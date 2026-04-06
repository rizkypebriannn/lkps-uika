<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tabel 2.b Penggunaan Dana') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <div class="container mt-5">
        <a href="{{ route('penggunaan_dana.index') }}" class="btn btn-outline-secondary mb-4 rounded-pill">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>

        <div class="card shadow-sm border-0 rounded-4 p-4">
            <h5 class="fw-bold mb-4 border-bottom pb-2">Update Alokasi Dana</h5>
            <form action="{{ route('penggunaan_dana.update', $dana->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="form-label fw-semibold">Jenis Penggunaan</label>
                    <input type="text" name="jenis_penggunaan" class="form-control" value="{{ $dana->jenis_penggunaan }}" required>
                </div>

                <div class="row g-4 mb-4">
                    <!-- Dana di UPPS -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light shadow-sm">
                            <h6 class="fw-bold text-primary mb-3"><i class="bi bi-building me-2"></i>Dana di UPPS (Fakultas)</h6>
                            <div class="input-group mb-2">
                                <span class="input-group-text">TS-2 (Rp)</span>
                                <input type="text" name="upps_ts2" class="form-control input-rupiah" value="{{ number_format($dana->upps_ts2, 0, ',', '.') }}">
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">TS-1 (Rp)</span>
                                <input type="text" name="upps_ts1" class="form-control input-rupiah" value="{{ number_format($dana->upps_ts1, 0, ',', '.') }}">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">TS (Rp)</span>
                                <input type="text" name="upps_ts" class="form-control input-rupiah" value="{{ number_format($dana->upps_ts, 0, ',', '.') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Dana di PS -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light shadow-sm">
                            <h6 class="fw-bold text-success mb-3"><i class="bi bi-mortarboard me-2"></i>Dana di Program Studi</h6>
                            <div class="input-group mb-2">
                                <span class="input-group-text">TS-2 (Rp)</span>
                                <input type="text" name="ps_ts2" class="form-control input-rupiah" value="{{ number_format($dana->ps_ts2, 0, ',', '.') }}">
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">TS-1 (Rp)</span>
                                <input type="text" name="ps_ts1" class="form-control input-rupiah" value="{{ number_format($dana->ps_ts1, 0, ',', '.') }}">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">TS (Rp)</span>
                                <input type="text" name="ps_ts" class="form-control input-rupiah" value="{{ number_format($dana->ps_ts, 0, ',', '.') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill fw-bold shadow-sm">
                    <i class="bi bi-pencil-square me-2"></i>UPDATE DATA KEUANGAN
                </button>
            </form>
        </div>
    </div>

    <!-- Script Rupiah yang sama dengan index agar input tetap cantik -->
    <script>
        document.querySelectorAll('.input-rupiah').forEach(function(input) {
            input.addEventListener('keyup', function(e) {
                let val = this.value.replace(/[^,\d]/g, '');
                let sisa = val.length % 3;
                let rupiah = val.substr(0, sisa);
                let ribuan = val.substr(sisa).match(/\d{3}/gi);
                if (ribuan) {
                    let separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
                this.value = rupiah;
            });
        });
    </script>
</x-app-layout>