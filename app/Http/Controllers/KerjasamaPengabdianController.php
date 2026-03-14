<?php

namespace App\Http\Controllers;

use App\Models\KerjasamaPengabdian;
use Illuminate\Http\Request;

class KerjasamaPengabdianController extends Controller
{
    public function index()
    {
        $data = KerjasamaPengabdian::where('prodi_id', auth()->user()->prodi_id)
                    ->orderBy('tanggal_awal', 'desc')
                    ->get();
        return view('kerjasama_pengabdian.index', compact('data'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['prodi_id'] = auth()->user()->prodi_id;

        // Pastikan tipe data sinkron dengan database (int untuk durasi)
        $input['durasi'] = (int) ($request->durasi ?? 1);
        $input['status_kerjasama'] = $request->status_kerjasama ?? 'Aktif';
        $input['manfaat'] = $request->manfaat ?? '-';

        
        KerjasamaPengabdian::create($input);

        return redirect()->back()->with('success', 'Data Kerjasama PkM berhasil disimpan!');
    }

    public function destroy($id)
    {
        KerjasamaPengabdian::where('id', $id)
            ->where('prodi_id', auth()->user()->prodi_id)
            ->firstOrFail()
            ->delete();

        return redirect()->back()->with('success', 'Data Kerjasama PkM berhasil dihapus!');
    }
}