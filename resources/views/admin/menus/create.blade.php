@extends('layouts.admin')
@section('title', 'Create New Menu')

@section('content')
<div class="container py-10 mt-5">
    <h2 class="mb-4">Buat Menu Baru</h2>

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
                    <label for="recipe" class="form-label">Resep</label>
                    <textarea class="form-control" id="recipe" name="recipe" rows="10">{{ old('recipe') }}</textarea>
                    @error('recipe')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="calories" class="form-label">Kalori</label>
                    <input type="number" class="form-control" id="calories" name="calories" value="{{ old('calories') }}" step="any" required>
                </div>
                <div class="mb-3">
                    <label for="meal_type" class="form-label">Tipe Makanan</label>
                    <select class="form-select" id="meal_type" name="meal_type" required>
                        <option value="">Pilih Tipe Makanan</option>
                        <option value="breakfast" {{ old('meal_type') == 'breakfast' ? 'selected' : '' }}>Sarapan</option>
                        <option value="lunch" {{ old('meal_type') == 'lunch' ? 'selected' : '' }}>Makan Siang</option>
                        <option value="dinner" {{ old('meal_type') == 'dinner' ? 'selected' : '' }}>Makan Malam</option>
                        <option value="snack" {{ old('meal_type') == 'snack' ? 'selected' : '' }}>Camilan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input class="form-control" type="file" id="photo" name="photo">
                    @error('photo')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <hr>

                <h4 class="mt-4">Bahan Makanan</h4>
                <div id="ingredients-container">
                    {{-- Ini untuk menampilkan bahan makanan yang sudah dipilih setelah validasi gagal --}}
                    @if(old('ingredients'))
                        @foreach(old('ingredients') as $index => $oldIngredientId)
                        <div class="row ingredient-row mb-3 align-items-center">
                            <div class="col-md-6">
                                <select name="ingredients[]" class="form-select">
                                    <option value="">Pilih Bahan Makanan</option>
                                    @foreach ($foodMaterials as $material)
                                        <option value="{{ $material->id }}" {{ $oldIngredientId == $material->id ? 'selected' : '' }}>
                                            {{ $material->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="quantities[]" class="form-control" placeholder="Jumlah (gram)" step="any" min="0" value="{{ old('quantities.'.$index) }}">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger remove-ingredient">Hapus</button>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>

                <button type="button" id="add-ingredient" class="btn btn-outline-primary mt-2">Tambah Bahan</button>
            </div>
        </div>

        <div class="mt-4 mb-3">
            <button type="submit" class="btn btn-primary">Buat Menu</button>
            <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<div id="ingredient-template" style="display: none;">
    <div class="row ingredient-row mb-3 align-items-center">
        <div class="col-md-6">
            <select name="ingredients[]" class="form-select">
                <option value="">Pilih Bahan Makanan</option>
                {{-- Loop ini akan selalu mencetak semua foodMaterials untuk template JS --}}
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
        // Mendapatkan konten template dari DOM
        const template = document.getElementById('ingredient-template').innerHTML;

        // Fungsi untuk menambahkan baris bahan makanan baru
        function addIngredientRow(selectedId = '', quantity = '') {
            const newRowHtml = template.trim();
            const newRowElement = document.createElement('div');
            newRowElement.innerHTML = newRowHtml;

            // Jika ada nilai lama, set nilainya
            if (selectedId) {
                const selectElement = newRowElement.querySelector('select[name="ingredients[]"]');
                if (selectElement) {
                    selectElement.value = selectedId;
                }
            }
            if (quantity) {
                const quantityElement = newRowElement.querySelector('input[name="quantities[]"]');
                if (quantityElement) {
                    quantityElement.value = quantity;
                }
            }

            ingredientsContainer.appendChild(newRowElement.firstElementChild);
        }

        addIngredientBtn.addEventListener('click', function() {
            addIngredientRow(); // Panggil tanpa argumen untuk baris kosong baru
        });

        ingredientsContainer.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-ingredient')) {
                e.target.closest('.ingredient-row').remove();
            }
        });

        // Jika ada old input (setelah validasi gagal), inisialisasi bahan makanan yang sudah ada
        @if(old('ingredients'))
            // Data sudah dicetak secara statis di PHP, jadi tidak perlu JS inisialisasi ulang
            // Ini adalah komentar untuk menjelaskan bahwa JS tidak perlu menginisialisasi
            // jika PHP sudah mencetak old() value.
        @endif
    });
</script>
@endpush