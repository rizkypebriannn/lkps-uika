<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 3.a.4 Basic Science - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <div class="container mt-5">
        <a href="{{ route('matkul_basic_science.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>

        <div class="card shadow-sm border-0 rounded-4 p-4 mb-5">
            <h5 class="fw-bold mb-4 border-bottom pb-2">Update Mata Kuliah Basic Science</h5>
            <form action="{{ route('matkul_basic_science.update', $matkul->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Mata Kuliah Basic Science / Matematika</label>
                        <input type="text" name="nama_mata_kuliah" class="form-control" value="{{ $matkul->nama_mata_kuliah }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Semester</label>
                        <input type="text" name="semester" class="form-control" value="{{ $matkul->semester }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Jumlah SKS</label>
                        <input type="number" name="jumlah_sks" class="form-control" value="{{ $matkul->jumlah_sks }}" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-warning px-4 py-2 rounded-pill fw-bold w-100">
                    <i class="bi bi-pencil-square me-2"></i>UPDATE DATA
                </button>
            </form>
        </div>
    </div>
</x-app-layout>