<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Mata Kuliah - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <div class="container mt-5">
        <a href="{{ route('kurikulum.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>

        <div class="card card-custom p-4 shadow-sm border-0 rounded-4">
            <h5 class="fw-bold mb-4 border-bottom pb-2">Update Data Mata Kuliah</h5>
            <form action="{{ route('kurikulum.update', $kurikulum->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row g-3 mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Semester</label>
                        <input type="number" name="semester" class="form-control" value="{{ $kurikulum->semester }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Kode MK</label>
                        <input type="text" name="kode_mk" class="form-control" value="{{ $kurikulum->kode_mk }}" required>
                    </div>
                    <div class="col-md-7">
                        <label class="form-label fw-semibold">Nama Mata Kuliah</label>
                        <input type="text" name="nama_mk" class="form-control" value="{{ $kurikulum->nama_mk }}" required>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-primary">Bobot SKS</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Kuliah</span>
                            <input type="number" name="sks_kuliah" class="form-control" value="{{ $kurikulum->sks_kuliah }}">
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Seminar</span>
                            <input type="number" name="sks_seminar" class="form-control" value="{{ $kurikulum->sks_seminar }}">
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">Praktikum</span>
                            <input type="number" name="sks_praktikum" class="form-control" value="{{ $kurikulum->sks_praktikum }}">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Kelengkapan Lain</label>
                        <input type="text" name="unit_penyelenggara" class="form-control mb-2" value="{{ $kurikulum->unit_penyelenggara }}">
                        <input type="url" name="dokumen_rps" class="form-control mb-3" value="{{ $kurikulum->dokumen_rps }}">
                        
                        <div class="form-check form-switch fs-5 mt-2">
                            <input class="form-check-input" type="checkbox" name="is_mk_kompetensi" id="mkKompetensi" value="1" {{ $kurikulum->is_mk_kompetensi ? 'checked' : '' }}>
                            <label class="form-check-label fs-6 mt-1" for="mkKompetensi">Ini adalah Mata Kuliah Kompetensi</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-warning px-5 py-3 rounded-pill fw-bold w-100 shadow-sm">
                    <i class="bi bi-pencil-square me-2"></i>UPDATE MATA KULIAH
                </button>
            </form>
        </div>
    </div>
</x-app-layout>