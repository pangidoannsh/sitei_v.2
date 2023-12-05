<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\JamKam;
use App\Models\JamSel;
use App\Models\Ruangan;
use App\Models\JamKPKam;
use App\Models\JamKPSel;
use App\Models\Jadwalkan;
use Illuminate\Http\Request;
use App\Models\PenjadwalanKP;
use App\Models\PenjadwalanSempro;
use App\Models\PendaftaranSkripsi;
use App\Models\PenjadwalanSkripsi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JadwalkanController extends Controller
{

    private function setJadwal(
        $list_mahasiswa = [],
        $list_active_day = [],
        $list_active_time = [],
        $dateStart,
        $addWeeks = 0,
        $jenis_seminar
    ){
        $list_ruangan = Ruangan::all();
        foreach($list_mahasiswa as $mahasiswa){
            $isUpdated = false;
            $addWeek = $addWeeks;
            while(!$isUpdated){
                for($i=0;$i<count($list_active_day);$i++){
                    if($isUpdated){
                        break;
                    }
                    $active_day = $list_active_day[$i];
                    $dateSchedule = new Carbon($dateStart);
                    $dateSchedule->addWeek($addWeek);
                    $dateSchedule->addDay($active_day);
                    foreach($list_active_time[$i] as $active_time){
                        if($isUpdated){
                            break;
                        }
                        $isScheduled = false;
                        $timeSchedule = new Carbon($dateSchedule->format("Y-m-d {$active_time}"));
                        $timeSchedule_end = new Carbon($timeSchedule);
                        if($jenis_seminar === "KP"){
                            $timeSchedule_end->addMinutes(30);
                        }
                        else{
                            $timeSchedule_end->addHour();
                        }
                        $check_jadwal_skripsi = PenjadwalanSkripsi::where('tanggal', $dateSchedule)->get();
                        foreach($check_jadwal_skripsi as $check_waktu_skripsi){
                            $tanggal_seminar = new Carbon($check_waktu_skripsi['tanggal']);
                            $waktu = explode(" - ", $check_waktu_skripsi->waktu);
                            $waktu_mulai = new Carbon($tanggal_seminar->format("Y-m-d {$waktu[0]}"));
                            $waktu_selesai = new Carbon($tanggal_seminar->format("Y-m-d {$waktu[1]}"));
                            if(($timeSchedule >= $waktu_mulai && $timeSchedule < $waktu_selesai) || ($timeSchedule_end > $waktu_mulai && $timeSchedule_end <= $waktu_selesai)){
                                $nip_scheduled = [
                                    $check_waktu_skripsi->pembimbingsatu_nip,
                                    $check_waktu_skripsi->pembimbingdua_nip,
                                    $check_waktu_skripsi->pengujisatu_nip,
                                    $check_waktu_skripsi->pengujidua_nip,
                                    $check_waktu_skripsi->pengujitiga_nip,
                                ];
                                $nip_will_schedule = [];
                                if ($jenis_seminar == "KP"){
                                    $nip_will_schedule = [
                                        $mahasiswa->pembimbing_nip,
                                        $mahasiswa->penguji_nip,
                                    ];
                                }else {
                                    $nip_will_schedule = [
                                        $mahasiswa->pembimbingsatu_nip,
                                        $mahasiswa->pembimbingdua_nip,
                                        $mahasiswa->pengujisatu_nip,
                                        $mahasiswa->pengujidua_nip,
                                        $mahasiswa->pengujitiga_nip,
                                    ];
                                }
                                if (array_intersect($nip_scheduled, $nip_will_schedule)){
                                    $isScheduled = true;
                                }
                            }
                        }
                        $check_jadwal_sempro = PenjadwalanSempro::where('tanggal', $dateSchedule)->get();
                        foreach($check_jadwal_sempro as $check_waktu_sempro){
                            $tanggal_seminar = new Carbon($check_waktu_sempro['tanggal']);
                            $waktu = explode(" - ", $check_waktu_sempro->waktu);
                            $waktu_mulai = new Carbon($tanggal_seminar->format("Y-m-d {$waktu[0]}"));
                            $waktu_selesai = new Carbon($tanggal_seminar->format("Y-m-d {$waktu[1]}"));
                            if(($timeSchedule >= $waktu_mulai && $timeSchedule < $waktu_selesai) || ($timeSchedule_end > $waktu_mulai && $timeSchedule_end <= $waktu_selesai)){
                                $nip_scheduled = [
                                    $check_waktu_sempro->pembimbingsatu_nip,
                                    $check_waktu_sempro->pembimbingdua_nip,
                                    $check_waktu_sempro->pengujisatu_nip,
                                    $check_waktu_sempro->pengujidua_nip,
                                    $check_waktu_sempro->pengujitiga_nip,
                                ];
                                $nip_will_schedule = [];
                                if ($jenis_seminar == "KP"){
                                    $nip_will_schedule = [
                                        $mahasiswa->pembimbing_nip,
                                        $mahasiswa->penguji_nip,
                                    ];
                                }else {
                                    $nip_will_schedule = [
                                        $mahasiswa->pembimbingsatu_nip,
                                        $mahasiswa->pembimbingdua_nip,
                                        $mahasiswa->pengujisatu_nip,
                                        $mahasiswa->pengujidua_nip,
                                        $mahasiswa->pengujitiga_nip,
                                    ];
                                }
                                if (array_intersect($nip_scheduled, $nip_will_schedule)){
                                    $isScheduled = true;
                                }
                            }
                        }
                        $check_jadwal_kp = PenjadwalanKP::where('tanggal', $dateSchedule)->get();
                        foreach($check_jadwal_kp as $check_waktu_kp){
                            $tanggal_seminar = new Carbon($check_waktu_kp['tanggal']);
                            $waktu = explode(" - ", $check_waktu_kp->waktu);
                            $waktu_mulai = new Carbon($tanggal_seminar->format("Y-m-d {$waktu[0]}"));
                            $waktu_selesai = new Carbon($tanggal_seminar->format("Y-m-d {$waktu[1]}"));
                            if(($timeSchedule >= $waktu_mulai && $timeSchedule < $waktu_selesai) || ($timeSchedule_end > $waktu_mulai && $timeSchedule_end <= $waktu_selesai)){
                                $nip_scheduled = [
                                    $check_waktu_kp->pembimbing_nip,
                                    $check_waktu_kp->penguji_nip,
                                ];
                                $nip_will_schedule = [];
                                if ($jenis_seminar == "KP"){
                                    $nip_will_schedule = [
                                        $mahasiswa->pembimbing_nip,
                                        $mahasiswa->penguji_nip,
                                    ];
                                }else {
                                    $nip_will_schedule = [
                                        $mahasiswa->pembimbingsatu_nip,
                                        $mahasiswa->pembimbingdua_nip,
                                        $mahasiswa->pengujisatu_nip,
                                        $mahasiswa->pengujidua_nip,
                                        $mahasiswa->pengujitiga_nip,
                                    ];
                                }
                                if (array_intersect($nip_scheduled, $nip_will_schedule)){
                                    $isScheduled = true;
                                }
                            }
                        }
                        if($isScheduled){
                            continue;
                        }
        
                        $update = $mahasiswa->update([
                            'tanggal' => $dateSchedule,
                            'waktu' => $timeSchedule->toTimeString() . " - " . $timeSchedule_end->toTimeString(),
                            'lokasi' => $list_ruangan[rand(0,4)]->nama_ruangan
                        ]);

                        if($update){
                            $isUpdated = true;
                        }
                    }
                }
                $addWeek++;
            }
        }
    }

    // private function setJadwal(
    //     $jlh_mahasiswa = [],
    //     $list_active_day = [], 
    //     $list_active_time = [],
    //     $dateStart,
    //     $addWeek = 0,
    //     $nextRuanganIndex = 0
    // ) {
    //     $scheduleTime = []; // tampung ruangan disini;
    //     $ruangan_list = Ruangan::all()->toArray();
    //     if(count($ruangan_list) < $nextRuanganIndex + 1) {
    //         $nextRuanganIndex = 0;
    //     }

    //     for($day = 0; $day < count($list_active_day); $day++) {
    //         $active_day = $list_active_day[$day];
    //         $dateSchedule = new Carbon($dateStart);
    //         $dateSchedule->addWeek($addWeek);
    //         $dateSchedule->addDay($active_day);
    //         // $endForEach = 0;

    //         // for ($i=0; $i<round(count($jlh_mahasiswa)/2); $i++){
    //         //     $active_time = $list_active_time[$day][$i];
    //         //     $timeSchedule = new Carbon($dateSchedule->format("Y-m-d {$active_time}"));
    //         //     $ruanganIndex = $nextRuanganIndex;
    //         //     $keepRuangan = true;
    //         //     while($keepRuangan) {
    //         //         $ruangan = $ruangan_list[$ruanganIndex];
    //         //         $scheduleTime[] = [
    //         //             "id_ruangan" => $ruangan["id"],
    //         //             "nama_ruangan" => $ruangan["nama_ruangan"],
    //         //             "tanggal" => $timeSchedule->format("Y-m-d"),
    //         //             "waktu" => $timeSchedule->format("H:i"),
    //         //         ];
    //         //         $ruanganIndex++;
    //         //         $keepRuangan = false;
    //         //     }
    //         // }

    //         foreach($list_active_time[$day] as $active_time) {
    //             // if ($endForEach == round(count($jlh_mahasiswa)/2)){
    //             //     break;
    //             // }
    //             $isScheduled = false;
    //             $timeSchedule = new Carbon($dateSchedule->format("Y-m-d {$active_time}"));
    //             $timeSchedule_end = new Carbon($timeSchedule);
    //             $timeSchedule_end->addMinutes(30);
    //             $check_jadwal_sempro = PenjadwalanSempro::where('tanggal', $dateSchedule)->get();
    //             foreach($check_jadwal_sempro as $check_waktu_sempro){
    //                 $tanggal_seminar = new Carbon($check_waktu_sempro['tanggal']);
    //                 $waktu = explode(" - ", $check_waktu_sempro->waktu);
    //                 $waktu_mulai = new Carbon($tanggal_seminar->format("Y-m-d {$waktu[0]}"));
    //                 $waktu_selesai = new Carbon($tanggal_seminar->format("Y-m-d {$waktu[1]}"));
    //                 if(($timeSchedule >= $waktu_mulai && $timeSchedule < $waktu_selesai) || ($timeSchedule_end > $waktu_mulai && $timeSchedule_end <= $waktu_selesai)){
    //                     $isScheduled = true;
    //                 }
    //             }
    //             $check_jadwal_skripsi = PenjadwalanSkripsi::where('tanggal', $dateSchedule)->get();
    //             foreach($check_jadwal_skripsi as $check_waktu_skripsi){
    //                 $tanggal_seminar = new Carbon($check_waktu_skripsi['tanggal']);
    //                 $waktu = explode(" - ", $check_waktu_skripsi->waktu);
    //                 $waktu_mulai = new Carbon($tanggal_seminar->format("Y-m-d {$waktu[0]}"));
    //                 $waktu_selesai = new Carbon($tanggal_seminar->format("Y-m-d {$waktu[1]}"));
    //                 if(($timeSchedule >= $waktu_mulai && $timeSchedule < $waktu_selesai) || ($timeSchedule_end > $waktu_mulai && $timeSchedule_end <= $waktu_selesai)){
    //                     $isScheduled = true;
    //                 }
    //             }
    //             if($isScheduled){
    //                 continue;
    //             }
    //             $check_jadwal_kp = PenjadwalanKP::where('tanggal', $dateSchedule)->get();
    //             foreach($check_jadwal_kp as $check_waktu_kp){
    //                 $tanggal_seminar = new Carbon($check_waktu_kp['tanggal']);
    //                 $waktu = explode(" - ", $check_waktu_kp->waktu);
    //                 $waktu_mulai = new Carbon($tanggal_seminar->format("Y-m-d {$waktu[0]}"));
    //                 $waktu_selesai = new Carbon($tanggal_seminar->format("Y-m-d {$waktu[1]}"));
    //                 if(($timeSchedule >= $waktu_mulai && $timeSchedule < $waktu_selesai) || ($timeSchedule_end > $waktu_mulai && $timeSchedule_end <= $waktu_selesai)){
    //                     $isScheduled = true;
    //                 }
    //             }
    //             if($isScheduled){
    //                 continue;
    //             }
                
    //             $ruanganIndex = $nextRuanganIndex;
    //             $keepRuangan = true;
    //             while($keepRuangan) {
    //                 $ruangan = $ruangan_list[rand(0,4)];
    //                 $scheduleTime[] = [
    //                     "id_ruangan" => $ruangan["id"],
    //                     "nama_ruangan" => $ruangan["nama_ruangan"],
    //                     "tanggal" => $timeSchedule->format("Y-m-d"),
    //                     "waktu" => $timeSchedule->format("H:i"),
    //                 ];
    //                 $ruanganIndex++;
    //                 $keepRuangan = false;
    //             }
    //             // $endForEach++;
    //         }
    //         // var_dump($dateSchedule->format("Y-m-d H:i"));
    //     }

    //     return [
    //         "nextIndexRuangan" => $nextRuanganIndex,
    //         "nextWeek" => $addWeek + 1,
    //         "schedule" => $scheduleTime,
    //     ];
    // }

    public function index(Request $request, PenjadwalanSkripsi $penjadwalan_skripsi)
    {

        // $penjadwalan_skripsi = PenjadwalanSkripsi::find($id);
        
        // $pendaftaran_skripsi = PendaftaranSkripsi::where('mahasiswa_nim', $penjadwalan_skripsi->mahasiswa_nim )->latest('created_at')->first();

        // $pendaftaran_skripsi->status_skripsi = 'SIDANG DIJADWALKAN';
        // $pendaftaran_skripsi->keterangan = 'Sidang Skripsi Dijadwalkan';
        // $pendaftaran_skripsi->tgl_disetujui_jadwal_sidang = Carbon::now();
        // $pendaftaran_skripsi->update();

        $now = Carbon::now();
        $weekStartDate = Carbon::now()->startOfWeek()->format('Y-m-d H:i');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');

        $addWeek = 0;
        $selasa = new Carbon($weekStartDate);
        $selasa->addDays(1);
        if ($now >= $selasa){
            $addWeek = 1;
        }

        $skripsiActiveDay = [1,3];
        $skripsiActiveTime = [
            ["08:00","09:30","11:00"],
            ["13:00","14:30","16:00"],
        ];

        $kpActiveDay = [1,3];
        $kpActiveTime = [
            ["08:00","08:45","09:30","10:15","11:00"],
            ["13:00","13:45","14:30","15:15"],
        ];

        $list_mahasiswa_skripsi = PenjadwalanSkripsi::where('tanggal', NULL)->get();
        $skripsi = $this->setJadwal(
            $list_mahasiswa_skripsi,
            $skripsiActiveDay,
            $skripsiActiveTime,
            $weekStartDate,
            $addWeek,
            "Skripsi"
        );
        $list_mahasiswa_sempro = PenjadwalanSempro::where('tanggal', NULL)->get();
        $this->setJadwal(
            $list_mahasiswa_sempro,
            $skripsiActiveDay,
            $skripsiActiveTime,
            $weekStartDate,
            $addWeek,
            "Sempro"
        );
        $list_mahasiswa_kp = PenjadwalanKP:: where('tanggal', NULL)->get();
        $this->setJadwal(
            $list_mahasiswa_kp,
            $kpActiveDay,
            $kpActiveTime,
            $weekStartDate,
            $addWeek,
            "KP"
        );

        

        return redirect()->route('form');
        // $now = Carbon::now();
        // $weekStartDate = Carbon::now()->startOfWeek()->format('Y-m-d H:i');
        // $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');

        
        // // START : JADWAL SEMPRO DAN SIDANG
        // $skripsi_list = PenjadwalanSkripsi::where('tanggal', NULL)
        // ->where("lokasi", null)
        // ->orderBy('created_at', 'ASC')->get()->toArray();
        // $sempro_list = PenjadwalanSempro::where('tanggal', NULL)
        // ->where("lokasi", null)
        // ->orderBy('created_at', 'ASC')->get()->toArray();

        // $mhsSemproSidang = [];
        // foreach($skripsi_list as $skripsi) {
        //     $mhsSemproSidang[] = [
        //         "id" => $skripsi["id"],
        //         "status" => "skripsi"
        //     ];
        // }
        // foreach($sempro_list as $sempro) {
        //     $mhsSemproSidang[] = [
        //         "id" => $sempro["id"],
        //         "status" => "sempro"
        //     ];
        // }
        
        // $keepSetSchedule = count($mhsSemproSidang) > 0;
        // $mhsJadwalSemproSidang = [];
        // $skripsiActiveDay = [1,3];
        // $skripsiActiveTime = [
        //     ["08:00","09:30","11:00"],
        //     ["13:00","14:30","16:00"],
        // ];

        // $addWeek = 0;
        // $selasa = new Carbon($weekStartDate);
        // if ($now >= $selasa->addDay(1)){
        //     $addWeek = 1;
        // }

        // $scheduleSkripsi = $this->setJadwal(
        //     $mhsSemproSidang,
        //     $skripsiActiveDay,
        //     $skripsiActiveTime,
        //     $weekStartDate,
        //     0,
        //     0,
        // );
        // while($keepSetSchedule) {
        //     for($s = 0; $s < count($scheduleSkripsi["schedule"]); $s++) {
        //         $schedule = $scheduleSkripsi["schedule"][$s];
        //         $waktu = new Carbon($schedule["tanggal"]." ".$schedule["waktu"]);
        //         $waktu->addHour(1);
        //         if(!isset($mhsSemproSidang[count($mhsJadwalSemproSidang)])) {
        //             continue;
        //         }
        //         $mhsJadwalSemproSidang[] = [
        //             "id_mhs" => $mhsSemproSidang[count($mhsJadwalSemproSidang)]["id"],
        //             "status" => $mhsSemproSidang[count($mhsJadwalSemproSidang)]["status"],
        //             "tanggal" => $schedule["tanggal"],
        //             "waktu" => $schedule["waktu"]." - ".$waktu->format("H:i"),
        //             "lokasi" => $schedule["nama_ruangan"],
        //         ];
        //     }
            
        //     if(count($mhsJadwalSemproSidang) >= count($mhsSemproSidang)) {
        //         $keepSetSchedule = false;
        //     }
        //     else {
        //         for($i=0;$i<count($mhsJadwalSemproSidang);$i++){
        //             unset($mhsSemproSidang[$i]);
        //         }
        //         $scheduleSkripsi = $this->setJadwal(
        //             $mhsSemproSidang,
        //             $skripsiActiveDay,
        //             $skripsiActiveTime,
        //             $weekStartDate,
        //             $addWeek+1,
        //             0,
        //         );
        //     }
        // }
        // foreach($mhsJadwalSemproSidang as $mhs) {
        //     if($mhs["status"] == "sempro") {
        //         $jadwal = PenjadwalanSempro::find($mhs["id_mhs"]);
        //         $jadwal->tanggal = $mhs["tanggal"];
        //         $jadwal->waktu = $mhs["waktu"];
        //         $jadwal->lokasi = $mhs["lokasi"];

        //         $jadwal->save();
        //     }
        //     if($mhs["status"] == "skripsi") {
        //         $jadwal = PenjadwalanSkripsi::find($mhs["id_mhs"]);
        //         $jadwal->tanggal = $mhs["tanggal"];
        //         $jadwal->waktu = $mhs["waktu"];
        //         $jadwal->lokasi = $mhs["lokasi"];

        //         $jadwal->save();
        //     }
        // }
        // // END : JADWAL SEMPRO DAN SIDANG


        // // START : JADWAL KP
        // $lastUsedWeek = $scheduleSkripsi["nextWeek"];
        // $kpDateStart = new Carbon($weekStartDate);
        // // $kpDateStart->addWeek($lastUsedWeek);
        // $kpActiveDay = [1,3];
        // $kpActiveTime = [
        //     ["08:00","08:45","09:30","10:15","11:00"],
        //     ["13:00","13:45","14:30","15:15"],
        // ];

        // $kpList = PenjadwalanKP::where('tanggal', NULL)
        // ->orderBy('created_at', 'ASC')->get()->toArray();
        // $mhsKp = [];
        // foreach($kpList as $kp) {
        //     $mhsKp[] = [
        //         "id" => $kp["id"],
        //         "status" => "kp"
        //     ];
        // }

        // if (count($mhsKp) > 0){
        //     $scheduleKp = $this->setJadwal(
        //         $mhsKp,
        //         $kpActiveDay,
        //         $kpActiveTime,
        //         $kpDateStart,
        //         $addWeek,
        //         0,
        //     );

        //     // return $scheduleKp;
    
        //     $keepSetScheduleKp = count($mhsKp) > 0;
        //     $mhsJadwalKp = [];
        //     while($keepSetScheduleKp) {
        //         for($s = 0; $s < count($scheduleKp["schedule"]); $s++) {
        //             $schedule = $scheduleKp["schedule"][$s];
        //             $waktu = new Carbon($schedule["tanggal"]." ".$schedule["waktu"]);
        //             $waktu->addMinute(30);
        //             if(!isset($mhsKp[count($mhsJadwalKp)])) {
        //                 continue;
        //             }
        //             $mhsJadwalKp[] = [
        //                 "id_mhs" => $mhsKp[count($mhsJadwalKp)]["id"],
        //                 "status" => $mhsKp[count($mhsJadwalKp)]["status"],
        //                 "tanggal" => $schedule["tanggal"],
        //                 "waktu" => $schedule["waktu"]." - ".$waktu->format("H:i"),
        //                 "lokasi" => $schedule["nama_ruangan"],
        //             ];
        //         }
        //         if(count($mhsJadwalKp) >= count($mhsKp)) {
        //             $keepSetScheduleKp = false;
        //         }
        //         else {
        //             for($i=0;$i<count($mhsJadwalKp);$i++){
        //                 unset($mhsKp[$i]);
        //             }
        //             $scheduleKp = $this->setJadwal(
        //                 $mhsKp,
        //                 $kpActiveDay,
        //                 $kpActiveTime,
        //                 $kpDateStart,
        //                 $addWeek+1,
        //                 0,
        //             );
        //         }
        //     }
        //     foreach($mhsJadwalKp as $mhs) {
        //         $jadwal = PenjadwalanKP::find($mhs["id_mhs"]);
        //         $jadwal->tanggal = $mhs["tanggal"];
        //         $jadwal->waktu = $mhs["waktu"];
        //         $jadwal->lokasi = $mhs["lokasi"];
    
        //         $jadwal->save();
        //     }
        // }

        // // START : JADWAL KP


        // return view('jadwalkan.index', [
        //     'role' => Role::all(),
        //     'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 0)->orderBy('created_at', 'ASC')->get(),
        //     'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 0)->orderBy('created_at', 'ASC')->get(),
        //     'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 0)->orderBy('created_at', 'ASC')->get(),
        //     'ruangan_id' => 1,
        //     'start' => $now->startOfWeek(Carbon::THURSDAY),
        //     'ruangans' => Ruangan::all(),
        //     'jamkpsels' => JamKPSel::all(),
        //     'jamkpkams' => JamKPKam::all(),
        //     'jamsels' => JamSel::all(),
        //     'jamkams' => JamKam::all(),  
        // ]);
        
    }

    
    public function edit(Jadwalkan $jadwalkan)
    {
        return view('jadwalkan.edit', [
            'jadwalkan' => $jadwalkan,
        ]);
    }

    public function update(Request $request, PenjadwalanKP $penjadwalan_kp)
    {
        $rules = [
            'mahasiswa_nim' => 'required',
            'pembimbing_nip' => 'required',
            'prodi_id' => 'required',                        
            'judul_kp' => 'required',
        ];
        $validated = $request->validate($rules);
        $validated['dibuat_oleh'] = auth()->user()->username;
        if ($request->tanggal != $penjadwalan_kp->tanggal) 
        {
            if ($request->waktu != $penjadwalan_kp->waktu)
            {
                if ($request->lokasi != $penjadwalan_kp->lokasi)
                {
                    if ($request->penguji_nip != $penjadwalan_kp->penguji_nip)
                    {
                        $validated = $request->validate([
                            'penguji_nip' => ['required', 'unique:jadwalkan'],
                        ]);
                    }
                $validated = $request->validate([
                    'lokasi' => ['required', 'unique:jadwalkan'],
                ]);
                }
            $validated = $request->validate([
                'waktu' => ['required', 'unique:jadwalkan'],
            ]);
            }
        $validated = $request->validate([
            'tanggal' => ['required', 'unique:jadwalkan'],
        ]);

            PenjadwalanKP::where('id', $penjadwalan_kp->id)
                ->update($validated);
            return redirect('/jadwalkan')->with('message', 'Data Berhasil Diubah!');
        } 
        else
        {
            return redirect('/jadwalkan')->with('message', 'Data Berhasil Diubah!');
        }
    }
    
    public function hitung()
    {
        $hitungkp = DB::table('penjadwalan_kp')->count();
        $hitungsempro = DB::table('penjadwalan_sempro')->count();
        $hitungskripsi = DB::table('penjadwalan_skripsi')->count();
        $totalsempro_skripsi = $hitungsempro + $hitungskripsi;
    }

}
