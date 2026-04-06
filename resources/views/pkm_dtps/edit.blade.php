<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 3.c PkM DTPS - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('pkm_dtps.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Jumlah Judul PkM DTPS</h5>
                <form action="{{ route('pkm_dtps.update', $pkm->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Sumber Pembiayaan</label>
                        <select name="sumber_pembiayaan" class="form-select rounded-3" required>
                            <option value="Perguruan Tinggi dan Mandiri" {{ $pkm->sumber_pembiayaan == 'Perguruan Tinggi dan Mandiri' ? 'selected' : '' }}>a) Perguruan Tinggi dan Mandiri</option>
                            <option value="Lembaga Dalam Negeri (diluar PT)" {{ $pkm->sumber_pembiayaan == 'Lembaga Dalam Negeri (diluar PT)' ? 'selected' : '' }}>b) Lembaga Dalam Negeri (diluar PT)</option>
                            <option value="Lembaga Luar Negeri" {{ $pkm->sumber_pembiayaan == 'Lembaga Luar Negeri' ? 'selected' : '' }}>c) Lembaga Luar Negeri</option>
                        </select>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah TS-2</label>
                            <input type="number" name="jumlah_ts2" class="form-control rounded-3" value="{{ $pkm->jumlah_ts2 }}" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah TS-1</label>
                            <input type="number" name="jumlah_ts1" class="form-control rounded-3" value="{{ $pkm->jumlah_ts1 }}" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah TS</label>
                            <input type="number" name="jumlah_ts" class="form-control rounded-3" value="{{ $pkm->jumlah_ts }}" min="0" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA PkM
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>