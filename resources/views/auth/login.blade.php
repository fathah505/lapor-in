<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Lapor.in</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #4fb3bf 0%, #2d5a7b 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .login-left {
            background: linear-gradient(135deg, #4fb3bf 0%, #2d5a7b 100%);
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        .logo-container {
            margin-bottom: 30px;
        }

        .logo-container h1 {
            font-size: 48px;
            font-weight: 700;
            color: white;
        }

        .welcome-text h2 {
            font-size: 32px;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .welcome-text p {
            font-size: 16px;
            line-height: 1.6;
            opacity: 0.9;
        }

        .login-right {
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            margin-bottom: 40px;
        }

        .login-header h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4fb3bf;
            background: white;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .forgot-password {
            color: #4fb3bf;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #2d5a7b;
        }

        .login-button {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #4fb3bf 0%, #2d5a7b 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79, 179, 191, 0.4);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .error-message {
            background: #fee;
            border: 1px solid #fcc;
            color: #c33;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .helper-text {
            margin-top: 15px;
            padding: 12px;
            background: #f0f9ff;
            border-left: 3px solid #4fb3bf;
            border-radius: 6px;
            font-size: 13px;
            color: #666;
        }

        .helper-text strong {
            color: #2d5a7b;
        }

        @media (max-width: 768px) {
            .login-container {
                grid-template-columns: 1fr;
            }

            .login-left {
                padding: 40px 30px;
            }

            .login-right {
                padding: 40px 30px;
            }

            .welcome-text h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <div class="logo-container">
                <h1> Lapor.in</h1>
            </div>
            <div class="welcome-text">
                <h2>Selamat Datang!</h2>
                <p>Sistem Pengaduan Sarana dan Prasarana Sekolah yang efektif dan efisien untuk mendukung lingkungan belajar yang lebih baik.</p>
            </div>
        </div>

        <div class="login-right">
            <div class="login-header">
                <h2>Masuk</h2>
                <p>Silakan login untuk melanjutkan</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="error-message">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="error-message">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Username / NIS -->
                <div class="form-group">
                    <label for="login">Username / NIS</label>
                    <input type="text" 
                           id="login" 
                           name="login" 
                           value="{{ old('login') }}"
                           placeholder="Masukkan Username (Admin) atau NIS (Siswa)" 
                           required 
                           autofocus>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           placeholder="Masukkan password" 
                           required>
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <span>Ingat Saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">Lupa Password?</a>
                    @endif
                </div>

                <button type="submit" class="login-button">Masuk</button>

            </form>
        </div>
    </div>
</body>
</html>