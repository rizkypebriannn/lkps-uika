<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 4.h Kinerja DTPS - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('kinerja_dtps.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Kinerja DTPS</h5>
                <form action="{{ route('kinerja_dtps.update', $kinerja->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Nama DTPS</label>
                        <input type="text" name="nama_dtps" class="form-control rounded-3" value="{{ $kinerja->nama_dtps }}" required>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jurnal/Paten TS-2</label>
                            <input type="number" name="jumlah_ts2" class="form-control rounded-3" value="{{ $kinerja->jumlah_ts2 }}" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jurnal/Paten TS-1</label>
                            <input type="number" name="jumlah_ts1" class="form-control rounded-3" value="{{ $kinerja->jumlah_ts1 }}" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jurnal/Paten TS</label>
                            <input type="number" name="jumlah_ts" class="form-control rounded-3" value="{{ $kinerja->jumlah_ts }}" min="0" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control rounded-3" value="{{ $kinerja->keterangan }}">
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA KINERJA
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>