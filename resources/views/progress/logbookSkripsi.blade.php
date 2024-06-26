<!DOCTYPE html>
<html>

<head>
    <title>LogBook Progress Report</title>
    @php
    use Carbon\Carbon;
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
    @endphp

    <style>
        .container {
            display: flex;
            justify-content: center;
            margin: 40px;
        }

        h4 {
            text-align: center;
            margin-bottom: none;
        }

        span {
            font-size: medium;
            font-weight: bold;
            text-align: center;
            margin-bottom: none;
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

        tr .tr2 {
            border-bottom: 1pt solid black;
        }

        @page {
            size: A4 portrait;
            margin: 1cm;
            padding: 0;
        }

        body {
            display: flex;
            font-family: Times New Roman;
            font-size: 33px;
        }

        body .isi {
            margin: 0 1.5cm 0 1.5cm;
        }

        .ttd {
            position: absolute;
            margin: 0%;
            left: 0%;
        }
    </style>
</head>

<body class="isi">
    <div class="container">
        <div style="margin-bottom: 100px;">
            <h4>LOG BOOK <br><span>PROPOSAL / SKRIPSI</span></h4>
        </div>
        <div style="text-align: center; margin-bottom : 100px;">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents($imagePath)) }}" width="180" height="180">
        </div>

        <table style="border-collapse:collapse;">
            <tr>
                <td style="font-weight: bold; width : 200px; padding-bottom : 100px;">JUDUL SKRIPSI</td>
                <td style="text-align: center; width : 30px; padding-bottom : 100px;">:</td>
                <td style="padding-bottom : 100px">{{ $pendaftaraSkripsi->judul }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold; padding-bottom : 30px;">NAMA</td>
                <td style="text-align: center; padding-bottom : 30px;">:</td>
                <td style=" padding-bottom : 30px;">{{ $skripsi->mahasiswa_nama }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold; padding-bottom : 100px;">DOSEN PEMBIMBING</td>
                <td style="text-align: center; padding-bottom : 100px;">:</td>
                <td style="padding-bottom : 100px;">{{ $skripsi->pembimbing_nama }}</td>
            </tr>
        </table>

        <div>
            <h5 style="font-size: medium; text-align: center; margin-bottom: 15px;">PROGRAM STUDI TEKNIK INFORMATIKA S1</h5>
            <h5 style="font-size: medium; text-align: center; margin-top: 15px; margin-bottom: 15px;">FAKULTAS TEKNIK</h5>
            <h5 style="font-size: medium; text-align: center; margin-top: 15px; margin-bottom: 15px;">UNIVERSITAS RIAU</h5>
            <h5 style="font-size: medium; text-align: center; margin-top: 15px; margin-bottom: 15px;">2024</h5>
        </div>
    </div>

</body>

<body class="isi">
    <div class="container">
        <p style="font-size: medium; font-weight: bold; margin: none;">Tanggal : <span style="font-weight: normal;">{{ $tanggal }}</span></p>

        <table style="border: 1px solid black; border-collapse: collapse; width: 100%; margin-bottom: 20px;">
            <thead style="border: 1px solid black;">
                <tr>
                    <th style="text-align: center; font-size: medium; border: 1px solid black; width: 50%">Diskusi</th>
                    <th style="text-align: center; font-size: medium; border: 1px solid black; width: 50%">Komentar / Agenda Selanjutnya</th>
                </tr>
            </thead>
            <tbody style="border: 1px solid black;">
                <tr>
                    <td style=" vertical-align: top; padding: 10px; border: 1px solid black; height: 400px;">{{ $skripsi->diskusi }}</td>
                    <td style=" vertical-align: top; padding: 10px; border: 1px solid black; height: 400px;">{{ $skripsi->komentar }}</td>
                </tr>
            </tbody>
        </table>

        <table style="border: 1px solid black; border-collapse: collapse; width: 100%;">
            <thead style="border: 1px solid black;">
                <tr>
                    <th style=" font-size: medium; border: 1px solid black; width: 100%">Penilaian Mingguan Pembimbing</th>
                </tr>
            </thead>
            <tbody style="border: 1px solid black;">
                <tr>
                    <td style=" vertical-align: top; padding: 10px; border: 1px solid black; height: auto;"><br>Petunjuk : <br>Berdasarkan hasil bimbingan, silahkan letakkan penilaian kinerja mahasiswa <br><br></td>
                </tr>
            </tbody>
            <thead style="border: 1px solid black;">
                <tr>
                    <th style=" font-size: medium; border: 1px solid black; width: 100%">Skala</th>
                </tr>
            </thead>
            <tbody style="border: 1px solid black;">
                <tr>
                    <td style="text-align: center; padding: 10px; border: 1px solid black; height: auto;"> {{ $skripsi->keterangan }}</td>
                </tr>
            </tbody>
            <tbody style="border: 1px solid black;">
                <tr>
                    <td style="text-align: center; padding: 10px; border: 1px solid black; height: auto;"> Pembimbing,
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="sign">
                            <img src="data:img/png;base64, {!! $qrcode !!}">
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        ( {{$skripsi->pembimbing_nama}} ) <br>
                        NIP. {{$skripsi->pembimbing_nip}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>