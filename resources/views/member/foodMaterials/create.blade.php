@extends('layouts.member')
@section('title', 'Tambah Bahan Makanan')

@section('content')
<div class="container py-4">
    <h2>Tambah Bahan Makanan ke Daftar Saya</h2>
    <div class="card shadow-sm border-0 rounded-4 mt-4">
        <div class="card-body">
            {{-- Bagian untuk menampilkan SEMUA error validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('member.foodMaterials.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="food_material_id" class="form-label">Pilih Bahan Makanan</label>
                    <select name="food_material_id" id="food_material_id" class="form-select @error('food_material_id') is-invalid @enderror" required>
                        <option value="" disabled {{ old('food_material_id') ? '' : 'selected' }}>-- Pilih dari daftar sistem --</option>
                        @foreach($systemMaterials as $material)
                        <option value="{{ $material->id }}" {{ old('food_material_id') == $material->id ? 'selected' : '' }}>
                            {{ $material->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('food_material_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Jumlah (gram)</label>
                    <input type="number" step="any" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" placeholder="Contoh: 100" value="{{ old('quantity') }}" required>
                    @error('quantity')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- INPUT 'UNIT' SEKARANG INVISIBLE (HIDDEN) DAN MENGIRIM NILAI 'gram' --}}
                <input type="hidden" name="unit" value="gram">
                
                <button type="submit" class="btn btn-primary rounded-pill">Tambahkan</button>
                <a href="{{ route('member.foodMaterials.index') }}" class="btn btn-secondary rounded-pill">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection