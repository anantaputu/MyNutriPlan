@extends('layouts.admin')
@section('title', 'Tambah Bahan Makanan')
@section('content')
<div class="container py-10 mt-5">
    <h2 class="mb-4">Tambah Bahan Makanan Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.food-materials.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="calories" class="form-label">Kalori (kcal)</label>
                <input type="number" step="any" class="form-control" id="calories" name="calories" value="{{ old('calories') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="protein" class="form-label">Protein (g)</label>
                <input type="number" step="any" class="form-control" id="protein" name="protein" value="{{ old('protein') }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="fat" class="form-label">Lemak (g)</label>
                <input type="number" step="any" class="form-control" id="fat" name="fat" value="{{ old('fat') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="carbohydrates" class="form-label">Karbohidrat (g)</label>
                <input type="number" step="any" class="form-control" id="carbohydrates" name="carbohydrates" value="{{ old('carbohydrates') }}" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="fiber" class="form-label">Serat (g)</label>
            <input type="number" step="any" class="form-control" id="fiber" name="fiber" value="{{ old('fiber') }}">
        </div>
        <div class="mb-3">
            <label for="vitamins" class="form-label">Vitamin (Contoh: A, B1, C)</label>
            <input type="text" class="form-control" id="vitamins" name="vitamins" value="{{ old('vitamins') }}">
        </div>
        <div class="mb-3">
            <label for="minerals" class="form-label">Mineral (Contoh: Fe, Mg, Zn)</label>
            <input type="text" class="form-control" id="minerals" name="minerals" value="{{ old('minerals') }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.food-materials.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection