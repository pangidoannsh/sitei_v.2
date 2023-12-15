<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Carbon\Carbon;
use App\Models\Barang;
use Illuminate\Http\Request;

class PeminjamanAdminController extends Controller
{
    public function index()
    {
        $jumlah_barang = Barang::all()->count();
        $jumlah_riwayat = Peminjaman::whereIn('status', ['Selesai', 'Ditolak'])->count();
        $jumlah_pinjaman = Peminjaman::whereIn('status', ['usulan', 'Disetujui'])->count();
        $pinjamans = Peminjaman::whereIn("peminjamen.status", ["Usulan", "Disetujui"])->leftJoin("barangs as barang_satu", "peminjamen.barang_satu", "=", "barang_satu.id")
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

        return view('inventaris.daftarpinjamadm.index', [
            'pinjamans' => $pinjamans,
            'jumlah_barang' => $jumlah_barang,
            'jumlah_riwayat' => $jumlah_riwayat,
            'jumlah_pinjaman' => $jumlah_pinjaman
        ]);
    }

    public function setuju($id)
    {

        $pinjaman = Peminjaman::findOrFail($id);

        $pinjaman->status = 'Disetujui';
        $pinjaman->penerima = auth()->user()->nama;
        $pinjaman->waktu_pinjam = Carbon::now();
        $pinjaman->update();

        $barang_satu = Barang::findOrFail($pinjaman->barang_satu);
        $barang_satu->status = 'Dipinjam';
        $barang_satu->jumlah = 0;
        $barang_satu->update();

        if ($pinjaman->barang_dua) {
            $barang_dua = Barang::findOrFail($pinjaman->barang_dua);
            $barang_dua->status = 'Dipinjam';
            $barang_dua->jumlah = 0;
            $barang_dua->update();
        }

        if ($pinjaman->barang_tiga) {
            $barang_tiga = Barang::findOrFail($pinjaman->barang_tiga);
            $barang_tiga->status = 'Dipinjam';
            $barang_tiga->jumlah = 0;
            $barang_tiga->update();
        }

        return redirect()->back()->with('message', 'Peminjaman Disetujui');
    }

    public function ditolak($id)
    {

        $pinjaman = Peminjaman::findOrFail($id);

        $pinjaman->status = 'Ditolak';
        $pinjaman->update();

        return redirect()->back()->with('message','Peminjaman Ditolak');
    }

    public function kembali($id)
    {

        $pinjaman = Peminjaman::findOrFail($id);

        $pinjaman->status = 'Selesai';
        $pinjaman->pengembali = auth()->user()->nama;
        $pinjaman->waktu_kembali = Carbon::now();
        $pinjaman->update();

        $barang_satu = Barang::findOrFail($pinjaman->barang_satu);
        $barang_satu->status = 'Tersedia';
        $barang_satu->jumlah = 1;
        $barang_satu->update();

        if ($pinjaman->barang_dua) {
            $barang_dua = Barang::findOrFail($pinjaman->barang_dua);
            $barang_dua->status = 'Tersedia';
            $barang_dua->jumlah = 1;
            $barang_dua->update();
        }

        if ($pinjaman->barang_tiga) {
            $barang_tiga = Barang::findOrFail($pinjaman->barang_tiga);
            $barang_tiga->status = 'Tersedia';
            $barang_tiga->jumlah = 1;
            $barang_tiga->update();
        }


        return redirect()->back()->with('message','Peminjaman Dikembalikan');
    }
}
