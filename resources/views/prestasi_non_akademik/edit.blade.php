<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 6.c.2 Prestasi Non-akademik - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('prestasi_non_akademik.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Prestasi Non-akademik Mahasiswa</h5>
                <form action="{{ route('prestasi_non_akademik.update', $prestasi->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" class="form-control rounded-3" value="{{ $prestasi->nama_kegiatan }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Waktu Perolehan</label>
                            <input type="date" name="waktu_perolehan" class="form-control rounded-3" value="{{ \Carbon\Carbon::parse($prestasi->waktu_perolehan)->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Tingkat</label>
                            <select name="tingkat" class="form-select rounded-3" required>
                                <option value="Lokal/Wilayah" {{ $prestasi->tingkat == 'Lokal/Wilayah' ? 'selected' : '' }}>Lokal/Wilayah</option>
                                <option value="Nasional" {{ $prestasi->tingkat == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                <option value="Internasional" {{ $prestasi->tingkat == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Prestasi yang Dicapai</label>
                        <input type="text" name="prestasi_dicapai" class="form-control rounded-3" value="{{ $prestasi->prestasi_dicapai }}" required>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA PRESTASI
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>