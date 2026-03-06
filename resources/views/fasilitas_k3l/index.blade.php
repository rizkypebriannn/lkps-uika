<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 5.c Fasilitas K3L - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
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
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Fasilitas K3L di UPPS</h5>
                <form action="{{ route('fasilitas_k3l.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Nama Sarana</label>
                            <input type="text" name="nama_sarana" class="form-control rounded-3" placeholder="Contoh: APAR, Kotak P3K, dll..." required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Fungsi</label>
                            <input type="text" name="fungsi" class="form-control rounded-3" placeholder="Contoh: Pemadam Api Ringan..." required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold text-sm">Jumlah Unit</label>
                            <input type="number" name="jumlah_unit" class="form-control rounded-3" min="1" value="1" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold text-sm">Kondisi</label>
                            <select name="kondisi" class="form-select rounded-3" required>
                                <option value="" disabled selected>Pilih...</option>
                                <option value="Terawat">Terawat</option>
                                <option value="Tidak Terawat">Tidak Terawat</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Daftar Fasilitas K3L Tersimpan ({{ $fasilitas->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th class="text-start">Nama Sarana</th>
                                <th class="text-start">Fungsi</th>
                                <th class="text-center">Jumlah Unit</th>
                                <th>Kondisi</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fasilitas as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start fw-bold">{{ $item->nama_sarana }}</td>
                                <td class="text-start">{{ $item->fungsi }}</td>
                                <td class="text-center">{{ $item->jumlah_unit }}</td>
                                <td><span class="badge {{ $item->kondisi == 'Terawat' ? 'bg-success' : 'bg-danger' }}">{{ $item->kondisi }}</span></td>
                                <td>
                                    <form action="{{ route('fasilitas_k3l.destroy', $item->id) }}" method="POST">
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