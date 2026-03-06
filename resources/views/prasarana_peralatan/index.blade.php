<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 5.a Prasarana & Peralatan - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
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
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Prasarana dan Peralatan Utama</h5>
                <form action="{{ route('prasarana_peralatan.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Nama Prasarana (Ruang/Lab)</label>
                            <input type="text" name="nama_prasarana" class="form-control rounded-3" placeholder="Contoh: Lab Komputer" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Jumlah Prasarana</label>
                            <input type="number" name="jumlah_prasarana" class="form-control rounded-3" min="1" value="1" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Nama Sarana / Alat / Peraga</label>
                            <input type="text" name="nama_sarana" class="form-control rounded-3" placeholder="Contoh: PC Desktop i7" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jml Alat (Standar Minimal)</label>
                            <input type="number" name="standar_minimal" class="form-control rounded-3" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jml Alat (Dimiliki UPPS)</label>
                            <input type="number" name="dimiliki_upps" class="form-control rounded-3" min="0" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Kepemilikan</label>
                            <select name="kepemilikan" class="form-select rounded-3" required>
                                <option value="" disabled selected>Pilih...</option>
                                <option value="Sendiri">Sendiri</option>
                                <option value="Sewa">Sewa</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Kondisi Alat</label>
                            <select name="kondisi" class="form-select rounded-3" required>
                                <option value="" disabled selected>Pilih...</option>
                                <option value="Terawat">Terawat</option>
                                <option value="Tidak Terawat">Tidak Terawat</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Logbook (Vokasi)</label>
                            <select name="logbook" class="form-select rounded-3">
                                <option value="">Tidak Diisi (Abaikan)</option>
                                <option value="Ada">Ada</option>
                                <option value="Tidak Ada">Tidak Ada</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Waktu Penggunaan</label>
                            <input type="text" name="waktu_penggunaan" class="form-control rounded-3" placeholder="Jam/Minggu (Opsional)">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Daftar Prasarana Tersimpan ({{ $prasaranas->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle text-center" style="font-size: 0.85rem;">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th class="text-start">Prasarana</th>
                                <th>Jml</th>
                                <th class="text-start">Nama Alat</th>
                                <th>Standar</th>
                                <th>Dimiliki</th>
                                <th>Kepemilikan</th>
                                <th>Kondisi</th>
                                <th>Logbook</th>
                                <th>Waktu/Mgg</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prasaranas as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start fw-bold">{{ $item->nama_prasarana }}</td>
                                <td>{{ $item->jumlah_prasarana }}</td>
                                <td class="text-start">{{ $item->nama_sarana }}</td>
                                <td>{{ $item->standar_minimal }}</td>
                                <td>{{ $item->dimiliki_upps }}</td>
                                <td><span class="badge {{ $item->kepemilikan == 'Sendiri' ? 'bg-success' : 'bg-warning' }}">{{ $item->kepemilikan }}</span></td>
                                <td><span class="badge {{ $item->kondisi == 'Terawat' ? 'bg-info' : 'bg-danger' }}">{{ $item->kondisi }}</span></td>
                                <td>{{ $item->logbook ?? '-' }}</td>
                                <td>{{ $item->waktu_penggunaan ?? '-' }}</td>
                                <td>
                                    <form action="{{ route('prasarana_peralatan.destroy', $item->id) }}" method="POST">
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