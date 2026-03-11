<?php

namespace App\Http\Controllers;

use App\Models\KerjasamaPenelitian;
use Illuminate\Http\Request;

class KerjasamaPenelitianController extends Controller
{
    public function index()
    {
        $data = KerjasamaPenelitian::where('prodi_id', auth()->user()->prodi_id)
                    ->orderBy('tanggal_awal', 'desc')
                    ->get();
        return view('kerjasama_penelitian.index', compact('data'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['prodi_id'] = auth()->user()->prodi_id;

        // Pastikan tipe data sesuai dengan struktur database
        $input['durasi'] = (int) ($request->durasi ?? 1);
        $input['status_kerjasama'] = $request->status_kerjasama ?? 'Aktif';
        $input['manfaat'] = $request->manfaat ?? '-';

        KerjasamaPenelitian::create($input);

        return redirect()->back()->with('success', 'Data Kerjasama Penelitian berhasil disimpan!');
    }

    public function destroy($id)
    {
        KerjasamaPenelitian::where('id', $id)
            ->where('prodi_id', auth()->user()->prodi_id)
            ->firstOrFail()
            ->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}