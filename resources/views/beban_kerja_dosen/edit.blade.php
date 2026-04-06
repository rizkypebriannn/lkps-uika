<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 4.c Beban Kerja Dosen - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('beban_kerja_dosen.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Beban Kerja Dosen (SKS)</h5>
                <form action="{{ route('beban_kerja_dosen.update', $dosen->id) }}" method="POST">
                    @csrf
                    @method('PUT')
            
                    <div class="row g-4">
                        <div class="col-md-6 border-end pe-md-4">
                            <h6 class="text-primary fw-bold mb-3"><i class="bi bi-person-badge me-2"></i>Identitas & Pengajaran</h6>
                            
                            <div class="row g-2 mb-3">
                                <div class="col-9">
                                    <label class="form-label fw-semibold text-sm">Nama Dosen</label>
                                    <input type="text" name="nama_dosen" class="form-control rounded-3" value="{{ $dosen->nama_dosen }}" required>
                                </div>
                                <div class="col-3">
                                    <label class="form-label fw-semibold text-sm">DTPS?</label>
                                    <select name="is_dtps" class="form-select rounded-3" required>
                                        <option value="Ya" {{ $dosen->is_dtps == 'Ya' ? 'selected' : '' }}>Ya</option>
                                        <option value="Tidak" {{ $dosen->is_dtps == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                </div>
                            </div>

                            <label class="form-label fw-semibold text-sm text-secondary">Pendidikan: Pembelajaran & Pembimbingan (SKS)</label>
                            <div class="mb-3">
                                <input type="number" step="0.01" name="sks_ps_diakreditasi" class="form-control rounded-3 mb-2" value="{{ $dosen->sks_ps_diakreditasi }}" required>
                                <input type="number" step="0.01" name="sks_ps_lain_dalam_pt" class="form-control rounded-3 mb-2" value="{{ $dosen->sks_ps_lain_dalam_pt }}" required>
                                <input type="number" step="0.01" name="sks_ps_lain_luar_pt" class="form-control rounded-3" value="{{ $dosen->sks_ps_lain_luar_pt }}" required>
                            </div>
                        </div>

                        <div class="col-md-6 ps-md-4">
                            <h6 class="text-success fw-bold mb-3"><i class="bi bi-briefcase me-2"></i>Penelitian, PkM & Tambahan</h6>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-sm">SKS Penelitian</label>
                                <input type="number" step="0.01" name="sks_penelitian" class="form-control rounded-3" value="{{ $dosen->sks_penelitian }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-sm">SKS Pengabdian Masyarakat (PkM)</label>
                                <input type="number" step="0.01" name="sks_pkm" class="form-control rounded-3" value="{{ $dosen->sks_pkm }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-sm">SKS Tugas Tambahan / Penunjang</label>
                                <input type="number" step="0.01" name="sks_tugas_tambahan" class="form-control rounded-3" value="{{ $dosen->sks_tugas_tambahan }}" required>
                            </div>
                            
                            <div class="alert alert-info py-2 text-sm mt-3 border-0 rounded-3">
                                <i class="bi bi-info-circle-fill me-1"></i> Jumlah Total SKS & Rata-rata per Semester akan dihitung ulang otomatis.
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                            <i class="bi bi-pencil-square me-2"></i>UPDATE DATA BEBAN KERJA
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>