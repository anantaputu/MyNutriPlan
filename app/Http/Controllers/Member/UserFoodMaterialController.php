<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\FoodMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFoodMaterialController extends Controller
{
    public function index()
    {
        $myMaterials = Auth::user()->myFoodMaterials;
        return view('member.foodMaterials.index', compact('myMaterials'));
    }

    public function create()
    {
        // Ambil bahan makanan dari sistem yang belum dimiliki pengguna
        $existingIds = Auth::user()->myFoodMaterials()->pluck('food_material_id');
        $systemMaterials = FoodMaterial::whereNotIn('id', $existingIds)->orderBy('name')->get();
        return view('member.foodMaterials.create', compact('systemMaterials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'food_material_id' => 'required|exists:food_materials,id',
            'quantity' => 'required|numeric|min:0.1',
            'unit' => 'required|string',
        ]);

        Auth::user()->myFoodMaterials()->attach($request->food_material_id, [
            'quantity' => $request->quantity,
            'unit' => $request->unit
        ]);

        return redirect()->route('member.foodMaterials.index')->with('success', 'Bahan makanan berhasil ditambahkan.');
    }

    public function edit($materialId)
    {
        $myMaterial = Auth::user()->myFoodMaterials()->findOrFail($materialId);
        return view('member.foodMaterials.edit', compact('myMaterial'));
    }

    public function update(Request $request, $materialId)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:0.1',
            'unit' => 'required|string',
        ]);
        
        Auth::user()->myFoodMaterials()->updateExistingPivot($materialId, [
            'quantity' => $request->quantity,
            'unit' => $request->unit
        ]);

        return redirect()->route('member.foodMaterials.index')->with('success', 'Bahan makanan berhasil diperbarui.');
    }

    public function destroy($materialId)
    {
        Auth::user()->myFoodMaterials()->detach($materialId);
        return redirect()->route('member.foodMaterials.index')->with('success', 'Bahan makanan berhasil dihapus.');
    }
}
