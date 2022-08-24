<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjadwalanSkripsi;
use Illuminate\Support\Facades\Auth;
use App\Models\PenilaianSkripsiPenguji;
use App\Models\PenilaianSkripsiPembimbing;

class PenilaianSkripsiController extends Controller
{
    public function index()
    {
        $dosen = PenjadwalanSkripsi::where('pembimbingsatu_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbingdua_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pengujidua_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pengujitiga_nip', Auth::user()->nip)->where('status_seminar', 0)->get();

        return view('penilaianskripsi.index', [
            'penjadwalan_skripsis' => $dosen,
        ]);
    }

    public function create($id)
    {       
        $pembimbing = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->get();
        $penjadwalan = PenjadwalanSkripsi::find($id);
        $ceknilaipenguji1 = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', $penjadwalan->pengujisatu_nip)->first();            
        
        if ($ceknilaipenguji1 == null) {
            $nilaipenguji1 = '';
        } else {
            $nilaipenguji1 = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', $penjadwalan->pengujisatu_nip)->first();
        }

        $ceknilaipenguji2 = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', $penjadwalan->pengujidua_nip)->first();
        if ($ceknilaipenguji2 == null) {
            $nilaipenguji2 = '';
        } else {
            $nilaipenguji2 = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', $penjadwalan->pengujidua_nip)->first();
        }

        $ceknilaipenguji3 = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', $penjadwalan->pengujitiga_nip)->first();
        if ($ceknilaipenguji3 == null) {
            $nilaipenguji3 = '';
        } else {
            $nilaipenguji3 = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', $penjadwalan->pengujitiga_nip)->first();
        }

        if ($pembimbing->count() > 1) {
            $pembimbingnilai = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->get();
        } else {
            $pembimbingnilai = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $penjadwalan->id)->first();
        }

        $ceknilaipembimbing1 = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->where('pembimbing_nip', $penjadwalan->pembimbingsatu_nip)->first();
        if ($ceknilaipembimbing1 == null) {
            $nilaipembimbing1 = '';
        } else {
            $nilaipembimbing1 = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->where('pembimbing_nip', $penjadwalan->pembimbingsatu_nip)->first();
        }

        $ceknilaipembimbing2 = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->where('pembimbing_nip', $penjadwalan->pembimbingdua_nip)->first();
        if ($ceknilaipembimbing2 == null) {
            $nilaipembimbing2 = '';
        } else {
            $nilaipembimbing2 = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->where('pembimbing_nip', $penjadwalan->pembimbingdua_nip)->first();
        }            

        return view('penilaianskripsi.create', [
            'skripsi' => PenjadwalanSkripsi::find($id),
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

    public function store_pembimbing(Request $request, $id)
    {
        $request->validate([
            'penguasaan_dasar_teori' => 'required',
            'tingkat_penguasaan_materi' => 'required',
            'tinjauan_pustaka' => 'required',
            'tata_tulis' => 'required',
            'hasil_dan_pembahasan' => 'required',
            'sikap_dan_kepribadian' => 'required',
            'total_nilai_angka' => 'required',
            'total_nilai_huruf' => 'required',
        ]);

        PenilaianSkripsiPembimbing::create([
            'penguasaan_dasar_teori' => $request->penguasaan_dasar_teori,
            'tingkat_penguasaan_materi' => $request->tingkat_penguasaan_materi,
            'tinjauan_pustaka' => $request->tinjauan_pustaka,
            'tata_tulis' => $request->tata_tulis,
            'hasil_dan_pembahasan' => $request->hasil_dan_pembahasan,
            'sikap_dan_kepribadian' => $request->sikap_dan_kepribadian,
            'total_nilai_angka' => $request->total_nilai_angka,
            'total_nilai_huruf' => $request->total_nilai_huruf,
            'pembimbing_nip' => $request['pembimbing_nip'] = auth()->user()->nip,
            'penjadwalan_skripsi_id' => $request['penjadwalan_skripsi_id'] = $id,
        ]);

        return redirect('/penilaian-skripsi')->with('message', 'Nilai Berhasil Diinput!');
    }

    public function store_penguji(Request $request, $id)
    {        
        $penilaian = new PenilaianSkripsiPenguji;
        $penilaian->presentasi = $request['presentasi'];
        $penilaian->tingkat_penguasaan_materi = $request['tingkat_penguasaan_materi'];
        $penilaian->keaslian = $request['keaslian'];
        $penilaian->ketepatan_metodologi = $request['ketepatan_metodologi'];
        $penilaian->penguasaan_dasar_teori = $request['penguasaan_dasar_teori'];
        $penilaian->kecermatan_perumusan_masalah = $request['kecermatan_perumusan_masalah'];
        $penilaian->tinjauan_pustaka = $request['tinjauan_pustaka'];
        $penilaian->tata_tulis = $request['tata_tulis'];
        $penilaian->tools = $request['tools'];
        $penilaian->penyajian_data = $request['penyajian_data'];
        $penilaian->hasil = $request['hasil'];
        $penilaian->pembahasan = $request['pembahasan'];
        $penilaian->kesimpulan = $request['kesimpulan'];
        $penilaian->luaran = $request['luaran'];
        $penilaian->sumbangan_pemikiran = $request['sumbangan_pemikiran'];
        $penilaian->total_nilai_angka = $request['total_nilai_angka'];
        $penilaian->total_nilai_huruf = $request['total_nilai_huruf'];

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

        $penilaian->penguji_nip =auth()->user()->nip;
        $penilaian->penjadwalan_skripsi_id = $id;
        $penilaian->save();

        return redirect('/penilaian-skripsi/edit/' . $id)->with('message', 'Nilai Berhasil Diinput!');
    }

    public function edit($id)
    {
        $cari_penguji = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', auth()->user()->nip)->count();

        if ($cari_penguji == 0) {
            return view('penilaianskripsi.edit', [
                'skripsi' => PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->where('pembimbing_nip', auth()->user()->nip)->first(),
            ]);
        } else {

            $pembimbing = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->get();

            $penjadwalan = PenjadwalanSkripsi::find($id);
            $ceknilaipenguji1 = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', $penjadwalan->pengujisatu_nip)->first();

            if ($ceknilaipenguji1 == null) {
                $nilaipenguji1 = '';
            } else {
                $nilaipenguji1 = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', $penjadwalan->pengujisatu_nip)->first();
            }

            $ceknilaipenguji2 = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', $penjadwalan->pengujidua_nip)->first();
            if ($ceknilaipenguji2 == null) {
                $nilaipenguji2 = '';
            } else {
                $nilaipenguji2 = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', $penjadwalan->pengujidua_nip)->first();
            }

            $ceknilaipenguji3 = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', $penjadwalan->pengujitiga_nip)->first();
            if ($ceknilaipenguji3 == null) {
                $nilaipenguji3 = '';
            } else {
                $nilaipenguji3 = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', $penjadwalan->pengujitiga_nip)->first();
            }

            if ($pembimbing->count() > 1) {
                $pembimbingnilai = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->get();
            } else {
                $pembimbingnilai = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $penjadwalan->id)->first();
            }

            $ceknilaipembimbing1 = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->where('pembimbing_nip', $penjadwalan->pembimbingsatu_nip)->first();
            if ($ceknilaipembimbing1 == null) {
                $nilaipembimbing1 = '';
            } else {
                $nilaipembimbing1 = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->where('pembimbing_nip', $penjadwalan->pembimbingsatu_nip)->first();
            }

            $ceknilaipembimbing2 = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->where('pembimbing_nip', $penjadwalan->pembimbingdua_nip)->first();
            if ($ceknilaipembimbing2 == null) {
                $nilaipembimbing2 = '';
            } else {
                $nilaipembimbing2 = PenilaianSkripsiPembimbing::where('penjadwalan_skripsi_id', $id)->where('pembimbing_nip', $penjadwalan->pembimbingdua_nip)->first();
            }

            return view('penilaianskripsi.edit', [
                'skripsi' => PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', auth()->user()->nip)->first(),
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

    public function update_pembimbing(Request $request, $id)
    {
        $request->validate([
            'penguasaan_dasar_teori' => 'required',
            'tingkat_penguasaan_materi' => 'required',
            'tinjauan_pustaka' => 'required',
            'tata_tulis' => 'required',
            'hasil_dan_pembahasan' => 'required',
            'sikap_dan_kepribadian' => 'required',
            'total_nilai_angka' => 'required',
            'total_nilai_huruf' => 'required',
        ]);

        $edit = PenilaianSkripsiPembimbing::where('id', $id)->where('pembimbing_nip', auth()->user()->nip)->first();
        $edit->penguasaan_dasar_teori = $request->penguasaan_dasar_teori;
        $edit->tingkat_penguasaan_materi = $request->tingkat_penguasaan_materi;
        $edit->tinjauan_pustaka = $request->tinjauan_pustaka;
        $edit->tata_tulis = $request->tata_tulis;
        $edit->hasil_dan_pembahasan = $request->hasil_dan_pembahasan;
        $edit->sikap_dan_kepribadian = $request->sikap_dan_kepribadian;
        $edit->total_nilai_angka = $request->total_nilai_angka;
        $edit->total_nilai_huruf = $request->total_nilai_huruf;
        $edit->update();

        return redirect('/penilaian-skripsi')->with('message', 'Nilai Berhasil Diedit!');
    }

    public function update_penguji(Request $request, $id)
    {
        $rules = [
            'presentasi' => 'required',
            'tingkat_penguasaan_materi' => 'required',
            'keaslian' => 'required',
            'ketepatan_metodologi' => 'required',
            'penguasaan_dasar_teori' => 'required',
            'kecermatan_perumusan_masalah' => 'required',
            'tinjauan_pustaka' => 'required',
            'tata_tulis' => 'required',
            'tools' => 'required',
            'penyajian_data' => 'required',
            'hasil' => 'required',
            'pembahasan' => 'required',
            'kesimpulan' => 'required',
            'luaran' => 'required',
            'sumbangan_pemikiran' => 'required',
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

        $penilaian = PenilaianSkripsiPenguji::where('id', $id)->where('penguji_nip', auth()->user()->nip)->first();
        $penilaian->presentasi = $validatedData['presentasi'];
        $penilaian->tingkat_penguasaan_materi = $validatedData['tingkat_penguasaan_materi'];
        $penilaian->keaslian = $validatedData['keaslian'];
        $penilaian->ketepatan_metodologi = $validatedData['ketepatan_metodologi'];
        $penilaian->penguasaan_dasar_teori = $validatedData['penguasaan_dasar_teori'];
        $penilaian->kecermatan_perumusan_masalah = $validatedData['kecermatan_perumusan_masalah'];
        $penilaian->tinjauan_pustaka = $validatedData['tinjauan_pustaka'];
        $penilaian->tata_tulis = $validatedData['tata_tulis'];
        $penilaian->tools = $validatedData['tools'];
        $penilaian->penyajian_data = $validatedData['penyajian_data'];
        $penilaian->hasil = $validatedData['hasil'];
        $penilaian->pembahasan = $validatedData['pembahasan'];
        $penilaian->kesimpulan = $validatedData['kesimpulan'];
        $penilaian->luaran = $validatedData['luaran'];
        $penilaian->sumbangan_pemikiran = $validatedData['sumbangan_pemikiran'];
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

        $cari_penguji1 = PenjadwalanSkripsi::find($request->penjadwalan_skripsi_id);
        if ($cari_penguji1->pengujisatu_nip == auth()->user()->nip) {
            return redirect('/penilaian-skripsi/edit/' . $request->penjadwalan_skripsi_id)->with('message', 'Nilai Berhasil Diedit!');
        } else {
            return redirect('/penilaian-skripsi')->with('message', 'Nilai Berhasil Diedit!');
        }
    }

    public function riwayat()
    {
        $riwayat = PenjadwalanSkripsi::where('pembimbingsatu_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pembimbingdua_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pengujidua_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pengujitiga_nip', Auth::user()->nip)->where('status_seminar', 1)->get();

        return view('penilaianskripsi.riwayat-penilaian-skripsi', [
            'penjadwalan_skripsis' => $riwayat,
        ]);
    }
}
