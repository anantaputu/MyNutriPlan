@extends('layouts.admin')
@section('title', 'Food Material Management')

@section('content')
<section class="py-10">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Food Material Management</h2>
            <a href="{{ route('admin.food-materials.create') }}" class="btn btn-success rounded-pill">Tambah Bahan</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered overflow-hidden" id="foodMaterialsTable">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Kalori (kcal)</th>
                        <th>Protein (g)</th>
                        <th>Lemak (g)</th>
                        <th>Karbo (g)</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                {{-- Hapus blok @empty dan gunakan loop @foreach biasa --}}
                <tbody>
                    @foreach ($materials as $material)
                    <tr>
                        <td>{{ $material->id }}</td>
                        <td>{{ $material->name }}</td>
                        <td>{{ $material->calories }}</td>
                        <td>{{ $material->protein }}</td>
                        <td>{{ $material->fat }}</td>
                        <td>{{ $material->carbohydrates }}</td>
                        <td>
                            <a href="{{ route('admin.food-materials.edit', $material->id) }}" class="btn btn-sm btn-warning rounded-pill">Edit</a>
                            <form action="{{ route('admin.food-materials.destroy', $material->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus bahan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger rounded-pill">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Tambahkan opsi language.emptyTable untuk menangani tabel kosong
        $('#foodMaterialsTable').DataTable({
            "language": {
                "emptyTable": "Belum ada data bahan makanan."
            }
        });
    });
</script>
@endpush
