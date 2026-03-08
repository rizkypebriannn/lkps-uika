<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 7.a Dokumen/Buku SPMI - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
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
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Dokumen Sistem Penjaminan Mutu Internal (SPMI)</h5>
                
                <form action="{{ route('dokumen_spmi.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Jenis Dokumen Penjaminan Mutu</label>
                        <select name="jenis_dokumen" class="form-select rounded-3" required>
                            <option value="" disabled selected>-- Pilih Jenis Dokumen --</option>
                            <option value="Kebijakan SPMI">Kebijakan SPMI</option>
                            <option value="Pedoman penerapan siklus PPEPP standar pendidikan tinggi dalam SPMI">Pedoman penerapan siklus PPEPP standar pendidikan tinggi dalam SPMI</option>
                            <option value="Standar dan/atau kriteria, norma, acuan mutu penyelenggaraan pendidikan dan pengelolaan perguruan tinggi">Standar dan/atau kriteria, norma, acuan mutu penyelenggaraan pendidikan dan pengelolaan perguruan tinggi</option>
                            <option value="Tata cara pendokumentasian implementasi SPMI">Tata cara pendokumentasian implementasi SPMI</option>
                        </select>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Nomor Dokumen</label>
                            <input type="text" name="nomor_dokumen" class="form-control rounded-3" placeholder="Contoh: 001/SPMI/2024..." required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Tanggal Dokumen</label>
                            <input type="date" name="tanggal_dokumen" class="form-control rounded-3" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DOKUMEN SPMI
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Data Dokumen Tersimpan ({{ $data->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="45%" class="text-start">Jenis Dokumen Penjaminan Mutu</th>
                                <th width="25%">No Dokumen</th>
                                <th width="15%">Tanggal Dokumen</th>
                                <th width="10%">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start fw-bold" style="font-size: 0.85rem;">{{ $item->jenis_dokumen }}</td>
                                <td><span class="badge bg-secondary">{{ $item->nomor_dokumen }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_dokumen)->format('d/m/Y') }}</td>
                                <td>
                                    <form action="{{ route('dokumen_spmi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-muted py-3">Belum ada Dokumen SPMI yang diinput.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>