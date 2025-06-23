@extends('layouts.member')

@section('title', $article->title)

@push('styles')
<style>
    .article-content h1, .article-content h2, .article-content h3 {
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }
    .article-content p {
        line-height: 1.8;
        margin-bottom: 1.25rem;
    }
    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }
    .article-feature-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 0.75rem;
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <article>
                <!-- Tombol Kembali ke Daftar Artikel -->
                @auth
                    @if(auth()->user()->is_member)
                        <div class="mb-4">
                            <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary rounded-pill">
                                <i class="bi bi-arrow-left me-2"></i>Kembali ke Semua Artikel
                            </a>
                        </div>
                    @else
                        <div class="mb-4">
                            <a href="{{ route('welcome') }}" class="btn btn-outline-secondary rounded-pill">
                                <i class="bi bi-arrow-left me-2"></i>Kembali ke Halaman Utama
                            </a>
                        </div>
                    @endif
                @else
                    <div class="mb-4">
                        <a href="{{ route('welcome') }}" class="btn btn-outline-secondary rounded-pill">
                            <i class="bi bi-arrow-left me-2"></i>Kembali ke Halaman Utama
                        </a>
                    </div>
                @endauth

                <!-- Gambar Utama Artikel -->
                @if ($article->photo)
                    <img src="{{ asset('storage/' . $article->photo) }}" class="img-fluid mb-4 article-feature-image" alt="{{ $article->title }}">
                @endif
                
                <!-- Judul Artikel -->
                <h1 class="display-5 fw-bold mb-3">{{ $article->title }}</h1>

                <!-- Info Meta -->
                <p class="text-muted">
                    <i class="bi bi-calendar-event me-2"></i>Dipublikasikan pada {{ $article->created_at->format('d F Y') }}
                </p>
                
                <hr class="my-4">

                <!-- Konten Artikel -->
                <div class="article-content fs-5">
                    {{-- Menggunakan {!! !!} untuk merender HTML dari rich text editor --}}
                    {!! $article->content !!}
                </div>

            </article>

        </div>
    </div>
</div>
@endsection
