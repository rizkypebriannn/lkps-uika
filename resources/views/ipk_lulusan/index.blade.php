<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 6.b IPK Lulusan - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
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
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input IPK Lulusan</h5>
                <form action="{{ route('ipk_lulusan.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Tahun Lulus</label>
                            <select name="tahun_lulus" class="form-select rounded-3" required>
                                <option value="" disabled selected>Pilih Tahun Lulus...</option>
                                <option value="TS-2">TS-2</option>
                                <option value="TS-1">TS-1</option>
                                <option value="TS">TS</option>
                            </select>
                            <small class="text-muted" style="font-size: 0.75rem;">(Data akan di-update jika tahun sudah ada)</small>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-semibold text-sm">Jumlah Lulusan</label>
                            <input type="number" name="jumlah_lulusan" class="form-control rounded-3" value="0" min="0" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">IPK Minimum</label>
                            <input type="number" step="0.01" name="ipk_min" class="form-control rounded-3" placeholder="Contoh: 2.75" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">IPK Rata-rata</label>
                            <input type="number" step="0.01" name="ipk_rata" class="form-control rounded-3" placeholder="Contoh: 3.20" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">IPK Maksimum</label>
                            <input type="number" step="0.01" name="ipk_maks" class="form-control rounded-3" placeholder="Contoh: 3.98" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA IPK
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Daftar Data Tersimpan ({{ $ipks->count() }}/3)</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Tahun Lulus</th>
                                <th>Jumlah Lulusan</th>
                                <th>IPK Min.</th>
                                <th>IPK Rata-rata</th>
                                <th>IPK Maks.</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ipks as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-bold text-primary">{{ $item->tahun_lulus }}</td>
                                <td>{{ $item->jumlah_lulusan }}</td>
                                <td>{{ number_format($item->ipk_min, 2) }}</td>
                                <td class="fw-bold">{{ number_format($item->ipk_rata, 2) }}</td>
                                <td>{{ number_format($item->ipk_maks, 2) }}</td>
                                <td>
                                    <form action="{{ route('ipk_lulusan.destroy', $item->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @if($ipks->isEmpty())
                            <tr>
                                <td colspan="7" class="text-muted text-center py-3">Belum ada data IPK yang diinput.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>