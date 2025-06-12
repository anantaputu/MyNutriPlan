<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\FoodMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Menampilkan daftar semua menu.
     */
    public function index()
    {
        $menus = Menu::latest()->get();
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Menampilkan form untuk membuat menu baru.
     */
    public function create()
    {
        // 1. Ambil semua data bahan makanan dari database, urutkan berdasarkan nama
        $foodMaterials = FoodMaterial::orderBy('name')->get();
        // 2. Kirim data tersebut ke view saat menampilkannya
        return view('admin.menus.create', compact('foodMaterials'));
    }

    /**
     * Menyimpan menu yang baru dibuat ke dalam database.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Jika ada file foto yang di-upload, simpan filenya
        if ($request->hasFile('photo')) {
            // Simpan foto di dalam folder 'storage/app/public/menus'
            $path = $request->file('photo')->store('menus', 'public');
            $validated['photo'] = $path;
        }

        // Buat 'slug' dari judul untuk URL yang rapi
        $validated['slug'] = Str::slug($request->title);

        // Buat record baru di database
        Menu::create($validated);

        // Alihkan kembali ke halaman daftar menu dengan pesan sukses
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit menu.
     * Menggunakan Route Model Binding untuk mengambil data menu secara otomatis.
     */
    public function edit(Menu $menu)
    {
        $foodMaterials = FoodMaterial::orderBy('name')->get();
        return view('admin.menus.edit', compact('foodMaterials'), ['menu' => $menu]);
    }

    /**
     * Mengupdate data menu di database.
     */
    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Jika ada foto baru yang di-upload
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($menu->photo) {
                Storage::disk('public')->delete($menu->photo);
            }
            // Simpan foto baru dan update path-nya
            $path = $request->file('photo')->store('menus', 'public');
            $validated['photo'] = $path;
        }

        $validated['slug'] = Str::slug($request->title);

        // Update record di database
        $menu->update($validated);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui!');
    }

    /**
     * Menghapus menu dari database.
     */
    public function destroy(Menu $menu)
    {
        // Hapus file foto dari storage jika ada
        if ($menu->photo) {
            Storage::disk('public')->delete($menu->photo);
        }

        // Hapus record dari database
        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus!');
    }
}
