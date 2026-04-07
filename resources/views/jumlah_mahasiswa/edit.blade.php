<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 6.a Jumlah Mahasiswa - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('jumlah_mahasiswa.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 p-4 mb-5">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Data Mahasiswa</h5>
                <form action="{{ route('jumlah_mahasiswa.update', $mahasiswa->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Program Studi</label>
                        <input type="text" name="program_studi" class="form-control" value="{{ $mahasiswa->program_studi }}" required>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light">
                                <label class="form-label fw-semibold text-primary">Mahasiswa Aktif</label>
                                <input type="number" name="aktif_ts2" class="form-control mb-2" value="{{ $mahasiswa->aktif_ts2 }}" required>
                                <input type="number" name="aktif_ts1" class="form-control mb-2" value="{{ $mahasiswa->aktif_ts1 }}" required>
                                <input type="number" name="aktif_ts" class="form-control" value="{{ $mahasiswa->aktif_ts }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light">
                                <label class="form-label fw-semibold text-success">Mhs. Asing (Full-Time)</label>
                                <input type="number" name="asing_ft_ts2" class="form-control mb-2" value="{{ $mahasiswa->asing_ft_ts2 }}">
                                <input type="number" name="asing_ft_ts1" class="form-control mb-2" value="{{ $mahasiswa->asing_ft_ts1 }}">
                                <input type="number" name="asing_ft_ts" class="form-control" value="{{ $mahasiswa->asing_ft_ts }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light">
                                <label class="form-label fw-semibold text-warning">Mhs. Asing (Part-Time)</label>
                                <input type="number" name="asing_pt_ts2" class="form-control mb-2" value="{{ $mahasiswa->asing_pt_ts2 }}">
                                <input type="number" name="asing_pt_ts1" class="form-control mb-2" value="{{ $mahasiswa->asing_pt_ts1 }}">
                                <input type="number" name="asing_pt_ts" class="form-control" value="{{ $mahasiswa->asing_pt_ts }}">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA MAHASISWA
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>