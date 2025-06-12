@extends('layouts.admin')
@section('title', 'Edit Artikel')

@section('content')
<div class="container py-10 mt-5 mb-5">
    <h2 class="mb-4">Edit Artikel: {{ $article->title }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card p-4">
            <div class="card-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $article->title) }}" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="10" required>{{ old('content', $article->content) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input class="form-control" type="file" id="photo" name="photo">
                    @if($article->photo)
                        <small class="form-text text-muted mt-2">Foto saat ini:</small>
                        <img src="{{ asset('storage/' . $article->photo) }}" class="img-thumbnail mt-2" style="width: 150px;">
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Update Artikel</button>
            <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
