<?php
namespace App\Http\Controllers;

use App\Models\KerjasamaPengabdian;
use Illuminate\Http\Request;

class KerjasamaPengabdianController extends Controller
{
    public function index()
    {
        $kerjasamas = KerjasamaPengabdian::orderBy('tanggal_awal', 'desc')->get();
        return view('kerjasama_pengabdian.index', compact('kerjasamas'));
        $kerjasamas = NamaModelAnda::where('prodi_id', auth()->user()->prodi_id)->get();
    }

    public function store(Request $request)
    {
        KerjasamaPengabdian::create($request->all());
        return redirect('/dashboard')->with('success', 'Data berhasil disimpan!');
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id;
    }
}