<?php
namespace App\Http\Controllers;

use App\Models\IntegrasiPembelajaran;
use Illuminate\Http\Request;

class IntegrasiPembelajaranController extends Controller
{
   public function index()
    {
        // FILTER DATA
        $integrasis = IntegrasiPembelajaran::where('prodi_id', auth()->user()->prodi_id)->orderBy('created_at', 'desc')->get();
        return view('integrasi_pembelajaran.index', compact('integrasis'));
    }

    public function store(Request $request)
    {
        // SUNTIKKAN PRODI ID
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id;

        IntegrasiPembelajaran::create($data);
        return redirect('/dashboard')->with('success', 'Data berhasil disimpan!');
    }
    public function destroy($id)
    {
        $integrasi = IntegrasiPembelajaran::findOrFail($id);
        $integrasi->delete();
        return redirect()->back()->with('success', 'Data Integrasi berhasil dihapus!');
    }
}