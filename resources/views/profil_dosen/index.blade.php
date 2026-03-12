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
                <i class="bi bi-arrow-left me-2"></i>Dashboard
            </a>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4 border-top border-primary border-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2 text-primary">Input Data Profil Dosen</h5>
                <form action="{{ route('profil-dosen.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Nama Dosen</label>
                            <input type="text" name="nama_dosen" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">NIDN / NIDK / NUPTK</label>
                            <input type="text" name="nidn_nidk" class="form-control rounded-3">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Kategori Dosen</label>
                            <select name="kategori_dosen" id="kategori_dosen" class="form-select rounded-3" required onchange="toggleIndustri()">
                                <option value="Dosen Tetap">Dosen Tetap</option>
                                <option value="Dosen Tidak Tetap">Dosen Tidak Tetap</option>
                                <option value="Dosen Industri">Dosen / Praktisi Industri</option>
                            </select>
                        </div>

                        <div class="col-md-12" id="div_industri" style="display: none;">
                            <div class="p-3 bg-light rounded-3 border border-warning">
                                <label class="form-label fw-semibold text-sm text-warning-emphasis">Nama Perusahaan / Industri (Khusus Dosen Industri)</label>
                                <input type="text" name="perusahaan_industri" id="input_industri" class="form-control rounded-3" placeholder="Contoh: PT. Astra Honda Motor">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Pendidikan S1 (PT & Ilmu)</label>
                            <input type="text" name="pendidikan_s1" class="form-control rounded-3" placeholder="Contoh: UI - Teknik Mesin">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Pendidikan S2 (PT & Ilmu)</label>
                            <input type="text" name="pendidikan_s2" class="form-control rounded-3">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Pendidikan S3 (PT & Ilmu)</label>
                            <input type="text" name="pendidikan_s3" class="form-control rounded-3">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Bidang Keahlian</label>
                            <input type="text" name="bidang_keahlian" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Kesesuaian Kompetensi PS</label>
                            <select name="kesesuaian_kompetensi" class="form-select rounded-3">
                                <option value="V">V (Sesuai)</option>
                                <option value="-">- (Tidak)</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Jabatan Akademik</label>
                            <select name="jabatan_akademik" class="form-select rounded-3">
                                <option value="-">-</option>
                                <option value="Tenaga Pengajar">Tenaga Pengajar</option>
                                <option value="Asisten Ahli">Asisten Ahli</option>
                                <option value="Lektor">Lektor</option>
                                <option value="Lektor Kepala">Lektor Kepala</option>
                                <option value="Guru Besar">Guru Besar</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">No. Sertifikat Pendidik</label>
                            <input type="text" name="sertifikat_pendidik" class="form-control rounded-3">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Sertifikat Profesi/Kompetensi</label>
                            <input type="text" name="sertifikat_kompetensi" class="form-control rounded-3">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Sertifikat Keinsinyuran</label>
                            <select name="sertifikat_keinsinyuran" class="form-select rounded-3">
                                <option value="-">-</option>
                                <option value="IPM">IPM</option>
                                <option value="IPU">IPU</option>
                            </select>
                        </div>

                        <div class="col-md-5">
                            <label class="form-label fw-semibold text-sm">Matkul di PS yg Diakreditasi</label>
                            <textarea name="matkul_ps_diakreditasi" class="form-control rounded-3" rows="2"></textarea>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold text-sm">Kesesuaian Matkul</label>
                            <select name="kesesuaian_matkul" class="form-select rounded-3">
                                <option value="V">V (Sesuai)</option>
                                <option value="-">- (Tidak)</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-semibold text-sm">Matkul di PS Lain</label>
                            <textarea name="matkul_ps_lain" class="form-control rounded-3" rows="2"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-3 mt-4 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA DOSEN
                    </button>
                </form>
            </div>

            <div class="card shadow-sm border-0 rounded-4 p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold m-0">Data Dosen Tersimpan (Lengkap)</h6>
                    <span class="badge bg-primary rounded-pill">{{ $data->count() }} Dosen</span>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered align-middle text-center text-nowrap" style="font-size: 0.85rem;">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Dosen</th>
                                <th>NIDN / NIDK</th>
                                <th>Kategori</th>
                                <th>Perusahaan (Industri)</th>
                                <th>Pendidikan S1</th>
                                <th>Pendidikan S2</th>
                                <th>Pendidikan S3</th>
                                <th>Bidang Keahlian</th>
                                <th>Kesesuaian PS</th>
                                <th>Jabatan Akademik</th>
                                <th>Sertifikat Pendidik</th>
                                <th>Sertifikat Profesi</th>
                                <th>Sertifikat Insinyur</th>
                                <th>Matkul PS</th>
                                <th>Kesesuaian Matkul</th>
                                <th>Matkul Lain</th>
                                <th class="sticky-end bg-light">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-bold text-start">{{ $item->nama_dosen }}</td>
                                <td>{{ $item->nidn_nidk ?? '-' }}</td>
                                <td><span class="badge bg-secondary">{{ $item->kategori_dosen }}</span></td>
                                <td>{{ $item->perusahaan_industri ?? '-' }}</td>
                                <td>{{ $item->pendidikan_s1 ?? '-' }}</td>
                                <td>{{ $item->pendidikan_s2 ?? '-' }}</td>
                                <td>{{ $item->pendidikan_s3 ?? '-' }}</td>
                                <td>{{ $item->bidang_keahlian }}</td>
                                <td>{{ $item->kesesuaian_kompetensi }}</td>
                                <td>{{ $item->jabatan_akademik }}</td>
                                <td>{{ $item->sertifikat_pendidik ?? '-' }}</td>
                                <td>{{ $item->sertifikat_kompetensi ?? '-' }}</td>
                                <td>{{ $item->sertifikat_keinsinyuran }}</td>
                                <td class="text-start text-wrap" style="min-width: 200px;">{{ $item->matkul_ps_diakreditasi ?? '-' }}</td>
                                <td>{{ $item->kesesuaian_matkul }}</td>
                                <td class="text-start text-wrap" style="min-width: 200px;">{{ $item->matkul_ps_lain ?? '-' }}</td>
                                <td class="sticky-end bg-white">
                                    <form action="{{ route('profil-dosen.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data dosen ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger p-0"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="18" class="text-muted py-4">Belum ada data profil dosen.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
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
                inputIndustri.value = ""; // Bersihkan isinya
            }
        }
    </script>
</x-app-layout>