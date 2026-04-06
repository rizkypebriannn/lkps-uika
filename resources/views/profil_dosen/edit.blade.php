<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 4.a Profil Dosen - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('profil_dosen.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4 border-top border-warning border-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2 text-warning">Update Data Profil Dosen</h5>
                <form action="{{ route('profil_dosen.update', $dosen->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Nama Dosen</label>
                            <input type="text" name="nama_dosen" class="form-control rounded-3" value="{{ $dosen->nama_dosen }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">NIDN / NIDK / NUPTK</label>
                            <input type="text" name="nidn_nidk" class="form-control rounded-3" value="{{ $dosen->nidn_nidk }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Kategori Dosen</label>
                            <select name="kategori_dosen" id="kategori_dosen" class="form-select rounded-3" required onchange="toggleIndustri()">
                                <option value="Dosen Tetap" {{ $dosen->kategori_dosen == 'Dosen Tetap' ? 'selected' : '' }}>Dosen Tetap</option>
                                <option value="Dosen Tidak Tetap" {{ $dosen->kategori_dosen == 'Dosen Tidak Tetap' ? 'selected' : '' }}>Dosen Tidak Tetap</option>
                                <option value="Dosen Industri" {{ $dosen->kategori_dosen == 'Dosen Industri' ? 'selected' : '' }}>Dosen / Praktisi Industri</option>
                            </select>
                        </div>

                        <!-- Form Perusahaan (Akan Muncul Jika Kategori = Dosen Industri) -->
                        <div class="col-md-12" id="div_industri" style="display: {{ $dosen->kategori_dosen == 'Dosen Industri' ? 'block' : 'none' }};">
                            <div class="p-3 bg-light rounded-3 border border-warning">
                                <label class="form-label fw-semibold text-sm text-warning-emphasis">Nama Perusahaan / Industri</label>
                                <input type="text" name="perusahaan_industri" id="input_industri" class="form-control rounded-3" value="{{ $dosen->perusahaan_industri }}" {{ $dosen->kategori_dosen == 'Dosen Industri' ? 'required' : '' }}>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Pendidikan S1 (PT & Ilmu)</label>
                            <input type="text" name="pendidikan_s1" class="form-control rounded-3" value="{{ $dosen->pendidikan_s1 }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Pendidikan S2 (PT & Ilmu)</label>
                            <input type="text" name="pendidikan_s2" class="form-control rounded-3" value="{{ $dosen->pendidikan_s2 }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Pendidikan S3 (PT & Ilmu)</label>
                            <input type="text" name="pendidikan_s3" class="form-control rounded-3" value="{{ $dosen->pendidikan_s3 }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Bidang Keahlian</label>
                            <input type="text" name="bidang_keahlian" class="form-control rounded-3" value="{{ $dosen->bidang_keahlian }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Kesesuaian Kompetensi PS</label>
                            <select name="kesesuaian_kompetensi" class="form-select rounded-3">
                                <option value="V" {{ $dosen->kesesuaian_kompetensi == 'V' ? 'selected' : '' }}>V (Sesuai)</option>
                                <option value="-" {{ $dosen->kesesuaian_kompetensi == '-' ? 'selected' : '' }}>- (Tidak)</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Jabatan Akademik</label>
                            <select name="jabatan_akademik" class="form-select rounded-3">
                                <option value="-" {{ $dosen->jabatan_akademik == '-' ? 'selected' : '' }}>-</option>
                                <option value="Tenaga Pengajar" {{ $dosen->jabatan_akademik == 'Tenaga Pengajar' ? 'selected' : '' }}>Tenaga Pengajar</option>
                                <option value="Asisten Ahli" {{ $dosen->jabatan_akademik == 'Asisten Ahli' ? 'selected' : '' }}>Asisten Ahli</option>
                                <option value="Lektor" {{ $dosen->jabatan_akademik == 'Lektor' ? 'selected' : '' }}>Lektor</option>
                                <option value="Lektor Kepala" {{ $dosen->jabatan_akademik == 'Lektor Kepala' ? 'selected' : '' }}>Lektor Kepala</option>
                                <option value="Guru Besar" {{ $dosen->jabatan_akademik == 'Guru Besar' ? 'selected' : '' }}>Guru Besar</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">No. Sertifikat Pendidik</label>
                            <input type="text" name="sertifikat_pendidik" class="form-control rounded-3" value="{{ $dosen->sertifikat_pendidik }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Sertifikat Profesi/Kompetensi</label>
                            <input type="text" name="sertifikat_kompetensi" class="form-control rounded-3" value="{{ $dosen->sertifikat_kompetensi }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Sertifikat Keinsinyuran</label>
                            <select name="sertifikat_keinsinyuran" class="form-select rounded-3">
                                <option value="-" {{ $dosen->sertifikat_keinsinyuran == '-' ? 'selected' : '' }}>-</option>
                                <option value="IPM" {{ $dosen->sertifikat_keinsinyuran == 'IPM' ? 'selected' : '' }}>IPM</option>
                                <option value="IPU" {{ $dosen->sertifikat_keinsinyuran == 'IPU' ? 'selected' : '' }}>IPU</option>
                            </select>
                        </div>

                        <div class="col-md-5">
                            <label class="form-label fw-semibold text-sm">Matkul di PS yg Diakreditasi</label>
                            <textarea name="matkul_ps_diakreditasi" class="form-control rounded-3" rows="2">{{ $dosen->matkul_ps_diakreditasi }}</textarea>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold text-sm">Kesesuaian Matkul</label>
                            <select name="kesesuaian_matkul" class="form-select rounded-3">
                                <option value="V" {{ $dosen->kesesuaian_matkul == 'V' ? 'selected' : '' }}>V (Sesuai)</option>
                                <option value="-" {{ $dosen->kesesuaian_matkul == '-' ? 'selected' : '' }}>- (Tidak)</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-semibold text-sm">Matkul di PS Lain</label>
                            <textarea name="matkul_ps_lain" class="form-control rounded-3" rows="2">{{ $dosen->matkul_ps_lain }}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 py-3 mt-4 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA DOSEN
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleIndustri() {
            var kategori = document.getElementById("kategori_dosen").value;
            var divIndustri = document.getElementById("div_industri");
            var inputIndustri = document.getElementById("input_industri");

            if (kategori === "Dosen Industri") {
                divIndustri.style.display = "block";
                inputIndustri.setAttribute("required", "required");
            } else {
                divIndustri.style.display = "none";
                inputIndustri.removeAttribute("required");
                inputIndustri.value = ""; 
            }
        }
    </script>
</x-app-layout>