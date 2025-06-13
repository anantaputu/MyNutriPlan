@extends('layouts.member')
@section('title', 'My Dashboard')

@section('content')
<div class="container py-4">
    {{-- Alert untuk notifikasi update profil --}}
    @if (session('status') === 'profile-updated')
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        Profil berhasil diperbarui!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Selamat Datang, {{ $user->fullname }}!</h2>
        {{-- Tombol Aksi Utama --}}
        <div>
            <a href="{{ route('member.foodMaterials.index') }}" class="btn btn-outline-primary me-2">
                <i class="bi bi-egg-fried me-1"></i> Kelola Bahan Makanan
            </a>
            <a href="{{ route('member.menus.index') }}" class="btn btn-primary">
                <i class="bi bi-magic me-1"></i> Pilih Menu
            </a>
        </div>
    </div>
    
    {{-- Kartu Statistik Profil Pengguna (tetap 4 kolom) --}}
    <div class="row g-3">
        <div class="col-md-3">
            <div class="card shadow-sm rounded-4 text-center p-3 h-100">
                <h5>Berat Badan</h5>
                <p class="fs-4 fw-bold mb-0">{{ $user->weight ?? 'Belum diisi' }} {{ $user->weight ? 'kg' : '' }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm rounded-4 text-center p-3 h-100">
                <h5>Tinggi Badan</h5>
                <p class="fs-4 fw-bold mb-0">{{ $user->height ?? 'Belum diisi' }} {{ $user->height ? 'cm' : '' }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm rounded-4 text-center p-3 h-100">
                <h5>Usia</h5>
                <p class="fs-4 fw-bold mb-0">{{ $user->age ?? 'Belum diisi' }} {{ $user->age ? 'tahun' : '' }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm rounded-4 text-center p-3 h-100">
                <h5>Tingkat Aktivitas</h5>
                <p class="fs-5 fw-bold mb-0" style="margin-top: 0.5rem;">
                    {{ $user->activity_level ? Str::title(str_replace('_', ' ', $user->activity_level)) : 'Belum diisi' }}
                </p>
            </div>
        </div>
    </div>

    @if($user->weight && $user->height && $user->age && $user->activity_level && isset($recommendations))
    <div class="row mt-4 g-4"> {{-- Menggunakan g-4 untuk gap antar kolom --}}
        {{-- Kolom Kiri: BMR & TDEE --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4 d-flex flex-column">
                    <h4 class="card-title mb-4">Ringkasan Kebutuhan Gizi Harian Anda</h4>
                    
                    <div class="mb-3"> {{-- Card untuk BMR --}}
                        <div class="p-3 bg-light rounded-4">
                            <h6 class="text-muted">Metabolisme Basal (BMR)</h6>
                            <p class="fs-4 fw-bold mb-0">{{ number_format($bmr, 0) }}</p>
                            <small>Kalori/hari</small>
                        </div>
                    </div>
                    
                    <div class="flex-grow-1"> {{-- Card untuk TDEE --}}
                        <div class="p-3 bg-primary bg-opacity-10 rounded-4">
                            <h6 class="text-primary">Target Kalori Harian (TDEE)</h6>
                            <p class="fs-4 fw-bold text-primary mb-0">{{ number_format($tdee, 0) }}</p>
                            <small class="text-primary">Kalori/hari</small>
                        </div>
                    </div>
                    
                    <p class="text-muted small text-center mt-3 mb-0">*Perhitungan ini menggunakan rumus Harris-Benedict dan merupakan sebuah estimasi. Kebutuhan aktual dapat bervariasi.</p>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Jelajahi Artikel (dengan slideshow otomatis) --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4 d-flex flex-column">
                    <h4 class="card-title mb-4">Jelajahi Artikel Gizi</h4>
                    <div id="articles-carousel-container" style="position: relative; height: 250px; overflow: hidden; margin-bottom: 1rem;">
                        @forelse($articles as $article)
                            <a href="{{ route('articles.show', $article->slug) }}" class="articles-carousel-item text-decoration-none text-dark" style="position: absolute; top: 0; left: 0; width: 100%; opacity: 0; transition: opacity 0.8s ease-in-out;">
                                <div class="card border-0 rounded-4 shadow-sm h-100">
                                    @if($article->photo)
                                        <img src="{{ asset('storage/' . $article->photo) }}" class="card-img-top rounded-top-4" alt="{{ $article->title }}" style="height: 120px; width: 100%; object-fit: cover;">
                                    @else
                                        <img src="[https://placehold.co/250x120/E0E0E0/666666?text=No+Image](https://placehold.co/250x120/E0E0E0/666666?text=No+Image)" class="card-img-top rounded-top-4" alt="Default Article Image" style="height: 120px; width: 100%; object-fit: cover;">
                                    @endif
                                    <div class="card-body p-3">
                                        <h6 class="card-title fw-bold mb-1">{{ $article->title }}</h6>
                                        <p class="card-text small text-muted mb-0" style="height: 40px; overflow: hidden;">{{ Str::limit(strip_tags($article->content), 50) }}</p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <p class="text-muted text-center w-100 position-absolute top-50 start-50 translate-middle">Belum ada artikel yang tersedia.</p>
                        @endforelse
                    </div>
                    <div class="d-flex justify-content-center mt-auto pt-3 border-top">
                        <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">Lihat Semua Artikel <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bagian Rekomendasi Rencana Makan Harian (Di Bawah Kedua Kolom) --}}
    <div class="mt-5"> {{-- Memberikan jarak dari bagian atas --}}
        <div class="text-center mb-4">
            <h2 class="fw-bold">Rekomendasi Rencana Makan Harian Untuk Anda</h2>
            <p class="lead text-muted">Dihasilkan berdasarkan profil dan target kalori Anda.</p>
        </div>

        <div class="row g-4">
            {{-- Sarapan --}}
            <div class="col-lg-4 d-flex">
                <div class="card shadow-sm rounded-4 w-100">
                    <div class="card-body">
                        <h5 class="card-title d-flex align-items-center"><i class="bi bi-cup-hot fs-4 me-2 text-primary"></i> <strong>Sarapan Pagi</strong></h5>
                        <h6 class="card-subtitle mb-3 text-muted">Estimasi: {{ number_format($recommendations['sarapan']['estimasi_kalori'] ?? ($tdee * 0.30), 0) }} Kalori</h6>
                        <ul class="list-unstyled">
                            @foreach ($recommendations['sarapan']['menu'] ?? [] as $item)
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>{{ $item }}</li>
                            @endforeach
                        </ul>
                        <p class="card-text small text-muted mt-3">{{ $recommendations['sarapan']['deskripsi'] ?? 'Rekomendasi sarapan Anda akan muncul di sini.' }}</p>
                    </div>
                </div>
            </div>

            {{-- Makan Siang --}}
            <div class="col-lg-4 d-flex">
                <div class="card shadow-sm rounded-4 w-100">
                    <div class="card-body">
                        <h5 class="card-title d-flex align-items-center"><i class="bi bi-sun fs-4 me-2 text-warning"></i> <strong>Makan Siang</strong></h5>
                        <h6 class="card-subtitle mb-3 text-muted">Estimasi: {{ number_format($recommendations['makan_siang']['estimasi_kalori'] ?? ($tdee * 0.40), 0) }} Kalori</h6>
                        <ul class="list-unstyled">
                            @foreach ($recommendations['makan_siang']['menu'] ?? [] as $item)
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>{{ $item }}</li>
                            @endforeach
                        </ul>
                        <p class="card-text small text-muted mt-3">{{ $recommendations['makan_siang']['deskripsi'] ?? 'Rekomendasi makan siang Anda akan muncul di sini.' }}</p>
                    </div>
                </div>
            </div>

            {{-- Makan Malam --}}
            <div class="col-lg-4 d-flex">
                <div class="card shadow-sm rounded-4 w-100">
                    <div class="card-body">
                        <h5 class="card-title d-flex align-items-center"><i class="bi bi-moon-stars fs-4 me-2 text-info"></i> <strong>Makan Malam</strong></h5>
                        <h6 class="card-subtitle mb-3 text-muted">Estimasi: {{ number_format($recommendations['makan_malam']['estimasi_kalori'] ?? ($tdee * 0.30), 0) }} Kalori</h6>
                        <ul class="list-unstyled">
                            @foreach ($recommendations['makan_malam']['menu'] ?? [] as $item)
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>{{ $item }}</li>
                            @endforeach
                        </ul>
                        <p class="card-text small text-muted mt-3">{{ $recommendations['makan_malam']['deskripsi'] ?? 'Rekomendasi makan malam Anda akan muncul di sini.' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-center text-muted small mt-4">*Ini adalah contoh rekomendasi. Sesuaikan dengan ketersediaan bahan makanan dan preferensi pribadi Anda.</p>
    </div>
    @else
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-warning rounded-4">
                <div class="card-body p-4 text-center">
                    <i class="bi bi-exclamation-triangle-fill text-warning fs-1 mb-3"></i>
                    <h4 class="card-title mb-3">Lengkapi Profil Anda</h4>
                    <p class="text-muted mb-4">Untuk mendapatkan rekomendasi gizi yang akurat, silakan lengkapi data profil Anda terlebih dahulu.</p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-warning rounded-pill px-4">
                        <i class="bi bi-person-gear me-2"></i>Lengkapi Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const carouselContainer = document.getElementById('articles-carousel-container');
    if (carouselContainer) {
        const carouselItems = carouselContainer.querySelectorAll('.articles-carousel-item');
        let currentArticleIndex = 0;
        const slideInterval = 5000; // Interval slide dalam milidetik (5 detik)

        function showArticle(index) {
            carouselItems.forEach((item, i) => {
                if (i === index) {
                    item.style.opacity = '1';
                    item.style.zIndex = '1'; // Bawa ke depan
                } else {
                    item.style.opacity = '0';
                    item.style.zIndex = '0'; // Kirim ke belakang
                }
            });
        }

        function nextArticle() {
            if (carouselItems.length === 0) return;

            currentArticleIndex++;
            if (currentArticleIndex >= carouselItems.length) {
                currentArticleIndex = 0; // Kembali ke awal jika sudah mencapai akhir
            }
            showArticle(currentArticleIndex);
        }

        if (carouselItems.length > 0) {
            showArticle(currentArticleIndex); // Tampilkan artikel pertama saat halaman dimuat
            setInterval(nextArticle, slideInterval); // Mulai slideshow otomatis
        } else {
            // Jika tidak ada artikel, pastikan pesan "Belum ada artikel" terlihat
            const noArticleMessage = carouselContainer.querySelector('.text-center.w-100');
            if (noArticleMessage) {
                noArticleMessage.style.opacity = '1';
                noArticleMessage.style.zIndex = '1';
            }
        }
    }
});
</script>
@endpush
@endsection