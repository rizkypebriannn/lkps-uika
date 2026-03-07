<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 6.f.2 Kesesuaian Bidang Kerja Lulusan - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Kesesuaian Bidang Kerja Lulusan</h5>
                
                <form action="{{ route('kesesuaian_bidang_kerja.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Tahun Lulus</label>
                            <input type="text" name="tahun_lulus" class="form-control rounded-3" placeholder="Contoh: TS-2" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah Lulusan</label>
                            <input type="number" name="jumlah_lulusan" class="form-control rounded-3" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jml Lulusan Terlacak</label>
                            <input type="number" name="jumlah_lulusan_terlacak" class="form-control rounded-3" min="0" required>
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded-3 mb-4 border">
                        <label class="form-label fw-bold text-sm text-primary mb-3"><i class="bi bi-briefcase-fill me-2"></i>Tingkat Kesesuaian Bidang Kerja</label>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-sm">Rendah</label>
                                <input type="number" name="kesesuaian_rendah" class="form-control rounded-3" min="0" value="0" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-sm">Sedang</label>
                                <input type="number" name="kesesuaian_sedang" class="form-control rounded-3" min="0" value="0" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-sm">Tinggi</label>
                                <input type="number" name="kesesuaian_tinggi" class="form-control rounded-3" min="0" value="0" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA KESESUAIAN KERJA
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Data Kesesuaian Kerja Tersimpan ({{ $data->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th rowspan="2" class="align-middle">Tahun Lulus</th>
                                <th rowspan="2" class="align-middle">Jumlah Lulusan</th>
                                <th rowspan="2" class="align-middle">Jml Lulusan Terlacak</th>
                                <th colspan="3">Tingkat Kesesuaian Bidang Kerja</th>
                                <th rowspan="2" class="align-middle">Hapus</th>
                            </tr>
                            <tr>
                                <th>Rendah</th>
                                <th>Sedang</th>
                                <th>Tinggi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $item)
                            <tr>
                                <td class="fw-bold">{{ $item->tahun_lulus }}</td>
                                <td>{{ $item->jumlah_lulusan }}</td>
                                <td>{{ $item->jumlah_lulusan_terlacak }}</td>
                                <td>{{ $item->kesesuaian_rendah }}</td>
                                <td>{{ $item->kesesuaian_sedang }}</td>
                                <td>{{ $item->kesesuaian_tinggi }}</td>
                                <td>
                                    <form action="{{ route('kesesuaian_bidang_kerja.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-muted py-3">Belum ada data Kesesuaian Bidang Kerja yang diinput.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>