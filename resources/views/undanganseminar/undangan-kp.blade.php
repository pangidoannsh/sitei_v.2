<!DOCTYPE html>
<html>
<head>
    <title>KPTI-6 Undangan Seminar Kerja Praktek</title>
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

        /*design table 1*/
        .table1 {
            font-family: Arial, sans-serif;
            font-size:13px;
            color: #232323;
            border-collapse: collapse;
            border: 1px solid #999;
            padding: 8px 20px;
            margin-top:30px;
            margin-left:auto;
            margin-right:auto;
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

            <table width="600px" style="text-align:center;">
                <tr>
                    <td>
                        <hr style="margin: 1px; border: 2px solid black">
                        <hr style="margin: 1px; border: 1px solid black">
                    </td>
                </tr>
            </table>
        </table>

        <table width="100%" style="text-align:center; margin-top:0px;">

        </table>

        <table width="100%" style="text-align: right; margin-top:-40px;">
            <tr>
                <td style="font-size:12pt;">
                    @if ($penjadwalan->mahasiswa->prodi->id == 1)
                        <strong style="border:1px solid #000; padding:4px">KPTE-6</strong>
                    @elseif ($penjadwalan->mahasiswa->prodi->id == 2)
                        <strong style="border:1px solid #000; padding:4px">KPTE-6</strong>
                    @else
                        <strong style="border:1px solid #000; padding:4px">KPTI-6</strong>
                    @endif
                </td>
            </tr>         
        </table>

    <table width="100%" style="font-family: Arial, sans-serif; margin-top:0px; line-height: 1.5">
        <tr class="text2">
            <td width="27%">Nomor</td>
            <td>:</td>
            <td width="70%" style="padding-left:30px;">/UN19.5.1.1.7/TE/DL/2022</td>
        </tr>
        <tr>
            <td width="27%">Lampiran</td>
            <td>:</td>
            <td width="70%">1 ( satu ) lembar</td>
        </tr>

        <tr>
            <td width="27%">Hal</td>
            <td>:</td>
            <td ><b><u>	Undangan Seminar KP</u></b></td>
        </tr>
    </table>
    <table width="100%" style="font-family: Arial, sans-serif; margin-top:0px; line-height: 1.5">
        <tr class="text2">
            <td width="27%">Kepada YTH  :</td>
        </tr>
        <tr>
            <td width="27%">Bapak/Ibu <span><b><u>{{ auth()->user()->nama }}</u></b></span></td>

        </tr>
        <tr>
            <td width="27%">Dosen Teknik Informatika UNRI</td>
        </tr>
        <tr>
            <td width="27%">di-</td>
        </tr>
        <tr>
            <td width="27%" style="padding-left:30px;"><u>Pekanbaru</u></td>
        </tr>
    </table>

    <table width="100%" style="font-family: Arial, sans-serif; margin-top:0px; line-height: 1.5">
        <tr class="text2">
            <td width="27%">Dengan hormat,</td>
        </tr>
        <tr>
            <td width="27%">Bersama ini kami mengundang Bapak/Ibu untuk  menghadiri  Seminar Kerja Praktek pada :</td>
        </tr>
    </table>

    <table width="100%" style="font-family: Arial, sans-serif; margin-top:0px; line-height: 1.5">
        <tr class="text2">
            <td width="27%">Hari/Tanggal</td>
            <td>:</td>
            <td width="70%">{{Carbon::parse($penjadwalan->tanggal)->translatedFormat('l, d F Y')}}</td>
        </tr>
        <tr>
            <td width="27%">Pukul</td>
            <td>:</td>
            <td width="70%">{{$penjadwalan->waktu}} WIB</td>
        </tr>

        <tr>
            <td width="27%">Tempat</td>
            <td>:</td>
            <td>{{$penjadwalan->lokasi}}</td>
        </tr>
    </table>

     <table width="100%" style="font-family: Arial, sans-serif; margin-top:0px; line-height: 1.5">
        <tr class="text2">
            <td width="27%">Demikian disampaikan, atas kesedian Bapak/Ibu datang tepat pada waktunya, diucapkan terima kasih.
</td>
        </tr>

    </table>



    

    <table width="100%" style="font-family: Arial, sans-serif; margin-top:0px;">
        <tr>
            <td class="text" style="text-align: left;">
                <div class="container">
                    <p>Mengetahui,</p>
                    @if ($penjadwalan->mahasiswa->prodi->id == 1)
                            <p>Koor. Program Studi Teknik Elektro D3</p>
                        @elseif ($penjadwalan->mahasiswa->prodi->id == 2)
                           <p>Koor. Program Studi Teknik Elektro S1</p> 
                        @else
                            <p>Koor. Program Studi Teknik Informatika</p> 
                        @endif
                    
                    <div class="ttd">
                        <img src="data:img/png;base64, {!! $qrcode !!}">
                    </div>
                    <br><br><br><br><br><br>
                     @if ($penjadwalan->mahasiswa->prodi->id == 1)
                            <strong style="text-decoration: underline;">{{ $kaprodi1->nama }}</strong><br>NIP.{{ $kaprodi1->nip }} 
                        @elseif ($penjadwalan->mahasiswa->prodi->id == 2)
                           <strong style="text-decoration: underline;">{{ $kaprodi2->nama }}</strong><br>NIP.{{ $kaprodi2->nip }} 
                        @else       
                            <strong style="text-decoration: underline;">{{ $kaprodi3->nama }}</strong><br>NIP.{{ $kaprodi3->nip }} 
                        @endif
                    
                </div>
                <br>
            </td>
            <td class="text" style="text-align: left;">
                <div class="container">
                    <p>Pekanbaru, {{Carbon::parse($penjadwalan->tanggal)->translatedFormat('d F Y')}} </p>

                    @if ($penjadwalan->mahasiswa->prodi->id == 1)
                            <p>Koordinator KP Teknik Elektro D3</p>
                        @elseif ($penjadwalan->mahasiswa->prodi->id == 2)
                           <p>Koordinator KP Teknik Elektro S1</p> 
                        @else
                            <p>Koordinator KP Teknik Informatika</p> 
                        @endif
                    <div class="ttd">
                        <img src="data:img/png;base64, {!! $qrcode !!}">
                    </div>
                    <br><br><br><br><br><br>
                     @if ($penjadwalan->mahasiswa->prodi->id == 1)
                            <strong style="text-decoration: underline;">{{ $koor1->nama }}</strong><br>NIP.{{ $koor1->nip }} 
                        @elseif ($penjadwalan->mahasiswa->prodi->id == 2)
                           <strong style="text-decoration: underline;">{{ $koor2->nama }}</strong><br>NIP.{{ $koor2->nip }} 
                        @else       
                            <strong style="text-decoration: underline;">{{ $koor3->nama }}</strong><br>NIP.{{ $koor3->nip }} 
                        @endif 
                </div>
                <br>
            </td>
        </tr>
    </table>

</div>

<!-- HALAMAN 2 -->

<div class="isi">
 <table width="100%" style="margin-top: 8px">
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

            <table width="600px" style="text-align:center;">
                <tr>
                    <td>
                        <hr style="margin: 1px; border: 2px solid black">
                        <hr style="margin: 1px; border: 1px solid black">
                    </td>
                </tr>
            </table>
        </table>

        <table width="100%" style="text-align:center; margin-top:0px;">

        </table>


         <table width="100%" style="font-family: Arial, sans-serif; margin-top:0px; line-height: 1.5">
        <tr class="text2">
            <td width="27%">Hari/tanggal</td>
            <td>:</td>
            <td width="70%">{{Carbon::parse($penjadwalan->tanggal)->translatedFormat('l, d F Y')}}</td>
        </tr>
        <tr>
            <td width="27%">Lampiran</td>
            <td>:</td>
            <td width="70%">Peserta Seminar Kerja Praktek Program Studi Teknik Informatika</td>
        </tr>

        <tr>
            <td width="27%">Semester</td>
            <td>:</td>
            <td>{{($penjadwalan->mahasiswa->angkatan - date('Y')) * -2 }}</td>
        </tr>
    </table>


        <!-- <table width="100%" style="font-family: Arial, sans-serif; margin-top:-10px;">
        <tr class="text2">
            <td width="70%" style="font-size:10px"><i>*coret yang tidak perlu</i></td>
        </tr>
    </table> -->

    <table width="100%" class="table1" style="font-family: Arial, sans-serif; margin-top:0px; text-align:center;">
        <tr>
            <!-- <th class="table1">No</th> -->
            <th class="table1"  >Nama</th>
            <th class="table1">Judul</th>
            <th class="table1" width="5px">Pembimbing</th>
            <th class="table1" >Penguji</th>
            <th class="table1" >Jam</th>
        </tr>
        <tr>
            <!-- <td class="table1">1</td>   -->
            <td class="table1">{{$penjadwalan->mahasiswa->nama}}</td>                
            <td class="table1">{{$penjadwalan->judul_kp}}</td>                        
            <td class="table1">{{$penjadwalan->pembimbing->nama_singkat}}</td>                        
            <td class="table1">{{$penjadwalan->penguji->nama_singkat}}</td>                        
            <td class="table1">{{$penjadwalan->waktu}} WIB</td>                        
        </tr>
        
    </table>

    <table width="100%" style="font-family: Arial, sans-serif; margin-top:0px; line-height: 1.5">
        <tr class="text2">
            <td width="27%"><b><u>Catatan   :</u></b></td>
        </tr>
        <tr class="text2">
            <td width="30%">Alokasi waktu seminar :</td>
        </tr>
        <tr class="text2">
            <td width="70%">
                <ol>
    <li>Ujian seminar dilaksanakan 30 menit (15 menit presentasi dan 10 menit untuk tanya jawab).</li>
    <li>Rapat Tim Penguji dan Pengumunan Kelulusan (5 menit).</li>
    <li>Waktu menyesuaikan dengan lama pelaksanaan seminar untuk itu penguji seminar diharapkan bersedia untuk melaksanakan seminar sebelum waktu yang ditetapkan.</li>
        </ol>
            </td>
        </tr>

    </table>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>
