@extends('layouts.member')
@section('title', 'Bahan Makanan Saya')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Bahan Makanan Saya</h2>
        <a href="{{ route('member.foodMaterials.create') }}" class="btn btn-success rounded-pill">Tambah Bahan Makanan</a>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Bahan</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($myMaterials as $material)
                    <tr>
                        <td>{{ $material->name }}</td>
                        <td>{{ $material->pivot->quantity }} {{ $material->pivot->unit }}</td>
                        <td>
                            <a href="{{ route('member.foodMaterials.edit', $material->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('member.foodMaterials.destroy', $material->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus bahan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">Anda belum memiliki bahan makanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
