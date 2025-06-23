@extends('layouts.member')

{{-- Menggunakan $menu->title untuk judul halaman --}}
@section('title', $menu->title)

@push('styles')
<style>
    .menu-content h1, .menu-content h2, .menu-content h3 {
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }
    .menu-content p {
        line-height: 1.8;
        margin-bottom: 1.25rem;
    }
    .menu-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }
    .menu-feature-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 0.75rem;
    }
    .nutrition-detail-card {
        background-color: #f8f9fa; /* Light background for detail card */
        border: 1px solid #e9ecef;
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    .nutrition-detail-card .row div {
        border-right: 1px solid #dee2e6; /* Separator between nutrition items */
    }
    .nutrition-detail-card .row div:last-child {
        border-right: none;
    }
    .nutrition-detail-card span {
        display: block;
        font-size: 0.9rem;
    }
    .nutrition-detail-card .fw-bold {
        font-size: 1.2rem;
        color: #333;
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <article>
                <div class="mb-4">
                    {{-- Menggunakan route 'member.menus.index' --}}
                    <a href="{{ route('member.menus.index') }}" class="btn btn-outline-secondary rounded-pill">
                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Menu
                    </a>
                </div>

                @if ($menu->photo)
                    <img src="{{ asset('storage/' . $menu->photo) }}" class="img-fluid mb-4 menu-feature-image" alt="{{ $menu->title }}">
                @endif

                <h1 class="display-5 fw-bold mb-3">{{ $menu->title }}</h1>

                <p class="text-muted">
                    <i class="bi bi-tag-fill me-2"></i>Tipe: {{ ucfirst($menu->meal_type) }}
                </p>

                <p class="text-muted">
                    <i class="bi bi-fire me-2"></i>Kalori: {{ number_format($menu->calories) }}
                </p>

                <hr class="my-4">
<!-- 
                <div class="nutrition-detail-card text-center">
                    <h3 class="mb-3">Informasi Nutrisi Per Porsi</h3>
                    <div class="row">
                        {{-- Jika Anda memiliki perhitungan protein, karbo, lemak berdasarkan food_materials,
                             maka Anda bisa menampilkannya di sini setelah perhitungan di controller/model.
                             Untuk saat ini, saya hanya menampilkan Kalori yang ada di tabel menus.
                             Jika ingin menampilkan detail dari food_materials yang membentuk menu,
                             Anda perlu mengambil data itu dan mengolahnya di controller. --}}
                        {{-- Contoh placeholder jika ada data di masa depan --}}
                        {{--
                        <div class="col-md-4 col-sm-6 mb-3 mb-md-0">
                            <span class="fw-bold">{{ number_format($menu->total_protein ?? 0, 1) }}g</span>
                            <span>Protein</span>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-3 mb-sm-0">
                            <span class="fw-bold">{{ number_format($menu->total_carbs ?? 0, 1) }}g</span>
                            <span>Karbohidrat</span>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <span class="fw-bold">{{ number_format($menu->total_fat ?? 0, 1) }}g</span>
                            <span>Lemak</span>
                        </div>
                        --}}
                    </div>
                </div> -->

                <h3 class="mb-3">Deskripsi Menu</h3>
                <div class="menu-content fs-5 mb-4">
                    {!! nl2br(e($menu->description)) !!} {{-- Gunakan nl2br untuk baris baru dari textarea --}}
                </div>

                @if ($menu->recipe)
                    <h3 class="mb-3">Resep dan Cara Membuat</h3>
                    <div class="menu-content fs-5 mb-4">
                        {!! nl2br(e($menu->recipe)) !!} {{-- Gunakan nl2br untuk baris baru dari textarea --}}
                    </div>
                @else
                    <div class="alert alert-info" role="alert">
                        Resep untuk menu ini belum tersedia.
                    </div>
                @endif


            </article>

        </div>
    </div>
</div>
@endsection