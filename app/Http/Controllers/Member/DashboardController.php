<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Article; // Pastikan ini di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard dengan rencana makan berdasarkan inventaris bahan pengguna.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user->weight || !$user->height || !$user->age || !$user->activity_level) {
            return redirect()->route('profile.edit')->with('status', 'Silakan lengkapi data profil Anda terlebih dahulu.');
        }

        $tdee = $this->calculateTdee($user);
        $bmr = $this->calculateBmr($user);
        $mealPlan = null;
        $error = null;

        try {
            $targets = [
                'breakfast' => $tdee * 0.30,
                'lunch'     => $tdee * 0.40,
                'dinner'    => $tdee * 0.30,
            ];

            $breakfastResult = $this->findBestMenuForUser('breakfast', $targets['breakfast'], $user);
            $lunchResult     = $this->findBestMenuForUser('lunch', $targets['lunch'], $user);
            $dinnerResult    = $this->findBestMenuForUser('dinner', $targets['dinner'], $user);

            if (!$breakfastResult && !$lunchResult && !$dinnerResult) {
                $error = "Kami tidak dapat menemukan menu yang relevan sama sekali. Tambahkan lebih banyak bahan.";
            } else {
                foreach (['breakfast', 'lunch', 'dinner'] as $mealType) {
                    $resultKey = $mealType . 'Result';
                    $currentResult = $$resultKey;

                    if ($currentResult) {
                        $mealPlan[$mealType] = [
                            'dishes' => [$currentResult->menu->title],
                            'summary' => $currentResult->menu->description ?? 'Rekomendasi ' . $mealType . ' dari bahan yang Anda miliki.',
                            'can_be_made' => $currentResult->can_be_made,
                            'missing_materials' => $currentResult->missing_materials,
                            'menu_slug' => $currentResult->menu->slug,
                        ];
                    } else {
                        $mealPlan[$mealType] = [
                            'dishes' => [],
                            'summary' => 'Maaf, kami tidak menemukan menu ' . $mealType . ' yang cocok dengan bahan Anda.',
                            'can_be_made' => false,
                            'missing_materials' => [],
                            'menu_slug' => null,
                        ];
                    }
                }
            }

        } catch (\Exception $e) {
            $error = "Terjadi kesalahan saat memproses data menu Anda: " . $e->getMessage();
        }

        // --- BAGIAN BARU UNTUK ARTIKEL (Mengambil 5 artikel) ---
        $featuredArticles = Article::latest()->take(5)->get(); // Mengambil 5 artikel terbaru
        // --- AKHIR BAGIAN BARU ---

        return view('member.dashboard', [
            'user'            => $user,
            'bmr'             => round($bmr),
            'tdee'            => round($tdee),
            'mealPlan'        => $mealPlan,
            'error'           => $error,
            'featuredArticles' => $featuredArticles, // Kirim koleksi artikel ke view
        ]);
    }

    /**
     * Mencari menu terbaik untuk user berdasarkan bahan yang dimiliki.
     */
    private function findBestMenuForUser(string $mealType, float $targetCalories, $user)
    {
        $userInventory = $user->myFoodMaterials->keyBy('id')->map(function ($material) {
            return $material->pivot->quantity;
        });
        $userMaterialIds = $userInventory->keys()->toArray();

        if (empty($userMaterialIds)) {
            return null;
        }

        $allMenusForMealType = Menu::where('meal_type', $mealType)
            ->with('foodMaterials')
            ->get();

        $scoredMenus = $allMenusForMealType->map(function ($menu) use ($userInventory, $userMaterialIds) {
            $requiredMaterialsCount = $menu->foodMaterials->count();
            if ($requiredMaterialsCount === 0) {
                return null;
            }

            $availableMaterialsCount = 0;
            $missingMaterials = [];
            $canBeMade = true;

            foreach ($menu->foodMaterials as $requiredMaterial) {
                $requiredQuantity = $requiredMaterial->pivot->quantity_grams;
                $userHasQuantity = $userInventory->get($requiredMaterial->id, 0);

                if (!in_array($requiredMaterial->id, $userMaterialIds) || $userHasQuantity < $requiredQuantity) {
                    $canBeMade = false;
                    $missingMaterials[] = [
                        'id' => $requiredMaterial->id,
                        'name' => $requiredMaterial->name,
                        'needed' => $requiredQuantity,
                        'have' => $userHasQuantity,
                        'reason' => 'Kuantitas kurang'
                    ];
                }
            }

            $matchScore = ($requiredMaterialsCount > 0) ? ($availableMaterialsCount / $requiredMaterialsCount) : 0;

            return (object)[
                'menu' => $menu,
                'match_score' => $matchScore,
                'can_be_made' => $canBeMade,
                'missing_materials' => $missingMaterials,
                'missing_count' => count($missingMaterials)
            ];
        })->filter();

        if ($scoredMenus->isEmpty()) {
            return null;
        }

        return $scoredMenus->sortBy(function ($item) use ($targetCalories) {
            $canBeMadePriority = $item->can_be_made ? 0 : 1;
            $missingCount = $item->missing_count;
            $calorieDifference = abs($item->menu->calories - $targetCalories);
            return $canBeMadePriority * 1000000 + $missingCount * 1000 + $calorieDifference;
        })->first();
    }

    /**
     * Menghitung BMR (Basal Metabolic Rate).
     */
    private function calculateBmr($user)
    {
        $gender = $user->gender ?? 'male';
        if (strtolower($gender) == 'male') {
            return 88.362 + (13.397 * $user->weight) + (4.799 * $user->height) - (5.677 * $user->age);
        }
        return 447.593 + (9.247 * $user->weight) + (3.098 * $user->height) - (4.330 * $user->age);
    }

    /**
     * Menghitung TDEE menggunakan BMR.
     */
    private function calculateTdee($user)
    {
        $bmr = $this->calculateBmr($user);

        $activityMultipliers = [
            'sedentary' => 1.2,
            'lightly_active' => 1.375,
            'moderately_active' => 1.55,
            'very_active' => 1.725,
            'extremely_active' => 1.9,
        ];

        $activityLevelKey = strtolower(str_replace(' ', '_', $user->activity_level));
        $multiplier = $activityMultipliers[$activityLevelKey] ?? 1.2;
        return $bmr * $multiplier;
    }
}