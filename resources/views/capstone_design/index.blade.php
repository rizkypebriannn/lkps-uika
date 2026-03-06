<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel 3.a.5 Capstone Design - ') }} <span class="text-indigo-600">{{ auth()->user()->prodi->nama_prodi ?? '' }}</span>
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
            </a>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0 rounded-4 mb-5 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Form Tambah Mata Kuliah Capstone Design</h5>
                <form action="{{ route('capstone_design.store') }}" method="POST">
                    @csrf
                    <div class="row g-3 mb-4">
                        <div class="col-md-9">
                            <label class="form-label fw-semibold">Nama Mata Kuliah Pendukung</label>
                            <input type="text" name="mk_pendukung" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Jumlah SKS Pendukung</label>
                            <input type="number" name="sks_pendukung" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Nama Mata Kuliah Capstone Design</label>
                            <input type="text" name="mk_capstone" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Jumlah SKS Capstone</label>
                            <input type="number" name="sks_capstone" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Semester</label>
                            <input type="text" name="semester" class="form-control" placeholder="Cth: 7" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Cakupan Bahasan</label>
                        <textarea name="cakupan_bahasan" class="form-control" rows="3" placeholder="Tuliskan cakupan bahasan..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                        <i class="bi bi-save me-2"></i>Simpan Data
                    </button>
                </form>
            </div>

            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h5 class="fw-bold mb-3 border-bottom pb-2">Daftar Mata Kuliah Tersimpan</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered text-center align-middle" style="font-size: 0.9rem;">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th class="text-start">Nama MK Pendukung</th>
                                <th>SKS Pendukung</th>
                                <th class="text-start">Nama MK Capstone</th>
                                <th>SKS Capstone</th>
                                <th>Semester</th>
                                <th class="text-start">Cakupan Bahasan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($capstones as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start fw-bold">{{ $item->mk_pendukung }}</td>
                                <td>{{ $item->sks_pendukung }}</td>
                                <td class="text-start fw-bold">{{ $item->mk_capstone }}</td>
                                <td>{{ $item->sks_capstone }}</td>
                                <td>{{ $item->semester }}</td>
                                <td class="text-start">{{ $item->cakupan_bahasan }}</td>
                                <td>
                                    <form action="{{ route('capstone_design.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash-fill"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-muted py-4">Belum ada data yang diinput.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>