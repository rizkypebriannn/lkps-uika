<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 2.a.1 Kerjasama Pendidikan - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
            </a>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Kerjasama Pendidikan</h5>
                
               <form action="{{ route('kerjasama_pendidikan.store') }}" method="POST">
    @csrf
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <label class="form-label fw-semibold">Lembaga Mitra</label>
            <input type="text" name="lembaga_mitra" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold">Tingkat</label>
            <select name="tingkat" class="form-select" required>
                <option value="Internasional">Internasional</option>
                <option value="Nasional">Nasional</option>
                <option value="Lokal/Wilayah">Lokal/Wilayah</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold">Status Kerjasama</label>
            <input type="text" name="status_kerjasama" class="form-control" placeholder="Contoh: Aktif / Selesai" required>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">Judul Kegiatan</label>
            <textarea name="judul_kegiatan" class="form-control" rows="2" required></textarea>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">Manfaat</label>
            <textarea name="manfaat" class="form-control" rows="2" required></textarea>
        </div>
        <div class="col-md-3">
            <label class="form-label fw-semibold">Tanggal Awal</label>
            <input type="date" name="tanggal_awal" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label fw-semibold">Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold">Durasi (Angka)</label>
            <input type="number" name="durasi" class="form-control" placeholder="Contoh: 3" required>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold">Link Bukti (Opsional)</label>
            <input type="url" name="bukti_kerjasama" class="form-control">
        </div>
    </div>
    <button type="submit" class="btn btn-primary w-100 py-3">SIMPAN DATA</button>
</form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Data Kerjasama Pendidikan Tersimpan ({{ $data->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th class="align-middle" width="5%">No</th>
                                <th class="align-middle" width="20%">Lembaga Mitra</th>
                                <th class="align-middle" width="10%">Tingkat</th>
                                <th class="align-middle" width="25%">Judul / Ruang Lingkup</th>
                                <th class="align-middle" width="15%">Durasi Waktu</th>
                                <th class="align-middle" width="15%">Bukti Kerjasama</th>
                                <th class="align-middle" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $item->lembaga_mitra }}</td>
                                <td><span class="badge bg-secondary">{{ $item->tingkat }}</span></td>
                                <td class="text-start">{{ $item->judul_kegiatan }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($item->tanggal_awal)->format('Y') }} - {{ \Carbon\Carbon::parse($item->tanggal_akhir)->format('Y') }}
                                </td>
                                <td>
                                    <a href="{{ $item->bukti_kerjasama }}" target="_blank" class="btn btn-sm btn-outline-info rounded-pill">
                                        <i class="bi bi-link-45deg"></i> Buka Dokumen
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <form action="{{ route('kerjasama_pendidikan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm text-danger" title="Hapus">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-muted py-3">Belum ada data Kerjasama Pendidikan yang diinput.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>