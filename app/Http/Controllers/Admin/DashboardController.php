<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Pastikan model User di-import
use App\Models\FoodMaterial; // Contoh model lain
use App\Models\Menu; // Contoh model lain
use App\Models\Article; // Contoh model lain
use Illuminate\Http\Request;
use Carbon\Carbon; // Pastikan Carbon di-import untuk manipulasi tanggal

class DashboardController extends Controller
{
    public function index()
    {
        // Mendapatkan total hitungan untuk kartu statistik
        $userCount = User::count();
        $foodMaterialCount = FoodMaterial::count();
        $menuCount = Menu::count();
        $articleCount = Article::count();

        // --- Logic untuk Grafik Pertumbuhan Pengguna ---
        $totalUsersData = [];
        $activeUsersData = []; // Untuk contoh ini, kita akan menghitung pengguna yang terdaftar di bulan tersebut
        $chartLabels = [];

        // Tentukan periode waktu (misal: 12 bulan terakhir)
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subMonths(11)->startOfMonth(); // 12 bulan termasuk bulan saat ini

        // Loop melalui setiap bulan dari startDate hingga endDate
        $currentDate = $startDate;
        while ($currentDate <= $endDate) {
            $month = $currentDate->format('M Y'); // Format: Jan 2023
            $chartLabels[] = $month;

            // Hitung total pengguna kumulatif hingga akhir bulan ini
            $totalUsersThisMonth = User::where('created_at', '<=', $currentDate->endOfMonth())->count();
            $totalUsersData[] = $totalUsersThisMonth;

            // Hitung pengguna yang aktif/terdaftar di bulan ini (non-kumulatif)
            $usersRegisteredThisMonth = User::whereBetween('created_at', [
                $currentDate->startOfMonth(),
                $currentDate->endOfMonth()
            ])->count();
            $activeUsersData[] = $usersRegisteredThisMonth; // Menggunakan "Registered Users This Month" sebagai "Active Users" untuk contoh ini.
                                                            // Jika "Active Users" memiliki definisi lain (misal: login terakhir), Anda perlu menyesuaikan kuerinya.

            $currentDate->addMonth();
        }
        // --- Akhir Logic untuk Grafik Pertumbuhan Pengguna ---

        return view('admin.dashboard', [
            'userCount' => $userCount,
            'foodMaterialCount' => $foodMaterialCount,
            'menuCount' => $menuCount,
            'articleCount' => $articleCount,
            'totalUsersData' => $totalUsersData,
            'activeUsersData' => $activeUsersData,
            'chartLabels' => $chartLabels,
        ]);
    }
}