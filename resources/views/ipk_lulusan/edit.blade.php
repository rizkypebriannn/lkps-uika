<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 6.b IPK Lulusan - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('ipk_lulusan.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update IPK Lulusan</h5>
                <form action="{{ route('ipk_lulusan.update', $ipk->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Tahun Lulus</label>
                            <input type="text" class="form-control rounded-3" value="{{ $ipk->tahun_lulus }}" disabled>
                            <!-- Kita disabled supaya tahun lulusnya nggak diubah-ubah saat edit -->
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-semibold text-sm">Jumlah Lulusan</label>
                            <input type="number" name="jumlah_lulusan" class="form-control rounded-3" value="{{ $ipk->jumlah_lulusan }}" min="0" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">IPK Minimum</label>
                            <input type="number" step="0.01" name="ipk_min" class="form-control rounded-3" value="{{ $ipk->ipk_min }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">IPK Rata-rata</label>
                            <input type="number" step="0.01" name="ipk_rata" class="form-control rounded-3" value="{{ $ipk->ipk_rata }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">IPK Maksimum</label>
                            <input type="number" step="0.01" name="ipk_maks" class="form-control rounded-3" value="{{ $ipk->ipk_maks }}" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA IPK
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>