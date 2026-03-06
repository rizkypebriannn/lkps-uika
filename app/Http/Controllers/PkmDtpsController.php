<?php
namespace App\Http\Controllers;

use App\Models\PkmDtps;
use Illuminate\Http\Request;

class PkmDtpsController extends Controller
{
    public function index()
    {
        // FILTER: Hanya tampilkan data milik Prodi yang login
        $pkms = PkmDtps::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('pkm_dtps.index', compact('pkms'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        PkmDtps::create($data);
        
        // KONSISTEN: Langsung lempar kembali ke Dashboard
        return redirect('/dashboard')->with('success', 'Data PkM DTPS berhasil disimpan!');
    }

    public function destroy($id)
    {
        $pkm = PkmDtps::findOrFail($id);
        $pkm->delete();
        
        return redirect('/dashboard')->with('success', 'Data PkM DTPS berhasil dihapus!');
    }
}