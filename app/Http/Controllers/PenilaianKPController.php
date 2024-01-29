<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\PenilaianKP;
use Illuminate\Http\Request;
use App\Models\PenjadwalanKP;
use App\Models\PendaftaranKP;
use App\Models\PenilaianKPPenguji;
use Illuminate\Support\Facades\Auth;
use App\Models\PenilaianKPPembimbing;
use Illuminate\Support\Facades\Crypt;

class PenilaianKPController extends Controller
{
    public function index()
    {
        $dosen = PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->get();
        return view('penilaiankp.index', [
            'penjadwalan_kps' => $dosen,
        ]);
    }

    public function create($id)
    {
        $decrypted = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanKP::findOrFail($decrypted);        
        $ceknilaipenguji = PenilaianKPPenguji::where('penjadwalan_kp_id' , $decrypted)->where('penguji_nip', $penjadwalan->penguji_nip)->first();

        if ($ceknilaipenguji == null) {
            $nilaipenguji = '';
        }
        else {
            $nilaipenguji = PenilaianKPPenguji::where('penjadwalan_kp_id', $decrypted)->where('penguji_nip', $penjadwalan->penguji_nip)->first();
        }

        $ceknilaipembimbing = PenilaianKPPembimbing::where('penjadwalan_kp_id', $decrypted)->where('pembimbing_nip', $penjadwalan->pembimbing_nip)->first();
        if ($ceknilaipembimbing == null) {
            $nilaipembimbing = '';
        }
        else {
            $nilaipembimbing = PenilaianKPPembimbing::where('penjadwalan_kp_id', $decrypted)->where('pembimbing_nip', $penjadwalan->pembimbing_nip)->first();
        }

        $pendaftaran_kp = PendaftaranKP::where('mahasiswa_nim', $penjadwalan->mahasiswa_nim )->latest('created_at')->first();

        return view('penilaiankp.create', [
            'kp' => PenjadwalanKP::find($decrypted),                   
            'penjadwalan' => $penjadwalan,
            'nilaipenguji' => $nilaipenguji,
            'nilaipembimbing' => $nilaipembimbing,
            'laporan_kp' => $pendaftaran_kp,
            
        ]);  

    }



    public function store_pembimbing(Request $request, $id)
    {

        $penilaian = new PenilaianKPPembimbing;

        $penilaian->presentasi = $request->presentasi;       
        $penilaian->materi = $request->materi;
        $penilaian->tanya_jawab = $request->tanya_jawab;
        $penilaian->total_nilai_angka = $request->total_nilai_angka;
        $penilaian->total_nilai_huruf = $request->total_nilai_huruf;        

        // if ($request->presentasi) {
        //     $penilaian->presentasi = $request->presentasi;
        // }
        // if ($request->materi) {
        //     $penilaian->materi = $request->materi;
        // }
        // if ($request->tanya_jawab) {
        //     $penilaian->tanya_jawab = $request->tanya_jawab;
        // }
        // if ($request->total_nilai_angka) {
        //     $penilaian->total_nilai_angka = $request->total_nilai_angka;
        // }
        // if ($request->total_nilai_huruf) {
        //     $penilaian->total_nilai_huruf = $request->total_nilai_huruf;
        // }
        if ($request->nilai_pembimbing_lapangan) {
            $penilaian->nilai_pembimbing_lapangan = $request->nilai_pembimbing_lapangan;
        }

        if ($request->catatan1) {
            $penilaian->catatan1 = $request['catatan1'];
        }
        if ($request->catatan2) {
            $penilaian->catatan2 = $request['catatan2'];
        }
        if ($request->catatan3) {
            $penilaian->catatan3 = $request['catatan3'];
        }

        // $pembimbing_nip = PenjadwalanKP::whereNotNull('pembimbing_nip')->first();
        // $penguji_nip = PenjadwalanKP::whereNotNull('penguji_nip')->first();

        $pembimbing_nip = PenjadwalanKP::where('pembimbing_nip', auth()->user()->nip)->where('id', $id )->first();
        $penguji_nip = PenjadwalanKP::where('penguji_nip', auth()->user()->nip)->where('id', $id )->first();

        if ($pembimbing_nip == $penguji_nip) {
            $penilaian->pembimbing_nip = auth()->user()->nip;
            $penilaian->penjadwalan_kp_id = $id;
            $penilaian->save();  

            $penilaianPenguji = new PenilaianKPPenguji();
            $penilaianPenguji->Penguji_nip = auth()->user()->nip;
            $penilaianPenguji->penjadwalan_kp_id = $id;
            $penilaianPenguji->save();
        }
        else{
            $penilaian->pembimbing_nip = auth()->user()->nip;
            $penilaian->penjadwalan_kp_id = $id;
            $penilaian->save();  
        } 

        // $penilaian->pembimbing_nip = auth()->user()->nip;
        // $penilaian->penjadwalan_kp_id = $id;
        // $penilaian->save();        

        return redirect('/penilaian-kp/edit/' . Crypt::encryptString($id))->with('message', 'Nilai Berhasil Diinput!');   

    }

    public function store_penguji(Request $request, $id)
    {
          

        $penilaian = new PenilaianKPPenguji;
        $penilaian->presentasi = $request->presentasi;       
        $penilaian->materi = $request->materi;
        $penilaian->tanya_jawab = $request->tanya_jawab;
        $penilaian->total_nilai_angka = $request->total_nilai_angka;
        $penilaian->total_nilai_huruf = $request->total_nilai_huruf;

        if ($request->revisi_naskah1) {
            $penilaian->revisi_naskah1 = $request->revisi_naskah1;
        }
        if ($request->revisi_naskah2) {
            $penilaian->revisi_naskah2 = $request->revisi_naskah2;
        }
        if ($request->revisi_naskah3) {
            $penilaian->revisi_naskah3 = $request->revisi_naskah3;
        }
        if ($request->revisi_naskah4) {
            $penilaian->revisi_naskah4 = $request->revisi_naskah4;
        }
        if ($request->revisi_naskah5) {
            $penilaian->revisi_naskah5 = $request->revisi_naskah5;
        } 

        $pembimbing_nip = PenjadwalanKP::where('pembimbing_nip', auth()->user()->nip)->where('id', $id )->first();
        $penguji_nip = PenjadwalanKP::where('penguji_nip', auth()->user()->nip)->where('id', $id )->first();
        
    if ($pembimbing_nip == $penguji_nip) {

        $penilaian->penguji_nip = auth()->user()->nip;
        $penilaian->penjadwalan_kp_id = $id;
        $penilaian->save();

        $penilaianPembimbing = new PenilaianKPPembimbing();
        $penilaianPembimbing->pembimbing_nip = auth()->user()->nip;
        $penilaianPembimbing->penjadwalan_kp_id = $penilaian->penjadwalan_kp_id;

        $penilaianPembimbing->presentasi = $penilaian->presentasi;       
        $penilaianPembimbing->materi = $penilaian->materi;
        $penilaianPembimbing->tanya_jawab = $penilaian->tanya_jawab;
        $penilaianPembimbing->total_nilai_angka = $penilaian->total_nilai_angka;
        $penilaianPembimbing->total_nilai_huruf = $penilaian->total_nilai_huruf;

        $penilaianPembimbing->save();
    } else{

    $penilaian->penguji_nip = auth()->user()->nip;
    $penilaian->penjadwalan_kp_id = $id;
    $penilaian->save();

    }

        return redirect('/penilaian-kp/edit/' . Crypt::encryptString($id))->with('message', 'Nilai Berhasil Diinput!');    
    }
    
    public function store_pembimbing_penguji_sama(Request $request, $id)
    {
        $penilaian = new PenilaianKPPenguji();
        $penilaian->presentasi = $request->presentasi;       
        $penilaian->materi = $request->materi;
        $penilaian->tanya_jawab = $request->tanya_jawab;
        $penilaian->total_nilai_angka = $request->total_nilai_angka;
        $penilaian->total_nilai_huruf = $request->total_nilai_huruf;

        if ($request->revisi_naskah1) {
            $penilaian->revisi_naskah1 = $request->revisi_naskah1;
        }
        if ($request->revisi_naskah2) {
            $penilaian->revisi_naskah2 = $request->revisi_naskah2;
        }
        if ($request->revisi_naskah3) {
            $penilaian->revisi_naskah3 = $request->revisi_naskah3;
        }
        if ($request->revisi_naskah4) {
            $penilaian->revisi_naskah4 = $request->revisi_naskah4;
        }
        if ($request->revisi_naskah5) {
            $penilaian->revisi_naskah5 = $request->revisi_naskah5;
        } 

        $penilaian->penguji_nip = auth()->user()->nip;
        $penilaian->penjadwalan_kp_id = $id;
        $penilaian->save();

        $penilaianPembimbing = new PenilaianKPPembimbing();
        $penilaianPembimbing->pembimbing_nip = auth()->user()->nip;
        $penilaianPembimbing->penjadwalan_kp_id = $penilaian->penjadwalan_kp_id;

        if ($request->nilai_pembimbing_lapangan) {
            $penilaianPembimbing->nilai_pembimbing_lapangan = $request->nilai_pembimbing_lapangan;
        }

        if ($request->catatan1) {
            $penilaianPembimbing->catatan1 = $request['catatan1'];
        }
        if ($request->catatan2) {
            $penilaianPembimbing->catatan2 = $request['catatan2'];
        }
        if ($request->catatan3) {
            $penilaianPembimbing->catatan3 = $request['catatan3'];
        }

        $penilaianPembimbing->presentasi = $penilaian->presentasi;    
        $penilaianPembimbing->materi = $penilaian->materi;
        $penilaianPembimbing->tanya_jawab = $penilaian->tanya_jawab;
        $penilaianPembimbing->total_nilai_angka = $penilaian->total_nilai_angka;
        $penilaianPembimbing->total_nilai_huruf = $penilaian->total_nilai_huruf;

        $penilaianPembimbing->save();


        return redirect('/penilaian-kp/edit/' . Crypt::encryptString($id))->with('message', 'Nilai Berhasil Diinput!');    
    }

    public function edit($id)
    {                
        $decrypted = Crypt::decryptString($id);
        $cari_pembimbing = PenilaianKPPembimbing::where('penjadwalan_kp_id', $decrypted)->where('pembimbing_nip', auth()->user()->nip)->count();

         $penjadwalan = PenjadwalanKP::find($decrypted);  
        $pendaftaran_kp = PendaftaranKP::where('mahasiswa_nim', $penjadwalan->mahasiswa_nim )->latest('created_at')->first();

        if ($cari_pembimbing == 0) {            
            return view('penilaiankp.edit', [
                'kp' => PenilaianKPPenguji::where('penjadwalan_kp_id', $decrypted)->where('penguji_nip', auth()->user()->nip)->first(),
                'laporan_kp' => $pendaftaran_kp,
  
            ]);
        } 
        else {
                        
                 
            $ceknilaipenguji = PenilaianKPPenguji::where('penjadwalan_kp_id' , $decrypted)->where('penguji_nip', $penjadwalan->penguji_nip)->first();

            if ($ceknilaipenguji == null) {
                $nilaipenguji = '';
            }
            else {
                $nilaipenguji = PenilaianKPPenguji::where('penjadwalan_kp_id', $decrypted)->where('penguji_nip', $penjadwalan->penguji_nip)->first();                
            }

            $ceknilaipembimbing = PenilaianKPPembimbing::where('penjadwalan_kp_id', $decrypted)->where('pembimbing_nip', $penjadwalan->pembimbing_nip)->first();

            if ($ceknilaipembimbing == null) {
                $nilaipembimbing = '';
            }
            else {
                $nilaipembimbing = PenilaianKPPembimbing::where('penjadwalan_kp_id', $decrypted)->where('pembimbing_nip', $penjadwalan->pembimbing_nip)->first();
            }

            $kp = PenilaianKPPembimbing::where('penjadwalan_kp_id', $decrypted)->where('pembimbing_nip', auth()->user()->nip)->first();
            $kpp = PenilaianKPPenguji::where('penjadwalan_kp_id', $decrypted)->where('penguji_nip', auth()->user()->nip)->first();

            

            return view('penilaiankp.edit', [
                'kp' => $kp,                           
                'kpp' => $kpp,                           
                'penjadwalan' => $penjadwalan,
                'nilaipenguji' => $nilaipenguji,
                'nilaipembimbing' => $nilaipembimbing,
                'laporan_kp' => $pendaftaran_kp,
 
            ]);

        }
    }

    public function update_penguji(Request $request, $id)
    {
        $rules = [
            'presentasi' => 'required',
            'materi' => 'required',
            'tanya_jawab' => 'required',            
            'total_nilai_angka' => 'required',
            'total_nilai_huruf' => 'required',
        ];

        if ($request->revisi_naskah1) {
            $rules['revisi_naskah1'] = 'required';
        }
        if ($request->revisi_naskah2) {
            $rules['revisi_naskah2'] = 'required';
        }
        if ($request->revisi_naskah3) {
            $rules['revisi_naskah3'] = 'required';
        }
        if ($request->revisi_naskah4) {
            $rules['revisi_naskah4'] = 'required';
        }
        if ($request->revisi_naskah5) {
            $rules['revisi_naskah5'] = 'required';
        }

        $validatedData = $request->validate($rules);

        $penilaian = PenilaianKPPenguji::where('id', $id)->where('penguji_nip', auth()->user()->nip)->first();   
        $penilaian->presentasi = $validatedData['presentasi'];
        $penilaian->materi = $validatedData['materi'];
        $penilaian->tanya_jawab = $validatedData['tanya_jawab'];        
        $penilaian->total_nilai_angka = $validatedData['total_nilai_angka'];
        $penilaian->total_nilai_huruf = $validatedData['total_nilai_huruf'];

        if ($request->revisi_naskah1) {
            $penilaian->revisi_naskah1 = $validatedData['revisi_naskah1'];
        }
        if ($request->revisi_naskah2) {
            $penilaian->revisi_naskah2 = $validatedData['revisi_naskah2'];
        }
        if ($request->revisi_naskah3) {
            $penilaian->revisi_naskah3 = $validatedData['revisi_naskah3'];
        }
        if ($request->revisi_naskah4) {
            $penilaian->revisi_naskah4 = $validatedData['revisi_naskah4'];
        }
        if ($request->revisi_naskah5) {
            $penilaian->revisi_naskah5 = $validatedData['revisi_naskah5'];
        }
        
        $penilaian->update();

        Alert::success('Berhasil', 'Nilai berhasil diedit!')->showConfirmButton('Ok', '#28a745');
        return  back();    

    }

    public function update_pembimbing(Request $request, $id)
    {
        $rules = [
            'presentasi' => 'required',
            'materi' => 'required',
            'tanya_jawab' => 'required',            
            'total_nilai_angka' => 'required',
            'total_nilai_huruf' => 'required',            
        ];

        if ($request->nilai_pembimbing_lapangan) {
            $rules['nilai_pembimbing_lapangan'] = 'required';
        }

        if ($request->catatan1) {
            $rules['catatan1'] = 'required';
        }
        if ($request->catatan2) {
            $rules['catatan2'] = 'required';
        }
        if ($request->catatan3) {
            $rules['catatan3'] = 'required';
        }

        $validatedData = $request->validate($rules);
        $edit = PenilaianKPPembimbing::where('id', $id)->where('pembimbing_nip', auth()->user()->nip)->first();
        $edit->presentasi = $validatedData['presentasi'];
        $edit->materi = $validatedData['materi'];
        $edit->tanya_jawab = $validatedData['tanya_jawab'];                
        $edit->total_nilai_angka = $validatedData['total_nilai_angka'];
        $edit->total_nilai_huruf = $validatedData['total_nilai_huruf']; 

        if ($request->nilai_pembimbing_lapangan) {
            $edit->nilai_pembimbing_lapangan = $validatedData['nilai_pembimbing_lapangan'];
        }

        if ($request->catatan1) {
            $edit->catatan1 = $validatedData['catatan1'];
        }
        if ($request->catatan2) {
            $edit->catatan2 = $validatedData['catatan2'];
        }
        if ($request->catatan3) {
            $edit->catatan3 = $validatedData['catatan3'];
        }

        $edit->update();

        Alert::success('Berhasil', 'Nilai berhasil diedit!')->showConfirmButton('Ok', '#28a745');
        return  back();    
    }


    //PEMBIMBING SAMA DENGAN PENGUJI

    public function update_pembimbing_penguji_sama(Request $request, $id)
    {
        $penjadwalan_kp = PenjadwalanKP::find($id);

          $rules = [
            // 'presentasi' => 'required',
            // 'materi' => 'required',
            // 'tanya_jawab' => 'required',            
            // 'total_nilai_angka' => 'required',
            // 'total_nilai_huruf' => 'required',
        ];

        // if ($request->revisi_naskah1) {
        //     $rules['revisi_naskah1'] = 'required';
        // }
        // if ($request->revisi_naskah2) {
        //     $rules['revisi_naskah2'] = 'required';
        // }
        // if ($request->revisi_naskah3) {
        //     $rules['revisi_naskah3'] = 'required';
        // }
        // if ($request->revisi_naskah4) {
        //     $rules['revisi_naskah4'] = 'required';
        // }
        // if ($request->revisi_naskah5) {
        //     $rules['revisi_naskah5'] = 'required';
        // }

        // $validatedData = $request->validate($rules);

        $penilaian = PenilaianKPPenguji::where('penjadwalan_kp_id', $penjadwalan_kp->id)->where('penguji_nip', auth()->user()->nip)->first();

        if ($request->presentasi) {
            $penilaian->presentasi = $request['presentasi'];
        }
        if ($request->materi) {
            $penilaian->materi = $request['materi'];
        }
        if ($request->tanya_jawab) {
            $penilaian->tanya_jawab = $request['tanya_jawab'];
        }
        if ($request->total_nilai_angka) {
            $penilaian->total_nilai_angka = $request['total_nilai_angka'];
        }
        if ($request->total_nilai_huruf) {
            $penilaian->total_nilai_huruf = $request['total_nilai_huruf'];
        }

        if ($request->revisi_naskah1) {
            $penilaian->revisi_naskah1 = $request['revisi_naskah1'];
        }
        if ($request->revisi_naskah2) {
            $penilaian->revisi_naskah2 = $request['revisi_naskah2'];
        }
        if ($request->revisi_naskah3) {
            $penilaian->revisi_naskah3 = $request['revisi_naskah3'];
        }
        if ($request->revisi_naskah4) {
            $penilaian->revisi_naskah4 = $request['revisi_naskah4'];
        }
        if ($request->revisi_naskah5) {
            $penilaian->revisi_naskah5 = $request['revisi_naskah5'];
        }

        $penilaian->update();

        $penilaianPembimbing = PenilaianKPPembimbing::where('penjadwalan_kp_id', $penjadwalan_kp->id)->where('pembimbing_nip' , auth()->user()->nip)->first();

        if ($request->presentasi) {
            $penilaianPembimbing->presentasi = $request['presentasi'];
        }
        if ($request->materi) {
            $penilaianPembimbing->materi = $request['materi'];
        }
        if ($request->tanya_jawab) {
            $penilaianPembimbing->tanya_jawab = $request['tanya_jawab'];
        }
        if ($request->total_nilai_angka) {
            $penilaianPembimbing->total_nilai_angka = $request['total_nilai_angka'];
        }
        if ($request->total_nilai_huruf) {
            $penilaianPembimbing->total_nilai_huruf = $request['total_nilai_huruf'];
        }

        if ($request->nilai_pembimbing_lapangan){
        $penilaianPembimbing->nilai_pembimbing_lapangan = $request->nilai_pembimbing_lapangan; 
        }
        if ($request->catatan1) {
        $penilaianPembimbing->catatan1 = $request->catatan1; 
        }
        if ($request->catatan2) {
        $penilaianPembimbing->catatan2 = $request->catatan2; 
        }
        if ($request->catatan3) {
        $penilaianPembimbing->catatan3 = $request->catatan3;
        }
  
        $penilaianPembimbing->update();
        
        Alert::success('Berhasil', 'Nilai berhasil diedit!')->showConfirmButton('Ok', '#28a745');
        
        return  back();    

    }


    public function riwayat()
    {
        $riwayat = PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 1)->get();

        return view('penilaiankp.riwayat-penilaian-kp', [
            'penjadwalan_kps' => $riwayat,
        ]);
    }
}
