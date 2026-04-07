<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 4.e Pagelaran/Pameran/Publikasi - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('karya_ilmiah_dtps.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Jumlah Karya Ilmiah / Pameran Dosen</h5>
                <form action="{{ route('karya_ilmiah_dtps.update', $karya->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Jenis Publikasi / Pagelaran</label>
                        <select name="jenis_publikasi" class="form-select rounded-3" required>
                            <option value="Jurnal nasional tidak terakreditasi" {{ $karya->jenis_publikasi == 'Jurnal nasional tidak terakreditasi' ? 'selected' : '' }}>1. Jurnal nasional tidak terakreditasi</option>
                            <option value="Jurnal nasional terakreditasi" {{ $karya->jenis_publikasi == 'Jurnal nasional terakreditasi' ? 'selected' : '' }}>2. Jurnal nasional terakreditasi</option>
                            <option value="Jurnal internasional" {{ $karya->jenis_publikasi == 'Jurnal internasional' ? 'selected' : '' }}>3. Jurnal internasional</option>
                            <option value="Jurnal internasional bereputasi" {{ $karya->jenis_publikasi == 'Jurnal internasional bereputasi' ? 'selected' : '' }}>4. Jurnal internasional bereputasi</option>
                            <option value="Prosiding di seminar nasional/wilayah" {{ $karya->jenis_publikasi == 'Prosiding di seminar nasional/wilayah' ? 'selected' : '' }}>5. Prosiding di seminar nasional/wilayah</option>
                            <option value="Prosiding tidak terindeks di seminar internasional" {{ $karya->jenis_publikasi == 'Prosiding tidak terindeks di seminar internasional' ? 'selected' : '' }}>6. Prosiding tidak terindeks di seminar internasional</option>
                            <option value="Prosiding terindeks Scopus / WoS di seminar internasional" {{ $karya->jenis_publikasi == 'Prosiding terindeks Scopus / WoS di seminar internasional' ? 'selected' : '' }}>7. Prosiding terindeks Scopus / WoS di seminar int.</option>
                            <option value="Pagelaran/pameran/presentasi dalam forum di tingkat wilayah" {{ $karya->jenis_publikasi == 'Pagelaran/pameran/presentasi dalam forum di tingkat wilayah' ? 'selected' : '' }}>8. Pagelaran/pameran/presentasi tingkat wilayah</option>
                            <option value="Pagelaran/pameran/presentasi dalam forum di tingkat nasional" {{ $karya->jenis_publikasi == 'Pagelaran/pameran/presentasi dalam forum di tingkat nasional' ? 'selected' : '' }}>9. Pagelaran/pameran/presentasi tingkat nasional</option>
                            <option value="Pagelaran/pameran/presentasi dalam forum di tingkat internasional" {{ $karya->jenis_publikasi == 'Pagelaran/pameran/presentasi dalam forum di tingkat internasional' ? 'selected' : '' }}>10. Pagelaran/pameran/presentasi tingkat internasional</option>
                        </select>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah TS-2</label>
                            <input type="number" name="jumlah_ts2" class="form-control rounded-3" value="{{ $karya->jumlah_ts2 }}" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah TS-1</label>
                            <input type="number" name="jumlah_ts1" class="form-control rounded-3" value="{{ $karya->jumlah_ts1 }}" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah TS</label>
                            <input type="number" name="jumlah_ts" class="form-control rounded-3" value="{{ $karya->jumlah_ts }}" min="0" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>