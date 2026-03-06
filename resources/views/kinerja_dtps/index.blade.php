<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 4.h Kinerja DTPS - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
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
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Kinerja DTPS (Mendukung Keunggulan Kompetitif)</h5>
                <form action="{{ route('kinerja_dtps.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Nama DTPS</label>
                        <input type="text" name="nama_dtps" class="form-control rounded-3" placeholder="Nama dosen..." required>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jurnal/Paten TS-2</label>
                            <input type="number" name="jumlah_ts2" class="form-control rounded-3" value="0" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jurnal/Paten TS-1</label>
                            <input type="number" name="jumlah_ts1" class="form-control rounded-3" value="0" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jurnal/Paten TS</label>
                            <input type="number" name="jumlah_ts" class="form-control rounded-3" value="0" min="0" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control rounded-3" placeholder="Keterangan tambahan (Opsional)">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Daftar Kinerja DTPS Tersimpan ({{ $kinerjas->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th class="text-start">Nama DTPS</th>
                                <th>TS-2</th>
                                <th>TS-1</th>
                                <th>TS</th>
                                <th>Keterangan</th>
                                <th class="text-primary">Jumlah Publikasi</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kinerjas as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start fw-bold">{{ $item->nama_dtps }}</td>
                                <td>{{ $item->jumlah_ts2 }}</td>
                                <td>{{ $item->jumlah_ts1 }}</td>
                                <td>{{ $item->jumlah_ts }}</td>
                                <td>{{ $item->keterangan ?? '-' }}</td>
                                <td class="fw-bold text-primary">{{ $item->jumlah_publikasi }}</td>
                                <td>
                                    <form action="{{ route('kinerja_dtps.destroy', $item->id) }}" method="POST">
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