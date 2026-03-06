<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 4.g Produk/Jasa DTPS - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
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
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Produk/Jasa DTPS yang Diadopsi Industri/Masyarakat</h5>
                <form action="{{ route('produk_jasa_dtps.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Nama DTPS</label>
                            <input type="text" name="nama_dtps" class="form-control rounded-3" placeholder="Nama dosen..." required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Nama Produk/Jasa</label>
                            <input type="text" name="nama_produk" class="form-control rounded-3" placeholder="Nama produk atau jasa..." required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-sm">Deskripsi Produk/Jasa</label>
                        <textarea name="deskripsi_produk" class="form-control rounded-3" rows="2" placeholder="Jelaskan secara singkat produk/jasa tersebut..." required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Bukti (Link / Dokumen / Sertifikat)</label>
                        <input type="text" name="bukti" class="form-control rounded-3" placeholder="Contoh: Surat Perjanjian Kerjasama / Link Berita" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Daftar Produk/Jasa Tersimpan ({{ $produks->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama DTPS</th>
                                <th class="text-start">Nama Produk/Jasa</th>
                                <th>Deskripsi</th>
                                <th>Bukti</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produks as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $item->nama_dtps }}</td>
                                <td class="text-start fw-bold" style="max-width: 200px; white-space: normal;">{{ $item->nama_produk }}</td>
                                <td style="max-width: 250px; white-space: normal; font-size: 0.85rem;">{{ $item->deskripsi_produk }}</td>
                                <td>{{ $item->bukti }}</td>
                                <td>
                                    <form action="{{ route('produk_jasa_dtps.destroy', $item->id) }}" method="POST">
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