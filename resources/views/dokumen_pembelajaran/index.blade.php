<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tabel 3.a.2 Mata Kuliah - LKPS</title>
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
       <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
    <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
</a>

        <div class="mb-4">
            <h3 class="fw-bold m-0">Tabel 3.a.2 Mata Kuliah dan Dokumen Pembelajaran</h3>
            <p class="text-danger fw-semibold">Diisi oleh pengusul dari Program Studi pada Program Profesi Insinyur.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-custom p-4 mb-5">
            <h5 class="fw-bold mb-4 border-bottom pb-2">Form Tambah Mata Kuliah</h5>
            <form action="{{ route('dokumen_pembelajaran.store') }}" method="POST">
                @csrf
                <div class="row g-3 mb-4">
                    <div class="col-md-7">
                        <label class="form-label fw-semibold">Nama Mata Kuliah</label>
                        <input type="text" name="mata_kuliah" class="form-control" required>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-semibold">Kelengkapan Dokumen RPS</label>
                        <input type="url" name="dokumen_rps" class="form-control" placeholder="Isi Link Google Drive RPS (Opsional)">
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Bobot (SKS)</label>
                        <input type="number" name="bobot_sks" class="form-control" value="0" required>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Konversi Kredit ke Jam</label>
                        <div class="d-flex gap-3">
                            <div class="input-group">
                                <span class="input-group-text">Teori</span>
                                <input type="number" name="konversi_teori" class="form-control" value="0">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Praktik</span>
                                <input type="number" name="konversi_praktik" class="form-control" value="0">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                    <i class="bi bi-save me-2"></i>Simpan Data
                </button>
            </form>
        </div>

        <div class="card card-custom p-4">
            <h5 class="fw-bold mb-3 border-bottom pb-2">Daftar Mata Kuliah</h5>
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center align-middle" style="font-size: 0.9rem;">
                    <thead class="table-dark">
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2" class="text-start">Mata Kuliah</th>
                            <th rowspan="2">Bobot (sks)</th>
                            <th colspan="2">Konversi Kredit ke Jam</th>
                            <th rowspan="2">Kelengkapan Dokumen RPS</th>
                            <th rowspan="2">Aksi</th>
                        </tr>
                        <tr>
                            <th>Teori</th>
                            <th>Praktik</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dokumens as $index => $dok)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="text-start fw-bold">{{ $dok->mata_kuliah }}</td>
                            <td>{{ $dok->bobot_sks }}</td>
                            <td>{{ $dok->konversi_teori }}</td>
                            <td>{{ $dok->konversi_praktik }}</td>
                            <td>{!! $dok->dokumen_rps ? '<a href="'.$dok->dokumen_rps.'" target="_blank" class="text-success fs-5"><i class="bi bi-check-circle-fill"></i> Taut</a>' : '<span class="text-muted">-</span>' !!}</td>
                            <td>
                                <form action="{{ route('dokumen_pembelajaran.destroy', $dok->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data mata kuliah ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-muted py-4">Belum ada data mata kuliah yang diinput.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>