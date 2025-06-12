@extends('layouts.member')

@section('title', 'Edit Profile')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Profile</h2>

    <div class="row gy-4">
        {{-- Kolom untuk Update Informasi Profil --}}
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    {{-- Meng-include file partial untuk form --}}
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        {{-- Kolom untuk Update Password --}}
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        {{-- Kolom untuk Hapus Akun --}}
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4 bg-light">
                <div class="card-body p-4 p-md-5">
                     @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
