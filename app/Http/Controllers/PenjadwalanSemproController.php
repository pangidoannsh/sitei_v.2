<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Konsentrasi;
use App\Models\Mahasiswa;
use App\Models\PenilaianSemproPembimbing;
use App\Models\PenilaianSemproPenguji;
use App\Models\PenjadwalanKP;
use App\Models\PenjadwalanSempro;
use App\Models\Prodi;
use Illuminate\Http\Request;

class PenjadwalanSemproController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id == 2) {            
            return view('penjadwalansempro.index', [
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 0)->where('prodi_id', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('penjadwalansempro.index', [
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 0)->where('prodi_id', 2)->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {            
            return view('penjadwalansempro.index', [
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 0)->where('prodi_id', 3)->get(),
            ]);
        }
    }

    public function create()
    {
        if (auth()->user()->role_id == 2) {            
            return view('penjadwalansempro.create', [    
                'prodis' => Prodi::all(),
                'mahasiswas' => Mahasiswa::where('prodi_id', 1)->get(),
                'dosens' => Dosen::all(),                
            ]);
        }        
        if (auth()->user()->role_id == 3) {            
            return view('penjadwalansempro.create', [    
                'prodis' => Prodi::all(),
                'mahasiswas' => Mahasiswa::where('prodi_id', 2)->get(),
                'dosens' => Dosen::all(),                
            ]);
        }        
        if (auth()->user()->role_id == 4) {            
            return view('penjadwalansempro.create', [    
                'prodis' => Prodi::all(),
                'mahasiswas' => Mahasiswa::where('prodi_id', 3)->get(),
                'dosens' => Dosen::all(),                
            ]);
        }        
    }

    public function store(Request $request)
    {
        $data = [
            'mahasiswa_nim' => 'required',
            'pembimbingsatu_nip' => 'required',
            'pengujisatu_nip' => 'required',
            'pengujidua_nip' => 'required',
            'pengujitiga_nip' => 'required',
            'prodi_id' => 'required',                            
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
                'mahasiswa_nim' => $validatedData['mahasiswa_nim'],
                'pembimbingsatu_nip' => $validatedData['pembimbingsatu_nip'],
                'pembimbingdua_nip' => $validatedData['pembimbingdua_nip'],
                'pengujisatu_nip' => $validatedData['pengujisatu_nip'],
                'pengujidua_nip' => $validatedData['pengujidua_nip'],
                'pengujitiga_nip' => $validatedData['pengujitiga_nip'],
                'prodi_id' => $validatedData['prodi_id'],                
                'judul_proposal' => $validatedData['judul_proposal'],
                'tanggal' => $validatedData['tanggal'],
                'waktu' => $validatedData['waktu'],
                'lokasi' => $validatedData['lokasi'],
                'dibuat_oleh' => auth()->user()->username,
            ]);
        }    
        else {
            PenjadwalanSempro::create([
                'mahasiswa_nim' => $validatedData['mahasiswa_nim'],                
                'pembimbingsatu_nip' => $validatedData['pembimbingsatu_nip'],                
                'pengujisatu_nip' => $validatedData['pengujisatu_nip'],
                'pengujidua_nip' => $validatedData['pengujidua_nip'],
                'pengujitiga_nip' => $validatedData['pengujitiga_nip'],
                'prodi_id' => $validatedData['prodi_id'],                
                'judul_proposal' => $validatedData['judul_proposal'],
                'tanggal' => $validatedData['tanggal'],
                'waktu' => $validatedData['waktu'],
                'lokasi' => $validatedData['lokasi'],
                'dibuat_oleh' => auth()->user()->username,
            ]);
        }

        return redirect('/form')->with('message', 'Jadwal Berhasil Dibuat!');
    }

    public function edit(PenjadwalanSempro $penjadwalan_sempro)
    {
        return view('penjadwalansempro.edit', [
            'sempro' => $penjadwalan_sempro,
            'prodis' => Prodi::all(),
            'mahasiswas' => Mahasiswa::all(),
            'dosens' => Dosen::all(),
        ]);
    }

    public function update(Request $request, PenjadwalanSempro $penjadwalan_sempro)
    {
        $rules = [
            'mahasiswa_nim' => 'required',
            'pembimbingsatu_nip' => 'required',
            'pengujisatu_nip' => 'required',
            'pengujidua_nip' => 'required',
            'pengujitiga_nip' => 'required',
            'prodi_id' => 'required',                           
            'judul_proposal' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
        ];        

        if ($request->pembimbingdua_nip) {
            if ($penjadwalan_sempro->pembimbingdua_nip != $request->pembimbingdua_nip) {
                $rules['pembimbingdua_nip'] = 'required';
            }
        }

        $validated = $request->validate($rules);
        $validated['dibuat_oleh'] = auth()->user()->username;

        $edit = PenjadwalanSempro::find($penjadwalan_sempro->id);
        $edit->mahasiswa_nim = $validated['mahasiswa_nim'];
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
        $edit->prodi_id = $validated['prodi_id'];                
        $edit->judul_proposal = $validated['judul_proposal'];
        $edit->tanggal = $validated['tanggal'];
        $edit->waktu = $validated['waktu'];
        $edit->lokasi = $validated['lokasi'];
        $edit->dibuat_oleh = $validated['dibuat_oleh'];
        $edit->update();

        return redirect('/form')->with('message', 'Jadwal Berhasil Diedit!');
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

        return redirect('/penilaian')->with('message', 'Seminar Telah Selesai!');
    }

    public function approve_koordinator($id)
    {
        $jadwal = PenjadwalanSempro::find($id);        
        $jadwal->status_seminar = 2;
        $jadwal->update();

        return redirect('/persetujuan-koordinator')->with('message', 'Berita Acara Disetujui!');
    }

    public function tolak_koordinator($id)
    {
        $jadwal = PenjadwalanSempro::find($id);        
        $jadwal->status_seminar = 0;
        $jadwal->update();

        return redirect('/persetujuan-koordinator')->with('message', 'Berita Acara Ditolak!');
    }

    public function approve_kaprodi($id)
    {
        $jadwal = PenjadwalanSempro::find($id);        
        $jadwal->status_seminar = 3;
        $jadwal->update();

        return redirect('/persetujuan-kaprodi')->with('message', 'Berita Acara Disetujui!');
    }

    public function tolak_kaprodi($id)
    {
        $jadwal = PenjadwalanSempro::find($id);        
        $jadwal->status_seminar = 0;
        $jadwal->update();

        return redirect('/persetujuan-kaprodi')->with('message', 'Berita Acara Ditolak!');
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

    public function nilaipembimbing($id, $pembimbing)
    {
        $penjadwalan = PenjadwalanSempro::find($id);
        $penilaian = PenilaianSemproPembimbing::where('penjadwalan_sempro_id', $id)->where('pembimbing_nip', $pembimbing)->first();
        return view('penjadwalansempro.nilai-sempro', [
            'penjadwalan' => $penjadwalan,
            'penilaianpembimbing' => $penilaian,
            'penilaianpenguji' => null,
        ]);
    }

    public function nilaipenguji($id, $penguji)
    {
        $penjadwalan = PenjadwalanSempro::find($id);
        $penilaianpenguji = PenilaianSemproPenguji::where('penjadwalan_sempro_id', $id)->where('penguji_nip', $penguji)->first();
        return view('penjadwalansempro.nilai-sempro', [
            'penjadwalan' => $penjadwalan,            
            'penilaianpenguji' => $penilaianpenguji,
        ]);
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

    public function perbaikanpengujisempro($id, $penguji)
    {
        $penjadwalan = PenjadwalanSempro::find($id);
        $penilaianpenguji = PenilaianSemproPenguji::where('penjadwalan_sempro_id', $id)->where('penguji_nip', $penguji)->first();

        return view('penjadwalansempro.perbaikan-sempro', [
            'penjadwalan' => $penjadwalan,
            'penilaianpenguji' => $penilaianpenguji,
        ]);
    }

    public function revisiproposal(Request $request, $id)
    {    
        $penjadwalan_sempro = PenjadwalanSempro::find($id);
        $penjadwalan_sempro->revisi_proposal = $request->revisi_proposal;
        $penjadwalan_sempro->update();
        $cari_penguji = PenilaianSemproPenguji::where('penjadwalan_sempro_id', $id)->where('penguji_nip', auth()->user()->nip)->count();
        if ($cari_penguji == 0) {
            return redirect('/penilaian-sempro/create/' . $id)->with('message', 'Judul Berhasil Diupdate!');
        } else {

            return redirect('/penilaian-sempro/edit/' . $id)->with('message', 'Judul Berhasil Diupdate!');
        }
        
    }

    public function riwayatjudul($id)
    {
        $penjadwalan = PenjadwalanSempro::find($id);        

        return view('penjadwalansempro.riwayat-judul', [
            'penjadwalan' => $penjadwalan,            
        ]);
    }

}
