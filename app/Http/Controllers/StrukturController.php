<?php

namespace App\Http\Controllers;

use App\Models\Struktur;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturController extends Controller
{
     public function index() : View
    {
        $strukturs = Struktur::latest()->paginate(10);
        return view('strukturs.index', compact('strukturs'));
    }

     public function create(): View
    {
        return view('strukturs.create');
    }

    /**
     * Simpan struktur ke database
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        // Upload gambar
        $gambar = $request->file('gambar');
        $gambar->storeAs('public/strukturs', $gambar->hashName());

        // Simpan ke DB
        Struktur::create([
            'gambar' => $gambar->hashName()
        ]);

        return redirect()->route('strukturs.index')->with(['success' => 'Gambar berhasil diupload!']);
    }

    /**
     * Show form edit data struktur
     */
    public function edit(string $id): View
    {
        $struktur = Struktur::findOrFail($id);

        return view('strukturs.edit', compact('struktur'));
    }

    /**
     * Update data struktur
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'gambar' => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Ambil data struktur berdasarkan ID
        $struktur = Struktur::findOrFail($id);

        // Cek apakah ada gambar baru yang di-upload
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $image->storeAs('public/strukturs', $image->hashName());

            // Hapus gambar lama dari storage
            Storage::delete('public/strukturs/' . $struktur->gambar);

            // Update dengan gambar baru
            $struktur->update([
                'gambar' => $image->hashName(),
            ]);
        }

        // Redirect ke index dengan pesan sukses
        return redirect()->route('strukturs.index')->with(['success' => 'Struktur berhasil diperbarui!']);
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
        $struktur = Struktur::findOrFail($id);

        //delete image
        Storage::delete('public/strukturs/'. $struktur->image);

        //delete product
        $struktur->delete();

        //redirect to index
        return redirect()->route('strukturs.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}
