<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 1 Visi Misi, Tujuan, dan Strategi - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('visi_misi.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Visi Misi, Tujuan, dan Strategi</h5>
                
                <form action="{{ route('visi_misi.update', $visiMisi->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Jenis VMTS</label>
                            <select name="jenis_vmts" class="form-select rounded-3" required>
                                <option value="VMTS PT" {{ $visiMisi->jenis_vmts == 'VMTS PT' ? 'selected' : '' }}>VMTS Perguruan Tinggi (PT)</option>
                                <option value="VMTS UPPS" {{ $visiMisi->jenis_vmts == 'VMTS UPPS' ? 'selected' : '' }}>VMTS UPPS (Fakultas)</option>
                                <option value="Visi Keilmuan PS" {{ $visiMisi->jenis_vmts == 'Visi Keilmuan PS' ? 'selected' : '' }}>Visi Keilmuan Program Studi</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">No. Surat Keputusan (SK)</label>
                            <input type="text" name="no_sk" class="form-control rounded-3" value="{{ $visiMisi->no_sk }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm">Link Dokumen</label>
                            <input type="url" name="link_dokumen" class="form-control rounded-3" value="{{ $visiMisi->link_dokumen }}" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold text-sm">Pernyataan Visi/Misi</label>
                            <textarea name="pernyataan" class="form-control rounded-3" rows="3" required>{{ $visiMisi->pernyataan }}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DATA VISI MISI
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>