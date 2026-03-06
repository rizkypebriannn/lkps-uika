<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 4.b Tenaga Kependidikan - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Data Laboran / Teknisi / Admin</h5>
                <form action="{{ route('tenaga_kependidikan.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Nama Lengkap</label>
                            <input type="text" name="nama_tenaga_kependidikan" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Pendidikan Terakhir</label>
                            <select name="pendidikan_terakhir" class="form-select rounded-3" required>
                                <option value="SMA/SMK">SMA/SMK</option>
                                <option value="D1">D1</option>
                                <option value="D2">D2</option>
                                <option value="D3">D3</option>
                                <option value="D4">D4</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Sertifikat Kompetensi</label>
                            <input type="text" name="sertifikat_kompetensi" class="form-control rounded-3" placeholder="Kosongkan jika tidak ada">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Unit Kerja</label>
                            <input type="text" name="unit_kerja" class="form-control rounded-3" placeholder="Contoh: Lab Komputer" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Daftar Tenaga Kependidikan ({{ $tenagas->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nama</th>
                                <th>Pendidikan</th>
                                <th>Sertifikat</th>
                                <th>Unit Kerja</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tenagas as $item)
                            <tr>
                                <td class="fw-bold">{{ $item->nama_tenaga_kependidikan }}</td>
                                <td>{{ $item->pendidikan_terakhir }}</td>
                                <td>{{ $item->sertifikat_kompetensi ?? '-' }}</td>
                                <td>{{ $item->unit_kerja }}</td>
                                <td>
                                    <form action="{{ route('tenaga_kependidikan.destroy', $item->id) }}" method="POST">
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