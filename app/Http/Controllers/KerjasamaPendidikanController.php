<?php
namespace App\Http\Controllers;

use App\Models\KerjasamaPendidikan;
use Illuminate\Http\Request;

class KerjasamaPendidikanController extends Controller
{
    public function index()
    {
        $kerjasamas = KerjasamaPendidikan::orderBy('tanggal_awal', 'desc')->get();
        return view('kerjasama_pendidikan.index', compact('kerjasamas'));
        $kerjasamas = NamaModelAnda::where('prodi_id', auth()->user()->prodi_id)->get();
    }

    public function store(Request $request)
    {
        KerjasamaPendidikan::create($request->all());
        return redirect('/dashboard')->with('success', 'Data berhasil disimpan!');
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id;
    }
}