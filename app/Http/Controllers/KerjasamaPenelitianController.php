<?php
namespace App\Http\Controllers;

use App\Models\KerjasamaPenelitian;
use Illuminate\Http\Request;

class KerjasamaPenelitianController extends Controller
{
    public function index()
    {
        $kerjasamas = KerjasamaPenelitian::orderBy('tanggal_awal', 'desc')->get();
        return view('kerjasama_penelitian.index', compact('kerjasamas'));
        $kerjasamas = NamaModelAnda::where('prodi_id', auth()->user()->prodi_id)->get();
    }

    public function store(Request $request)
    {
        KerjasamaPenelitian::create($request->all());
       return redirect('/dashboard')->with('success', 'Data berhasil disimpan!');
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id;
    }
}