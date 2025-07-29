<?php

namespace App\Http\Controllers;

use App\Models\Rencana;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RencanaController extends Controller
{
     public function index() : View
    {
        //get all products
        $rencanas = Rencana::latest()->paginate(10);

        //render view with products
        return view('rencanas.index', compact('rencanas'));
    }

     public function create(): View
    {
        // Kirim list bulan jika kamu ingin membuat dropdown
        $bulanList = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        return view('rencanas.create', compact('bulanList'));
    }

    /**
     * Store Rencana ke database
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_seksi' => 'required|string|max:255',
            'saldo_tahunan' => 'required|integer|min:0',
            'minggu_1' => 'nullable|integer|min:0',
            'minggu_2' => 'nullable|integer|min:0',
            'minggu_3' => 'nullable|integer|min:0',
            'minggu_4' => 'nullable|integer|min:0',
            'bulan' => 'required|string'
        ]);

        // Hitung sisa saldo bulan
        $minggu1 = $request->minggu_1 ?? 0;
        $minggu2 = $request->minggu_2 ?? 0;
        $minggu3 = $request->minggu_3 ?? 0;
        $minggu4 = $request->minggu_4 ?? 0;

        $sisa = $request->saldo_tahunan - ($minggu1 + $minggu2 + $minggu3 + $minggu4);

        Rencana::create([
            'nama_seksi' => $request->nama_seksi,
            'saldo_tahunan' => $request->saldo_tahunan,
            'minggu_1' => $minggu1,
            'minggu_2' => $minggu2,
            'minggu_3' => $minggu3,
            'minggu_4' => $minggu4,
            'sisa_saldo_bulan' => $sisa,
            'bulan' => $request->bulan
        ]);

        return redirect()->route('rencanas.index')->with('success', 'Rencana berhasil disimpan!');
    }

    /**
     * Show edit form.
     */
    public function edit(string $id): View
    {
        $rencana = Rencana::findOrFail($id);
        return view('rencanas.edit', compact('rencana'));
    }

    /**
     * Update data.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'nama_seksi'          => 'required|string|max:255',
            'saldo_tahunan'       => 'required|numeric',
            'minggu_1'            => 'nullable|numeric',
            'minggu_2'            => 'nullable|numeric',
            'minggu_3'            => 'nullable|numeric',
            'minggu_4'            => 'nullable|numeric',
            'sisa_saldo_bulan'    => 'nullable|numeric',
            'bulan'               => 'required|string|max:50',
        ]);

        $rencana = Rencana::findOrFail($id);

        $rencana->update([
            'nama_seksi'        => $request->nama_seksi,
            'saldo_tahunan'     => $request->saldo_tahunan,
            'minggu_1'          => $request->minggu_1 ?? 0,
            'minggu_2'          => $request->minggu_2 ?? 0,
            'minggu_3'          => $request->minggu_3 ?? 0,
            'minggu_4'          => $request->minggu_4 ?? 0,
            'sisa_saldo_bulan'  => $request->sisa_saldo_bulan ?? 0,
            'bulan'             => $request->bulan,
        ]);

        return redirect()->route('rencanas.index')->with('success', 'Data rencana berhasil diperbarui!');
    }

     
    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get product by ID
        $rencana = Rencana::findOrFail($id);

        //delete image
        Storage::delete('public/rencanas/'. $rencana->image);

        //delete product
        $rencana->delete();

        //redirect to index
        return redirect()->route('rencanas.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}
