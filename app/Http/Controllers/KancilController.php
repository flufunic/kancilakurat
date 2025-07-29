<?php

namespace App\Http\Controllers;
use App\Models\Realisasi;
use App\Models\Rencana;
use App\Models\Struktur;
use App\Models\Dipa;
use Illuminate\Http\Request;

class KancilController extends Controller
{
     public function index()
    {
        $realisasi = Realisasi::all();
        $rencana = Rencana::all();
        $struktur = Struktur::all();
        $dipa = Dipa::all();

        return view('welcome', compact('realisasi', 'rencana', 'struktur', 'dipa'));
    }
}
