<?php
namespace App\Http\Controllers;

use App\Models\ProfilDosen;
use Illuminate\Http\Request;

class ProfilDosenController extends Controller
{
    public function index()
    {
        // FILTER: Hanya tampilkan data milik Prodi yang login
        $dosens = ProfilDosen::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('profil_dosen.index', compact('dosens'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        ProfilDosen::create($data);
        
        // KONSISTEN: Langsung lempar kembali ke Dashboard
        return redirect('/dashboard')->with('success', 'Data Profil Dosen berhasil disimpan!');
    }

    public function destroy($id)
    {
        $dosen = ProfilDosen::findOrFail($id);
        $dosen->delete();
        
        return redirect('/dashboard')->with('success', 'Data Profil Dosen berhasil dihapus!');
    }
}