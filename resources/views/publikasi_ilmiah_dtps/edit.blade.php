<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 4.d Publikasi Ilmiah DTPS - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('publikasi_ilmiah_dtps.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Jumlah Publikasi Ilmiah Dosen</h5>
                <form action="{{ route('publikasi_ilmiah_dtps.update', $publikasi->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Jenis Publikasi</label>
                        <select name="jenis_publikasi" class="form-select rounded-3" required>
                            <option value="Jurnal nasional tidak terakreditasi" {{ $publikasi->jenis_publikasi == 'Jurnal nasional tidak terakreditasi' ? 'selected' : '' }}>1. Jurnal nasional tidak terakreditasi</option>
                            <option value="Jurnal nasional terakreditasi" {{ $publikasi->jenis_publikasi == 'Jurnal nasional terakreditasi' ? 'selected' : '' }}>2. Jurnal nasional terakreditasi / majalah profesi</option>
                            <option value="Jurnal internasional" {{ $publikasi->jenis_publikasi == 'Jurnal internasional' ? 'selected' : '' }}>3. Jurnal internasional</option>
                            <option value="Jurnal internasional bereputasi" {{ $publikasi->jenis_publikasi == 'Jurnal internasional bereputasi' ? 'selected' : '' }}>4. Jurnal internasional bereputasi</option>
                            <option value="Prosiding seminar nasional" {{ $publikasi->jenis_publikasi == 'Prosiding seminar nasional' ? 'selected' : '' }}>5. Prosiding seminar nasional / wilayah</option>
                            <option value="Prosiding seminar internasional (tidak terindeks)" {{ $publikasi->jenis_publikasi == 'Prosiding seminar internasional (tidak terindeks)' ? 'selected' : '' }}>6. Prosiding seminar internasional (tidak terindeks)</option>
                            <option value="Prosiding seminar internasional (terindeks Scopus/WoS)" {{ $publikasi->jenis_publikasi == 'Prosiding seminar internasional (terindeks Scopus/WoS)' ? 'selected' : '' }}>7. Prosiding seminar internasional (terindeks Scopus/WoS)</option>
                        </select>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah TS-2</label>
                            <input type="number" name="jumlah_ts2" class="form-control rounded-3" value="{{ $publikasi->jumlah_ts2 }}" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah TS-1</label>
                            <input type="number" name="jumlah_ts1" class="form-control rounded-3" value="{{ $publikasi->jumlah_ts1 }}" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah TS</label>
                            <input type="number" name="jumlah_ts" class="form-control rounded-3" value="{{ $publikasi->jumlah_ts }}" min="0" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA PUBLIKASI
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>