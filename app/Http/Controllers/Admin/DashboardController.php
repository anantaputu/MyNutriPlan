<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\FoodMaterial;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dasbor admin dengan data ringkasan.
     */
    public function index()
    {
        // Mengambil data untuk kartu statistik
        $userCount = User::count();
        $foodMaterialCount = FoodMaterial::count();
        $menuCount = Menu::count();
        $articleCount = Article::count();
        
        // Contoh data untuk chart, di aplikasi nyata ini akan berasal dari query database.
        // Misalnya, menghitung user baru per bulan.
        $chartLabels = ['Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May'];
        $totalUsersData = [80, 90, 100, 110, 120, 130, 140];
        $activeUsersData = [60, 70, 80, 90, 100, 110, 120];

        // Kirim semua data ke view 'admin.dashboard'
        return view('admin.dashboard', [
            'userCount' => $userCount,
            'foodMaterialCount' => $foodMaterialCount,
            'menuCount' => $menuCount,
            'articleCount' => $articleCount,
            'chartLabels' => $chartLabels,
            'totalUsersData' => $totalUsersData,
            'activeUsersData' => $activeUsersData,
        ]);
    }
}