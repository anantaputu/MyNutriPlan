@extends('layouts.member')

@section('title', 'Pilih Menu Makanan')

@push('styles')
<style>
    .card-img-top {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .card {
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .card-text {
        flex-grow: 1;
    }
    .nutrition-info span {
        display: block;
        font-size: 0.85rem;
    }
    .nutrition-info .fw-bold {
        font-size: 1rem;
    }
    /* Style untuk ikon status */
    .menu-status-icon {
        font-size: 1.25rem; /* Ukuran ikon */
        vertical-align: middle;
        margin-left: 8px; /* Jarak dari judul */
    }
    .icon-available {
        color: green; /* Warna hijau untuk tersedia */
    }
    .icon-missing {
        color: orange; /* Warna oranye untuk bahan kurang */
    }
    .icon-unknown {
        color: gray; /* Warna abu-abu untuk tidak diketahui (misal belum login) */
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold">Pilihan Menu Sehat</h2>
        <p class="lead text-muted">Telusuri berbagai menu lezat dan bergizi yang telah kami siapkan.</p>
    </div>

    <div class="row g-4">
        {{-- Loop melalui setiap menu dari controller --}}
        @forelse ($menus as $menu)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                    <a href="{{ route('member.menus.show', $menu->slug) }}" style="color: #111; text-decoration: none;">
                        <img src="{{ $menu->photo ? asset('storage/' . $menu->photo) : 'https://placehold.co/600x400/a7e6a8/333333?text=Menu+Image' }}" class="card-img-top" alt="{{ $menu->title }}">
                        <div class="card-body position-relative d-flex flex-column">
                            <h5 class="card-title fw-bold mb-2">
                                {{ $menu->title }}
                                {{-- Tampilkan ikon berdasarkan status_ketersediaan --}}
                                @if (isset($menu->status_ketersediaan))
                                    @if ($menu->status_ketersediaan == 'bisa_dibuat')
                                        <i class="bi bi-check-circle-fill menu-status-icon icon-available" title="Bisa dibuat dengan bahan Anda"></i>
                                    @elseif ($menu->status_ketersediaan == 'bahan_kurang')
                                        <i class="bi bi-exclamation-triangle-fill menu-status-icon icon-missing" title="Bahan kurang tersedia"></i>
                                    @else {{-- 'tidak_login' atau 'unknown' --}}
                                        <i class="bi bi-question-circle-fill menu-status-icon icon-unknown" title="Hubungi Admin"></i>
                                    @endif
                                @endif
                            </h5>
                            <p class="card-text text-muted small mb-3">
                                <i class="bi bi-fire"></i> {{ number_format($menu->calories) }} Kalori
                            </p>
                            <p class="card-text">
                                {{ Str::limit(strip_tags($menu->description), 120) }}
                            </p>
                            <div class="mt-3">
                                <a href="{{ route('member.menus.show', $menu->slug) }}" class="btn btn-outline-secondary rounded-pill w-100">
                                    Lihat Resep <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @empty
            {{-- Tampilan jika tidak ada menu sama sekali --}}
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="card card-body bg-light border-0">
                        <p class="lead text-muted mb-0">Belum ada menu yang tersedia saat ini.</p>
                    </div>
                </div>
            </div>
        @endforelse

    @if ($menus->hasPages())
        <div class="mt-5 pt-4 d-flex justify-content-center">
            {{ $menus->links() }}
        </div>
    @endif
</div>
@endsection