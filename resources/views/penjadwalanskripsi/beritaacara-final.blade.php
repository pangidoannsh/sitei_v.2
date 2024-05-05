<!DOCTYPE html>
<html>

<head>
    <title>Surat Keterangan Berita Acara Sidang</title>
    @php
        use Carbon\Carbon;
        $now = \Carbon\Carbon::now();
        $nextMonth = $now->addMonths(1);
    @endphp
    <style type="text/css">
        table {
            border-style: double;
            border-width: 3px;
            border-color: white;
            margin: 1%;
            /* border-collapse: collapse; */
        }

        .table1 {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #232323;
            border-collapse: collapse;
            border: 1px solid #999;
            padding: 5px 10px;
            margin-top: 30px;
            margin-left: auto;
            margin-right: auto;
        }

        .table2 {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #232323;
            border-collapse: collapse;
            border: 1px solid #999;
            padding: 3px 10px;
            margin-top: 50px;
        }

        .tablesti15 {
            margin-top: -18px;
            margin-left: 20px;
        }

        .tablesti15_2 {
            margin-left: 20px;
        }

        .tablesti15_3 {
            margin-top: -15px;
            margin-left: 60%;
        }

        .tablesti15_4 {
            margin-top: -15px;
            margin-left: 20px;
        }

        .tablesti15_6 {
            margin-top: -15px;
            margin-left: 20px;
        }

        table tr .text2 {
            text-align: right;
            font-size: 13pt;
        }

        table tr .text {
            text-align: center;
            font-size: 13px;
        }

        table tr td {
            font-size: 13px;
        }

        table,
        th,
        td {
            /* border: 1px solid black; */
        }


        tr .tr2 {
            border-bottom: 1pt solid black;
        }

        @page {
            size: A4 portrait;
            margin: 1cm;
            padding: 0; // you can set margin and padding 0
        }

        body {
            font-family: Times New Roman;
            font-size: 33px;
        }

        body .isi {
            margin: 0 1.5cm 0 1.5cm;
        }

        .container {
            position: absolute;
            text-align: left;
            color: black;
            margin: 0%;
            top: -2%;
            right: 10%;
        }

        .ttd1 {
            position: relative;
            margin: 0%;
            right: 700%;
            top: 7%;
        }

        .visi1 {
            position: relative;
            margin: 0%;
            text-align: center;
            top: 17%;
        }

        .logo {
            position: absolute;
            top: 7%;
            right: 73%;
            transform: translate(-50%, -50%);
        }

        .logo2 {
            position: absolute;
            right: 73%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>
    <div class="isi">

        <table width="100%" style="margin-bottom: 0%; margin-top: -30px;">
            <tr>
                <td>
                    <div class="logo">
                        <img id="img" src="https://live.staticflickr.com/65535/51644220143_f5dba04544_o_d.png"
                            width="110" height="110">
                    </div>
                </td>
                <td>
                    <center>
                        <font size="4">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN</font><br>
                        <font size="4">RISET DAN TEKNOLOGI</font><br>
                        <font size="3"><b>UNIVERSITAS RIAU - FAKULTAS TEKNIK</b></font><br>
                        <font size="3"><b>JURUSAN TEKNIK ELEKTRO</b></font><br>
                        @if ($penjadwalan_skripsi != null)
                        @if ($penjadwalan_skripsi->mahasiswa->prodi->id == 1)
                            <font size="3"><b>PROGRAM STUDI TEKNIK ELEKTRO D3</b></font><br>
                        @elseif ($penjadwalan_skripsi->mahasiswa->prodi->id == 2)
                            <font size="3"><b>PROGRAM STUDI TEKNIK ELEKTRO S1</b></font><br>
                        @else
                            <font size="3"><b>PROGRAM STUDI TEKNIK INFORMATIKA</b></font><br>
                        @endif
                        @else
                        @if ($pendaftaran_skripsi->mahasiswa->prodi->id == 1)
                            <font size="3"><b>PROGRAM STUDI TEKNIK ELEKTRO D3</b></font><br>
                        @elseif ($pendaftaran_skripsi->mahasiswa->prodi->id == 2)
                            <font size="3"><b>PROGRAM STUDI TEKNIK ELEKTRO S1</b></font><br>
                        @else
                            <font size="3"><b>PROGRAM STUDI TEKNIK INFORMATIKA</b></font><br>
                        @endif

                        @endif

                        <font size="2">Kampus Bina Widya Km. 12,5 Simpang Baru Pekanbaru 28293</font><br>
                        <font size="2">Telepon (0761) 66596 Faksimile (0761) 66595</font><br>
                        @if ($penjadwalan_skripsi != null)
                        @if ($penjadwalan_skripsi->mahasiswa->prodi->id == 1)
                            <font size="2">Laman: <u>http://elektrod3.ft.unri.ac.id</u></font>
                        @elseif ($penjadwalan_skripsi->mahasiswa->prodi->id == 2)
                            <font size="2">Laman: <u>http://elektros1.ft.unri.ac.id</u></font>
                        @else
                            <font size="2">Laman: <u>http://informatika.ft.unri.ac.id</u></font>
                        @endif
                        @else
                         @if ($pendaftaran_skripsi->mahasiswa->prodi->id == 1)
                            <font size="2">Laman: <u>http://elektrod3.ft.unri.ac.id</u></font>
                        @elseif ($pendaftaran_skripsi->mahasiswa->prodi->id == 2)
                            <font size="2">Laman: <u>http://elektros1.ft.unri.ac.id</u></font>
                        @else
                            <font size="2">Laman: <u>http://informatika.ft.unri.ac.id</u></font>
                        @endif
                        @endif
                    </center>
                </td>
            </tr>

            <table width="600px" style="text-align:center">
                <tr>
                    <td>
                        <hr style="margin: 1px; border: 2px solid black">
                        <hr style="margin: 1px; border: 1px solid black">
                    </td>
                </tr>
            </table>
        </table>

        <table width="100%" style="text-align:center; margin-top:-10px;">
            <tr>
                <td style="font-size:11pt;">
                    <strong>Penguji</strong><br>
                    @if ($penjadwalan_skripsi != null)
                    @if ($penjadwalan_skripsi->mahasiswa->prodi->id == 1)
                        <strong>Sidang Skripsi Mahasiswa Program Studi Teknik Elektro D3</strong><br>
                        @elseif ($penjadwalan_skripsi->mahasiswa->prodi->id == 2)
                        <strong>Sidang Skripsi Mahasiswa Program Studi Teknik Elektro S1</strong><br>
                        @else
                        <strong>Sidang Skripsi Mahasiswa Program Studi Teknik Informatika</strong><br>
                    @endif
                    @else
                    @if ($pendaftaran_skripsi->mahasiswa->prodi->id == 1)
                        <strong>Sidang Skripsi Mahasiswa Program Studi Teknik Elektro D3</strong><br>
                        @elseif ($pendaftaran_skripsi->mahasiswa->prodi->id == 2)
                        <strong>Sidang Skripsi Mahasiswa Program Studi Teknik Elektro S1</strong><br>
                        @else
                        <strong>Sidang Skripsi Mahasiswa Program Studi Teknik Informatika</strong><br>
                    @endif
                    @endif
                    <strong>Fakultas Teknik Universitas Riau</strong>
                </td>
            </tr>
        </table>

        <table width="100%" style="font-family: Arial, sans-serif; margin-top:-10px; text-align:center;">
            <tr>
                <td>Nomor : ....../UN.19.5.1.1.7/TE/DL/2024</td>
            </tr>
            <tr>
                <td><hr style="border: 1px solid black"></td>
            </tr>
        </table>

        <table width="100%" style="font-family: Arial, sans-serif; margin-top:-10px; line-height: 1.1">
            <tr>
                <td width="20%">Menimbang</td>
                <td>:&nbsp;&nbsp; 1. Hasil Rapat Tim Penguji Sidang Skripsi</td>
            </tr>
            <tr>
                <td width="20%"></td>
                <td>
                     @if ($penjadwalan_skripsi != null)
                    @if ($penjadwalan_skripsi->mahasiswa->prodi->id == 1)
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Program Studi Teknik Elektro D3 Fakultas Teknik UNRI Tanggal <br>
                        @elseif ($penjadwalan_skripsi->mahasiswa->prodi->id == 2)
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Program Studi Teknik Elektro S1 Fakultas Teknik UNRI Tanggal <br>
                        @else
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Program Studi Teknik Informatika Fakultas Teknik UNRI Tanggal <br>
                    @endif
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>{{ Carbon::parse($penjadwalan_skripsi->tanggal)->translatedFormat('d F Y') }}</strong>
                    @else
                    @if ($pendaftaran_skripsi->mahasiswa->prodi->id == 1)
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Program Studi Teknik Elektro D3 Fakultas Teknik UNRI Tanggal <br>
                        @elseif ($pendaftaran_skripsi->mahasiswa->prodi->id == 2)
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Program Studi Teknik Elektro S1 Fakultas Teknik UNRI Tanggal <br>
                        @else
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Program Studi Teknik Informatika Fakultas Teknik UNRI Tanggal <br>
                    @endif
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>{{ Carbon::parse($pendaftaran_skripsi->tgl_disetujui_jadwal_sidang)->translatedFormat('d F Y') }}</strong>
                    @endif
                </td>
            </tr>
            <tr>
                <td width="20%"></td>
                <td>
                    @if ($penjadwalan_skripsi != null)
                    @if ($penjadwalan_skripsi->mahasiswa->prodi->id == 1)
                        &nbsp;&nbsp;&nbsp; 2. Berita Acara Sidang Skripsi Program Studi Teknik Elektro D3 Fakultas<br>
                        @elseif ($penjadwalan_skripsi->mahasiswa->prodi->id == 2)
                        &nbsp;&nbsp;&nbsp; 2. Berita Acara Sidang Skripsi Program Studi Teknik Elektro S1 Fakultas<br>
                        @else
                        &nbsp;&nbsp;&nbsp; 2. Berita Acara Sidang Skripsi Program Studi Teknik Informatika Fakultas<br>
                    @endif
                    @else
                    @if ($pendaftaran_skripsi->mahasiswa->prodi->id == 1)
                        &nbsp;&nbsp;&nbsp; 2. Berita Acara Sidang Skripsi Program Studi Teknik Elektro D3 Fakultas<br>
                        @elseif ($pendaftaran_skripsi->mahasiswa->prodi->id == 2)
                        &nbsp;&nbsp;&nbsp; 2. Berita Acara Sidang Skripsi Program Studi Teknik Elektro S1 Fakultas<br>
                        @else
                        &nbsp;&nbsp;&nbsp; 2. Berita Acara Sidang Skripsi Program Studi Teknik Informatika Fakultas<br>
                    @endif
                    @endif
                    &nbsp; &nbsp; &nbsp; &nbsp; Teknik UNRI.
                </td>
            </tr>

            <tr>
                <td width="20%">Mengingat</td>
                <td>:&nbsp;&nbsp; 1. Ketetapan Peraturan Akademik Program Studi S1 Fakultas Teknik</td>
            </tr>
            <tr>
                <td width="20%"></td>
                <td>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; UNRI No.42 / J.19.131/AK/2001.<br>
                </td>
            </tr>
            <tr>
                <td width="20%"></td>
                <td>&nbsp;&nbsp;&nbsp; 2. Keputusan Dekan Fakultas Teknik UNRI tentang pembentukan</td>
            </tr>
            <tr>
                <td width="20%"></td>
                <td>
                    @if ($penjadwalan_skripsi != null)
                    @if ($penjadwalan_skripsi->mahasiswa->prodi->id == 1)
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Panitia Sidang Skripsi Mahasiswa Program Studi Teknik Elektro D3 Fakultas<br>
                        @elseif ($penjadwalan_skripsi->mahasiswa->prodi->id == 2)
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Panitia Sidang Skripsi Mahasiswa Program Studi Teknik Elektro S1 Fakultas<br>
                        @else
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Panitia Sidang Skripsi Mahasiswa Program Studi Teknik Informatika Fakultas<br>
                    @endif
                    @else
                    @if ($pendaftaran_skripsi->mahasiswa->prodi->id == 1)
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Panitia Sidang Skripsi Mahasiswa Program Studi Teknik Elektro D3 Fakultas<br>
                        @elseif ($pendaftaran_skripsi->mahasiswa->prodi->id == 2)
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Panitia Sidang Skripsi Mahasiswa Program Studi Teknik Elektro S1 Fakultas<br>
                        @else
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Panitia Sidang Skripsi Mahasiswa Program Studi Teknik Informatika Fakultas<br>
                    @endif
                    @endif

                    &nbsp; &nbsp; &nbsp; &nbsp; Teknik UNRI.
                </td>
            </tr>

        </table>

        <table width="100%" style="font-family: Arial, sans-serif; text-align:center; margin-top:-10px;">
            <tr class="text2">
                <td>Memutuskan</td>
            </tr>
        </table>
        <table width="100%" style="font-family: Arial, sans-serif; margin-top:-15px; line-height: 1.1">
            <tr>
                <td width="20%">Menetapkan</td>
                <td>:</td>
            </tr>
        </table>
        <table width="100%" style="font-family: Arial,  sans-serif; margin-top:-10px; line-height: 1.1">
            <tr>
                <td width="13%"></td>
                <td width="32%">Nama</td>
                @if ($penjadwalan_skripsi != null)
                <td>:&nbsp;  {{ $penjadwalan_skripsi->mahasiswa->nama }}</td>
                @else
                <td>:&nbsp;  {{ $pendaftaran_skripsi->mahasiswa->nama }}</td>
                @endif
            </tr>
            <tr>
                <td width="13%"></td>
                <td width="32%">NIM</td>
                @if ($penjadwalan_skripsi != null)
                <td>:&nbsp;  {{ $penjadwalan_skripsi->mahasiswa->nim }}</td>
                @else
                <td>:&nbsp;  {{ $pendaftaran_skripsi->mahasiswa->nim }}</td>
                @endif
            </tr>
            <tr>
                <td width="13%"></td>
                <td width="32%">Judul Tugas Akhir</td>
                @if ($penjadwalan_skripsi != null)
                <td>:&nbsp;  {{ $penjadwalan_skripsi->revisi_skripsi != null ? $penjadwalan_skripsi->revisi_skripsi : $penjadwalan_skripsi->judul_skripsi }}</td>
                @else
                <td>:&nbsp;  {{ $pendaftaran_skripsi->judul_skripsi }}</td>
                @endif
            </tr>
            <tr>
                <td width="13%"></td>
                <td width="32%">Tanggal Mulai Pengerjaan T.A</td>
                <td>:&nbsp;  {{ Carbon::parse($pendaftaran_skripsi->tgl_created_usuljudul)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td width="13%"></td>
                <td width="32%">Pembimbing</td>
                @if ($penjadwalan_skripsi != null)
                <td>:&nbsp; 1. {{ ($penjadwalan_skripsi->pembimbingsatu->nama) }}</td>
                @else
                <td>:&nbsp; 1. {{ ($pendaftaran_skripsi->dosen_pembimbing1->nama) }}</td>
                @endif
            </tr>
            <tr>
                @if ($penjadwalan_skripsi != null)
                @if ($penjadwalan_skripsi->pembimbingdua_nip != null)
                <td width="13%"></td>
                <td width="32%"></td>
                <td>&nbsp;&nbsp; 2. {{ $penjadwalan_skripsi->pembimbingdua->nama }}
                </td>
                @else

                @endif
                @else
                @if ($pendaftaran_skripsi->pembimbing_2_nip != null)
                <td width="13%"></td>
                <td width="32%"></td>
                <td>&nbsp;&nbsp; 2. {{ $pendaftaran_skripsi->dosen_pembimbing2->nama }}
                </td>
                @else

                @endif
                @endif
            </tr>
        </table>
        <table width="100%" style="font-family: Arial, sans-serif; margin-top:5px; line-height: 1.1">
        @if ($penjadwalan_skripsi != null)
            <tr>
                <td width="13%"></td>
                <td width="32%">Penguji</td>
                <td>:&nbsp; 1. {{ ($penjadwalan_skripsi->pengujisatu->nama) }}</td>
            </tr>
            <tr>
                <td width="13%"></td>
                <td width="32%"></td>
                <td>&nbsp;&nbsp; 2. {{ ($penjadwalan_skripsi->pengujidua->nama) }}</td>
            </tr>
            <tr>
                @if ($penjadwalan_skripsi->pengujitiga_nip != null)
                <td width="13%"></td>
                <td width="32%"></td>
                <td>&nbsp;&nbsp; 3. {{ $penjadwalan_skripsi->pengujitiga->nama }}</td>
                @else

                @endif
            </tr>
        @else
            <tr>
                <td width="13%"></td>
                <td width="32%">Penguji</td>
                <td>:&nbsp; 1. Data seminar tidak ditemukan!</td>
            </tr>
            <tr>
                <td width="13%"></td>
                <td width="32%"></td>
                <td>&nbsp;&nbsp; 2. Data seminar tidak ditemukan!</td>
            </tr>
            <tr>
                <td width="13%"></td>
                <td width="32%"></td>
                <td>&nbsp;&nbsp; 3. Data seminar tidak ditemukan!</td>
            </tr>
        @endif
        </table>
        <table width="100%" style="font-family: Arial, sans-serif; margin-top:5px; line-height: 1.1">
            <tr>
                <td width="13%"></td>
                <td width="32%">Dinyatakan</td>
                <td>:&nbsp; <strong>{{ ($pendaftaran_skripsi->status_skripsi) }}</strong></td>
            </tr>

            <tr>
                <td width="13%"></td>
                <td width="32%">Dengan nilai angka rata-rata</td>
                @if ($penjadwalan_skripsi != null)
                <td>:&nbsp;
                    <strong>
                        <?php
                        $nilai_masuk = 0;
                        if (!empty($nilai_penguji1)) {
                            $nilai_masuk = $nilai_masuk + 1;
                            $penguji1 = $nilai_penguji1->total_nilai_angka;
                        } else {
                            $penguji1 = 0;
                        }
                        if (!empty($nilai_penguji2)) {
                            $nilai_masuk = $nilai_masuk + 1;
                            $penguji2 = $nilai_penguji2->total_nilai_angka;
                        } else {
                            $penguji2 = 0;
                        }
                        if (!empty($nilai_penguji3)) {
                            $nilai_masuk = $nilai_masuk + 1;
                            $penguji3 = $nilai_penguji3->total_nilai_angka;
                        } else {
                            $penguji3 = 0;
                        }
                        $nilaitotalpenguji = round(($penguji1 + $penguji2 + $penguji3) / $nilai_masuk);
                        $nilai_masuk = 0;
                        
                        if (!empty($nilai_pembimbing1)) {
                            $nilai_masuk = $nilai_masuk + 1;
                            $pembimbing1 = $nilai_pembimbing1->total_nilai_angka;
                        } else {
                            $pembimbing1 = 0;
                        }
                        if (!empty($nilaipembimbing2)) {
                            $nilai_masuk = $nilai_masuk + 1;
                            $pembimbing2 = $nilaipembimbing2->total_nilai_angka;
                        } else {
                            $pembimbing2 = 0;
                        }
                        if ($nilai_masuk == 0) {
                            $nilai_masuk = 1;
                        }
                        $nilaitotalpembimbing = round(($pembimbing1 + $pembimbing2) / $nilai_masuk);
                        $nilai_masuk_akhir = 0;
                        if ($nilaitotalpenguji != 0) {
                            $nilai_masuk_akhir = $nilai_masuk_akhir + 1;
                            $penguji = $nilaitotalpenguji;
                        } else {
                            $penguji = 0;
                        }
                        if ($nilaitotalpembimbing != 0) {
                            $nilai_masuk_akhir = $nilai_masuk_akhir + 1;
                            $pembimbing = $nilaitotalpembimbing;
                        } else {
                            $pembimbing = 0;
                        }
                        $total_nilai = $penguji + $pembimbing;
                        ?>
                        {{ $total_nilai }}
                    </strong>
                </td>
                @else
                    <td>:&nbsp; 
                        <strong>Data seminar tidak ditemukan!</strong>
                    </td>
                @endif
            </tr>

            <tr>
                <td width="13%"></td>
                <td width="32%">Atau setara dengan nilai mutu</td>
                @if ($penjadwalan_skripsi != null)
                <td>:&nbsp;
                    <strong>
                        @if ($total_nilai >= 85)
                            A
                        @elseif ($total_nilai >= 80)
                            A-
                        @elseif ($total_nilai >= 75)
                            B+
                        @elseif ($total_nilai >= 70)
                            B
                        @elseif ($total_nilai >= 65)
                            B-
                        @elseif ($total_nilai >= 60)
                            C+
                        @elseif ($total_nilai >= 55)
                            C
                        @elseif ($total_nilai >= 40)
                            D
                        @else
                            E
                        @endif
                    </strong>
                </td>
                @else
                    <td>:&nbsp; 
                        <strong>Data seminar tidak ditemukan!</strong>
                    </td>
                @endif
            </tr>
        </table>
        <table width="100%" style="font-family: Arial, sans-serif; margin-top:-10px; line-height: 1.1">
            <tr>
                <td>II.&nbsp; Kepada Alumni seperti tersebut pada butir 1 di atas berhak menggunakan Gelar Sarjana Teknik &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ST).</td>
            </tr>
            <tr>
                <td>III. Kepada mahasiswa seperti tersebut pada butir 1 di atas diharapkan agar dapat menyelesaikan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;seluruh persyaratan keseluruhannya paling lambat pada tanggal <strong>{{ Carbon::parse($pendaftaran_skripsi->tgl_selesai_sidang)->modify('+24 days')->translatedFormat('d F Y') }}</strong> <br> &nbsp;&nbsp;&nbsp;&nbsp; Demikianlah keputusan ini dibuat dan apabila terdapat kekeliruan dalam keputusan ini, maka akan &nbsp;&nbsp;&nbsp;&nbsp; diadakan perbaikan sebagaimana mestinya.</td>
            </tr>
        </table>
        <table width="100%" style="font-family: Arial, sans-serif; position: absolute;">
            <tr>
                @if($penjadwalan_skripsi != null)
                <td>
                    @if ($penjadwalan_skripsi->mahasiswa->prodi->id == 1)
                        <div class="container">
                        <div class="ttd1">
                            <img style="width: 80px;" src="data:img/png;base64, {!! $qrcodeee !!}">
                        </div>
                    </div>
                    @elseif ($penjadwalan_skripsi->mahasiswa->prodi->id == 2)
                        <div class="container">
                        <div class="ttd1">
                            <img style="width: 80px;" src="data:img/png;base64, {!! $qrcodeee !!}">
                        </div>
                    </div>
                    @else
                        <div class="container">
                        <div class="ttd1">
                            <img style="width: 80px;" src="data:img/png;base64, {!! $qrcodeee !!}">
                        </div>
                    </div>
                    @endif
                    <br>
                </td>
                @else
                <td>
                    <!-- <div class="container">
                        Data seminar tidak ditemukan!
                    </div> -->
                </td>
                @endif
            </tr>
            <tr>
                @if($penjadwalan_skripsi != null)
                <td class="text-center">
                    @if ($penjadwalan_skripsi->mahasiswa->prodi->id == 1)
                        <div class="container">
                        <div class="visi1" style="border: 1px solid black; padding: 2px;">
                            <p>Visi : {{ $visi1->visi }}</p>
                        </div>
                    </div>
                    @elseif ($penjadwalan_skripsi->mahasiswa->prodi->id == 2)
                        <div class="container">
                        <div class="visi1" style="border: 1px solid black; padding: 2px;">
                            <p>Visi : {{ $visi2->visi }}</p>
                        </div>
                    </div>
                    @else
                        <div class="container">
                        <div class="visi1" style="border: 1px solid black; padding: 2px;">
                            <p>Visi : {{ $visi3->visi }}</p>
                        </div>
                    </div>
                    @endif
                    <br>
                </td>
                @else
                <td class="text-center">
                    @if ($pendaftaran_skripsi->mahasiswa->prodi->id == 1)
                        <div class="container">
                        <div class="visi1" style="border: 1px solid black; padding: 2px;">
                            <p>Visi : {{ $visi1->visi }}</p>
                        </div>
                    </div>
                    @elseif ($pendaftaran_skripsi->mahasiswa->prodi->id == 2)
                        <div class="container">
                        <div class="visi1" style="border: 1px solid black; padding: 2px;">
                            <p>Visi : {{ $visi2->visi }}</p>
                        </div>
                    </div>
                    @else
                        <div class="container">
                        <div class="visi1" style="border: 1px solid black; padding: 2px;">
                            <p>Visi : {{ $visi3->visi }}</p>
                        </div>
                    </div>
                    @endif
                    <br>
                </td>
                @endif
            </tr>
            <tr>
                <td width="55%" align="right">
                </td>
                @if($penjadwalan_skripsi != null)
                <td class="text" style="text-align: center;">
                    @if ($penjadwalan_skripsi->mahasiswa->prodi->id == 1)
                        <div class="container">
                            <p>Pekanbaru, {{ Carbon::parse($penjadwalan_skripsi->tanggal)->translatedFormat('d F Y') }} </p>
                            <p style="margin-top: -10px;">Program Studi Teknik Elektro D3 </p>
                            <p style="margin-top: -10px;">Koordinator,</p>
                            <br><br><br><br>
                            <strong style="text-decoration: underline;">{{ $kaprodi1->nama }}</strong><br>NIP.
                            {{ $kaprodi1->nip }}
                        </div>
                    @elseif ($penjadwalan_skripsi->mahasiswa->prodi->id == 2)
                        <div class="container">
                            <p>Pekanbaru, {{ Carbon::parse($penjadwalan_skripsi->tanggal)->translatedFormat('d F Y') }} </p>
                            <p style="margin-top: -10px;">Program Studi Teknik Elektro S1 </p>
                            <p style="margin-top: -10px;">Koordinator,</p>
                            <br><br><br><br>
                            <strong style="text-decoration: underline;">{{ $kaprodi2->nama }}</strong><br>NIP.
                            {{ $kaprodi2->nip }}
                        </div>
                    @else
                        <div class="container">
                            <p>Pekanbaru, {{ Carbon::parse($penjadwalan_skripsi->tanggal)->translatedFormat('d F Y') }} </p>
                            <p style="margin-top: -10px;">Program Studi Teknik Informatika </p>
                            <p width="30%" style="margin-top: -10px;">Koordinator,</p>
                            <br><br><br><br>
                            <strong style="text-decoration: underline;">{{ $kaprodi3->nama }}</strong><br>NIP.
                            {{ $kaprodi3->nip }}
                        </div>
                    @endif
                    <br>
                </td>
                @else
                <td class="text" style="text-align: center;">
                    @if ($pendaftaran_skripsi->mahasiswa->prodi->id == 1)
                        <div class="container">
                            <p>Pekanbaru, {{ Carbon::parse($pendaftaran_skripsi->tgl_selesai_sidang)->translatedFormat('d F Y') }} </p>
                            <p style="margin-top: -10px;">Program Studi Teknik Elektro D3 </p>
                            <p style="margin-top: -10px;">Koordinator,</p>
                            <br><br><br><br>
                            <strong style="text-decoration: underline;">{{ $kaprodi1->nama }}</strong><br>NIP.
                            {{ $kaprodi1->nip }}
                        </div>
                    @elseif ($pendaftaran_skripsi->mahasiswa->prodi->id == 2)
                        <div class="container">
                            <p>Pekanbaru, {{ Carbon::parse($pendaftaran_skripsi->tgl_selesai_sidang)->translatedFormat('d F Y') }} </p>
                            <p style="margin-top: -10px;">Program Studi Teknik Elektro S1 </p>
                            <p style="margin-top: -10px;">Koordinator,</p>
                            <br><br><br><br>
                            <strong style="text-decoration: underline;">{{ $kaprodi2->nama }}</strong><br>NIP.
                            {{ $kaprodi2->nip }}
                        </div>
                    @else
                        <div class="container">
                            <p>Pekanbaru, {{ Carbon::parse($pendaftaran_skripsi->tgl_selesai_sidang)->translatedFormat('d F Y') }} </p>
                            <p style="margin-top: -10px;">Program Studi Teknik Informatika </p>
                            <p width="30%" style="margin-top: -10px;">Koordinator,</p>
                            <br><br><br><br>
                            <strong style="text-decoration: underline;">{{ $kaprodi3->nama }}</strong><br>NIP.
                            {{ $kaprodi3->nip }}
                        </div>
                    @endif
                    <br>
                </td>
                @endif
            </tr>
        </table>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>
