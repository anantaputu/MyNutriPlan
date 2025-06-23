@extends('layouts.member')
@section('title', 'Bahan Makanan Saya')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Bahan Makanan Saya</h2>
        <div class="">
            <a href="{{ route('member.foodMaterials.create') }}" class="btn btn-success rounded-pill mb-2">Tambah Bahan Makanan</a>
            <a href="{{ route('member.dashboard') }}" class="btn btn-secondary rounded-pill mb-2">Kembali</a>
        </div>
    </div>

    <div class="row">
        @forelse($myMaterials as $material)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-4">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">{{ $material->name }}</h5>
                            <p class="card-text mb-3">
                                {{ $material->pivot->quantity }} {{ $material->pivot->unit }}
                            </p>
                        </div>
                        <div class="mt-auto">
                            <a href="{{ route('member.foodMaterials.edit', $material->id) }}" class="btn btn-warning btn-sm rounded-5 w-100 mb-2">Edit</a>
                            
                            {{-- TOMBOL HAPUS SEKARANG MEMICU MODAL --}}
                            <button type="button" class="btn btn-danger btn-sm rounded-5 w-100"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteConfirmationModal"
                                data-bs-id="{{ $material->id }}"
                                data-bs-name="{{ $material->name }}">
                                Hapus
                            </button>
                            
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Anda belum memiliki bahan makanan.
                </div>
            </div>
        @endforelse
    </div>
</div>

<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi Penghapusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus bahan makanan <strong id="materialNamePlaceholder"></strong> dari daftar Anda? Aksi ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var deleteConfirmationModal = document.getElementById('deleteConfirmationModal');

    if (deleteConfirmationModal) {
        deleteConfirmationModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;

            var materialId = button.getAttribute('data-bs-id');
            var materialName = button.getAttribute('data-bs-name');

            var materialNamePlaceholder = deleteConfirmationModal.querySelector('#materialNamePlaceholder');
            materialNamePlaceholder.textContent = materialName;

            var deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/member/food-materials/${materialId}`; 
        });
    }
});
</script>
@endpush