<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 4.a Profil Dosen - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
            </a>
            
            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Data Profil Dosen</h5>
                <form action="{{ route('profil_dosen.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-4">
                        <div class="col-md-6 border-end pe-md-4">
                            <h6 class="text-primary fw-bold mb-3"><i class="bi bi-person-badge me-2"></i>Data Pribadi & Akademik</h6>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-sm">Nama Dosen</label>
                                <input type="text" name="nama_dosen" class="form-control rounded-3" required>
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label fw-semibold text-sm">NIDN/NIDK</label>
                                    <input type="text" name="nidn" class="form-control rounded-3" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label fw-semibold text-sm">Kategori</label>
                                    <select name="kategori_dosen" class="form-select rounded-3" required>
                                        <option value="Dosen Tetap">Dosen Tetap</option>
                                        <option value="Dosen Tidak Tetap">Dosen Tidak Tetap</option>
                                        <option value="Dosen Industri">Dosen Industri</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-sm">Jabatan Akademik</label>
                                <select name="jabatan_akademik" class="form-select rounded-3" required>
                                    <option value="Tenaga Pengajar">Tenaga Pengajar</option>
                                    <option value="Asisten Ahli">Asisten Ahli</option>
                                    <option value="Lektor">Lektor</option>
                                    <option value="Lektor Kepala">Lektor Kepala</option>
                                    <option value="Guru Besar">Guru Besar</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-sm">Pendidikan S1, S2, S3 (Asal PT)</label>
                                <input type="text" name="pendidikan_s1" class="form-control rounded-3 mb-2" placeholder="S1: Univ... (Opsional)">
                                <input type="text" name="pendidikan_s2" class="form-control rounded-3 mb-2" placeholder="S2: Univ... (Opsional)">
                                <input type="text" name="pendidikan_s3" class="form-control rounded-3" placeholder="S3: Univ... (Opsional)">
                            </div>
                        </div>

                        <div class="col-md-6 ps-md-4">
                            <h6 class="text-success fw-bold mb-3"><i class="bi bi-book-half me-2"></i>Kompetensi & Pengajaran</h6>
                            
                            <div class="row g-2 mb-3">
                                <div class="col-8">
                                    <label class="form-label fw-semibold text-sm">Bidang Keahlian</label>
                                    <input type="text" name="bidang_keahlian" class="form-control rounded-3" required>
                                </div>
                                <div class="col-4">
                                    <label class="form-label fw-semibold text-sm">Sesuai dgn PS?</label>
                                    <select name="kesesuaian_kompetensi" class="form-select rounded-3" required>
                                        <option value="Sesuai">Sesuai</option>
                                        <option value="Tidak Sesuai">Tidak</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-sm">Sertifikat Pendidik (No. Sertifikat)</label>
                                <input type="text" name="sertifikat_pendidik" class="form-control rounded-3" placeholder="Kosongkan jika tidak ada">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-sm">Mata Kuliah di PS yang Diakreditasi</label>
                                <textarea name="matkul_ps_diakreditasi" class="form-control rounded-3" rows="2" required></textarea>
                            </div>
                            
                            <div class="row g-2 mb-3">
                                <div class="col-8">
                                    <label class="form-label fw-semibold text-sm">Mata Kuliah di PS Lain</label>
                                    <input type="text" name="matkul_ps_lain" class="form-control rounded-3" placeholder="Opsional">
                                </div>
                                <div class="col-4">
                                    <label class="form-label fw-semibold text-sm">Kesesuaian MK?</label>
                                    <select name="kesesuaian_matkul" class="form-select rounded-3" required>
                                        <option value="Sesuai">Sesuai</option>
                                        <option value="Tidak Sesuai">Tidak</option>
                                    </select>
                                </div>
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
                <h6 class="fw-bold mb-3">Daftar Dosen Tersimpan ({{ $dosens->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle" style="font-size: 0.85rem;">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Dosen</th>
                                <th>NIDN</th>
                                <th>Kategori</th>
                                <th>Jabatan</th>
                                <th>Bidang Keahlian</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dosens as $item)
                            <tr>
                                <td class="fw-bold">{{ $item->nama_dosen }}</td>
                                <td>{{ $item->nidn }}</td>
                                <td><span class="badge bg-secondary">{{ $item->kategori_dosen }}</span></td>
                                <td>{{ $item->jabatan_akademik }}</td>
                                <td>{{ $item->bidang_keahlian }}</td>
                                <td>
                                    <form action="{{ route('profil_dosen.destroy', $item->id) }}" method="POST">
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