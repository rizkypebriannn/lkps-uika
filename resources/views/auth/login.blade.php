<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Fakultas Teknik & Sains UIKA</title>
    
    <style>
        body {
            margin: 0;
            font-family: 'Palatino', serif;
            box-sizing: border-box;
        }

        /* Background Hijau Tua */
        .login-page {
            background-color: #0d2a1c; 
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Kartu Krem Proporsional */
        .login-card {
            background-color: #f3eee4;
            /* Hapus baris background-image di bawah jika Anda tidak punya file teksturnya */
            background-image: url('{{ asset("img/textured-linen.png") }}'); 
            background-repeat: repeat;
            background-size: auto;
            width: 90%;
            max-width: 420px; 
            padding: 2rem;
            border: 1px solid #1a3325;
            border-radius: 8px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            position: relative;
            box-sizing: border-box;
        }

        /* Header Logo Tengah */
        .card-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .uika-logo {
            width: 85px; 
            height: auto;
            margin-bottom: 0.8rem;
        }

        .header-text-group {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header-text {
            color: #1a3325;
            line-height: 1.2;
        }

        .header-text.faculty {
            font-weight: bold;
            font-size: 1.15rem;
        }

        .header-text.university {
            font-size: 0.9rem;
        }

        /* Judul Login */
        .login-title {
            color: #1a3325;
            font-size: 1.6rem;
            margin: 0 0 0.5rem;
            font-weight: normal;
            text-align: center;
        }

        .login-description {
            color: #1a3325;
            font-size: 0.9rem;
            margin: 0 0 1.5rem;
            text-align: center;
        }

        /* Kotak Input */
        .input-group {
            position: relative;
            margin-bottom: 1.2rem;
        }

        .input-group input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #1a3325;
            background-color: transparent;
            border-radius: 4px;
            color: #333;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        .input-group label {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            pointer-events: none;
            transition: all 0.3s ease;
            background-color: transparent;
        }

        .input-group input:focus,
        .input-group input:not(:placeholder-shown) {
            border-color: #c19e71;
        }

        .input-group input:focus + label,
        .input-group input:not(:placeholder-shown) + label {
            top: 0;
            font-size: 0.8rem;
            background-color: #f3eee4; 
            padding: 0 0.5rem;
            color: #1a3325;
        }

        /* Checkbox Ingat Saya */
        .remember-group {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .remember-group input[type="checkbox"] {
            margin-right: 0.5rem;
            accent-color: #1a3325; /* Warna hijau tua saat dicentang */
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .remember-group label {
            color: #1a3325;
            font-size: 0.9rem;
            cursor: pointer;
        }

        /* Bawah (Link & Tombol) */
        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .forgot-link {
            color: #1a3325;
            text-decoration: underline;
            font-size: 0.85rem;
        }

        .login-button {
            background-color: #121212;
            color: #c19e71;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 4px;
            font-weight: bold;
            font-size: 0.95rem;
            cursor: pointer;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .login-button:hover {
            background-color: #222;
        }
        
        /* Notifikasi Error Laravel */
        .text-red-600 { color: #dc2626; font-size: 0.85rem; margin-top: 0.25rem; display: block; }
    </style>
</head>
<body>
    <div class="login-page">
        <div class="login-card">
            
            <div class="card-header">
                <img src="{{ asset('LogoFTS.png') }}" alt="UIKA Logo" class="uika-logo">
                <div class="header-text-group">
                    <span class="header-text faculty">FAKULTAS TEKNIK & SAINS</span>
                    <span class="header-text university">UNIVERSITAS IBN KHALDUN BOGOR</span>
                </div>
            </div>

            <div class="card-body">
                <h1 class="login-title">Selamat Datang Kembali</h1>
                <p class="login-description">Silakan masuk ke akun Anda</p>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    
                    <div class="input-group">
                        <input type="email" name="email" id="email" placeholder=" " value="{{ old('email') }}" required autofocus>
                        <label for="email">Alamat Email</label>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                    </div>

                    <div class="input-group">
                        <input type="password" name="password" id="password" placeholder=" " required>
                        <label for="password">Password</label>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                    </div>

                    <div class="remember-group">
                        <input id="remember_me" type="checkbox" name="remember">
                        <label for="remember_me">Ingat saya</label>
                    </div>

                    <div class="card-footer">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                        @else
                            <span></span> @endif
                        <button type="submit" class="login-button">LOG IN</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</body>
</html>