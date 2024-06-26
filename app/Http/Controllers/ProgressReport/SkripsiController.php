<?php

namespace App\Http\Controllers\ProgressReport;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\PendaftaranSkripsi;
use App\Models\ProgressReport\Pr_Skripsi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkripsiController extends Controller
{
    public function create()
    {
        $prskripsi = Pr_Skripsi::where('mahasiswa_nim', Auth::guard("mahasiswa")->user()->nim)->latest()->first();
        $bimbingan_ke = 0;

        if ($prskripsi?->bimbingan) {
            $bimbingan_ke = $prskripsi->bimbingan + 1;
        } else {
            $bimbingan_ke = 1;
        }

        return view('progress.skripsi.create', [
            'skripsi' => $prskripsi,
            'bimbingan_ke' => $bimbingan_ke
        ]);
    }



    public function store(Request $request)
    {
        $pendaftaran_skripsi = PendaftaranSkripsi::where('mahasiswa_nim', Auth::guard("mahasiswa")->user()->nim)->latest()->first();
        dd($pendaftaran_skripsi);
        $dosen = Dosen::where('nip', $pendaftaran_skripsi->pembimbing_1_nip)->first();

        $request->validate([
            'diskusi' => 'required',
            'naskah' => 'mimes:pdf|max:10240',
            'link' => 'required',
            'bab1' => 'required',
        ]);

        $skripsi = new Pr_Skripsi();
        if ($request->naskah) {
            $skripsi->naskah = str_replace('public/', '', $request->file('naskah')->store('file'));
        } else {
            $skripsi->naskah = 'file/1';
        }
        $skripsi->bimbingan = $request->bimbingan_ke;
        $skripsi->pendaftaran_skripsi = $pendaftaran_skripsi->id;
        $skripsi->mahasiswa_nama = Auth::user()->nama;
        $skripsi->mahasiswa_nim = Auth::guard("mahasiswa")->user()->nim;
        $skripsi->pembimbing_nama = $dosen->nama;
        $skripsi->pembimbing_nip = $dosen->nip;
        $skripsi->diskusi = $request->diskusi;
        $skripsi->link = $request->link;
        $skripsi->bab1 = $request->bab1;
        if ($request->bab2) {
            $skripsi->bab2 = $request->bab2;
        }
        if ($request->bab3) {
            $skripsi->bab3 = $request->bab3;
        }
        if ($request->bab4) {
            $skripsi->bab4 = $request->bab4;
        }
        if ($request->bab5) {
            $skripsi->bab5 = $request->bab5;
        }
        $bab1_percent = 0;
        $bab2_percent = 0;
        $bab3_percent = 0;
        $bab4_percent = 0;
        $bab5_percent = 0;

        $array_bab1 = count($request->bab1);

        if ($array_bab1 == 6) {
            $bab1_percent = 6;
        } elseif ($array_bab1 == 5) {
            $bab1_percent = 5;
        } elseif ($array_bab1 == 4) {
            $bab1_percent = 4;
        } elseif ($array_bab1 == 3) {
            $bab1_percent = 3;
        } elseif ($array_bab1 == 2) {
            $bab1_percent = 2;
        } else {
            $bab1_percent = 1;
        }

        if ($request->bab2) {
            $array_bab2 = count($request->bab2);

            if ($array_bab2 == 2) {
                $bab2_percent = 25;
            } else {
                $bab2_percent = 12.5;
            }
        }

        if ($request->bab3) {
            $array_bab3 = count($request->bab3);

            if ($array_bab3 == 2) {
                $bab3_percent = 12;
            } else {
                $bab3_percent = 6;
            }
        }

        if ($request->bab4) {
            $array_bab4 = count($request->bab4);

            if ($array_bab4 == 2) {
                $bab4_percent = 55;
            } else {
                $bab4_percent = 27.5;
            }
        }

        if ($request->bab5) {
            $array_bab5 = count($request->bab5);

            if ($array_bab5 == 2) {
                $bab5_percent = 2;
            } else {
                $bab5_percent = 1;
            }
        }

        $skripsi->progress_report = $bab1_percent + $bab2_percent + $bab3_percent + $bab4_percent + $bab5_percent;

        $skripsi->tanggal = Carbon::now();
        $skripsi->save();

        return redirect("/usuljudul/index")->with('success', 'Progress Report Skripsi created successfully');
    }

    public function skripsiupdate(Request $request)
    {
        $request->validate([
            'diskusi' => 'required',
            'naskah' => 'mimes:pdf|max:10000',
            'bab1' => 'required',
        ]);

        $pendaftaranSkripsi = PendaftaranSkripsi::where('mahasiswa_nim', Auth::guard("mahasiswa")->user()->nim)->latest()->first();

        $skripsi = Pr_Skripsi::where('mahasiswa_nim', Auth::guard("mahasiswa")->user()->nim)->latest()->first();
        $path = public_path('storage/' . $skripsi->naskah);
        if (file_exists($path)) {
            unlink($path);
        }

        $newSkripsi = new Pr_Skripsi();
        $newSkripsi->bimbingan = $request->bimbingan_ke;
        $newSkripsi->pendaftaran_skripsi = $pendaftaranSkripsi->id;
        $newSkripsi->diskusi = $request->diskusi;
        $newSkripsi->mahasiswa_nama = Auth::user()->nama;
        $newSkripsi->mahasiswa_nim = Auth::user()->nim;
        $newSkripsi->pembimbing_nama = $skripsi->pembimbing_nama;
        $newSkripsi->pembimbing_nip = $skripsi->pembimbing_nip;
        $newSkripsi->link = $request->link;
        if ($request->naskah) {
            $newSkripsi->naskah = str_replace('public/', '', $request->file('naskah')->store('file'));
        } else {
            $newSkripsi->naskah = 'file/1';
        }
        $newSkripsi->bab1 = $request->bab1;
        if ($request->bab2) {
            $newSkripsi->bab2 = $request->bab2;
        }
        if ($request->bab3) {
            $newSkripsi->bab3 = $request->bab3;
        }
        if ($request->bab4) {
            $newSkripsi->bab4 = $request->bab4;
        }
        if ($request->bab5) {
            $newSkripsi->bab5 = $request->bab5;
        }

        $bab1_percent = 0;
        $bab2_percent = 0;
        $bab3_percent = 0;
        $bab4_percent = 0;
        $bab5_percent = 0;

        $array_bab1 = count($request->bab1);

        if ($array_bab1 == 6) {
            $bab1_percent = 6;
        } elseif ($array_bab1 == 5) {
            $bab1_percent = 5;
        } elseif ($array_bab1 == 4) {
            $bab1_percent = 4;
        } elseif ($array_bab1 == 3) {
            $bab1_percent = 3;
        } elseif ($array_bab1 == 2) {
            $bab1_percent = 2;
        } else {
            $bab1_percent = 1;
        }


        if ($request->bab2) {
            $array_bab2 = count($request->bab2);

            if ($array_bab2 == 2) {
                $bab2_percent = 25;
            } else {
                $bab2_percent = 12.5;
            }
        }

        if ($request->bab3) {
            $array_bab3 = count($request->bab3);

            if ($array_bab3 == 2) {
                $bab3_percent = 12;
            } else {
                $bab3_percent = 6;
            }
        }

        if ($request->bab4) {
            $array_bab4 = count($request->bab4);

            if ($array_bab4 == 2) {
                $bab4_percent = 55;
            } else {
                $bab4_percent = 27.5;
            }
        }
        if ($request->bab5) {
            $array_bab5 = count($request->bab5);

            if ($array_bab5 == 2) {
                $bab5_percent = 2;
            } else {
                $bab5_percent = 1;
            }
        }

        $newSkripsi->progress_report = $bab1_percent + $bab2_percent + $bab3_percent + $bab4_percent + $bab5_percent;
        $newSkripsi->tanggal = Carbon::now();

        $newSkripsi->save();

        return redirect('usuljudul/index')->with('success', 'Skripsi created successfully');
    }
}
