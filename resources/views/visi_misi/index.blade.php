<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 1 Visi Misi, Tujuan, dan Strategi - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
            </a>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Input Visi Misi, Tujuan, dan Strategi</h5>
                
                <form action="{{ route('visi_misi.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jenis VMTS</label>
                            <select name="jenis_vmts" class="form-select rounded-3" required>
                                <option value="" disabled selected>-- Pilih Jenis --</option>
                                <option value="VMTS PT">VMTS Perguruan Tinggi (PT)</option>
                                <option value="VMTS UPPS">VMTS UPPS (Fakultas)</option>
                                <option value="Visi Keilmuan PS">Visi Keilmuan Program Studi</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">No. Surat Keputusan (SK)</label>
                            <input type="text" name="no_sk" class="form-control rounded-3" placeholder="Contoh: 0153/SK/LAM Teknik/..." required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Link Dokumen</label>
                            <input type="url" name="link_dokumen" class="form-control rounded-3" placeholder="https://drive.google.com/..." required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold text-sm">Pernyataan Visi/Misi</label>
                            <textarea name="pernyataan" class="form-control rounded-3" rows="3" placeholder="Tuliskan isi pernyataan visi misi secara lengkap di sini..." required></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA VISI MISI
                    </button>
                </form>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h6 class="fw-bold mb-3">Data Visi Misi Tersimpan ({{ $visiMisis->count() }})</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th class="align-middle" width="5%">No</th>
                                <th class="align-middle" width="20%">Jenis VMTS</th>
                                <th class="align-middle" width="35%">Pernyataan</th>
                                <th class="align-middle" width="15%">No. SK</th>
                                <th class="align-middle" width="15%">Link Dokumen</th>
                                <th class="align-middle" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($visiMisis as $index => $vm)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $vm->jenis_vmts }}</td>
                                <td class="text-start">{{ $vm->pernyataan }}</td>
                                <td>{{ $vm->no_sk }}</td>
                                <td>
                                    <a href="{{ $vm->link_dokumen }}" target="_blank" class="btn btn-sm btn-outline-info rounded-pill">
                                        <i class="bi bi-link-45deg"></i> Buka
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('visi_misi.edit', $vm->id) }}" class="btn btn-sm text-warning" title="Edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('visi_misi.destroy', $vm->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm text-danger" title="Hapus">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-muted py-3">Belum ada data Visi Misi yang diinput.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>