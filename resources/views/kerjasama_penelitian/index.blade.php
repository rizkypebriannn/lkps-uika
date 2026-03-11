<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 2.a.2 Kerjasama Penelitian - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Dashboard
            </a>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Kerjasama Penelitian</h5>
                <form action="{{ route('kerjasama_penelitian.store') }}" method="POST">
                    @csrf
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Lembaga Mitra</label>
                            <input type="text" name="lembaga_mitra" class="form-control rounded-3" placeholder="Contoh: BRIN" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Tingkat</label>
                            <select name="tingkat" class="form-select rounded-3" required>
                                <option value="Internasional">Internasional</option>
                                <option value="Nasional">Nasional</option>
                                <option value="Lokal/Wilayah">Lokal / Wilayah</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Status Kerjasama</label>
                            <input type="text" name="status_kerjasama" class="form-control rounded-3" placeholder="Aktif/Selesai" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Judul Kegiatan Penelitian</label>
                            <textarea name="judul_kegiatan" class="form-control rounded-3" rows="2" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Manfaat bagi PS</label>
                            <textarea name="manfaat" class="form-control rounded-3" rows="2" required></textarea>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Tanggal Awal</label>
                            <input type="date" name="tanggal_awal" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold text-sm">Durasi (Angka)</label>
                            <input type="number" name="durasi" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Link Bukti Kerjasama</label>
                            <input type="url" name="bukti_kerjasama" class="form-control rounded-3">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA PENELITIAN
                    </button>
                </form>
            </div>

            <div class="card shadow-sm border-0 rounded-4 p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold m-0">Data Kerjasama Penelitian Tersimpan</h6>
                    <span class="badge bg-primary rounded-pill">{{ $data->count() }} Data</span>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered align-middle text-center" style="font-size: 0.85rem;">
                        <thead class="table-light text-secondary">
                            <tr>
                                <th>No</th>
                                <th>Lembaga Mitra</th>
                                <th>Tingkat</th>
                                <th>Judul Kegiatan</th>
                                <th>Manfaat</th>
                                <th>Status</th>
                                <th>Durasi</th>
                                <th>Bukti</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $item->lembaga_mitra }}</td>
                                <td>
                                    <span class="badge {{ $item->tingkat == 'Internasional' ? 'bg-danger' : ($item->tingkat == 'Nasional' ? 'bg-warning text-dark' : 'bg-info text-dark') }}">
                                        {{ $item->tingkat }}
                                    </span>
                                </td>
                                <td class="text-start">{{ $item->judul_kegiatan }}</td>
                                <td class="text-start small text-muted">{{ $item->manfaat }}</td>
                                <td><span class="text-success fw-bold small">{{ $item->status_kerjasama }}</span></td>
                                <td>{{ $item->durasi }} Thn</td>
                                <td>
                                    @if($item->bukti_kerjasama)
                                        <a href="{{ $item->bukti_kerjasama }}" target="_blank" class="btn btn-outline-primary btn-sm px-2 py-0" style="font-size: 0.75rem;">
                                            <i class="bi bi-link-45deg"></i> Link
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('kerjasama_penelitian.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger p-0"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="9" class="text-muted py-4 small">Belum ada data penelitian.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>