<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 4.f Teknologi/Produk - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('luaran_teknologi_produk.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Luaran (Teknologi Tepat Guna, Produk, Karya Seni)</h5>
                <form action="{{ route('luaran_teknologi_produk.update', $produk->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Judul Luaran (Teknologi/Produk/Karya)</label>
                        <textarea name="judul_luaran" class="form-control rounded-3" rows="2" required>{{ $produk->judul_luaran }}</textarea>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Tahun</label>
                            <input type="number" name="tahun" class="form-control rounded-3" value="{{ $produk->tahun }}" required min="2000" max="{{ date('Y') }}">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-semibold text-sm">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control rounded-3" value="{{ $produk->keterangan }}" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA PRODUK
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>