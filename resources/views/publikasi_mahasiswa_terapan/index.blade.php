<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 6.e.2 Publikasi Mahasiswa (Terapan) - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
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
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Pagelaran/Pameran/Presentasi/Publikasi Mahasiswa</h5>
                
                <form action="{{ route('publikasi_mahasiswa_terapan.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Jenis Publikasi</label>
                        <select name="jenis_publikasi" class="form-select rounded-3" required>
                            <option value="" disabled selected>Pilih Jenis Publikasi...</option>
                            <option value="Publikasi di jurnal nasional tidak terakreditasi">Publikasi di jurnal nasional tidak terakreditasi</option>
                            <option value="Publikasi di jurnal nasional terakreditasi">Publikasi di jurnal nasional terakreditasi</option>
                            <option value="Publikasi di jurnal internasional">Publikasi di jurnal internasional</option>
                            <option value="Publikasi di jurnal internasional bereputasi">Publikasi di jurnal internasional bereputasi</option>
                            <option value="Prosiding di seminar nasional/wilayah">Prosiding di seminar nasional/wilayah</option>
                            <option value="Prosiding tidak terindeks di seminar internasional">Prosiding tidak terindeks di seminar internasional</option>
                            <option value="Prosiding terindeks Scopus / WoS di seminar internasional">Prosiding terindeks Scopus / WoS di seminar internasional</option>
                            <option value="Pagelaran/pameran/presentasi dalam forum di tingkat wilayah">Pagelaran/pameran/presentasi dalam forum di tingkat wilayah</option>
                            <option value="Pagelaran/pameran/presentasi dalam forum di tingkat nasional">Pagelaran/pameran/presentasi dalam forum di tingkat nasional</option>
                            <option value="Pagelaran/pameran/presentasi dalam forum di tingkat internasional">Pagelaran/pameran/presentasi dalam forum di tingkat internasional</option>
                        </select>
                        <small class="text-muted" style="font-size: 0.75rem;">(Data akan diperbarui secara otomatis jika Anda memilih jenis yang sama)</small>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah Judul (TS-2)</label>
                            <input type="number" name="ts_2" class="form-control rounded-3" value="0" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah Judul (TS-1)</label>
                            <input type="number" name="ts_1" class="form-control rounded-3" value="0" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm text-primary">Jumlah Judul (TS)</label>
                            <input type="number" name="ts" class="form-control rounded-3 border-primary" value="0" min="0" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA PUBLIKASI/PAMERAN
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Daftar Jenis Tersimpan ({{ $publikasis->count() }}/10)</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th rowspan="2" class="align-middle">No</th>
                                <th rowspan="2" class="align-middle text-start">Jenis Publikasi</th>
                                <th colspan="3">Jumlah Judul</th>
                                <th rowspan="2" class="align-middle">Hapus</th>
                            </tr>
                            <tr>
                                <th>TS-2</th>
                                <th>TS-1</th>
                                <th>TS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($publikasis as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start fw-bold" style="font-size: 0.85rem;">{{ $item->jenis_publikasi }}</td>
                                <td>{{ $item->ts_2 }}</td>
                                <td>{{ $item->ts_1 }}</td>
                                <td class="fw-bold text-primary">{{ $item->ts }}</td>
                                <td>
                                    <form action="{{ route('publikasi_mahasiswa_terapan.destroy', $item->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @if($publikasis->isEmpty())
                            <tr>
                                <td colspan="6" class="text-muted py-3">Belum ada data publikasi/pagelaran yang diinput.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>