<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa - Tabel 6.a</title>
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

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold m-0">Tabel 6.a Jumlah Mahasiswa</h3>
                <p class="text-muted">Pendataan Mahasiswa Reguler dan Asing (Penuh Waktu & Paruh Waktu)</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-custom p-4 mb-5">
            <h5 class="fw-bold mb-4 border-bottom pb-2">Form Tambah Data Mahasiswa</h5>
            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-semibold">Program Studi</label>
                    <input type="text" name="program_studi" class="form-control" placeholder="Contoh: S1 Teknik Elektro" required>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light">
                            <label class="form-label fw-semibold text-primary">Mahasiswa Aktif</label>
                            <input type="number" name="aktif_ts2" class="form-control mb-2" placeholder="Tahun TS-2" required>
                            <input type="number" name="aktif_ts1" class="form-control mb-2" placeholder="Tahun TS-1" required>
                            <input type="number" name="aktif_ts" class="form-control" placeholder="Tahun TS" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light">
                            <label class="form-label fw-semibold text-success">Mhs. Asing (Full-Time)</label>
                            <input type="number" name="asing_ft_ts2" class="form-control mb-2" placeholder="Tahun TS-2" value="0">
                            <input type="number" name="asing_ft_ts1" class="form-control mb-2" placeholder="Tahun TS-1" value="0">
                            <input type="number" name="asing_ft_ts" class="form-control" placeholder="Tahun TS" value="0">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light">
                            <label class="form-label fw-semibold text-warning">Mhs. Asing (Part-Time)</label>
                            <input type="number" name="asing_pt_ts2" class="form-control mb-2" placeholder="Tahun TS-2" value="0">
                            <input type="number" name="asing_pt_ts1" class="form-control mb-2" placeholder="Tahun TS-1" value="0">
                            <input type="number" name="asing_pt_ts" class="form-control" placeholder="Tahun TS" value="0">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                    <i class="bi bi-save me-2"></i>Simpan Data
                </button>
            </form>
        </div>

        <div class="card card-custom p-4">
            <h5 class="fw-bold mb-3 border-bottom pb-2">Data Tersimpan</h5>
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th rowspan="2">Program Studi</th>
                            <th colspan="3">Mahasiswa Aktif</th>
                            <th colspan="3">Mhs Asing (Full-Time)</th>
                        </tr>
                        <tr>
                            <th>TS-2</th><th>TS-1</th><th>TS</th>
                            <th>TS-2</th><th>TS-1</th><th>TS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswas as $mhs)
                        <tr>
                            <td class="text-start">{{ $mhs->program_studi }}</td>
                            <td>{{ $mhs->aktif_ts2 }}</td>
                            <td>{{ $mhs->aktif_ts1 }}</td>
                            <td class="fw-bold text-primary">{{ $mhs->aktif_ts }}</td>
                            <td>{{ $mhs->asing_ft_ts2 }}</td>
                            <td>{{ $mhs->asing_ft_ts1 }}</td>
                            <td>{{ $mhs->asing_ft_ts }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-muted py-4">Belum ada data mahasiswa yang diinput.</td>
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