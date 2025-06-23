<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MyNutriPlan</title>
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <!-- Custom CSS -->
        <link href="/css/global.css" rel="stylesheet">
    </head>
    <body>
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images/logo.png" alt="Logo MyNutriPlan" class="img-fluid" style="height: 50px; width: 50px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#articles">Articles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                    </ul>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary rounded-pill px-4 ms-3"> Dashboard </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4 ms-3"> Sign in </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary     rounded-pill px-4 ms-3"> Sign up </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>

        <!-- Home Section -->
        <section id="home" class="py-5 mt-5">
            <div class="container py-5">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h1 class="display-4 fw-bold mb-3">MyNutriPlan</h1>
                        <p class="lead mb-4">Your personalized nutrition partner for a healthier lifestyle. We provide customized meal plans, nutrition advice, and health tracking to help you achieve your wellness goals.</p>
                        <a class="btn btn-outline-secondary btn-lg rounded-pill px-4" href="https://medium.com/@sugiartha1000/mynutriplan-09a3518b6b5a">Learn More</a>
                    </div>
                    <div class="col-lg-6">
                        <div class="rounded-4 overflow-hidden"> <!-- shadow-lg -->
                            <img src="/images/home.jpg" alt="Nutrition Illustration" class="img-cover">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Us Section -->
        <section id="about" class="py-5 bg-light">
            <div class="container py-5">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold">About Us</h2>
                    <p class="lead">Meet the team behind MyNutriPlan</p>
                </div>
                <div class="row g-4">
                    <!-- Achievement 1 -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 rounded-4">
                            <div class="card-body text-center p-4">
                                <div class="p-3 mb-3">
                                    <i class="bi bi-trophy fs-1" style="color: #347c36;"></i>
                                </div>
                                <h3 class="h4 mb-3">Award Winning</h3>
                                <p>Recognized as the Best Nutrition App of 2025 by Health Tech Awards.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Achievement 2 -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 rounded-4">
                            <div class="card-body text-center p-4">
                                <div class="p-3 mb-3">
                                    <i class="bi bi-people fs-1" style="color: #347c36;"></i>
                                </div>
                                <h3 class="h4 mb-3">Expert Team</h3>
                                <p>Our team consists of certified nutritionists, developers, and health experts.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Achievement 3 -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 rounded-4">
                            <div class="card-body text-center p-4">
                                <div class="p-3 mb-3">
                                    <i class="bi bi-graph-up fs-1" style="color: #347c36;"></i>
                                </div>
                                <h3 class="h4 mb-3">Growing Community</h3>
                                <p>Over 100,000 users trust MyNutriPlan for their nutrition guidance.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Articles Section -->
        <section id="articles" class="py-5 bg-white">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold">Educational Articles</h2>
                    <p class="lead">Don't miss the articles!!!</p>
                </div>
                @if ($articles->isNotEmpty())
                    <div class="row g-4">
                        @foreach ($articles as $article)
                            <div class="col-md-4">
                                <div class="card h-100 border-0 shadow-sm rounded-4">
                                    @if ($article->photo)
                                        <img src="{{ asset('storage/' . $article->photo) }}" class="card-img-top rounded-top-4" alt="{{ $article->title }}">
                                    @else
                                        <img src="/images/article-placeholder.jpg" class="card-img-top rounded-top-4" alt="Article Image">
                                    @endif
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title fw-bold mb-2">
                                            <a href="{{ route('articles.show', $article) }}" class="text-decoration-none text-dark">
                                                {{ $article->title }}
                                            </a>
                                        </h5>
                                        <p class="card-text text-muted mb-3" style="font-size: 0.95rem;">
                                            {{ Str::limit(strip_tags($article->content), 100) }}
                                        </p>
                                        <div class="mt-auto d-flex justify-content-between align-items-center">
                                            <small class="text-secondary">
                                                <i class="bi bi-calendar-event"></i>
                                                {{ $article->created_at->format('d M Y') }}
                                            </small>
                                            <a href="{{ route('articles.show', $article) }}" class="btn btn-outline-secondary rounded-pill">
                                                Read More
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        No articles available at the moment.
                    </div>
                @endif
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-5 bg-light">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="display-5 fw-bold mb-4">Contact</h2>
                    <p class="lead mb-4">Have questions or feedback? We'd love to hear from you!</p>
                    <div class="d-flex align-items-center mb-3">
                        <div class="p-3 me-3">
                            <i class="bi bi-geo-alt" style="color: #347c36;"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Address</h5>
                            <p class="mb-0">C4PQ+G8W, Dasan Geria, Kec. Lingsar, Kabupaten Lombok Barat, Nusa Tenggara Bar.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="p-3 me-3">
                            <i class="bi bi-envelope" style="color: #347c36;"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Email</h5>
                            <p class="mb-0">sugiartha1000@gmail.com</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="p-3 me-3">
                            <i class="bi bi-telephone" style="color: #347c36;"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Phone</h5>
                            <p class="mb-0">+62 881 4825 700</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <h3 class="h4 mb-4">Send us a message</h3>
                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf {{-- Penting untuk keamanan Laravel --}}

                                <div class="mb-3">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" class="form-control rounded-pill @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control rounded-pill @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input type="text" class="form-control rounded-pill @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Enter subject" value="{{ old('subject') }}">
                                    @error('subject')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control rounded-4 @error('message') is-invalid @enderror" id="message" name="message" rows="4" placeholder="Enter your message" required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary rounded-pill px-4">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <h3 class="h5 mb-3">MyNutriPlan</h3>
                        <p>Your personalized nutrition partner for a healthier lifestyle. We provide customized meal plans, nutrition advice, and health tracking.</p>
                        <div class="d-flex gap-3 mt-4">
                            <a href="https://www.instagram.com/nantooou/" class="text-white"><i class="bi bi-instagram fs-5"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <h3 class="h5 mb-3">Quick Links</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#home" class="text-white text-decoration-none">Home</a></li>
                            <li class="mb-2"><a href="#about" class="text-white text-decoration-none">About Us</a></li>
                            <li class="mb-2"><a href="#articles" class="text-white text-decoration-none">Articles</a></li>
                            <li class="mb-2"><a href="#contact" class="text-white text-decoration-none">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <hr class="my-4">
                <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <p class="mb-0">© 2025 MyNutriPlan. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <!-- <a href="#" class="text-white text-decoration-none me-3">Privacy Policy</a>
                        <a href="#" class="text-white text-decoration-none">Terms of Service</a> -->
                        <p class="mb-0">Sign by MNPTeam</i></p> 
                    </div>
                </div>
            </div>
        </footer>

        <!-- @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif -->
        <!-- Bootstrap 5 JS Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Custom JS -->
        <script src="/js/script.js"></script>
    </body>
</html>
