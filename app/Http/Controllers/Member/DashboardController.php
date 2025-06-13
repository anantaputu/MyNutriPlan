<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Article; // <-- Tambahkan ini untuk mengimpor model Article

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard member beserta kalkulasi gizi.
     */
    public function index()
    {
        // 1. Ambil data pengguna yang sedang login
        $user = Auth::user();

        // Jika data profil pengguna belum lengkap, alihkan ke halaman profil
        if (!$user->age || !$user->gender || !$user->weight || !$user->height || !$user->activity_level) {
            return redirect()->route('profile.edit')->with('error', 'Silakan lengkapi data profil Anda terlebih dahulu untuk melihat ringkasan gizi.');
        }

        // 2. Lakukan kalkulasi kebutuhan gizi (BMR dan TDEE)
        // Rumus Harris-Benedict
        $bmr = 0;
        if (strtolower($user->gender) == 'male') {
            $bmr = 88.362 + (13.397 * $user->weight) + (4.799 * $user->height) - (5.677 * $user->age);
        } elseif (strtolower($user->gender) == 'female') {
            $bmr = 447.593 + (9.247 * $user->weight) + (3.098 * $user->height) - (4.330 * $user->age);
        }

        // Faktor Aktivitas untuk TDEE
        $activityFactors = [
            'sedentary' => 1.2, // Pastikan konsisten dengan nilai di form (huruf kecil, tanpa spasi)
            'lightly_active' => 1.375,
            'moderately_active' => 1.55,
            'very_active' => 1.725,
            'extremely_active' => 1.9,
        ];

        // Normalisasi activity_level dari user agar sesuai dengan key activityFactors
        $userActivityLevel = strtolower(str_replace(' ', '_', $user->activity_level));
        $activityFactor = $activityFactors[$userActivityLevel] ?? 1.2;
        $tdee = $bmr * $activityFactor;

        // 3. Panggil Gemini API untuk mendapatkan rekomendasi makan
        $recommendations = $this->getMealRecommendations($user, round($tdee));

        // 4. Ambil beberapa artikel terbaru untuk ditampilkan di dashboard
        $articles = Article::latest()->limit(5)->get(); // Mengambil 5 artikel terbaru

        // 5. Kirim semua data yang diperlukan ke view
        return view('member.dashboard', [
            'user' => $user,
            'bmr' => round($bmr),
            'tdee' => round($tdee),
            'recommendations' => $recommendations,
            'articles' => $articles, // <-- Kirim data artikel ke view
        ]);
    }

    /**
     * Fungsi privat untuk mengambil rekomendasi rencana makan dari Gemini API.
     *
     * @param \App\Models\User $user
     * @param int $tdee
     * @return array
     */
    private function getMealRecommendations($user, $tdee)
    {
        // Ambil API Key dari file .env
        $apiKey = env('GEMINI_API_KEY');
        if (!$apiKey) {
            Log::error('GEMINI_API_KEY tidak ditemukan di file .env.');
            return []; // Kembalikan array kosong jika API key tidak ada
        }
        
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$apiKey}";

        // Buat prompt yang detail untuk hasil yang lebih baik
        $prompt = "
            Anda adalah seorang ahli gizi. Buatkan saya rekomendasi rencana makan harian yang realistis untuk satu hari di Indonesia dalam format JSON.
            Berikut adalah data pengguna:
            - Usia: {$user->age} tahun
            - Jenis Kelamin: {$user->gender}
            - Berat Badan: {$user->weight} kg
            - Tinggi Badan: {$user->height} cm
            - Tingkat Aktivitas: {$user->activity_level}
            - Target Kalori Harian (TDEE): sekitar {$tdee} kalori.

            Gunakan struktur JSON yang ketat seperti ini:
            {
                \"sarapan\": {
                    \"estimasi_kalori\": ".round($tdee * 0.3).",
                    \"menu\": [\"Contoh menu 1\", \"Contoh menu 2\"],
                    \"deskripsi\": \"Penjelasan singkat dan menarik tentang manfaat menu sarapan ini.\"
                },
                \"makan_siang\": {
                    \"estimasi_kalori\": ".round($tdee * 0.4).",
                    \"menu\": [\"Contoh menu 1\", \"Contoh menu 2\", \"Contoh menu 3\"],
                    \"deskripsi\": \"Penjelasan singkat dan menarik tentang manfaat menu makan siang ini.\"
                },
                \"makan_malam\": {
                    \"estimasi_kalori\": ".round($tdee * 0.3).",
                    \"menu\": [\"Contoh menu 1\", \"Contoh menu 2\"],
                    \"deskripsi\": \"Penjelasan singkat dan menarik tentang manfaat menu makan malam ini.\"
                }
            }

            Prioritaskan bahan makanan yang umum ditemukan di Indonesia. Jangan sertakan markdown (seperti ```json) dalam respons, hanya JSON murni.
        ";

        try {
            $response = Http::timeout(30)->post($url, [ // Timeout 30 detik
                'contents' => [
                    [ 'parts' => [ ['text' => $prompt] ] ]
                ]
            ]);

            if ($response->successful() && isset($response->json()['candidates'][0]['content']['parts'][0]['text'])) {
                $jsonResult = $response->json()['candidates'][0]['content']['parts'][0]['text'];
                return json_decode($jsonResult, true);
            } else {
                Log::error('Gagal mendapatkan respons valid dari Gemini API.', ['response' => $response->body()]);
                return [];
            }
        } catch (\Exception $e) {
            Log::error('Exception saat memanggil Gemini API: ' . $e->getMessage());
            return []; // Kembalikan array kosong jika terjadi exception
        }
    }
}
