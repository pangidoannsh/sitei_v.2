<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\Peminjaman;
use Illuminate\Http\Request;


class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jumlah_barang = Barang::all()->count();
        $jumlah_riwayat = Peminjaman::where('status', 'Selesai')->count();
        $jumlah_pinjaman = Peminjaman::whereIn('status', ['usulan','Disetujui'])->count();
        return view('inventaris.barang.index', [
            'barang' => Barang::all(),
            'jumlah_barang' => $jumlah_barang,
            'jumlah_riwayat' => $jumlah_riwayat,
            'jumlah_pinjaman' => $jumlah_pinjaman
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::create([
            'kode_barang' => request('kode_barang'),
            'nama_barang' => request('nama_barang'),
            'jumlah' => request('jumlah'),
        ]); 
        // return redirect()->route('stok');
        return redirect('/inventaris/stok');
    }

    public function addbarang(){
        return view('inventaris.barang.modal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBarangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBarangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('inventaris.barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBarangRequest  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);
        $barang->update($request->all());
        return redirect(route('stok'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();

        return redirect()->back();
    }
}
