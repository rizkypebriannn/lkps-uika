<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tabel 3.a.3 Integrasi Kegiatan - LKPS</title>
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
            <h3 class="fw-bold m-0">Tabel 3.a.3 Integrasi Kegiatan Penelitian/PkM dalam Pembelajaran</h3>
            <p class="text-danger fw-semibold">Diisi oleh pengusul dari Program Studi untuk semua program.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-custom p-4 mb-5">
            <h5 class="fw-bold mb-4 border-bottom pb-2">Form Tambah Data Integrasi</h5>
            <form action="{{ route('integrasi_pembelajaran.store') }}" method="POST">
                @csrf
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Nama Dosen</label>
                        <input type="text" name="nama_dosen" class="form-control" required>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Judul Penelitian/PkM</label>
                        <input type="text" name="judul_kegiatan" class="form-control" required>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Mata Kuliah</label>
                        <input type="text" name="mata_kuliah" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Bentuk Integrasi</label>
                        <input type="text" name="bentuk_integrasi" class="form-control" placeholder="Cth: Studi Kasus, Materi Perkuliahan, Modul" required>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold d-block">Tahun Kegiatan</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">TS-2</span>
                            <input type="text" name="tahun_ts2" class="form-control" placeholder="Tahun/Strip">
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">TS-1</span>
                            <input type="text" name="tahun_ts1" class="form-control" placeholder="Tahun/Strip">
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">TS</span>
                            <input type="text" name="tahun_ts" class="form-control" placeholder="Tahun/Strip">
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Kesesuaian dengan Peta Jalan</label>
                                <select name="kesesuaian_peta_jalan" class="form-select" required>
                                    <option value="Sesuai">Sesuai</option>
                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Kesesuaian dengan RPS</label>
                                <select name="kesesuaian_rps" class="form-select" required>
                                    <option value="Sesuai">Sesuai</option>
                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label fw-semibold">Bukti Sahih (Link)</label>
                                <input type="url" name="bukti_sahih" class="form-control" placeholder="Link Google Drive...">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                    <i class="bi bi-save me-2"></i>Simpan Data Integrasi
                </button>
            </form>
        </div>

        <div class="card card-custom p-4">
            <h5 class="fw-bold mb-3 border-bottom pb-2">Daftar Integrasi Pembelajaran</h5>
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center align-middle" style="font-size: 0.85rem;">
                    <thead class="table-dark">
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Nama Dosen</th>
                            <th rowspan="2">Judul Penelitian/PkM</th>
                            <th rowspan="2">Mata Kuliah</th>
                            <th rowspan="2">Bentuk Integrasi</th>
                            <th colspan="3">Tahun</th>
                            <th rowspan="2">Kesesuaian Peta Jalan</th>
                            <th rowspan="2">Bukti Sahih</th>
                            <th rowspan="2">Kesesuaian RPS</th>
                            <th rowspan="2">Aksi</th>
                        </tr>
                        <tr>
                            <th>TS-2</th><th>TS-1</th><th>TS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($integrasis as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="text-start fw-bold">{{ $item->nama_dosen }}</td>
                            <td class="text-start">{{ $item->judul_kegiatan }}</td>
                            <td>{{ $item->mata_kuliah }}</td>
                            <td>{{ $item->bentuk_integrasi }}</td>
                            <td>{{ $item->tahun_ts2 ?? '-' }}</td>
                            <td>{{ $item->tahun_ts1 ?? '-' }}</td>
                            <td>{{ $item->tahun_ts ?? '-' }}</td>
                            <td>
                                <span class="badge {{ $item->kesesuaian_peta_jalan == 'Sesuai' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $item->kesesuaian_peta_jalan }}
                                </span>
                            </td>
                            <td>{!! $item->bukti_sahih ? '<a href="'.$item->bukti_sahih.'" target="_blank" class="btn btn-sm btn-outline-info"><i class="bi bi-link"></i></a>' : '-' !!}</td>
                            <td>
                                <span class="badge {{ $item->kesesuaian_rps == 'Sesuai' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $item->kesesuaian_rps }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('integrasi_pembelajaran.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-muted py-4">Belum ada data yang diinput.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>