<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel 1 Visi Misi - LKPS</title>
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
            <h3 class="fw-bold m-0">Tabel 1 Visi Misi, Tujuan, dan Strategi</h3>
            <p class="text-muted">Pendataan VMTS Perguruan Tinggi, UPPS (Fakultas), serta Visi Keilmuan Program Studi.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-custom p-4 mb-5">
            <h5 class="fw-bold mb-4 border-bottom pb-2">Form Tambah Data VMTS</h5>
            <form action="{{ route('visi_misi.store') }}" method="POST">
                @csrf
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Jenis VMTS</label>
                        <select name="jenis_vmts" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Jenis --</option>
                            <option value="VMTS PT">VMTS Perguruan Tinggi (PT)</option>
                            <option value="VMTS UPPS">VMTS UPPS (Fakultas)</option>
                            <option value="Visi Keilmuan PS">Visi Keilmuan Program Studi</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">No. Surat Keputusan (SK)</label>
                        <input type="text" name="no_sk" class="form-control" placeholder="Contoh: 0153/SK/LAM Teknik/..." required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Link Dokumen</label>
                        <input type="url" name="link_dokumen" class="form-control" placeholder="https://drive.google.com/..." required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Pernyataan Visi/Misi</label>
                        <textarea name="pernyataan" class="form-control" rows="4" placeholder="Tuliskan isi pernyataan visi misi secara lengkap di sini..." required></textarea>
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
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Jenis VMTS</th>
                            <th width="40%">Pernyataan</th>
                            <th width="20%">No. SK</th>
                            <th width="15%">Link Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visiMisis as $index => $vm)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="fw-bold">{{ $vm->jenis_vmts }}</td>
                            <td>{{ $vm->pernyataan }}</td>
                            <td>{{ $vm->no_sk }}</td>
                            <td class="text-center">
                                <a href="{{ $vm->link_dokumen }}" target="_blank" class="btn btn-sm btn-outline-info rounded-pill">
                                    <i class="bi bi-link-45deg"></i> Buka Dokumen
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-muted text-center py-4">Belum ada data Visi Misi yang diinput.</td>
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