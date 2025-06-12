{{-- Mengasumsikan layout utama Anda bernama 'layouts.app' --}}
@extends('layouts.member')

@section('title', 'Browse Articles')

@push('styles')
<style>
    /* Style untuk memastikan card memiliki tinggi yang sama dan gambar terisi dengan baik */
    .card-img-top {
        width: 100%;
        height: 200px;
        object-fit: cover; /* Memastikan gambar tidak terdistorsi */
    }
    .card {
        display: flex;
        flex-direction: column;
        height: 100%; /* Penting agar semua card dalam satu baris memiliki tinggi yang sama */
    }
    .card-body {
        flex-grow: 1; /* Memastikan body card mengisi ruang yang tersisa */
        display: flex;
        flex-direction: column;
    }
    .card-text {
        flex-grow: 1; /* Memastikan paragraf mengisi ruang sebelum tombol */
    }
    /* Helper agar tautan di judul membuat seluruh card bisa diklik */
    .card-title a.stretched-link::after {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1;
        pointer-events: auto;
        background-color: rgba(0,0,0,0);
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold">Latest Health Articles</h2>
        <p class="lead text-muted">Temukan informasi dan tips terbaru seputar gizi dan kesehatan.</p>
    </div>
    
    <div class="row g-4">
        {{-- Loop melalui setiap artikel dari controller --}}
        @forelse ($articles as $article)
         <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                <img src="{{ $article->photo ? asset('storage/' . $article->photo) : 'https://placehold.co/600x400/a7e6a8/333333?text=No+Image' }}" class="card-img-top" alt="{{ $article->title }}">
                <div class="card-body position-relative">
                    <h5 class="card-title fw-bold mb-2">
                       <a href="{{ route('articles.show', $article) }}" class="text-decoration-none text-dark stretched-link">{{ $article->title }}</a>
                    </h5>
                    <p class="card-text text-muted small mb-3">
                        <i class="bi bi-calendar-event"></i> Dipublikasikan pada: {{ $article->created_at->format('d F Y') }}
                    </p>
                    <p class="card-text">
                       {{-- Menampilkan kutipan konten, 120 karakter pertama --}}
                       {{ Str::limit(strip_tags($article->content), 120) }}
                    </p>
                </div>
            </div>
        </div>
        @empty
            {{-- Tampilan jika tidak ada artikel sama sekali --}}
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="card card-body bg-light border-0">
                        <p class="lead text-muted mb-0">Belum ada artikel yang dipublikasikan saat ini. Silakan kembali lagi nanti.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Tampilkan Komponen Paginasi hanya jika diperlukan -->
    @if ($articles->hasPages())
        <div class="mt-5 pt-4 d-flex justify-content-center">
            {{ $articles->links() }}
        </div>
    @endif
</div>
@endsection
