<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyNutriPlan Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
    <link href="{{ asset('style/global.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}"> {{-- Menggunakan route() --}}
                <img src="/images/logo.png" alt="Logo MyNutriPlan" class="img-fluid" style="height: 50px; width: 50px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a> {{-- Menggunakan route() --}}
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">User Management</a> {{-- Menggunakan route() --}}
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.food-materials*') ? 'active' : '' }}" href="{{ route('admin.food-materials.index') }}">Food Material Management</a> {{-- Menggunakan route() --}}
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.menus*') ? 'active' : '' }}" href="{{ route('admin.menus.index') }}">Menu Management</a> {{-- Menggunakan route() --}}
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.articles*') ? 'active' : '' }}" href="{{ route('admin.articles.index') }}">Article Management</a> {{-- Menggunakan route() --}}
                    </li>
                </ul>
                <div class="btn btn-danger rounded-pill">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="container" style="padding-top: 5rem;">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show  mt-5" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        @yield('content')
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    @stack('scripts')
</body>
</html>