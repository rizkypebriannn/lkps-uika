<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 6.g.2 Kepuasan Pengguna Lulusan - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Tingkat Kepuasan Pengguna Lulusan</h5>
                
                <form action="{{ route('kepuasan_pengguna_lulusan.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Jenis Kemampuan</label>
                        <select name="jenis_kemampuan" class="form-select rounded-3" required>
                            <option value="" disabled selected>-- Pilih Jenis Kemampuan --</option>
                            <option value="Etika">Etika</option>
                            <option value="Keahlian pada bidang ilmu (kompetensi utama)">Keahlian pada bidang ilmu (kompetensi utama)</option>
                            <option value="Kemampuan berbahasa asing">Kemampuan berbahasa asing</option>
                            <option value="Penggunaan teknologi informasi">Penggunaan teknologi informasi</option>
                            <option value="Kemampuan berkomunikasi">Kemampuan berkomunikasi</option>
                            <option value="Kerjasama tim">Kerjasama tim</option>
                            <option value="Pengembangan diri">Pengembangan diri</option>
                        </select>
                    </div>

                    <div class="p-3 bg-light rounded-3 mb-4 border">
                        <label class="form-label fw-bold text-sm text-primary mb-3"><i class="bi bi-percent me-2"></i>Tingkat Kepuasan Pengguna (%)</label>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label fw-semibold text-sm">Sangat Baik</label>
                                <input type="number" step="any" name="sangat_baik" class="form-control rounded-3" min="0" value="0" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold text-sm">Baik</label>
                                <input type="number" step="any" name="baik" class="form-control rounded-3" min="0" value="0" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold text-sm">Cukup</label>
                                <input type="number" step="any" name="cukup" class="form-control rounded-3" min="0" value="0" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold text-sm">Kurang</label>
                                <input type="number" step="any" name="kurang" class="form-control rounded-3" min="0" value="0" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Rencana Tindak Lanjut oleh UPPS/PS</label>
                        <textarea name="rencana_tindak_lanjut" class="form-control rounded-3" rows="3" placeholder="Deskripsikan rencana tindak lanjut..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA KEPUASAN
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Data Kepuasan Tersimpan ({{ $data->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered align-middle text-center" style="font-size: 0.85rem;">
                        <thead class="table-light">
                            <tr>
                                <th rowspan="2" class="align-middle" width="5%">No</th>
                                <th rowspan="2" class="align-middle text-start" width="25%">Jenis Kemampuan</th>
                                <th colspan="4">Tingkat Kepuasan Pengguna (%)</th>
                                <th rowspan="2" class="align-middle text-start" width="25%">Rencana Tindak Lanjut</th>
                                <th rowspan="2" class="align-middle" width="5%">Hapus</th>
                            </tr>
                            <tr>
                                <th>Sangat Baik</th>
                                <th>Baik</th>
                                <th>Cukup</th>
                                <th>Kurang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start fw-bold">{{ $item->jenis_kemampuan }}</td>
                                <td>{{ $item->sangat_baik }}%</td>
                                <td>{{ $item->baik }}%</td>
                                <td>{{ $item->cukup }}%</td>
                                <td>{{ $item->kurang }}%</td>
                                <td class="text-start">{{ $item->rencana_tindak_lanjut }}</td>
                                <td>
                                    <form action="{{ route('kepuasan_pengguna_lulusan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-muted py-3">Belum ada data Kepuasan Pengguna yang diinput.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>