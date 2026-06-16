<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password — ELD Solutions Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        body { background: #f0f4f8; min-height: 100vh; display: flex; align-items: center; font-family: 'Inter', sans-serif; }
        .auth-card { max-width: 440px; width: 100%; margin: auto; background: #fff; border-radius: 14px; box-shadow: 0 8px 40px rgba(0,0,0,.1); overflow: hidden; }
        .auth-header { background: #1a1a2e; padding: 32px; text-align: center; }
        .auth-body { padding: 36px 32px; }
        .btn-eld-full { background: #3DBDA0; border: none; color: #fff; width: 100%; padding: 13px; border-radius: 6px; font-weight: 600; font-size: 1rem; transition: background .2s; }
        .btn-eld-full:hover { background: #2fa88c; color: #fff; }
        .form-control:focus { border-color: #3DBDA0; box-shadow: 0 0 0 .2rem rgba(61,189,160,.2); }
        .back-link { color: #3DBDA0; font-size: .875rem; text-decoration: none; }
        .back-link:hover { opacity: .8; color: #3DBDA0; }
        .info-box { background: #e8f8f5; border-left: 4px solid #3DBDA0; border-radius: 0 6px 6px 0; padding: 14px 16px; font-size: .88rem; color: #1a6651; margin-bottom: 24px; }
        .alert-success-eld { background: #e8f8f5; border-left: 4px solid #3DBDA0; border-radius: 0 6px 6px 0; padding: 14px 16px; font-size: .9rem; color: #1a6651; }
    </style>
</head>
<body>
<div class="container">
    <div class="auth-card">

        {{-- Header --}}
        <div class="auth-header">
            <div class="d-flex justify-content-center gap-2 mb-3">
                <span class="logo-square" style="width:38px;height:38px;font-size:15px">E</span>
                <span class="logo-square" style="width:38px;height:38px;font-size:15px">L</span>
                <span class="logo-square" style="width:38px;height:38px;font-size:15px">D</span>
            </div>
            <h5 class="text-white fw-bold mb-1">Forgot Password?</h5>
            <small style="color:rgba(255,255,255,.6)">ELD Solutions Admin Panel</small>
        </div>

        {{-- Body --}}
        <div class="auth-body">

            {{-- Success message --}}
            @if(session('success'))
            <div class="alert-success-eld mb-4">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
            </div>
            @endif

            {{-- Error --}}
            @if($errors->any())
            <div class="alert alert-danger mb-4" style="font-size:.9rem">
                {{ $errors->first() }}
            </div>
            @endif

            @if(!session('success'))
            <div class="info-box">
                <i class="bi bi-info-circle me-1"></i>
                Enter the email address linked to your admin account. We will send you a secure link to reset your password.
            </div>

            <form method="POST" action="{{ route('admin.password.email') }}">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-semibold">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-envelope" style="color:#3DBDA0"></i>
                        </span>
                        <input type="email" name="email"
                               class="form-control border-start-0 ps-1"
                               value="{{ old('email') }}"
                               placeholder="admin@eldsolutions.com"
                               required autofocus>
                    </div>
                </div>
                <button type="submit" class="btn-eld-full mb-3">
                    <i class="bi bi-send me-2"></i> Send Reset Link
                </button>
            </form>
            @endif

            <div class="text-center mt-2">
                <a href="{{ route('admin.login') }}" class="back-link">
                    <i class="bi bi-arrow-left me-1"></i> Back to Sign In
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
