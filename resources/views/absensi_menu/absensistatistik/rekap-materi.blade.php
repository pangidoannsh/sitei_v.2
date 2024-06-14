<!DOCTYPE html>
<html>

<head>
    <title>Rekapitulasi Materi Perkuliahan</title>
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
        <table width="100%" style="margin-bottom: 0%; margin-top: 10;">
            <tr>
                <td>
                    <div class="logo">
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents($imagePath)) }}" width="110" height="110">
                    </div>
                </td>
                <td>
                    <center>
                        <font size="4">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN</font><br>
                        <font size="4">RISET DAN TEKNOLOGI</font><br>
                        <font size="3"><b>UNIVERSITAS RIAU - FAKULTAS TEKNIK</b></font><br>
                        <font size="3"><b>JURUSAN TEKNIK ELEKTRO</b></font><br>
                        @if (Auth::user()->role_id == 3 || Auth::user()->role_id == 7)
                            <font size="3"><b>PROGRAM STUDI TEKNIK ELEKTRO D3</b></font><br>
                        @elseif (Auth::user()->role_id == 2 || Auth::user()->role_id == 6 )
                            <font size="3"><b>PROGRAM STUDI TEKNIK ELEKTRO S1</b></font><br>
                        @elseif(Auth::user()->role_id == 4 || Auth::user()->role_id == 8)
                            <font size="3"><b>PROGRAM STUDI TEKNIK INFORMATIKA</b></font><br>
                        @endif
                        <font size="2">Kampus Bina Widya Km. 12,5 Simpang Baru Pekanbaru 28293</font><br>
                        <font size="2">Telepon (0761) 66596 Faksimile (0761) 66595</font><br>
                        @if (Auth::user()->role_id == 3 || Auth::user()->role_id == 7)
                            <font size="2">Laman: <u>http://elektrod3.ft.unri.ac.id</u></font>
                        @elseif (Auth::user()->role_id == 2 || Auth::user()->role_id == 6 )
                            <font size="2">Laman: <u>http://elektros1.ft.unri.ac.id</u></font>
                        @elseif(Auth::user()->role_id == 4 || Auth::user()->role_id == 8)
                            <font size="2">Laman: <u>http://informatika.ft.unri.ac.id</u></font>
                        @endif
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr style="margin: 1px; border: 2px solid black">
                    <hr style="margin: 1px; border: 1px solid black">
                </td>
            </tr>
        </table>

        <table width="100%" style="text-align:center; margin-top:0px;">
            <tr>
                <td style="font-size:12pt; text-decoration: underline;">
                    <strong>REKAPITULASI KESESUAIAN MATERI DENGAN RPS PERKULIAHAN</strong>
                </td>
            </tr>
        </table>

        <div class="margin-top" style="margin-top: 10px">
            <table class="center" style="font-size: 13px; width: 680px; margin: auto; margin-bottom: 5px;">
                <tr>
                    <th style="text-align: left;">Mata Kuliah</th>
                    <td style="font-weight: bold">: {{ $groupedAttendances->first()->first()->mata_kuliah ?? '-' }}</td>
                    <th style="text-align: left; padding-left: 20px;">Program Studi</th>
                    <td style="font-weight: bold">: {{ $groupedAttendances->first()->first()->class->prodi->nama_prodi ?? '-' }}</td>
                </tr>
                <tr>
                    <th style="text-align: left;">SKS</th>
                    <td style="font-weight: bold">: {{ $groupedAttendances->first()->first()->class->sks ?? '-' }} SKS</td>
                    <th style="text-align: left; padding-left: 20px;">Dosen</th>
                    <td style="font-weight: bold">: {{ $groupedAttendances->first()->first()->nama_dosen ?? '-' }}</td>
                </tr>
                <tr>
                    <th style="text-align: left;">Semester</th>
                    <td style="font-weight: bold">: {{ $groupedAttendances->first()->first()->class->semester->semester ?? '-' }} {{ $groupedAttendances->first()->first()->class->semester->tahun_ajaran ?? '-' }}</td>
                    <th style="text-align: left; padding-left: 20px;">Kelas</th>
                    <td style="font-weight: bold">: {{ $groupedAttendances->first()->first()->class->kelas->nama_kelas ?? '-' }}</td>
                </tr>
            </table>
        </div>

    </div>
    <table class="center" border="1" style="border: 1px solid black;
  border-collapse: collapse; width: 670px; margin: auto; font-size: 12px; margin-top: 30px">
            <thead>
                <tr>
                    <th class="text-center" scope="col" style="border: 1px solid black">Pertemuan ke-</th>
                    <th class="text-center" scope="col" style="border: 1px solid black">Hari</th>
                    <th class="text-center" scope="col" style="border: 1px solid black">Metode Pembelajaran</th>
                    <th class="text-center" scope="col" style="border: 1px solid black">Materi (Aktual)</th>
                    <th class="text-center" scope="col" style="border: 1px solid black">Materi (RPS)</th>
                    <th class="text-center" scope="col" style="border: 1px solid black">Kesesuaian Materi</th>
                </tr>
            </thead>
        <tbody>
            @php
                $totalPertemuan = 0;
                $totalSesuai = 0;
            @endphp
            @foreach($groupedAttendances as $perkuliahanId => $attendances)
                @php
                    $firstAttendance = $attendances->first();
                    $kesesuaian = $firstAttendance->perkuliahan->rekapitulasiRps->kesesuaian ?? null;
                    $totalPertemuan++;
                    if ($kesesuaian === 'Sesuai') {
                        $totalSesuai++;
                    }
                @endphp
                <tr>
                    <td class="text-center" style="text-align: center; border: 1px solid black">{{ $firstAttendance->perkuliahan->nomor_pertemuan }}</td>
                    <td class="text-center" style="text-align: center; border: 1px solid black">{{ \Carbon\Carbon::parse($firstAttendance->perkuliahan->created_at)->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}</td>
                    <td class="text-center" style="text-align: center; border: 1px solid black">{{ $firstAttendance->perkuliahan->jenis_perkuliahan ?? '-' }}</td>
                    <td class="text-center" style="text-align: center; border: 1px solid black">{{ $firstAttendance->perkuliahan->materi ?? '-' }}</td>
                    <td class="text-center" style="text-align: center; border: 1px solid black">{{ $firstAttendance->class->{"rps_pertemuan_" . $loop->iteration} ?? '-' }}</td>
                    @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 4 || Auth::user()->role_id == 6 || Auth::user()->role_id == 7 || Auth::user()->role_id == 8)
                        <td class="text-center" style="text-align: center; border: 1px solid black">
                            @if ($kesesuaian === 'Sesuai')
                                <span>Sesuai</span>
                            @elseif ($kesesuaian === 'Tidak Sesuai')
                                <span style="color: red;">Tidak Sesuai</span>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
        @php
            $persentaseKesesuaian = $totalPertemuan > 0 ? ($totalSesuai / $totalPertemuan) * 100 : 0;
        @endphp
        <tr>
            <td colspan="5" class="text-center" style="text-align: center; border: 1px solid black">  Persentase Kesesuaian Materi Aktual dengan Materi RPS</td>
            <td class="text-center" style="text-align: center; border: 1px solid black">{{ number_format($persentaseKesesuaian, 2) }}% </td>
        </tr>
    </table>

    <table width="100%" style="font-family: Times New Roman; margin-top:20px; margin-right:20px">
            <tr>
                <td width="60%" align="right">
                    <!-- Disini untuk perintah Qr code -->
                </td>
                <td class="text" style="text-align: left;">
                    <div class="container">
                        <p>Pekanbaru, {{ \Carbon\Carbon::now()->locale('id')->isoFormat('DD MMMM YYYY') }}</p>
                        <p style="margin-top:-10px;">Koordinator Prodi</p>
                        <div class="ttd">
                            
                        </div>
                        <br><br><br><br><br><br>
                        @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 6)
                        <strong
                            style="text-decoration: underline; ">Dian Yayan Sukma, S.T., M.T.</strong><br>NIP.
                        197803082003121001
                        @elseif (Auth::user()->role_id == 3 || Auth::user()->role_id == 7)
                        <strong
                            style="text-decoration: underline; ">Dr. Fri Murdiya, S.T., M.T.</strong><br>NIP.
                        198002052003121001
                         @elseif (Auth::user()->role_id == 4 || Auth::user()->role_id == 8)
                         <strong
                            style="text-decoration: underline; ">Dr. Feri Candra, ST., MT</strong><br>NIP.
                        197404282002121003
                        @endif
                    </div>
                    <br>
                </td>
            </tr>
        </table>
</body>

</html>
