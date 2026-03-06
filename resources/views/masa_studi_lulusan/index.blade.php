<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 6.d Masa Studi Lulusan - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
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
                <h5 class="fw-bold mb-2">Input Masa Studi Lulusan</h5>
                <p class="text-muted small mb-4">Abaikan (kosongkan) isian jumlah lulusan jika pada tahun tersebut sel di Excel aslinya berwarna abu-abu.</p>
                
                <form action="{{ route('masa_studi_lulusan.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Tahun Masuk</label>
                            <select name="tahun_masuk" class="form-select rounded-3" required>
                                <option value="" disabled selected>Pilih Tahun Masuk...</option>
                                <option value="TS-7">TS-7</option>
                                <option value="TS-6">TS-6</option>
                                <option value="TS-5">TS-5</option>
                                <option value="TS-4">TS-4</option>
                                <option value="TS-3">TS-3</option>
                                <option value="TS-2">TS-2</option>
                                <option value="TS-1">TS-1</option>
                                <option value="TS">TS</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm text-primary">Jumlah Mahasiswa Masuk</label>
                            <input type="number" name="jumlah_masuk" class="form-control rounded-3" value="0" min="0" required>
                        </div>
                    </div>

                    <h6 class="fw-bold mb-3 border-bottom pb-2">Jumlah Mahasiswa Lulus berdasarkan Masa Studi (MS)</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label class="form-label text-sm">3,5 < MS ≤ 4,5 Tahun</label>
                            <input type="number" name="lulus_3_5" class="form-control rounded-3" value="0" min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-sm">4,5 < MS ≤ 5,5 Tahun</label>
                            <input type="number" name="lulus_4_5" class="form-control rounded-3" value="0" min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-sm">5,5 < MS ≤ 6,5 Tahun</label>
                            <input type="number" name="lulus_5_5" class="form-control rounded-3" value="0" min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-sm">6,5 < MS ≤ 8 Tahun</label>
                            <input type="number" name="lulus_6_5" class="form-control rounded-3" value="0" min="0">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Daftar Data Tersimpan ({{ $masa_studi->count() }}/8)</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th rowspan="2" class="align-middle">No</th>
                                <th rowspan="2" class="align-middle">Tahun Masuk</th>
                                <th rowspan="2" class="align-middle">Jml Masuk</th>
                                <th colspan="4">Jml Lulus (Rentang Masa Studi)</th>
                                <th rowspan="2" class="align-middle">Hapus</th>
                            </tr>
                            <tr>
                                <th>> 3.5 th</th>
                                <th>> 4.5 th</th>
                                <th>> 5.5 th</th>
                                <th>> 6.5 th</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($masa_studi as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-bold text-primary">{{ $item->tahun_masuk }}</td>
                                <td class="fw-bold bg-light">{{ $item->jumlah_masuk }}</td>
                                <td>{{ $item->lulus_3_5 }}</td>
                                <td>{{ $item->lulus_4_5 }}</td>
                                <td>{{ $item->lulus_5_5 }}</td>
                                <td>{{ $item->lulus_6_5 }}</td>
                                <td>
                                    <form action="{{ route('masa_studi_lulusan.destroy', $item->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @if($masa_studi->isEmpty())
                            <tr>
                                <td colspan="8" class="text-muted py-3">Belum ada data yang diinput.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>