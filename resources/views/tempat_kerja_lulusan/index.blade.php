<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 6.g.1 Tempat Kerja Lulusan - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
            </a>

            <!-- PESAN SUKSES & ERROR -->
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

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Tempat Kerja Lulusan</h5>
                
                <form action="{{ route('tempat_kerja_lulusan.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Tahun Lulus</label>
                            <input type="text" name="tahun_lulus" class="form-control rounded-3" placeholder="Contoh: TS-2" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Jumlah Lulusan</label>
                            <input type="number" name="jumlah_lulusan" class="form-control rounded-3" min="0" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Jml Tanggapan</label>
                            <input type="number" name="jumlah_tanggapan" class="form-control rounded-3" min="0" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Jml Terlacak</label>
                            <input type="number" name="jumlah_terlacak" class="form-control rounded-3" min="0" required>
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded-3 mb-4 border">
                        <label class="form-label fw-bold text-sm text-primary mb-3"><i class="bi bi-building me-2"></i>Tingkat / Ukuran Tempat Kerja / Berwirausaha</label>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-sm">Lokal / Wilayah / Tdk Berizin</label>
                                <input type="number" name="tingkat_lokal" class="form-control rounded-3" min="0" value="0" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-sm">Nasional / Berizin</label>
                                <input type="number" name="tingkat_nasional" class="form-control rounded-3" min="0" value="0" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-sm">Multinasional / Internasional</label>
                                <input type="number" name="tingkat_multinasional" class="form-control rounded-3" min="0" value="0" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold"
                            onclick="if(this.form.checkValidity()) { this.disabled=true; this.innerHTML='<span class=\'spinner-border spinner-border-sm me-2\'></span>Menyimpan...'; this.form.submit(); } else { this.form.reportValidity(); }">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA TEMPAT KERJA
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Data Tempat Kerja Tersimpan ({{ $data->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered align-middle text-center" style="font-size: 0.9rem;">
                        <thead class="table-light">
                            <tr>
                                <th rowspan="2" class="align-middle">Tahun Lulus</th>
                                <th rowspan="2" class="align-middle">Jml Lulusan</th>
                                <th rowspan="2" class="align-middle">Jml Tanggapan</th>
                                <th rowspan="2" class="align-middle">Jml Terlacak</th>
                                <th colspan="3">Tingkat Tempat Kerja</th>
                                <th rowspan="2" class="align-middle">Aksi</th>
                            </tr>
                            <tr>
                                <th>Lokal/Wilayah</th>
                                <th>Nasional</th>
                                <th>Multinasional</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $item)
                            <tr>
                                <td class="fw-bold text-primary">{{ $item->tahun_lulus }}</td>
                                <td>{{ $item->jumlah_lulusan }}</td>
                                <td>{{ $item->jumlah_tanggapan }}</td>
                                <td>{{ $item->jumlah_terlacak }}</td>
                                <td>{{ $item->tingkat_lokal }}</td>
                                <td>{{ $item->tingkat_nasional }}</td>
                                <td>{{ $item->tingkat_multinasional }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('tempat_kerja_lulusan.edit', $item->id) }}" class="btn btn-sm text-warning p-0" title="Edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('tempat_kerja_lulusan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm text-danger p-0" title="Hapus"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-muted py-3">Belum ada data Tempat Kerja Lulusan yang diinput.</td>
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