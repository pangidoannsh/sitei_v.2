<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\Konsentrasi;
use App\Models\PenilaianKP;
use Illuminate\Http\Request;
use App\Models\PenjadwalanKP;

class PenjadwalanKPController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id == 2) {            
            return view('penjadwalankp.index', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 0)->where('prodi_id', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('penjadwalankp.index', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 0)->where('prodi_id', 2)->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {            
            return view('penjadwalankp.index', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 0)->where('prodi_id', 3)->get(),
            ]);
        }
    }

    public function create()
    {
        if (auth()->user()->role_id == 2) {            
            return view('penjadwalankp.create', [    
                'prodis' => Prodi::all(),
                'mahasiswas' => Mahasiswa::where('prodi_id', 1)->get(),
                'dosens' => Dosen::all(),                
            ]);
        }        
        if (auth()->user()->role_id == 3) {            
            return view('penjadwalankp.create', [    
                'prodis' => Prodi::all(),
                'mahasiswas' => Mahasiswa::where('prodi_id', 2)->get(),
                'dosens' => Dosen::all(),                
            ]);
        }        
        if (auth()->user()->role_id == 4) {            
            return view('penjadwalankp.create', [    
                'prodis' => Prodi::all(),
                'mahasiswas' => Mahasiswa::where('prodi_id', 3)->get(),
                'dosens' => Dosen::all(),                
            ]);
        }        
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_nim' => 'required',
            'pembimbing_nip' => 'required',
            'penguji_nip' => 'required',
            'prodi_id' => 'required',                                                             
            'judul_kp' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
        ]);

        PenjadwalanKP::create([
            'mahasiswa_nim' => $request->mahasiswa_nim,
            'pembimbing_nip' => $request->pembimbing_nip,
            'penguji_nip' => $request->penguji_nip,                        
            'prodi_id' => $request->prodi_id,            
            'judul_kp' => $request->judul_kp,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'dibuat_oleh' => auth()->user()->username,
        ]);

        return redirect('/form')->with('message', 'Jadwal Berhasil Dibuat!');
    }

    public function edit(PenjadwalanKP $penjadwalan_kp)
    {
        return view('penjadwalankp.edit', [
            'kp' => $penjadwalan_kp,
            'prodis' => Prodi::all(),
            'mahasiswas' => Mahasiswa::all(),
            'dosens' => Dosen::all(),
        ]);
    }

    public function update(Request $request, PenjadwalanKP $penjadwalan_kp)
    {
        $rules = [
            'mahasiswa_nim' => 'required',
            'pembimbing_nip' => 'required',
            'penguji_nip' => 'required',
            'prodi_id' => 'required',                        
            'judul_kp' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
        ];
               
        $validated = $request->validate($rules);

        $validated['dibuat_oleh'] = auth()->user()->username;

        PenjadwalanKP::where('id', $penjadwalan_kp->id)
            ->update($validated);

        return redirect('/form')->with('message', 'Jadwal Berhasil Diedit!');
    }

    public function riwayat()
    {
        return view('penjadwalankp.riwayat-penjadwalan-kp', [
            'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 1)->get(),
        ]);
    }

    public function approve_koordinator($id)
    {
        $jadwal = PenjadwalanKP::find($id);        
        $jadwal->status_seminar = 2;
        $jadwal->update();

        return redirect('/persetujuan-koordinator')->with('message', 'Berita Acara Disetujui!');
    }

    public function tolak_koordinator($id)
    {
        $jadwal = PenjadwalanKP::find($id);        
        $jadwal->status_seminar = 0;
        $jadwal->update();

        return redirect('/persetujuan-koordinator')->with('message', 'Berita Acara Ditolak!');
    }

    public function approve_kaprodi($id)
    {
        $jadwal = PenjadwalanKP::find($id);        
        $jadwal->status_seminar = 3;
        $jadwal->update();

        return redirect('/persetujuan-kaprodi')->with('message', 'Berita Acara Disetujui!');
    }

    public function tolak_kaprodi($id)
    {
        $jadwal = PenjadwalanKP::find($id);        
        $jadwal->status_seminar = 0;
        $jadwal->update();

        return redirect('/persetujuan-kaprodi')->with('message', 'Berita Acara Ditolak!');
    }

    public function nilaikp($id)
    {

        $penjadwalan = PenjadwalanKP::find($id);
        $penilaiankp = PenilaianKP::where('penjadwalan_kp_id', $id)->where('penguji_nip', $penjadwalan->penguji_nip)->first();

        return view('penjadwalankp.nilai-kp', [
            'penjadwalan' => $penjadwalan,
            'penilaiankp' => $penilaiankp,
        ]);
    }

    public function perbaikan($id)
    {
        $penjadwalan = PenjadwalanKP::find($id);
        $penilaianpenguji = PenilaianKP::where('penjadwalan_kp_id', $id)->where('penguji_nip', auth()->user()->nip)->first();

        return view('penjadwalankp.perbaikan-kp', [
            'penjadwalan' => $penjadwalan,
            'penilaianpenguji' => $penilaianpenguji,
        ]);
    }

    public function perbaikanpengujikp($id, $penguji)
    {
        $penjadwalan = PenjadwalanKP::find($id);
        $penilaianpenguji = PenilaianKP::where('penjadwalan_kp_id', $id)->where('penguji_nip', $penguji)->first();

        return view('penjadwalankp.perbaikan-kp', [
            'penjadwalan' => $penjadwalan,
            'penilaianpenguji' => $penilaianpenguji,
        ]);
    }
}
