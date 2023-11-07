<?php

namespace App\Http\Controllers;

use \PDF;
use Illuminate\Http\Request;
use App\Models\PenjadwalanSkripsi;
use App\Models\PenjadwalanSempro;
use App\Models\PenjadwalanKP;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\PenilaianSkripsiPenguji;
use App\Models\Dosen;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UndanganSeminarController extends Controller
{
      public function undangan_kp($id)
    {   
        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanKP::where('id', $id)->where('penguji_nip', auth()->user()->nip)->
        orWhere('id', $id)->where('pembimbing_nip', auth()->user()->nip)->
        first();
        $kaprodi1 = Dosen::where('role_id', '6')->first();
        $kaprodi2 = Dosen::where('role_id', '7')->first();
        $kaprodi3 = Dosen::where('role_id', '8')->first();
        $koor1 = Dosen::where('role_id', '9')->first();
        $koor2 = Dosen::where('role_id', '10')->first();
        $koor3 = Dosen::where('role_id', '11')->first();

        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-undangan-kp').'/'. $penjadwalan->id));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $pdf->loadView('undanganseminar.undangan-kp',compact('penjadwalan','qrcode', 'pdf', 'kaprodi1', 'kaprodi2', 'kaprodi3', 'koor1', 'koor2', 'koor3'));
        
        return $pdf->stream('STI/TE-4 Undangan Seminar ProposalKerja Praktek.pdf', array("Attachment" => false));  
    }
      public function undangan_sempro($id)
    {   
        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanSempro::where('id', $id)->where('pengujisatu_nip', auth()->user()->nip)->
        orWhere('id', $id)->where('pengujidua_nip', auth()->user()->nip)->
        orWhere('id', $id)->where('pengujitiga_nip', auth()->user()->nip)->
        orWhere('id', $id)->where('pembimbingsatu_nip', auth()->user()->nip)->
        orWhere('id', $id)->where('pembimbingdua_nip', auth()->user()->nip)->
        first();
        $kaprodi1 = Dosen::where('role_id', '6')->first();
        $kaprodi2 = Dosen::where('role_id', '7')->first();
        $kaprodi3 = Dosen::where('role_id', '8')->first();
        $koor1 = Dosen::where('role_id', '9')->first();
        $koor2 = Dosen::where('role_id', '10')->first();
        $koor3 = Dosen::where('role_id', '11')->first();

        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-undangan-sempro').'/'. $penjadwalan->id));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $pdf->loadView('undanganseminar.undangan-sempro',compact('penjadwalan','qrcode', 'pdf', 'kaprodi1', 'kaprodi2', 'kaprodi3', 'koor1', 'koor2', 'koor3'));
        
        return $pdf->stream('STI/TE-4 Undangan Seminar Proposal.pdf', array("Attachment" => false));  
    }
      public function undangan_sidang($id)
    {   
        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanSkripsi::where('id', $id)->where('pengujisatu_nip', auth()->user()->nip)->
        orWhere('id', $id)->where('pengujidua_nip', auth()->user()->nip)->
        orWhere('id', $id)->where('pengujitiga_nip', auth()->user()->nip)->
        orWhere('id', $id)->where('pembimbingsatu_nip', auth()->user()->nip)->
        orWhere('id', $id)->where('pembimbingdua_nip', auth()->user()->nip)->
        first();
        $kaprodi1 = Dosen::where('role_id', '6')->first();
        $kaprodi2 = Dosen::where('role_id', '7')->first();
        $kaprodi3 = Dosen::where('role_id', '8')->first();
        $koor1 = Dosen::where('role_id', '9')->first();
        $koor2 = Dosen::where('role_id', '10')->first();
        $koor3 = Dosen::where('role_id', '11')->first();

        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-undangan-sidang').'/'. $penjadwalan->id));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $pdf->loadView('undanganseminar.undangan-sidang',compact('penjadwalan','qrcode', 'pdf', 'kaprodi1', 'kaprodi2', 'kaprodi3', 'koor1', 'koor2', 'koor3'));
        
        return $pdf->stream('STI/TE-12 Undangan Sidang Skripsi.pdf', array("Attachment" => false));  
    }

    public function perbaikanpengujiskripsi($id, $penguji)
    {
        $id = Crypt::decryptString($id);
        $penjadwalan = PenjadwalanSkripsi::find($id);
        $penilaianpenguji = PenilaianSkripsiPenguji::where('penjadwalan_skripsi_id', $id)->where('penguji_nip', $penguji)->first();

        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/detail-skripsi').'/'. $penjadwalan->id));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $pdf->loadView('undanganseminar.undangan-sidang',compact('penjadwalan','qrcode', 'pdf', 'penilaianpenguji'));
        
        return $pdf->stream('STI/TE-16 Lembar Kontrol Perbaikan Skripsi.pdf', array("Attachment" => false));
    }
}
