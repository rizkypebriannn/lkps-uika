<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 5.b Dokumen K3L - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
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
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Dokumen K3L di UPPS</h5>
                <form action="{{ route('dokumen_k3l.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Jenis Dokumen K3L</label>
                        <input type="text" name="jenis_dokumen" class="form-control rounded-3" placeholder="Contoh: SOP Penggunaan Lab, Modul K3..." required>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jumlah Dokumen</label>
                            <input type="number" name="jumlah" class="form-control rounded-3" min="1" value="1" required>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-semibold text-sm">Riwayat Pengesahan</label>
                            <input type="text" name="riwayat_pengesahan" class="form-control rounded-3" placeholder="Disahkan oleh siapa / SK Nomor berapa..." required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Daftar Dokumen K3L Tersimpan ({{ $dokumens->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th class="text-start">Jenis Dokumen</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-start">Riwayat Pengesahan</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dokumens as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start fw-bold">{{ $item->jenis_dokumen }}</td>
                                <td class="text-center">{{ $item->jumlah }}</td>
                                <td class="text-start">{{ $item->riwayat_pengesahan }}</td>
                                <td>
                                    <form action="{{ route('dokumen_k3l.destroy', $item->id) }}" method="POST">
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