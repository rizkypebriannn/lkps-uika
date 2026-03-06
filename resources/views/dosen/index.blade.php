<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <a href="/" class="btn btn-secondary mb-3">🏠 Kembali ke Dashboard</a>
    
    <h3>Data Profil Dosen (Tabel 4a)</h3>
    
    <div class="card p-4 mb-4 bg-white shadow-sm">
        <form action="{{ route('dosen.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-2"><input type="text" name="nama_dosen" class="form-control" placeholder="Nama Lengkap" required></div>
                <div class="col-md-4 mb-2"><input type="text" name="nidn" class="form-control" placeholder="NIDN/NIDK" required></div>
                <div class="col-md-4 mb-2">
                    <select name="kategori_dosen" class="form-control">
                        <option value="Dosen Tetap">Dosen Tetap</option>
                        <option value="Dosen Tidak Tetap">Dosen Tidak Tetap</option>
                    </select>
                </div>
                <div class="col-md-4 mb-2"><input type="text" name="jabatan_akademik" class="form-control" placeholder="Jabatan Akademik (Lektor, Asisten Ahli)" required></div>
                <div class="col-md-4 mb-2"><input type="text" name="pendidikan_terakhir" class="form-control" placeholder="Pendidikan Terakhir (S2/S3)" required></div>
                <div class="col-md-4 mb-2"><input type="text" name="mata_kuliah_diampu" class="form-control" placeholder="Mata Kuliah yang Diampu" required></div>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Simpan Data</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Dosen</th>
                <th>NIDN</th>
                <th>Kategori</th>
                <th>Jabatan</th>
                <th>Mata Kuliah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dosens as $index => $dosen)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $dosen->nama_dosen }}</td>
                <td>{{ $dosen->nidn }}</td>
                <td>{{ $dosen->kategori_dosen }}</td>
                <td>{{ $dosen->jabatan_akademik }}</td>
                <td>{{ $dosen->mata_kuliah_diampu }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>