@extends('layouts.admin')
@section('title', 'Article Management')

@section('content')
<section class="py-10">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Article Management</h2>
            <a href="{{ route('admin.articles.create') }}" class="btn btn-success rounded-pill">Tambah Artikel</a>
        </div>
        <div class="table-responsive">
            <table id="articleTable" class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Photo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td>{{ $article->id }}</td>
                            <td>{{ $article->title }}</td>
                            <td>
                                @if($article->photo)
                                    <img src="{{ asset('storage/' . $article->photo) }}" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                                @else
                                    <span>No Photo</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-sm btn-warning rounded-pill">Edit</a>
                                <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
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
<script>
    $(document).ready( function () {
        $('#articleTable').DataTable({
            "language": {
                "emptyTable": "Belum ada data artikel."
            }
        });
    } );
</script>
@endpush
