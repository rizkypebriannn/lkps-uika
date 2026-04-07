<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 6.a Jumlah Mahasiswa - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
            </a>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i><strong>Gagal Menyimpan Data!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0 rounded-4 p-4 mb-5">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Form Tambah Data Mahasiswa</h5>
                <form action="{{ route('jumlah_mahasiswa.store') }}" method="POST">
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

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold"
                            onclick="if(this.form.checkValidity()) { this.disabled=true; this.innerHTML='<span class=\'spinner-border spinner-border-sm me-2\'></span>Menyimpan...'; this.form.submit(); } else { this.form.reportValidity(); }">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA
                    </button>
                </form>
            </div>

            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h5 class="fw-bold mb-3 border-bottom pb-2">Data Tersimpan</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered text-center align-middle" style="font-size: 0.9rem;">
                        <thead class="table-dark">
                            <tr>
                                <th rowspan="2" class="align-middle">Program Studi</th>
                                <th colspan="3">Mahasiswa Aktif</th>
                                <th colspan="3">Mhs Asing (Full-Time)</th>
                                <th rowspan="2" class="align-middle">Aksi</th>
                            </tr>
                            <tr>
                                <th>TS-2</th><th>TS-1</th><th>TS</th>
                                <th>TS-2</th><th>TS-1</th><th>TS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mahasiswas as $mhs)
                            <tr>
                                <td class="text-start fw-bold">{{ $mhs->program_studi }}</td>
                                <td>{{ $mhs->aktif_ts2 }}</td>
                                <td>{{ $mhs->aktif_ts1 }}</td>
                                <td class="fw-bold text-primary">{{ $mhs->aktif_ts }}</td>
                                <td>{{ $mhs->asing_ft_ts2 }}</td>
                                <td>{{ $mhs->asing_ft_ts1 }}</td>
                                <td>{{ $mhs->asing_ft_ts }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('jumlah_mahasiswa.edit', $mhs->id) }}" class="btn btn-sm text-warning p-0" title="Edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('jumlah_mahasiswa.destroy', $mhs->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm text-danger p-0" title="Hapus"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-muted py-4">Belum ada data mahasiswa yang diinput.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>