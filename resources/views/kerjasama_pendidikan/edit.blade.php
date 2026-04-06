<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 2.a.1 Kerjasama Pendidikan - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('kerjasama_pendidikan.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Kerjasama Pendidikan</h5>
                
                <form action="{{ route('kerjasama_pendidikan.update', $kerjasama->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Lembaga Mitra</label>
                            <input type="text" name="lembaga_mitra" class="form-control" value="{{ $kerjasama->lembaga_mitra }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Tingkat</label>
                            <select name="tingkat" class="form-select" required>
                                <option value="Internasional" {{ $kerjasama->tingkat == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                                <option value="Nasional" {{ $kerjasama->tingkat == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                <option value="Lokal/Wilayah" {{ $kerjasama->tingkat == 'Lokal/Wilayah' ? 'selected' : '' }}>Lokal/Wilayah</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Status Kerjasama</label>
                            <input type="text" name="status_kerjasama" class="form-control" value="{{ $kerjasama->status_kerjasama }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Judul Kegiatan</label>
                            <textarea name="judul_kegiatan" class="form-control" rows="2" required>{{ $kerjasama->judul_kegiatan }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Manfaat</label>
                            <textarea name="manfaat" class="form-control" rows="2" required>{{ $kerjasama->manfaat }}</textarea>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Tanggal Awal</label>
                            <input type="date" name="tanggal_awal" class="form-control" value="{{ $kerjasama->tanggal_awal }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" class="form-control" value="{{ $kerjasama->tanggal_akhir }}" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Durasi (Tahun)</label>
                            <input type="number" name="durasi" class="form-control" value="{{ $kerjasama->durasi }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Link Bukti (Opsional)</label>
                            <input type="url" name="bukti_kerjasama" class="form-control" value="{{ $kerjasama->bukti_kerjasama }}">
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