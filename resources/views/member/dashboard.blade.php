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
    
    {{-- Kartu Statistik Profil Pengguna --}}
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

    {{-- Kartu Kebutuhan Gizi Harian --}}
    @if($user->weight && $user->height && $user->age && $user->activity_level)
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <h4 class="card-title mb-4">Ringkasan Kebutuhan Gizi Harian Anda</h4>
                    <div class="row text-center my-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="p-3 bg-light rounded-4 h-100">
                                <h6 class="text-muted">Metabolisme Basal (BMR)</h6>
                                <p class="fs-4 fw-bold mb-0">{{ number_format($bmr, 0) }}</p>
                                <small>Kalori/hari</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-primary bg-opacity-10 rounded-4 h-100">
                                <h6 class="text-primary">Target Kalori Harian (TDEE)</h6>
                                <p class="fs-4 fw-bold text-primary mb-0">{{ number_format($tdee, 0) }}</p>
                                <small class="text-primary">Kalori/hari</small>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted small text-center mb-0">*Perhitungan ini menggunakan rumus Harris-Benedict dan merupakan sebuah estimasi. Kebutuhan aktual dapat bervariasi.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
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
                        <h6 class="card-subtitle mb-3 text-muted">Estimasi: {{ number_format($tdee * 0.30, 0) }} Kalori</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Oatmeal dengan topping pisang & kacang almond.</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>2 butir Telur Rebus.</li>
                        </ul>
                        <p class="card-text small text-muted mt-3">Kombinasi serat tinggi dari oatmeal dan protein dari telur akan memberikan energi yang stabil untuk memulai aktivitas Anda.</p>
                    </div>
                </div>
            </div>

            {{-- Makan Siang --}}
            <div class="col-lg-4 d-flex">
                <div class="card shadow-sm rounded-4 w-100">
                    <div class="card-body">
                        <h5 class="card-title d-flex align-items-center"><i class="bi bi-sun fs-4 me-2 text-warning"></i> <strong>Makan Siang</strong></h5>
                        <h6 class="card-subtitle mb-3 text-muted">Estimasi: {{ number_format($tdee * 0.40, 0) }} Kalori</h6>
                        <ul class="list-unstyled">
                             <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Nasi Merah (1 porsi).</li>
                             <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Dada Ayam Bakar tanpa kulit.</li>
                             <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Tumis Brokoli dan Wortel.</li>
                             <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Tempe Bacem.</li>
                        </ul>
                        <p class="card-text small text-muted mt-3">Menu lengkap dengan karbohidrat kompleks, protein tanpa lemak, serta vitamin dan mineral dari sayuran untuk menjaga produktivitas.</p>
                    </div>
                </div>
            </div>

            {{-- Makan Malam --}}
            <div class="col-lg-4 d-flex">
                <div class="card shadow-sm rounded-4 w-100">
                    <div class="card-body">
                        <h5 class="card-title d-flex align-items-center"><i class="bi bi-moon-stars fs-4 me-2 text-info"></i> <strong>Makan Malam</strong></h5>
                        <h6 class="card-subtitle mb-3 text-muted">Estimasi: {{ number_format($tdee * 0.30, 0) }} Kalori</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Ikan Kembung Kukus bumbu kuning.</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Sayur Bening Bayam dengan Jagung.</li>
                             <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Tahu Putih Kukus.</li>
                        </ul>
                         <p class="card-text small text-muted mt-3">Porsi makan malam yang lebih ringan, kaya akan Omega-3 dan mudah dicerna untuk mendukung proses pemulihan tubuh saat tidur.</p>
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
@endsection
