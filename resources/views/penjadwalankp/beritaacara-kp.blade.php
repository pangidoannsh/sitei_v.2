<!DOCTYPE html>
<html>

<head>
    <title>KPTI-8 Berita Acara Seminar Kerja Praktek</title>
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

        .tablekpti8 {
            margin-top: 20px;
            margin-left: 20px;
        }

        .tablekpti8_2 {
            margin-left: 20px;
        }

        .tablekpti8_3 {
            margin-top: -15px;
            margin-left: 84%;
        }

        .tablekpti8_4 {
            margin-top: -15px;
            margin-left: 52%;
        }

        .tablekpti8_5 {
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
                    <strong>BERITA ACARA SEMINAR KERJA PRAKTEK</strong>
                </td>
            </tr>
        </table>

        <table width="100%" style="text-align: right; margin-top:-40px;">
            <tr>
                <td style="font-size:12pt;">
                    @if ($penjadwalan->mahasiswa->prodi->id == 1)
                        <strong style="border:1px solid #000; padding:4px">KPTE-8</strong>
                    @elseif ($penjadwalan->mahasiswa->prodi->id == 2)
                        <strong style="border:1px solid #000; padding:4px">KPTE-8</strong>
                    @else
                        <strong style="border:1px solid #000; padding:4px">KPTI-8</strong>
                    @endif
                </td>
            </tr>
        </table>

        <table width="100%" style="font-family: Arial, sans-serif; margin-top:20px; line-height: 1.5">
            <tr>
                <td>Hari/Tgl</td>
                <td>:</td>
                <td width="70%">{{ Carbon::parse($penjadwalan->tanggal)->translatedFormat('l, d F Y') }}</td>
            </tr>

            <tr class="text2">
                <td>Nama Mahasiswa</td>
                <td>:</td>
                <td width="70%">{{ $penjadwalan->mahasiswa->nama }}</td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>:</td>
                <td width="70%">{{ $penjadwalan->mahasiswa->nim }}</td>
            </tr>
            <tr>
                <td>Judul Laporan KP</td>
                <td>:</td>
                <td width="70%">{{ $penjadwalan->judul_kp }}</td>
            </tr>

            <tr>
                <td width="30%">Dosen Pembimbing KP</td>
                <td>:</td>
                <td width="70%">{{ $penjadwalan->pembimbing->nama }}</td>
            </tr>
        </table>

        <table class="tablekpti8" width="74%" style="font-family: Arial, sans-serif; line-height: 1.5">
            <tr>
                <td style="text-decoration:underline; font-weight:bold;">A. NILAI SEMINAR</td>
            </tr>

            <tr>
                <td>PENGUJI</td>
                <td>({{ $penjadwalan->penguji->nama }})</td>
                <td>:</td>
                <td>{{ $nilaipenguji->total_nilai_angka }}</td>
            </tr>
        </table>

        <table class="tablekpti8_2" width="95%" style="font-family: Arial, sans-serif; line-height: 1.5">
            <tr>
                <td style="text-decoration:underline; font-weight:bold;">B. NILAI AKHIR</td>
            </tr>

            <tr class="text2">
                <td>PEMBIMBING LAPANGAN (nilai x 40%)</td>
                <td>:</td>
                <td>{{ $nilaipembimbing->nilai_pembimbing_lapangan }} x 40%</td>
                <td>=</td>
                <td>{{ $nilaipembimbing->nilai_pembimbing_lapangan }}</td>
            </tr>
            <tr>
                <td>PEMBIMBING KP (nilai x 30%)</td>
                <td>:</td>
                <td>{{ $nilaipembimbing->total_nilai_angka }} x 30%</td>
                <td>=</td>
                <td>{{ $nilaipembimbing->total_nilai_angka }}</td>
            </tr>
            <tr>
                <td>NILAI SEMINAR (nilai x 30%)</td>
                <td>:</td>
                <td>{{ $nilaipenguji->total_nilai_angka }} x 30%</td>
                <td>=</td>
                <td>{{ $nilaipenguji->total_nilai_angka }}</td>
            </tr>
        </table>

        <table class="tablekpti8_3" width="40%">
            <tr>
                <td>
                    <hr style="margin: 1px; border: 1px solid black">
                </td>
                <td>&#43;</td>
            </tr>
        </table>

        <table class="tablekpti8_4" width="45%" style="font-family: Arial, sans-serif; line-height: 1.5">
            <tr>
                <td>TOTAL NILAI</td>
                <td>:</td>
                <td>
                    {{ round(($nilaipembimbing->total_nilai_angka + $nilaipenguji->total_nilai_angka + $nilaipembimbing->nilai_pembimbing_lapangan) / 3) }}
                </td>
                </td>
            </tr>
            <tr>
                <td>NILAI AKHIR (HURUF)</td>
                <td>:</td>
                <td>
                    @if (
                        ($nilaipembimbing->total_nilai_angka +
                            $nilaipenguji->total_nilai_angka +
                            $nilaipembimbing->nilai_pembimbing_lapangan) /
                            3 >=
                            85)
                        A
                    @elseif (
                        ($nilaipembimbing->total_nilai_angka +
                            $nilaipenguji->total_nilai_angka +
                            $nilaipembimbing->nilai_pembimbing_lapangan) /
                            3 >=
                            80)
                        A-
                    @elseif (
                        ($nilaipembimbing->total_nilai_angka +
                            $nilaipenguji->total_nilai_angka +
                            $nilaipembimbing->nilai_pembimbing_lapangan) /
                            3 >=
                            75)
                        B+
                    @elseif (
                        ($nilaipembimbing->total_nilai_angka +
                            $nilaipenguji->total_nilai_angka +
                            $nilaipembimbing->nilai_pembimbing_lapangan) /
                            3 >=
                            70)
                        B
                    @elseif (
                        ($nilaipembimbing->total_nilai_angka +
                            $nilaipenguji->total_nilai_angka +
                            $nilaipembimbing->nilai_pembimbing_lapangan) /
                            3 >=
                            65)
                        B-
                    @elseif (
                        ($nilaipembimbing->total_nilai_angka +
                            $nilaipenguji->total_nilai_angka +
                            $nilaipembimbing->nilai_pembimbing_lapangan) /
                            3 >=
                            60)
                        C+
                    @elseif (
                        ($nilaipembimbing->total_nilai_angka +
                            $nilaipenguji->total_nilai_angka +
                            $nilaipembimbing->nilai_pembimbing_lapangan) /
                            3 >=
                            55)
                        C
                    @elseif (
                        ($nilaipembimbing->total_nilai_angka +
                            $nilaipenguji->total_nilai_angka +
                            $nilaipembimbing->nilai_pembimbing_lapangan) /
                            3 >=
                            40)
                        D
                    @else
                        E
                    @endif
                </td>
            </tr>
        </table>

        <table class="tablekpti8_5" width="100%" style="font-family: Arial, sans-serif; line-height: 1.5">
            <tr>
                <td style="text-decoration:underline; font-weight:bold;">CATATAN</td>
            </tr>

            <tr>
                @if ($nilaipembimbing->catatan1 != null)
                    <td>- {{ $nilaipembimbing->catatan1 }}</td>
                @else
                    <td>- ..............................................................</td>
                @endif
            </tr>

            <tr>
                @if ($nilaipembimbing->catatan2 != null)
                    <td>- {{ $nilaipembimbing->catatan2 }}</td>
                @else
                    <td>- ..............................................................</td>
                @endif
            </tr>

            <tr>
                @if ($nilaipembimbing->catatan3 != null)
                    <td>- {{ $nilaipembimbing->catatan3 }}</td>
                @else
                    <td>- ..............................................................</td>
                @endif
            </tr>

        </table>

        <table width="100%" style="font-family: Arial, sans-serif; position: absolute; margin-top:10px;">
            <tr>
                <td width="55%" align="right">
                    <!-- Disini untuk perintah Qr code -->
                </td>
                <td class="text" style="text-align: left;">
                    <div class="container">
                        <p>Pekanbaru, {{ Carbon::parse($penjadwalan->tanggal)->translatedFormat('d F Y') }} </p>
                        <p>Ketua Seminar KP</p>
                        <div class="ttd">
                            <img src="data:img/png;base64, {!! $qrcode !!}">
                        </div>
                        <br><br><br><br><br><br>
                        <strong
                            style="text-decoration: underline;">{{ $penjadwalan->pembimbing->nama }}</strong><br>NIP.
                        {{ $penjadwalan->pembimbing->nip }}
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
