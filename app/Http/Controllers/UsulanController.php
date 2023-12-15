<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\Barang;

class UsulanController extends Controller
{
    public function index(){
        return view('inventaris.formpinjam.index', [
            'nama_barang' => Barang::all()
        ]);
    }

    public function create(){
        $peminjaman = Peminjaman::create([
            'barang_satu' => request('barang_satu'),
            'barang_dua' => request('barang_dua'),
            'barang_tiga' => request('barang_tiga'),
            'tujuan' => request('tujuan'),
            'ruangan' => request('ruangan'),
            'jaminan' => request('jaminan'),
            'peminjam' => auth()->user()->nama,
            'user_id' => auth()->user()->id
        ]); 

        return redirect()->route('peminjaman')->with('message', 'Barang Berhasil Diusulkan!');
    }
}
