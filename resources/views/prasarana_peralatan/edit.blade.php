<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 5.a Prasarana & Peralatan - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('prasarana_peralatan.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Prasarana dan Peralatan Utama</h5>
                <form action="{{ route('prasarana_peralatan.update', $prasarana->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Nama Prasarana (Ruang/Lab)</label>
                            <input type="text" name="nama_prasarana" class="form-control rounded-3" value="{{ $prasarana->nama_prasarana }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Jumlah Prasarana</label>
                            <input type="number" name="jumlah_prasarana" class="form-control rounded-3" min="1" value="{{ $prasarana->jumlah_prasarana }}" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Nama Sarana / Alat / Peraga</label>
                            <input type="text" name="nama_sarana" class="form-control rounded-3" value="{{ $prasarana->nama_sarana }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jml Alat (Standar Minimal)</label>
                            <input type="number" name="standar_minimal" class="form-control rounded-3" min="0" value="{{ $prasarana->standar_minimal }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jml Alat (Dimiliki UPPS)</label>
                            <input type="number" name="dimiliki_upps" class="form-control rounded-3" min="0" value="{{ $prasarana->dimiliki_upps }}" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Kepemilikan</label>
                            <select name="kepemilikan" class="form-select rounded-3" required>
                                <option value="Sendiri" {{ $prasarana->kepemilikan == 'Sendiri' ? 'selected' : '' }}>Sendiri</option>
                                <option value="Sewa" {{ $prasarana->kepemilikan == 'Sewa' ? 'selected' : '' }}>Sewa</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Kondisi Alat</label>
                            <select name="kondisi" class="form-select rounded-3" required>
                                <option value="Terawat" {{ $prasarana->kondisi == 'Terawat' ? 'selected' : '' }}>Terawat</option>
                                <option value="Tidak Terawat" {{ $prasarana->kondisi == 'Tidak Terawat' ? 'selected' : '' }}>Tidak Terawat</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Logbook (Vokasi)</label>
                            <select name="logbook" class="form-select rounded-3">
                                <option value="" {{ empty($prasarana->logbook) ? 'selected' : '' }}>Tidak Diisi (Abaikan)</option>
                                <option value="Ada" {{ $prasarana->logbook == 'Ada' ? 'selected' : '' }}>Ada</option>
                                <option value="Tidak Ada" {{ $prasarana->logbook == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Waktu Penggunaan</label>
                            <input type="text" name="waktu_penggunaan" class="form-control rounded-3" value="{{ $prasarana->waktu_penggunaan }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA PRASARANA
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>