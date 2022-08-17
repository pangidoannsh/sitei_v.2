<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\PenjadwalanSkripsi;
use App\Models\PenilaianSkripsiPenguji;
use App\Models\PenilaianSkripsiPembimbing;

class PenjadwalanSkripsiController extends Controller
{
    public function index()
    {
        return view('penjadwalanskripsi.index', [
            'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 0)->get(),
        ]);
    }

    public function create()
    {
        return view('penjadwalanskripsi.create', [
            'mahasiswas' => Mahasiswa::all(),
            'dosens' => Dosen::all(),
        ]);
    }

    public function store(Request $request)
    {

        $data = [
            'pembimbingsatu_nip' => 'required',
            'pengujisatu_nip' => 'required',
            'pengujidua_nip' => 'required',
            'pengujitiga_nip' => 'required',
            'mahasiswa_nim' => 'required|unique:penjadwalan_skripsi',
            'jenis_seminar' => 'required',
            'judul_skripsi' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
        ];

        if ($request->pembimbingdua_nip) {
            $data['pembimbingdua_nip'] = 'required';
        }

        $validatedData = $request->validate($data);

        if ($request->pembimbingdua_nip) {
            PenjadwalanSkripsi::create([
                'pembimbingsatu_nip' => $validatedData['pembimbingsatu_nip'],
                'pembimbingdua_nip' => $validatedData['pembimbingdua_nip'],
                'pengujisatu_nip' => $validatedData['pengujisatu_nip'],
                'pengujidua_nip' => $validatedData['pengujidua_nip'],
                'pengujitiga_nip' => $validatedData['pengujitiga_nip'],
                'mahasiswa_nim' => $validatedData['mahasiswa_nim'],
                'jenis_seminar' => $validatedData['jenis_seminar'],
                'judul_skripsi' => $validatedData['judul_skripsi'],
                'tanggal' => $validatedData['tanggal'],
                'waktu' => $validatedData['waktu'],
                'lokasi' => $validatedData['lokasi'],
                'dibuat_oleh' => auth()->user()->nip,
            ]);
        } else {
            PenjadwalanSkripsi::create([
                'pembimbingsatu_nip' => $validatedData['pembimbingsatu_nip'],
                'pengujisatu_nip' => $validatedData['pengujisatu_nip'],
                'pengujidua_nip' => $validatedData['pengujidua_nip'],
                'pengujitiga_nip' => $validatedData['pengujitiga_nip'],
                'mahasiswa_nim' => $validatedData['mahasiswa_nim'],
                'jenis_seminar' => $validatedData['jenis_seminar'],
                'judul_skripsi' => $validatedData['judul_skripsi'],
                'tanggal' => $validatedData['tanggal'],
                'waktu' => $validatedData['waktu'],
                'lokasi' => $validatedData['lokasi'],
                'dibuat_oleh' => auth()->user()->nip,
            ]);
        }

        return redirect('/form-skripsi')->with('message', 'Jadwal Berhasil Dibuat!');
    }

    public function edit(PenjadwalanSkripsi $penjadwalan_skripsi)
    {
        return view('penjadwalanskripsi.edit', [
            'skripsi' => $penjadwalan_skripsi,
            'mahasiswas' => Mahasiswa::all(),
            'dosens' => Dosen::all(),
        ]);
    }

    public function update(Request $request, PenjadwalanSkripsi $penjadwalan_skripsi)
    {
        $rules = [
            'pembimbingsatu_nip' => 'required',
            'pengujisatu_nip' => 'required',
            'pengujidua_nip' => 'required',
            'pengujitiga_nip' => 'required',
            'jenis_seminar' => 'required',
            'judul_skripsi' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
        ];

        if ($penjadwalan_skripsi->mahasiswa_nim != $request->mahasiswa_nim) {
            $rules['mahasiswa_nim'] = 'required|unique:penjadwalan_skripsi';
        }

        if ($request->pembimbingdua_nip) {
            if ($penjadwalan_skripsi->pembimbingdua_nip != $request->pembimbingdua_nip) {
                $rules['pembimbingdua_nip'] = 'required';
            }
        }

        $validated = $request->validate($rules);
        $validated['dibuat_oleh'] = auth()->user()->nip;

        $edit = PenjadwalanSkripsi::find($penjadwalan_skripsi->id);
        $edit->pembimbingsatu_nip = $validated['pembimbingsatu_nip'];

        if ($request->pembimbingdua_nip) {
            if ($penjadwalan_skripsi->pembimbingdua_nip != $request->pembimbingdua_nip) {
                if ($request->pembimbingdua_nip == 1) {
                    $edit->pembimbingdua_nip = null;
                } else {
                    $edit->pembimbingdua_nip = $validated['pembimbingdua_nip'];
                }
            }
        }

        $edit->pengujisatu_nip = $validated['pengujisatu_nip'];
        $edit->pengujidua_nip = $validated['pengujidua_nip'];
        $edit->pengujitiga_nip = $validated['pengujitiga_nip'];

        if ($penjadwalan_skripsi->mahasiswa_nim != $request->mahasiswa_nim) {
            $edit->mahasiswa_nim = $validated['mahasiswa_nim'];
        }

        $edit->jenis_seminar = $validated['jenis_seminar'];
        $edit->judul_skripsi = $validated['judul_skripsi'];
        $edit->tanggal = $validated['tanggal'];
        $edit->waktu = $validated['waktu'];
        $edit->lokasi = $validated['lokasi'];
        $edit->dibuat_oleh = $validated['dibuat_oleh'];
        $edit->update();

        return redirect('/form-skripsi')->with('message', 'Jadwal Berhasil Diedit!');
    }

    public function ceknilai($id)
    {

        $pembimbing = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->get();

        $penjadwalan = PenjadwalanSkripsi::find($id);
        $nilaipenguji1 = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', $penjadwalan->pengujisatu_nip)->first();

        $nilaipenguji2 = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', $penjadwalan->pengujidua_nip)->first();

        $nilaipenguji3 = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', $penjadwalan->pengujitiga_nip)->first();

        if ($pembimbing->count() > 1) {
            $pembimbingnilai = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->get();
        } else {
            $pembimbingnilai = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $penjadwalan->id)->first();
        }

        $nilaipembimbing1 = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->where('pembimbing_nip', $penjadwalan->pembimbingsatu_nip)->first();

        if ($penjadwalan->pembimbingdua_nip == null) {
            return view('penjadwalanskripsi.cek-nilai', [
                'pembimbing' => $pembimbing,
                'pembimbingnilai' => $pembimbingnilai,
                'penjadwalan' => $penjadwalan,
                'nilaipenguji1' => $nilaipenguji1,
                'nilaipenguji2' => $nilaipenguji2,
                'nilaipenguji3' => $nilaipenguji3,
                'nilaipembimbing1' => $nilaipembimbing1,
            ]);
        } else {
            $nilaipembimbing2 = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->where('pembimbing_nip', $penjadwalan->pembimbingdua_nip)->first();

            return view('penjadwalanskripsi.cek-nilai', [
                'pembimbing' => $pembimbing,
                'pembimbingnilai' => $pembimbingnilai,
                'penjadwalan' => $penjadwalan,
                'nilaipenguji1' => $nilaipenguji1,
                'nilaipenguji2' => $nilaipenguji2,
                'nilaipenguji3' => $nilaipenguji3,
                'nilaipembimbing1' => $nilaipembimbing1,
                'nilaipembimbing2' => $nilaipembimbing2,
            ]);
        }
    }

    public function approve($id)
    {
        $jadwal = PenjadwalanSkripsi::find($id);
        $jadwal->status_seminar = 1;
        $jadwal->update();

        return redirect('/penilaian-skripsi')->with('message', 'Seminar Telah Selesai!');
    }

    public function riwayat()
    {
        return view('penjadwalanskripsi.riwayat-penjadwalan-skripsi', [
            'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 1)->get(),
        ]);
    }

    public function nilaiskripsi($id)
    {

        $penjadwalan = PenjadwalanSkripsi::find($id);
        $cek = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->where('pembimbing_nip', auth()->user()->nip)->count();

        if ($cek != 0) {
            $penilaianpembimbing = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->where('pembimbing_nip', auth()->user()->nip)->first();

            return view('penjadwalanskripsi.nilai-skripsi', [
                'penjadwalan' => $penjadwalan,
                'penilaianpembimbing' => $penilaianpembimbing,
                'penilaianpenguji' => null,
            ]);
        } else {
            $penilaianpenguji = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', auth()->user()->nip)->first();

            return view('penjadwalanskripsi.nilai-skripsi', [
                'penjadwalan' => $penjadwalan,
                'penilaianpenguji' => $penilaianpenguji,
            ]);
        }
    }

    public function perbaikan($id)
    {
        $penjadwalan = PenjadwalanSkripsi::find($id);
        $penilaianpenguji = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', auth()->user()->nip)->first();

        return view('penjadwalanskripsi.perbaikan-skripsi', [
            'penjadwalan' => $penjadwalan,
            'penilaianpenguji' => $penilaianpenguji,
        ]);
    }
}
