<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password — ELD Solutions Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        body { background: #f0f4f8; min-height: 100vh; display: flex; align-items: center; font-family: 'Inter', sans-serif; }
        .auth-card { max-width: 460px; width: 100%; margin: auto; background: #fff; border-radius: 14px; box-shadow: 0 8px 40px rgba(0,0,0,.1); overflow: hidden; }
        .auth-header { background: #1a1a2e; padding: 32px; text-align: center; }
        .auth-body { padding: 36px 32px; }
        .btn-eld-full { background: #3DBDA0; border: none; color: #fff; width: 100%; padding: 13px; border-radius: 6px; font-weight: 600; font-size: 1rem; transition: background .2s; }
        .btn-eld-full:hover { background: #2fa88c; color: #fff; }
        .form-control:focus { border-color: #3DBDA0; box-shadow: 0 0 0 .2rem rgba(61,189,160,.2); }
        .back-link { color: #3DBDA0; font-size: .875rem; text-decoration: none; }
        .back-link:hover { opacity: .8; color: #3DBDA0; }
        .strength-bar { height: 4px; border-radius: 2px; transition: width .3s, background .3s; }
        .toggle-pw { cursor: pointer; background: #f8f9fa; border-left: none; }
        .toggle-pw:hover { background: #e9ecef; }
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
            <h5 class="text-white fw-bold mb-1">Set New Password</h5>
            <small style="color:rgba(255,255,255,.6)">ELD Solutions Admin Panel</small>
        </div>

        {{-- Body --}}
        <div class="auth-body">

            @if($errors->any())
            <div class="alert alert-danger mb-4" style="font-size:.9rem">
                {{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('admin.password.update') }}" id="resetForm">
                @csrf

                {{-- Hidden fields --}}
                <input type="hidden" name="token" value="{{ $token }}">

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-envelope" style="color:#3DBDA0"></i>
                        </span>
                        <input type="email" name="email"
                               class="form-control border-start-0 ps-1 @error('email') is-invalid @enderror"
                               value="{{ old('email', $email) }}"
                               required readonly>
                    </div>
                    @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>

                {{-- New Password --}}
                <div class="mb-1">
                    <label class="form-label fw-semibold">New Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-lock" style="color:#3DBDA0"></i>
                        </span>
                        <input type="password" name="password" id="password"
                               class="form-control border-start-0 border-end-0 ps-1 @error('password') is-invalid @enderror"
                               placeholder="Min. 8 characters"
                               required autocomplete="new-password">
                        <span class="input-group-text toggle-pw" onclick="togglePw('password','icon-pw1')">
                            <i id="icon-pw1" class="bi bi-eye"></i>
                        </span>
                    </div>
                    @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>

                {{-- Strength indicator --}}
                <div class="mb-3 mt-1">
                    <div style="background:#eee;border-radius:2px;height:4px">
                        <div id="strengthBar" class="strength-bar" style="width:0%;background:#ccc"></div>
                    </div>
                    <small id="strengthLabel" class="text-muted" style="font-size:.75rem"></small>
                </div>

                {{-- Confirm Password --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Confirm New Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-lock-fill" style="color:#3DBDA0"></i>
                        </span>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="form-control border-start-0 border-end-0 ps-1"
                               placeholder="Repeat new password"
                               required autocomplete="new-password">
                        <span class="input-group-text toggle-pw" onclick="togglePw('password_confirmation','icon-pw2')">
                            <i id="icon-pw2" class="bi bi-eye"></i>
                        </span>
                    </div>
                    <small id="matchMsg" class="mt-1 d-block" style="font-size:.75rem"></small>
                </div>

                <button type="submit" class="btn-eld-full mb-3">
                    <i class="bi bi-shield-check me-2"></i> Reset Password
                </button>
            </form>

            <div class="text-center">
                <a href="{{ route('admin.login') }}" class="back-link">
                    <i class="bi bi-arrow-left me-1"></i> Back to Sign In
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    /* Toggle password visibility */
    function togglePw(fieldId, iconId) {
        const field = document.getElementById(fieldId);
        const icon  = document.getElementById(iconId);
        if (field.type === 'password') {
            field.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            field.type = 'password';
            icon.className = 'bi bi-eye';
        }
    }

    /* Password strength meter */
    const pwInput  = document.getElementById('password');
    const pwBar    = document.getElementById('strengthBar');
    const pwLabel  = document.getElementById('strengthLabel');
    const confInput = document.getElementById('password_confirmation');
    const matchMsg  = document.getElementById('matchMsg');

    pwInput.addEventListener('input', function () {
        const val = this.value;
        let score = 0;
        if (val.length >= 8)  score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        const levels = [
            { pct: '0%',   color: '#ccc',    label: '' },
            { pct: '25%',  color: '#ff4757', label: 'Weak' },
            { pct: '50%',  color: '#ffa502', label: 'Fair' },
            { pct: '75%',  color: '#eccc68', label: 'Good' },
            { pct: '100%', color: '#3DBDA0', label: 'Strong' },
        ];
        const lvl = levels[score];
        pwBar.style.width     = lvl.pct;
        pwBar.style.background = lvl.color;
        pwLabel.textContent   = lvl.label;
        pwLabel.style.color   = lvl.color;
        checkMatch();
    });

    confInput.addEventListener('input', checkMatch);

    function checkMatch() {
        if (!confInput.value) { matchMsg.textContent = ''; return; }
        if (pwInput.value === confInput.value) {
            matchMsg.textContent = '✓ Passwords match';
            matchMsg.style.color = '#3DBDA0';
        } else {
            matchMsg.textContent = '✗ Passwords do not match';
            matchMsg.style.color = '#ff4757';
        }
    }
</script>
</body>
</html>
