<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\Konsentrasi;
use App\Models\PenilaianKP;
use Illuminate\Http\Request;
use App\Models\PenjadwalanKP;
use App\Models\PendaftaranKP;
use \PDF;
use App\Models\PenilaianKPPenguji;
use Illuminate\Support\Facades\URL;
use App\Models\PenilaianKPPembimbing;
use Illuminate\Support\Facades\Crypt;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
                'mahasiswas' => Mahasiswa::where('prodi_id', 1)->get()->sortBy('nama'),
                'pendaftaran_kp' => PendaftaranKP::all(),
                'dosens' => Dosen::all()->sortBy('nama'),
                // 'pendaftaran_kp' => PendaftaranKP::where('keterangan', 'Menunggu Jadwal Seminar KP')->where('prodi_id', 1)->get(),                   
            ]);
        }        
        if (auth()->user()->role_id == 3) {            
            return view('penjadwalankp.create', [    
                'prodis' => Prodi::all(),
                'mahasiswas' => Mahasiswa::where('prodi_id', 2)->get()->sortBy('nama'),
                'dosens' => Dosen::all()->sortBy('nama'),
                'pendaftaran_kp' => PendaftaranKP::all(),
                // 'pendaftaran_kp' => PendaftaranKP::where('keterangan', 'Menunggu Jadwal Seminar KP')->where('prodi_id', 2)->get(),                   
            ]);
        }        
        if (auth()->user()->role_id == 4) {    
            
            return view('penjadwalankp.create', [    
                'prodis' => Prodi::all(),
                'mahasiswas' => Mahasiswa::where('prodi_id', 3)->get()->sortBy('nama'),
                'dosens' => Dosen::all()->sortBy('nama'), 
                'pendaftaran_kp' => PendaftaranKP::all(),     
                // 'pendaftaran_kp' => PendaftaranKP::where('keterangan', 'Menunggu Jadwal Seminar KP')->where('prodi_id', 3)->get(),          
            ]);
        }        
        // if (auth()->user()->nim > 0) {            
        //     return view('penjadwalankp.create', [    
        //         'prodis' => Prodi::all(),
        //         'mahasiswas' => Mahasiswa::where('prodi_id', 3)->get()->sortBy('nama'),
        //         'dosens' => Dosen::all()->sortBy('nama'),     
                       
        //     ]);
        // }        
    }

    public function store(Request $request , PendaftaranKP $id)
    {
        $request->validate([
            // 'pendaftarankp_id' => 'required',
            'mahasiswa_nim' => 'required',
            'pembimbing_nip' => 'required',
            'penguji_nip' => 'required',
            'prodi_id' => 'required',                                                             
            'judul_kp' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            // 'status_kp' => 'required',
        ]);
        
    //    $pendaftarankp_id = PendaftaranKP::select('id')->where('mahasiswa_nim', $request->pendaftarankp_id)->get();

        PenjadwalanKP::create([
            // 'pendaftarankp_id' =>$pendaftarankp_id, 
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
        // PendaftaranKP::update([      
        //     'status_kp' => $request->status_kp,
        // ]);
      
        // $kp = PendaftaranKP::find($id);
        // // $kp->jenis_usulan = 'Usulan Seminar Kerja Praktek';
        // // $kp->tgl_created_semkp = Carbon::now()->isoFormat('D MMMM Y');
        // $kp->status_kp = 'SEMINAR KP DIJADWALKAN';
        // // $kp->keterangan = 'Seminar Kerja Praktek dijadwal';
        // $kp->update();

        Alert::success('Berhasil!', 'Data berhasil ditambahkan')->showConfirmButton('Ok', '#28a745');
        return redirect('/persetujuan/admin/index');
    }

    public function edit($id)
    {
        $decrypted = Crypt::decryptString($id);
        $kps = PenjadwalanKP::findOrFail($decrypted);

        return view('penjadwalankp.edit', [
            'kp' => $kps,
            'prodis' => Prodi::all(),
            'mahasiswas' => Mahasiswa::all()->sortBy('nama'),
            'dosens' => Dosen::all()->sortBy('nama'),
            // 'pendaftaran_kp' =>  PendaftaranKP::where('id', $id)->where('dosen_pembimbing_nip', Auth::user()->nip)->get(),
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

        return redirect('/form')->with('message', 'Jadwal Berhasil Diubah!');
    }

    public function destroy($id)
    {   
        $decrypted = Crypt::decryptString($id);
        PenjadwalanKP::destroy($decrypted);
        return redirect('/form')->with('message', 'Data Berhasil Dihapus!');
    }

    public function approve($id)
    {
        $jadwal = PenjadwalanKP::find($id);
        $jadwal->status_seminar = 1;
        $jadwal->update();

        return redirect('/penilaian')->with('message', 'Seminar Telah Selesai!');
    }
    //APPROVAL SELESAI SEMINAR
    // public function approveselesaiseminarkp($id)
    // {
    //     $kp = PendaftaranKP::find($id);
    //     $kp->status_kp = 'SEMINAR KP SELESAI';
    //     $kp->keterangan = 'Seminar Kerja Praktek Selesai';
    //     $kp->tgl_disetujui_kpti_10 = Carbon::now();
    //     $kp->update();

    //     return redirect('/penilaian')->with('message', 'Seminar Telah Selesai!');
    // }



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

    public function ceknilaikp($id)
    {
        $decrypted = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanKP::findOrFail($decrypted);        
        $nilaipenguji = PenilaianKPPenguji::where('penjadwalan_kp_id', $decrypted)->where('penguji_nip', $penjadwalan->penguji_nip)->first();

        $nilaipembimbing = PenilaianKPPembimbing::where('penjadwalan_kp_id', $decrypted)->where('pembimbing_nip', $penjadwalan->pembimbing_nip)->first();

        return view('penjadwalankp.cek-nilai-kp', [
            'penjadwalan' => $penjadwalan,
            'nilaipembimbing' => $nilaipembimbing,
            'nilaipenguji' => $nilaipenguji,
        ]);
    }

    public function nilaikp($id)
    {
        $decrypted = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanKP::findOrFail($decrypted);        
        $nilaipenguji = PenilaianKPPenguji::where('penjadwalan_kp_id', $decrypted)->where('penguji_nip', $penjadwalan->penguji_nip)->first();

        $nilaipembimbing = PenilaianKPPembimbing::where('penjadwalan_kp_id', $decrypted)->where('pembimbing_nip', $penjadwalan->pembimbing_nip)->first();

        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-kp').'/'. $penjadwalan->id));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $pdf->loadView('penjadwalankp.nilai-kp',compact('penjadwalan','qrcode','nilaipenguji','nilaipembimbing', 'pdf'));
        
        return $pdf->stream('KPTI/TE-7 Form Nilai Penguji Seminar KP.pdf', array("Attachment" => false));
        
    }

    public function beritaacarakp($id)
    {
        $decrypted = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanKP::findOrFail($decrypted);    

        $nilaipenguji = PenilaianKPPenguji::where('penjadwalan_kp_id', $decrypted)->where('penguji_nip', $penjadwalan->penguji_nip)->first();

        $nilaipembimbing = PenilaianKPPembimbing::where('penjadwalan_kp_id', $decrypted)->where('pembimbing_nip', $penjadwalan->pembimbing_nip)->first();

        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-kp').'/'. $penjadwalan->id));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $pdf->loadView('penjadwalankp.beritaacara-kp',compact('penjadwalan','qrcode','nilaipenguji','nilaipembimbing', 'pdf'));
        
        return $pdf->stream('KPTI/TE-8 Berita Acara Seminar Kerja Praktek.pdf', array("Attachment" => false));
    }

    public function perbaikan($id)
    {
        $decrypted = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanKP::findOrFail($decrypted);         
        $penilaianpenguji = PenilaianKPPenguji::where('penjadwalan_kp_id', $decrypted)->where('penguji_nip', auth()->user()->nip)->first();

        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-kp').'/'. $penjadwalan->id));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $pdf->loadView('penjadwalankp.perbaikan-kp',compact('penjadwalan','qrcode','penilaianpenguji', 'pdf'));
        
        return $pdf->stream('KPTI/TE-9 Lembar Perbaikan Seminar Kerja Praktek.pdf', array("Attachment" => false)); 
    }

    public function perbaikanpengujikp($id, $penguji)
    {
        $decrypted = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanKP::findOrFail($decrypted);        
        $penilaianpenguji = PenilaianKPPenguji::where('penjadwalan_kp_id', $decrypted)->where('penguji_nip', $penguji)->first();

        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-kp').'/'. $penjadwalan->id));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $pdf->loadView('penjadwalankp.perbaikan-kp',compact('penjadwalan','qrcode','penilaianpenguji', 'pdf'));
        
        return $pdf->stream('KPTI/TE-9 Lembar Perbaikan Seminar Kerja Praktek.pdf', array("Attachment" => false));    
    }
}
