<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function riwayat(){
        // $pinjaman = Peminjaman::where('status', 'Selesai')->latest()->get();
        $jumlah_barang = Barang::all()->count();
        $jumlah_riwayat = Peminjaman::whereIn('status', ['Selesai','Ditolak'])->count();
        $jumlah_pinjaman = Peminjaman::whereIn('status', ['usulan','Disetujui'])->count();
        $pinjaman = Peminjaman::whereIn("peminjamen.status", ["Selesai","Ditolak"])->leftJoin("barangs as barang_satu", "peminjamen.barang_satu", "=", "barang_satu.id")
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

        return view('inventaris.riwayatadm.index', [
            'pinjamans' => $pinjaman,
            'jumlah_barang' => $jumlah_barang,
            'jumlah_riwayat' => $jumlah_riwayat,
            'jumlah_pinjaman' => $jumlah_pinjaman
        ]);
    }

    public function riwayatplp(){
        // $pinjaman = Peminjaman::where('status', 'Selesai')->latest()->get();
        $jumlah_barang = Barang::all()->count();
        $jumlah_riwayat = Peminjaman::whereIn('status', ['Selesai','Ditolak'])->count();
        $jumlah_pinjaman = Peminjaman::whereIn('status', ['usulan','Disetujui'])->count();
        $pinjaman = Peminjaman::whereIn("peminjamen.status", ["Selesai","Ditolak"])->leftJoin("barangs as barang_satu", "peminjamen.barang_satu", "=", "barang_satu.id")
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

        return view('inventaris.riwayatplp.index', [
            'pinjamans' => $pinjaman,
            'jumlah_barang' => $jumlah_barang,
            'jumlah_riwayat' => $jumlah_riwayat,
            'jumlah_pinjaman' => $jumlah_pinjaman
        ]);
    }

    public function riwayatmhs(){
        // $pinjaman = Peminjaman::where('user_id', auth()->user()->id)->where('status', 'Selesai')->latest()->get();
        $jumlah_barang = Barang::all()->count();
        $jumlah_riwayat = Peminjaman::where('user_id', auth()->user()->id)->whereIn('status', ['Selesai', 'Ditolak'])->count();
        $jumlah_pinjaman = Peminjaman::where('user_id', auth()->user()->id)->whereIn('status', ['usulan','Disetujui'])->count();
        $pinjaman = Peminjaman::where('peminjamen.user_id', auth()->user()->id )->whereIn("peminjamen.status", ["Selesai","Ditolak"])->leftJoin("barangs as barang_satu", "peminjamen.barang_satu", "=", "barang_satu.id")
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

        return view('inventaris.riwayatmhs.index',[
            'pinjamans' => $pinjaman,
            'jumlah_barang' => $jumlah_barang,
            'jumlah_riwayat' => $jumlah_riwayat,
            'jumlah_pinjaman' => $jumlah_pinjaman
        ]);
    }

    public function riwayatdsn(){
        // $pinjaman = Peminjaman::where('user_id', auth()->user()->id)->where('status', 'Selesai')->latest()->get();
        $jumlah_barang = Barang::all()->count();
        $jumlah_riwayat = Peminjaman::where('user_id', auth()->user()->id)->whereIn('status', ['Selesai', 'Ditolak'])->count();
        $jumlah_pinjaman = Peminjaman::where('user_id', auth()->user()->id)->whereIn('status', ['usulan','Disetujui'])->count();
        $pinjaman = Peminjaman::where('peminjamen.user_id', auth()->user()->id )->whereIn("peminjamen.status", ["Selesai","Ditolak"])->leftJoin("barangs as barang_satu", "peminjamen.barang_satu", "=", "barang_satu.id")
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

        return view('inventaris.riwayatdsn.index',[
            'pinjamans' => $pinjaman,
            'jumlah_barang' => $jumlah_barang,
            'jumlah_riwayat' => $jumlah_riwayat,
            'jumlah_pinjaman' => $jumlah_pinjaman
        ]);
    }
}
