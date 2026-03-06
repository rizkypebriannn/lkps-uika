<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 6.a Jumlah Mahasiswa - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Data Jumlah Mahasiswa</h5>
                <form action="{{ route('jumlah_mahasiswa.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold text-sm">Nama Program Studi</label>
                            <input type="text" name="program_studi" class="form-control rounded-3" value="{{ auth()->user()->prodi->nama_prodi ?? '' }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Prodi yang Diakreditasi?</label>
                            <select name="is_diakreditasi" class="form-select rounded-3" required>
                                <option value="Ya">Ya (Centang V)</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <div class="p-3 border rounded-3 bg-light">
                                <h6 class="fw-bold mb-3 text-primary"><i class="bi bi-people-fill me-2"></i>Mahasiswa Aktif</h6>
                                <div class="mb-2">
                                    <label class="form-label text-sm mb-1">TS-2</label>
                                    <input type="number" name="aktif_ts2" class="form-control form-control-sm" value="0" min="0" required>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label text-sm mb-1">TS-1</label>
                                    <input type="number" name="aktif_ts1" class="form-control form-control-sm" value="0" min="0" required>
                                </div>
                                <div>
                                    <label class="form-label text-sm mb-1">TS</label>
                                    <input type="number" name="aktif_ts" class="form-control form-control-sm" value="0" min="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded-3 bg-light">
                                <h6 class="fw-bold mb-3 text-success"><i class="bi bi-globe me-2"></i>Mhs Asing (Full-Time)</h6>
                                <div class="mb-2">
                                    <label class="form-label text-sm mb-1">TS-2</label>
                                    <input type="number" name="asing_ft_ts2" class="form-control form-control-sm" value="0" min="0" required>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label text-sm mb-1">TS-1</label>
                                    <input type="number" name="asing_ft_ts1" class="form-control form-control-sm" value="0" min="0" required>
                                </div>
                                <div>
                                    <label class="form-label text-sm mb-1">TS</label>
                                    <input type="number" name="asing_ft_ts" class="form-control form-control-sm" value="0" min="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded-3 bg-light">
                                <h6 class="fw-bold mb-3 text-warning"><i class="bi bi-globe me-2"></i>Mhs Asing (Part-Time)</h6>
                                <div class="mb-2">
                                    <label class="form-label text-sm mb-1">TS-2</label>
                                    <input type="number" name="asing_pt_ts2" class="form-control form-control-sm" value="0" min="0" required>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label text-sm mb-1">TS-1</label>
                                    <input type="number" name="asing_pt_ts1" class="form-control form-control-sm" value="0" min="0" required>
                                </div>
                                <div>
                                    <label class="form-label text-sm mb-1">TS</label>
                                    <input type="number" name="asing_pt_ts" class="form-control form-control-sm" value="0" min="0" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Daftar Data Tersimpan ({{ $mahasiswas->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm align-middle text-center" style="font-size: 0.85rem;">
                        <thead class="table-light">
                            <tr>
                                <th rowspan="2" class="align-middle">No</th>
                                <th rowspan="2" class="align-middle text-start">Program Studi</th>
                                <th rowspan="2" class="align-middle">Diakreditasi</th>
                                <th colspan="3">Mhs Aktif</th>
                                <th colspan="3">Mhs Asing (Full-Time)</th>
                                <th colspan="3">Mhs Asing (Part-Time)</th>
                                <th rowspan="2" class="align-middle">Hapus</th>
                            </tr>
                            <tr>
                                <th>TS-2</th><th>TS-1</th><th>TS</th>
                                <th>TS-2</th><th>TS-1</th><th>TS</th>
                                <th>TS-2</th><th>TS-1</th><th>TS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mahasiswas as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start fw-bold">{{ $item->program_studi }}</td>
                                <td>{{ $item->is_diakreditasi == 'Ya' ? 'V' : '-' }}</td>
                                <td class="bg-light">{{ $item->aktif_ts2 }}</td><td class="bg-light">{{ $item->aktif_ts1 }}</td><td class="bg-light fw-bold">{{ $item->aktif_ts }}</td>
                                <td>{{ $item->asing_ft_ts2 }}</td><td>{{ $item->asing_ft_ts1 }}</td><td class="fw-bold">{{ $item->asing_ft_ts }}</td>
                                <td class="bg-light">{{ $item->asing_pt_ts2 }}</td><td class="bg-light">{{ $item->asing_pt_ts1 }}</td><td class="bg-light fw-bold">{{ $item->asing_pt_ts }}</td>
                                <td>
                                    <form action="{{ route('jumlah_mahasiswa.destroy', $item->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>