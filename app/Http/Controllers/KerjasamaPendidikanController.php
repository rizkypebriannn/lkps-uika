<?php

namespace App\Http\Controllers;

use App\Models\KerjasamaPendidikan;
use Illuminate\Http\Request;

class KerjasamaPendidikanController extends Controller
{
    public function index()
    {
        $data = KerjasamaPendidikan::where('prodi_id', auth()->user()->prodi_id)
                    ->orderBy('tanggal_awal', 'desc')
                    ->get();
                    
        return view('kerjasama_pendidikan.index', compact('data'));
    }

   public function store(Request $request)
{
    $input = $request->all();
    $input['prodi_id'] = auth()->user()->prodi_id;

    // Pastikan durasi adalah angka (sesuai tipe int(11) di gambar)
    $input['durasi'] = (int) ($request->durasi ?? 1);

    // Backup jika manfaat atau status kelupaan diisi
    $input['manfaat'] = $request->manfaat ?? '-';
    $input['status_kerjasama'] = $request->status_kerjasama ?? 'Aktif';

    KerjasamaPendidikan::create($input);

    return redirect()->back()->with('success', 'Data Kerjasama Pendidikan Berhasil Disimpan!');
}
    public function destroy($id)
    {
        // Fitur Hapus satu baris (Chain Method) persis seperti controller Kepuasan Anda
        KerjasamaPendidikan::where('id', $id)
            ->where('prodi_id', auth()->user()->prodi_id)
            ->firstOrFail()
            ->delete();
        
        return redirect()->back()->with('success', 'Data Kerjasama Pendidikan berhasil dihapus!');
    }
}