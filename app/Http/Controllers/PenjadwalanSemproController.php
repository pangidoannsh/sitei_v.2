<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\PenilaianSemproPembimbing;
use App\Models\PenilaianSemproPenguji;
use App\Models\PenjadwalanSempro;
use Illuminate\Http\Request;

class PenjadwalanSemproController extends Controller
{
    public function index()
    {
        return view('penjadwalansempro.index', [
            'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 0)->get(),
        ]);
    }

    public function create()
    {
        return view('penjadwalansempro.create', [
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
            'mahasiswa_nim' => 'required|unique:penjadwalan_sempro',
            'jenis_seminar' => 'required',
            'judul_proposal' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
        ];

        if ($request->pembimbingdua_nip) {
            $data['pembimbingdua_nip'] = 'required';
        }

        $validatedData = $request->validate($data);

        if ($request->pembimbingdua_nip) {
            PenjadwalanSempro::create([
                'pembimbingsatu_nip' => $validatedData['pembimbingsatu_nip'],
                'pembimbingdua_nip' => $validatedData['pembimbingdua_nip'],
                'pengujisatu_nip' => $validatedData['pengujisatu_nip'],
                'pengujidua_nip' => $validatedData['pengujidua_nip'],
                'pengujitiga_nip' => $validatedData['pengujitiga_nip'],
                'mahasiswa_nim' => $validatedData['mahasiswa_nim'],
                'jenis_seminar' => $validatedData['jenis_seminar'],
                'judul_proposal' => $validatedData['judul_proposal'],
                'tanggal' => $validatedData['tanggal'],
                'waktu' => $validatedData['waktu'],
                'lokasi' => $validatedData['lokasi'],
                'dibuat_oleh' => auth()->user()->nip,
            ]);
        } else {
            PenjadwalanSempro::create([
                'pembimbingsatu_nip' => $validatedData['pembimbingsatu_nip'],
                'pengujisatu_nip' => $validatedData['pengujisatu_nip'],
                'pengujidua_nip' => $validatedData['pengujidua_nip'],
                'pengujitiga_nip' => $validatedData['pengujitiga_nip'],
                'mahasiswa_nim' => $validatedData['mahasiswa_nim'],
                'jenis_seminar' => $validatedData['jenis_seminar'],
                'judul_proposal' => $validatedData['judul_proposal'],
                'tanggal' => $validatedData['tanggal'],
                'waktu' => $validatedData['waktu'],
                'lokasi' => $validatedData['lokasi'],
                'dibuat_oleh' => auth()->user()->nip,
            ]);
        }

        return redirect('/form-sempro')->with('message', 'Jadwal Berhasil Dibuat!');
    }

    public function edit(PenjadwalanSempro $penjadwalan_sempro)
    {
        return view('penjadwalansempro.edit', [
            'sempro' => $penjadwalan_sempro,
            'mahasiswas' => Mahasiswa::all(),
            'dosens' => Dosen::all(),
        ]);
    }

    public function update(Request $request, PenjadwalanSempro $penjadwalan_sempro)
    {
        $rules = [
            'pembimbingsatu_nip' => 'required',
            'pengujisatu_nip' => 'required',
            'pengujidua_nip' => 'required',
            'pengujitiga_nip' => 'required',
            'jenis_seminar' => 'required',
            'judul_proposal' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
        ];

        if ($penjadwalan_sempro->mahasiswa_nim != $request->mahasiswa_nim) {
            $rules['mahasiswa_nim'] = 'required|unique:penjadwalan_sempro';
        }

        if ($request->pembimbingdua_nip) {
            if ($penjadwalan_sempro->pembimbingdua_nip != $request->pembimbingdua_nip) {
                $rules['pembimbingdua_nip'] = 'required';
            }
        }

        $validated = $request->validate($rules);
        $validated['dibuat_oleh'] = auth()->user()->nip;

        $edit = PenjadwalanSempro::find($penjadwalan_sempro->id);
        $edit->pembimbingsatu_nip = $validated['pembimbingsatu_nip'];

        if ($request->pembimbingdua_nip) {
            if ($penjadwalan_sempro->pembimbingdua_nip != $request->pembimbingdua_nip) {
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

        if ($penjadwalan_sempro->mahasiswa_nim != $request->mahasiswa_nim) {
            $edit->mahasiswa_nim = $validated['mahasiswa_nim'];
        }

        $edit->jenis_seminar = $validated['jenis_seminar'];
        $edit->judul_proposal = $validated['judul_proposal'];
        $edit->tanggal = $validated['tanggal'];
        $edit->waktu = $validated['waktu'];
        $edit->lokasi = $validated['lokasi'];
        $edit->dibuat_oleh = $validated['dibuat_oleh'];
        $edit->update();

        return redirect('/form-sempro')->with('message', 'Jadwal Berhasil Diedit!');
    }

    public function ceknilai($id)
    {

        $pembimbing = PenilaianSemproPembimbing::where('penjadwalan_sempro_id', $id)->get();

        $penjadwalan = PenjadwalanSempro::find($id);
        $nilaipenguji1 = PenilaianSemproPenguji::where('penjadwalan_sempro_id', $id)->where('penguji_nip', $penjadwalan->pengujisatu_nip)->first();

        $nilaipenguji2 = PenilaianSemproPenguji::where('penjadwalan_sempro_id', $id)->where('penguji_nip', $penjadwalan->pengujidua_nip)->first();

        $nilaipenguji3 = PenilaianSemproPenguji::where('penjadwalan_sempro_id', $id)->where('penguji_nip', $penjadwalan->pengujitiga_nip)->first();

        if ($pembimbing->count() > 1) {
            $pembimbingnilai = PenilaianSemproPembimbing::where('penjadwalan_sempro_id', $id)->get();
        } else {
            $pembimbingnilai = PenilaianSemproPembimbing::where('penjadwalan_sempro_id', $penjadwalan->id)->first();
        }

        $nilaipembimbing1 = PenilaianSemproPembimbing::where('penjadwalan_sempro_id', $id)->where('pembimbing_nip', $penjadwalan->pembimbingsatu_nip)->first();

        if ($penjadwalan->pembimbingdua_nip == null) {
            return view('penjadwalansempro.cek-nilai', [
                'pembimbing' => $pembimbing,
                'pembimbingnilai' => $pembimbingnilai,
                'penjadwalan' => $penjadwalan,
                'nilaipenguji1' => $nilaipenguji1,
                'nilaipenguji2' => $nilaipenguji2,
                'nilaipenguji3' => $nilaipenguji3,
                'nilaipembimbing1' => $nilaipembimbing1,
            ]);
        } else {
            $nilaipembimbing2 = PenilaianSemproPembimbing::where('penjadwalan_sempro_id', $id)->where('pembimbing_nip', $penjadwalan->pembimbingdua_nip)->first();

            return view('penjadwalansempro.cek-nilai', [
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
        $jadwal = PenjadwalanSempro::find($id);
        $jadwal->status_seminar = 1;
        $jadwal->update();

        return redirect('/penilaian-sempro')->with('message', 'Seminar Telah Selesai!');
    }

    public function riwayat()
    {
        return view('penjadwalansempro.riwayat-penjadwalan-sempro', [
            'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 1)->get(),
        ]);
    }

    public function nilaisempro($id)
    {

        $penjadwalan = PenjadwalanSempro::find($id);
        $cek = PenilaianSemproPembimbing::where('penjadwalan_sempro_id', $id)->where('pembimbing_nip', auth()->user()->nip)->count();

        if ($cek != 0) {
            $penilaianpembimbing = PenilaianSemproPembimbing::where('penjadwalan_sempro_id', $id)->where('pembimbing_nip', auth()->user()->nip)->first();

            return view('penjadwalansempro.nilai-sempro', [
                'penjadwalan' => $penjadwalan,
                'penilaianpembimbing' => $penilaianpembimbing,
                'penilaianpenguji' => null,
            ]);
        } else {
            $penilaianpenguji = PenilaianSemproPenguji::where('penjadwalan_sempro_id', $id)->where('penguji_nip', auth()->user()->nip)->first();

            return view('penjadwalansempro.nilai-sempro', [
                'penjadwalan' => $penjadwalan,
                'penilaianpenguji' => $penilaianpenguji,
            ]);
        }
    }

    public function perbaikan($id)
    {
        $penjadwalan = PenjadwalanSempro::find($id);
        $penilaianpenguji = PenilaianSemproPenguji::where('penjadwalan_sempro_id', $id)->where('penguji_nip', auth()->user()->nip)->first();

        return view('penjadwalansempro.perbaikan-sempro', [
            'penjadwalan' => $penjadwalan,
            'penilaianpenguji' => $penilaianpenguji,
        ]);
    }
}
