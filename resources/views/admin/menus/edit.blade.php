@extends('layouts.admin')
@section('title', 'Edit Menu')

@section('content')
<div class="container py-10 mt-5">
    {{-- Judul halaman diubah untuk mode edit --}}
    <h2 class="mb-4">Edit Menu: {{ $menu->title }}</h2>

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

    {{-- Form action diubah ke route 'update' dan method 'PUT' --}}
    <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card p-4">
            <div class="card-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Menu Title</label>
                    {{-- Nilai input diisi dengan data yang ada --}}
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $menu->title) }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    {{-- Textarea diisi dengan data yang ada --}}
                    <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description', $menu->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input class="form-control" type="file" id="photo" name="photo">
                    {{-- Menampilkan foto saat ini jika ada --}}
                    @if($menu->photo)
                        <small class="form-text text-muted mt-2">Foto saat ini:</small>
                        <img src="{{ asset('storage/' . $menu->photo) }}" class="img-thumbnail mt-2" style="width: 150px;">
                    @endif
                </div>

                <hr>

                <h4 class="mt-4">Bahan Makanan</h4>
                <div id="ingredients-container">
                    {{-- Loop untuk menampilkan bahan makanan yang sudah ada --}}
                    @foreach($menu->foodMaterials as $existingMaterial)
                    <div class="row ingredient-row mb-3 align-items-center">
                        <div class="col-md-6">
                            <select name="ingredients[]" class="form-select">
                                <option value="">Pilih Bahan Makanan</option>
                                @foreach ($foodMaterials as $material)
                                    {{-- Pilih bahan yang sesuai dengan data yang ada --}}
                                    <option value="{{ $material->id }}" {{ $existingMaterial->id == $material->id ? 'selected' : '' }}>
                                        {{ $material->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            {{-- Isi jumlah gram yang sesuai --}}
                            <input type="number" name="quantities[]" class="form-control" placeholder="Jumlah (gram)" step="any" min="0" value="{{ $existingMaterial->pivot->quantity_grams }}">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-ingredient">Hapus</button>
                        </div>
                    </div>
                    @endforeach
                </div>

                <button type="button" id="add-ingredient" class="btn btn-outline-primary mt-2">Tambah Bahan</button>
            </div>
        </div>

        <div class="mt-4 mb-3">
            {{-- Tombol submit diubah menjadi 'Update Menu' --}}
            {{-- Tombol submit diubah menjadi 'Update' --}}
            <button type="submit" class="btn btn-primary">Update Menu</button>
            <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<div id="ingredient-template" style="display: none;">
    <div class="row ingredient-row mb-3 align-items-center">
        <div class="col-md-6">
            <select name="ingredients[]" class="form-select">
                <option value="">Pilih Bahan Makanan</option>
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
{{-- JavaScript tetap sama seperti di create view --}}
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
