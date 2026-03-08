<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 6.h.2 Penelitian DTPS Rujukan Tesis/Disertasi - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
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
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Penelitian DTPS Rujukan Tesis/Disertasi</h5>
                
                <form action="{{ route('penelitian_dtps_rujukan.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Nama Dosen</label>
                            <input type="text" name="nama_dosen" class="form-control rounded-3" placeholder="Contoh: Dr. Budi Santoso..." required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Nama Mahasiswa</label>
                            <input type="text" name="nama_mahasiswa" class="form-control rounded-3" placeholder="Contoh: Siti Aminah..." required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Tema Penelitian sesuai Roadmap</label>
                        <input type="text" name="tema_penelitian" class="form-control rounded-3" placeholder="Contoh: Keamanan Siber Lanjut..." required>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-9">
                            <label class="form-label fw-semibold text-sm">Judul Tesis / Disertasi</label>
                            <input type="text" name="judul_tesis" class="form-control rounded-3" placeholder="Contoh: Analisis Kriptografi Kuantum..." required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Tahun (YYYY)</label>
                            <input type="text" name="tahun" class="form-control rounded-3" placeholder="Contoh: 2024" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA RUJUKAN TESIS
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Data Tersimpan ({{ $data->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%" class="text-start">Nama Dosen</th>
                                <th width="20%" class="text-start">Tema Penelitian</th>
                                <th width="15%" class="text-start">Nama Mahasiswa</th>
                                <th width="30%" class="text-start">Judul Tesis/Disertasi</th>
                                <th width="10%">Tahun</th>
                                <th width="5%">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start fw-bold">{{ $item->nama_dosen }}</td>
                                <td class="text-start" style="font-size: 0.85rem;">{{ $item->tema_penelitian }}</td>
                                <td class="text-start">{{ $item->nama_mahasiswa }}</td>
                                <td class="text-start" style="font-size: 0.85rem;">{{ $item->judul_tesis }}</td>
                                <td><span class="badge bg-secondary">{{ $item->tahun }}</span></td>
                                <td>
                                    <form action="{{ route('penelitian_dtps_rujukan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-muted py-3">Belum ada data yang diinput.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>