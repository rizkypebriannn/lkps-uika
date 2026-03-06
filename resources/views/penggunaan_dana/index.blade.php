<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tabel 2.b Penggunaan Dana - LKPS</title>
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
            <h3 class="fw-bold m-0">Tabel 2.b Penggunaan Dana</h3>
            <p class="text-muted">Pendataan biaya operasional dan investasi (Format: Rupiah Penuh).</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-custom p-4 mb-5">
            <h5 class="fw-bold mb-4 border-bottom pb-2">Form Tambah Alokasi Dana</h5>
            <form action="{{ route('penggunaan_dana.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-semibold">Jenis Penggunaan</label>
                    <input type="text" name="jenis_penggunaan" class="form-control" placeholder="Cth: Biaya Dosen / Biaya Penelitian / Investasi Sarana" required>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-white shadow-sm">
                            <h6 class="fw-bold text-primary mb-3"><i class="bi bi-building me-2"></i>Dana di UPPS (Fakultas)</h6>
                            <div class="input-group mb-2">
                                <span class="input-group-text">TS-2 (Rp)</span>
                                <input type="text" name="upps_ts2" class="form-control input-rupiah" value="0">
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">TS-1 (Rp)</span>
                                <input type="text" name="upps_ts1" class="form-control input-rupiah" value="0">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">TS (Rp)</span>
                                <input type="text" name="upps_ts" class="form-control input-rupiah" value="0">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-white shadow-sm">
                            <h6 class="fw-bold text-success mb-3"><i class="bi bi-mortarboard me-2"></i>Dana di Program Studi</h6>
                            <div class="input-group mb-2">
                                <span class="input-group-text">TS-2 (Rp)</span>
                                <input type="text" name="ps_ts2" class="form-control input-rupiah" value="0">
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">TS-1 (Rp)</span>
                                <input type="text" name="ps_ts1" class="form-control input-rupiah" value="0">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">TS (Rp)</span>
                                <input type="text" name="ps_ts" class="form-control input-rupiah" value="0">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                    <i class="bi bi-save me-2"></i>Simpan Data Keuangan
                </button>
            </form>
        </div>

        <div class="card card-custom p-4">
            <h5 class="fw-bold mb-3 border-bottom pb-2">Daftar Penggunaan Dana Tersimpan</h5>
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center align-middle" style="font-size: 0.9rem;">
                    <thead class="table-dark">
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Jenis Penggunaan</th>
                            <th colspan="3">Unit Pengelola Program Studi (UPPS)</th>
                            <th colspan="3">Program Studi (PS)</th>
                            <th rowspan="2">Aksi</th> </tr>
                        </tr>
                        <tr>
                            <th>TS-2</th><th>TS-1</th><th>TS</th>
                            <th>TS-2</th><th>TS-1</th><th>TS</th>
                        </tr>
                    </thead>
                    <tbody>
                       @forelse($danas as $index => $dana)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="text-start fw-bold">{{ $dana->jenis_penggunaan }}</td>
                            
                            <td>{{ number_format($dana->upps_ts2, 0, ',', '.') }}</td>
                            <td>{{ number_format($dana->upps_ts1, 0, ',', '.') }}</td>
                            <td class="text-primary fw-bold">{{ number_format($dana->upps_ts, 0, ',', '.') }}</td>
                            
                            <td>{{ number_format($dana->ps_ts2, 0, ',', '.') }}</td>
                            <td>{{ number_format($dana->ps_ts1, 0, ',', '.') }}</td>
                            <td class="text-success fw-bold">{{ number_format($dana->ps_ts, 0, ',', '.') }}</td>
                            
                            <td>
                                <form action="{{ route('penggunaan_dana.destroy', $dana->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-muted py-4">Belum ada data keuangan yang diinput.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.querySelectorAll('.input-rupiah').forEach(function(input) {
            input.addEventListener('keyup', function(e) {
                // Hapus semua karakter selain angka
                let val = this.value.replace(/[^,\d]/g, '');
                
                // Tambahkan titik pemisah ribuan
                let sisa = val.length % 3;
                let rupiah = val.substr(0, sisa);
                let ribuan = val.substr(sisa).match(/\d{3}/gi);
                
                if (ribuan) {
                    let separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
                
                this.value = rupiah;
            });
        });
    </script>
</body>
</html>