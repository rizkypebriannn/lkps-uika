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
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h4 class="mb-4 fw-bold">Daftar Tabel LKPS Lamteknik</h4>
                <div class="mb-5" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 1.5rem; padding: 2rem; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.2);">
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="text-white mb-3 mb-md-0">
                            <h4 class="fw-bold mb-2" style="font-size: 1.5rem;">
                                <i class="bi bi-file-earmark-excel-fill me-2"></i> Export Borang LAMTEKNIK
                            </h4>
                            <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                                Unduh seluruh data tabel yang telah Anda isi ke dalam format Excel (.xlsx) resmi. Sistem akan otomatis memfilter data sesuai Program Studi Anda.
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('export.excel') }}" class="btn btn-light text-success fw-bold px-4 py-3 shadow-sm" style="border-radius: 50px; white-space: nowrap;">
                                <i class="bi bi-cloud-arrow-down-fill me-2 fs-5 align-middle"></i> Unduh Excel
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    
                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box text-dark">
                                    <i class="bi bi-eye-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 1.a</h5>
                                <h6 class="text-muted mb-3 fs-6">Visi, Misi, Tujuan & Strategi</h6>
                                <p class="card-text text-secondary mb-4 fs-6">Kesesuaian Visi, Misi, Tujuan, dan Strategi Program Studi.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('visi_misi.index') }}" class="btn btn-outline-dark w-100 btn-pill">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box text-primary">
                                    <i class="bi bi-mortarboard-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 2.a.1</h5>
                                <h6 class="text-muted mb-3 fs-6">Kerjasama Pendidikan</h6>
                                <p class="card-text text-secondary mb-4 fs-6">Kerjasama Tridharma Perguruan Tinggi bidang Pendidikan.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('kerjasama_pendidikan.index') }}" class="btn btn-outline-primary w-100 btn-pill">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box text-success">
                                    <i class="bi bi-search"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 2.a.2</h5>
                                <h6 class="text-muted mb-3 fs-6">Kerjasama Penelitian</h6>
                                <p class="card-text text-secondary mb-4 fs-6">Kerjasama Tridharma Perguruan Tinggi bidang Penelitian.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('kerjasama_penelitian.index') }}" class="btn btn-outline-success w-100 btn-pill">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box text-info">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 2.a.3</h5>
                                <h6 class="text-muted mb-3 fs-6">Kerjasama PkM</h6>
                                <p class="card-text text-secondary mb-4 fs-6">Kerjasama Tridharma Perguruan Tinggi bidang PkM.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('kerjasama_pengabdian.index') }}" class="btn btn-outline-info w-100 btn-pill">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box text-success">
                                    <i class="bi bi-cash-coin"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 2.b</h5>
                                <h6 class="text-muted mb-3 fs-6">Penggunaan Dana</h6>
                                <p class="card-text text-secondary mb-4 fs-6">Alokasi biaya operasional dan investasi Fakultas dan Program Studi.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('penggunaan_dana.index') }}" class="btn btn-outline-success w-100 btn-pill">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box text-info">
                                    <i class="bi bi-book-half"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 3.a.1</h5>
                                <h6 class="text-muted mb-3 fs-6">Kurikulum & Capaian</h6>
                                <p class="card-text text-secondary mb-4 fs-6">Kesesuaian kurikulum dengan capaian pembelajaran dan rencana pembelajaran.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('kurikulum.index') }}" class="btn btn-outline-info w-100 btn-pill">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box text-warning">
                                    <i class="bi bi-journal-text"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 3.a.2</h5>
                                <h6 class="text-muted mb-3 fs-6">Mata Kuliah & Konversi</h6>
                                <p class="card-text text-secondary mb-4 fs-6">Pendataan bobot SKS, konversi jam, dan dokumen RPS.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('dokumen_pembelajaran.index') }}" class="btn btn-outline-warning w-100 btn-pill">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box text-primary">
                                    <i class="bi bi-diagram-3-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 3.a.3</h5>
                                <h6 class="text-muted mb-3 fs-6">Integrasi Penelitian/PkM</h6>
                                <p class="card-text text-secondary mb-4 fs-6">Penelitian & PkM dosen yang diintegrasikan ke mata kuliah.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('integrasi_pembelajaran.index') }}" class="btn btn-outline-primary w-100 btn-pill">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #6f42c1;">
                                    <i class="bi bi-calculator"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 3.a.4</h5>
                                <h6 class="text-muted mb-3 fs-6">Basic Science & Matematika</h6>
                                <p class="card-text text-secondary mb-4 fs-6">Mata kuliah rumpun Basic Science dan Matematika.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('matkul_basic_science.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="color: #6f42c1; border-color: #6f42c1;">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box text-danger">
                                    <i class="bi bi-layers"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 3.a.5</h5>
                                <h6 class="text-muted mb-3 fs-6">Capstone Design</h6>
                                <p class="card-text text-secondary mb-4 fs-6">Mata kuliah pendukung dan Capstone Design beserta bahasan.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('capstone_design.index') }}" class="btn btn-outline-danger w-100 btn-pill">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box text-warning">
                                    <i class="bi bi-journal-richtext"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 3.b</h5>
                                <h6 class="text-muted mb-3 fs-6">Penelitian DTPS</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data sumber pembiayaan dan jumlah judul penelitian DTPS dalam 3 tahun terakhir.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('penelitian_dtps.index') }}" class="btn btn-outline-warning w-100 btn-pill">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #fd7e14;">
                                    <i class="bi bi-megaphone-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 3.c</h5>
                                <h6 class="text-muted mb-3 fs-6">PkM DTPS</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data sumber pembiayaan dan jumlah judul Pengabdian kepada Masyarakat (PkM) DTPS.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('pkm_dtps.index') }}" class="btn btn-outline-warning w-100 btn-pill" style="color: #fd7e14; border-color: #fd7e14;">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box text-primary">
                                    <i class="bi bi-person-vcard-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.a</h5>
                                <h6 class="text-muted mb-3 fs-6">Profil Dosen</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data profil, pendidikan, kepangkatan, sertifikasi, dan bidang keahlian dosen.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('profil_dosen.index') }}" class="btn btn-outline-primary w-100 btn-pill">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box text-success">
                                    <i class="bi bi-person-gear"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.b</h5>
                                <h6 class="text-muted mb-3 fs-6">Tenaga Kependidikan</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data Laboran, Teknisi, dan Administrator Sistem.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('tenaga_kependidikan.index') }}" class="btn btn-outline-success w-100 btn-pill">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box text-danger">
                                    <i class="bi bi-file-earmark-bar-graph"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.c</h5>
                                <h6 class="text-muted mb-3 fs-6">Beban Kerja Dosen</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data beban SKS dosen untuk pendidikan, penelitian, PkM, dan tugas tambahan.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('beban_kerja_dosen.index') }}" class="btn btn-outline-danger w-100 btn-pill">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #8b5cf6;">
                                    <i class="bi bi-journal-text"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.d</h5>
                                <h6 class="text-muted mb-3 fs-6">Publikasi Ilmiah DTPS</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data rekapan jumlah Jurnal dan Prosiding dosen dalam 3 tahun terakhir.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('publikasi_ilmiah_dtps.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="color: #8b5cf6; border-color: #8b5cf6;">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #ec4899;">
                                    <i class="bi bi-easel2-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.e</h5>
                                <h6 class="text-muted mb-3 fs-6">Karya Ilmiah / Pameran</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data rekapan Pagelaran, Pameran, Presentasi, dan Publikasi Ilmiah DTPS.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('karya_ilmiah_dtps.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="color: #ec4899; border-color: #ec4899;">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #06b6d4;">
                                    <i class="bi bi-award-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.f (1)</h5>
                                <h6 class="text-muted mb-3 fs-6">Luaran HKI (Paten)</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data luaran penelitian dan PkM berupa Hak Kekayaan Intelektual (Paten & Paten Sederhana).</p>
                                <div class="mt-auto">
                                    <a href="{{ route('luaran_hki_paten.index') }}" class="btn btn-outline-info w-100 btn-pill" style="color: #06b6d4; border-color: #06b6d4;">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #0ea5e9;">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.f (2)</h5>
                                <h6 class="text-muted mb-3 fs-6">HKI (Hak Cipta, dll)</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data luaran berupa Hak Cipta, Desain Produk Industri, dan Desain Tata Letak Sirkuit.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('luaran_hki_hak_cipta.index') }}" class="btn btn-outline-info w-100 btn-pill" style="color: #0ea5e9; border-color: #0ea5e9;">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #f59e0b;">
                                    <i class="bi bi-cpu-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.f (3)</h5>
                                <h6 class="text-muted mb-3 fs-6">Teknologi & Produk</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data luaran berupa Teknologi Tepat Guna, Produk Terstandarisasi/Tersertifikasi, dan Rekayasa Sosial.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('luaran_teknologi_produk.index') }}" class="btn btn-outline-warning w-100 btn-pill" style="color: #f59e0b; border-color: #f59e0b;">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #6366f1;">
                                    <i class="bi bi-book-half"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.f (4)</h5>
                                <h6 class="text-muted mb-3 fs-6">Buku Ber-ISBN</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data luaran berupa Buku Ber-ISBN dan Book Chapter yang dihasilkan oleh DTPS.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('luaran_buku_isbn.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="color: #6366f1; border-color: #6366f1;">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #14b8a6;">
                                    <i class="bi bi-box-seam-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.g</h5>
                                <h6 class="text-muted mb-3 fs-6">Produk/Jasa DTPS</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data produk atau jasa karya DTPS yang telah diadopsi oleh industri atau masyarakat.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('produk_jasa_dtps.index') }}" class="btn btn-outline-info w-100 btn-pill" style="color: #14b8a6; border-color: #14b8a6;">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #ef4444;">
                                    <i class="bi bi-bar-chart-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.h</h5>
                                <h6 class="text-muted mb-3 fs-6">Kinerja DTPS</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data kinerja DTPS dalam mendukung keunggulan kompetitif (Jurnal Bereputasi & Paten).</p>
                                <div class="mt-auto">
                                    <a href="{{ route('kinerja_dtps.index') }}" class="btn btn-outline-danger w-100 btn-pill">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #8b5cf6;">
                                    <i class="bi bi-quote"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.i</h5>
                                <h6 class="text-muted mb-3 fs-6">Sitasi Karya Ilmiah</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data karya ilmiah DTPS yang disitasi dalam 3 tahun terakhir.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('karya_ilmiah_sitasi.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="color: #8b5cf6; border-color: #8b5cf6;">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #d946ef;">
                                    <i class="bi bi-patch-check-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.j</h5>
                                <h6 class="text-muted mb-3 fs-6">Rekognisi DTPS</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data pengakuan dan penghargaan yang diterima oleh DTPS pada tingkat wilayah, nasional, maupun internasional.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('pengakuan_dtps.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="color: #d946ef; border-color: #d946ef;">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #059669;">
                                    <i class="bi bi-person-workspace"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 4.k</h5>
                                <h6 class="text-muted mb-3 fs-6">Pembimbing Lapangan</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data pembimbing lapangan khusus untuk Program Studi Profesi Insinyur.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('pembimbing_lapangan.index') }}" class="btn btn-outline-success w-100 btn-pill">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #0284c7;">
                                    <i class="bi bi-pc-display"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 5.a</h5>
                                <h6 class="text-muted mb-3 fs-6">Prasarana & Alat Utama</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data prasarana (ruang kelas/lab) beserta alat peraga dan tingkat kepemilikannya.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('prasarana_peralatan.index') }}" class="btn btn-outline-info w-100 btn-pill" style="color: #0284c7; border-color: #0284c7;">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #f59e0b;">
                                    <i class="bi bi-shield-plus"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 5.b</h5>
                                <h6 class="text-muted mb-3 fs-6">Dokumen K3L</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data dokumen Kesehatan, Keselamatan Kerja, dan Lingkungan (K3L) di UPPS.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('dokumen_k3l.index') }}" class="btn btn-outline-warning w-100 btn-pill" style="color: #f59e0b; border-color: #f59e0b;">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #ef4444;">
                                    <i class="bi bi-fire"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 5.c</h5>
                                <h6 class="text-muted mb-3 fs-6">Fasilitas K3L</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data fasilitas Keselamatan, Kesehatan Kerja, dan Lingkungan (K3L) fisik yang ada di UPPS.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('fasilitas_k3l.index') }}" class="btn btn-outline-danger w-100 btn-pill">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #10b981;">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.a</h5>
                                <h6 class="text-muted mb-3 fs-6">Jumlah Mahasiswa</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data tren jumlah mahasiswa aktif reguler dan mahasiswa asing dalam 3 tahun terakhir.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('jumlah_mahasiswa.index') }}" class="btn btn-outline-success w-100 btn-pill">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #6366f1;">
                                    <i class="bi bi-award-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.b</h5>
                                <h6 class="text-muted mb-3 fs-6">IPK Lulusan</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data tren Indeks Prestasi Kumulatif (IPK) minimum, rata-rata, dan maksimum lulusan dalam 3 tahun terakhir.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('ipk_lulusan.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="color: #6366f1; border-color: #6366f1;">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #eab308;">
                                    <i class="bi bi-trophy-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.c.1</h5>
                                <h6 class="text-muted mb-3 fs-6">Prestasi Akademik</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data capaian prestasi akademik mahasiswa tingkat lokal, nasional, dan internasional.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('prestasi_akademik.index') }}" class="btn btn-outline-warning w-100 btn-pill" style="color: #eab308; border-color: #eab308;">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #ec4899;">
                                    <i class="bi bi-palette-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.c.2</h5>
                                <h6 class="text-muted mb-3 fs-6">Prestasi Non-Akademik</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data capaian prestasi mahasiswa di bidang olahraga, seni, atau kegiatan non-akademik lainnya.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('prestasi_non_akademik.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="color: #ec4899; border-color: #ec4899;">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
 
                    <div class="col-md-6 col-lg-4 mb-4"> <div class="card card-lkps shadow-sm h-100 p-3 border">
        <div class="card-body d-flex flex-column">
            <div class="icon-box" style="color: #8b5cf6;">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.d</h5>
            <h6 class="text-muted mb-3 fs-6">Masa Studi Lulusan</h6>
            <p class="card-text text-secondary mb-4 fs-6 small">Data tren masa studi kelulusan mahasiswa yang dilacak dari TS-7 hingga TS.</p>
            <div class="mt-auto">
                <a href="{{ route('masa_studi_lulusan.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="color: #8b5cf6; border-color: #8b5cf6;">
                    Isi Data <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

            <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #0ea5e9;">
                                    <i class="bi bi-journal-text"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.e.1</h5>
                                <h6 class="text-muted mb-3 fs-6">Publikasi Mahasiswa</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data rekapitulasi karya ilmiah mahasiswa dalam bentuk jurnal maupun prosiding selama 3 tahun terakhir.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('publikasi_ilmiah_mahasiswa.index') }}" class="btn btn-outline-info w-100 btn-pill" style="color: #0ea5e9; border-color: #0ea5e9;">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #0d9488;">
                                    <i class="bi bi-easel"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.e.2</h5>
                                <h6 class="text-muted mb-3 fs-6">Pagelaran/Publikasi Terapan</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data pagelaran, pameran, presentasi, atau publikasi ilmiah khusus untuk Program Studi Terapan.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('publikasi_mahasiswa_terapan.index') }}" class="btn btn-outline-primary w-100 btn-pill" style="color: #0d9488; border-color: #0d9488;">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card card-lkps shadow-sm h-100 p-3 border">
                            <div class="card-body d-flex flex-column">
                                <div class="icon-box" style="color: #f97316;">
                                    <i class="bi bi-lightbulb-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.e.3</h5>
                                <h6 class="text-muted mb-3 fs-6">HKI Mahasiswa (Paten)</h6>
                                <p class="card-text text-secondary mb-4 fs-6 small">Data luaran penelitian dan PkM mahasiswa berupa Hak Kekayaan Intelektual (Paten & Paten Sederhana).</p>
                                <div class="mt-auto">
                                    <a href="{{ route('luaran_hki_mahasiswa.index') }}" class="btn btn-outline-warning w-100 btn-pill" style="color: #f97316; border-color: #f97316;">
                                        Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-4">
                     <div class="card card-lkps shadow-sm h-100 p-3 border">
                        <div class="card-body d-flex flex-column">
                            <div class="icon-box" style="color: #f97316;">
                                <i class="bi bi-c-circle-fill"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-1">Tabel 6.e.3-2</h5>
                            <h6 class="text-muted mb-3 fs-6">HKI Bagian 2 (Hak Cipta, dll)</h6>
                            <p class="card-text text-secondary mb-4 fs-6 small">Data luaran penelitian dan PkM mahasiswa berupa HKI (Hak Cipta, Desain Produk Industri, dll).</p>
                            <div class="mt-auto">
                                <a href="{{ route('luaran_hki_bagian2.index') }}" class="btn btn-outline-warning w-100 btn-pill" style="color: #f97316; border-color: #f97316;">
                                    Isi Data <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            
        
                
      

                </div> </div>
        </div>
    </div>
</x-app-layout>