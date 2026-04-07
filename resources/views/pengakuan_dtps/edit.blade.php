<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 4.j Pengakuan DTPS - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('pengakuan_dtps.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Pengakuan/Rekognisi DTPS</h5>
                <form action="{{ route('pengakuan_dtps.update', $pengakuan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Nama DTPS</label>
                            <input type="text" name="nama_dtps" class="form-control rounded-3" value="{{ $pengakuan->nama_dtps }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Bidang Keahlian</label>
                            <input type="text" name="bidang_keahlian" class="form-control rounded-3" value="{{ $pengakuan->bidang_keahlian }}" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Rekognisi</label>
                            <input type="text" name="rekognisi" class="form-control rounded-3" value="{{ $pengakuan->rekognisi }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Bukti Pendukung</label>
                            <input type="text" name="bukti_pendukung" class="form-control rounded-3" value="{{ $pengakuan->bukti_pendukung }}" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Tingkat</label>
                            <select name="tingkat" class="form-select rounded-3" required>
                                <option value="Wilayah" {{ $pengakuan->tingkat == 'Wilayah' ? 'selected' : '' }}>Wilayah / Lokal</option>
                                <option value="Nasional" {{ $pengakuan->tingkat == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                <option value="Internasional" {{ $pengakuan->tingkat == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Tahun (YYYY)</label>
                            <input type="number" name="tahun" class="form-control rounded-3" value="{{ $pengakuan->tahun }}" required min="2000" max="{{ date('Y') }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA PENGAKUAN
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>