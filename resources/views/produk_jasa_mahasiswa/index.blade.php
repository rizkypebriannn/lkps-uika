<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 6.e.4 Produk/Jasa Mahasiswa - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
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
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Produk/Jasa Mahasiswa yang Diadopsi Industri/Masyarakat</h5>
                
                <form action="{{ route('produk_jasa_mahasiswa.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Nama Mahasiswa</label>
                            <input type="text" name="nama_mahasiswa" class="form-control rounded-3" placeholder="Contoh: Ahmad Dhani..." required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Nama Produk/Jasa</label>
                            <input type="text" name="nama_produk_jasa" class="form-control rounded-3" placeholder="Contoh: Aplikasi Kasir Pintar..." required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Deskripsi Produk/Jasa</label>
                        <textarea name="deskripsi" class="form-control rounded-3" rows="3" placeholder="Jelaskan secara singkat kegunaan produk/jasa tersebut..." required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Bukti (Link/Dokumen)</label>
                        <input type="text" name="bukti" class="form-control rounded-3" placeholder="Contoh: Surat Keterangan Mitra / Link Berita..." required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA PRODUK/JASA
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Daftar Produk/Jasa Tersimpan ({{ $data->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%" class="text-start">Nama Mahasiswa</th>
                                <th width="25%" class="text-start">Nama Produk/Jasa</th>
                                <th width="25%" class="text-start">Deskripsi</th>
                                <th width="15%">Bukti</th>
                                <th width="10%">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start fw-bold">{{ $item->nama_mahasiswa }}</td>
                                <td class="text-start">{{ $item->nama_produk_jasa }}</td>
                                <td class="text-start" style="font-size: 0.85rem;">{{ Str::limit($item->deskripsi, 50) }}</td>
                                <td><span class="badge bg-success">{{ $item->bukti }}</span></td>
                                <td>
                                    <form action="{{ route('produk_jasa_mahasiswa.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-muted py-3">Belum ada data Produk/Jasa yang diinput.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>