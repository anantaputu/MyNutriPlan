@extends('layouts.member')
@section('title', 'Edit Bahan Makanan')

@section('content')
<div class="container py-4">
    {{-- Judul dibuat dinamis sesuai nama bahan --}}
    <h2>Edit Bahan Makanan: {{ $myMaterial->name }}</h2>

    <div class="card shadow-sm border-0 rounded-4 mt-4">
        <div class="card-body">
            {{-- Form action diubah ke route update dan method PUT --}}
            <form action="{{ route('member.foodMaterials.update', $myMaterial->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama bahan ditampilkan sebagai teks biasa (tidak bisa diubah) --}}
                <div class="mb-3">
                    <label class="form-label">Nama Bahan</label>
                    <input type="text" class="form-control" value="{{ $myMaterial->name }}" disabled readonly>
                </div>

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="quantity" class="form-label">Jumlah</label>
                        {{-- Input diisi dengan data yang ada --}}
                        <input type="number" step="any" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $myMaterial->pivot->quantity) }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="unit" class="form-label">Satuan</label>
                        {{-- Opsi yang sesuai akan terpilih secara otomatis --}}
                        <select name="unit" id="unit" class="form-select" required>
                            <option value="gram" {{ old('unit', $myMaterial->pivot->unit) == 'gram' ? 'selected' : '' }}>gram</option>
                            <option value="kg" {{ old('unit', $myMaterial->pivot->unit) == 'kg' ? 'selected' : '' }}>kg</option>
                            <option value="ml" {{ old('unit', $myMaterial->pivot->unit) == 'ml' ? 'selected' : '' }}>ml</option>
                            <option value="liter" {{ old('unit', $myMaterial->pivot->unit) == 'liter' ? 'selected' : '' }}>liter</option>
                            <option value="buah" {{ old('unit', $myMaterial->pivot->unit) == 'buah' ? 'selected' : '' }}>buah</option>
                        </select>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('member.foodMaterials.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
