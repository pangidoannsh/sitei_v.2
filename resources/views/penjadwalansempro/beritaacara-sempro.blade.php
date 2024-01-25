<!DOCTYPE html>
<html>

<head>
    <title>STI-7 Berita Acara Seminar Proposal Skripsi</title>
    @php
        use Carbon\Carbon;
        use SimpleSoftwareIO\QrCode\Facades\QrCode;
    @endphp
    <style type="text/css">
        table {
            border-style: double;
            border-width: 3px;
            border-color: white;
            margin: 1%;
            /* border-collapse: collapse; */
        }

        .tablesti7 {
            margin-top: 10px;
            margin-left: 20px;
        }

        .tablesti7_2 {
            margin-left: 20px;
        }

        .tablesti7_3 {
            margin-top: -15px;
            margin-left: 57%;
        }

        .tablesti7_4 {
            margin-top: -15px;
            margin-left: 20px;
        }

        .tablesti7_6 {
            margin-top: -15px;
            margin-left: 20px;
        }

        .tablesti7_5 {
            margin-left: 20px;
        }

        .table2 {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #232323;
            border-collapse: collapse;
            border: 1px solid #999;
            padding: 3px 10px;
            margin-top: 30px;
            margin-left: 10px;
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
            position: relative;
            text-align: left;
            color: black;
        }

        .ttd {
            position: absolute;
            margin: 0%;
            left: 0%;
        }

        .logo {
            position: absolute;
            top: 7%;
            right: 73%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>
    <div class="isi">

        <table width="100%" style="margin-bottom: 0%">
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
                        @if ($penjadwalan->mahasiswa->prodi->id == 1)
                            <font size="3"><b>PROGRAM STUDI TEKNIK ELEKTRO D3</b></font><br>
                        @elseif ($penjadwalan->mahasiswa->prodi->id == 2)
                            <font size="3"><b>PROGRAM STUDI TEKNIK ELEKTRO S1</b></font><br>
                        @else
                            <font size="3"><b>PROGRAM STUDI TEKNIK INFORMATIKA</b></font><br>
                        @endif
                        <font size="2">Kampus Bina Widya Km. 12,5 Simpang Baru Pekanbaru 28293</font><br>
                        <font size="2">Telepon (0761) 66596 Faksimile (0761) 66595</font><br>
                        @if ($penjadwalan->mahasiswa->prodi->id == 1)
                            <font size="2">Laman: <u>http://elektrod3.ft.unri.ac.id</u></font>
                        @elseif ($penjadwalan->mahasiswa->prodi->id == 2)
                            <font size="2">Laman: <u>http://elektros1.ft.unri.ac.id</u></font>
                        @else
                            <font size="2">Laman: <u>http://informatika.ft.unri.ac.id</u></font>
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

        <table width="100%" style="text-align:center; margin-top:0px;">
            <tr>
                <td style="font-size:12pt;text-decoration: underline;">
                    <strong>BERITA ACARA SEMINAR PROPOSAL SKRIPSI</strong>
                </td>
            </tr>
        </table>

        <table width="100%" style="text-align: right; margin-top:-40px;">
            <tr>
                <td style="font-size:12pt;">
                    @if ($penjadwalan->mahasiswa->prodi->id == 1)
                        <strong style="border:1px solid #000; padding:4px">STE-7</strong>
                    @elseif ($penjadwalan->mahasiswa->prodi->id == 2)
                        <strong style="border:1px solid #000; padding:4px">STE-7</strong>
                    @else
                        <strong style="border:1px solid #000; padding:4px">STI-7</strong>
                    @endif
                </td>
            </tr>
        </table>

        <table width="100%" style="font-family: Arial, sans-serif; margin-top:20px; line-height: 1.5">
            <tr>
                <td width="27%">Hari/Tgl</td>
                <td>:</td>
                <td width="70%">{{ Carbon::parse($penjadwalan->tanggal)->translatedFormat('l, d F Y') }}</td>
            </tr>

            <tr class="text2">
                <td width="27%">Nama Mahasiswa</td>
                <td>:</td>
                <td width="70%">{{ $penjadwalan->mahasiswa->nama }}</td>
            </tr>
            <tr>
                <td width="27%">NIM</td>
                <td>:</td>
                <td width="70%">{{ $penjadwalan->mahasiswa->nim }}</td>
            </tr>
            <tr>
                <td width="27%">Judul Proposal</td>
                <td>:</td>
                <td width="70%">
                    {{ $penjadwalan->revisi_proposal != null ? $penjadwalan->revisi_proposal : $penjadwalan->judul_proposal }}
                </td>
            </tr>
        </table>

        <table width="100%" style="font-family: Arial, sans-serif; margin-top:-13px;">
            <tr>
                <td width="27%">Dosen Pembimbing</td>
                <td>:</td>
                <td width="70%">1. {{ $penjadwalan->pembimbingsatu->nama }}</td>
            </tr>
        </table>

        <table width="100%" style="font-family: Arial, sans-serif; margin-top:-10px; margin-left:31%;">
            <tr>
                @if ($penjadwalan->pembimbingdua_nip != null)
                    <td width="70%">2. {{ $penjadwalan->pembimbingdua->nama }}</td>
                @else
                    <td width="70%">2. -</td>
                @endif
            </tr>
        </table>

        <table class="tablesti7" width="100%" style="font-family: Arial, sans-serif; line-height: 1.5">
            <tr>
                <td style="font-weight:bold;">NILAI SEMINAR</td>
            </tr>

            <tr>
                <td width="60%">PEMBIMBING 1 &nbsp; ({{ $penjadwalan->pembimbingsatu->nama }}) </td>
                <td>: &nbsp; {{ $nilaipembimbing1->total_nilai_angka }} </td>
            </tr>

            <tr>
                @if ($penjadwalan->pembimbingdua_nip != null)
                    <td>PEMBIMBING 2 &nbsp; ({{ $penjadwalan->pembimbingdua->nama }})</td>
                    <td>: &nbsp; {{ $nilaipembimbing2->total_nilai_angka }} </td>
                @else
                    <td>PEMBIMBING 2 &nbsp; (-)</td>
                    <td>: &nbsp; - </td>
                @endif
            </tr>
        </table>

        <table class="tablesti7_6" width="84%" style="font-family: Arial, sans-serif; line-height: 1.5">
            <tr>
                <td style="font-weight:bold;">RATA-RATA NILAI PEMBIMBING</td>
                <td>: &nbsp; @if ($nilaipembimbing1 == '' && $nilaipembimbing2 == '')
                        -
                    @else
                        <?php
                        $nilai_masuk1 = 0;
                        
                        if (!empty($nilaipembimbing1)) {
                            $nilai_masuk1 = $nilai_masuk1 + 1;
                            $pembimbing1 = $nilaipembimbing1->total_nilai_angka;
                        } else {
                            $pembimbing1 = 0;
                        }
                        if (!empty($nilaipembimbing2)) {
                            $nilai_masuk1 = $nilai_masuk1 + 1;
                            $pembimbing2 = $nilaipembimbing2->total_nilai_angka;
                        } else {
                            $pembimbing2 = 0;
                        }
                        $nilaitotalpembimbing = round(($pembimbing1 + $pembimbing2) / $nilai_masuk1);
                        ?>
                        {{ $nilaitotalpembimbing }}
                    @endif
                </td>
            </tr>
        </table>

        <table class="tablesti7_2" width="100%" style="font-family: Arial, sans-serif; line-height: 1.5">
            <tr>
                <td width="60%">PENGUJI 1 &nbsp; ({{ $penjadwalan->pengujisatu->nama }})</td>
                <td>: &nbsp; {{ $nilaipenguji1->total_nilai_angka }} </td>
            </tr>

            <tr>
                <td>PENGUJI 2 &nbsp; ({{ $penjadwalan->pengujidua->nama }})</td>
                <td>: &nbsp; {{ $nilaipenguji2->total_nilai_angka }} </td>
            </tr>

            <tr>
                @if ($penjadwalan->pengujitiga_nip != null)
                    <td>PENGUJI 3 &nbsp; ({{ $penjadwalan->pengujitiga->nama }})</td>
                    <td>: &nbsp; {{ $nilaipenguji3->total_nilai_angka }} </td>
                @else
                    <td>PENGUJI 3 &nbsp; (-)</td>
                    <td>: &nbsp; - </td>
                @endif
            </tr>
        </table>

        <table class="tablesti7_6" width="85%" style="font-family: Arial, sans-serif; line-height: 1.5">
            <tr>
                <td style="font-weight:bold;">RATA-RATA NILAI PENGUJI</td>
                <td>: &nbsp;
                    @if ($nilaipenguji1 == '' && $nilaipenguji2 == '' && $nilaipenguji3 == '')
                        -
                    @else
                        <?php
                        $nilai_masuk = 0;
                        if (!empty($nilaipenguji1)) {
                            $nilai_masuk = $nilai_masuk + 1;
                            $penguji1 = $nilaipenguji1->total_nilai_angka;
                        } else {
                            $penguji1 = 0;
                        }
                        if (!empty($nilaipenguji2)) {
                            $nilai_masuk = $nilai_masuk + 1;
                            $penguji2 = $nilaipenguji2->total_nilai_angka;
                        } else {
                            $penguji2 = 0;
                        }
                        if (!empty($nilaipenguji3)) {
                            $nilai_masuk = $nilai_masuk + 1;
                            $penguji3 = $nilaipenguji3->total_nilai_angka;
                        } else {
                            $penguji3 = 0;
                        }
                        $nilaitotalpenguji = round(($penguji1 + $penguji2 + $penguji3) / $nilai_masuk);
                        ?>
                        {{ $nilaitotalpenguji }}
                    @endif
                </td>

            </tr>
        </table>

        <table class="tablesti7_3" width="60%">
            <tr>
                <td>
                    <hr style="margin: 1px; border: 1px solid black">
                </td>
                <td>&#43;</td>
            </tr>
        </table>

        <table class="tablesti7_4" width="81.5%" style="font-family: Arial, sans-serif; line-height: 1.5">
            <tr>
                <td><b>TOTAL NILAI PEMBIMBING + PENGUJI</b></td>
                <td>: &nbsp; @if (
                    $nilaipenguji1 == '' &&
                        $nilaipenguji2 == '' &&
                        $nilaipenguji3 == '' &&
                        $nilaipembimbing1 == '' &&
                        $nilaipembimbing2 == '')
                        -
                    @else
                        <?php
                        $nilai_masuk = 0;
                        if (!empty($nilaipenguji1)) {
                            $nilai_masuk = $nilai_masuk + 1;
                            $penguji1 = $nilaipenguji1->total_nilai_angka;
                        } else {
                            $penguji1 = 0;
                        }
                        if (!empty($nilaipenguji2)) {
                            $nilai_masuk = $nilai_masuk + 1;
                            $penguji2 = $nilaipenguji2->total_nilai_angka;
                        } else {
                            $penguji2 = 0;
                        }
                        if (!empty($nilaipenguji3)) {
                            $nilai_masuk = $nilai_masuk + 1;
                            $penguji3 = $nilaipenguji3->total_nilai_angka;
                        } else {
                            $penguji3 = 0;
                        }
                        $nilaitotalpenguji = round(($penguji1 + $penguji2 + $penguji3) / $nilai_masuk);
                        $nilai_masuk = 0;
                        
                        if (!empty($nilaipembimbing1)) {
                            $nilai_masuk = $nilai_masuk + 1;
                            $pembimbing1 = $nilaipembimbing1->total_nilai_angka;
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
                    @endif
                </td>

            </tr>
            <tr>
                <td><b>NILAI AKHIR (HURUF)</b></td>
                <td>: &nbsp; @if ($nilaitotalpenguji == '' && $nilaitotalpembimbing == '')
                        -
                    @else
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
                    @endif
                </td>
            </tr>
        </table>

        <table class="tablesti7_5" width="100%" style="font-family: Arial, sans-serif; line-height: 1.5;">
            <tr>
                <td style="text-decoration:underline; font-weight:bold;">CATATAN</td>
            </tr>

            <tr>
                @if ($penjadwalan->catatan1 != null)
                    <td>- {{ $penjadwalan->catatan1 }}</td>
                @else
                    <td>- ..............................................................</td>
                @endif
            </tr>

            <tr>
                @if ($penjadwalan->catatan2 != null)
                    <td>- {{ $penjadwalan->catatan2 }}</td>
                @else
                    <td>- ..............................................................</td>
                @endif
            </tr>

            <tr>
                @if ($penjadwalan->catatan3 != null)
                    <td>- {{ $penjadwalan->catatan3 }}</td>
                @else
                    <td>- ..............................................................</td>
                @endif
            </tr>
        </table>

        <!--<table class="table2" style="font-family: Arial, sans-serif; text-align:center;">-->
        <!--    <tr>-->
        <!--        <th class="table2">Nilai Angka</th>-->
        <!--        <th class="table2">Nilai <br> Mutu</th>-->
        <!--        <th class="table2">Angka <br> Mutu</th>-->
        <!--        <th class="table2">Sebutan <br> Mutu</th>-->
        <!--    </tr>-->
        <!--    <tr>-->
        <!--        <td class="table2">X &ge; 85 </td>  -->
        <!--        <td class="table2">A</td>                -->
        <!--        <td class="table2">4,00</td>-->
        <!--        <td class="table2">Sgt Baik</td>                        -->
        <!--    </tr>-->

        <!--    <tr>-->
        <!--        <td class="table2">80 &le; X &lt; 85</td>  -->
        <!--        <td class="table2">A -</td>                -->
        <!--        <td class="table2">3,75</td>                -->
        <!--        <td class="table2">Sgt Baik</td>                        -->
        <!--    </tr>-->

        <!--    <tr>-->
        <!--        <td class="table2">75 &le; X &lt; 80</td>  -->
        <!--        <td class="table2">B +</td>                -->
        <!--        <td class="table2">3,50</td>                -->
        <!--        <td class="table2">Baik</td>                        -->
        <!--    </tr>  -->

        <!--    <tr>-->
        <!--        <td class="table2">70 &le; X &lt; 75</td>  -->
        <!--        <td class="table2">B</td>                -->
        <!--        <td class="table2">3,00</td>                -->
        <!--        <td class="table2">Baik</td>                        -->
        <!--    </tr>  -->

        <!--    <tr>-->
        <!--        <td class="table2">65 &le; X &lt; 70</td>  -->
        <!--        <td class="table2">B -</td>                -->
        <!--        <td class="table2">2,75</td>                -->
        <!--        <td class="table2">Cukup</td>                        -->
        <!--    </tr>  -->

        <!--    <tr>-->
        <!--        <td class="table2">60 &le; X &lt; 65</td>  -->
        <!--        <td class="table2">C +</td>                -->
        <!--        <td class="table2">2,50</td>                -->
        <!--        <td class="table2">Cukup</td>                        -->
        <!--    </tr>  -->

        <!--    <tr>-->
        <!--        <td class="table2">55 &le; X &lt; 60</td>  -->
        <!--        <td class="table2">C</td>                -->
        <!--        <td class="table2">2,00</td>                -->
        <!--        <td class="table2">Cukup</td>                        -->
        <!--    </tr>  -->

        <!--    <tr>-->
        <!--        <td class="table2">40 &le; X &lt; 55</td>  -->
        <!--        <td class="table2">D</td>                -->
        <!--        <td class="table2">1,00</td>                -->
        <!--        <td class="table2">Kurang</td>                        -->
        <!--    </tr>  -->

        <!--    <tr>-->
        <!--        <td class="table2">X &lt; 40</td>  -->
        <!--        <td class="table2">E</td>                -->
        <!--        <td class="table2">0,00</td>                -->
        <!--        <td class="table2">Gagal</td>                        -->
        <!--    </tr>  -->
        <!--</table>-->

        <table width="100%" style="font-family: Arial, sans-serif; position: absolute; margin-top: 10px;">
            <tr>
                <td width="50%" align="right">
                    <!-- Disini untuk perintah Qr code -->
                </td>
                <td class="text" style="text-align: left;">
                    <div class="container">
                        <p>Pekanbaru, {{ Carbon::parse($penjadwalan->tanggal)->translatedFormat('d F Y') }} </p>
                        <p>Ketua Seminar,</p>
                        <div class="ttd">
                            <img src="data:img/png;base64, {!! $qrcode !!}">
                        </div>
                        <br><br><br><br><br><br>
                        <strong
                            style="text-decoration: underline;">{{ $penjadwalan->pengujisatu->nama }}</strong><br>NIP.
                        {{ $penjadwalan->pengujisatu->nip }}
                    </div>
                    <br>
                </td>
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
