@extends('layouts.admin')
@section('title', 'Tambah Artikel Baru')

@section('content')
<div class="container py-10 mt-5">
    <h2 class="mb-4">Tambah Artikel Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card p-4">
            <div class="card-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="10" required>{{ old('content') }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input class="form-control" type="file" id="photo" name="photo">
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Simpan Artikel</button>
            <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
