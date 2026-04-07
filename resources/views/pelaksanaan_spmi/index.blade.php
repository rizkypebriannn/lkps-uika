<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 7.b Pelaksanaan SPMI - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
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
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Dokumen Pelaksanaan SPMI (Siklus PPEPP)</h5>
                
                <form action="{{ route('pelaksanaan_spmi.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Pilih Tahapan Dokumen (PPEPP)</label>
                        <select name="dokumen" class="form-select rounded-3" required>
                            <option value="" disabled selected>-- Pilih Tahapan --</option>
                            <option value="Penetapan">1. Penetapan</option>
                            <option value="Pelaksanaan">2. Pelaksanaan</option>
                            <option value="Evaluasi">3. Evaluasi (Isi Link Laporan Audit)</option>
                            <option value="Pengendalian">4. Pengendalian (Isi Link Laporan RTM)</option>
                            <option value="Peningkatan">5. Peningkatan (Isi Link Dok. Peningkatan)</option>
                        </select>
                        <small class="text-muted" style="font-size: 0.75rem;">(Data akan diperbarui secara otomatis jika Anda memilih tahapan yang sama)</small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Link Dokumen (Wajib untuk semua tahapan)</label>
                        <input type="url" name="link_dokumen" class="form-control rounded-3" placeholder="Contoh: https://drive.google.com/..." required>
                    </div>

                    <div class="p-3 bg-light rounded-3 mb-4 border">
                        <label class="form-label fw-bold text-sm text-primary mb-3"><i class="bi bi-link-45deg me-2"></i>Link Khusus (Isi sesuai tahapan yang dipilih)</label>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-sm">Link Laporan Hasil Audit</label>
                                <input type="url" name="link_laporan_audit" class="form-control rounded-3" placeholder="Hanya untuk Evaluasi">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-sm">Link Laporan RTM</label>
                                <input type="url" name="link_laporan_rtm" class="form-control rounded-3" placeholder="Hanya untuk Pengendalian">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-sm">Link Dokumen Peningkatan</label>
                                <input type="url" name="link_dokumen_peningkatan" class="form-control rounded-3" placeholder="Hanya untuk Peningkatan">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold"
                            onclick="if(this.form.checkValidity()) { this.disabled=true; this.innerHTML='<span class=\'spinner-border spinner-border-sm me-2\'></span>Menyimpan...'; this.form.submit(); } else { this.form.reportValidity(); }">
                        <i class="bi bi-save me-2"></i>SIMPAN PELAKSANAAN SPMI
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Data Pelaksanaan Tersimpan ({{ $data->count() }}/5)</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle text-center" style="font-size: 0.85rem;">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%" class="text-start">Dokumen (PPEPP)</th>
                                <th width="20%">Link Dokumen</th>
                                <th width="15%">Link Hasil Audit</th>
                                <th width="15%">Link Laporan RTM</th>
                                <th width="20%">Link Dok Peningkatan</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start fw-bold">{{ $item->dokumen }}</td>
                                <td>
                                    <a href="{{ $item->link_dokumen }}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i> Lihat</a>
                                </td>
                                <td>
                                    @if($item->link_laporan_audit) <a href="{{ $item->link_laporan_audit }}" target="_blank" class="badge bg-success text-decoration-none">Ada Link</a> @else <span class="text-muted">-</span> @endif
                                </td>
                                <td>
                                    @if($item->link_laporan_rtm) <a href="{{ $item->link_laporan_rtm }}" target="_blank" class="badge bg-warning text-dark text-decoration-none">Ada Link</a> @else <span class="text-muted">-</span> @endif
                                </td>
                                <td>
                                    @if($item->link_dokumen_peningkatan) <a href="{{ $item->link_dokumen_peningkatan }}" target="_blank" class="badge bg-info text-dark text-decoration-none">Ada Link</a> @else <span class="text-muted">-</span> @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('pelaksanaan_spmi.edit', $item->id) }}" class="btn btn-sm text-warning p-0" title="Edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('pelaksanaan_spmi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm text-danger p-0" title="Hapus"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-muted py-3">Belum ada data Pelaksanaan SPMI yang diinput.</td>
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