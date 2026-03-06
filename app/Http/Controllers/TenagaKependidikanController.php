<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TenagaKependidikan;

class TenagaKependidikanController extends Controller


{
    public function index()
    {
        $tenagas = TenagaKependidikan::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('tenaga_kependidikan.index', compact('tenagas'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        TenagaKependidikan::create($data);
        return redirect('/dashboard')->with('success', 'Data Tenaga Kependidikan berhasil disimpan!');
    }

    public function destroy($id)
    {
        TenagaKependidikan::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data berhasil dihapus!');
    }
}
    //

