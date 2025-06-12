<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Menampilkan daftar menu yang bisa dibuat berdasarkan bahan makanan pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 1. Dapatkan pengguna yang sedang login
        $user = Auth::user();

        // 2. Ambil ID dari semua bahan makanan yang dimiliki pengguna
        //    (Asumsi: Anda memiliki relasi 'userFoodMaterials' pada model User)
        $userFoodMaterialIds = $user->userFoodMaterials()->pluck('food_material_id')->toArray();

        // 3. Filter menu:
        //    Gunakan relasi 'foodMaterials' sesuai dengan definisi di Menu Model.
        //    Logikanya adalah mengambil semua menu yang TIDAK memiliki bahan ('foodMaterials')
        //    yang TIDAK ADA ('whereNotIn') dalam daftar bahan yang dimiliki pengguna.
        $menus = Menu::whereDoesntHave('foodMaterials', function ($query) use ($userFoodMaterialIds) {
            $query->whereNotIn('food_material_id', $userFoodMaterialIds);
        })->paginate(9);

        // 4. Tampilkan halaman view dan kirim data menu yang sudah difilter
        return view('member.menus.index', compact('menus'));
    }

    /**
     * Menampilkan detail dari satu menu.
     * Menggunakan Route-Model Binding untuk secara otomatis menemukan menu berdasarkan ID.
     */
    public function show(Menu $menu)
    {
        // Tampilkan view untuk detail menu
        return view('member.menus.show', compact('menu'));
    }

    // ... method lainnya tetap sama untuk saat ini ...
}
