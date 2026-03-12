<?php

namespace App\Http\Controllers;

use App\Models\ProfilDosen;
use Illuminate\Http\Request;

class ProfilDosenController extends Controller
{
    public function index()
    {
        $data = ProfilDosen::where('prodi_id', auth()->user()->prodi_id)
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('profil_dosen.index', compact('data'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['prodi_id'] = auth()->user()->prodi_id;

        // Bersihkan data Perusahaan jika bukan Dosen Industri
        if ($input['kategori_dosen'] != 'Dosen Industri') {
            $input['perusahaan_industri'] = null;
        }

        ProfilDosen::create($input);

        return redirect()->back()->with('success', 'Data Profil Dosen (4.a) berhasil disimpan!');
    }

    public function destroy($id)
    {
        ProfilDosen::where('id', $id)
            ->where('prodi_id', auth()->user()->prodi_id)
            ->firstOrFail()
            ->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}