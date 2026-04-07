<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 6.h.2 Penelitian DTPS Rujukan Tesis/Disertasi - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('penelitian_dtps_rujukan.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Penelitian DTPS Rujukan Tesis/Disertasi</h5>
                
                <form action="{{ route('penelitian_dtps_rujukan.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Nama Dosen</label>
                            <input type="text" name="nama_dosen" class="form-control rounded-3" value="{{ $data->nama_dosen }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Nama Mahasiswa</label>
                            <input type="text" name="nama_mahasiswa" class="form-control rounded-3" value="{{ $data->nama_mahasiswa }}" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Tema Penelitian sesuai Roadmap</label>
                        <input type="text" name="tema_penelitian" class="form-control rounded-3" value="{{ $data->tema_penelitian }}" required>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-9">
                            <label class="form-label fw-semibold text-sm">Judul Tesis / Disertasi</label>
                            <input type="text" name="judul_tesis" class="form-control rounded-3" value="{{ $data->judul_tesis }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Tahun (YYYY)</label>
                            <input type="text" name="tahun" class="form-control rounded-3" value="{{ $data->tahun }}" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA RUJUKAN TESIS
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>