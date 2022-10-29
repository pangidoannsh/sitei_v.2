<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\Konsentrasi;
use Illuminate\Http\Request;
use App\Models\PenjadwalanSkripsi;
use App\Models\PenilaianSkripsiPenguji;
use App\Models\PenilaianSkripsiPembimbing;

class PenjadwalanSkripsiController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id == 2) {            
            return view('penjadwalanskripsi.index', [
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 0)->where('prodi_id', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('penjadwalanskripsi.index', [
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 0)->where('prodi_id', 2)->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {            
            return view('penjadwalanskripsi.index', [
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 0)->where('prodi_id', 3)->get(),
            ]);
        }
    }

    public function create()
    {
        if (auth()->user()->role_id == 2) {            
            return view('penjadwalanskripsi.create', [    
                'prodis' => Prodi::all(),
                'mahasiswas' => Mahasiswa::where('prodi_id', 1)->get(),
                'dosens' => Dosen::all(),                
            ]);
        }        
        if (auth()->user()->role_id == 3) {            
            return view('penjadwalanskripsi.create', [    
                'prodis' => Prodi::all(),
                'mahasiswas' => Mahasiswa::where('prodi_id', 2)->get(),
                'dosens' => Dosen::all(),                
            ]);
        }        
        if (auth()->user()->role_id == 4) {            
            return view('penjadwalanskripsi.create', [    
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
                'mahasiswa_nim' => $validatedData['mahasiswa_nim'],
                'pembimbingsatu_nip' => $validatedData['pembimbingsatu_nip'],
                'pembimbingdua_nip' => $validatedData['pembimbingdua_nip'],
                'pengujisatu_nip' => $validatedData['pengujisatu_nip'],
                'pengujidua_nip' => $validatedData['pengujidua_nip'],
                'pengujitiga_nip' => $validatedData['pengujitiga_nip'],
                'prodi_id' => $validatedData['prodi_id'],                
                'judul_skripsi' => $validatedData['judul_skripsi'],
                'tanggal' => $validatedData['tanggal'],
                'waktu' => $validatedData['waktu'],
                'lokasi' => $validatedData['lokasi'],
                'dibuat_oleh' => auth()->user()->username,
            ]);
        } else {
            PenjadwalanSkripsi::create([
                'mahasiswa_nim' => $validatedData['mahasiswa_nim'],                
                'pembimbingsatu_nip' => $validatedData['pembimbingsatu_nip'],                
                'pengujisatu_nip' => $validatedData['pengujisatu_nip'],
                'pengujidua_nip' => $validatedData['pengujidua_nip'],
                'pengujitiga_nip' => $validatedData['pengujitiga_nip'],
                'prodi_id' => $validatedData['prodi_id'],                
                'judul_skripsi' => $validatedData['judul_skripsi'],
                'tanggal' => $validatedData['tanggal'],
                'waktu' => $validatedData['waktu'],
                'lokasi' => $validatedData['lokasi'],
                'dibuat_oleh' => auth()->user()->username,
            ]);
        }

        return redirect('/form')->with('message', 'Jadwal Berhasil Dibuat!');
    }

    public function edit(PenjadwalanSkripsi $penjadwalan_skripsi)
    {
        return view('penjadwalanskripsi.edit', [
            'skripsi' => $penjadwalan_skripsi,
            'prodis' => Prodi::all(),
            'mahasiswas' => Mahasiswa::all(),
            'dosens' => Dosen::all(),
        ]);
    }

    public function update(Request $request, PenjadwalanSkripsi $penjadwalan_skripsi)
    {
        $rules = [
            'mahasiswa_nim' => 'required',
            'pembimbingsatu_nip' => 'required',
            'pengujisatu_nip' => 'required',
            'pengujidua_nip' => 'required',
            'pengujitiga_nip' => 'required',
            'prodi_id' => 'required',                           
            'judul_skripsi' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
        ];        

        if ($request->pembimbingdua_nip) {
            if ($penjadwalan_skripsi->pembimbingdua_nip != $request->pembimbingdua_nip) {
                $rules['pembimbingdua_nip'] = 'required';
            }
        }

        $validated = $request->validate($rules);
        $validated['dibuat_oleh'] = auth()->user()->username;

        $edit = PenjadwalanSkripsi::find($penjadwalan_skripsi->id);
        $edit->mahasiswa_nim = $validated['mahasiswa_nim'];
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
        $edit->prodi_id = $validated['prodi_id'];                
        $edit->judul_skripsi = $validated['judul_skripsi'];
        $edit->tanggal = $validated['tanggal'];
        $edit->waktu = $validated['waktu'];
        $edit->lokasi = $validated['lokasi'];
        $edit->dibuat_oleh = $validated['dibuat_oleh'];
        $edit->update();

        return redirect('/form')->with('message', 'Jadwal Berhasil Diedit!');
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

        return redirect('/penilaian')->with('message', 'Seminar Telah Selesai!');
    }

    public function approve_koordinator($id)
    {
        $jadwal = PenjadwalanSkripsi::find($id);        
        $jadwal->status_seminar = 2;
        $jadwal->update();

        return redirect('/persetujuan-koordinator')->with('message', 'Berita Acara Disetujui!');
    }

    public function tolak_koordinator($id)
    {
        $jadwal = PenjadwalanSkripsi::find($id);        
        $jadwal->status_seminar = 0;
        $jadwal->update();

        return redirect('/persetujuan-koordinator')->with('message', 'Berita Acara Ditolak!');
    }

    public function approve_kaprodi($id)
    {
        $jadwal = PenjadwalanSkripsi::find($id);        
        $jadwal->status_seminar = 3;
        $jadwal->update();

        return redirect('/persetujuan-kaprodi')->with('message', 'Berita Acara Disetujui!');
    }

    public function tolak_kaprodi($id)
    {
        $jadwal = PenjadwalanSkripsi::find($id);        
        $jadwal->status_seminar = 0;
        $jadwal->update();

        return redirect('/persetujuan-kaprodi')->with('message', 'Berita Acara Ditolak!');
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

    public function nilaipembimbing($id, $pembimbing)
    {
        $penjadwalan = PenjadwalanSkripsi::find($id);
        $penilaian = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->where('pembimbing_nip', $pembimbing)->first();
        return view('penjadwalanskripsi.nilai-skripsi', [
            'penjadwalan' => $penjadwalan,
            'penilaianpembimbing' => $penilaian,
            'penilaianpenguji' => null,
        ]);
    }

    public function nilaipenguji($id, $penguji)
    {
        $penjadwalan = PenjadwalanSkripsi::find($id);
        $penilaianpenguji = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', $penguji)->first();
        return view('penjadwalanskripsi.nilai-skripsi', [
            'penjadwalan' => $penjadwalan,            
            'penilaianpenguji' => $penilaianpenguji,
        ]);
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

    public function perbaikanpengujiskripsi($id, $penguji)
    {
        $penjadwalan = PenjadwalanSkripsi::find($id);
        $penilaianpenguji = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', $penguji)->first();

        return view('penjadwalanskripsi.perbaikan-skripsi', [
            'penjadwalan' => $penjadwalan,
            'penilaianpenguji' => $penilaianpenguji,
        ]);
    }

    public function revisiskripsi(Request $request, $id)
    {    
        $penjadwalan_skripsi = PenjadwalanSkripsi::find($id);
        $penjadwalan_skripsi->revisi_skripsi = $request->revisi_skripsi;
        $penjadwalan_skripsi->update();
        $cari_penguji = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', auth()->user()->nip)->count();
        if ($cari_penguji == 0) {
            return redirect('/penilaian-skripsi/create/' . $id)->with('message', 'Judul Berhasil Diupdate!');
        } else {

            return redirect('/penilaian-skripsi/edit/' . $id)->with('message', 'Judul Berhasil Diupdate!');
        }
        
    }

    public function riwayatjudul($id)
    {
        $penjadwalan = PenjadwalanSkripsi::find($id);        

        return view('penjadwalanskripsi.riwayat-judul', [
            'penjadwalan' => $penjadwalan,            
        ]);
    }
}
