<?php

namespace App\Http\Controllers;

use App\Models\Realisasi;

use Illuminate\View\View;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Storage;

class RealisasiController extends Controller
{
     public function index() : View
    {
        
        $realisasis = Realisasi::latest()->paginate(10);

        
        return view('realisasis.index', compact('realisasis'));
    }

    public function create(): View
    {
        return view('realisasis.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'nama_seksi' => 'required|string|max:255',
            'sisa_anggaran' => 'required|numeric',
            'link_spreadsheet' => 'required|url'
        ]);

        // Simpan data ke database
        Realisasi::create([
            'nama_seksi' => $request->nama_seksi,
            'sisa_anggaran' => $request->sisa_anggaran,
            'link_spreadsheet' => $request->link_spreadsheet,
        ]);

        return redirect()->route('realisasis.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
 * Show the form for editing the specified realisasi.
 *
 * @param  int  $id
 * @return \Illuminate\View\View
 */
public function edit($id): View
{
    $realisasi = Realisasi::findOrFail($id);
    return view('realisasis.edit', compact('realisasi'));
}

/**
 * Update the specified realisasi in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\RedirectResponse
 */
public function update(Request $request, $id): RedirectResponse
{
    // Validasi form
    $request->validate([
        'nama_seksi' => 'required|string|max:255',
        'sisa_anggaran' => 'required|numeric',
        'link_spreadsheet' => 'required|url'
    ]);

    // Cari data realisasi
    $realisasi = Realisasi::findOrFail($id);

    // Update data
    $realisasi->update([
        'nama_seksi' => $request->nama_seksi,
        'sisa_anggaran' => $request->sisa_anggaran,
        'link_spreadsheet' => $request->link_spreadsheet,
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('realisasis.index')->with(['success' => 'Data realisasi berhasil diperbarui.']);
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
        $realisasi = Realisasi::findOrFail($id);

        //delete image
        Storage::delete('public/products/'. $realisasi->image);

        //delete product
        $realisasi->delete();

        //redirect to index
        return redirect()->route('realisasis.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}



