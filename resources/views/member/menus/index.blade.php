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
         <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                {{-- Gunakan foto menu atau placeholder --}}
                <img src="{{ $menu->photo ? asset('storage/' . $menu->photo) : 'https://placehold.co/600x400/a7e6a8/333333?text=Menu+Image' }}" class="card-img-top" alt="{{ $menu->name }}">
                
                <div class="card-body">
                    <h2 class="card-title fw-bold mb-2">{{ $menu->name }}</h2>
                    <p class="card-text text-muted">
                       {{ Str::limit($menu->description, 100) }}
                    </p>
                    
                    {{-- Informasi Gizi --}}
                    <div class="row text-center mt-auto pt-3 border-top nutrition-info">
                        <div class="col">
                            <span class="fw-bold">{{ number_format($menu->calories) }}</span>
                            <span>Kalori</span>
                        </div>
                        <div class="col">
                            <span class="fw-bold">{{ number_format($menu->protein) }}g</span>
                            <span>Protein</span>
                        </div>
                        <div class="col">
                            <span class="fw-bold">{{ number_format($menu->carbs) }}g</span>
                            <span>Karbo</span>
                        </div>
                        <div class="col">
                             <span class="fw-bold">{{ number_format($menu->fat) }}g</span>
                            <span>Lemak</span>
                        </div>
                    </div>
                    {{-- Tombol Aksi --}}
                    <div class="mt-3">
                        <a href="{{ route('member.menus.show', $menu->id) }}" class="btn btn-primary w-100">
                            <i class="bi bi-info-circle me-1"></i> Lihat Resep
                        </a>
                </div>
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
    </div>

    <!-- Komponen Paginasi -->
    @if ($menus->hasPages())
        <div class="mt-5 pt-4 d-flex justify-content-center">
            {{ $menus->links() }}
        </div>
    @endif
</div>
@endsection
