<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 3.a.5 Capstone Design - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('capstone_design.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Mata Kuliah Capstone Design</h5>
                <form action="{{ route('capstone_design.update', $capstone->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-9">
                            <label class="form-label fw-semibold">Nama Mata Kuliah Pendukung</label>
                            <input type="text" name="mk_pendukung" class="form-control" value="{{ $capstone->mk_pendukung }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Jumlah SKS Pendukung</label>
                            <input type="number" name="sks_pendukung" class="form-control" value="{{ $capstone->sks_pendukung }}" required>
                        </div>
                    </div>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Nama Mata Kuliah Capstone Design</label>
                            <input type="text" name="mk_capstone" class="form-control" value="{{ $capstone->mk_capstone }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Jumlah SKS Capstone</label>
                            <input type="number" name="sks_capstone" class="form-control" value="{{ $capstone->sks_capstone }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Semester</label>
                            <input type="text" name="semester" class="form-control" value="{{ $capstone->semester }}" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Cakupan Bahasan</label>
                        <textarea name="cakupan_bahasan" class="form-control" rows="3" required>{{ $capstone->cakupan_bahasan }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-warning px-4 py-2 rounded-pill fw-bold w-100 shadow-sm">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>