<?php

namespace App\Http\Controllers;

use App\Models\IpkLulusan;
use Illuminate\Http\Request;

class IpkLulusanController extends Controller
{
    public function index()
    {
        // Mengurutkan agar TS-2 tampil duluan, lalu TS-1, lalu TS
        $ipks = IpkLulusan::where('prodi_id', auth()->user()->prodi_id)
                    ->orderBy('tahun_lulus', 'asc')
                    ->get();
        return view('ipk_lulusan.index', compact('ipks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun_lulus'    => 'required|in:TS-2,TS-1,TS',
            'jumlah_lulusan' => 'required|numeric|min:0',
            'ipk_min'        => 'required|numeric|min:0|max:4',
            'ipk_rata'       => 'required|numeric|min:0|max:4',
            'ipk_maks'       => 'required|numeric|min:0|max:4',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        // Cek apakah tahun lulus tersebut sudah diinput sebelumnya untuk prodi ini
        $existing = IpkLulusan::where('prodi_id', auth()->user()->prodi_id)
                              ->where('tahun_lulus', $request->tahun_lulus)
                              ->first();

        if ($existing) {
            $existing->update($validated);
            return redirect()->back()->with('success', 'Data IPK ' . $request->tahun_lulus . ' berhasil diperbarui!');
        }

        IpkLulusan::create($validated);
        return redirect()->back()->with('success', 'Data IPK Lulusan berhasil disimpan!');
    }

    public function edit($id)
    {
        $ipk = IpkLulusan::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('ipk_lulusan.edit', compact('ipk'));
    }

    public function update(Request $request, $id)
    {
        $ipk = IpkLulusan::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'jumlah_lulusan' => 'required|numeric|min:0',
            'ipk_min'        => 'required|numeric|min:0|max:4',
            'ipk_rata'       => 'required|numeric|min:0|max:4',
            'ipk_maks'       => 'required|numeric|min:0|max:4',
        ]);

        $ipk->update($validated);

        return redirect()->route('ipk_lulusan.index')->with('success', 'Data IPK Lulusan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $ipk = IpkLulusan::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $ipk->delete();
        
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}