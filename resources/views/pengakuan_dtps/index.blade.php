<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 4.j Pengakuan DTPS - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
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
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Pengakuan/Rekognisi DTPS</h5>
                <form action="{{ route('pengakuan_dtps.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Nama DTPS</label>
                            <input type="text" name="nama_dtps" class="form-control rounded-3" placeholder="Nama dosen..." required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Bidang Keahlian</label>
                            <input type="text" name="bidang_keahlian" class="form-control rounded-3" placeholder="Keahlian dosen..." required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Rekognisi</label>
                            <input type="text" name="rekognisi" class="form-control rounded-3" placeholder="Bentuk rekognisi / penghargaan..." required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Bukti Pendukung</label>
                            <input type="text" name="bukti_pendukung" class="form-control rounded-3" placeholder="Sertifikat / Surat Keputusan..." required>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Tingkat</label>
                            <select name="tingkat" class="form-select rounded-3" required>
                                <option value="" disabled selected>Pilih Tingkat...</option>
                                <option value="Wilayah">Wilayah / Lokal</option>
                                <option value="Nasional">Nasional</option>
                                <option value="Internasional">Internasional</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Tahun (YYYY)</label>
                            <input type="number" name="tahun" class="form-control rounded-3" placeholder="Contoh: 2023" required min="2000" max="{{ date('Y') }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Daftar Rekognisi Tersimpan ({{ $pengakuans->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th class="text-start">Nama DTPS</th>
                                <th>Bidang Keahlian</th>
                                <th>Rekognisi</th>
                                <th>Tingkat</th>
                                <th>Tahun</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengakuans as $index => $item)
                            <tr class="text-center">
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start fw-bold">{{ $item->nama_dtps }}</td>
                                <td>{{ $item->bidang_keahlian }}</td>
                                <td>{{ $item->rekognisi }}</td>
                                <td>
                                    @if($item->tingkat == 'Wilayah') <span class="badge bg-secondary">Wilayah</span>
                                    @elseif($item->tingkat == 'Nasional') <span class="badge bg-info text-dark">Nasional</span>
                                    @else <span class="badge bg-success">Internasional</span>
                                    @endif
                                </td>
                                <td>{{ $item->tahun }}</td>
                                <td>
                                    <form action="{{ route('pengakuan_dtps.destroy', $item->id) }}" method="POST">
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