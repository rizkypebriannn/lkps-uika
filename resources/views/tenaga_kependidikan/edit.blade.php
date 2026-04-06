<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 4.b Tenaga Kependidikan - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('tenaga_kependidikan.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Data Tenaga Kependidikan</h5>
                <form action="{{ route('tenaga_kependidikan.update', $tenaga->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Nama Lengkap</label>
                            <input type="text" name="nama_tenaga_kependidikan" class="form-control rounded-3" value="{{ $tenaga->nama_tenaga_kependidikan }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Pendidikan Terakhir</label>
                            <select name="pendidikan_terakhir" class="form-select rounded-3" required>
                                <option value="SMA/SMK" {{ $tenaga->pendidikan_terakhir == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                <option value="D1" {{ $tenaga->pendidikan_terakhir == 'D1' ? 'selected' : '' }}>D1</option>
                                <option value="D2" {{ $tenaga->pendidikan_terakhir == 'D2' ? 'selected' : '' }}>D2</option>
                                <option value="D3" {{ $tenaga->pendidikan_terakhir == 'D3' ? 'selected' : '' }}>D3</option>
                                <option value="D4" {{ $tenaga->pendidikan_terakhir == 'D4' ? 'selected' : '' }}>D4</option>
                                <option value="S1" {{ $tenaga->pendidikan_terakhir == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ $tenaga->pendidikan_terakhir == 'S2' ? 'selected' : '' }}>S2</option>
                                <option value="S3" {{ $tenaga->pendidikan_terakhir == 'S3' ? 'selected' : '' }}>S3</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Sertifikat Kompetensi</label>
                            <input type="text" name="sertifikat_kompetensi" class="form-control rounded-3" value="{{ $tenaga->sertifikat_kompetensi }}" placeholder="Kosongkan jika tidak ada">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Unit Kerja</label>
                            <input type="text" name="unit_kerja" class="form-control rounded-3" value="{{ $tenaga->unit_kerja }}" required>
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