<?php

namespace App\Http\Controllers\ProgressReport;

use App\Http\Controllers\Controller;
use App\Models\BatalSeminar;
use App\Models\Konsentrasi;
use App\Models\Mahasiswa;
use App\Models\PendaftaranSkripsi;
use App\Models\Prodi;
use App\Models\ProgressReport\Pr_Proposal;
use App\Models\ProgressReport\Pr_Skripsi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProgressController extends Controller
{
    public function index()
    {
        $proposal = Pr_Proposal::where('mahasiswa_nim', Auth::user()->nim)->where('keterangan', null)->get();
        $skripsi = Pr_Skripsi::where('mahasiswa_nim', Auth::user()->nim)->where('keterangan', null)->get();

        $jumlahproposal = Pr_Proposal::where('mahasiswa_nim', Auth::user()->nim)->where('keterangan', null)->count();
        $jumlahskripsi = Pr_Skripsi::where('mahasiswa_nim', Auth::user()->nim)->where('keterangan', null)->count();

        $riwayatproposal = Pr_Proposal::where('mahasiswa_nim', Auth::user()->nim)->where('keterangan', '!=', null)->count();
        $riwayatskripsi = Pr_Skripsi::where('mahasiswa_nim', Auth::user()->nim)->where('keterangan',  '!=', null)->count();

        $currentDate = Carbon::now()->translatedFormat('d F Y');

        $lastProposal = Pr_Proposal::where('mahasiswa_nim', Auth::user()->nim)->latest()->first();
        $lastSkripsi = Pr_Skripsi::where('mahasiswa_nim', Auth::user()->nim)->latest()->first();

        return view('progress.index', [
            'lastProposal' => $lastProposal,
            'lastSkripsi' => $lastSkripsi,
            'currentDate' => $currentDate,
            'proposals' => $proposal,
            'skripsis' => $skripsi,
            'jumlah_riwayat' => $riwayatproposal + $riwayatskripsi,
            'jumlah' => $jumlahproposal + $jumlahskripsi
        ]);
    }

    public function riwayat()
    {
        $pendaftaran_skripsi = PendaftaranSkripsi::where('mahasiswa_nim', Auth::user()->nim)->latest('created_at')->first();
        $skripsi = PendaftaranSkripsi::where('mahasiswa_nim', Auth::user()->nim)->get();

        $batal_sempro = BatalSeminar::where('mahasiswa_nim', Auth::user()->nim)->where('jenis_seminar', 'Seminar Proposal')->latest('created_at')->first();
        $batal_sidang = BatalSeminar::where('mahasiswa_nim', Auth::user()->nim)->where('jenis_seminar', 'Sidang Skripsi')->latest('created_at')->first();

        $bimbinganProposal = Pr_Proposal::where('mahasiswa_nim', Auth::user()->nim)->select('bimbingan as pembimbing')->pluck('pembimbing');
        $proposalSubBab = Pr_Proposal::where('mahasiswa_nim', Auth::user()->nim)->select('bab1', 'bab2', 'bab3')->get();

        $ProposalSubBab1 = [];
        $ProposalSubBab2 = [];
        $ProposalSubBab3 = [];
        $ProposalBab1 = 0;
        $ProposalBab2 = 0;
        $ProposalBab3 = 0;

        foreach ($proposalSubBab as $subBab) {

            if ($subBab->bab1) {
                $count1 = count($subBab->bab1);
                if ($count1 == 1) {
                    $ProposalSubBab1[$ProposalBab1] = 3;
                } elseif ($count1 == 2) {
                    $ProposalSubBab1[$ProposalBab1] = 6;
                } elseif ($count1 == 3) {
                    $ProposalSubBab1[$ProposalBab1] = 9;
                } elseif ($count1 == 4) {
                    $ProposalSubBab1[$ProposalBab1] = 12;
                } elseif ($count1 == 5) {
                    $ProposalSubBab1[$ProposalBab1] = 15;
                } else {
                    $ProposalSubBab1[$ProposalBab1] = 18;
                }
            } else {
                $ProposalSubBab1[$ProposalBab1] = null;
            }

            if ($subBab->bab2) {
                $count2 = count($subBab->bab2);
                if ($count2 == 1) {
                    $ProposalSubBab2[$ProposalBab2] = 16;
                } else {
                    $ProposalSubBab2[$ProposalBab2] = 32;
                }
            } else {
                $ProposalSubBab2[$ProposalBab2] = null;
            }

            if ($subBab->bab3) {
                $count3 = count($subBab->bab3);
                if ($count3 == 1) {
                    $ProposalSubBab3[$ProposalBab3] = 25;
                } else {
                    $ProposalSubBab3[$ProposalBab3] = 50;
                }
            } else {
                $ProposalSubBab3[$ProposalBab3] = null;
            }

            $ProposalBab1++;
            $ProposalBab2++;
            $ProposalBab3++;
        }
        $bimbinganSkripsi = Pr_Skripsi::where('mahasiswa_nim', Auth::user()->nim)->select('bimbingan as pembimbingSkripsi')->pluck('pembimbingSkripsi');
        $skripsiSubBab = Pr_Skripsi::where('mahasiswa_nim', Auth::user()->nim)->select('bab1', 'bab2', 'bab3', 'bab4', 'bab5')->get();

        $skripsiSubBab1 = [];
        $skripsiSubBab2 = [];
        $skripsiSubBab3 = [];
        $skripsiSubBab4 = [];
        $skripsiSubBab5 = [];
        $skripsiBab1 = 0;
        $skripsiBab2 = 0;
        $skripsiBab3 = 0;
        $skripsiBab4 = 0;
        $skripsiBab5 = 0;

        foreach ($skripsiSubBab as $subBab) {

            if ($subBab->bab1) {
                $count1 = count($subBab->bab1);
                if ($count1 == 1) {
                    $skripsiSubBab1[$skripsiBab1] = 1;
                } elseif ($count1 == 2) {
                    $skripsiSubBab1[$skripsiBab1] = 2;
                } elseif ($count1 == 3) {
                    $skripsiSubBab1[$skripsiBab1] = 3;
                } elseif ($count1 == 4) {
                    $skripsiSubBab1[$skripsiBab1] = 4;
                } elseif ($count1 == 5) {
                    $skripsiSubBab1[$skripsiBab1] = 5;
                } else {
                    $skripsiSubBab1[$skripsiBab1] = 6;
                }
            } else {
                $skripsiSubBab1[$skripsiBab1] = null;
            }

            if ($subBab->bab2) {
                $count2 = count($subBab->bab2);
                if ($count2 == 1) {
                    $skripsiSubBab2[$skripsiBab2] = 12.5;
                } else {
                    $skripsiSubBab2[$skripsiBab2] = 25;
                }
            } else {
                $skripsiSubBab2[$skripsiBab2] = null;
            }

            if ($subBab->bab3) {
                $count3 = count($subBab->bab3);
                if ($count3 == 1) {
                    $skripsiSubBab3[$skripsiBab3] = 6;
                } else {
                    $skripsiSubBab3[$skripsiBab3] = 12;
                }
            } else {
                $skripsiSubBab3[$skripsiBab3] = null;
            }

            if ($subBab->bab4) {
                $count4 = count($subBab->bab4);
                if ($count4 == 1) {
                    $skripsiSubBab4[$skripsiBab4] = 27.5;
                } else {
                    $skripsiSubBab4[$skripsiBab4] = 55;
                }
            } else {
                $skripsiSubBab4[$skripsiBab4] = null;
            }

            if ($subBab->bab5) {
                $count5 = count($subBab->bab5);
                if ($count5 == 1) {
                    $skripsiSubBab5[$skripsiBab5] = 1;
                } else {
                    $skripsiSubBab5[$skripsiBab5] = 2;
                }
            } else {
                $skripsiSubBab5[$skripsiBab5] = null;
            }

            $skripsiBab1++;
            $skripsiBab2++;
            $skripsiBab3++;
            $skripsiBab4++;
            $skripsiBab5++;
        }
        $proposal = Pr_Proposal::where('mahasiswa_nim', Auth::user()->nim)->where('keterangan', '!=', null)->latest()->get();
        $skripsis = Pr_Skripsi::where('mahasiswa_nim', Auth::user()->nim)->where('keterangan', '!=', null)->latest()->get();

        $riwayatproposal = Pr_Proposal::where('mahasiswa_nim', Auth::user()->nim)->where('keterangan', '!=', null)->count();
        $riwayatskripsi = Pr_Skripsi::where('mahasiswa_nim', Auth::user()->nim)->where('keterangan', '!=', null)->count();

        $jumlahproposal = Pr_Proposal::where('mahasiswa_nim', Auth::user()->nim)->where('keterangan', null)->count();
        $jumlahskripsi = Pr_Skripsi::where('mahasiswa_nim', Auth::user()->nim)->where('keterangan', null)->count();

        $lastProposal = Pr_Proposal::where('mahasiswa_nim', Auth::user()->nim)->latest()->first();
        $lastSkripsi = Pr_Skripsi::where('mahasiswa_nim', Auth::user()->nim)->latest()->first();
        $currentDate = Carbon::now()->translatedFormat('d F Y');

        return view("pendaftaran.skripsi.usul-judul.index", [
            'pendaftaran_skripsi' => $pendaftaran_skripsi,
            'skripsi' => $skripsi,
            'batal_sempro' => $batal_sempro,
            'batal_sidang' => $batal_sidang,
            'proposalSubBab1' => $ProposalSubBab1,
            'proposalSubBab2' => $ProposalSubBab2,
            'proposalSubBab3' => $ProposalSubBab3,
            'skripsiSubBab1' => $skripsiSubBab1,
            'skripsiSubBab2' => $skripsiSubBab2,
            'skripsiSubBab3' => $skripsiSubBab3,
            'skripsiSubBab4' => $skripsiSubBab4,
            'skripsiSubBab5' => $skripsiSubBab5,
            'bimbinganProposal' => $bimbinganProposal,
            'bimbinganSkripsi' => $bimbinganSkripsi,
            'proposals' => $proposal,
            'skripsis' => $skripsis,
            'jumlah_skripsi' => $riwayatproposal + $riwayatskripsi,
            'jumlah' => $jumlahproposal + $jumlahskripsi,
            'lastProposal' => $lastProposal,
            'lastSkripsi' => $lastSkripsi,
            'currentDate' => $currentDate,
            'isRiwayat' => true
        ]);
    }

    public function show($id)
    {
        $proposal = Pr_Proposal::findOrFail($id);
        $mahasiswa = Mahasiswa::where('nim', $proposal->mahasiswa_nim)->first();
        $pendaftaran_skripsi = PendaftaranSkripsi::where('mahasiswa_nim', $proposal->mahasiswa_nim)->first();
        $prodi = Prodi::where('id', $mahasiswa->prodi_id)->first();
        $konsentrasi = Konsentrasi::where('id', $mahasiswa->konsentrasi_id)->first();

        return view('progress.proposal.show', [
            'proposal' => $proposal,
            'prodi' => $prodi,
            'konsentrasi' => $konsentrasi,
            'pendaftaran_skripsi' => $pendaftaran_skripsi
        ]);
    }

    public function showskripsi($id)
    {
        $skripsi = Pr_Skripsi::findOrFail($id);
        $mahasiswa = Mahasiswa::where('nim', $skripsi->mahasiswa_nim)->first();
        $pendaftaran_skripsi = PendaftaranSkripsi::where('mahasiswa_nim', $skripsi->mahasiswa_nim)->first();
        $prodi = Prodi::where('id', $mahasiswa->prodi_id)->first();
        $konsentrasi = Konsentrasi::where('id', $mahasiswa->konsentrasi_id)->first();

        return view('progress.skripsi.show', [
            'skripsi' => $skripsi,
            'prodi' => $prodi,
            'konsentrasi' => $konsentrasi,
            'pendaftaran_skripsi' => $pendaftaran_skripsi
        ]);
    }

    public function statistik()
    {
        $progressReportProposal = Pr_Proposal::where('mahasiswa_nim', Auth::user()->nim)->select('progress_report as proposal')->pluck('proposal');
        $bimbinganProposal = Pr_Proposal::where('mahasiswa_nim', Auth::user()->nim)->select('bimbingan as pembimbing')->pluck('pembimbing');

        $progressReportSkripsi = Pr_Skripsi::where('mahasiswa_nim', Auth::user()->nim)->select('progress_report as skripsi')->pluck('skripsi');
        $bimbinganSkripsi = Pr_Skripsi::where('mahasiswa_nim', Auth::user()->nim)->select('bimbingan as pembimbingSkripsi')->pluck('pembimbingSkripsi');

        $riwayatproposal = Pr_Proposal::where('mahasiswa_nim', Auth::user()->nim)->where('keterangan', '!=', null)->count();
        $riwayatskripsi = Pr_Skripsi::where('mahasiswa_nim', Auth::user()->nim)->where('keterangan', '!=', null)->count();

        $jumlahproposal = Pr_Proposal::where('mahasiswa_nim', Auth::user()->nim)->where('keterangan', null)->count();
        $jumlahskripsi = Pr_Skripsi::where('mahasiswa_nim', Auth::user()->nim)->where('keterangan', null)->count();

        return view('progress.statistik', [
            'progressReportProposal' => $progressReportProposal,
            'bimbinganProposal' => $bimbinganProposal,
            'progressReportSkripsi' => $progressReportSkripsi,
            'bimbinganSkripsi' => $bimbinganSkripsi,
            'jumlah_skripsi' => $riwayatproposal + $riwayatskripsi,
            'jumlah' => $jumlahproposal + $jumlahskripsi
        ]);
    }

    public function logbookProposal($id)
    {
        $proposal = Pr_Proposal::findOrFail($id);
        $pendaftaraSkripsi = PendaftaranSkripsi::where('mahasiswa_nim', Auth::user()->nim)->first();
        $currentDate = Carbon::now()->translatedFormat('d F Y');
        $imagePath = public_path('img/developer/logo.png');
        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/progress/detailProposal') . '/' . $id));
        $pdf = Pdf::loadView('progress.logbookProposal', [
            'qrcode' => $qrcode,
            'proposal' => $proposal,
            'pendaftaraSkripsi' => $pendaftaraSkripsi,
            'tanggal' => $currentDate,
            'imagePath' => $imagePath
        ]);

        return $pdf->stream('Logbook.pdf');
    }

    public function logbookSkripsi($id)
    {
        $skripsi = Pr_Skripsi::findOrFail($id);
        $pendaftaraSkripsi = PendaftaranSkripsi::where('mahasiswa_nim', Auth::user()->nim)->first();
        $currentDate = Carbon::now()->translatedFormat('d F Y');
        $imagePath = public_path('img/developer/logo.png');
        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(URL::to('/progress/detailSkripsi') . '/' . $id));

        $pdf = Pdf::loadView('progress.logbookSkripsi', [
            'qrcode' => $qrcode,
            'skripsi' => $skripsi,
            'pendaftaraSkripsi' => $pendaftaraSkripsi,
            'tanggal' => $currentDate,
            'imagePath' => $imagePath
        ]);

        return $pdf->stream('Logbook.pdf');
    }

    public function detailProposal($id)
    {
        $proposal = Pr_Proposal::findOrFail($id);
        $pendaftaranSkripsi = PendaftaranSkripsi::with('users', 'konsentrasi', 'prodis', 'pembimbing')->where('nim', $proposal->mahasiswa_nim)->latest()->first();
        return view('progress.detailProposal', [
            'proposal' => $proposal,
            'pendaftaranSkripsi' => $pendaftaranSkripsi
        ]);
    }

    public function detailSkripsi($id)
    {
        $skripsi = Pr_Skripsi::findOrFail($id);
        $pendaftaranSkripsi = PendaftaranSkripsi::with('users', 'konsentrasi', 'prodis', 'pembimbing')->where('nim', $skripsi->mahasiswa_nim)->latest()->first();
        return view('progress.detailSkripsi', [
            'skripsi' => $skripsi,
            'pendaftaranSkripsi' => $pendaftaranSkripsi
        ]);
    }
}
