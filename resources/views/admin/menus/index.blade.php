@extends('layouts.admin')
@section('title', 'Menu Management')

@section('content')
<section id="menu-system" class="py-10">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Menu System Management</h2>
            {{-- Tombol ini sekarang menjadi link ke halaman pembuatan menu --}}
            <a href="{{ route('admin.menus.create') }}" class="btn btn-success rounded-pill">Tambah Menu</a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered overflow-hidden" id="menusTable">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Menu Title</th>
                        <th>Description</th>
                        <th>Photo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop untuk menampilkan data menu dari database --}}
                    @foreach ($menus as $menu)
                    <tr>
                        <td>{{ $menu->id }}</td>
                        <td>{{ $menu->title }}</td>
                        {{-- Menggunakan Str::limit untuk membatasi panjang deskripsi --}}
                        <td>{{ Str::limit($menu->description, 50) }}</td>
                        <td class="text-center">
                            @if($menu->photo)
                                {{-- Menampilkan foto dari storage --}}
                                <img src="{{ asset('storage/' . $menu->photo) }}" alt="{{ $menu->title }}" class="rounded-4 img-fluid" style="width: 100px; height: 100px; object-fit: cover;">
                            @else
                                <span>No Photo</span>
                            @endif
                        </td>
                        <td>
                            {{-- Tombol Edit sekarang menjadi link ke halaman edit --}}
                            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-sm btn-warning rounded-pill">Edit</a>
                            
                            {{-- Tombol Delete sekarang berada di dalam form untuk keamanan --}}
                            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus menu ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger rounded-pill">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection

@push('scripts')
{{-- Inisialisasi DataTable --}}
<script>
    $(document).ready(function () {
        $('#menusTable').DataTable({
            "language": {
                "emptyTable": "Belum ada data menu."
            }
        });
    });
</script>
@endpush
