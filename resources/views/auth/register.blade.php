<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun Baru - Fakultas Teknik UIKA</title>
    {{-- Path CSS Anda --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            margin: 0;
            font-family: 'Palatino', serif;
            box-sizing: border-box;
        }

        /* 1. Latar Belakang Hijau Tua Solid Tanpa Ornamen */
        .registration-page {
            background-color: #0d2a1c;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem; /* Tambahan agar tidak mentok layar di hp */
        }

        /* 2. Kartu Krem Bertekstur Tenun */
        .registration-card {
            background-color: #f3eee4;
            background-image: url('{{ asset("") }}');
            background-repeat: repeat;
            background-size: auto;
            width: 100%;
            max-width: 420px;
            padding: 1.5rem 2rem; /* Dikurangi dari 2rem agar lebih pendek */
            border: 1px solid #1a3325;
            border-radius: 8px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            box-sizing: border-box;
        }

        /* Header */
        .card-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 1rem; /* Dikurangi */
        }

        .uika-logo {
            width: 75px; /* Dikecilkan sedikit */
            height: auto;
            margin-bottom: 0.5rem; /* Dikurangi */
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
            font-size: 1.1rem; /* Dikecilkan sedikit */
        }

        .header-text.university {
            font-size: 0.85rem;
        }

        /* Teks Utama */
        .card-body {
            text-align: center; /* Rata tengah agar rapi */
        }

        .registration-title {
            color: #1a3325;
            font-size: 1.5rem; /* Dikecilkan dari 2rem */
            margin: 0 0 0.2rem;
        }

        .registration-description {
            color: #1a3325;
            font-size: 0.85rem;
            margin: 0 0 1rem;
        }

        /* Input Fields */
        .input-group {
            position: relative;
            margin-bottom: 0.8rem; /* Dikurangi dari 1rem */
        }

        .input-group input {
            width: 100%;
            padding: 0.6rem 1rem; /* Padding atas-bawah dikurangi */
            border: 2px solid #1a3325;
            background-color: transparent;
            border-radius: 4px;
            color: #333;
            font-size: 0.9rem;
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
            font-size: 0.75rem;
            background-color: #f3eee4;
            padding: 0 0.3rem;
            color: #1a3325;
        }

        /* Trik: Membagi dua kolom untuk password agar tidak memanjang ke bawah */
        .row-password {
            display: flex;
            gap: 10px;
            margin-bottom: 0.8rem;
        }
        .row-password .input-group {
            margin-bottom: 0;
            flex: 1;
        }

        /* Dropdown */
        .dropdown-group {
            margin-bottom: 1rem;
            text-align: left; /* Kembalikan ke kiri untuk label dropdown */
        }

        .dropdown-label {
            display: block;
            color: #1a3325;
            font-size: 0.8rem;
            margin-bottom: 0.3rem;
            font-weight: bold;
        }

        .dropdown-group select {
            width: 100%;
            padding: 0.6rem; /* Dikurangi dari 0.8rem */
            border: 2px solid #1a3325;
            border-radius: 4px;
            background-color: transparent;
            color: #333;
            font-size: 0.9rem;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            appearance: none;
            background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="%231a3325" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"%3e%3cpolyline points="6 9 12 15 18 9"%3e%3c/polyline%3e%3c/svg%3e');
            background-repeat: no-repeat;
            background-position: right 0.8rem center;
            background-size: 1rem;
            box-sizing: border-box;
        }

        /* Footer (link dan tombol) */
        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0.5rem; /* Dikurangi */
        }

        .login-link {
            color: #1a3325;
            text-decoration: underline;
            font-size: 0.85rem;
            font-weight: bold;
        }

        .register-button {
            background-color: #121212;
            color: #c19e71;
            border: none;
            padding: 0.6rem 1.5rem; /* Dikurangi dari 0.8rem 2rem */
            border-radius: 4px;
            font-weight: bold;
            font-size: 0.95rem;
            cursor: pointer;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .register-button:hover {
            background-color: #222;
        }
    </style>
</head>
<body>
    <div class="registration-page">
        <div class="registration-card">
            <div class="card-header">
                {{-- Ganti dengan path logo Anda --}}
                <img src="{{ asset('LogoFTS.png') }}" alt="UIKA Logo" class="uika-logo">
                <div class="header-text-group">
                    <span class="header-text faculty">FAKULTAS TEKNIK & SAINS</span>
                    <span class="header-text university">UNIVERSITAS IBN KHALDUN BOGOR</span>
                </div>
            </div>

            <div class="card-body">
                <h1 class="registration-title">Daftar Akun Baru</h1>
                <p class="registration-description">Silakan lengkapi data Prodi Anda</p>

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                        <div style="background-color: #ffcccc; color: #cc0000; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 0.85rem; text-align: left;">
                            <ul style="margin: 0; padding-left: 20px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="input-group">
                        <input type="text" name="name" id="name" placeholder=" " required>
                        <label for="name">Nama Lengkap</label>
                    </div>
                    
                    <div class="input-group">
                        <input type="email" name="email" id="email" placeholder=" " required>
                        <label for="email">Email</label>
                    </div>
                    
                    <div class="row-password">
                        <div class="input-group">
                            <input type="password" name="password" id="password" placeholder=" " required>
                            <label for="password">Password</label>
                        </div>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder=" " required>
                            <label for="password_confirmation">Konfirmasi</label>
                        </div>
                    </div>

                    <div class="dropdown-group">
                        <label for="prodi_id" class="dropdown-label">PILIH PROGRAM STUDI</label>
                        <select name="prodi_id" id="prodi_id" required>
                            <option value="" disabled selected>-- Pilih Prodi --</option>
                            @foreach($prodis as $prodi)
                                <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('login') }}" class="login-link">Sudah terdaftar?</a>
                        <button type="submit" class="register-button">REGISTER</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>