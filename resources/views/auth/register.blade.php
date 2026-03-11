<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun Baru - Fakultas Teknik UIKA</title>
    {{-- Path CSS Anda --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* CSS untuk Latar Belakang Hijau Solid dan Kartu Bertekstur Tenun */

body {
    margin: 0;
    font-family: 'Palatino', serif; /* Menggunakan font serif untuk mencocokkan gaya header */
    box-sizing: border-box;
}

/* 1. Latar Belakang Hijau Tua Solid Tanpa Ornamen */
.registration-page {
    background-color: #0d2a1c; /* Latar belakang hijau tua solid, bersih */
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* 2. Kartu Krem Bertekstur Tenun */
.registration-card {
    background-color: #f3eee4; /* Latar belakang krem, bersih */
    /* Menambahkan tekstur garis tenun halus pada kartu.
       Anda memerlukan file gambar tekstur linen. */
    background-image: url('{{ asset("download.png") }}'); /* Ganti dengan path gambar tekstur linen Anda */
    background-repeat: repeat;
    background-size: auto;
    width: 90%;
    max-width: 420px;
    padding: 2rem;
    border: 1px solid #1a3325; /* Border tipis dark green */
    border-radius: 8px; /* Sudut sedikit membulat seperti kartu */
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    position: relative;
    box-sizing: border-box;
}

/* Header */
.card-header {
    display: flex;
    flex-direction: column; /* Mengubah susunan menjadi vertikal (atas-bawah) */
    align-items: center;    /* Memposisikan elemen di tengah secara horizontal */
    text-align: center;     /* Membuat teks rata tengah */
    margin-bottom: 1.5rem;
}

.uika-logo {
    width: 90px;           /* Ukuran logo diperbesar (Silakan ganti angkanya jika masih kurang besar, misal 100px atau 120px) */
    height: auto;          /* Tinggi menyesuaikan agar proporsional */
    margin-right: 0;       /* Menghapus jarak di kanan */
    margin-bottom: 1rem;   /* Memberi jarak antara logo dan teks di bawahnya */
}

.header-text-group {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.header-text {
    color: #1a3325; /* Teks dark green */
    line-height: 1.2;
}

.header-text.faculty {
    font-weight: bold; /* Dibuat sedikit lebih tebal agar tegas */
    font-size: 1.2rem; /* Ukuran teks sedikit diperbesar */
}

.header-text.university {
    font-size: 0.95rem;
}
/* Teks Utama */
.registration-title {
    color: #1a3325;
    font-size: 2rem;
    margin: 0 0 0.5rem;
    font-weight: normal;
}

.registration-description {
    color: #1a3325;
    font-size: 0.9rem;
    margin: 0 0 1.2rem;
}

/* Input Fields (dengan label abu-abu dan border dark green) */
.input-group {
    position: relative;
    margin-bottom: 1rem;
}

.input-group input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid #1a3325; /* Border dark green */
    background-color: transparent;
    border-radius: 4px;
    color: #333;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1); /* Shadow halus untuk kedalaman input */
    box-sizing: border-box;
}

.input-group label {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #888; /* Label abu-abu */
    pointer-events: none;
    transition: all 0.3s ease;
    background-color: transparent;
}

.input-group input:focus,
.input-group input:not(:placeholder-shown) {
    border-color: #c19e71; /* Warna emas pada fokus */
}

.input-group input:focus + label,
.input-group input:not(:placeholder-shown) + label {
    top: 0;
    font-size: 0.8rem;
    background-color: #f3eee4; /* Krem tenun */
    padding: 0 0.5rem;
    color: #1a3325; /* Dark green pada fokus */
}

/* Dropdown */
.dropdown-group {
    margin-bottom: 1rem;
}

.dropdown-label {
    display: block;
    color: #1a3325;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.dropdown-group select {
    width: 100%;
    padding: 0.8rem;
    border: 2px solid #1a3325;
    border-radius: 4px;
    background-color: transparent;
    color: #333;
    font-size: 1rem;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    appearance: none; /* Menghapus dropdown bawaan browser */
    background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="%231a3325" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"%3e%3cpolyline points="6 9 12 15 18 9"%3e%3c/polyline%3e%3c/svg%3e'); /* Ikon panah kustom */
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 1rem;
    box-sizing: border-box;
}

/* Footer (link dan tombol) */
.card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 1rem;
}

.login-link {
    color: #1a3325; /* Teks dark green */
    text-decoration: underline;
    font-size: 0.9rem;
}

.register-button {
    background-color: #121212; /* Tombol dark green/hitam solid */
    color: #c19e71; /* Teks emas */
    border: none;
    padding: 0.8rem 2rem;
    border-radius: 4px;
    font-weight: bold;
    font-size: 1rem;
    cursor: pointer;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2); /* Shadow tombol */
    transition: all 0.3s ease;
}

.register-button:hover {
    background-color: #222;
}
        /* CSS yang diberikan di bawah ini dapat dimasukkan ke dalam file CSS Anda,
           atau ditempatkan di sini dalam tag style ini. */
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
                    <div class="input-group">
                        <input type="text" name="name" id="name" placeholder=" " required>
                        <label for="name">Nama Lengkap</label>
                    </div>
                    <div class="input-group">
                        <input type="email" name="email" id="email" placeholder=" " required>
                        <label for="email">Email</label>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" id="password" placeholder=" " required>
                        <label for="password">Password</label>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder=" " required>
                        <label for="password_confirmation">Konfirmasi Password</label>
                    </div>

                          <div class="dropdown-group">
                            <label for="prodi_id" class="dropdown-label">PILIH PROGRAM STUDI</label>
                            <select name="prodi_id" id="prodi_id" required>
                                <option value="" disabled selected>-- Pilih Prodi --</option>
                                
                                {{-- Looping otomatis mengambil data dari database --}}
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