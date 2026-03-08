<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tabel 3.a.4 Basic Science - LKPS</title>
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
            <h3 class="fw-bold m-0">Tabel 3.a.4 Mata Kuliah Basic Science dan Matematika</h3>
            <p class="text-danger fw-semibold">Diisi oleh pengusul dari program studi pada program Sarjana/Sarjana Terapan</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-custom p-4 mb-5">
            <h5 class="fw-bold mb-4 border-bottom pb-2">Form Tambah Mata Kuliah</h5>
            <form action="{{ route('matkul_basic_science.store') }}" method="POST">
                @csrf
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Mata Kuliah Basic Science / Matematika</label>
                        <input type="text" name="nama_mata_kuliah" class="form-control" placeholder="Cth: Kalkulus I" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Semester</label>
                        <input type="text" name="semester" class="form-control" placeholder="Cth: 1" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Jumlah SKS</label>
                        <input type="number" name="jumlah_sks" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                    <i class="bi bi-save me-2"></i>Simpan Data
                </button>
            </form>
        </div>

        <div class="card card-custom p-4">
            <h5 class="fw-bold mb-3 border-bottom pb-2">Daftar Mata Kuliah Tersimpan</h5>
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center align-middle" style="font-size: 0.95rem;">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th class="text-start">Nama Mata Kuliah Basic Science dan Matematika</th>
                            <th>Semester</th>
                            <th>Jumlah SKS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($matkuls as $index => $mk)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="text-start fw-bold">{{ $mk->nama_mata_kuliah }}</td>
                            <td>{{ $mk->semester }}</td>
                            <td>{{ $mk->jumlah_sks }}</td>
                            <td>
                                <form action="{{ route('matkul_basic_science.destroy', $mk->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data mata kuliah ini?');">
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
                            <td colspan="5" class="text-muted py-4">Belum ada data mata kuliah yang diinput.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>