<?php

namespace App\Http\Controllers;

use \PDF;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\Konsentrasi;
use Illuminate\Http\Request;
use App\Models\PenjadwalanKP;
use App\Models\PenjadwalanSempro;
use App\Models\PendaftaranSkripsi;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\PenilaianSemproPenguji;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\PenilaianSemproPembimbing;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
                'mahasiswas' => Mahasiswa::where('prodi_id', 1)->get()->sortBy('nama'),
                'dosens' => Dosen::all(),                
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('keterangan', 'Menunggu Jadwal Seminar Proposal')->where('prodi_id', 1)->get(),  
            ]);
        }        
        if (auth()->user()->role_id == 3) {            
            return view('penjadwalansempro.create', [    
                'prodis' => Prodi::all(),
                'mahasiswas' => Mahasiswa::where('prodi_id', 2)->get()->sortBy('nama'),
                'dosens' => Dosen::all()->sortBy('nama'),
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('keterangan', 'Menunggu Jadwal Seminar Proposal')->where('prodi_id', 2)->get(),                  
            ]);
        }        
        if (auth()->user()->role_id == 4) {            
            return view('penjadwalansempro.create', [    
                'prodis' => Prodi::all(),
                'mahasiswas' => Mahasiswa::where('prodi_id', 3)->get()->sortBy('nama'),
                'dosens' => Dosen::all()->sortBy('nama'),
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('keterangan', 'Menunggu Jadwal Seminar Proposal')->where('prodi_id', 3)->get(),                  
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
            'prodi_id' => 'required',                            
            'judul_proposal' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
        ];

        if ($request->pembimbingdua_nip) {
            $data['pembimbingdua_nip'] = 'required';            
        }
        
        if ($request->pengujitiga_nip) {
            $data['pengujitiga_nip'] = 'required';            
        } 

        $validatedData = $request->validate($data);

        if ($request->pembimbingdua_nip && $request->pengujitiga_nip) {
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
        elseif ($request->pembimbingdua_nip == null && $request->pengujitiga_nip == null) {
            PenjadwalanSempro::create([
                'mahasiswa_nim' => $validatedData['mahasiswa_nim'],                
                'pembimbingsatu_nip' => $validatedData['pembimbingsatu_nip'],                
                'pengujisatu_nip' => $validatedData['pengujisatu_nip'],
                'pengujidua_nip' => $validatedData['pengujidua_nip'],                
                'prodi_id' => $validatedData['prodi_id'],                
                'judul_proposal' => $validatedData['judul_proposal'],
                'tanggal' => $validatedData['tanggal'],
                'waktu' => $validatedData['waktu'],
                'lokasi' => $validatedData['lokasi'],
                'dibuat_oleh' => auth()->user()->username,
            ]);
        }        
        elseif ($request->pembimbingdua_nip == null) {
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
        elseif ($request->pengujitiga_nip == null) {
            PenjadwalanSempro::create([
                'mahasiswa_nim' => $validatedData['mahasiswa_nim'],                
                'pembimbingsatu_nip' => $validatedData['pembimbingsatu_nip'],                
                'pembimbingdua_nip' => $validatedData['pembimbingdua_nip'],
                'pengujisatu_nip' => $validatedData['pengujisatu_nip'],
                'pengujidua_nip' => $validatedData['pengujidua_nip'],                
                'prodi_id' => $validatedData['prodi_id'],                
                'judul_proposal' => $validatedData['judul_proposal'],
                'tanggal' => $validatedData['tanggal'],
                'waktu' => $validatedData['waktu'],
                'lokasi' => $validatedData['lokasi'],
                'dibuat_oleh' => auth()->user()->username,
            ]);
        }

        // Alert::success('Berhasil!', 'Jadwal Berhasil Ditambahkan')->showConfirmButton('Ok', '#28a745');
        // return redirect('/persetujuan/admin/index');
        return redirect('/form')->with('message', 'Jadwal Berhasil Ditambahkan!');
    }

    public function edit($id)
    {
        $decrypted = Crypt::decryptString($id);
        $sempro = PenjadwalanSempro::findOrFail($decrypted);

        return view('penjadwalansempro.edit', [
            'sempro' => $sempro,
            'prodis' => Prodi::all(),
            'mahasiswas' => Mahasiswa::all()->sortBy('nama'),
            'dosens' => Dosen::all()->sortBy('nama'),
        ]);
    }

    public function update(Request $request, PenjadwalanSempro $penjadwalan_sempro)
    {
        $rules = [
            'mahasiswa_nim' => 'required',
            'pembimbingsatu_nip' => 'required',
            'pengujisatu_nip' => 'required',
            'pengujidua_nip' => 'required',            
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

        if ($request->pengujitiga_nip) {
            if ($penjadwalan_sempro->pengujitiga_nip != $request->pengujitiga_nip) {
                $rules['pengujitiga_nip'] = 'required';
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
        
        if ($request->pengujitiga_nip) {
            if ($penjadwalan_sempro->pengujitiga_nip != $request->pengujitiga_nip) {
                if ($request->pengujitiga_nip == 1) {
                    $edit->pengujitiga_nip = null;
                } else {
                    $edit->pengujitiga_nip = $validated['pengujitiga_nip'];
                }
            }
        }
        
        $edit->prodi_id = $validated['prodi_id'];                
        $edit->judul_proposal = $validated['judul_proposal'];
        $edit->tanggal = $validated['tanggal'];
        $edit->waktu = $validated['waktu'];
        $edit->lokasi = $validated['lokasi'];
        $edit->dibuat_oleh = $validated['dibuat_oleh'];
        $edit->update();

        return redirect('/form')->with('message', 'Jadwal Berhasil Diubah!');
    }

    public function destroy($id)
    {   
        $decrypted = Crypt::decryptString($id);
        PenjadwalanSempro::destroy($decrypted);
        return redirect('/form')->with('message', 'Data Berhasil Dihapus!');
    }

    public function ceknilai($id)
    {

        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanSempro::find($id);
        $pembimbing = PenilaianSemproPembimbing::where('penjadwalan_sempro_id', $id)->get();
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
        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanSempro::find($id);
        $cek = PenilaianSemproPembimbing::where('penjadwalan_sempro_id', $id)->where('pembimbing_nip', auth()->user()->nip)->count();

        if ($cek != 0) {
            $penilaianpembimbing = PenilaianSemproPembimbing::where('penjadwalan_sempro_id', $id)->where('pembimbing_nip', auth()->user()->nip)->first();

            $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-sempro').'/'. $penjadwalan->id));
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

            $pdf->loadView('penjadwalansempro.nilai-sempro-pembimbing',compact('penjadwalan','qrcode','penilaianpembimbing', 'pdf'));
        
            return $pdf->stream('STI/TE-6 Form Nilai Pembimbing Seminar Proposal Skripsi.pdf', array("Attachment" => false));

        } else {
            $penilaianpenguji = PenilaianSemproPenguji::where('penjadwalan_sempro_id', $id)->where('penguji_nip', auth()->user()->nip)->first();

            $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-sempro').'/'. $penjadwalan->id));
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

            $pdf->loadView('penjadwalansempro.nilai-sempro-penguji',compact('penjadwalan','qrcode','penilaianpenguji', 'pdf'));
        
            return $pdf->stream('STI/TE-5 Form Nilai Penguji Seminar Proposal Skripsi.pdf', array("Attachment" => false));            
        }
    }

    public function nilaipembimbing($id, $pembimbing)
    {
        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanSempro::find($id);
        $penilaianpembimbing = PenilaianSemproPembimbing::where('penjadwalan_sempro_id', $id)->where('pembimbing_nip', $pembimbing)->first();

        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-sempro').'/'. $penjadwalan->id));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $pdf->loadView('penjadwalansempro.nilai-sempro-pembimbing',compact('penjadwalan','qrcode','penilaianpembimbing', 'pdf'));
        
        return $pdf->stream('STI/TE-6 Form Nilai Pembimbing Seminar Proposal Skripsi.pdf', array("Attachment" => false));
        
    }

    public function nilaipenguji($id, $penguji)
    {
        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanSempro::find($id);
        $penilaianpenguji = PenilaianSemproPenguji::where('penjadwalan_sempro_id', $id)->where('penguji_nip', $penguji)->first();
        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-sempro').'/'. $penjadwalan->id));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $pdf->loadView('penjadwalansempro.nilai-sempro-penguji',compact('penjadwalan','qrcode','penilaianpenguji', 'pdf'));
        
        return $pdf->stream('STI/TE-5 Form Nilai Penguji Seminar Proposal Skripsi.pdf', array("Attachment" => false));        
    }

    public function perbaikan($id)
    {
        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanSempro::find($id);
        $penilaianpenguji = PenilaianSemproPenguji::where('penjadwalan_sempro_id', $id)->where('penguji_nip', auth()->user()->nip)->first();

        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-sempro').'/'. $penjadwalan->id));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $pdf->loadView('penjadwalansempro.perbaikan-sempro',compact('penjadwalan','qrcode','penilaianpenguji', 'pdf'));
        
        return $pdf->stream('STI/TE-9 Lembar Kontrol Perbaikan Proposal Skripsi.pdf', array("Attachment" => false));        
    }

    public function perbaikanpengujisempro($id, $penguji)
    {
        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanSempro::find($id);
        $penilaianpenguji = PenilaianSemproPenguji::where('penjadwalan_sempro_id', $id)->where('penguji_nip', $penguji)->first();

        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-sempro').'/'. $penjadwalan->id));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $pdf->loadView('penjadwalansempro.perbaikan-sempro',compact('penjadwalan','qrcode','penilaianpenguji', 'pdf'));
        
        return $pdf->stream('STI/TE-9 Lembar Kontrol Perbaikan Proposal Skripsi.pdf', array("Attachment" => false)); 
    }

    public function revisiproposal(Request $request, $id)
    {    
        $penjadwalan_sempro = PenjadwalanSempro::find($id);
        $penjadwalan_sempro->revisi_proposal = $request->revisi_proposal;
        $penjadwalan_sempro->update();
        $cari_penguji = PenilaianSemproPenguji::where('penjadwalan_sempro_id', $id)->where('penguji_nip', auth()->user()->nip)->count();
        if ($cari_penguji == 0) {
            return redirect('/penilaian-sempro/create/' . Crypt::encryptString($id))->with('message', 'Judul Berhasil Diubah!');
        } else {

            return redirect('/penilaian-sempro/edit/' . Crypt::encryptString($id))->with('message', 'Judul Berhasil Diubah!');
        }
        
    }

    public function catatansempro(Request $request, $id)
    {    
        
        $penjadwalan_sempro = PenjadwalanSempro::find($id);
        $penjadwalan_sempro->catatan1 = $request->catatan1;
        $penjadwalan_sempro->catatan2 = $request->catatan2;
        $penjadwalan_sempro->catatan3 = $request->catatan3;
        $penjadwalan_sempro->update();
        $cari_penguji = PenilaianSemproPenguji::where('penjadwalan_sempro_id', $id)->where('penguji_nip', auth()->user()->nip)->count();
        if ($cari_penguji == 0) {
            return redirect('/penilaian-sempro/create/' . Crypt::encryptString($id))->with('message', 'Catatan Berhasil ditambah!');
        } else {
            return redirect('/penilaian-sempro/edit/' . Crypt::encryptString($id))->with('message', 'Catatan Berhasil ditambah!');
        }
        
    }

    public function riwayatjudul($id)
    {
        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanSempro::find($id);
        
        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-sempro').'/'. $penjadwalan->id));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $pdf->loadView('penjadwalansempro.riwayat-judul',compact('penjadwalan','qrcode', 'pdf'));
        
        return $pdf->stream('STI/TE-8 Lembar Penggantian Judul.pdf', array("Attachment" => false));         
    }

    public function beritaacarasempro($id)
    {
        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanSempro::find($id);
        $pembimbing = PenilaianSemproPembimbing::where('penjadwalan_sempro_id', $id)->get();
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

            $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-sempro').'/'. $penjadwalan->id));
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

            $pdf->loadView('penjadwalansempro.beritaacara-sempro',compact('penjadwalan','qrcode', 'pdf','pembimbing','pembimbingnilai','nilaipenguji1','nilaipenguji2','nilaipenguji3','nilaipembimbing1'));
        
            return $pdf->stream('STI/TE-7 Berita Acara Seminar Proposal Skripsi.pdf', array("Attachment" => false));

        } else {
            $nilaipembimbing2 = PenilaianSemproPembimbing::where('penjadwalan_sempro_id', $id)->where('pembimbing_nip', $penjadwalan->pembimbingdua_nip)->first();

            $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-sempro').'/'. $penjadwalan->id));
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

            $pdf->loadView('penjadwalansempro.beritaacara-sempro',compact('penjadwalan','qrcode', 'pdf','pembimbing','pembimbingnilai','nilaipenguji1','nilaipenguji2','nilaipenguji3','nilaipembimbing1','nilaipembimbing2'));
        
            return $pdf->stream('STI/TE-7 Berita Acara Seminar Proposal Skripsi.pdf', array("Attachment" => false));            
        }
    }    

}
