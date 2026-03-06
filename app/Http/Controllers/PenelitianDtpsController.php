<?php
namespace App\Http\Controllers;

use App\Models\PenelitianDtps;
use Illuminate\Http\Request;

class PenelitianDtpsController extends Controller
{
    public function index()
    {
        // FILTER: Hanya tampilkan data milik Prodi yang login
        $penelitians = PenelitianDtps::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('penelitian_dtps.index', compact('penelitians'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        PenelitianDtps::create($data);
        
        // SESUAI PERMINTAAN: Langsung lempar kembali ke Dashboard!
        return redirect('/dashboard')->with('success', 'Data Penelitian DTPS berhasil disimpan!');
    }

    public function destroy($id)
    {
        $penelitian = PenelitianDtps::findOrFail($id);
        $penelitian->delete();
        
        // Hapus juga langsung kembali ke Dashboard
        return redirect('/dashboard')->with('success', 'Data Penelitian DTPS berhasil dihapus!');
    }
}