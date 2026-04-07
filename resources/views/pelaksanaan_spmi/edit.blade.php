<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 7.b Pelaksanaan SPMI - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('pelaksanaan_spmi.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Dokumen Pelaksanaan SPMI (Siklus PPEPP)</h5>
                
                <form action="{{ route('pelaksanaan_spmi.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Pilih Tahapan Dokumen (PPEPP)</label>
                        <select name="dokumen" class="form-select rounded-3" required>
                            <option value="Penetapan" {{ $data->dokumen == 'Penetapan' ? 'selected' : '' }}>1. Penetapan</option>
                            <option value="Pelaksanaan" {{ $data->dokumen == 'Pelaksanaan' ? 'selected' : '' }}>2. Pelaksanaan</option>
                            <option value="Evaluasi" {{ $data->dokumen == 'Evaluasi' ? 'selected' : '' }}>3. Evaluasi (Isi Link Laporan Audit)</option>
                            <option value="Pengendalian" {{ $data->dokumen == 'Pengendalian' ? 'selected' : '' }}>4. Pengendalian (Isi Link Laporan RTM)</option>
                            <option value="Peningkatan" {{ $data->dokumen == 'Peningkatan' ? 'selected' : '' }}>5. Peningkatan (Isi Link Dok. Peningkatan)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Link Dokumen (Wajib untuk semua tahapan)</label>
                        <input type="url" name="link_dokumen" class="form-control rounded-3" value="{{ $data->link_dokumen }}" required>
                    </div>

                    <div class="p-3 bg-light rounded-3 mb-4 border">
                        <label class="form-label fw-bold text-sm text-primary mb-3"><i class="bi bi-link-45deg me-2"></i>Link Khusus (Isi sesuai tahapan yang dipilih)</label>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-sm">Link Laporan Hasil Audit</label>
                                <input type="url" name="link_laporan_audit" class="form-control rounded-3" value="{{ $data->link_laporan_audit }}" placeholder="Hanya untuk Evaluasi">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-sm">Link Laporan RTM</label>
                                <input type="url" name="link_laporan_rtm" class="form-control rounded-3" value="{{ $data->link_laporan_rtm }}" placeholder="Hanya untuk Pengendalian">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-sm">Link Dokumen Peningkatan</label>
                                <input type="url" name="link_dokumen_peningkatan" class="form-control rounded-3" value="{{ $data->link_dokumen_peningkatan }}" placeholder="Hanya untuk Peningkatan">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE PELAKSANAAN SPMI
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>