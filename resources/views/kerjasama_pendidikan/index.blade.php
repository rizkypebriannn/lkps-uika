<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tabel 2.a.1 Kerjasama Pendidikan - LKPS</title>
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
            <h3 class="fw-bold m-0">Tabel 2.a.1 Kerjasama Tridharma (Pendidikan)</h3>
            <p class="text-muted">Pendataan lembaga mitra, durasi kerjasama, dan bukti kegiatan pelaksanaan.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-custom p-4 mb-5">
            <h5 class="fw-bold mb-4 border-bottom pb-2">Form Tambah Data Kerjasama</h5>
            <form action="{{ route('kerjasama_pendidikan.store') }}" method="POST">
                @csrf
                <div class="row g-3 mb-3">
                    <div class="col-md-5">
                        <label class="form-label fw-semibold">Lembaga Mitra</label>
                        <input type="text" name="lembaga_mitra" class="form-control" placeholder="Cth: PT Telkom Indonesia" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Tingkat Kerjasama</label>
                        <select name="tingkat" class="form-select" required>
                            <option value="Internasional">Internasional</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Lokal/Wilayah">Lokal/Wilayah</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Status Kerjasama</label>
                        <input type="text" name="status_kerjasama" class="form-control" placeholder="Cth: MoU / SPK / Surat Penugasan" required>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Judul Kegiatan Kerjasama</label>
                        <input type="text" name="judul_kegiatan" class="form-control" placeholder="Cth: Program Magang Merdeka" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Manfaat bagi PS yang Diakreditasi</label>
                        <input type="text" name="manfaat" class="form-control" placeholder="Cth: Peningkatan kompetensi mahasiswa" required>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Tanggal Awal (Mulai)</label>
                        <input type="date" name="tanggal_awal" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Tanggal Akhir (Selesai)</label>
                        <input type="date" name="tanggal_akhir" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Durasi (Tahun)</label>
                        <input type="number" name="durasi" class="form-control" placeholder="Cth: 3" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Link Bukti Kerjasama</label>
                        <input type="url" name="bukti_kerjasama" class="form-control" placeholder="Link Google Drive" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                    <i class="bi bi-save me-2"></i>Simpan Data Kerjasama
                </button>
            </form>
        </div>

        <div class="card card-custom p-4">
            <h5 class="fw-bold mb-3 border-bottom pb-2">Daftar Kerjasama</h5>
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center align-middle" style="font-size: 0.9rem;">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Lembaga Mitra</th>
                            <th>Tingkat</th>
                            <th>Judul Kegiatan</th>
                            <th>Waktu Pelaksanaan</th>
                            <th>Durasi</th>
                            <th>Status & Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kerjasamas as $index => $kj)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="text-start fw-bold">{{ $kj->lembaga_mitra }}</td>
                            <td>
                                @if($kj->tingkat == 'Internasional') <span class="badge bg-primary">Internasional</span>
                                @elseif($kj->tingkat == 'Nasional') <span class="badge bg-success">Nasional</span>
                                @else <span class="badge bg-secondary">Lokal/Wilayah</span>
                                @endif
                            </td>
                            <td class="text-start">{{ $kj->judul_kegiatan }}<br><small class="text-muted">Manfaat: {{ $kj->manfaat }}</small></td>
                            <td>{{ \Carbon\Carbon::parse($kj->tanggal_awal)->format('d/m/Y') }} - <br> {{ \Carbon\Carbon::parse($kj->tanggal_akhir)->format('d/m/Y') }}</td>
                            <td>{{ $kj->durasi }} thn</td>
                            <td>
                                <div>{{ $kj->status_kerjasama }}</div>
                                <a href="{{ $kj->bukti_kerjasama }}" target="_blank" class="btn btn-sm btn-outline-info mt-1"><i class="bi bi-link"></i> Bukti</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-muted py-4">Belum ada data kerjasama yang diinput.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>