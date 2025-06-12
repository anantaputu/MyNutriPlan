@extends('layouts.admin')
@section('title', 'Tambah Menu Baru')

@section('content')
<div class="container py-10 mt-5">
    <h2 class="mb-4">Tambah Menu Baru</h2>

    {{-- Menampilkan error validasi jika ada --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card p-4">
            <div class="card-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Menu Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input class="form-control" type="file" id="photo" name="photo">
                </div>

                <hr>

                <h4 class="mt-4">Bahan Makanan</h4>
                <div id="ingredients-container">
                    {{-- Baris bahan makanan akan ditambahkan di sini oleh JavaScript --}}
                </div>

                <button type="button" id="add-ingredient" class="btn btn-outline-primary mt-2">Tambah Bahan</button>
            </div>
        </div>

        <div class="mt-4 mb-3">
            <button type="submit" class="btn btn-primary">Simpan Menu</button>
            <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<!-- Template untuk baris bahan makanan (disembunyikan) -->
<div id="ingredient-template" style="display: none;">
    <div class="row ingredient-row mb-3 align-items-center">
        <div class="col-md-6">
            <select name="ingredients[]" class="form-select">
                <option value="">Pilih Bahan Makanan</option>
                {{-- Opsi ini akan diisi oleh controller --}}
                @foreach ($foodMaterials as $material)
                    <option value="{{ $material->id }}">{{ $material->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <input type="number" name="quantities[]" class="form-control" placeholder="Jumlah (gram)" step="any" min="0">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-danger remove-ingredient">Hapus</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addIngredientBtn = document.getElementById('add-ingredient');
        const ingredientsContainer = document.getElementById('ingredients-container');
        const template = document.getElementById('ingredient-template').innerHTML;

        addIngredientBtn.addEventListener('click', function() {
            ingredientsContainer.insertAdjacentHTML('beforeend', template);
        });

        ingredientsContainer.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-ingredient')) {
                e.target.closest('.ingredient-row').remove();
            }
        });
    });
</script>
@endpush
