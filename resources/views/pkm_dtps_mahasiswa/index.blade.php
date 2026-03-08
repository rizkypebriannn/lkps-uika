<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 6.i PkM DTPS Melibatkan Mahasiswa - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
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
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Pengabdian kepada Masyarakat (PkM) DTPS Melibatkan Mahasiswa</h5>
                
                <form action="{{ route('pkm_dtps_mahasiswa.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Nama Dosen</label>
                            <input type="text" name="nama_dosen" class="form-control rounded-3" placeholder="Contoh: Dr. Budi Santoso..." required>
                        </div>
                       <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Nama Mahasiswa <span class="text-muted fw-normal">(Bisa > 1)</span></label>
                            <div id="mahasiswa-container">
                                <div class="d-flex mb-2">
                                    <input type="text" name="nama_mahasiswa[]" class="form-control rounded-3 me-2" placeholder="Contoh: Siti Aminah..." required>
                                    <button type="button" class="btn btn-primary rounded-3 px-3 shadow-sm" onclick="addMahasiswa()" title="Tambah Mahasiswa"><i class="bi bi-plus-lg"></i></button>
                                </div>
                            </div>
                        </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Tema PkM sesuai Peta Jalan</label>
                        <input type="text" name="tema_pkm" class="form-control rounded-3" placeholder="Contoh: Pemberdayaan UMKM Digital..." required>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-9">
                            <label class="form-label fw-semibold text-sm">Judul Kegiatan PkM</label>
                            <input type="text" name="judul_kegiatan" class="form-control rounded-3" placeholder="Contoh: Pelatihan Pemasaran Digital bagi UMKM Desa X..." required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-sm">Tahun (YYYY)</label>
                            <input type="text" name="tahun" class="form-control rounded-3" placeholder="Contoh: 2024" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA PKM
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Data PkM Tersimpan ({{ $data->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%" class="text-start">Nama Dosen</th>
                                <th width="20%" class="text-start">Tema PkM</th>
                                <th width="15%" class="text-start">Nama Mahasiswa</th>
                                <th width="30%" class="text-start">Judul Kegiatan PkM</th>
                                <th width="10%">Tahun</th>
                                <th width="5%">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start fw-bold">{{ $item->nama_dosen }}</td>
                                <td class="text-start" style="font-size: 0.85rem;">{{ $item->tema_pkm }}</td>
                                <td class="text-start">
                                    @php
                                        // Pecah berdasarkan koma, lalu bersihkan spasi ekstra di kiri/kanan nama
                                        $daftar_mhs = array_filter(array_map('trim', explode(',', $item->nama_mahasiswa)));
                                    @endphp
                                    
                                    @if(count($daftar_mhs) > 1)
                                        <ol class="mb-0 text-start" style="padding-left: 1.2rem; margin-top: 0;">
                                            @foreach($daftar_mhs as $mhs)
                                                <li>{{ $mhs }}</li>
                                            @endforeach
                                        </ol>
                                    @else
                                        {{ $item->nama_mahasiswa }}
                                    @endif
                                </td>
                                <td class="text-start" style="font-size: 0.85rem;">{{ $item->judul_kegiatan }}</td>
                                <td><span class="badge bg-secondary">{{ $item->tahun }}</span></td>
                                <td>
                                    <form action="{{ route('pkm_dtps_mahasiswa.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-muted py-3">Belum ada data PkM DTPS yang diinput.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <script>
        function addMahasiswa() {
            const container = document.getElementById('mahasiswa-container');
            const div = document.createElement('div');
            div.className = 'd-flex mb-2';
            div.innerHTML = `
                <input type="text" name="nama_mahasiswa[]" class="form-control rounded-3 me-2" placeholder="Nama Mahasiswa selanjutnya..." required>
                <button type="button" class="btn btn-danger rounded-3 px-3 shadow-sm" onclick="this.parentElement.remove()" title="Hapus baris ini"><i class="bi bi-trash-fill"></i></button>
            `;
            container.appendChild(div);
        }
    </script>
</x-app-layout>