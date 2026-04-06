<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 3.a.3 Integrasi Kegiatan - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <div class="container mt-5">
        <a href="{{ route('integrasi_pembelajaran.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>

        <div class="card shadow-sm border-0 rounded-4 p-4 mb-5">
            <h5 class="fw-bold mb-4 border-bottom pb-2">Update Data Integrasi</h5>
            <form action="{{ route('integrasi_pembelajaran.update', $integrasi->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Nama Dosen</label>
                        <input type="text" name="nama_dosen" class="form-control" value="{{ $integrasi->nama_dosen }}" required>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Judul Penelitian/PkM</label>
                        <input type="text" name="judul_kegiatan" class="form-control" value="{{ $integrasi->judul_kegiatan }}" required>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Mata Kuliah</label>
                        <input type="text" name="mata_kuliah" class="form-control" value="{{ $integrasi->mata_kuliah }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Bentuk Integrasi</label>
                        <input type="text" name="bentuk_integrasi" class="form-control" value="{{ $integrasi->bentuk_integrasi }}" required>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold d-block">Tahun Kegiatan</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">TS-2</span>
                            <input type="text" name="tahun_ts2" class="form-control" value="{{ $integrasi->tahun_ts2 }}">
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">TS-1</span>
                            <input type="text" name="tahun_ts1" class="form-control" value="{{ $integrasi->tahun_ts1 }}">
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">TS</span>
                            <input type="text" name="tahun_ts" class="form-control" value="{{ $integrasi->tahun_ts }}">
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Kesesuaian dengan Peta Jalan</label>
                                <select name="kesesuaian_peta_jalan" class="form-select" required>
                                    <option value="Sesuai" {{ $integrasi->kesesuaian_peta_jalan == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                                    <option value="Tidak Sesuai" {{ $integrasi->kesesuaian_peta_jalan == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Kesesuaian dengan RPS</label>
                                <select name="kesesuaian_rps" class="form-select" required>
                                    <option value="Sesuai" {{ $integrasi->kesesuaian_rps == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                                    <option value="Tidak Sesuai" {{ $integrasi->kesesuaian_rps == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label fw-semibold">Bukti Sahih (Link)</label>
                                <input type="url" name="bukti_sahih" class="form-control" value="{{ $integrasi->bukti_sahih }}">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-warning px-4 py-2 rounded-pill w-100 fw-bold">
                    <i class="bi bi-pencil-square me-2"></i>UPDATE DATA INTEGRASI
                </button>
            </form>
        </div>
    </div>
</x-app-layout>