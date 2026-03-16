<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard LKPS - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? 'Admin' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        .card-lkps { border: none; border-radius: 1rem; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: transform 0.2s; background: #fff; }
        .card-lkps:hover { transform: translateY(-5px); }
        .icon-box { font-size: 2.5rem; margin-bottom: 1rem; }
        .btn-pill { border-radius: 50px !important; }
        /* Tambahan agar layout lebih lebar dan lega untuk sidebar */
        .dashboard-container { max-width: 95%; margin: 0 auto; }
    </style>

    <div class="py-8">
        <div class="dashboard-container sm:px-6 lg:px-8">
            
            <div class="row g-4">
                
                <div class="col-lg-3 col-md-4">
                    <div class="sticky-top" style="top: 2rem; z-index: 10;">
                        <h5 class="fw-bold text-secondary mb-3">
                            <i class="bi bi-bar-chart-fill me-2"></i>Ringkasan Skor
                        </h5>
                        
                        <div class="card shadow-sm border-0 rounded-4 border-start border-success border-4 mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <p class="text-muted mb-1 fw-semibold" style="font-size: 0.85rem;">Kerjasama</p>
                                        <h2 class="fw-bold text-success mb-0">{{ $skorKerjasama }} <span style="font-size: 1rem; color:#888;">/ 4.00</span></h2>
                                    </div>
                                    <div class="bg-success bg-opacity-10 p-2 rounded-circle">
                                        <i class="bi bi-diagram-3-fill text-success" style="font-size: 1.2rem;"></i>
                                    </div>
                                </div>
                                <p class="mb-0 text-muted" style="font-size: 0.75rem;">Target Unggul: 4.00. (Tabel 2.a)</p>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 rounded-4 border-start border-primary border-4 mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <p class="text-muted mb-1 fw-semibold" style="font-size: 0.85rem;">Dosen Lulusan S3</p>
                                        <h2 class="fw-bold text-primary mb-0">{{ $skorDosenS3 }} <span style="font-size: 1rem; color:#888;">/ 4.00</span></h2>
                                    </div>
                                    <div class="bg-primary bg-opacity-10 p-2 rounded-circle">
                                        <i class="bi bi-mortarboard-fill text-primary" style="font-size: 1.2rem;"></i>
                                    </div>
                                </div>
                                <p class="mb-0 text-muted" style="font-size: 0.75rem;">Target: 50% DTPS bergelar Doktor. (Tabel 4.a)</p>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 rounded-4 border-start border-danger border-4 mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <p class="text-muted mb-1 fw-semibold" style="font-size: 0.85rem;">Kecukupan Dosen</p>
                                        <h2 class="fw-bold text-danger mb-0">{{ $skorKecukupanDosen }} <span style="font-size: 1rem; color:#888;">/ 4.00</span></h2>
                                    </div>
                                    <div class="bg-danger bg-opacity-10 p-2 rounded-circle">
                                        <i class="bi bi-people-fill text-danger" style="font-size: 1.2rem;"></i>
                                    </div>
                                </div>
                                <p class="mb-0 text-muted" style="font-size: 0.75rem;">Target: Minimal 12 DTPS & Maks 10% Dosen Tidak Tetap. (Tabel 4.a)</p>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 rounded-4 border-start border-warning border-4 mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <p class="text-muted mb-1 fw-semibold" style="font-size: 0.85rem;">Jabatan Akademik</p>
                                        <h2 class="fw-bold text-warning mb-0">{{ $skorJabatanDosen }} <span style="font-size: 1rem; color:#888;">/ 4.00</span></h2>
                                    </div>
                                    <div class="bg-warning bg-opacity-10 p-2 rounded-circle">
                                        <i class="bi bi-award-fill text-warning" style="font-size: 1.2rem;"></i>
                                    </div>
                                </div>
                                <p class="mb-0 text-muted" style="font-size: 0.75rem;">Target: 70% Lektor/LK/GB. (Tabel 4.a)</p>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 rounded-4 border-start border-info border-4 mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <p class="text-muted mb-1 fw-semibold" style="font-size: 0.85rem;">Tenaga Kependidikan</p>
                                        <h2 class="fw-bold text-info mb-0">{{ $skorTendik }} <span style="font-size: 1rem; color:#888;">/ 4.00</span></h2>
                                    </div>
                                    <div class="bg-info bg-opacity-10 p-2 rounded-circle">
                                        <i class="bi bi-person-gear text-info" style="font-size: 1.2rem;"></i>
                                    </div>
                                </div>
                                <p class="mb-0 text-muted" style="font-size: 0.75rem;">Target: > 70% Bersertifikat. (Tabel 4.b)</p>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 rounded-4 border-start border-secondary border-4 mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <p class="text-muted mb-1 fw-semibold" style="font-size: 0.85rem;">Beban Kerja (RBK)</p>
                                        <h2 class="fw-bold text-secondary mb-0">{{ $skorBebanKerja }} <span style="font-size: 1rem; color:#888;">/ 4.00</span></h2>
                                    </div>
                                    <div class="bg-secondary bg-opacity-10 p-2 rounded-circle">
                                        <i class="bi bi-file-earmark-bar-graph text-secondary" style="font-size: 1.2rem;"></i>
                                    </div>
                                </div>
                                <p class="mb-0 text-muted" style="font-size: 0.75rem;">Target: RBK 12-16 SKS. (Tabel 4.c)</p>
                            </div>
                        </div>

                        </div>
                </div>


                <div class="col-lg-9 col-md-8">
                    
                    <div class="mb-4" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 1.5rem; padding: 2rem; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.2);">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <div class="text-white mb-3 mb-md-0">
                                <h4 class="fw-bold mb-2" style="font-size: 1.5rem;">
                                    <i class="bi bi-file-earmark-excel-fill me-2"></i> Export Borang LAMTEKNIK
                                </h4>
                                <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                                    Unduh seluruh data tabel yang telah Anda isi ke dalam format Excel (.xlsx) resmi. Sistem otomatis memfilter data Prodi Anda.
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('export.excel') }}" class="btn btn-light text-success fw-bold px-4 py-3 shadow-sm" style="border-radius: 50px; white-space: nowrap;">
                                    <i class="bi bi-cloud-arrow-down-fill me-2 fs-5 align-middle"></i> Unduh Excel
                                </a>
                            </div>
                        </div>
                    </div>

                    <h5 class="fw-bold text-secondary mb-3"><i class="bi bi-table me-2"></i>Daftar Tabel LKPS</h5>

                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4 mb-5">
                        
                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box text-dark"><i class="bi bi-eye-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 1.a</h5>
                                    <h6 class="text-muted mb-3 fs-6">Visi, Misi, Tujuan & Strategi</h6>
                                    <p class="card-text text-secondary mb-4 fs-6">Kesesuaian Visi, Misi, Tujuan, dan Strategi Program Studi.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('visi_misi.index') }}" class="btn btn-outline-dark w-100 btn-pill">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box text-primary"><i class="bi bi-mortarboard-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 2.a.1</h5>
                                    <h6 class="text-muted mb-3 fs-6">Kerjasama Pendidikan</h6>
                                    <p class="card-text text-secondary mb-4 fs-6">Kerjasama Tridharma Perguruan Tinggi bidang Pendidikan.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('kerjasama_pendidikan.index') }}" class="btn btn-outline-primary w-100 btn-pill">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box text-success"><i class="bi bi-search"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 2.a.2</h5>
                                    <h6 class="text-muted mb-3 fs-6">Kerjasama Penelitian</h6>
                                    <p class="card-text text-secondary mb-4 fs-6">Kerjasama Tridharma Perguruan Tinggi bidang Penelitian.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('kerjasama_penelitian.index') }}" class="btn btn-outline-success w-100 btn-pill">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box text-info"><i class="bi bi-people-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 2.a.3</h5>
                                    <h6 class="text-muted mb-3 fs-6">Kerjasama PkM</h6>
                                    <p class="card-text text-secondary mb-4 fs-6">Kerjasama Tridharma Perguruan Tinggi bidang PkM.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('kerjasama_pengabdian.index') }}" class="btn btn-outline-info w-100 btn-pill">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box text-success"><i class="bi bi-cash-coin"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 2.b</h5>
                                    <h6 class="text-muted mb-3 fs-6">Penggunaan Dana</h6>
                                    <p class="card-text text-secondary mb-4 fs-6">Alokasi biaya operasional dan investasi Fakultas dan Program Studi.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('penggunaan_dana.index') }}" class="btn btn-outline-success w-100 btn-pill">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box text-info"><i class="bi bi-book-half"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 3.a.1</h5>
                                    <h6 class="text-muted mb-3 fs-6">Kurikulum & Capaian</h6>
                                    <p class="card-text text-secondary mb-4 fs-6">Kesesuaian kurikulum dengan capaian pembelajaran dan rencana.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('kurikulum.index') }}" class="btn btn-outline-info w-100 btn-pill">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box text-warning"><i class="bi bi-journal-text"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 3.a.2</h5>
                                    <h6 class="text-muted mb-3 fs-6">Mata Kuliah & Konversi</h6>
                                    <p class="card-text text-secondary mb-4 fs-6">Pendataan bobot SKS, konversi jam, dan dokumen RPS.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('dokumen_pembelajaran.index') }}" class="btn btn-outline-warning w-100 btn-pill">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box text-primary"><i class="bi bi-diagram-3-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 3.a.3</h5>
                                    <h6 class="text-muted mb-3 fs-6">Integrasi Penelitian/PkM</h6>
                                    <p class="card-text text-secondary mb-4 fs-6">Penelitian & PkM dosen yang diintegrasikan ke mata kuliah.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('integrasi_pembelajaran.index') }}" class="btn btn-outline-primary w-100 btn-pill">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #6f42c1;"><i class="bi bi-calculator"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 3.a.4</h5>
                                    <h6 class="text-muted mb-3 fs-6">Basic Science</h6>
                                    <p class="card-text text-secondary mb-4 fs-6">Mata kuliah rumpun Basic Science dan Matematika.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('matkul_basic_science.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="color: #6f42c1; border-color: #6f42c1;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box text-danger"><i class="bi bi-layers"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 3.a.5</h5>
                                    <h6 class="text-muted mb-3 fs-6">Capstone Design</h6>
                                    <p class="card-text text-secondary mb-4 fs-6">Mata kuliah pendukung dan Capstone Design beserta bahasan.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('capstone_design.index') }}" class="btn btn-outline-danger w-100 btn-pill">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box text-warning"><i class="bi bi-journal-richtext"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 3.b</h5>
                                    <h6 class="text-muted mb-3 fs-6">Penelitian DTPS</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data sumber pembiayaan dan jumlah judul penelitian DTPS dalam 3 tahun.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('penelitian_dtps.index') }}" class="btn btn-outline-warning w-100 btn-pill">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #fd7e14;"><i class="bi bi-megaphone-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 3.c</h5>
                                    <h6 class="text-muted mb-3 fs-6">PkM DTPS</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data sumber pembiayaan dan jumlah judul Pengabdian kepada Masyarakat (PkM) DTPS.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('pkm_dtps.index') }}" class="btn btn-outline-warning w-100 btn-pill" style="color: #fd7e14; border-color: #fd7e14;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box text-primary"><i class="bi bi-person-vcard-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.a</h5>
                                    <h6 class="text-muted mb-3 fs-6">Profil Dosen</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data profil, pendidikan, kepangkatan, sertifikasi, dan bidang keahlian dosen.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('profil_dosen.index') }}" class="btn btn-outline-primary w-100 btn-pill">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box text-success"><i class="bi bi-person-gear"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.b</h5>
                                    <h6 class="text-muted mb-3 fs-6">Tenaga Kependidikan</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data Laboran, Teknisi, dan Administrator Sistem.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('tenaga_kependidikan.index') }}" class="btn btn-outline-success w-100 btn-pill">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box text-danger"><i class="bi bi-file-earmark-bar-graph"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.c</h5>
                                    <h6 class="text-muted mb-3 fs-6">Beban Kerja Dosen</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data beban SKS dosen untuk pendidikan, penelitian, PkM, dan tugas tambahan.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('beban_kerja_dosen.index') }}" class="btn btn-outline-danger w-100 btn-pill">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #8b5cf6;"><i class="bi bi-journal-text"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.d</h5>
                                    <h6 class="text-muted mb-3 fs-6">Publikasi Ilmiah DTPS</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data rekapan jumlah Jurnal dan Prosiding dosen dalam 3 tahun terakhir.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('publikasi_ilmiah_dtps.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="color: #8b5cf6; border-color: #8b5cf6;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #ec4899;"><i class="bi bi-easel2-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.e</h5>
                                    <h6 class="text-muted mb-3 fs-6">Karya Ilmiah / Pameran</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data rekapan Pagelaran, Pameran, Presentasi, dan Publikasi Ilmiah DTPS.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('karya_ilmiah_dtps.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="color: #ec4899; border-color: #ec4899;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #06b6d4;"><i class="bi bi-award-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.f (1)</h5>
                                    <h6 class="text-muted mb-3 fs-6">Luaran HKI (Paten)</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data luaran penelitian dan PkM berupa Hak Kekayaan Intelektual (Paten & Paten Sederhana).</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('luaran_hki_paten.index') }}" class="btn btn-outline-info w-100 btn-pill" style="color: #06b6d4; border-color: #06b6d4;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #0ea5e9;"><i class="bi bi-shield-check"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.f (2)</h5>
                                    <h6 class="text-muted mb-3 fs-6">HKI (Hak Cipta, dll)</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data luaran berupa Hak Cipta, Desain Produk Industri, dan Desain Tata Letak Sirkuit.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('luaran_hki_hak_cipta.index') }}" class="btn btn-outline-info w-100 btn-pill" style="color: #0ea5e9; border-color: #0ea5e9;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #f59e0b;"><i class="bi bi-cpu-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.f (3)</h5>
                                    <h6 class="text-muted mb-3 fs-6">Teknologi & Produk</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data luaran berupa Teknologi Tepat Guna, Produk Terstandarisasi/Tersertifikasi, dan Rekayasa Sosial.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('luaran_teknologi_produk.index') }}" class="btn btn-outline-warning w-100 btn-pill" style="color: #f59e0b; border-color: #f59e0b;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #6366f1;"><i class="bi bi-book-half"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.f (4)</h5>
                                    <h6 class="text-muted mb-3 fs-6">Buku Ber-ISBN</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data luaran berupa Buku Ber-ISBN dan Book Chapter yang dihasilkan oleh DTPS.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('luaran_buku_isbn.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="color: #6366f1; border-color: #6366f1;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #14b8a6;"><i class="bi bi-box-seam-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.g</h5>
                                    <h6 class="text-muted mb-3 fs-6">Produk/Jasa DTPS</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data produk atau jasa karya DTPS yang telah diadopsi oleh industri atau masyarakat.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('produk_jasa_dtps.index') }}" class="btn btn-outline-info w-100 btn-pill" style="color: #14b8a6; border-color: #14b8a6;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #ef4444;"><i class="bi bi-bar-chart-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.h</h5>
                                    <h6 class="text-muted mb-3 fs-6">Kinerja DTPS</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data kinerja DTPS dalam mendukung keunggulan kompetitif (Jurnal Bereputasi & Paten).</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('kinerja_dtps.index') }}" class="btn btn-outline-danger w-100 btn-pill">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #8b5cf6;"><i class="bi bi-quote"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.i</h5>
                                    <h6 class="text-muted mb-3 fs-6">Sitasi Karya Ilmiah</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data karya ilmiah DTPS yang disitasi dalam 3 tahun terakhir.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('karya_ilmiah_sitasi.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="color: #8b5cf6; border-color: #8b5cf6;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #d946ef;"><i class="bi bi-patch-check-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.j</h5>
                                    <h6 class="text-muted mb-3 fs-6">Rekognisi DTPS</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data pengakuan dan penghargaan yang diterima oleh DTPS pada tingkat wilayah, nasional, maupun internasional.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('pengakuan_dtps.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="color: #d946ef; border-color: #d946ef;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #059669;"><i class="bi bi-person-workspace"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.k</h5>
                                    <h6 class="text-muted mb-3 fs-6">Pembimbing Lapangan</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data pembimbing lapangan khusus untuk Program Studi Profesi Insinyur.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('pembimbing_lapangan.index') }}" class="btn btn-outline-success w-100 btn-pill">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #0284c7;"><i class="bi bi-pc-display"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 5.a</h5>
                                    <h6 class="text-muted mb-3 fs-6">Prasarana & Alat Utama</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data prasarana (ruang kelas/lab) beserta alat peraga dan tingkat kepemilikannya.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('prasarana_peralatan.index') }}" class="btn btn-outline-info w-100 btn-pill" style="color: #0284c7; border-color: #0284c7;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #f59e0b;"><i class="bi bi-shield-plus"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 5.b</h5>
                                    <h6 class="text-muted mb-3 fs-6">Dokumen K3L</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data dokumen Kesehatan, Keselamatan Kerja, dan Lingkungan (K3L) di UPPS.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('dokumen_k3l.index') }}" class="btn btn-outline-warning w-100 btn-pill" style="color: #f59e0b; border-color: #f59e0b;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #ef4444;"><i class="bi bi-fire"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 5.c</h5>
                                    <h6 class="text-muted mb-3 fs-6">Fasilitas K3L</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data fasilitas Keselamatan, Kesehatan Kerja, dan Lingkungan (K3L) fisik yang ada di UPPS.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('fasilitas_k3l.index') }}" class="btn btn-outline-danger w-100 btn-pill">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #10b981;"><i class="bi bi-people-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.a</h5>
                                    <h6 class="text-muted mb-3 fs-6">Jumlah Mahasiswa</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data tren jumlah mahasiswa aktif reguler dan mahasiswa asing dalam 3 tahun terakhir.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('jumlah_mahasiswa.index') }}" class="btn btn-outline-success w-100 btn-pill">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #6366f1;"><i class="bi bi-award-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.b</h5>
                                    <h6 class="text-muted mb-3 fs-6">IPK Lulusan</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data tren Indeks Prestasi Kumulatif (IPK) minimum, rata-rata, dan maksimum lulusan dalam 3 tahun.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('ipk_lulusan.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="color: #6366f1; border-color: #6366f1;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #eab308;"><i class="bi bi-trophy-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.c.1</h5>
                                    <h6 class="text-muted mb-3 fs-6">Prestasi Akademik</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data capaian prestasi akademik mahasiswa tingkat lokal, nasional, dan internasional.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('prestasi_akademik.index') }}" class="btn btn-outline-warning w-100 btn-pill" style="color: #eab308; border-color: #eab308;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #ec4899;"><i class="bi bi-palette-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.c.2</h5>
                                    <h6 class="text-muted mb-3 fs-6">Prestasi Non-Akademik</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data capaian prestasi mahasiswa di bidang olahraga, seni, atau kegiatan non-akademik lainnya.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('prestasi_non_akademik.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="color: #ec4899; border-color: #ec4899;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #8b5cf6;"><i class="bi bi-hourglass-split"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.d</h5>
                                    <h6 class="text-muted mb-3 fs-6">Masa Studi Lulusan</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data tren masa studi kelulusan mahasiswa yang dilacak dari TS-7 hingga TS.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('masa_studi_lulusan.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="color: #8b5cf6; border-color: #8b5cf6;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #0ea5e9;"><i class="bi bi-journal-text"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.e.1</h5>
                                    <h6 class="text-muted mb-3 fs-6">Publikasi Mahasiswa</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data rekapitulasi karya ilmiah mahasiswa dalam bentuk jurnal maupun prosiding selama 3 tahun.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('publikasi_ilmiah_mahasiswa.index') }}" class="btn btn-outline-info w-100 btn-pill" style="color: #0ea5e9; border-color: #0ea5e9;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #0d9488;"><i class="bi bi-easel"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.e.2</h5>
                                    <h6 class="text-muted mb-3 fs-6">Pagelaran Terapan</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data pagelaran, pameran, presentasi, atau publikasi ilmiah khusus untuk Program Studi Terapan.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('publikasi_mahasiswa_terapan.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="color: #0d9488; border-color: #0d9488;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #f97316;"><i class="bi bi-lightbulb-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.e.3</h5>
                                    <h6 class="text-muted mb-3 fs-6">HKI Mahasiswa (Paten)</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data luaran penelitian dan PkM mahasiswa berupa Hak Kekayaan Intelektual (Paten).</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('luaran_hki_mahasiswa.index') }}" class="btn btn-outline-warning w-100 btn-pill" style="color: #f97316; border-color: #f97316;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #f97316;"><i class="bi bi-c-circle-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.e.3-2</h5>
                                    <h6 class="text-muted mb-3 fs-6">HKI Bagian 2</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data luaran penelitian dan PkM mahasiswa berupa HKI (Hak Cipta, Desain Produk Industri, dll).</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('luaran_hki_bagian2.index') }}" class="btn btn-outline-warning w-100 btn-pill" style="color: #f97316; border-color: #f97316;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #0dcaf0;"><i class="bi bi-cpu-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.e.3-3</h5>
                                    <h6 class="text-muted mb-3 fs-6">TTG / Produk</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data luaran penelitian mahasiswa berupa Teknologi Tepat Guna atau Produk (Tersertifikasi).</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('luaran_hki_bagian3.index') }}" class="btn btn-outline-info w-100 btn-pill" style="border-color: #0dcaf0; color: #087f96;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #6f42c1;"><i class="bi bi-book-half"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.e.3-4</h5>
                                    <h6 class="text-muted mb-3 fs-6">Buku Ber-ISBN</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data luaran penelitian dan PkM mahasiswa berupa Buku ber-ISBN atau Book Chapter yang terbit.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('luaran_hki_bagian4.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="border-color: #6f42c1; color: #6f42c1;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #198754;"><i class="bi bi-box-seam-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.e.4</h5>
                                    <h6 class="text-muted mb-3 fs-6">Produk/Jasa Mahasiswa</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data luaran berupa Produk/Jasa mahasiswa yang telah diadopsi oleh Industri atau Masyarakat.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('produk_jasa_mahasiswa.index') }}" class="btn btn-outline-success w-100 btn-pill" style="border-color: #198754; color: #198754;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #fd7e14;"><i class="bi bi-stopwatch-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.f.1</h5>
                                    <h6 class="text-muted mb-3 fs-6">Waktu Tunggu Lulusan</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data masa tunggu lulusan Program Sarjana untuk mendapatkan pekerjaan pertama.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('waktu_tunggu_lulusan.index') }}" class="btn btn-outline-warning w-100 btn-pill text-dark" style="border-color: #fd7e14; color: #fd7e14;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #0dcaf0;"><i class="bi bi-clipboard2-data-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.f.2</h5>
                                    <h6 class="text-muted mb-3 fs-6">Kesesuaian Bidang Kerja</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data tingkat kesesuaian bidang kerja lulusan saat mendapatkan pekerjaan pertama.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('kesesuaian_bidang_kerja.index') }}" class="btn btn-outline-info w-100 btn-pill" style="border-color: #0dcaf0; color: #087f96;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #6610f2;"><i class="bi bi-buildings-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.g.1</h5>
                                    <h6 class="text-muted mb-3 fs-6">Tempat Kerja Lulusan</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data lulusan yang terlacak bekerja berdasarkan tingkat tempat kerja atau berwirausaha.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('tempat_kerja_lulusan.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="border-color: #6610f2; color: #6610f2;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #d63384;"><i class="bi bi-emoji-smile-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.g.2</h5>
                                    <h6 class="text-muted mb-3 fs-6">Kepuasan Pengguna</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data tingkat kepuasan pihak pengguna terhadap kinerja lulusan (dalam persentase).</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('kepuasan_pengguna_lulusan.index') }}" class="btn btn-outline-danger w-100 btn-pill" style="border-color: #d63384; color: #d63384;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #20c997;"><i class="bi bi-diagram-3-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.h.1</h5>
                                    <h6 class="text-muted mb-3 fs-6">Penelitian DTPS & Mhs</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data penelitian Dosen Tetap Perguruan Tinggi yang pelaksanaannya melibatkan mahasiswa.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('penelitian_dtps_mahasiswa.index') }}" class="btn btn-outline-success w-100 btn-pill" style="border-color: #20c997; color: #20c997;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #fd7e14;"><i class="bi bi-journal-bookmark-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.h.2</h5>
                                    <h6 class="text-muted mb-3 fs-6">Penelitian Rujukan Tesis</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data penelitian DTPS yang menjadi rujukan tema Tesis atau Disertasi mahasiswa.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('penelitian_dtps_rujukan.index') }}" class="btn btn-outline-warning w-100 btn-pill text-dark" style="border-color: #fd7e14; color: #fd7e14;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #0dcaf0;"><i class="bi bi-people-fill"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.i</h5>
                                    <h6 class="text-muted mb-3 fs-6">PkM DTPS & Mahasiswa</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data kegiatan PkM DTPS yang pelaksanaannya melibatkan mahasiswa.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('pkm_dtps_mahasiswa.index') }}" class="btn btn-outline-info w-100 btn-pill" style="border-color: #0dcaf0; color: #087f96;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #198754;"><i class="bi bi-shield-check"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 7.a</h5>
                                    <h6 class="text-muted mb-3 fs-6">Dokumen SPMI</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data ketersediaan Dokumen/Buku Sistem Penjaminan Mutu Internal (SPMI) program studi.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('dokumen_spmi.index') }}" class="btn btn-outline-success w-100 btn-pill" style="border-color: #198754; color: #198754;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-lkps shadow-sm h-100 p-3 border">
                                <div class="card-body d-flex flex-column">
                                    <div class="icon-box" style="color: #6f42c1;"><i class="bi bi-ui-checks"></i></div>
                                    <h5 class="card-title fw-bold text-dark mb-1">Tabel 7.b</h5>
                                    <h6 class="text-muted mb-3 fs-6">Pelaksanaan SPMI</h6>
                                    <p class="card-text text-secondary mb-4 fs-6 small">Data ketersediaan bukti pelaksanaan Sistem Penjaminan Mutu Internal (Siklus PPEPP).</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('pelaksanaan_spmi.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="border-color: #6f42c1; color: #6f42c1;">Isi Data <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div> </div>
        </div>
    </div>
</x-app-layout>