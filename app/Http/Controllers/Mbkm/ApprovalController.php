<?php

namespace App\Http\Controllers\Mbkm;

use App\Http\Controllers\Controller;
use App\Models\Mbkm\Konversi;
use App\Models\Mbkm\Logbook;
use App\Models\Mbkm\Mbkm;
use App\Models\Mbkm\PenilaianMbkm;
use App\Models\Mbkm\SertifikatMbkm;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ApprovalController extends Controller
{
    public function approveUsulan($id)
    {
        $km = Mbkm::find($id);
        $km->status = 'Disetujui';
        $km->tanggal_disetujui = date('Y-m-d H:i:s');
        $km->update();
        // Mengubah Status Usulan yang lainnya menjadi DITOLAK
        Mbkm::where("mahasiswa_nim", $km->mahasiswa_nim)
            ->where("id", "!=", $id)
            ->where("status", "Usulan")
            ->update([
                "status" => "Ditolak",
                "catatan" => "Salah satu usulan telah DITERIMA"
            ]);
        $logbooks = Logbook::where("mbkm_id", $id)->orderBy("input_date")->get();
        if ($logbooks->count() == 0) {
            foreach (Logbook::generateMonthArray($km->mulai_kegiatan, $km->selesai_kegiatan) as $date) {
                Logbook::create([
                    "mbkm_id" => $id,
                    "input_date" => $date
                ]);
            }
            $logbooks = Logbook::where("mbkm_id", $id)->orderBy("input_date")->get();
        }

        Alert::success('Berhasil!', 'Berhasil menyetujui usulan MBKM')->showConfirmButton('Ok', '#28a745');
        return redirect()->back();
    }

    public function tolakUsulan(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required',
        ]);
        // dd($request->all());
        $km = Mbkm::find($id);
        $km->status = 'Ditolak';
        $km->catatan = $request->catatan;
        $km->update();
        return redirect()->back();
    }

    public function konversi($id)
    {
        $mbkm = Mbkm::findOrFail($id);
        if ($mbkm->status !== "Usulan konversi nilai") {
            return abort(404);
        }
        $sertifikat = SertifikatMbkm::where("mbkm_id", $id)->first();
        $konversi = Konversi::where("mbkm_id", $id)->get();
        $penilaianMbkm = PenilaianMbkm::where("mbkm_id", $id)->get();
        return view("mbkm.prodi.konversi", compact("mbkm", "konversi", 'penilaianMbkm', 'sertifikat'));
    }
    public function approveKonversi(Request $request, $id)
    {
        // dd($request->all());
        $konversi = $request->konversi;
        if (is_array($konversi)) {
            foreach ($konversi as $value) {
                Konversi::where("id", $value["matkul"])->update([
                    "subjek_mbkm" => $value["penilaian_mbkm"],
                    "nilai_sks" => $value["nilai"],
                ]);
            }
        }
        $km = Mbkm::findOrFail($id);
        $km->status = 'Konversi diterima';
        $km->updated_at = date('Y-m-d H:i:s');
        $km->update();
        return redirect()->route("mbkm.prodi");
    }

    public function approveStaff($id)
    {
        $km = mbkm::findOrFail($id);
        $km->status = 'Nilai sudah keluar';
        $km->update();
        return back();
    }
    public function tolakKonversi(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required',
        ]);
        $km = Mbkm::find($id);
        $km->status = 'Konversi Ditolak';
        $km->catatan = $request->catatan;
        $km->updated_at = date('Y-m-d H:i:s');
        $km->update();
        return back();
    }

    public function approvePengunduran($id)
    {
        $km = mbkm::findOrFail($id);
        $km->status = 'Mengundurkan diri';
        $km->update();
        return redirect()->route("mbkm.prodi");
    }
}
