<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 4.f Teknologi/Produk - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
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
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Luaran (Teknologi Tepat Guna, Produk, Karya Seni, Rekayasa Sosial)</h5>
                <form action="{{ route('luaran_teknologi_produk.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Judul Luaran (Teknologi/Produk/Karya)</label>
                        <textarea name="judul_luaran" class="form-control rounded-3" rows="2" placeholder="Masukkan judul luaran..." required></textarea>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Tahun</label>
                            <input type="number" name="tahun" class="form-control rounded-3" placeholder="Contoh: 2023" required min="2000" max="{{ date('Y') }}">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-semibold text-sm">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control rounded-3" placeholder="Contoh: Diterapkan di Desa X / Tersertifikasi Nasional" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Daftar Teknologi & Produk Tersimpan ({{ $produks->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th class="text-start">Judul Luaran (Teknologi/Produk)</th>
                                <th>Tahun</th>
                                <th>Keterangan</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produks as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start fw-bold" style="max-width: 300px; white-space: normal;">{{ $item->judul_luaran }}</td>
                                <td>{{ $item->tahun }}</td>
                                <td>{{ $item->keterangan ?? '-' }}</td>
                                <td>
                                    <form action="{{ route('luaran_teknologi_produk.destroy', $item->id) }}" method="POST">
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