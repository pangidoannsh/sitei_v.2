<?php

namespace App\Http\Controllers;

use \PDF;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\Konsentrasi;
use Illuminate\Http\Request;
use App\Models\PendaftaranSkripsi;
use App\Models\PenjadwalanSkripsi;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\PenilaianSkripsiPenguji;
use App\Models\PenilaianSkripsiPembimbing;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
                'mahasiswas' => Mahasiswa::where('prodi_id', 1)->get()->sortBy('nama'),
                'dosens' => Dosen::all()->sortBy('nama'),
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('keterangan', 'Menunggu Jadwal Sidang Skripsi')->where('prodi_id', 1)->get(),                
            ]);
        }        
        if (auth()->user()->role_id == 3) {            
            return view('penjadwalanskripsi.create', [    
                'prodis' => Prodi::all(),
                'mahasiswas' => Mahasiswa::where('prodi_id', 2)->get()->sortBy('nama'),
                'dosens' => Dosen::all()->sortBy('nama'),
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('keterangan', 'Menunggu Jadwal Sidang Skripsi')->where('prodi_id', 2)->get(),                
            ]);
        }        
        if (auth()->user()->role_id == 4) {            
            return view('penjadwalanskripsi.create', [    
                'prodis' => Prodi::all(),
                'mahasiswas' => Mahasiswa::where('prodi_id', 3)->get()->sortBy('nama'),
                'dosens' => Dosen::all()->sortBy('nama'),
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('keterangan', 'Menunggu Jadwal Sidang Skripsi')->where('prodi_id', 3)->get(),                
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
            'judul_skripsi' => 'required',
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
        }
        elseif ($request->pembimbingdua_nip == null && $request->pengujitiga_nip == null) {
            PenjadwalanSkripsi::create([
                'mahasiswa_nim' => $validatedData['mahasiswa_nim'],                
                'pembimbingsatu_nip' => $validatedData['pembimbingsatu_nip'],                
                'pengujisatu_nip' => $validatedData['pengujisatu_nip'],
                'pengujidua_nip' => $validatedData['pengujidua_nip'],                
                'prodi_id' => $validatedData['prodi_id'],                
                'judul_skripsi' => $validatedData['judul_skripsi'],
                'tanggal' => $validatedData['tanggal'],
                'waktu' => $validatedData['waktu'],
                'lokasi' => $validatedData['lokasi'],
                'dibuat_oleh' => auth()->user()->username,
            ]);
        }        
        elseif ($request->pembimbingdua_nip == null) {
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
        elseif ($request->pengujitiga_nip == null) {
            PenjadwalanSkripsi::create([
                'mahasiswa_nim' => $validatedData['mahasiswa_nim'],                
                'pembimbingsatu_nip' => $validatedData['pembimbingsatu_nip'],                
                'pembimbingdua_nip' => $validatedData['pembimbingdua_nip'],
                'pengujisatu_nip' => $validatedData['pengujisatu_nip'],
                'pengujidua_nip' => $validatedData['pengujidua_nip'],                
                'prodi_id' => $validatedData['prodi_id'],                
                'judul_skripsi' => $validatedData['judul_skripsi'],
                'tanggal' => $validatedData['tanggal'],
                'waktu' => $validatedData['waktu'],
                'lokasi' => $validatedData['lokasi'],
                'dibuat_oleh' => auth()->user()->username,
            ]);
        }

        return redirect('/form')->with('message', 'Jadwal Berhasil Ditambahkan!');
    }

    public function edit($id)
    {
        $decrypted = Crypt::decryptString($id);
        $skripsi = PenjadwalanSkripsi::findOrFail($decrypted);

        return view('penjadwalanskripsi.edit', [
            'skripsi' => $skripsi,
            'prodis' => Prodi::all(),
            'mahasiswas' => Mahasiswa::all()->sortBy('nama'),
            'dosens' => Dosen::all()->sortBy('nama'),
        ]);
    }

    public function update(Request $request, PenjadwalanSkripsi $penjadwalan_skripsi)
    {
        $rules = [
            'mahasiswa_nim' => 'required',
            'pembimbingsatu_nip' => 'required',
            'pengujisatu_nip' => 'required',
            'pengujidua_nip' => 'required',
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

        if ($request->pengujitiga_nip) {
            if ($penjadwalan_skripsi->pengujitiga_nip != $request->pengujitiga_nip) {
                $rules['pengujitiga_nip'] = 'required';
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
        if ($request->pengujitiga_nip) {
            if ($penjadwalan_skripsi->pengujitiga_nip != $request->pengujitiga_nip) {
                if ($request->pengujitiga_nip == 1) {
                    $edit->pengujitiga_nip = null;
                } else {
                    $edit->pengujitiga_nip = $validated['pengujitiga_nip'];
                }
            }
        }
        $edit->prodi_id = $validated['prodi_id'];                
        $edit->judul_skripsi = $validated['judul_skripsi'];
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
        PenjadwalanSkripsi::destroy($decrypted);
        return redirect('/form')->with('message', 'Data Berhasil Dihapus!');
    }

    public function ceknilai($id)
    {

        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanSkripsi::find($id);
        $pembimbing = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->get();

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

    public function draft($id)
    {

        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanSkripsi::find($id);
        $pembimbing = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->get();

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
            return view('penjadwalanskripsi.draft-ba', [
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

            return view('penjadwalanskripsi.draft-ba', [
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
        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanSkripsi::find($id);
        $cek = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->where('pembimbing_nip', auth()->user()->nip)->count();

        if ($cek != 0) {
            $penilaianpembimbing = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->where('pembimbing_nip', auth()->user()->nip)->first();

            $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-skripsi').'/'. $penjadwalan->id));
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

            $pdf->loadView('penjadwalanskripsi.nilai-skripsi-pembimbing',compact('penjadwalan','qrcode', 'pdf', 'penilaianpembimbing'));
        
            return $pdf->stream('STI/TE-13 Form Nilai Pembimbing Sidang Skripsi.pdf', array("Attachment" => false));
            
        } else {
            $penilaianpenguji = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', auth()->user()->nip)->first();            

            $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-skripsi').'/'. $penjadwalan->id));
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

            $pdf->loadView('penjadwalanskripsi.nilai-skripsi-penguji',compact('penjadwalan','qrcode', 'pdf', 'penilaianpenguji'));
        
            return $pdf->stream('STI/TE-14 Form Nilai Penguji Sidang Skripsi.pdf', array("Attachment" => false));            
        }
    }

    public function nilaipembimbing($id, $pembimbing)
    {
        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanSkripsi::find($id);
        $penilaianpembimbing = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->where('pembimbing_nip', $pembimbing)->first();

        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-skripsi').'/'. $penjadwalan->id));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $pdf->loadView('penjadwalanskripsi.nilai-skripsi-pembimbing',compact('penjadwalan','qrcode', 'pdf', 'penilaianpembimbing'));
        
        return $pdf->stream('STI/TE-13 Form Nilai Pembimbing Sidang Skripsi.pdf', array("Attachment" => false)); 
    
    }

    public function nilaipenguji($id, $penguji)
    {
        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanSkripsi::find($id);
        $penilaianpenguji = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', $penguji)->first();

        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-skripsi').'/'. $penjadwalan->id));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $pdf->loadView('penjadwalanskripsi.nilai-skripsi-penguji',compact('penjadwalan','qrcode', 'pdf', 'penilaianpenguji'));
        
        return $pdf->stream('STI/TE-14 Form Nilai Penguji Sidang Skripsi.pdf', array("Attachment" => false)); 
    }

    public function perbaikan($id)
    {   
        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanSkripsi::find($id);
        $penilaianpenguji = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', auth()->user()->nip)->first();

        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-skripsi').'/'. $penjadwalan->id));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $pdf->loadView('penjadwalanskripsi.perbaikan-skripsi',compact('penjadwalan','qrcode', 'pdf', 'penilaianpenguji'));
        
        return $pdf->stream('STI/TE-16 Lembar Kontrol Perbaikan Skripsi.pdf', array("Attachment" => false));  
    }

    public function perbaikanpengujiskripsi($id, $penguji)
    {
        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanSkripsi::find($id);
        $penilaianpenguji = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', $penguji)->first();

        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-skripsi').'/'. $penjadwalan->id));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $pdf->loadView('penjadwalanskripsi.perbaikan-skripsi',compact('penjadwalan','qrcode', 'pdf', 'penilaianpenguji'));
        
        return $pdf->stream('STI/TE-16 Lembar Kontrol Perbaikan Skripsi.pdf', array("Attachment" => false));
    }

    public function revisiskripsi(Request $request, $id)
    {   
        $penjadwalan_skripsi = PenjadwalanSkripsi::find($id);
        $penjadwalan_skripsi->revisi_skripsi = $request->revisi_skripsi;
        $penjadwalan_skripsi->update();
        $cari_penguji = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', auth()->user()->nip)->count();
        if ($cari_penguji == 0) {
            return redirect('/penilaian-skripsi/create/' . Crypt::encryptString($id))->with('message', 'Judul Berhasil Diubah!');
        } else {

            return redirect('/penilaian-skripsi/edit/' . Crypt::encryptString($id))->with('message', 'Judul Berhasil Diubah!');
        }
        
    }

    public function catatanskripsi(Request $request, $id)
    {    
        $penjadwalan_skripsi = PenjadwalanSkripsi::find($id);
        $penjadwalan_skripsi->catatan = $request->catatan;        
        $penjadwalan_skripsi->update();
        $cari_penguji = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', auth()->user()->nip)->count();
        if ($cari_penguji == 0) {
            return redirect('/penilaian-skripsi/create/' . Crypt::encryptString($id))->with('message', 'Catatan Berhasil ditambah!');
        } else {
            return redirect('/penilaian-skripsi/edit/' . Crypt::encryptString($id))->with('message', 'Catatan Berhasil ditambah!');
        }
        
    }

    public function riwayatjudul($id)
    {
        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanSkripsi::find($id);        

        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-skripsi').'/'. $penjadwalan->id));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $pdf->loadView('penjadwalanskripsi.riwayat-judul',compact('penjadwalan','qrcode', 'pdf'));
        
        return $pdf->stream('STI/TE-8 Lembar Penggantian Judul.pdf', array("Attachment" => false));
    }

    public function beritaacaraskripsi($id)
    {

        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanSkripsi::find($id);
        $pembimbing = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->get();

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

            $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-skripsi').'/'. $penjadwalan->id));
            $qrcodee = base64_encode(QrCode::format('svg')->size(20)->errorCorrection('H')->generate(URL::to('/detail-skripsi').'/'. $penjadwalan->id));
            $qrcodeee = base64_encode(QrCode::format('svg')->size(50)->errorCorrection('H')->generate(URL::to('/detail-skripsi').'/'. $penjadwalan->id));
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

            $pdf->loadView('penjadwalanskripsi.beritaacara-skripsi',compact('penjadwalan','qrcode', 'qrcodee', 'qrcodeee', 'pdf','pembimbing','pembimbingnilai','nilaipenguji1','nilaipenguji2','nilaipenguji3','nilaipembimbing1'));
        
            return $pdf->stream('STI/TE-15 Berita Acara Sidang Skripsi.pdf', array("Attachment" => false));
            
        } else {
            $nilaipembimbing2 = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->where('pembimbing_nip', $penjadwalan->pembimbingdua_nip)->first();

            $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-skripsi').'/'. $penjadwalan->id));
            $qrcodee = base64_encode(QrCode::format('svg')->size(20)->errorCorrection('H')->generate(URL::to('/detail-skripsi').'/'. $penjadwalan->id));
            $qrcodeee = base64_encode(QrCode::format('svg')->size(50)->errorCorrection('H')->generate(URL::to('/detail-skripsi').'/'. $penjadwalan->id));
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

            $pdf->loadView('penjadwalanskripsi.beritaacara-skripsi',compact('penjadwalan','qrcode', 'qrcodee', 'qrcodeee', 'pdf','pembimbing','pembimbingnilai','nilaipenguji1','nilaipenguji2','nilaipenguji3','nilaipembimbing1','nilaipembimbing2'));
        
            return $pdf->stream('STI/TE-15 Berita Acara Sidang Skripsi.pdf', array("Attachment" => false));    
        }
    }
}
