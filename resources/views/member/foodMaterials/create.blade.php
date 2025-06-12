@extends('layouts.member')
@section('title', 'Tambah Bahan Makanan')

@section('content')
<div class="container py-4">
    <h2>Tambah Bahan Makanan ke Daftar Saya</h2>
    <div class="card shadow-sm border-0 rounded-4 mt-4">
        <div class="card-body">
            <form action="{{ route('member.foodMaterials.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="food_material_id" class="form-label">Pilih Bahan Makanan</label>
                    <select name="food_material_id" id="food_material_id" class="form-select" required>
                        <option value="" disabled selected>-- Pilih dari daftar sistem --</option>
                        @foreach($systemMaterials as $material)
                        <option value="{{ $material->id }}">{{ $material->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="quantity" class="form-label">Jumlah</label>
                        <input type="number" step="any" name="quantity" id="quantity" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="unit" class="form-label">Satuan</label>
                        <select name="unit" id="unit" class="form-select" required>
                            <option value="gram">gram</option>
                            <option value="kg">kg</option>
                            <option value="ml">ml</option>
                            <option value="liter">liter</option>
                            <option value="buah">buah</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Tambahkan</button>
                <a href="{{ route('member.foodMaterials.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
