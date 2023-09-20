<!DOCTYPE html>
<html>
<head>
    <title>STI-9 Lembar Kontrol Perbaikan Proposal Skripsi</title>
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
                    <strong>LEMBAR KONTROL PERBAIKAN PROPOSAL SKRIPSI</strong> </td>
            </tr>
            <tr>
                <td style=" text-align: center; ">
                    (Untuk Penguji 1 / 3) </td>
            </tr>
        </table>

        <table width="100%" style="text-align: right; margin-top:-70px; margin-bottom:50px;">
            <tr>
                <td style="font-size:12pt;">
                    @if ($penjadwalan->mahasiswa->prodi->id == 1)
                        <strong style="border:1px solid #000; padding:4px">STE-9</strong>
                    @elseif ($penjadwalan->mahasiswa->prodi->id == 2)
                        <strong style="border:1px solid #000; padding:4px">STE-9</strong>
                    @else
                        <strong style="border:1px solid #000; padding:4px">STI-9</strong>
                    @endif
                </td>
            </tr>
        </table>

    <table width="100%" style="font-family: Arial, sans-serif; margin-top:10px; line-height: 1.5">
        <tr class="text2">
            <td>Nama Mahasiswa</td>
            <td>:</td>
            <td width="70%">{{$penjadwalan->mahasiswa->nama}}</td>
        </tr>
        <tr>
            <td>NIM</td>
            <td>:</td>
            <td width="70%">{{$penjadwalan->mahasiswa->nim}}</td>
        </tr>
        <tr>
            <td width="27%">Dosen Pembimbing 1</td>
            <td>:</td>
            <td width="70%">{{$penjadwalan->pembimbingsatu->nama}}</td>
        </tr>

        <tr>
            <td width="27%">Dosen Pembimbing 2</td>
            <td>:</td>
            @if ($penjadwalan->pembimbingdua_nip != null)
            <td width="70%">{{$penjadwalan->pembimbingdua->nama}}</td>
            @else
            <td width="70%">-</td>
            @endif  
        </tr>

        <tr>
            <td>Judul Skripsi</td>
            <td>:</td>
            <td>{{ $penjadwalan->revisi_proposal != null ? $penjadwalan->revisi_proposal : $penjadwalan->judul_proposal }}</td>
        </tr>
    </table>

    <table width="100%" style="font-family: Arial, sans-serif; ">
        <tr class="text2">
            <td>Tanggal Seminar</td>
            <td>:</td>
            <td width="70%">{{Carbon::parse($penjadwalan->tanggal)->translatedFormat('l, d F Y')}}</td>
        </tr>

        <tr class="text2">
            <td width="27%">Dosen Penguji (1 / 2 / 3)*</td>
            <td>:</td>
            <td width="70%">{{$penilaianpenguji->penguji->nama}}</td>
        </tr>
    </table>

    <table width="100%" style="font-family: Arial, sans-serif; margin-top:-13px;">
        <tr class="text2">
            <td width="70%" style="font-size:10px"><i>*coret yang tidak perlu</i></td>
        </tr>
    </table>

    <table width="100%" class="table1" style="font-family: Arial, sans-serif; margin-top:0px;">
        <tr>
            <th class="table1" width="10px">No</th>
            <th class="table1">Saran/Perbaikan</th>
            <th class="table1" width="10px">Paraf Pembimbing</th>
        </tr>
        <tr>
            <td class="table1">1</td>  
            <td class="table1">{{$penilaianpenguji->revisi_naskah1}}</td>                
            <td class="table1"></td>                        
        </tr>
        
        <tr>
            <td class="table1">2</td>  
            <td class="table1">{{$penilaianpenguji->revisi_naskah2}}</td>              
            <td class="table1"></td>   
        </tr>
        
        <tr>
            <td class="table1">3</td>  
            <td class="table1">{{$penilaianpenguji->revisi_naskah3}}</td>                
            <td class="table1"></td>                        
        </tr>  

        <tr>
            <td class="table1">4</td>  
            <td class="table1">{{$penilaianpenguji->revisi_naskah4}}</td>
            <td class="table1"></td>                        
        </tr>  

        <tr>
            <td class="table1">5</td>  
            <td class="table1">{{$penilaianpenguji->revisi_naskah5}}</td>               
            <td class="table1"></td>                        
        </tr>           
    </table>

    <table width="100%" style="font-family: Arial, sans-serif; margin-top:100px;">
        <tr>
            <td width="60%" align="right">
                <!-- Disini untuk perintah Qr code -->
            </td>
            <td class="text" style="text-align: left;">
                <div class="container">
                    <p>Pekanbaru, {{Carbon::parse($penjadwalan->tanggal)->translatedFormat('d F Y')}} </p>
                    <p>Dosen Penguji</p>
                    <div class="ttd">
                        <img src="data:img/png;base64, {!! $qrcode !!}">
                    </div>
                    <br><br><br><br><br><br>
                    <strong style="text-decoration: underline;">{{$penilaianpenguji->penguji->nama}}</strong><br>NIP. {{$penilaianpenguji->penguji->nip}}
                </div>
                <br>
            </td>
        </tr>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>
