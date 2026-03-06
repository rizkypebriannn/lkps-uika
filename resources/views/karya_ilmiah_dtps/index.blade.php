<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 4.e Pagelaran/Pameran/Publikasi - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Jumlah Karya Ilmiah / Pameran Dosen</h5>
                <form action="{{ route('karya_ilmiah_dtps.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Jenis Publikasi / Pagelaran</label>
                        <select name="jenis_publikasi" class="form-select rounded-3" required>
                            <option value="" disabled selected>Pilih Jenis Publikasi/Pameran...</option>
                            <option value="Jurnal nasional tidak terakreditasi">1. Jurnal nasional tidak terakreditasi</option>
                            <option value="Jurnal nasional terakreditasi">2. Jurnal nasional terakreditasi</option>
                            <option value="Jurnal internasional">3. Jurnal internasional</option>
                            <option value="Jurnal internasional bereputasi">4. Jurnal internasional bereputasi</option>
                            <option value="Prosiding di seminar nasional/wilayah">5. Prosiding di seminar nasional/wilayah</option>
                            <option value="Prosiding tidak terindeks di seminar internasional">6. Prosiding tidak terindeks di seminar internasional</option>
                            <option value="Prosiding terindeks Scopus / WoS di seminar internasional">7. Prosiding terindeks Scopus / WoS di seminar int.</option>
                            <option value="Pagelaran/pameran/presentasi dalam forum di tingkat wilayah">8. Pagelaran/pameran/presentasi tingkat wilayah</option>
                            <option value="Pagelaran/pameran/presentasi dalam forum di tingkat nasional">9. Pagelaran/pameran/presentasi tingkat nasional</option>
                            <option value="Pagelaran/pameran/presentasi dalam forum di tingkat internasional">10. Pagelaran/pameran/presentasi tingkat internasional</option>
                        </select>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah TS-2</label>
                            <input type="number" name="jumlah_ts2" class="form-control rounded-3" value="0" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah TS-1</label>
                            <input type="number" name="jumlah_ts1" class="form-control rounded-3" value="0" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah TS</label>
                            <input type="number" name="jumlah_ts" class="form-control rounded-3" value="0" min="0" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Daftar Karya Tersimpan ({{ $karyas->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle text-center" style="font-size: 0.85rem;">
                        <thead class="table-light">
                            <tr>
                                <th class="text-start">Jenis Publikasi / Pameran</th>
                                <th>TS-2</th>
                                <th>TS-1</th>
                                <th>TS</th>
                                <th>Total</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($karyas as $item)
                            <tr>
                                <td class="text-start fw-bold">{{ $item->jenis_publikasi }}</td>
                                <td>{{ $item->jumlah_ts2 }}</td>
                                <td>{{ $item->jumlah_ts1 }}</td>
                                <td>{{ $item->jumlah_ts }}</td>
                                <td class="text-primary fw-bold">{{ $item->jumlah_total }}</td>
                                <td>
                                    <form action="{{ route('karya_ilmiah_dtps.destroy', $item->id) }}" method="POST">
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