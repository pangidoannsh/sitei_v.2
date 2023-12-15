<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;

class PeminjamanMahasiswaController extends Controller
{
    public function index(){
        // $pinjaman = Peminjaman::where('user_id', auth()->user()->id )->whereIn('status', ['usulan','Disetujui'])->latest()->get();
        $jumlah_barang = Barang::all()->count();
        $jumlah_riwayat = Peminjaman::where('user_id', auth()->user()->id)->whereIn('status', ['Selesai', 'Ditolak'])->count();
        $jumlah_pinjaman = Peminjaman::where('user_id', auth()->user()->id)->whereIn('status', ['usulan','Disetujui'])->count();
        $pinjaman = Peminjaman::where('peminjamen.user_id', auth()->user()->id )->whereIn("peminjamen.status", ["Usulan","Disetujui"])->leftJoin("barangs as barang_satu", "peminjamen.barang_satu", "=", "barang_satu.id")
            ->leftJoin("barangs as barang_dua", "peminjamen.barang_dua", "=", "barang_dua.id")
            ->leftJoin("barangs as barang_tiga", "peminjamen.barang_tiga", "=", "barang_tiga.id")
            ->select(
                "barang_satu.nama_barang as barang_satu",
                "barang_dua.nama_barang as barang_dua",
                "barang_tiga.nama_barang as barang_tiga",
                "peminjamen.peminjam",
                "peminjamen.tujuan",
                "peminjamen.ruangan",
                "peminjamen.waktu_pinjam",
                "peminjamen.penerima",
                "peminjamen.pengembali",
                "peminjamen.waktu_kembali",
                "peminjamen.jaminan",
                "peminjamen.status",
                "peminjamen.id"
            )
            ->get();
            
        return view('inventaris.daftarpinjammhs.index', [
            'pinjamans' => $pinjaman,
            'jumlah_barang' => $jumlah_barang,
            'jumlah_riwayat' => $jumlah_riwayat,
            'jumlah_pinjaman' => $jumlah_pinjaman
        ]);
    }

    public function destroy($id){
        $pinjaman = Peminjaman::find($id);
        $pinjaman->delete();

        return redirect()->back()->with('message', 'Barang Berhasil Dihapus!');
    }

    public function edit($id){
        $pinjaman = Peminjaman::find($id);
        return view('inventaris.formpinjam.edit', compact('pinjaman'),[
            'nama_barang' => Barang::all()
        ]);
    }

    public function update(Request $request, $id){
        $pinjaman = Peminjaman::find($id);
        $pinjaman->update($request->all());
        return redirect()->route('peminjaman')->with('message', 'Barang Berhasil Diubah!');
    }
}
