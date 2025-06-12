<section>
    <header>
        {{-- Menggunakan kelas header Bootstrap --}}
        <h4>
            {{ __('Profile Information') }}
        </h4>
        <p class="text-muted">
            {{-- Mengubah field 'name' menjadi 'fullname' agar sesuai dengan database Anda --}}
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    {{-- Form untuk mengirim ulang email verifikasi (tidak perlu diubah) --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Form utama dengan kelas Bootstrap --}}
    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        {{-- Field Full Name --}}
        <div class="mb-3">
            <label for="fullname" class="form-label">{{ __('Full Name') }}</label>
            {{-- Menggunakan input biasa dengan kelas 'form-control' dan nama 'fullname' --}}
            <input id="fullname" name="fullname" type="text" class="form-control rounded-pill" value="{{ old('fullname', $user->fullname) }}" required autofocus autocomplete="name">
            @error('fullname')
                <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Field Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="form-control rounded-pill" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror

            {{-- Logika verifikasi email dengan gaya Bootstrap --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-muted">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline">{{ __('Click here to re-send the verification email.') }}</button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-success">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Area tombol dan pesan "Saved" --}}
        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="btn btn-primary rounded-pill px-4">{{ __('Save') }}</button>

            {{-- Pesan 'Saved.' sekarang menggunakan session biasa, menghilangkan Alpine.js --}}
            @if (session('status') === 'profile-updated')
                <span class="text-success">{{ __('Saved.') }}</span>
            @endif
        </div>
    </form>
</section>
