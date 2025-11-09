<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Test Site')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
        footer {
            background: linear-gradient(to right, rgba(255, 255, 255, 0.41), #e5ffbaff);
        }
    </style>
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light" style="background: linear-gradient(to right, #bcf3bcff, rgba(48, 238, 0, 0.42));">
        <div class="container">
            <a class="navbar-brand fw-bold text-success" href="{{ url('/') }}">Test Site</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                @if(Auth::check())
                    <ul class="navbar-nav align-items-center">

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}" 
                            href="{{ route('products.index') }}">
                                All Products
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('view') ? 'active' : '' }}" 
                            href="{{ route('view') }}">
                                All Employees
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('add') ? 'active' : '' }}" 
                            href="{{ route('add') }}">
                                Add Employee
                            </a>
                        </li>

                        <li class="nav-item d-flex align-items-center ms-3">                     
                            <span class="me-2">
                                Welcome <strong>{{ Auth::user()->name }}</strong>
                            </span>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                            </form>
                        </li>
                    </ul>
                @else
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" 
                            href="{{ route('login') }}">
                                Login
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('signup') ? 'active' : '' }}" 
                            href="{{ route('signup') }}">
                                Sign Up
                            </a>
                        </li>

                    </ul>
                @endif
            </div>
        </div>
    </nav>

    {{-- Main content --}}
    <main class="container my-4 flex-grow-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="text-center py-3 mt-auto fw-bold text-success">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Test Site. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
