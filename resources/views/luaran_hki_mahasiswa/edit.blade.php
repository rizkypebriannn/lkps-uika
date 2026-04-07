<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 6.e.3 HKI Mahasiswa (Paten) - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('luaran_hki_mahasiswa.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Luaran HKI Mahasiswa</h5>
                
                <form action="{{ route('luaran_hki_mahasiswa.update', $hki->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Luaran Penelitian dan PkM</label>
                        <input type="text" name="luaran_penelitian" class="form-control rounded-3" value="{{ $hki->luaran_penelitian }}" required>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control rounded-3" value="{{ $hki->tanggal }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Status</label>
                            <select name="status" class="form-select rounded-3" required>
                                <option value="Registered" {{ $hki->status == 'Registered' ? 'selected' : '' }}>Registered (Terdaftar)</option>
                                <option value="Granted" {{ $hki->status == 'Granted' ? 'selected' : '' }}>Granted (Disetujui)</option>
                                <option value="Komersial" {{ $hki->status == 'Komersial' ? 'selected' : '' }}>Komersial (Sudah Dikomersialkan)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Nomor Registrasi/Paten</label>
                            <input type="text" name="nomor_registrasi" class="form-control rounded-3" value="{{ $hki->nomor_registrasi }}" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA HKI
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>