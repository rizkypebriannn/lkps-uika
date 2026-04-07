<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 4.k Pembimbing Lapangan - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('pembimbing_lapangan.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Pembimbing Lapangan (Program Profesi Insinyur)</h5>
                <form action="{{ route('pembimbing_lapangan.update', $pembimbing->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Nama Pembimbing</label>
                            <input type="text" name="nama" class="form-control rounded-3" value="{{ $pembimbing->nama }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Industri Asal</label>
                            <input type="text" name="industri" class="form-control rounded-3" value="{{ $pembimbing->industri }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Bidang Keinsinyuran</label>
                            <input type="text" name="bidang_keinsinyuran" class="form-control rounded-3" value="{{ $pembimbing->bidang_keinsinyuran }}" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Pengalaman Kerja (Tahun)</label>
                            <input type="number" name="pengalaman_kerja" class="form-control rounded-3" min="0" value="{{ $pembimbing->pengalaman_kerja }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Pendidikan Tinggi</label>
                            <input type="text" name="pendidikan_tinggi" class="form-control rounded-3" value="{{ $pembimbing->pendidikan_tinggi }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Kategori SIP</label>
                            <select name="kategori_sip" class="form-select rounded-3" required>
                                <option value="IPM" {{ $pembimbing->kategori_sip == 'IPM' ? 'selected' : '' }}>IPM (Insinyur Profesional Madya)</option>
                                <option value="IPU" {{ $pembimbing->kategori_sip == 'IPU' ? 'selected' : '' }}>IPU (Insinyur Profesional Utama)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Nomor SIP</label>
                            <input type="text" name="nomor_sip" class="form-control rounded-3" value="{{ $pembimbing->nomor_sip }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Tanggal Berakhir SIP</label>
                            <input type="date" name="tanggal_berakhir_sip" class="form-control rounded-3" value="{{ \Carbon\Carbon::parse($pembimbing->tanggal_berakhir_sip)->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah Bimbingan (3 Thn)</label>
                            <input type="number" name="jumlah_bimbingan" class="form-control rounded-3" min="0" value="{{ $pembimbing->jumlah_bimbingan }}" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA PEMBIMBING
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>