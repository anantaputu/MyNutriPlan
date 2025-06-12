<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoodMaterial;
use Illuminate\Http\Request;

class FoodMaterialController extends Controller
{
    public function index()
    {
        $materials = FoodMaterial::latest()->get();
        return view('admin.food_materials.index', compact('materials'));
    }

    public function create()
    {
        return view('admin.food_materials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'calories' => 'required|numeric|min:0',
            'protein' => 'required|numeric|min:0',
            'fat' => 'required|numeric|min:0',
            'carbohydrates' => 'required|numeric|min:0',
            'fiber' => 'nullable|numeric|min:0',
            'vitamins' => 'nullable|string|max:255',
            'minerals' => 'nullable|string|max:255',
        ]);
        FoodMaterial::create($validated);
        return redirect()->route('admin.food-materials.index')->with('success', 'Bahan makanan berhasil ditambahkan.');
    }
    
    public function edit(FoodMaterial $foodMaterial)
    {
        return view('admin.food_materials.edit', ['material' => $foodMaterial]);
    }

    public function update(Request $request, FoodMaterial $foodMaterial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'calories' => 'required|numeric|min:0',
            'protein' => 'required|numeric|min:0',
            'fat' => 'required|numeric|min:0',
            'carbohydrates' => 'required|numeric|min:0',
            'fiber' => 'nullable|numeric|min:0',
            'vitamins' => 'nullable|string|max:255',
            'minerals' => 'nullable|string|max:255',
        ]);
        $foodMaterial->update($validated);
        return redirect()->route('admin.food-materials.index')->with('success', 'Bahan makanan berhasil diperbarui.');
    }

    public function destroy(FoodMaterial $foodMaterial)
    {
        $foodMaterial->delete();
        return redirect()->route('admin.food-materials.index')->with('success', 'Bahan makanan berhasil dihapus.');
    }
}