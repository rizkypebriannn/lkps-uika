<?php
namespace App\Http\Controllers;

use App\Models\PenggunaanDana;
use Illuminate\Http\Request;

class PenggunaanDanaController extends Controller
{
    // Fungsi index() ini yang tadi hilang/tidak terbaca
    public function index()
    {
        // FILTER DATA
        $danas = PenggunaanDana::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('penggunaan_dana.index', compact('danas'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // SUNTIKKAN PRODI ID
        $data['prodi_id'] = auth()->user()->prodi_id; 

        $kolomUang = ['upps_ts2', 'upps_ts1', 'upps_ts', 'ps_ts2', 'ps_ts1', 'ps_ts'];
        foreach ($kolomUang as $kolom) {
            if (isset($data[$kolom])) {
                $data[$kolom] = str_replace('.', '', $data[$kolom]);
            }
        }

        PenggunaanDana::create($data);
        return redirect('/dashboard')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $dana = PenggunaanDana::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
        return view('penggunaan_dana.edit', compact('dana'));
    }

    public function update(Request $request, $id)
    {
        $dana = PenggunaanDana::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $data = $request->all();

        // Bersihkan titik rupiah sebelum update
        $kolomUang = ['upps_ts2', 'upps_ts1', 'upps_ts', 'ps_ts2', 'ps_ts1', 'ps_ts'];
        foreach ($kolomUang as $kolom) {
            if (isset($data[$kolom])) {
                $data[$kolom] = str_replace('.', '', $data[$kolom]);
            }
        }

        $dana->update($data);

        return redirect()->route('penggunaan_dana.index')->with('success', 'Data penggunaan dana berhasil diperbarui!');
    }
    // Fungsi untuk menghapus data
    public function destroy($id)
    {
        $dana = PenggunaanDana::findOrFail($id);
        $dana->delete();
        
        return redirect()->back()->with('success', 'Data keuangan berhasil dihapus!');
    }
}