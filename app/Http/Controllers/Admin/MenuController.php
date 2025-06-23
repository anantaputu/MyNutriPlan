<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\FoodMaterial; // Pastikan ini di-import
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
        // Ambil semua data bahan makanan dari database, urutkan berdasarkan nama
        $foodMaterials = FoodMaterial::orderBy('name')->get();
        // Kirim data tersebut ke view saat menampilkannya
        return view('admin.menus.create', compact('foodMaterials'));
    }

    /**
     * Menyimpan menu yang baru dibuat ke dalam database.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'recipe'      => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'calories'    => 'required|integer|min:0',
            'meal_type'   => 'required|in:breakfast,lunch,dinner,snack', // Menambahkan 'snack' jika sebelumnya tidak ada di validasi
            // --- TAMBAHAN VALIDASI UNTUK BAHAN MAKANAN ---
            'ingredients' => 'nullable|array', // Mengizinkan array kosong atau tidak ada
            'ingredients.*' => 'required|exists:food_materials,id', // Setiap bahan harus ada di tabel food_materials
            'quantities'  => 'nullable|array', // Mengizinkan array kosong atau tidak ada
            'quantities.*' => 'required|numeric|min:0.01', // Setiap kuantitas harus angka positif
            // --- AKHIR TAMBAHAN VALIDASI ---
        ]);

        // Jika ada file foto yang di-upload, simpan filenya
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('menus', 'public');
            $validated['photo'] = $path;
        } else {
            // Jika tidak ada foto baru di-upload, pastikan kolom photo tidak di-set
            unset($validated['photo']);
        }

        // Buat 'slug' dari judul untuk URL yang rapi
        $validated['slug'] = Str::slug($request->title);

        // Buat record baru di database
        // Gunakan $menu = Menu::create(...) agar kita bisa mengakses instance menu yang baru dibuat
        $menu = Menu::create($validated);

        // --- BAGIAN PENTING: MENYIMPAN BAHAN MAKANAN KE TABEL PIVOT ---
        $syncData = [];
        // Pastikan kedua array (ingredients dan quantities) ada dan memiliki jumlah elemen yang sama
        if ($request->has('ingredients') && $request->has('quantities') &&
            is_array($request->ingredients) && is_array($request->quantities) &&
            count($request->ingredients) === count($request->quantities))
        {
            foreach ($request->ingredients as $index => $ingredientId) {
                $quantity = $request->quantities[$index];
                // Validasi tambahan di sini untuk keamanan, meskipun sudah ada di atas
                if (is_numeric($ingredientId) && $ingredientId > 0 && is_numeric($quantity) && $quantity >= 0.01) {
                    $syncData[$ingredientId] = ['quantity_grams' => (float)$quantity];
                }
            }
        }
        $menu->foodMaterials()->sync($syncData); // Sinkronkan relasi many-to-many
        // --- AKHIR BAGIAN PENTING ---

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
        // Load juga bahan makanan yang sudah terkait dengan menu ini
        $menu->load('foodMaterials');
        return view('admin.menus.edit', compact('foodMaterials', 'menu'));
    }

    /**
     * Mengupdate data menu di database.
     */
    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'recipe'      => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'calories'    => 'required|integer|min:0',
            'meal_type'   => 'required|in:breakfast,lunch,dinner,snack', // Menambahkan 'snack' jika sebelumnya tidak ada di validasi
            // --- TAMBAHAN VALIDASI UNTUK BAHAN MAKANAN ---
            'ingredients' => 'nullable|array',
            'ingredients.*' => 'required|exists:food_materials,id',
            'quantities'  => 'nullable|array',
            'quantities.*' => 'required|numeric|min:0.01',
            // --- AKHIR TAMBAHAN VALIDASI ---
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
        } else {
            // Jika tidak ada foto baru di-upload, dan checkbox "hapus foto lama" tidak ada,
            // atau jika Anda ingin mempertahankan foto lama,
            // pastikan validated array tidak menimpa nilai photo dengan NULL
            if (!isset($validated['photo'])) {
                unset($validated['photo']); // Penting: Jangan biarkan 'photo' menjadi NULL jika tidak ada upload baru
            }
        }

        // Pastikan slug di-update jika judul berubah
        $validated['slug'] = Str::slug($request->title);

        // Update record di database
        $menu->update($validated);

        // --- BAGIAN PENTING: MENGUPDATE BAHAN MAKANAN KE TABEL PIVOT ---
        $syncData = [];
        if ($request->has('ingredients') && $request->has('quantities') &&
            is_array($request->ingredients) && is_array($request->quantities) &&
            count($request->ingredients) === count($request->quantities))
        {
            foreach ($request->ingredients as $index => $ingredientId) {
                $quantity = $request->quantities[$index];
                if (is_numeric($ingredientId) && $ingredientId > 0 && is_numeric($quantity) && $quantity >= 0.01) {
                    $syncData[$ingredientId] = ['quantity_grams' => (float)$quantity];
                }
            }
        }
        $menu->foodMaterials()->sync($syncData); // Sinkronkan relasi many-to-many
        // --- AKHIR BAGIAN PENTING ---

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui!');
    }

    /**
     * Menampilkan detail menu.
     * (Opsional, jika Anda memiliki halaman detail menu)
     */
    public function show(Menu $menu)
    {
        $menu->load('foodMaterials'); // Load bahan makanan terkait
        return view('admin.menus.show', compact('menu'));
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

        // Hapus relasi di tabel pivot terlebih dahulu (opsional, cascade delete biasanya diatur di migrasi)
        // Jika Anda tidak menggunakan cascade delete di migrasi, ini penting:
        $menu->foodMaterials()->detach();

        // Hapus record dari database
        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus!');
    }
}