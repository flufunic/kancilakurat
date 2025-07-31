<?php

namespace App\Http\Controllers;

use App\Models\Realisasi;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class RealisasiController extends Controller
{
    public function index(): View
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
            'sisa_anggaran' => 'required|integer|min:0',
            'link_spreadsheet' => 'nullable|url|max:255'
        ]);

        // Simpan data ke database
        Realisasi::create([
            'nama_seksi' => $request->nama_seksi,
            'sisa_anggaran' => $request->sisa_anggaran,
            'link_spreadsheet' => $request->link_spreadsheet,
        ]);

        return redirect()->route('realisasis.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id): View
    {
        $realisasi = Realisasi::findOrFail($id);
        return view('realisasis.edit', compact('realisasi'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'nama_seksi' => 'required|string|max:255',
            'sisa_anggaran' => 'required|integer|min:0',
            'link_spreadsheet' => 'nullable|url|max:255'
        ]);

        // Cari data realisasi
        $realisasi = Realisasi::findOrFail($id);

        // Update data
        $realisasi->update([
            'nama_seksi' => $request->nama_seksi,
            'sisa_anggaran' => $request->sisa_anggaran,
            'link_spreadsheet' => $request->link_spreadsheet,
        ]);

        return redirect()->route('realisasis.index')->with(['success' => 'Data realisasi berhasil diperbarui.']);
    }

    public function destroy($id): RedirectResponse
    {
        $realisasi = Realisasi::findOrFail($id);
        $realisasi->delete();

        return redirect()->route('realisasis.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
