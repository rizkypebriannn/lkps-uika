<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 5.b Dokumen K3L - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('dokumen_k3l.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Dokumen K3L di UPPS</h5>
                <form action="{{ route('dokumen_k3l.update', $dokumen->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Jenis Dokumen K3L</label>
                        <input type="text" name="jenis_dokumen" class="form-control rounded-3" value="{{ $dokumen->jenis_dokumen }}" required>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah Dokumen</label>
                            <input type="number" name="jumlah" class="form-control rounded-3" min="1" value="{{ $dokumen->jumlah }}" required>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-semibold text-sm">Riwayat Pengesahan</label>
                            <input type="text" name="riwayat_pengesahan" class="form-control rounded-3" value="{{ $dokumen->riwayat_pengesahan }}" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA DOKUMEN K3L
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>