<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 7.a Dokumen/Buku SPMI - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('dokumen_spmi.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Update Dokumen Sistem Penjaminan Mutu Internal (SPMI)</h5>
                
                <form action="{{ route('dokumen_spmi.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-sm">Jenis Dokumen Penjaminan Mutu</label>
                        <select name="jenis_dokumen" class="form-select rounded-3" required>
                            @php
                                $jenis_docs = [
                                    'Kebijakan SPMI',
                                    'Pedoman penerapan siklus PPEPP standar pendidikan tinggi dalam SPMI',
                                    'Standar dan/atau kriteria, norma, acuan mutu penyelenggaraan pendidikan dan pengelolaan perguruan tinggi',
                                    'Tata cara pendokumentasian implementasi SPMI'
                                ];
                            @endphp
                            @foreach($jenis_docs as $jenis)
                                <option value="{{ $jenis }}" {{ $data->jenis_dokumen == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Nomor Dokumen</label>
                            <input type="text" name="nomor_dokumen" class="form-control rounded-3" value="{{ $data->nomor_dokumen }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm">Tanggal Dokumen</label>
                            <input type="date" name="tanggal_dokumen" class="form-control rounded-3" value="{{ $data->tanggal_dokumen }}" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>UPDATE DOKUMEN SPMI
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>