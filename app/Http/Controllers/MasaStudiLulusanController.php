<?php

namespace App\Http\Controllers;

use App\Models\MasaStudiLulusan;
use Illuminate\Http\Request;

class MasaStudiLulusanController extends Controller
{
    public function index()
    {
        // Mengurutkan dari TS-7 sampai TS
        $masa_studi = MasaStudiLulusan::where('prodi_id', auth()->user()->prodi_id)
                        ->orderByRaw("FIELD(tahun_masuk, 'TS-7', 'TS-6', 'TS-5', 'TS-4', 'TS-3', 'TS-2', 'TS-1', 'TS')")
                        ->get();
        return view('masa_studi_lulusan.index', compact('masa_studi'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        // Cek apakah data tahun masuk tersebut sudah ada
        $existing = MasaStudiLulusan::where('prodi_id', auth()->user()->prodi_id)
                                    ->where('tahun_masuk', $request->tahun_masuk)
                                    ->first();

        if ($existing) {
            $existing->update($data);
            return redirect('/dashboard')->with('success', 'Data Masa Studi ' . $request->tahun_masuk . ' berhasil diperbarui!');
        }

        MasaStudiLulusan::create($data);
        return redirect('/dashboard')->with('success', 'Data Masa Studi berhasil disimpan!');
    }

    public function destroy($id)
    {
        MasaStudiLulusan::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data berhasil dihapus!');
    }
}