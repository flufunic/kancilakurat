<?php

namespace App\Http\Controllers;
use App\Models\Realisasi;
use App\Models\Rencana;
use App\Models\Struktur;
use App\Models\Dipa;
use Illuminate\Http\Request;

class KancilController extends Controller
{
    public function index(Request $request)
{
    $sort = $request->input('sort');

    $bulanUrutan = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    $rencana = Rencana::all()->sortBy(function ($item) use ($bulanUrutan) {
        return array_search($item->bulan, $bulanUrutan);
    });

    if ($sort === 'desc') {
        $rencana = $rencana->reverse();
    }

    $realisasi = Realisasi::all();
    $dipa = Dipa::all();

    return view('welcome', compact('rencana', 'realisasi', 'dipa'));
}

    
}
