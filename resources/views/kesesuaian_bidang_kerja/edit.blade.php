<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 6.f.2 Kesesuaian Bidang Kerja Lulusan - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('kesesuaian_bidang_kerja.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Kesesuaian Bidang Kerja Lulusan</h5>
                
                <form action="{{ route('kesesuaian_bidang_kerja.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Tahun Lulus</label>
                            <input type="text" name="tahun_lulus" class="form-control rounded-3" value="{{ $data->tahun_lulus }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah Lulusan</label>
                            <input type="number" name="jumlah_lulusan" class="form-control rounded-3" value="{{ $data->jumlah_lulusan }}" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jml Lulusan Terlacak</label>
                            <input type="number" name="jumlah_lulusan_terlacak" class="form-control rounded-3" value="{{ $data->jumlah_lulusan_terlacak }}" min="0" required>
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded-3 mb-4 border">
                        <label class="form-label fw-bold text-sm text-primary mb-3"><i class="bi bi-briefcase-fill me-2"></i>Tingkat Kesesuaian Bidang Kerja</label>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-sm">Rendah</label>
                                <input type="number" name="kesesuaian_rendah" class="form-control rounded-3" value="{{ $data->kesesuaian_rendah }}" min="0" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-sm">Sedang</label>
                                <input type="number" name="kesesuaian_sedang" class="form-control rounded-3" value="{{ $data->kesesuaian_sedang }}" min="0" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-sm">Tinggi</label>
                                <input type="number" name="kesesuaian_tinggi" class="form-control rounded-3" value="{{ $data->kesesuaian_tinggi }}" min="0" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA KESESUAIAN KERJA
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>