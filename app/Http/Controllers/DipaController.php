<?php

namespace App\Http\Controllers;

use App\Models\Dipa;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class DipaController extends Controller
{
     public function index() : View
    {
        $dipas = Dipa::latest()->paginate(10);
        return view('dipas.index', compact('dipas'));
    }

    public function create(): View
    {
        return view('dipas.create');
    }

    /**
     * Store data DIPA
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi
        $request->validate([
            'nama'      => 'required|string|max:255',
            'file_pdf'  => 'required|mimes:pdf|max:5120', // maks 5MB
        ]);

        // Simpan file PDF ke folder 'public/dipas'
        $file = $request->file('file_pdf');
        $file->storeAs('public/dipas', $file->hashName());

        // Simpan ke database
        Dipa::create([
            'nama'      => $request->nama,
            'file_pdf'  => $file->hashName(),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('dipas.index')->with('success', 'Data DIPA berhasil disimpan.');
    }
/**
     * Menampilkan form edit data DIPA
     */
    public function edit(string $id): View
    {
        $dipa = Dipa::findOrFail($id);

        return view('dipas.edit', compact('dipa'));
    }

    /**
     * Mengupdate data DIPA
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'file_pdf'  => 'nullable|mimes:pdf|max:2048',
        ]);

        $dipa = Dipa::findOrFail($id);

        // Jika ada file baru diupload
        if ($request->hasFile('file_pdf')) {
            // Upload file baru
            $file = $request->file('file_pdf');
            $fileName = $file->hashName();
            $file->storeAs('public/dipas', $fileName);

            // Hapus file lama
            Storage::delete('public/dipas/' . $dipa->file_pdf);

            // Update dengan file baru
            $dipa->update([
                'nama'     => $request->nama,
                'file_pdf' => $fileName,
            ]);
        } else {
            // Update tanpa ubah file
            $dipa->update([
                'nama' => $request->nama,
            ]);
        }

        return redirect()->route('dipas.index')->with('success', 'Data berhasil diperbarui!');
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
        $dipa = Dipa::findOrFail($id);

        //delete image
        Storage::delete('public/dipas/'. $dipa->image);

        //delete product
        $dipa->delete();

        //redirect to index
        return redirect()->route('dipas.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }


}
