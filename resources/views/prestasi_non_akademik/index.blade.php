<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 6.c.2 Prestasi Non-akademik - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
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
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Prestasi Non-akademik Mahasiswa</h5>
                <form action="{{ route('prestasi_non_akademik.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" class="form-control rounded-3" placeholder="Contoh: Kejuaraan Pencak Silat, Lomba Paduan Suara..." required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Waktu Perolehan</label>
                            <input type="date" name="waktu_perolehan" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Tingkat</label>
                            <select name="tingkat" class="form-select rounded-3" required>
                                <option value="" disabled selected>Pilih Tingkat...</option>
                                <option value="Lokal/Wilayah">Lokal/Wilayah</option>
                                <option value="Nasional">Nasional</option>
                                <option value="Internasional">Internasional</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Prestasi yang Dicapai</label>
                        <input type="text" name="prestasi_dicapai" class="form-control rounded-3" placeholder="Contoh: Juara 1, Medali Perak, Best Player..." required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA PRESTASI
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Daftar Prestasi Tersimpan ({{ $prestasis->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th class="text-start">Nama Kegiatan</th>
                                <th>Waktu Perolehan</th>
                                <th>Tingkat</th>
                                <th>Prestasi yang Dicapai</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prestasis as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start fw-bold">{{ $item->nama_kegiatan }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->waktu_perolehan)->format('d/m/Y') }}</td>
                                <td>
                                    @if($item->tingkat == 'Lokal/Wilayah') <span class="badge bg-secondary">Lokal/Wilayah</span>
                                    @elseif($item->tingkat == 'Nasional') <span class="badge bg-info text-dark">Nasional</span>
                                    @else <span class="badge bg-success">Internasional</span>
                                    @endif
                                </td>
                                <td>{{ $item->prestasi_dicapai }}</td>
                                <td>
                                    <form action="{{ route('prestasi_non_akademik.destroy', $item->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @if($prestasis->isEmpty())
                            <tr>
                                <td colspan="6" class="text-muted py-3">Belum ada data prestasi non-akademik.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>