<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 6.d Masa Studi Lulusan - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('masa_studi_lulusan.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Masa Studi Lulusan</h5>
                
                <form action="{{ route('masa_studi_lulusan.update', $masa_studi->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Tahun Masuk</label>
                            <select name="tahun_masuk" class="form-select rounded-3" required>
                                @foreach(['TS-7', 'TS-6', 'TS-5', 'TS-4', 'TS-3', 'TS-2', 'TS-1', 'TS'] as $tahun)
                                    <option value="{{ $tahun }}" {{ $masa_studi->tahun_masuk == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm text-primary">Jumlah Mahasiswa Masuk</label>
                            <input type="number" name="jumlah_masuk" class="form-control rounded-3" value="{{ $masa_studi->jumlah_masuk }}" min="0" required>
                        </div>
                    </div>

                    <h6 class="fw-bold mb-3 border-bottom pb-2">Jumlah Mahasiswa Lulus berdasarkan Masa Studi (MS)</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label class="form-label text-sm">3,5 < MS ≤ 4,5 Tahun</label>
                            <input type="number" name="lulus_3_5" class="form-control rounded-3" value="{{ $masa_studi->lulus_3_5 ?? 0 }}" min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-sm">4,5 < MS ≤ 5,5 Tahun</label>
                            <input type="number" name="lulus_4_5" class="form-control rounded-3" value="{{ $masa_studi->lulus_4_5 ?? 0 }}" min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-sm">5,5 < MS ≤ 6,5 Tahun</label>
                            <input type="number" name="lulus_5_5" class="form-control rounded-3" value="{{ $masa_studi->lulus_5_5 ?? 0 }}" min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-sm">6,5 < MS ≤ 8 Tahun</label>
                            <input type="number" name="lulus_6_5" class="form-control rounded-3" value="{{ $masa_studi->lulus_6_5 ?? 0 }}" min="0">
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