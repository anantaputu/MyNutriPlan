<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Sign-up</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/css/global.css" rel="stylesheet">
    <link href="/css/background.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="bg-light">

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card border-0 shadow-sm rounded-4" style="width: 100%; max-width: 800px;">
            <div class="card-body p-4">
                <a href="{{ url('/') }}" class="btn btn-light rounded-pill px-3 mb-3 d-inline-flex align-items-center" style="position: absolute; left: 1.5rem; top: 1.5rem;">
                    <i class='bx bx-arrow-back' style="font-size: 1.2rem;"></i>
                    <span class="ms-2 d-none d-md-inline">Back</span>
                </a>                
                <h2 class="mb-4 text-center">Sign up</h2>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control rounded-pill @error('fullname') is-invalid @enderror"
                                id="fullname" name="fullname" value="{{ old('fullname') }}" placeholder="Enter your full name" required>
                            @error('fullname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control rounded-pill @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control rounded-pill @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Enter your password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control rounded-pill @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3 col-md-4">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control rounded-pill @error('age') is-invalid @enderror"
                                id="age" name="age" value="{{ old('age') }}" min="0" placeholder="Enter your age" required>
                            @error('age')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control rounded-pill @error('gender') is-invalid @enderror"
                                id="gender" name="gender" required>
                                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select your gender</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="medical" class="form-label">Medical History</label>
                            <input type="text" class="form-control rounded-pill @error('medical') is-invalid @enderror"
                                id="medical" name="medical" value="{{ old('medical') }}" placeholder="E.g., diabetes, hypertension, none">
                            @error('medical')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="weight" class="form-label">Weight (kg)</label>
                            <input type="number" class="form-control rounded-pill @error('weight') is-invalid @enderror"
                                id="weight" name="weight" value="{{ old('weight') }}" min="0" step="0.1" placeholder="Enter your weight" required>
                            @error('weight')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="height" class="form-label">Height (cm)</label>
                            <input type="number" class="form-control rounded-pill @error('height') is-invalid @enderror"
                                id="height" name="height" value="{{ old('height') }}" min="0" step="0.1" placeholder="Enter your height" required>
                            @error('height')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="activity" class="form-label">Physical Activity</label>
                            <select class="form-control rounded-pill @error('activity') is-invalid @enderror"
                                id="activity" name="activity" required>
                                <option value="" disabled {{ old('activity') ? '' : 'selected' }}>Select your activity level</option>
                                <option value="Sedentary" {{ old('activity') == 'Sedentary' ? 'selected' : '' }}>Sedentary</option>
                                <option value="Lightly active" {{ old('activity') == 'Lightly active' ? 'selected' : '' }}>Lightly active</option>
                                <option value="Moderately active" {{ old('activity') == 'Moderately active' ? 'selected' : '' }}>Moderately active</option>
                                <option value="Very active" {{ old('activity') == 'Very active' ? 'selected' : '' }}>Very active</option>
                                <option value="Extra active" {{ old('activity') == 'Extra active' ? 'selected' : '' }}>Extra active</option>
                            </select>
                            @error('activity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <p>Already have an account? Please <a href="{{ route('login') }}">sign in</a></p>
                    </div>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 position-absolute" style="right: 1.5rem; bottom: 1.5rem;">
                        Sign Up
                    </button>
                </form>
            </div>
        </div>
    </div>


    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="/js/script.js"></script>
</body>
</html>


<!-- PERBATASAN -->