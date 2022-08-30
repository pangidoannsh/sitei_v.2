<?php

namespace App\Http\Controllers;

use App\Models\PenilaianKP;
use Illuminate\Http\Request;
use App\Models\PenjadwalanKP;
use Illuminate\Support\Facades\Auth;

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
        return view('penilaiankp.create', [
            'kp' => PenjadwalanKP::find($id),
        ]);
    }

    public function store(Request $request, $id)
    {
        $rules = [
            'presentasi' => 'required',
            'materi' => 'required',
            'tanya_jawab' => 'required',
            'total_nilai_seminar' => 'required',
            'nilai_pembimbing_lapangan' => 'required',
            'nilai_pembimbing_kp' => 'required',
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

        $validatedData['penguji_nip'] = auth()->user()->nip;
        $validatedData['penjadwalan_kp_id'] = $id;

        $penilaian = new PenilaianKP;
        $penilaian->presentasi = $validatedData['presentasi'];
        $penilaian->materi = $validatedData['materi'];
        $penilaian->tanya_jawab = $validatedData['tanya_jawab'];
        $penilaian->total_nilai_seminar = $validatedData['total_nilai_seminar'];
        $penilaian->nilai_pembimbing_lapangan = $validatedData['nilai_pembimbing_lapangan'];
        $penilaian->nilai_pembimbing_kp = $validatedData['nilai_pembimbing_kp'];
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

        $penilaian->penguji_nip = $validatedData['penguji_nip'];
        $penilaian->penjadwalan_kp_id = $validatedData['penjadwalan_kp_id'];
        $penilaian->save();

        $jadwal = PenjadwalanKP::find($id);
        $jadwal->status_seminar = 1;
        $jadwal->update();

        return redirect('/penilaian')->with('message', 'Nilai Berhasil Diinput!');
    }

    public function riwayat()
    {
        $riwayat = PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 1)->get();

        return view('penilaiankp.riwayat-penilaian-kp', [
            'penjadwalan_kps' => $riwayat,
        ]);
    }
}
