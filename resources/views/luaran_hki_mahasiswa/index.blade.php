<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 6.e.3 HKI Mahasiswa (Paten) - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
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
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Luaran HKI Mahasiswa (Paten / Paten Sederhana)</h5>
                
                <form action="{{ route('luaran_hki_mahasiswa.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Luaran Penelitian dan PkM</label>
                        <input type="text" name="luaran_penelitian" class="form-control rounded-3" placeholder="Contoh: Mesin Pencacah Plastik Otomatis, Algoritma Kompresi Data..." required>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Status</label>
                            <select name="status" class="form-select rounded-3" required>
                                <option value="" disabled selected>Pilih Status...</option>
                                <option value="Registered">Registered (Terdaftar)</option>
                                <option value="Granted">Granted (Disetujui)</option>
                                <option value="Komersial">Komersial (Sudah Dikomersialkan)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Nomor Registrasi/Paten</label>
                            <input type="text" name="nomor_registrasi" class="form-control rounded-3" placeholder="Contoh: P00202312345" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA HKI
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Daftar HKI Tersimpan ({{ $hkis->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th class="text-start">Luaran Penelitian dan PkM</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Nomor Registrasi</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hkis as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start fw-bold" style="font-size: 0.85rem;">{{ $item->luaran_penelitian }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                <td>
                                    @if($item->status == 'Registered') <span class="badge bg-secondary">Registered</span>
                                    @elseif($item->status == 'Granted') <span class="badge bg-success">Granted</span>
                                    @else <span class="badge bg-primary">Komersial</span>
                                    @endif
                                </td>
                                <td>{{ $item->nomor_registrasi }}</td>
                                <td>
                                    <form action="{{ route('luaran_hki_mahasiswa.destroy', $item->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @if($hkis->isEmpty())
                            <tr>
                                <td colspan="6" class="text-muted py-3">Belum ada data HKI yang diinput.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>