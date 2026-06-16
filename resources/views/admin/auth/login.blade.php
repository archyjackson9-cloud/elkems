<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — ELD Solutions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        body { background: #f0f4f8; min-height: 100vh; display: flex; align-items: center; font-family: 'Inter', sans-serif; }
        .login-card { max-width: 420px; width: 100%; margin: auto; background: #fff; border-radius: 14px; box-shadow: 0 8px 40px rgba(0,0,0,.1); overflow: hidden; }
        .login-header { background: #1a1a2e; padding: 36px 32px; text-align: center; }
        .login-body { padding: 36px 32px; }
        .btn-login { background: #3DBDA0; border: none; color: #fff; width: 100%; padding: 13px; border-radius: 6px; font-weight: 600; font-size: 1rem; transition: background .2s; }
        .btn-login:hover { background: #2fa88c; color: #fff; }
        .form-control:focus { border-color: #3DBDA0; box-shadow: 0 0 0 .2rem rgba(61,189,160,.2); }
    </style>
</head>
<body>
<div class="container">
    <div class="login-card">
        <div class="login-header">
            <div class="d-flex justify-content-center gap-2 mb-3">
                <span class="logo-square" style="width:40px;height:40px;font-size:17px">E</span>
                <span class="logo-square" style="width:40px;height:40px;font-size:17px">L</span>
                <span class="logo-square" style="width:40px;height:40px;font-size:17px">D</span>
            </div>
            <h5 class="text-white fw-700 mb-1">ELD Solutions Ltd</h5>
            <small style="color:rgba(255,255,255,.6);letter-spacing:2px">ADMIN PANEL</small>
        </div>
        <div class="login-body">
            <h6 class="fw-700 mb-4" style="color:#222">Sign In to Continue</h6>

            @if($errors->any())
            <div class="alert alert-danger mb-3">{{ $errors->first() }}</div>
            @endif
            @if(session('success'))
            <div class="alert alert-success mb-3">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-600">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label fw-600 mb-0">Password</label>
                        <a href="{{ route('admin.password.request') }}"
                           style="color:#3DBDA0;font-size:.8rem;text-decoration:none;">
                            Forgot password?
                        </a>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" id="loginPassword"
                               class="form-control border-end-0" required>
                        <span class="input-group-text bg-light border-start-0"
                              style="cursor:pointer"
                              onclick="toggleLoginPw()">
                            <i id="loginPwIcon" class="bi bi-eye" style="color:#3DBDA0"></i>
                        </span>
                    </div>
                </div>
                <div class="mb-4 d-flex align-items-center gap-2">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input m-0">
                    <label for="remember" class="form-check-label small">Remember me</label>
                </div>
                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="{{ route('home') }}" style="color:#3DBDA0;font-size:.85rem;text-decoration:none;">
                    <i class="bi bi-arrow-left me-1"></i> Back to Website
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleLoginPw() {
        const f = document.getElementById('loginPassword');
        const i = document.getElementById('loginPwIcon');
        if (f.type === 'password') { f.type = 'text';     i.className = 'bi bi-eye-slash'; }
        else                       { f.type = 'password'; i.className = 'bi bi-eye'; }
        i.style.color = '#3DBDA0';
    }
</script>
</body>
</html>
