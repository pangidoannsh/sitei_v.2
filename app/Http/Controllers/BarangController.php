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

    public function indexplp()
    {
        $jumlah_barang = Barang::all()->count();
        $jumlah_riwayat = Peminjaman::where('status', 'Selesai')->count();
        $jumlah_pinjaman = Peminjaman::whereIn('status', ['usulan','Disetujui'])->count();
        return view('inventaris.barangplp.index', [
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
        return redirect('/inventaris/stok')->with('message', 'Barang Berhasil Ditambahkan');
    }

    public function createplp()
    {
        $barang = Barang::create([
            'kode_barang' => request('kode_barang'),
            'nama_barang' => request('nama_barang'),
            'jumlah' => request('jumlah'),
        ]); 
        // return redirect()->route('stok');
        return redirect('/inventaris/stok-plp')->with('message', 'Barang Berhasil Ditambahkan');
    }

    public function addbarang(){
        return view('inventaris.barang.create');
    }

    public function addbarangplp(){
        return view('inventaris.barangplp.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBarangRequest  $request
     * @return \Illuminate\Http\Response
     */


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

    public function editplp($id)
    {
        $barang = Barang::findOrFail($id);
        return view('inventaris.barangplp.edit', compact('barang'));
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
        return redirect(route('stok'))->with('message', 'Barang Berhasil Diubah');
    }

    public function updateplp(Request $request, $id)
    {
        $barang = Barang::find($id);
        $barang->update($request->all());
        return redirect(route('stokplp'))->with('message', 'Barang Berhasil Diubah');
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

    public function destroyplp($id)
    {
        $barang = Barang::find($id);
        $barang->delete();

        return redirect()->back();
    }
}
