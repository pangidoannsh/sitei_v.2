<?php

namespace App\Http\Controllers;

use \PDF;
use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\JamKam;
use App\Models\JamSel;
use App\Models\Ruangan;
use App\Models\Mahasiswa;
use App\Models\Konsentrasi;
use App\Models\BatalSeminar;
use Illuminate\Http\Request;
use App\Models\PenjadwalanKP;
use App\Models\PublikasiJurnal;
use App\Models\PenjadwalanSempro;
use App\Models\PendaftaranSkripsi;
use App\Models\PenjadwalanSkripsi;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\PenilaianSkripsiPenguji;
use RealRashid\SweetAlert\Facades\Alert;
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
                // 'ruangans' => Ruangan::all()->sortBy('nama_ruangan'),
                // 'jamsels' => JamSel::all()->sortBy('id'),
                // 'jamkams' => JamKam::all()->sortBy('id'),                      
            ]);
        }        
        if (auth()->user()->role_id == 3) {            
            return view('penjadwalanskripsi.create', [    
                'prodis' => Prodi::all(),
                'mahasiswas' => Mahasiswa::where('prodi_id', 2)->get()->sortBy('nama'),
                'dosens' => Dosen::all()->sortBy('nama'),
                // 'ruangans' => Ruangan::all()->sortBy('nama_ruangan'),
                // 'jamsels' => JamSel::all()->sortBy('id'),
                // 'jamkams' => JamKam::all()->sortBy('id'),                      
            ]);
        }        
        if (auth()->user()->role_id == 4) {            
            return view('penjadwalanskripsi.create', [    
                'prodis' => Prodi::all(),
                'mahasiswas' => Mahasiswa::where('prodi_id', 3)->get()->sortBy('nama'),
                'dosens' => Dosen::all()->sortBy('nama'),
                // 'ruangans' => Ruangan::all()->sortBy('nama_ruangan'),
                // 'jamsels' => JamSel::all()->sortBy('id'),
                // 'jamkams' => JamKam::all()->sortBy('id'),               
            ]);
        }        
    }

    public function store(Request $request)
    {
        $request->validate(
            [
            'mahasiswa_nim' => 'required',
            'pembimbingsatu_nip' => 'required',           
            'prodi_id' => 'required',                            
            'judul_skripsi' => 'required',
            'pengujisatu_nip' => 'required',
            // 'indeksasi_jurnal' => 'required',
            // 'judul_jurnal' => 'required',
            // 'status_publikasi_jurnal' => 'required',
            ]
            );

        PenjadwalanSkripsi::create([
            'mahasiswa_nim' => $request['mahasiswa_nim'],
            'pembimbingsatu_nip' => $request['pembimbingsatu_nip'],
            'pembimbingdua_nip' => $request['pembimbingdua_nip'],
            'pengujisatu_nip' => $request['pengujisatu_nip'],
            'pengujidua_nip' => $request['pengujidua_nip'],
            'pengujitiga_nip' => $request['pengujitiga_nip'],
            'prodi_id' => $request['prodi_id'],                
            'judul_skripsi' => $request['judul_skripsi'],
            'indeksasi_jurnal' => $request['indeksasi_jurnal'],
            'judul_jurnal' => $request['judul_jurnal'],
            'status_publikasi_jurnal' => $request['status_publikasi_jurnal'],
            'tanggal' => $request['tanggal'],
            'waktu' => $request['waktu'],
            'lokasi' => $request['lokasi'],
            'dibuat_oleh' => auth()->user()->username,
        ]);

        return redirect('/form')->with('message', 'Jadwal Berhasil Ditambahkan!');
    }

    public function edit($id)
    {
        $decrypted = Crypt::decryptString($id);
        $skripsi = PenjadwalanSkripsi::findOrFail($decrypted);
        return view('penjadwalanskripsi.edit', [
            'skripsi' => $skripsi,
            'skripsip' => PendaftaranSkripsi::where('mahasiswa_nim', $skripsi->mahasiswa_nim )->latest('created_at')->first(),
            'prodis' => Prodi::all(),
            'mahasiswas' => Mahasiswa::all()->sortBy('nama'),
            'dosens' => Dosen::all()->sortBy('nama'),
            // 'ruangans' => Ruangan::all()->sortBy('nama_ruangan'),
            // 'jamsels' => JamSel::all()->sortBy('id'),
            // 'jamkams' => JamKam::all()->sortBy('id'),
        ]);
    }

    public function update(Request $request, PenjadwalanSkripsi $penjadwalan_skripsi)
    {
        $rules = [
            'mahasiswa_nim' => 'required',
            'pembimbingsatu_nip' => 'nullable',   
            'pengujisatu_nip' => 'required',         
            'pengujidua_nip' => 'required',         
            'pengujitiga_nip' => 'nullable',  
            'prodi_id' => 'required',                           
            'judul_skripsi' => 'required',
        ];        

        if ($request->pembimbingdua_nip) {
            if ($penjadwalan_skripsi->pembimbingdua_nip != $request->pembimbingdua_nip) {
                $rules['pembimbingdua_nip'] = 'nullable';
            }
        }

        if ($request->pengujitiga_nip) {
            if ($penjadwalan_skripsi->pengujitiga_nip != $request->pengujitiga_nip) {
                $rules['pengujitiga_nip'] = 'nullable';
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
        $edit->pengujitiga_nip = $request['pengujitiga_nip'];
        
        if($request->waktu_selasa != null) {
            $request->waktu = $request->waktu_selasa;
        }
        if($request->waktu_kamis != null) {
            $request->waktu = $request->waktu_kamis;
        }
        if(isset($request->lokasi)) {
            $edit->lokasi = $request->lokasi;
        }
        if(isset($request->tanggal)) {
            $edit->tanggal = $request->tanggal;
        }
        $edit->waktu = $request->waktu;                
        $edit->prodi_id = $validated['prodi_id'];                
        $edit->judul_skripsi = $validated['judul_skripsi'];
        $edit->dibuat_oleh = $validated['dibuat_oleh'];
        $edit->update();

        $pendaftaran_skripsi = PendaftaranSkripsi::where('mahasiswa_nim', $edit->mahasiswa_nim )->latest('created_at')->first();
        // $pendaftaran_skripsi = PendaftaranSkripsi::whereNotNull('mahasiswa_nim',  PenjadwalanSempro::find($mahasiswa_nim) )->latest('created_at')->first();

        $pendaftaran_skripsi->status_skripsi = 'SIDANG DIJADWALKAN';
        $pendaftaran_skripsi->keterangan = 'Sidang Skripsi Dijadwalkan';
        $pendaftaran_skripsi->tgl_disetujui_jadwal_sidang = Carbon::now();
        $pendaftaran_skripsi->update();
        
        
        // $jurnal = PublikasiJurnal::where('mahasiswa_nim', $edit->mahasiswa_nim)->latest('created_at')->first();
        // $jurnal->penjadwalan_skripsi_id = $edit->id;
        // $jurnal->update();

        // return redirect('/form')->with('message', 'Jadwal Berhasil Diubah!');
        Alert::success('Berhasil!', 'Jadwal Berhasil Diubah!')->showConfirmButton('Ok', '#28a745');
        return back();
    }
    
    public function edit_koordinator($id)
    {
        $decrypted = Crypt::decryptString($id);
        $skripsi = PenjadwalanSkripsi::findOrFail($decrypted);
        return view('penjadwalanskripsi.edit', [
            'skripsi' => $skripsi,
            'skripsip' => PendaftaranSkripsi::where('mahasiswa_nim', $skripsi->mahasiswa_nim )->latest('created_at')->first(),
            'prodis' => Prodi::all(),
            'mahasiswas' => Mahasiswa::all()->sortBy('nama'),
            'dosens' => Dosen::all()->sortBy('nama'),
            // 'ruangans' => Ruangan::all()->sortBy('nama_ruangan'),
            // 'jamsels' => JamSel::all()->sortBy('id'),
            // 'jamkams' => JamKam::all()->sortBy('id'),
        ]);
    }

    public function update_koordinator(Request $request, PenjadwalanSkripsi $penjadwalan_skripsi)
    {
        $rules = [
            'mahasiswa_nim' => 'required',
            'pembimbingsatu_nip' => 'nullable',   
            'pengujisatu_nip' => 'required',         
            'pengujidua_nip' => 'required',         
            'pengujitiga_nip' => 'nullable',  
            'prodi_id' => 'required',                           
            'judul_skripsi' => 'required',
        ];        

        if ($request->pembimbingdua_nip) {
            if ($penjadwalan_skripsi->pembimbingdua_nip != $request->pembimbingdua_nip) {
                $rules['pembimbingdua_nip'] = 'nullable';
            }
        }

        if ($request->pengujitiga_nip) {
            if ($penjadwalan_skripsi->pengujitiga_nip != $request->pengujitiga_nip) {
                $rules['pengujitiga_nip'] = 'nullable';
            }
        }

        $validated = $request->validate($rules);
        $validated['dibuat_oleh'] = auth()->user()->nama;

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
        
        if($request->waktu_selasa != null) {
            $request->waktu = $request->waktu_selasa;
        }
        if($request->waktu_kamis != null) {
            $request->waktu = $request->waktu_kamis;
        }
        if(isset($request->lokasi)) {
            $edit->lokasi = $request->lokasi;
        }
        if(isset($request->tanggal)) {
            $edit->tanggal = $request->tanggal;
        }
        $edit->waktu = $request->waktu;                
        $edit->prodi_id = $validated['prodi_id'];                
        $edit->judul_skripsi = $validated['judul_skripsi'];
        $edit->dibuat_oleh = $validated['dibuat_oleh'];
        $edit->update();

        $pendaftaran_skripsi = PendaftaranSkripsi::where('mahasiswa_nim', $edit->mahasiswa_nim )->latest('created_at')->first();
        // $pendaftaran_skripsi = PendaftaranSkripsi::whereNotNull('mahasiswa_nim',  PenjadwalanSempro::find($mahasiswa_nim) )->latest('created_at')->first();

        $pendaftaran_skripsi->status_skripsi = 'SIDANG DIJADWALKAN';
        $pendaftaran_skripsi->keterangan = 'Sidang Skripsi Dijadwalkan';
        $pendaftaran_skripsi->tgl_disetujui_jadwal_sidang = Carbon::now();
        $pendaftaran_skripsi->update();

        $jurnal = PublikasiJurnal::where('mahasiswa_nim', $edit->mahasiswa_nim)->latest('created_at')->first();
        if ($jurnal !== null) {
        $jurnal->penjadwalan_skripsi_id = $edit->id;
        $jurnal->update();
        }



        // return redirect('/form')->with('message', 'Jadwal Berhasil Diubah!');
        Alert::success('Berhasil!', 'Jadwal Berhasil Diubah!')->showConfirmButton('Ok', '#28a745');
        return back();
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
        $nilaipembimbing2 = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->where('pembimbing_nip', $penjadwalan->pembimbingdua_nip)->first();

        $jurnal = PublikasiJurnal::where('mahasiswa_nim', $penjadwalan->mahasiswa_nim )->latest('created_at')->first();

        if ($penjadwalan->pembimbingdua_nip == null) {
            return view('penjadwalanskripsi.cek-nilai', [
                'pembimbing' => $pembimbing,
                'pembimbingnilai' => $pembimbingnilai,
                'penjadwalan' => $penjadwalan,
                'nilaipenguji1' => $nilaipenguji1,
                'nilaipenguji2' => $nilaipenguji2,
                'nilaipenguji3' => $nilaipenguji3,
                'nilaipembimbing1' => $nilaipembimbing1,
                'nilaipembimbing2' => $nilaipembimbing2,
                'jurnal' => $jurnal,
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
                'jurnal' => $jurnal,
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

    public function undur_sidang_admin(Request $request, $id)
    {
        $jadwal = PenjadwalanSkripsi::find($id);
        

    $pendaftaran_skripsi = PendaftaranSkripsi::where('mahasiswa_nim', $jadwal->mahasiswa_nim )->latest('created_at')->first();

    $pendaftaran_skripsi->status_skripsi = 'DAFTAR SIDANG DISETUJUI';
    $pendaftaran_skripsi->keterangan = 'Jadwal Sidang Dibatalkan';
    $pendaftaran_skripsi->save();

        $request->validate([                                           
            'alasan' => 'required',
        ]);

        $batal_seminar = new BatalSeminar();
        $batal_seminar->penjadwalan_skripsi_id = $jadwal->id;
        $batal_seminar->mahasiswa_nim = $jadwal->mahasiswa_nim;
        $batal_seminar->prodi_id = $jadwal->prodi_id;
        $batal_seminar->pembimbingsatu_nip = $pendaftaran_skripsi->pembimbing_1_nip;
        $batal_seminar->pembimbingdua_nip = $pendaftaran_skripsi->pembimbing_2_nip ?? null;
        $batal_seminar->pengujisatu_nip = $jadwal->pengujisatu_nip;
        $batal_seminar->pengujidua_nip = $jadwal->pengujidua_nip ?? null;
        $batal_seminar->pengujitiga_nip = $jadwal->pengujitiga_nip ?? null;
        $batal_seminar->judul_skripsi = $pendaftaran_skripsi->judul_skripsi;
        $batal_seminar->jenis_seminar = $jadwal->jenis_seminar;
        $batal_seminar->tanggal = $jadwal->tanggal;
        $batal_seminar->waktu = $jadwal->waktu;
        $batal_seminar->lokasi = $jadwal->lokasi;
        $batal_seminar->alasan = $request->alasan;
        $batal_seminar->dibuat_oleh = auth()->user()->username;
        $batal_seminar->save();

        $jadwal->tanggal = null;
        $jadwal->waktu = null;
        $jadwal->lokasi = null;
        $jadwal->update();

        // return redirect('/persetujuan-koordinator')->with('message', 'Berita Acara Disetujui!');
        return back()->with('message', 'Seminar berhasil dibatalkan!');
    }
    
    public function undur_sidang_koordinator(Request $request, $id)
    {
        $jadwal = PenjadwalanSkripsi::find($id);
        

    $pendaftaran_skripsi = PendaftaranSkripsi::where('mahasiswa_nim', $jadwal->mahasiswa_nim )->latest('created_at')->first();

    $pendaftaran_skripsi->status_skripsi = 'DAFTAR SIDANG DISETUJUI';
    $pendaftaran_skripsi->keterangan = 'Jadwal Sidang Dibatalkan';
    $pendaftaran_skripsi->save();

        $request->validate([                                           
            'alasan' => 'required',
        ]);

        $batal_seminar = new BatalSeminar();
        $batal_seminar->penjadwalan_skripsi_id = $jadwal->id;
        $batal_seminar->mahasiswa_nim = $jadwal->mahasiswa_nim;
        $batal_seminar->prodi_id = $jadwal->prodi_id;
        $batal_seminar->pembimbingsatu_nip = $pendaftaran_skripsi->pembimbing_1_nip;
        $batal_seminar->pembimbingdua_nip = $pendaftaran_skripsi->pembimbing_2_nip ?? null;
        $batal_seminar->pengujisatu_nip = $jadwal->pengujisatu_nip;
        $batal_seminar->pengujidua_nip = $jadwal->pengujidua_nip ?? null;
        $batal_seminar->pengujitiga_nip = $jadwal->pengujitiga_nip ?? null;
        $batal_seminar->judul_skripsi = $pendaftaran_skripsi->judul_skripsi;
        $batal_seminar->jenis_seminar = $jadwal->jenis_seminar;
        $batal_seminar->tanggal = $jadwal->tanggal;
        $batal_seminar->waktu = $jadwal->waktu;
        $batal_seminar->lokasi = $jadwal->lokasi;
        $batal_seminar->alasan = $request->alasan;
        $batal_seminar->dibuat_oleh = auth()->user()->nama;
        $batal_seminar->save();

        $jadwal->tanggal = null;
        $jadwal->waktu = null;
        $jadwal->lokasi = null;
        $jadwal->update();

        return back()->with('message', 'Seminar berhasil dibatalkan!');
    }

    public function approve($id)
    {
        $jadwal = PenjadwalanSkripsi::find($id);
        $jurnal = PublikasiJurnal::where('mahasiswa_nim', $jadwal->mahasiswa_nim)->latest('created_at')->first();
        $jadwal->status_seminar = 1;
        if($jurnal != null && $jurnal->nilai == null){
            Alert::error('Gagal', 'Silahkan isi nilai jurnal terlebih dahulu!')->showConfirmButton('Ok', '#dc3545');
            return  back();
        }else {
        $jadwal->update();
        }

        Alert::success('Berhasil!', 'Seminar Telah Selesai')->showConfirmButton('Ok', '#28a745');
        return back();
    }
    
    public function tolak($id)
    {

        $jadwal = PenjadwalanSkripsi::find($id);
        $jurnal = PublikasiJurnal::where('mahasiswa_nim', $jadwal->mahasiswa_nim)->latest('created_at')->first();
        $jadwal->status_seminar = 3;
        if ($jadwal->catatan == null) {
            Alert::error('Gagal', 'Silahkan isi catatan/alasan terlebih dahulu!')->showConfirmButton('Ok', '#dc3545');
            return  back();
        }else if($jurnal != null && $jurnal->nilai == null){
            Alert::error('Gagal', 'Silahkan isi nilai jurnal terlebih dahulu!')->showConfirmButton('Ok', '#dc3545');
            return  back();
        }else {
            $jadwal->update();
        }
        

        $pendaftaran_skripsi = PendaftaranSkripsi::where('mahasiswa_nim', $jadwal->mahasiswa_nim )->latest('created_at')->first();

        $pendaftaran_skripsi->status_skripsi = 'DAFTAR SIDANG ULANG';
        $pendaftaran_skripsi->keterangan = 'Belum Lulus Seminar Sidang Skripsi';
        $pendaftaran_skripsi->tgl_semproselesai = Carbon::now();
        $pendaftaran_skripsi->alasan = 'Anda belum lulus Seminar Sidang Skripsi';
        $pendaftaran_skripsi->save();

        Alert::success('Berhasil', 'Seminar telah Selesai')->showConfirmButton('Ok', '#dc3545');
        return back();
    }

    public function approve_koordinator($id)
    {
        $jadwal = PenjadwalanSkripsi::find($id);        
        $jadwal->status_seminar = 2;
        $jadwal->update();

        // return redirect('/riwayat-koordinator')->with('message', 'Berita Acara Disetujui!');
        Alert::success('Berhasil!', 'Seminar Telah Selesai')->showConfirmButton('Ok', '#28a745');
    return back();
    }

    public function tolak_koordinator($id)
    {
        $jadwal = PenjadwalanSkripsi::find($id);        
        $jadwal->status_seminar = 0;
        $jadwal->update();

        // return redirect('/riwayat-koordinator')->with('message', 'Berita Acara Ditolak!');
        Alert::error('Berhasil', 'Berita acara berhasil ditolak')->showConfirmButton('Ok', '#dc3545');
    return back();
    }

    public function approve_kaprodi($id)
    {
        $jadwal = PenjadwalanSkripsi::find($id);        
        $jadwal->status_seminar = 3;
        $jadwal->update();

         $pendaftaran_skripsi = PendaftaranSkripsi::where('mahasiswa_nim', $jadwal->mahasiswa_nim )->latest('created_at')->first();

        $pendaftaran_skripsi->status_skripsi = 'SIDANG SELESAI';
        $pendaftaran_skripsi->keterangan = 'Sidang Skripsi Selesai';
        $pendaftaran_skripsi->tgl_selesai_sidang = Carbon::now();
        $pendaftaran_skripsi->update();

        // return redirect('/riwayat-koordinator')->with('message', 'Berita Acara Disetujui!');
        Alert::success('Berhasil!', 'Seminar Telah Selesai')->showConfirmButton('Ok', '#28a745');
    return back();
    }

    public function tolak_kaprodi($id)
    {
        $jadwal = PenjadwalanSkripsi::find($id);        
        $jadwal->status_seminar = 0;
        $jadwal->update();

        // return redirect('/riwayat-koordinator')->with('message', 'Berita Acara Ditolak!');
        Alert::error('Berhasil', 'Berita acara berhasil ditolak')->showConfirmButton('Ok', '#dc3545');
        return back();
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


    //PERBAIKAN
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

        $pendaftaran_skripsi = PendaftaranSkripsi::where('mahasiswa_nim', $penjadwalan_skripsi->mahasiswa_nim )->latest('created_at')->first();

        $pendaftaran_skripsi->judul_skripsi = $penjadwalan_skripsi->revisi_skripsi;
        $pendaftaran_skripsi->update();

        if ($cari_penguji == 0) {
            // return redirect('/penilaian-skripsi/create/' . Crypt::encryptString($id))->with('message', 'Judul Berhasil Diubah!');            
            Alert::success('Berhasil', 'Judul Berhasil Diubah!')->showConfirmButton('Ok', '#28a745');
                return redirect('/penilaian-skripsi/create/' . Crypt::encryptString($id));
        } else {

            // return redirect('/penilaian-skripsi/edit/' . Crypt::encryptString($id))->with('message', 'Judul Berhasil Diubah!');
            Alert::success('Berhasil', 'Judul Berhasil Diubah!')->showConfirmButton('Ok', '#28a745');
                return redirect('/penilaian-skripsi/edit/' . Crypt::encryptString($id));
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
    
    public function nilaijurnal(Request $request, $id)
    {    
        $penjadwalan_skripsi = PenjadwalanSkripsi::find($id);
        $jurnal = PublikasiJurnal::where('mahasiswa_nim', $penjadwalan_skripsi->mahasiswa_nim )->latest('created_at')->first();
        $jurnal->nilai = $request->nilai;        
        $jurnal->save();

        Alert::success('Berhasil!', 'Nilai berhasil ditambahkan')->showConfirmButton('Ok', '#28a745');
        return back();
        
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
        $kaprodi1 = Dosen::where('role_id','6')->first();
        $kaprodi2 = Dosen::where('role_id','7')->first();
        $kaprodi3 = Dosen::where('role_id','8')->first();
        $koordinator1 = Dosen::where('role_id','9')->first();
        $koordinator2 = Dosen::where('role_id','10')->first();
        $koordinator3 = Dosen::where('role_id','11')->first();

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

            $pdf->loadView('penjadwalanskripsi.beritaacara-skripsi',compact('penjadwalan','qrcode', 'qrcodee', 'qrcodeee', 'pdf','pembimbing','pembimbingnilai','nilaipenguji1','nilaipenguji2','nilaipenguji3','nilaipembimbing1','kaprodi1', 'kaprodi2', 'kaprodi3', 'koordinator1', 'koordinator2', 'koordinator3'));
        
            return $pdf->stream('STI/TE-15 Berita Acara Sidang Skripsi.pdf', array("Attachment" => false));
            
        } else {
            $nilaipembimbing2 = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->where('pembimbing_nip', $penjadwalan->pembimbingdua_nip)->first();

            $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-skripsi').'/'. $penjadwalan->id));
            $qrcodee = base64_encode(QrCode::format('svg')->size(20)->errorCorrection('H')->generate(URL::to('/detail-skripsi').'/'. $penjadwalan->id));
            $qrcodeee = base64_encode(QrCode::format('svg')->size(50)->errorCorrection('H')->generate(URL::to('/detail-skripsi').'/'. $penjadwalan->id));
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

            $pdf->loadView('penjadwalanskripsi.beritaacara-skripsi',compact('penjadwalan','qrcode', 'qrcodee', 'qrcodeee', 'pdf','pembimbing','pembimbingnilai','nilaipenguji1','nilaipenguji2','nilaipenguji3','nilaipembimbing1','nilaipembimbing2' ,'kaprodi1', 'kaprodi2', 'kaprodi3', 'koordinator1', 'koordinator2', 'koordinator3'));
        
            return $pdf->stream('STI/TE-15 Berita Acara Sidang Skripsi.pdf', array("Attachment" => false));    
        }
    }
}
