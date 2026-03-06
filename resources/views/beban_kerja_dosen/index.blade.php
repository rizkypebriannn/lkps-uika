<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 4.c Beban Kerja Dosen - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
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
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Beban Kerja Dosen (SKS)</h5>
                <form action="{{ route('beban_kerja_dosen.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-4">
                        <div class="col-md-6 border-end pe-md-4">
                            <h6 class="text-primary fw-bold mb-3"><i class="bi bi-person-badge me-2"></i>Identitas & Pengajaran</h6>
                            
                            <div class="row g-2 mb-3">
                                <div class="col-9">
                                    <label class="form-label fw-semibold text-sm">Nama Dosen</label>
                                    <input type="text" name="nama_dosen" class="form-control rounded-3" required>
                                </div>
                                <div class="col-3">
                                    <label class="form-label fw-semibold text-sm">DTPS?</label>
                                    <select name="is_dtps" class="form-select rounded-3" required>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>

                            <label class="form-label fw-semibold text-sm text-secondary">Pendidikan: Pembelajaran & Pembimbingan (SKS)</label>
                            <div class="mb-3">
                                <input type="number" step="0.01" name="sks_ps_diakreditasi" class="form-control rounded-3 mb-2" placeholder="SKS di PS yang Diakreditasi" value="0" required>
                                <input type="number" step="0.01" name="sks_ps_lain_dalam_pt" class="form-control rounded-3 mb-2" placeholder="SKS di PS Lain (Dalam PT)" value="0" required>
                                <input type="number" step="0.01" name="sks_ps_lain_luar_pt" class="form-control rounded-3" placeholder="SKS di PS Lain (Luar PT)" value="0" required>
                            </div>
                        </div>

                        <div class="col-md-6 ps-md-4">
                            <h6 class="text-success fw-bold mb-3"><i class="bi bi-briefcase me-2"></i>Penelitian, PkM & Tambahan</h6>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-sm">SKS Penelitian</label>
                                <input type="number" step="0.01" name="sks_penelitian" class="form-control rounded-3" value="0" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-sm">SKS Pengabdian Masyarakat (PkM)</label>
                                <input type="number" step="0.01" name="sks_pkm" class="form-control rounded-3" value="0" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-sm">SKS Tugas Tambahan / Penunjang</label>
                                <input type="number" step="0.01" name="sks_tugas_tambahan" class="form-control rounded-3" value="0" required>
                            </div>
                            
                            <div class="alert alert-info py-2 text-sm mt-3 border-0 rounded-3">
                                <i class="bi bi-info-circle-fill me-1"></i> Jumlah Total SKS & Rata-rata per Semester akan dihitung otomatis oleh sistem.
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                            <i class="bi bi-save me-2"></i>SIMPAN DATA
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Daftar Beban Kerja Dosen ({{ $dosens->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle text-center" style="font-size: 0.85rem;">
                        <thead class="table-light">
                            <tr>
                                <th class="text-start">Nama Dosen</th>
                                <th>DTPS</th>
                                <th>SKS Ajar</th>
                                <th>SKS Peneliti</th>
                                <th>SKS PkM</th>
                                <th>Total/Thn</th>
                                <th>Rata/Smt</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dosens as $item)
                            <tr>
                                <td class="text-start fw-bold">{{ $item->nama_dosen }}</td>
                                <td>{!! $item->is_dtps == 'Ya' ? '<i class="bi bi-check-circle-fill text-success"></i>' : '-' !!}</td>
                                <td>{{ $item->sks_ps_diakreditasi + $item->sks_ps_lain_dalam_pt + $item->sks_ps_lain_luar_pt }}</td>
                                <td>{{ $item->sks_penelitian }}</td>
                                <td>{{ $item->sks_pkm }}</td>
                                <td class="fw-bold text-primary">{{ $item->sks_jumlah }}</td>
                                <td class="fw-bold text-success">{{ $item->sks_rata_rata }}</td>
                                <td>
                                    <form action="{{ route('beban_kerja_dosen.destroy', $item->id) }}" method="POST">
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