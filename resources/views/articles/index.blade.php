{{-- Mengasumsikan layout utama Anda bernama 'layouts.app' --}}
@extends('layouts.member')

@section('title', 'Browse Articles')

@push('styles')
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
                <a href="{{ route('articles.show', $article) }}" style="color: #111; text-decoration: none;">
                    <img src="{{ $article->photo ? asset('storage/' . $article->photo) : 'https://placehold.co/600x400/a7e6a8/333333?text=No+Image' }}" class="card-img-top" alt="{{ $article->title }}">
                    <div class="card-body position-relative">
                        <h5 class="card-title fw-bold mb-2">{{ $article->title }}</h5>
                        <p class="card-text text-muted small mb-3">
                            <i class="bi bi-calendar-event"></i> Dipublikasikan pada: {{ $article->created_at->format('d F Y') }}
                        </p>
                        <p class="card-text">
                           {{-- Menampilkan kutipan konten, 120 karakter pertama --}}
                           {{ Str::limit(strip_tags($article->content), 120) }}
                        </p>
                    </div>
                </a>
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
