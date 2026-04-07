<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 5.c Fasilitas K3L - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('fasilitas_k3l.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Fasilitas K3L di UPPS</h5>
                <form action="{{ route('fasilitas_k3l.update', $fasilitas->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Nama Sarana</label>
                            <input type="text" name="nama_sarana" class="form-control rounded-3" value="{{ $fasilitas->nama_sarana }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Fungsi</label>
                            <input type="text" name="fungsi" class="form-control rounded-3" value="{{ $fasilitas->fungsi }}" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold text-sm">Jumlah Unit</label>
                            <input type="number" name="jumlah_unit" class="form-control rounded-3" min="1" value="{{ $fasilitas->jumlah_unit }}" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold text-sm">Kondisi</label>
                            <select name="kondisi" class="form-select rounded-3" required>
                                <option value="Terawat" {{ $fasilitas->kondisi == 'Terawat' ? 'selected' : '' }}>Terawat</option>
                                <option value="Tidak Terawat" {{ $fasilitas->kondisi == 'Tidak Terawat' ? 'selected' : '' }}>Tidak Terawat</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA FASILITAS K3L
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>