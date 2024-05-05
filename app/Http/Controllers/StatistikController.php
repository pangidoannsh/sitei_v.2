<?php

namespace App\Http\Controllers;


use DateTime;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Semester;
use App\Models\Mahasiswa;
use App\Models\Konsentrasi;
use App\Models\PendaftaranKP;
use Illuminate\Support\Carbon;
use App\Models\KapasitasBimbingan;
use App\Models\PendaftaranSkripsi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StatistikController extends Controller
{

    public function index() 
    {
        // ----------------------------------DATA SKRIPSI TEKNIK INFORMATIKA S1---------------------------- //

        $skripsiInformatikaStatuses = [
            'BELUM SEMPRO' => ['USULAN JUDUL','JUDUL DISETUJUI', 'USULAN JUDUL DISETUJUI', 'DAFTAR SEMPRO', 'DAFTAR SEMPRO DISETUJUI', 'SEMPRO DIJADWALKAN'],
            'SUDAH SEMPRO' => ['SEMPRO SELESAI','PERPANJANGAN 1','PERPANJANGAN 2', 'DAFTAR SIDANG', 'DAFTAR SIDANG DISETUJUI', 'SIDANG DIJADWALKAN'],
            'SUDAH SIDANG' => ['SIDANG SELESAI','PERPANJANGAN REVISI DISETUJUI','PERPANJANGAN 1 DISETUJUI','PERPANJANGAN 2 DISETUJUI','SKRIPSI SELESAI','BUKTI PENYERAHAN BUKU SKRIPSI']
        ];

        $kpInformatikaStatuses = [
            'SEDANG KP' => ['USULAN KP', 'SURAT PERUSAHAAN', 'DAFTAR SEMINAR KP', 'BUKTI PENYERAHAN LAPORAN', 'SEMINAR KP DIJADWALKAN','USULAN KP DITERIMA','KP DISETUJUI','DAFTAR SEMINAR KP DISETUJUI'],
            'SUDAH SEMINAR' => ['SEMINAR KP SELESAI'],
        ];

        $skripsiData = [];
        $totalSkripsi = 0;

        $kpData = [];
        $totalKp = 0;

        // Ambil data prodi yang ID-nya 1, 2, atau 3
        $prodis = Prodi::whereIn('id', [1, 2, 3])->pluck('id')->toArray();
        
        // Inisialisasi data skripsi untuk setiap prodi
        $skripsiDataByProdi = [];

        // Inisialisasi data kp untuk setiap prodi
        $kpDataByProdi = [];
        
        foreach ($prodis as $prodiId) {
            $skripsiDataByProdi[$prodiId] = [
                'total' => 0,
                'statuses' => []
            ];
        }

        foreach ($prodis as $prodiId) {
            $kpDataByProdi[$prodiId] = [
                'total' => 0,
                'statuses' => []
            ];
        }
        
        // Hitung total skripsi untuk setiap status dan prodi
        foreach ($skripsiInformatikaStatuses as $status => $subStatuses) {
            foreach ($prodis as $prodiId) {
                $count = 0;
                foreach ($subStatuses as $subStatus) {
                    $count += PendaftaranSkripsi::where('status_skripsi', $subStatus)
                                                ->where('prodi_id', $prodiId)
                                                ->count();
                }
                $skripsiDataByProdi[$prodiId]['statuses'][$status] = $count;
                $skripsiDataByProdi[$prodiId]['total'] += $count;
            }
        }

        // Hitung total kp untuk setiap status dan prodi
        foreach ($kpInformatikaStatuses as $status => $subStatuses) {
            foreach ($prodis as $prodiId) {
                $count = 0;
                foreach ($subStatuses as $subStatus) {
                    $count += PendaftaranKP::where('status_kp', $subStatus)
                                                ->where('prodi_id', $prodiId)
                                                ->count();
                }
                $kpDataByProdi[$prodiId]['statuses'][$status] = $count;
                $kpDataByProdi[$prodiId]['total'] += $count;
            }
        }

        // Inisialisasi data skripsi per angkatan
        $skripsiDataInformatikaByAngkatan = [];

        // Inisialisasi data kp per angkatan
        $kpDataInformatikaByAngkatan = [];

        // Ambil data skripsi untuk prodi Teknik Informatika S1 (ID 3)
        $teknikInformatikaData = $skripsiDataByProdi[3];

        // Ambil data kp untuk prodi Teknik Informatika S1 (ID 3)
        $teknikInformatikaDataKp = $kpDataByProdi[3];

        // Ambil data mahasiswa untuk mendapatkan daftar angkatan
        $angkatanInformatikaList = Mahasiswa::distinct('angkatan')->pluck('angkatan')->toArray();

        // Ambil data mahasiswa untuk mendapatkan daftar angkatan (untuk KP)
        $angkatanInformatikaListKp = Mahasiswa::distinct('angkatan')->pluck('angkatan')->toArray();

        // Urutkan tahun angkatan dari terkecil ke terbesar
        sort($angkatanInformatikaList);

        // Batasi jumlah tahun angkatan yang ditampilkan maksimal 7 tahun terbaru
        $angkatanInformatikaList = array_slice($angkatanInformatikaList, -7, 7);
        
        // Urutkan tahun angkatan dari terkecil ke terbesar (untuk KP)
        sort($angkatanInformatikaListKp);

        // Batasi jumlah tahun angkatan yang ditampilkan maksimal 7 tahun terbaru
        $angkatanInformatikaListKp = array_slice($angkatanInformatikaListKp, -7, 7);

        // Hitung jumlah skripsi untuk setiap angkatan dan status
        foreach ($angkatanInformatikaList as $angkatan) {
            $skripsiDataInformatikaByAngkatan[$angkatan] = [];
            foreach ($skripsiInformatikaStatuses as $status => $subStatuses) {
                $count = 0;
                foreach ($subStatuses as $subStatus) {
                    $count += PendaftaranSkripsi::where('status_skripsi', $subStatus)
                                                ->whereHas('mahasiswa', function ($query) use ($angkatan) {
                                                    $query->where('angkatan', $angkatan)
                                                    ->where('prodi_id', 3); // Ganti dengan ID prodi Teknik Informatika
                                                })
                                                ->count();
                }
                $skripsiDataInformatikaByAngkatan[$angkatan][$status] = $count;
            }
        }

        // Hitung jumlah kp untuk setiap angkatan dan status
        foreach ($angkatanInformatikaListKp as $angkatan) {
            $kpDataInformatikaByAngkatan[$angkatan] = [];
            foreach ($kpInformatikaStatuses as $status => $subStatuses) {
                $count = 0;
                foreach ($subStatuses as $subStatus) {
                    $count += PendaftaranKP::where('status_kp', $subStatus)
                                                ->whereHas('mahasiswa', function ($query) use ($angkatan) {
                                                    $query->where('angkatan', $angkatan)
                                                    ->where('prodi_id', 3); // Ganti dengan ID prodi Teknik Informatika
                                                })
                                                ->count();
                }
                $kpDataInformatikaByAngkatan[$angkatan][$status] = $count;
            }
        }
        
        // Ambil data semester untuk 7 tahun terakhir dari yang terbaru dan urutkan dari terkecil ke terbesar
        $latestSemesters = Semester::orderBy('tahun_ajaran', 'asc')
            ->take(14) // Ambil 14 data teratas
            ->get();

        // Inisialisasi array untuk menyimpan jumlah lulusan per tahun
        $jumlahLulusanPerTahun = [];

        // Mengisi data jumlah lulusan per tahun
        foreach ($latestSemesters as $semester) {
            $tahunAjaran = $semester->tahun_ajaran;

            // Gabungkan jumlah lulusan semester ganjil dan genap dari tahun ajaran yang sama
            if (!isset($jumlahLulusanPerTahun[$tahunAjaran])) {
                $jumlahLulusanPerTahun[$tahunAjaran] = 0;
            }

            // Mengambil jumlah lulusan dari prodi Teknik Informatika dengan prodi_id 3
            $jumlahLulusanPerTahun[$tahunAjaran] += PendaftaranSkripsi::whereBetween('tgl_disetujui_sti_17_koordinator', [$semester->tanggal_mulai, $semester->tanggal_selesai])
                ->where('prodi_id', 3) // Sesuaikan dengan prodi_id Teknik Informatika
                ->count();
        }

        // Buat array yang sesuai dengan format yang dibutuhkan oleh chart JS
        $chartData = [];
        foreach ($jumlahLulusanPerTahun as $tahun => $jumlahLulusan) {
            // Ubah format tahun ajaran menjadi semester (2017/2018, 2018/2019, dst)
            $tahunAjaran = substr($tahun, 0, 4) . '/' . substr($tahun, 5, 4);
            $chartData[] = [
                'tahun' => $tahunAjaran,
                'jumlah_lulusan' => $jumlahLulusan
            ];
        }

        // Ambil data semester untuk 7 tahun terakhir dari yang terbaru dan urutkan dari terkecil ke terbesar
        $latestSemesters = Semester::orderBy('tahun_ajaran', 'asc')
            ->take(14) // Ambil 14 data teratas
            ->get();

        // Inisialisasi array untuk menyimpan jumlah lulusan per tahun
        $jumlahLulusanPerTahun = [];
        // Inisialisasi array untuk menyimpan rerata durasi per semester
        $rataRataDurasiPerSemester = [];

        // Loop melalui setiap semester
        foreach ($latestSemesters as $semester) {
            $tahunAjaran = $semester->tahun_ajaran;

            // Gabungkan jumlah lulusan semester ganjil dan genap dari tahun ajaran yang sama
            if (!isset($jumlahLulusanPerTahun[$tahunAjaran])) {
                $jumlahLulusanPerTahun[$tahunAjaran] = 0;
            }

            // Mengambil jumlah lulusan dari prodi Teknik Informatika dengan prodi_id 3
            $jumlahLulusanPerTahun[$tahunAjaran] += PendaftaranSkripsi::whereBetween('tgl_disetujui_sti_17_koordinator', [$semester->tanggal_mulai, $semester->tanggal_selesai])
                ->where('prodi_id', 3) // Sesuaikan dengan prodi_id Teknik Informatika
                ->count();

            // Ambil data mahasiswa yang lulus pada semester ini
            $mahasiswas = PendaftaranSkripsi::whereBetween('tgl_disetujui_sti_17_koordinator', [$semester->tanggal_mulai, $semester->tanggal_selesai])
                ->where('prodi_id', 3) // Sesuaikan dengan prodi_id Teknik Informatika
                ->get();

            $totalDurasi = 0;
            $jumlahMahasiswa = $mahasiswas->count();

            // Hitung total durasi pengerjaan skripsi per mahasiswa
            foreach ($mahasiswas as $mahasiswa) {
                $tanggalMulai = Carbon::parse($mahasiswa->tgl_disetujui_usuljudul_kaprodi);
                $tanggalDisetujui = Carbon::parse($mahasiswa->tgl_disetujui_sti_17_koordinator);
                
                // Mengambil durasi skripsi dalam bulan dan hari
                $durasiSkripsi = $tanggalMulai->diffInMonths($tanggalDisetujui); // Mengambil durasi dalam bulan
                $bulan = floor($durasiSkripsi); // Bagian bulan
                $hari = $tanggalMulai->addMonths($bulan)->diffInDays($tanggalDisetujui); // Bagian hari
                
                // Menambahkan durasi ke total durasi
                $totalDurasi += $bulan + ($hari / 30); // Menghitung total dalam bulan
            }


            // Hitung rerata durasi per semester
            $rataRataDurasi = $jumlahMahasiswa > 0 ? ($totalDurasi / $jumlahMahasiswa) : 0;

            // Tambahkan data ke array rerata durasi per semester
            $rataRataDurasiPerSemester[$tahunAjaran] = $rataRataDurasi;
        }

        // Buat array yang sesuai dengan format yang dibutuhkan oleh chart JS
        $chartData = [];
        foreach ($jumlahLulusanPerTahun as $tahun => $jumlahLulusan) {
            // Ubah format tahun ajaran menjadi semester (2017/2018, 2018/2019, dst)
            $tahunAjaran = substr($tahun, 0, 4) . '/' . substr($tahun, 5, 4);
            $chartData[] = [
                'tahun' => $tahunAjaran,
                'jumlah_lulusan' => $jumlahLulusan,
                'rerata_durasi' => $rataRataDurasiPerSemester[$tahun]
            ];
        }

        // ----------------------------------DATA SKRIPSI TEKNIK ELEKTRO S1---------------------------- //

        $skripsiElektroS1Statuses = [
            'BELUM SEMPRO' => ['USULAN JUDUL','JUDUL DISETUJUI', 'USULAN JUDUL DISETUJUI', 'DAFTAR SEMPRO', 'DAFTAR SEMPRO DISETUJUI', 'SEMPRO DIJADWALKAN'],
            'SUDAH SEMPRO' => ['SEMPRO SELESAI','PERPANJANGAN 1','PERPANJANGAN 2', 'DAFTAR SIDANG', 'DAFTAR SIDANG DISETUJUI', 'SIDANG DIJADWALKAN'],
            'SUDAH SIDANG' => ['SIDANG SELESAI','PERPANJANGAN REVISI DISETUJUI','PERPANJANGAN 1 DISETUJUI','PERPANJANGAN 2 DISETUJUI','SKRIPSI SELESAI','BUKTI PENYERAHAN BUKU SKRIPSI']
        ];

        $kpElektroS1Statuses = [
            'SEDANG KP' => ['USULAN KP', 'SURAT PERUSAHAAN', 'DAFTAR SEMINAR KP', 'BUKTI PENYERAHAN LAPORAN', 'SEMINAR KP DIJADWALKAN','USULAN KP DITERIMA','KP DISETUJUI','DAFTAR SEMINAR KP DISETUJUI'],
            'SUDAH SEMINAR' => ['SEMINAR KP SELESAI'],
        ];

        $skripsiData = [];
        $totalSkripsi = 0;

        $kpData = [];
        $totalKp = 0;

        // Ambil data prodi yang ID-nya 1, 2, atau 3
        $prodis = Prodi::whereIn('id', [1, 2, 3])->pluck('id')->toArray();
        
        // Inisialisasi data skripsi untuk setiap prodi
        $skripsiDataByProdi = [];

        // Inisialisasi data kp untuk setiap prodi
        $kpDataByProdi = [];
        
        foreach ($prodis as $prodiId) {
            $skripsiDataByProdi[$prodiId] = [
                'total' => 0,
                'statuses' => []
            ];
        }

        foreach ($prodis as $prodiId) {
            $kpDataByProdi[$prodiId] = [
                'total' => 0,
                'statuses' => []
            ];
        }
        
        // Hitung total skripsi untuk setiap status dan prodi
        foreach ($skripsiElektroS1Statuses as $status => $subStatuses) {
            foreach ($prodis as $prodiId) {
                $count = 0;
                foreach ($subStatuses as $subStatus) {
                    $count += PendaftaranSkripsi::where('status_skripsi', $subStatus)
                                                ->where('prodi_id', $prodiId)
                                                ->count();
                }
                $skripsiDataByProdi[$prodiId]['statuses'][$status] = $count;
                $skripsiDataByProdi[$prodiId]['total'] += $count;
            }
        }

        // Hitung total skripsi untuk setiap status dan prodi (untuk KP)
        foreach ($kpElektroS1Statuses as $status => $subStatuses) {
            foreach ($prodis as $prodiId) {
                $count = 0;
                foreach ($subStatuses as $subStatus) {
                    $count += PendaftaranKP::where('status_kp', $subStatus)
                                                ->where('prodi_id', $prodiId)
                                                ->count();
                }
                $kpDataByProdi[$prodiId]['statuses'][$status] = $count;
                $kpDataByProdi[$prodiId]['total'] += $count;
            }
        }

        // Inisialisasi data skripsi per angkatan
        $skripsiDataElektroS1ByAngkatan = [];

        // Inisialisasi data skripsi per angkatan (Untuk KP)
        $kpDataElektroS1ByAngkatan = [];

        // Ambil data skripsi untuk prodi Teknik Elektro S1 (ID 2)
        $teknikElektroS1Data = $skripsiDataByProdi[2];

        // Ambil data kp untuk prodi Teknik Elektro S1 (ID 2)
        $teknikElektroS1DataKp = $kpDataByProdi[2];

        // Ambil data mahasiswa untuk mendapatkan daftar angkatan
        $angkatanElektroS1List = Mahasiswa::distinct('angkatan')->pluck('angkatan')->toArray();

        // Ambil data mahasiswa untuk mendapatkan daftar angkatan
        $angkatanElektroS1ListKp = Mahasiswa::distinct('angkatan')->pluck('angkatan')->toArray();

        // Urutkan tahun angkatan dari terkecil ke terbesar
        sort($angkatanElektroS1List);

        // Batasi jumlah tahun angkatan yang ditampilkan maksimal 7 tahun terbaru
        $angkatanElektroS1List = array_slice($angkatanElektroS1List, -7, 7);
        
        // Urutkan tahun angkatan dari terkecil ke terbesar
        sort($angkatanElektroS1ListKp);

        // Batasi jumlah tahun angkatan yang ditampilkan maksimal 7 tahun terbaru
        $angkatanElektroS1ListKp = array_slice($angkatanElektroS1ListKp, -7, 7);

        // Hitung jumlah skripsi untuk setiap angkatan dan status
        foreach ($angkatanElektroS1List as $angkatan) {
            $skripsiDataElektroS1ByAngkatan[$angkatan] = [];
            foreach ($skripsiElektroS1Statuses as $status => $subStatuses) {
                $count = 0;
                foreach ($subStatuses as $subStatus) {
                    $count += PendaftaranSkripsi::where('status_skripsi', $subStatus)
                                                ->whereHas('mahasiswa', function ($query) use ($angkatan) {
                                                    $query->where('angkatan', $angkatan)
                                                    ->where('prodi_id', 2); // Ganti dengan ID prodi Teknik Elektro S1
                                                })
                                                ->count();
                }
                $skripsiDataElektroS1ByAngkatan[$angkatan][$status] = $count;
            }
        }

        // Hitung jumlah kp untuk setiap angkatan dan status
        foreach ($angkatanElektroS1ListKp as $angkatan) {
            $kpDataElektroS1ByAngkatan[$angkatan] = [];
            foreach ($kpElektroS1Statuses as $status => $subStatuses) {
                $count = 0;
                foreach ($subStatuses as $subStatus) {
                    $count += PendaftaranKP::where('status_kp', $subStatus)
                                                ->whereHas('mahasiswa', function ($query) use ($angkatan) {
                                                    $query->where('angkatan', $angkatan)
                                                    ->where('prodi_id', 2); // Ganti dengan ID prodi Teknik Elektro S1
                                                })
                                                ->count();
                }
                $kpDataElektroS1ByAngkatan[$angkatan][$status] = $count;
            }
        }
        
        // Ambil data semester untuk 7 tahun terakhir dari yang terbaru dan urutkan dari terkecil ke terbesar
        $latestSemestersElektroS1 = Semester::orderBy('tahun_ajaran', 'asc')
            ->take(14) // Ambil 14 data teratas
            ->get();

        // Inisialisasi array untuk menyimpan jumlah lulusan per tahun
        $jumlahLulusanPerTahunElektroS1 = [];

        // Mengisi data jumlah lulusan per tahun
        foreach ($latestSemestersElektroS1 as $semester) {
            $tahunAjaranElektroS1 = $semester->tahun_ajaran;

            // Gabungkan jumlah lulusan semester ganjil dan genap dari tahun ajaran yang sama
            if (!isset($jumlahLulusanPerTahunElektroS1[$tahunAjaranElektroS1])) {
                $jumlahLulusanPerTahunElektroS1[$tahunAjaranElektroS1] = 0;
            }

            // Mengambil jumlah lulusan dari prodi Teknik Elektro S1 dengan prodi_id 2
            $jumlahLulusanPerTahunElektroS1[$tahunAjaranElektroS1] += PendaftaranSkripsi::whereBetween('tgl_disetujui_sti_17_koordinator', [$semester->tanggal_mulai, $semester->tanggal_selesai])
                ->where('prodi_id', 2) // Sesuaikan dengan prodi_id Teknik Elektro S1
                ->count();
        }

        // Buat array yang sesuai dengan format yang dibutuhkan oleh chart JS
        $chartDataLulusanElektroS1 = [];
        foreach ($jumlahLulusanPerTahunElektroS1 as $tahun => $jumlahLulusanElektroS1) {
            // Ubah format tahun ajaran menjadi semester (2017/2018, 2018/2019, dst)
            $tahunAjaranElektroS1 = substr($tahun, 0, 4) . '/' . substr($tahun, 5, 4);
            $chartDataLulusanElektroS1[] = [
                'tahun' => $tahunAjaranElektroS1,
                'jumlah_lulusan' => $jumlahLulusanElektroS1
            ];
        }

        // Ambil data semester untuk 7 tahun terakhir dari yang terbaru dan urutkan dari terkecil ke terbesar
        $latestSemestersElektroS1 = Semester::orderBy('tahun_ajaran', 'asc')
            ->take(14) // Ambil 14 data teratas
            ->get();

        // Inisialisasi array untuk menyimpan jumlah lulusan per tahun
        $jumlahLulusanPerTahunElektroS1 = [];
        // Inisialisasi array untuk menyimpan rerata durasi per semester
        $rataRataDurasiPerSemesterElektroS1 = [];

        // Loop melalui setiap semester
        foreach ($latestSemestersElektroS1 as $semester) {
            $tahunAjaranElektroS1 = $semester->tahun_ajaran;

            // Gabungkan jumlah lulusan semester ganjil dan genap dari tahun ajaran yang sama
            if (!isset($jumlahLulusanPerTahunElektroS1[$tahunAjaranElektroS1])) {
                $jumlahLulusanPerTahunElektroS1[$tahunAjaranElektroS1] = 0;
            }

            // Mengambil jumlah lulusan dari prodi Teknik Elektro S1 dengan prodi_id 2
            $jumlahLulusanPerTahunElektroS1[$tahunAjaranElektroS1] += PendaftaranSkripsi::whereBetween('tgl_disetujui_sti_17_koordinator', [$semester->tanggal_mulai, $semester->tanggal_selesai])
                ->where('prodi_id', 2) // Sesuaikan dengan prodi_id Teknik Elektro S1
                ->count();

            // Ambil data mahasiswa yang lulus pada semester ini
            $mahasiswas = PendaftaranSkripsi::whereBetween('tgl_disetujui_sti_17_koordinator', [$semester->tanggal_mulai, $semester->tanggal_selesai])
                ->where('prodi_id', 2) // Sesuaikan dengan prodi_id Teknik Elektro S1
                ->get();

            $totalDurasiElektroS1 = 0;
            $jumlahMahasiswaElektroS1 = $mahasiswas->count();

            // Hitung total durasi pengerjaan skripsi per mahasiswa
            foreach ($mahasiswas as $mahasiswa) {
                $tanggalMulaiElektroS1 = Carbon::parse($mahasiswa->tgl_disetujui_usuljudul_kaprodi);
                $tanggalDisetujuiElektroS1 = Carbon::parse($mahasiswa->tgl_disetujui_sti_17_koordinator);
                
                // Mengambil durasi skripsi dalam bulan dan hari
                $durasiSkripsiElektroS1 = $tanggalMulaiElektroS1->diffInMonths($tanggalDisetujuiElektroS1); // Mengambil durasi dalam bulan
                $bulan = floor($durasiSkripsiElektroS1); // Bagian bulan
                $hari = $tanggalMulaiElektroS1->addMonths($bulan)->diffInDays($tanggalDisetujuiElektroS1); // Bagian hari
                
                // Menambahkan durasi ke total durasi
                $totalDurasiElektroS1 += $bulan + ($hari / 30); // Menghitung total dalam bulan
            }


            // Hitung rerata durasi per semester
            $rataRataDurasiElektroS1 = $jumlahMahasiswaElektroS1 > 0 ? ($totalDurasiElektroS1 / $jumlahMahasiswaElektroS1) : 0;

            // Tambahkan data ke array rerata durasi per semester
            $rataRataDurasiPerSemesterElektroS1[$tahunAjaranElektroS1] = $rataRataDurasiElektroS1;
        }

        // Buat array yang sesuai dengan format yang dibutuhkan oleh chart JS
        $chartDataLulusanElektroS1 = [];
        foreach ($jumlahLulusanPerTahunElektroS1 as $tahun => $jumlahLulusanElektroS1) {
            // Ubah format tahun ajaran menjadi semester (2017/2018, 2018/2019, dst)
            $tahunAjaranElektroS1 = substr($tahun, 0, 4) . '/' . substr($tahun, 5, 4);
            $chartDataLulusanElektroS1[] = [
                'tahun' => $tahunAjaranElektroS1,
                'jumlah_lulusan' => $jumlahLulusanElektroS1,
                'rerata_durasi' => $rataRataDurasiPerSemesterElektroS1[$tahun]
            ];
        }

        // ----------------------------------DATA SKRIPSI TEKNIK ELEKTRO D3---------------------------- //

        $skripsiElektroD3Statuses = [
            'BELUM SEMPRO' => ['USULAN JUDUL','JUDUL DISETUJUI', 'USULAN JUDUL DISETUJUI', 'DAFTAR SEMPRO', 'DAFTAR SEMPRO DISETUJUI', 'SEMPRO DIJADWALKAN'],
            'SUDAH SEMPRO' => ['SEMPRO SELESAI','PERPANJANGAN 1','PERPANJANGAN 2', 'DAFTAR SIDANG', 'DAFTAR SIDANG DISETUJUI', 'SIDANG DIJADWALKAN'],
            'SUDAH SIDANG' => ['SIDANG SELESAI','PERPANJANGAN REVISI DISETUJUI','PERPANJANGAN 1 DISETUJUI','PERPANJANGAN 2 DISETUJUI','SKRIPSI SELESAI','BUKTI PENYERAHAN BUKU SKRIPSI']
        ];

        $kpElektroD3Statuses = [
            'SEDANG KP' => ['USULAN KP', 'SURAT PERUSAHAAN', 'DAFTAR SEMINAR KP', 'BUKTI PENYERAHAN LAPORAN', 'SEMINAR KP DIJADWALKAN','USULAN KP DITERIMA','KP DISETUJUI','DAFTAR SEMINAR KP DISETUJUI'],
            'SUDAH SEMINAR' => ['SEMINAR KP SELESAI'],
        ];

        $skripsiData = [];
        $totalSkripsi = 0;

        $kpData = [];
        $totalKp = 0;

        // Ambil data prodi yang ID-nya 1, 2, atau 3
        $prodis = Prodi::whereIn('id', [1, 2, 3])->pluck('id')->toArray();
        
        // Inisialisasi data skripsi untuk setiap prodi
        $skripsiDataByProdi = [];

        // Inisialisasi data kp untuk setiap prodi
        $kpDataByProdi = [];
        
        foreach ($prodis as $prodiId) {
            $skripsiDataByProdi[$prodiId] = [
                'total' => 0,
                'statuses' => []
            ];
        }

        foreach ($prodis as $prodiId) {
            $kpDataByProdi[$prodiId] = [
                'total' => 0,
                'statuses' => []
            ];
        }
        
        // Hitung total skripsi untuk setiap status dan prodi
        foreach ($skripsiElektroD3Statuses as $status => $subStatuses) {
            foreach ($prodis as $prodiId) {
                $count = 0;
                foreach ($subStatuses as $subStatus) {
                    $count += PendaftaranSkripsi::where('status_skripsi', $subStatus)
                                                ->where('prodi_id', $prodiId)
                                                ->count();
                }
                $skripsiDataByProdi[$prodiId]['statuses'][$status] = $count;
                $skripsiDataByProdi[$prodiId]['total'] += $count;
            }
        }

        // Hitung total kp untuk setiap status dan prodi
        foreach ($kpElektroD3Statuses as $status => $subStatuses) {
            foreach ($prodis as $prodiId) {
                $count = 0;
                foreach ($subStatuses as $subStatus) {
                    $count += PendaftaranKP::where('status_kp', $subStatus)
                                                ->where('prodi_id', $prodiId)
                                                ->count();
                }
                $kpDataByProdi[$prodiId]['statuses'][$status] = $count;
                $kpDataByProdi[$prodiId]['total'] += $count;
            }
        }

        // Inisialisasi data skripsi per angkatan
        $skripsiDataElektroD3ByAngkatan = [];

        // Inisialisasi data kp per angkatan
        $kpDataElektroD3ByAngkatan = [];

        // Ambil data skripsi untuk prodi Teknik Elektro D3 (ID 1)
        $teknikElektroD3Data = $skripsiDataByProdi[1];

        // Ambil data skripsi untuk prodi Teknik Elektro D3 (ID 1)
        $teknikElektroD3DataKp = $kpDataByProdi[1];

        // Ambil data mahasiswa untuk mendapatkan daftar angkatan
        $angkatanElektroD3List = Mahasiswa::distinct('angkatan')->pluck('angkatan')->toArray();

        // Ambil data mahasiswa untuk mendapatkan daftar angkatan
        $angkatanElektroD3ListKp = Mahasiswa::distinct('angkatan')->pluck('angkatan')->toArray();

        // Urutkan tahun angkatan dari terkecil ke terbesar
        sort($angkatanElektroD3List);

        // Batasi jumlah tahun angkatan yang ditampilkan maksimal 7 tahun terbaru
        $angkatanElektroD3List = array_slice($angkatanElektroD3List, -7, 7);

        // Urutkan tahun angkatan dari terkecil ke terbesar
        sort($angkatanElektroD3ListKp);

        // Batasi jumlah tahun angkatan yang ditampilkan maksimal 7 tahun terbaru
        $angkatanElektroD3ListKp = array_slice($angkatanElektroD3ListKp, -7, 7);

        // Hitung jumlah skripsi untuk setiap angkatan dan status
        foreach ($angkatanElektroD3List as $angkatan) {
            $skripsiDataElektroD3ByAngkatan[$angkatan] = [];
            foreach ($skripsiElektroD3Statuses as $status => $subStatuses) {
                $count = 0;
                foreach ($subStatuses as $subStatus) {
                    $count += PendaftaranSkripsi::where('status_skripsi', $subStatus)
                                                ->whereHas('mahasiswa', function ($query) use ($angkatan) {
                                                    $query->where('angkatan', $angkatan)
                                                    ->where('prodi_id', 1); // Ganti dengan ID prodi Teknik Elektro D3
                                                })
                                                ->count();
                }
                $skripsiDataElektroD3ByAngkatan[$angkatan][$status] = $count;
            }
        }

        // Hitung jumlah kp untuk setiap angkatan dan status
        foreach ($angkatanElektroD3ListKp as $angkatan) {
            $kpDataElektroD3ByAngkatan[$angkatan] = [];
            foreach ($kpElektroD3Statuses as $status => $subStatuses) {
                $count = 0;
                foreach ($subStatuses as $subStatus) {
                    $count += PendaftaranKP::where('status_kp', $subStatus)
                                                ->whereHas('mahasiswa', function ($query) use ($angkatan) {
                                                    $query->where('angkatan', $angkatan)
                                                    ->where('prodi_id', 1); // Ganti dengan ID prodi Teknik Elektro D3
                                                })
                                                ->count();
                }
                $kpDataElektroD3ByAngkatan[$angkatan][$status] = $count;
            }
        }
        
        // Ambil data semester untuk 7 tahun terakhir dari yang terbaru dan urutkan dari terkecil ke terbesar
        $latestSemestersElektroD3 = Semester::orderBy('tahun_ajaran', 'asc')
            ->take(14) // Ambil 14 data teratas
            ->get();

        // Inisialisasi array untuk menyimpan jumlah lulusan per tahun
        $jumlahLulusanPerTahunElektroD3 = [];

        // Mengisi data jumlah lulusan per tahun
        foreach ($latestSemestersElektroD3 as $semester) {
            $tahunAjaranElektroD3 = $semester->tahun_ajaran;

            // Gabungkan jumlah lulusan semester ganjil dan genap dari tahun ajaran yang sama
            if (!isset($jumlahLulusanPerTahunElektroD3[$tahunAjaranElektroD3])) {
                $jumlahLulusanPerTahunElektroD3[$tahunAjaranElektroD3] = 0;
            }

            // Mengambil jumlah lulusan dari prodi Teknik Elektro S1 dengan prodi_id 2
            $jumlahLulusanPerTahunElektroD3[$tahunAjaranElektroD3] += PendaftaranSkripsi::whereBetween('tgl_disetujui_sti_17_koordinator', [$semester->tanggal_mulai, $semester->tanggal_selesai])
                ->where('prodi_id', 1) // Sesuaikan dengan prodi_id Teknik Elektro S1
                ->count();
        }

        // Buat array yang sesuai dengan format yang dibutuhkan oleh chart JS
        $chartDataLulusanElektroD3 = [];
        foreach ($jumlahLulusanPerTahunElektroD3 as $tahun => $jumlahLulusanElektroD3) {
            // Ubah format tahun ajaran menjadi semester (2017/2018, 2018/2019, dst)
            $tahunAjaranElektroD3 = substr($tahun, 0, 4) . '/' . substr($tahun, 5, 4);
            $chartDataLulusanElektroD3[] = [
                'tahun' => $tahunAjaranElektroD3,
                'jumlah_lulusan' => $jumlahLulusanElektroD3
            ];
        }

        // Ambil data semester untuk 7 tahun terakhir dari yang terbaru dan urutkan dari terkecil ke terbesar
        $latestSemestersElektroD3 = Semester::orderBy('tahun_ajaran', 'asc')
            ->take(14) // Ambil 14 data teratas
            ->get();

        // Inisialisasi array untuk menyimpan jumlah lulusan per tahun
        $jumlahLulusanPerTahunElektroD3 = [];
        // Inisialisasi array untuk menyimpan rerata durasi per semester
        $rataRataDurasiPerSemesterElektroD3 = [];

        // Loop melalui setiap semester
        foreach ($latestSemestersElektroD3 as $semester) {
            $tahunAjaranElektroD3 = $semester->tahun_ajaran;

            // Gabungkan jumlah lulusan semester ganjil dan genap dari tahun ajaran yang sama
            if (!isset($jumlahLulusanPerTahunElektroD3[$tahunAjaranElektroD3])) {
                $jumlahLulusanPerTahunElektroD3[$tahunAjaranElektroD3] = 0;
            }

            // Mengambil jumlah lulusan dari prodi Teknik Elektro S1 dengan prodi_id 2
            $jumlahLulusanPerTahunElektroD3[$tahunAjaranElektroD3] += PendaftaranSkripsi::whereBetween('tgl_disetujui_sti_17_koordinator', [$semester->tanggal_mulai, $semester->tanggal_selesai])
                ->where('prodi_id', 1) // Sesuaikan dengan prodi_id Teknik Elektro S1
                ->count();

            // Ambil data mahasiswa yang lulus pada semester ini
            $mahasiswas = PendaftaranSkripsi::whereBetween('tgl_disetujui_sti_17_koordinator', [$semester->tanggal_mulai, $semester->tanggal_selesai])
                ->where('prodi_id', 1) // Sesuaikan dengan prodi_id Teknik Elektro S1
                ->get();

            $totalDurasiElektroD3 = 0;
            $jumlahMahasiswaElektroD3 = $mahasiswas->count();

            // Hitung total durasi pengerjaan skripsi per mahasiswa
            foreach ($mahasiswas as $mahasiswa) {
                $tanggalMulaiElektroD3 = Carbon::parse($mahasiswa->tgl_disetujui_usuljudul_kaprodi);
                $tanggalDisetujuiElektroD3 = Carbon::parse($mahasiswa->tgl_disetujui_sti_17_koordinator);
                
                // Mengambil durasi skripsi dalam bulan dan hari
                $durasiSkripsiElektroD3 = $tanggalMulaiElektroD3->diffInMonths($tanggalDisetujuiElektroD3); // Mengambil durasi dalam bulan
                $bulan = floor($durasiSkripsiElektroD3); // Bagian bulan
                $hari = $tanggalMulaiElektroD3->addMonths($bulan)->diffInDays($tanggalDisetujuiElektroD3); // Bagian hari
                
                // Menambahkan durasi ke total durasi
                $totalDurasiElektroD3 += $bulan + ($hari / 30); // Menghitung total dalam bulan
            }


            // Hitung rerata durasi per semester
            $rataRataDurasiElektroD3 = $jumlahMahasiswaElektroD3 > 0 ? ($totalDurasiElektroD3 / $jumlahMahasiswaElektroD3) : 0;

            // Tambahkan data ke array rerata durasi per semester
            $rataRataDurasiPerSemesterElektroD3[$tahunAjaranElektroD3] = $rataRataDurasiElektroD3;
        }

        // Buat array yang sesuai dengan format yang dibutuhkan oleh chart JS
        $chartDataLulusanElektroD3 = [];
        foreach ($jumlahLulusanPerTahunElektroD3 as $tahun => $jumlahLulusanElektroD3) {
            // Ubah format tahun ajaran menjadi semester (2017/2018, 2018/2019, dst)
            $tahunAjaranElektroD3 = substr($tahun, 0, 4) . '/' . substr($tahun, 5, 4);
            $chartDataLulusanElektroD3[] = [
                'tahun' => $tahunAjaranElektroD3,
                'jumlah_lulusan' => $jumlahLulusanElektroD3,
                'rerata_durasi' => $rataRataDurasiPerSemesterElektroD3[$tahun]
            ];
        }

        return view('pendaftaran.statistik.index', [
            // data skripsi informatika s1
            'teknikInformatikaData' => $teknikInformatikaData,
            'skripsiDataInformatikaByAngkatan' => $skripsiDataInformatikaByAngkatan,
            'skripsiInformatikaStatuses' => $skripsiInformatikaStatuses,

            // data kp informatika s1
            'teknikInformatikaDataKp' => $teknikInformatikaDataKp,
            'kpDataInformatikaByAngkatan' => $kpDataInformatikaByAngkatan,
            'kpInformatikaStatuses' => $kpInformatikaStatuses,
            
            // jumlah lulusan 5 tahun terakhir informatika
            'chartData' => $chartData,
            'jumlahLulusanPerTahun' => $jumlahLulusanPerTahun,
            
            // lama pengerjaan skripsi informatika
            'rataRataDurasiPerSemester' => $rataRataDurasiPerSemester,

            // data skripsi elektro s1
            'teknikElektroS1Data' => $teknikElektroS1Data,
            'skripsiDataElektroS1ByAngkatan' => $skripsiDataElektroS1ByAngkatan,
            'skripsiElektroS1Statuses' => $skripsiElektroS1Statuses,

            // data kp elektro s1
            'teknikElektroS1DataKp' => $teknikElektroS1DataKp,
            'kpDataElektroS1ByAngkatan' => $kpDataElektroS1ByAngkatan,
            'kpElektroS1Statuses' => $kpElektroS1Statuses,
            
            // jumlah lulusan 5 tahun terakhir elektro s1
            'chartDataLulusanElektroS1' => $chartDataLulusanElektroS1,
            'jumlahLulusanPerTahunElektroS1' => $jumlahLulusanPerTahunElektroS1,
            
            // lama pengerjaan skripsi elektro s1
            'rataRataDurasiPerSemesterElektroS1' => $rataRataDurasiPerSemesterElektroS1,

            // data skripsi elektro d3
            'teknikElektroD3Data' => $teknikElektroD3Data,
            'skripsiDataElektroD3ByAngkatan' => $skripsiDataElektroD3ByAngkatan,
            'skripsiElektroD3Statuses' => $skripsiElektroD3Statuses,

            // data kp elektro d3
            'teknikElektroD3DataKp' => $teknikElektroD3DataKp,
            'kpDataElektroD3ByAngkatan' => $kpDataElektroD3ByAngkatan,
            'kpElektroD3Statuses' => $kpElektroD3Statuses,
            
            // jumlah lulusan 5 tahun terakhir elektro d3
            'chartDataLulusanElektroD3' => $chartDataLulusanElektroD3,
            'jumlahLulusanPerTahunElektroD3' => $jumlahLulusanPerTahunElektroD3,
            
            // lama pengerjaan skripsi elektro d3
            'rataRataDurasiPerSemesterElektroD3' => $rataRataDurasiPerSemesterElektroD3,
        ]);
    }


    public function bimbingan_kp()
    {

    $dosenskp = Dosen::withCount([
        'pendaftaranKP' => function ($query) {
            $query->where('status_kp', '!=', 'USULAN KP DITOLAK')
                ->where('status_kp', '!=', 'USULKAN KP ULANG')
                ->where('keterangan', '!=', 'Nilai KP Telah Keluar');
        },
    ])->get()->sortByDesc('pendaftaran_k_p_count');
        
    $dosenskplulus = Dosen::withCount([
         'pendaftarankp' => function ($query) {
        $query->where('status_kp','KP SELESAI');
    }
    ])->get()->sortByDesc('pendaftarankp_count');

        return view('pendaftaran.statistik.bimbingan-kp', [
            'dosen' => $dosenskp,
            'dosen_lulus' => $dosenskplulus,
            'kapasitas' => KapasitasBimbingan::first(),
        ]);
    }

    public function detail_lulus_bimbingan_kp($nip)
    {
        $dosen = Dosen::where('nip', $nip)->first();

        $mahasiswa = $dosen->pembimbingkp_lulus;

        return view('pendaftaran.statistik.detail-lulus-kp', [
            'pendaftaran_kp' => $mahasiswa,
            'dosen' => $dosen,
        ]);
    }

    public function detail_lulus_bimbingan_skripsi($nip)
    {
        $dosen = Dosen::where('nip', $nip)->first();

        $mahasiswa1 = $dosen->pembimbing1skripsi_lulus;
        $mahasiswa2 = $dosen->pembimbing2skripsi_lulus;

        $gabungan = $mahasiswa1->merge($mahasiswa2);

        return view('pendaftaran.statistik.detail-lulus-skripsi', [
            'pendaftaran_skripsi' => $gabungan,
            'dosen' => $dosen,
        ]);
    }
    
    public function bimbingan_skripsi()
    {
    
    $dosensskripsi = Dosen::withCount([
        'pendaftaranSkripsi1' => function ($query) {
            $query->where('status_skripsi', '!=', 'USULAN JUDUL DITOLAK')
                ->where('status_skripsi', '!=', 'USULKAN JUDUL ULANG')
                ->where('keterangan', '!=', 'Nilai Skripsi Telah Keluar');
        },
        'pendaftaranSkripsi2' => function ($query) {
            $query->where('status_skripsi', '!=', 'USULAN JUDUL DITOLAK')
                ->where('status_skripsi', '!=', 'USULKAN JUDUL ULANG')
                ->where('keterangan', '!=', 'Nilai Skripsi Telah Keluar');
        },
    ])->get()->sortByDesc(function($dosen) {
        return $dosen->pendaftaran_skripsi1_count + $dosen->pendaftaran_skripsi2_count;
    });
    
    $dosensskripsiLulus = Dosen::withCount([
        'pendaftaranSkripsi1' => function ($query) {
            $query->where('status_skripsi', 'LULUS');
        },
        'pendaftaranSkripsi2' => function ($query) {
            $query->where('status_skripsi', 'LULUS');
        },
    ])->get()->sortByDesc(function($dosen) {
        return $dosen->pendaftaran_skripsi1_count + $dosen->pendaftaran_skripsi2_count;
    });

        return view('pendaftaran.statistik.bimbingan-skripsi', [
            'dosen' => $dosensskripsi,
            'dosen_lulus' => $dosensskripsiLulus,
            'kapasitas' => KapasitasBimbingan::first(),
        ]);
    }

    public function indexkp()   
    {
        //  $pendaftaran_kp = PendaftaranKP::all()->first();

        return view('pendaftaran.kerja-praktek.index', [
            'dosens' => Dosen::all(), 
            'prodi' => Prodi::all(),
            'konsentrasi' => Konsentrasi::all(),
            'mahasiswa' => Mahasiswa::where('nim', Auth::user()->nim)->get(),
            'pendaftaran_kp' => PendaftaranKP::all()->sortBy('update_at'),
       
        ]);
    }
    
    public function judul_skripsi_terdaftar(){    
        $statuses = ['JUDUL DISETUJUI', 'DAFTAR SEMPRO', 'DAFTAR SIDANG', 'PERPANJANGAN REVISI', 'BUKTI PENYERAHAN BUKU SKRIPSI', 'SEMPRO DIJADWALKAN', 'SIDANG DIJADWALKAN', 'DAFTAR SEMPRO DISETUJUI', 'DAFTAR SIDANG DISETUJUI', 'SEMPRO SELESAI', 'PERPANJANGAN REVISI DISETUJUI', 'SIDANG SELESAI', 'PERPANJANGAN 1 DISETUJUI', 'PERPANJANGAN 2 DISETUJUI', 'SKRIPSI SELESAI', 'LULUS'];
    
        $pendaftaran_skripsis = PendaftaranSkripsi::where(function ($query) use ($statuses) {
            foreach ($statuses as $status) {
                $query->orWhere('status_skripsi', $status);
            }
        })->get()->sortBy('update_at');
    
        return view('pendaftaran.statistik.judul-skripsi-terdaftar', compact('pendaftaran_skripsis'));
    }
    
    public function riwayat_lokasi_kp(){
        $statuses = ['KP DISETUJUI', 'DAFTAR SEMINAR KP', 'SEMINAR KP DIJADWALKAN', 'DAFTAR SEMINAR KP DISETUJUI', 'SEMINAR KP SELESAI', 'KP SELESAI'];
    
        $pendaftaran_kps = PendaftaranKP::where(function ($query) use ($statuses) {
            foreach ($statuses as $status) {
                $query->orWhere('status_kp', $status);
            }
        })->get()->sortBy('update_at');
    
        return view('pendaftaran.statistik.riwayat_lokasi_kp', compact('pendaftaran_kps'));
    }


}