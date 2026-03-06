<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 4.k Pembimbing Lapangan - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
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
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Pembimbing Lapangan (Program Profesi Insinyur)</h5>
                <form action="{{ route('pembimbing_lapangan.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Nama Pembimbing</label>
                            <input type="text" name="nama" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Industri Asal</label>
                            <input type="text" name="industri" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Bidang Keinsinyuran</label>
                            <input type="text" name="bidang_keinsinyuran" class="form-control rounded-3" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Pengalaman Kerja (Tahun)</label>
                            <input type="number" name="pengalaman_kerja" class="form-control rounded-3" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Pendidikan Tinggi</label>
                            <input type="text" name="pendidikan_tinggi" class="form-control rounded-3" placeholder="S1/S2/S3..." required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Kategori SIP</label>
                            <select name="kategori_sip" class="form-select rounded-3" required>
                                <option value="" disabled selected>Pilih Kategori SIP...</option>
                                <option value="IPM">IPM (Insinyur Profesional Madya)</option>
                                <option value="IPU">IPU (Insinyur Profesional Utama)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Nomor SIP</label>
                            <input type="text" name="nomor_sip" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Tanggal Berakhir SIP</label>
                            <input type="date" name="tanggal_berakhir_sip" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah Bimbingan (3 Thn)</label>
                            <input type="number" name="jumlah_bimbingan" class="form-control rounded-3" min="0" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Daftar Pembimbing Tersimpan ({{ $pembimbings->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle text-center" style="font-size: 0.85rem;">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th class="text-start">Nama</th>
                                <th>Industri</th>
                                <th>Bidang</th>
                                <th>Pengalaman (Thn)</th>
                                <th>Pendidikan</th>
                                <th>SIP</th>
                                <th>Tgl Berakhir</th>
                                <th>Jml Bimbingan</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembimbings as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start fw-bold">{{ $item->nama }}</td>
                                <td>{{ $item->industri }}</td>
                                <td>{{ $item->bidang_keinsinyuran }}</td>
                                <td>{{ $item->pengalaman_kerja }}</td>
                                <td>{{ $item->pendidikan_tinggi }}</td>
                                <td><span class="badge bg-primary">{{ $item->kategori_sip }}</span><br>{{ $item->nomor_sip }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_berakhir_sip)->format('d/m/Y') }}</td>
                                <td class="fw-bold">{{ $item->jumlah_bimbingan }}</td>
                                <td>
                                    <form action="{{ route('pembimbing_lapangan.destroy', $item->id) }}" method="POST">
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