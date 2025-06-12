<section>
    <header>
        <h4>
            {{ __('Profile Information') }}
        </h4>
        <p class="text-muted">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    {{-- Form untuk mengirim ulang email verifikasi --}}
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

            {{-- Logika verifikasi email --}}
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

        {{-- Field Berat Badan --}}
        <div class="mb-3">
            <label for="weight" class="form-label">{{ __('Weight (kg)') }}</label>
            <input id="weight" name="weight" type="number" step="0.1" min="1" max="500" class="form-control rounded-pill" value="{{ old('weight', $user->weight) }}" required>
            @error('weight')
                <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        {{-- Field Tinggi Badan --}}
        <div class="mb-3">
            <label for="height" class="form-label">{{ __('Height (cm)') }}</label>
            <input id="height" name="height" type="number" step="0.1" min="50" max="300" class="form-control rounded-pill" value="{{ old('height', $user->height) }}" required>
            @error('height')
                <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Field Usia --}}
        <div class="mb-3">
            <label for="age" class="form-label">{{ __('Age (years)') }}</label>
            <input id="age" name="age" type="number" min="1" max="150" class="form-control rounded-pill" value="{{ old('age', $user->age) }}" required>
            @error('age')
                <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Field Tingkat Aktivitas --}}
        <div class="mb-3">
            <label for="activity_level" class="form-label">{{ __('Activity Level') }}</label>
            <select id="activity_level" name="activity_level" class="form-select rounded-pill" required>
                <option value="">{{ __('Select Activity Level') }}</option>
                <option value="sedentary" {{ old('activity_level', $user->activity_level) == 'sedentary' ? 'selected' : '' }}>
                    {{ __('Sedentary (Little to no exercise)') }}
                </option>
                <option value="lightly_active" {{ old('activity_level', $user->activity_level) == 'lightly_active' ? 'selected' : '' }}>
                    {{ __('Lightly Active (Light exercise 1-3 days/week)') }}
                </option>
                <option value="moderately_active" {{ old('activity_level', $user->activity_level) == 'moderately_active' ? 'selected' : '' }}>
                    {{ __('Moderately Active (Moderate exercise 3-5 days/week)') }}
                </option>
                <option value="very_active" {{ old('activity_level', $user->activity_level) == 'very_active' ? 'selected' : '' }}>
                    {{ __('Very Active (Hard exercise 6-7 days/week)') }}
                </option>
                <option value="extremely_active" {{ old('activity_level', $user->activity_level) == 'extremely_active' ? 'selected' : '' }}>
                    {{ __('Extremely Active (Very hard exercise, physical job)') }}
                </option>
            </select>
            @error('activity_level')
                <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- Medical History --}}
        <div class>
            <label for="medical_history" class="form-label">{{ __('Medical History') }}</label>
            <textarea id="medical_history" name="medical_history" class="form-control rounded-3" rows="3" placeholder="{{ __('Describe any medical conditions or allergies') }}">{{ old('medical_history', $user->medical_history) }}</textarea>
            @error('medical_history')
                <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror
        {{-- Area tombol dan pesan "Saved" --}}
        <div class="d-flex align-items-center gap-4 mt-3" >
            <button type="submit" class="btn btn-primary rounded-pill px-4">{{ __('Save') }}</button>
        
            {{-- Pesan 'Saved.' --}}
            @if (session('status') === 'profile-updated')
                <span class="text-success">{{ __('Saved.') }}</span>
            @endif
        </div>
    </form>
</section>
