<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — ELD Solutions CMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>

{{-- ===== Sidebar ===== --}}
<aside class="admin-sidebar">
    <div class="brand">
        <div class="d-flex align-items-center gap-2 mb-1">
            <span class="logo-square" style="font-size:13px">E</span>
            <span class="logo-square" style="font-size:13px">L</span>
            <span class="logo-square" style="font-size:13px">D</span>
        </div>
        <p class="brand-title mt-2 mb-0">ELD Solutions</p>
        <span class="brand-sub">ADMIN PANEL</span>
    </div>

    <nav class="mt-2">
        <a href="{{ route('admin.dashboard') }}"
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="nav-section">Content</div>

        <a href="{{ route('admin.hero.edit') }}"
           class="nav-link {{ request()->routeIs('admin.hero*') ? 'active' : '' }}">
            <i class="bi bi-image"></i> Hero Section
        </a>
        <a href="{{ route('admin.about.edit') }}"
           class="nav-link {{ request()->routeIs('admin.about*') ? 'active' : '' }}">
            <i class="bi bi-info-circle"></i> About Section
        </a>
        <a href="{{ route('admin.services.index') }}"
           class="nav-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}">
            <i class="bi bi-grid-3x3-gap"></i> Services
        </a>
        <a href="{{ route('admin.team.index') }}"
           class="nav-link {{ request()->routeIs('admin.team*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Team
        </a>
        <a href="{{ route('admin.clients.index') }}"
           class="nav-link {{ request()->routeIs('admin.clients*') ? 'active' : '' }}">
            <i class="bi bi-building-check"></i> Clients
        </a>

        <div class="nav-section">Enquiries</div>

        <a href="{{ route('admin.messages.index') }}"
           class="nav-link {{ request()->routeIs('admin.messages*') ? 'active' : '' }}">
            <i class="bi bi-envelope"></i> Messages
            @php $unread = \App\Models\ContactMessage::unread()->count(); @endphp
            @if($unread > 0)
            <span class="badge-unread ms-auto">{{ $unread }}</span>
            @endif
        </a>

        <div class="nav-section">System</div>

        <a href="{{ route('admin.settings.edit') }}"
           class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i> Settings
        </a>
        <a href="{{ route('home') }}" class="nav-link" target="_blank">
            <i class="bi bi-box-arrow-up-right"></i> View Website
        </a>

        <div class="mt-4 mb-2 px-3">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm w-100 text-start nav-link border-0 p-0"
                        style="background:transparent;cursor:pointer;">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </button>
            </form>
        </div>
    </nav>
</aside>

{{-- ===== Main Content ===== --}}
<div class="admin-main">

    {{-- Top Bar --}}
    <div class="admin-topbar">
        <div class="d-flex align-items-center gap-3">
            <button id="sidebarToggle" class="btn btn-sm d-lg-none border-0">
                <i class="bi bi-list fs-4"></i>
            </button>
            <h6 class="mb-0 fw-700" style="color:#222">@yield('page-title', 'Dashboard')</h6>
        </div>
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-person-circle fs-5" style="color:#3DBDA0"></i>
            <small class="fw-semibold" style="color:#555">{{ auth()->user()->name ?? 'Admin' }}</small>
        </div>
    </div>

    {{-- Flash messages --}}
    <div class="px-4 pt-3">
        @if(session('success'))
        <div class="alert-eld alert auto-dismiss p-3 px-4">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger auto-dismiss">{{ session('error') }}</div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger auto-dismiss">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif
    </div>

    <div class="admin-content">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
