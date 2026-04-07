<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 6.e.2 Publikasi Mahasiswa (Terapan) - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('publikasi_mahasiswa_terapan.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Pagelaran/Pameran/Presentasi/Publikasi Mahasiswa</h5>
                
                <form action="{{ route('publikasi_mahasiswa_terapan.update', $publikasi->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Jenis Publikasi</label>
                        <select name="jenis_publikasi" class="form-select rounded-3" required>
                            @php
                                $kategoris = [
                                    'Publikasi di jurnal nasional tidak terakreditasi',
                                    'Publikasi di jurnal nasional terakreditasi',
                                    'Publikasi di jurnal internasional',
                                    'Publikasi di jurnal internasional bereputasi',
                                    'Prosiding di seminar nasional/wilayah',
                                    'Prosiding tidak terindeks di seminar internasional',
                                    'Prosiding terindeks Scopus / WoS di seminar internasional',
                                    'Pagelaran/pameran/presentasi dalam forum di tingkat wilayah',
                                    'Pagelaran/pameran/presentasi dalam forum di tingkat nasional',
                                    'Pagelaran/pameran/presentasi dalam forum di tingkat internasional'
                                ];
                            @endphp
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori }}" {{ $publikasi->jenis_publikasi == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah Judul (TS-2)</label>
                            <input type="number" name="ts_2" class="form-control rounded-3" value="{{ $publikasi->ts_2 }}" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah Judul (TS-1)</label>
                            <input type="number" name="ts_1" class="form-control rounded-3" value="{{ $publikasi->ts_1 }}" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm text-primary">Jumlah Judul (TS)</label>
                            <input type="number" name="ts" class="form-control rounded-3 border-primary" value="{{ $publikasi->ts }}" min="0" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA PUBLIKASI/PAMERAN
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>