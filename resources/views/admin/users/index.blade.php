@extends('layouts.admin')
@section('title', 'User Management')
@section('content')
<section id="users" class="py-10">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>User Management</h2>
            <a href="{{ route('admin.users.create') }}" class="btn btn-success rounded-pill">Tambah Pengguna</a>
        </div>

        <table class="table table-bordered overflow-hidden" id="myTable">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->fullname }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge bg-{{ $user->role === 'admin' ? 'primary' : 'secondary' }}">{{ ucfirst($user->role) }}</span></td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning rounded-pill">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger rounded-pill">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data pengguna.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
@push('scripts')
<script>
    $(document).ready(function() { $('#myTable').DataTable(); });
</script>
@endpush