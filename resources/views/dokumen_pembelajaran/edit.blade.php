<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 3.a.2 Mata Kuliah dan Dokumen Pembelajaran') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <div class="container mt-5">
        <a href="{{ route('dokumen_pembelajaran.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>

        <div class="card shadow-sm border-0 rounded-4 p-4 mb-5">
            <h5 class="fw-bold mb-4 border-bottom pb-2">Update Data Mata Kuliah</h5>
            <form action="{{ route('dokumen_pembelajaran.update', $dokumen->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row g-3 mb-4">
                    <div class="col-md-7">
                        <label class="form-label fw-semibold">Nama Mata Kuliah</label>
                        <input type="text" name="mata_kuliah" class="form-control" value="{{ $dokumen->mata_kuliah }}" required>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-semibold">Kelengkapan Dokumen RPS</label>
                        <input type="url" name="dokumen_rps" class="form-control" value="{{ $dokumen->dokumen_rps }}" placeholder="Isi Link Google Drive RPS (Opsional)">
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Bobot (SKS)</label>
                        <input type="number" name="bobot_sks" class="form-control" value="{{ $dokumen->bobot_sks }}" required>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Konversi Kredit ke Jam</label>
                        <div class="d-flex gap-3">
                            <div class="input-group">
                                <span class="input-group-text">Teori</span>
                                <input type="number" name="konversi_teori" class="form-control" value="{{ $dokumen->konversi_teori }}">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Praktik</span>
                                <input type="number" name="konversi_praktik" class="form-control" value="{{ $dokumen->konversi_praktik }}">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-warning px-4 py-2 rounded-pill fw-bold w-100">
                    <i class="bi bi-pencil-square me-2"></i>UPDATE DATA
                </button>
            </form>
        </div>
    </div>
</x-app-layout>