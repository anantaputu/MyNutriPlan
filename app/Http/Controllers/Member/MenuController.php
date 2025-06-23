<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\FoodMaterial; // Pastikan ini di-import jika digunakan di controller
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth
use Illuminate\Database\Eloquent\Builder; // Import Builder
use Parsedown;

class MenuController extends Controller
{
    public function index() {
        $user = Auth::user();

        // Mengubah .get() menjadi .paginate()
        // Jumlah item per halaman (misal: 9 menu per halaman)
        $menus = Menu::latest()->with('foodMaterials')->paginate(9); // Eager load foodMaterials

        // Logika pengecekan ketersediaan bahan tetap sama,
        // namun sekarang diterapkan pada koleksi yang sudah dipaginasi
        if ($user) {
            $userInventory = $user->myFoodMaterials->keyBy('id')->map(function ($material) {
                return $material->pivot->quantity;
            });
            $userMaterialIds = $userInventory->keys()->toArray();

            foreach ($menus as $menu) { // Loop ini sekarang akan bekerja pada item-item di halaman saat ini
                $requiredMaterialsCount = $menu->foodMaterials->count();
                $missingMaterials = [];
                $canBeMadeFully = true;

                if ($requiredMaterialsCount === 0) {
                    $canBeMadeFully = false;
                    $menu->status_ketersediaan = 'unknown'; // Atau 'tidak_ada_resep'
                    $menu->missing_materials = [];
                    continue;
                }

                foreach ($menu->foodMaterials as $requiredMaterial) {
                    $requiredQuantity = $requiredMaterial->pivot->quantity_grams;
                    $userHasQuantity = $userInventory->get($requiredMaterial->id, 0);

                    if (!in_array($requiredMaterial->id, $userMaterialIds) || $userHasQuantity < $requiredQuantity) {
                        $canBeMadeFully = false;
                        $missingMaterials[] = [
                            'id' => $requiredMaterial->id,
                            'name' => $requiredMaterial->name,
                            'needed' => $requiredQuantity,
                            'have' => $userHasQuantity,
                        ];
                    }
                }
                $menu->status_ketersediaan = $canBeMadeFully ? 'bisa_dibuat' : 'bahan_kurang';
                $menu->missing_materials = $missingMaterials;
            }
        } else {
            // Jika user tidak login, semua menu diasumsikan 'tidak_diketahui' ketersediaannya
            foreach ($menus as $menu) {
                $menu->status_ketersediaan = 'tidak_login';
                $menu->missing_materials = [];
            }
        }

        return view('member.menus.index', compact('menus'));
    }

    /**
     * Menampilkan detail dari satu menu.
     * Menggunakan Route-Model Binding untuk secara otomatis menemukan menu berdasarkan slug.
     */
    public function show(Menu $menu)
    {
        $parsedown = new Parsedown();
        $menu->recipe_html = $parsedown->text($menu->recipe); // Buat properti baru untuk HTML yang sudah di-parse
        $menu->description_html = $parsedown->text($menu->description);

        return view('member.menus.show', compact('menu'));
    }
}
