<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ELD Solutions Ltd') — Delivering Excellence Across Every Project</title>
    <meta name="description" content="@yield('meta_description', 'ELD Solutions Ltd is a Ghanaian professional project management company delivering Supply Chain, Construction, Consultancy, and Agriculture services.')">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    {{-- App CSS (compiled by Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body>

{{-- ===== Navigation ===== --}}
<nav id="mainNav" class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <span class="logo-square">E</span>
            <span class="logo-square">L</span>
            <span class="logo-square">D</span>
            <div class="ms-2">
                <div style="font-weight:700;font-size:.95rem;line-height:1">ELD</div>
                <div style="font-size:.62rem;letter-spacing:3px;color:#3DBDA0">SOLUTIONS</div>
            </div>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#hero">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="#team">Team</a></li>
                <li class="nav-item"><a class="nav-link" href="#clients">Partnerships</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

{{-- ===== Flash Messages ===== --}}
@if(session('success'))
<div class="alert-eld alert auto-dismiss p-3 px-4 mb-0" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible auto-dismiss mb-0" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- ===== Main Content ===== --}}
@yield('content')

{{-- ===== Footer ===== --}}
<footer>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-3 mb-md-0">
                <p class="mb-0">
                    &copy; {{ date('Y') }} <strong style="color:#fff">ELD Solutions Ltd</strong>.
                    {{ $settings['footer_text'] ?? 'All rights reserved.' }}
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                @if(!empty($settings['linkedin']))
                <a href="{{ $settings['linkedin'] }}" class="social-link" target="_blank" rel="noopener" title="LinkedIn">
                    <i class="bi bi-linkedin"></i>
                </a>
                @endif
                @if(!empty($settings['twitter']))
                <a href="{{ $settings['twitter'] }}" class="social-link" target="_blank" rel="noopener" title="Twitter">
                    <i class="bi bi-twitter-x"></i>
                </a>
                @endif
                @if(!empty($settings['facebook']))
                <a href="{{ $settings['facebook'] }}" class="social-link" target="_blank" rel="noopener" title="Facebook">
                    <i class="bi bi-facebook"></i>
                </a>
                @endif
            </div>
        </div>
    </div>
</footer>

{{-- Scroll to Top --}}
<button id="scrollTop" title="Back to top"><i class="bi bi-arrow-up"></i></button>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
</body>
</html>
