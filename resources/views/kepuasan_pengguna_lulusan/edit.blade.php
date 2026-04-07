<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 6.g.2 Kepuasan Pengguna Lulusan - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('kepuasan_pengguna_lulusan.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Tingkat Kepuasan Pengguna Lulusan</h5>
                
                <form action="{{ route('kepuasan_pengguna_lulusan.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Jenis Kemampuan</label>
                        <select name="jenis_kemampuan" class="form-select rounded-3" required>
                            @php
                                $kategoris = [
                                    'Etika',
                                    'Keahlian pada bidang ilmu (kompetensi utama)',
                                    'Kemampuan berbahasa asing',
                                    'Penggunaan teknologi informasi',
                                    'Kemampuan berkomunikasi',
                                    'Kerjasama tim',
                                    'Pengembangan diri'
                                ];
                            @endphp
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori }}" {{ $data->jenis_kemampuan == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="p-3 bg-light rounded-3 mb-4 border">
                        <label class="form-label fw-bold text-sm text-primary mb-3"><i class="bi bi-percent me-2"></i>Tingkat Kepuasan Pengguna (%)</label>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label fw-semibold text-sm">Sangat Baik</label>
                                <input type="number" step="any" name="sangat_baik" class="form-control rounded-3" value="{{ $data->sangat_baik }}" min="0" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold text-sm">Baik</label>
                                <input type="number" step="any" name="baik" class="form-control rounded-3" value="{{ $data->baik }}" min="0" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold text-sm">Cukup</label>
                                <input type="number" step="any" name="cukup" class="form-control rounded-3" value="{{ $data->cukup }}" min="0" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold text-sm">Kurang</label>
                                <input type="number" step="any" name="kurang" class="form-control rounded-3" value="{{ $data->kurang }}" min="0" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Rencana Tindak Lanjut oleh UPPS/PS</label>
                        <textarea name="rencana_tindak_lanjut" class="form-control rounded-3" rows="3" required>{{ $data->rencana_tindak_lanjut }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA KEPUASAN
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>