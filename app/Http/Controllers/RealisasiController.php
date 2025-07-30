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
            'sisa_anggaran' =>'required|integer|min:0',
            'lihat_dokumen' => 'nullable|file|mimes:pdf|max:102400'

        ]);

         // Simpan file PDF ke folder 'public/dipas'
        $file = $request->file('lihat_dokumen');
        $file->storeAs('public/strukturs', $file->hashName());

        // Simpan data ke database
        Realisasi::create([
            'nama_seksi' => $request->nama_seksi,
            'sisa_anggaran' => $request->sisa_anggaran,
            'lihat_dokumen' => $file->hashName(),
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
        'sisa_anggaran' =>'required|integer|min:0',
        'lihat_dokumen' => 'nullable|file|mimes:pdf|max:102400'
    ]);

    // Cari data realisasi
    $realisasi = Realisasi::findOrFail($id);

    // Data yang akan diupdate
    $data = [
        'nama_seksi' => $request->nama_seksi,
        'sisa_anggaran' => $request->sisa_anggaran,
    ];

    // Jika ada file baru diupload
    if ($request->hasFile('lihat_dokumen')) {
        $file = $request->file('lihat_dokumen');
        $fileName = $file->hashName();
        $file->storeAs('public/strukturs', $fileName);

        // Hapus file lama
        Storage::delete('public/strukturs/' . $realisasi->lihat_dokumen);

        // Tambahkan file baru ke data
        $data['lihat_dokumen'] = $fileName;
    }

    // Update data
    $realisasi->update($data);

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



