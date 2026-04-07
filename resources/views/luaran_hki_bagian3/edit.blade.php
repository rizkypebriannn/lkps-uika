<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 6.e.3-3 Teknologi Tepat Guna, Produk - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('luaran_hki_bagian3.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Luaran Bagian-3 (Teknologi Tepat Guna, Produk)</h5>
                
                <form action="{{ route('luaran_hki_bagian3.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Luaran Penelitian dan PkM</label>
                        <input type="text" name="luaran_penelitian" class="form-control rounded-3" value="{{ $data->luaran_penelitian }}" required>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control rounded-3" value="{{ $data->tanggal }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Status (Tingkat Kesiapan Teknologi)</label>
                            <input type="text" name="status" class="form-control rounded-3" value="{{ $data->status }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Nomor Sertifikat TKT</label>
                            <input type="text" name="nomor_sertifikat" class="form-control rounded-3" value="{{ $data->nomor_sertifikat }}" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA TEKNOLOGI
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>