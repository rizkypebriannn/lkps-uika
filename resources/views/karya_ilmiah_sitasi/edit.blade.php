<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 4.i Sitasi Karya Ilmiah - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('karya_ilmiah_sitasi.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Sitasi Karya Ilmiah DTPS</h5>
                <form action="{{ route('karya_ilmiah_sitasi.update', $sitasi->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold text-sm">Nama DTPS</label>
                            <input type="text" name="nama_dtps" class="form-control rounded-3" value="{{ $sitasi->nama_dtps }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah Sitasi</label>
                            <input type="number" name="jumlah_sitasi" class="form-control rounded-3" value="{{ $sitasi->jumlah_sitasi }}" min="0" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Judul Artikel yang Disitasi</label>
                        <textarea name="judul_artikel" class="form-control rounded-3" rows="3" required>{{ $sitasi->judul_artikel }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA SITASI
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>