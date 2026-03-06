<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tabel 3.a.1 Kurikulum - LKPS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .card-custom { border: none; border-radius: 1rem; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    </style>
</head>
<body class="pb-5">

    <div class="container mt-5">
        <a href="{{ url('/') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
        </a>

        <div class="mb-4">
            <h3 class="fw-bold m-0">Tabel 3.a.1 Kurikulum dan Rencana Pembelajaran</h3>
            <p class="text-muted">Pendataan sebaran mata kuliah, SKS, dan kelengkapan Dokumen RPS.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-custom p-4 mb-5">
            <h5 class="fw-bold mb-4 border-bottom pb-2">Form Tambah Mata Kuliah</h5>
            <form action="{{ route('kurikulum.store') }}" method="POST">
                @csrf
                <div class="row g-3 mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Semester</label>
                        <input type="number" name="semester" class="form-control" placeholder="Cth: 1" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Kode MK</label>
                        <input type="text" name="kode_mk" class="form-control" placeholder="Cth: TKE101" required>
                    </div>
                    <div class="col-md-7">
                        <label class="form-label fw-semibold">Nama Mata Kuliah</label>
                        <input type="text" name="nama_mk" class="form-control" required>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-primary">Bobot SKS</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Kuliah</span>
                            <input type="number" name="sks_kuliah" class="form-control" value="0">
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Seminar</span>
                            <input type="number" name="sks_seminar" class="form-control" value="0">
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">Praktikum</span>
                            <input type="number" name="sks_praktikum" class="form-control" value="0">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Kelengkapan Lain</label>
                        <input type="text" name="unit_penyelenggara" class="form-control mb-2" placeholder="Unit Penyelenggara (Cth: Prodi/Fakultas)">
                        <input type="url" name="dokumen_rps" class="form-control mb-3" placeholder="Link Dokumen RPS (Google Drive)">
                        
                        <div class="form-check form-switch fs-5 mt-2">
                            <input class="form-check-input" type="checkbox" name="is_mk_kompetensi" id="mkKompetensi" value="1">
                            <label class="form-check-label fs-6 mt-1" for="mkKompetensi">Ini adalah Mata Kuliah Kompetensi</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                    <i class="bi bi-save me-2"></i>Simpan Mata Kuliah
                </button>
            </form>
        </div>

        <div class="card card-custom p-4">
            <h5 class="fw-bold mb-3 border-bottom pb-2">Daftar Kurikulum</h5>
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th rowspan="2">Smt</th>
                            <th rowspan="2">Kode MK</th>
                            <th rowspan="2" class="text-start">Nama Mata Kuliah</th>
                            <th rowspan="2">MK Kompetensi</th>
                            <th colspan="3">Bobot SKS</th>
                            <th rowspan="2">Unit Penyelenggara</th>
                        </tr>
                        <tr>
                            <th>Kuliah</th><th>Seminar</th><th>Praktik</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kurikulums as $mk)
                        <tr>
                            <td>{{ $mk->semester }}</td>
                            <td>{{ $mk->kode_mk }}</td>
                            <td class="text-start">{{ $mk->nama_mk }}</td>
                            <td>{!! $mk->is_mk_kompetensi ? '<i class="bi bi-check-lg text-success fw-bold fs-4"></i>' : '-' !!}</td>
                            <td>{{ $mk->sks_kuliah }}</td>
                            <td>{{ $mk->sks_seminar }}</td>
                            <td>{{ $mk->sks_praktikum }}</td>
                            <td>{{ $mk->unit_penyelenggara }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-muted py-4">Belum ada mata kuliah yang diinput.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>