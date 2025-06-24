@extends('layouts.member')
@section('title', 'My Dashboard')

@push('styles')
@endpush

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Selamat Datang, {{ explode(' ', trim($user->fullname))[1] ?? $user->fullname }}</h1>
        {{-- Tombol Aksi Utama --}}
        <div>
            <a href="{{ route('member.foodMaterials.index') }}" class="btn btn-outline-success rounded-pill me-2 mb-2">
                <i class="bi bi-egg-fried me-1"></i> Kelola Bahan Makanan
            </a>
            <a href="{{ route('member.menus.index') }}" class="btn btn-success rounded-pill mb-2">
                <i class="bi bi-magic me-1"></i> Pilih Menu
            </a>
        </div>
    </div>

    {{-- Kartu Statistik Profil Pengguna --}}
    <div class="row g-3">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm rounded-4 text-center profile-stat-card h-100 d-flex flex-column align-items-center justify-content-center">
                <div class="card-body">
                    <div class="mb-2">
                        <img src="/images/Timbangan.png" alt="Weight Icon" style="width: 50px; height: 50px;">
                    </div>
                    <p class="mb-0 mt-4">Berat Badan</p>
                    <p class="fw-bold">{{ $user->weight }} kg</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm rounded-4 text-center profile-stat-card h-100 d-flex flex-column align-items-center justify-content-center">
                <div class="card-body">
                    <div class="mb-2">
                        <img src="/images/Tinggi.png" alt="Height Icon" style="width: 50px; height: 50px;">
                    </div>
                    <p class="mb-0 mt-4">Tinggi Badan</p>
                    <p class="fw-bold">{{ $user->height }} cm</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm rounded-4 text-center profile-stat-card h-100 d-flex flex-column align-items-center justify-content-center">
                <div class="card-body">
                    <div class="mb-2">
                        <img src="/images/Umur.png" alt="Age Icon" style="width: 50px; height: 50px;">
                    </div>
                    <p class="mb-0 mt-4">Usia</p>
                    <p class="fw-bold">{{ $user->age }} tahun</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm rounded-4 text-center profile-stat-card h-100 d-flex flex-column align-items-center justify-content-center">
                <div class="card-body">
                    <div class="mb-2">
                        <img src="/images/Aktifitas.png" alt="Activity Icon" style="width: 50px; height: 50px;">
                    </div>
                    <p class="mb-0 mt-4">Tingkat Aktivitas</p>
                    <p class="fw-bold">{{ Str::title(str_replace('_', ' ', $user->activity_level)) }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Kartu Kebutuhan Gizi Harian & Artikel Pilihan --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 rounded-4 h-100 nutrition-summary-card">
                        <div class="card-body p-4">
                            <h4 class="card-title mb-4 text-center">Ringkasan Kebutuhan Gizi Harian Anda</h4>
                            <div class="row text-left my-4">
                                <div class="col-12 mb-2" >
                                    <div class="bg-light rounded-4 py-5" style="background-image: url('/images/bmr.jpg'); background-size: cover; background-position: center; border-radius: 0.5rem;">
                                        <h6 class="text-muted ms-3">Metabolisme Basal (BMR)</h6>
                                        <p class="fs-4 fw-bold mb-0 ms-3">{{ number_format($bmr, 0) }}</p>
                                        <small class="ms-3">Kalori/hari</small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-success bg-opacity-10 rounded-4 py-5" style="background-image: url('/images/tdee.png'); background-size: cover; background-position: center; border-radius: 0.5rem;">
                                        <h6 class="text-success ms-3">Target Kalori Harian (TDEE)</h6>
                                        <p class="fs-4 fw-bold text-success mb-0 ms-3">{{ number_format($tdee, 0) }}</p>
                                        <small class="text-success ms-3">Kalori/hari</small>
                                    </div>
                                </div>
                            </div>
                            <p class="text-muted small text-center mb-0">*Perhitungan ini menggunakan rumus Mifflin-St Jeor dan merupakan sebuah estimasi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex flex-column">
                    <div class="card shadow-sm border-0 rounded-4 h-100 article-preview-card bg-white">
                        <div class="card-body d-flex flex-column">
                            <h4 class="card-title mb-4 text-center">Artikel Pilihan Untuk Anda</h4>
                            @if ($featuredArticles->isNotEmpty())
                                <div id="featuredArticlesCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($featuredArticles->take(5) as $index => $article)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <div class="card shadow-sm border-0 article-preview-card flex-grow-1 mb-4 rounded-4" >
                                                    <img src="{{ $article->photo ? asset('storage/' . $article->photo) : '/images/placeholder-article.jpg' }}"
                                                         class="card-img-top rounded-top-4"
                                                         alt="{{ $article->title }}"
                                                         style="border-bottom-left-radius: 0 !important; border-bottom-right-radius: 0 !important; height: 300px;">
                                                    <div class="card-body rounded-4">
                                                        <h5 class="card-title">{{ $article->title }}</h5>
                                                        <p class="card-text">{{ Str::limit($article->description, 120) }}</p>
                                                        {{-- <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-primary mt-auto">Baca Selengkapnya</a> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if($featuredArticles->count() > 1)
                                        <button class="carousel-control-prev" type="button" data-bs-target="#featuredArticlesCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#featuredArticlesCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    @endif
                                </div>
                                <div class="text-center mt-3">
                                    <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary rounded-pill">
                                        Lihat Artikel Lainnya <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            @else
                                <div class="alert alert-info text-center flex-grow-1 d-flex align-items-center justify-content-center mb-0">
                                    Belum ada artikel pilihan saat ini.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ====================================================== --}}
    {{-- BAGIAN REKOMENDASI MAKANAN YANG SUDAH DINAMIS --}}
    {{-- ====================================================== --}}
    <div class="mt-5">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Rekomendasi Rencana Makan Harian Untuk Anda</h2>
            <p class="lead text-muted">Dipilih dari menu sistem berdasarkan profil dan target kalori Anda.</p>
        </div>

        @if($error)
            <div class="alert alert-warning text-center">{{ $error }}</div>
        @elseif($mealPlan)
            <div class="row g-4">
                {{-- Loop untuk setiap jenis makan: breakfast, lunch, dinner --}}
                @foreach(['breakfast', 'lunch', 'dinner'] as $mealTypeKey)
                    @php
                        $meal = $mealPlan[$mealTypeKey];
                        $iconClass = '';
                        $iconColorClass = '';
                        $mealTitle = '';
                        $estimatedCalories = 0;

                        // Set ikon dan judul berdasarkan jenis makan
                        if ($mealTypeKey == 'breakfast') {
                            $iconClass = 'bi-cup-hot';
                            $iconColorClass = 'text-primary';
                            $mealTitle = 'Sarapan Pagi';
                            $estimatedCalories = $tdee * 0.30;
                        } elseif ($mealTypeKey == 'lunch') {
                            $iconClass = 'bi-sun';
                            $iconColorClass = 'text-warning';
                            $mealTitle = 'Makan Siang';
                            $estimatedCalories = $tdee * 0.40;
                        } elseif ($mealTypeKey == 'dinner') {
                            $iconClass = 'bi-moon-stars';
                            $iconColorClass = 'text-info';
                            $mealTitle = 'Makan Malam';
                            $estimatedCalories = $tdee * 0.30;
                        }
                    @endphp

                    <div class="col-lg-4 d-flex">
                        <div class="card shadow-sm rounded-4 w-100 dashboard-meal-card">
                            <div class="card-body">
                                <h5 class="card-title d-flex align-items-center mb-0">
                                    <i class="bi {{ $iconClass }} fs-4 me-2 {{ $iconColorClass }}"></i>
                                    <strong class="me-2">{{ $mealTitle }}</strong>
                                    {{-- Status indikator (Mirip icon di index menus) --}}
                                    @if (isset($meal['can_be_made']))
                                        @if ($meal['can_be_made'])
                                            <i class="bi bi-check-circle-fill status-icon status-available text-success" title="Bisa dibuat sepenuhnya"></i>
                                        @elseif (count($meal['missing_materials']) > 0)
                                            <i class="bi bi-exclamation-triangle-fill status-icon status-missing text-warning" title="Bahan kurang tersedia"></i>
                                        @else
                                            <i class="bi bi-question-circle-fill status-icon status-not-found text-danger" title="Tidak ada menu cocok ditemukan"></i>
                                        @endif
                                    @else
                                        {{-- Fallback jika properti status belum terdefinisi --}}
                                        <i class="bi bi-question-circle-fill status-icon status-not-found" title="Status ketersediaan tidak diketahui"></i>
                                    @endif
                                </h5>
                                <p class="estimated-calories">Estimasi: {{ number_format($estimatedCalories, 0) }} Kalori</p>

                                @if (!empty($meal['dishes']))
                                    <ul class="list-unstyled dish-list">
                                        @foreach($meal['dishes'] as $dish)
                                            <li class="mb-2">
                                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                {{ $dish }}
                                                @if (isset($meal['menu_slug']) && $meal['menu_slug'])
                                                    <a href="{{ route('member.menus.show', $meal['menu_slug']) }}" class="text-decoration-none small ms-2">(Lihat Resep)</a>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-muted fst-italic">Tidak ada rekomendasi menu untuk {{ strtolower($mealTitle) }}</p>
                                @endif

                                @if (isset($meal['can_be_made']) && !$meal['can_be_made'] && !empty($meal['missing_materials']))
                                    <p class="text-danger small mt-3 mb-1">Bahan yang kurang:</p>
                                    <ul class="missing-materials-list small text-danger" style="list-style: none; padding-left: 0;">
                                        @foreach($meal['missing_materials'] as $missing)
                                            <li><i class="bi bi-x-circle-fill me-1"></i>{{ $missing['name'] }} (Butuh: {{ $missing['needed'] }}g, Anda punya: {{ $missing['have'] }}g)</li>
                                        @endforeach
                                    </ul>
                                @endif

                                <p class="card-text small text-muted mt-3">{{ $meal['summary'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center">Tidak ada rekomendasi yang bisa ditampilkan saat ini.</div>
        @endif

        <p class="text-center text-muted small mt-4">*Ini adalah contoh rekomendasi. Sesuaikan dengan ketersediaan bahan makanan dan preferensi pribadi Anda.</p>
    </div>
</div>
@endsection