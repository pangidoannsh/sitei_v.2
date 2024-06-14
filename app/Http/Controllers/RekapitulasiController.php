<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbRekapitulasiRps;
use App\Models\Absensi;
use App\Models\Dosen;
use App\Models\Perkuliahan;
use Log;
use Dompdf\Dompdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RekapitulasiController extends Controller
{
    public function updateKesesuaian(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'perkuliahan_id' => 'required|exists:ab_perkuliahan,id',
                'kesesuaian' => 'required|in:Sesuai,Tidak Sesuai'
            ]);


            AbRekapitulasiRps::updateOrCreate(
                ['perkuliahan_id' => $validatedData['perkuliahan_id']],
                ['kesesuaian' => $validatedData['kesesuaian']]
            );

            return response()->json(['message' => 'Kesesuaian berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while updating data. Please try again.'], 500);
        }
    }

    public function downloadPDF($class_id)
    {
        $attendances = Absensi::whereHas('perkuliahan', function ($query) use ($class_id) {
            $query->where('class_id', $class_id);
        })->get();

        $groupedAttendances = $attendances->groupBy('perkuliahan_id');
        $perkuliahan = Perkuliahan::with('rekapitulasiRps')->find($class_id);
        $user = Auth::user();
        $currentDate = Carbon::now()->format('d F Y');
        $imagePath = public_path('img/developer/logoo.png'); 
        $pdf = new Dompdf();
        $htmlPage = view('absensi_menu.absensistatistik.rekap-materi', compact('groupedAttendances', 'perkuliahan', 'attendances', 'class_id', 'currentDate', 'imagePath'))->render();
        $pdf->loadHtml($htmlPage);
        $pdf->setPaper('A4', 'portrait');

        // Render the PDF
        $pdf->render();
        return $pdf->stream('Rekapitulasi Materi Perkuliahan.pdf');
    }

}
