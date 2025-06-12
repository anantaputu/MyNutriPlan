@extends('layouts.admin')
@section('title', 'Tambah Pengguna')
@section('content')
<div class="container py-10 mt-5">
    <h2 class="mb-4">Tambah Pengguna Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="row">
            {{-- Kolom Kiri: Informasi Akun --}}
            <div class="col-md-6">
                <h4>Informasi Akun</h4>
                <hr>
                <div class="mb-3">
                    <label for="fullname" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname') }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="member" {{ old('role') == 'member' ? 'selected' : '' }}>Member</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
            </div>

            {{-- Kolom Kanan: Informasi Profil & Kesehatan --}}
            <div class="col-md-6">
                <h4>Informasi Profil & Kesehatan</h4>
                <hr>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="age" class="form-label">Umur</label>
                        <input type="number" class="form-control" id="age" name="age" value="{{ old('age') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="" disabled selected>Pilih Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="height" class="form-label">Tinggi Badan (cm)</label>
                        <input type="number" step="0.1" class="form-control" id="height" name="height" value="{{ old('height') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="weight" class="form-label">Berat Badan (kg)</label>
                        <input type="number" step="0.1" class="form-control" id="weight" name="weight" value="{{ old('weight') }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="activity_level" class="form-label">Tingkat Aktivitas Fisik</label>
                    <select class="form-select" id="activity_level" name="activity_level" required>
                        <option value="" disabled selected>Pilih Tingkat Aktivitas</option>
                        <option value="Sedentary" {{ old('activity_level') == 'Sedentary' ? 'selected' : '' }}>Sedentary</option>
                        <option value="Lightly active" {{ old('activity_level') == 'Lightly active' ? 'selected' : '' }}>Lightly active</option>
                        <option value="Moderately active" {{ old('activity_level') == 'Moderately active' ? 'selected' : '' }}>Moderately active</option>
                        <option value="Very active" {{ old('activity_level') == 'Very active' ? 'selected' : '' }}>Very active</option>
                        <option value="Extra active" {{ old('activity_level') == 'Extra active' ? 'selected' : '' }}>Extra active</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="medical_history" class="form-label">Riwayat Medis</label>
                    <input type="text" class="form-control" id="medical_history" name="medical_history" value="{{ old('medical_history') }}" placeholder="Contoh: diabetes, hipertensi, atau kosongkan">
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Simpan Pengguna</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection