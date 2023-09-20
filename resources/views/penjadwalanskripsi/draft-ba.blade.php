<!DOCTYPE html>
<html>
<head>
    <title>STI-15 Berita Acara Sidang Skripsi</title>
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
            font-size:13px;
            color: #232323;
            border-collapse: collapse;
            border: 1px solid #999;
            padding: 5px 10px;
            margin-top:30px;
            margin-left:auto;
            margin-right:auto;
        }

        .table2 {
            font-family: Arial, sans-serif;
            font-size:10px;
            color: #232323;
            border-collapse: collapse;
            border: 1px solid #999;
            padding: 3px 10px;
            margin-top:50px;
        }

        .tablesti15 {
            margin-top:30px;
            margin-left:20px;
        }

        .tablesti15_2 {
            margin-left:20px;
        }

        .tablesti15_3 {
            margin-top:-15px;
            margin-left:60%;
        }

        .tablesti15_4 {
            margin-top:-15px;
            margin-left:20px;
        }

        .tablesti15_6 {
            margin-top:-15px;
            margin-left:20px;
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

        .logo2 {
            position: absolute;
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
                        <font size="4">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</font><br>
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

            <table width="100%" style="margin: 0%">
                <tr>
                    <td>
                        <hr style="margin: 1px; border: 2px solid black">
                        <hr style="margin: 1px; border: 1px solid black">
                    </td>
                </tr>
            </table>
        </table>

        <table width="100%" style="margin-top: 0%">
            <tr>
                <td style="font-size:14pt; position:absolute; right:10%;">
                    @if ($penjadwalan->mahasiswa->prodi->id == 1)
                        <strong style="border:1px solid #000; padding:4px">STE-15</strong>
                    @elseif ($penjadwalan->mahasiswa->prodi->id == 2)
                        <strong style="border:1px solid #000; padding:4px">STE-15</strong>
                    @else
                        <strong style="border:1px solid #000; padding:4px">STI-15</strong>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="font-size:14pt; text-align: center; text-decoration: underline;">
                <br>
                <br>
                    <strong>BERITA ACARA SIDANG SKRIPSI</strong> </td>
            </tr>
        </table>

        <table width="100%" style="font-family: Arial, sans-serif; margin-top:20px;">
            <tr>
                <td><strong>Telah dilaksanakan sidang mahasiswa :</strong></td>
            </tr>
        </table>

    <table width="100%" style="font-family: Arial, sans-serif; margin-top:-15px; line-height: 1.5">
        <tr class="text2">
            <td>Nama</td>
            <td>:</td>
            <td width="70%">{{$penjadwalan->mahasiswa->nama}}</td>
        </tr>

        <tr>
            <td>NIM</td>
            <td>:</td>
            <td width="70%">{{$penjadwalan->mahasiswa->nim}}</td>
        </tr>

        <tr>
            <td>Judul Skripsi</td>
            <td>:</td>
            <td width="70%">{{ $penjadwalan->revisi_skripsi != null ? $penjadwalan->revisi_skripsi : $penjadwalan->judul_skripsi }}</td>
        </tr>

        <tr>
            <td>Hari / Tanggal</td>
            <td>:</td>
            <td width="70%">{{Carbon::parse($penjadwalan->tanggal)->translatedFormat('l, d F Y')}}</td>
        </tr>

        <tr>
            <td>Ruang / Pukul</td>
            <td>:</td>
            <td width="70%">{{$penjadwalan->lokasi}}, {{$penjadwalan->waktu}}</td>
        </tr>
    </table>

    <table width="100%" style="font-family: Arial, sans-serif; margin-top:-15px;">
        <tr class="text2">
            <td>Hasil sidang memutuskan bahwa mahasiswa tersebut di atas dinyatakan :</td>
        </tr>
    </table>

    @if ($penjadwalan->pembimbingdua_nip == null && $penjadwalan->pengujitiga_nip == null)
        
        @if (($nilaipembimbing1->total_nilai_angka + ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka) / 2) >= 60)

        <table width="100%" style="font-family: Arial, sans-serif; margin-top:-15px;">
            <tr class="text2">
                <td>-&nbsp;<strong>LULUS</strong> dengan nilai angka 
                    <strong> (
                        <?php
                                          $nilai_masuk=0;
                                          if(!empty($nilaipenguji1)){
                                            $nilai_masuk=$nilai_masuk+1;
                                            $penguji1=$nilaipenguji1->total_nilai_angka;
                                          }
                                          else{
                                            $penguji1=0;
                                          }
                                          if(!empty($nilaipenguji2)){
                                            $nilai_masuk=$nilai_masuk+1;
                                            $penguji2=$nilaipenguji2->total_nilai_angka;
                                          }
                                          else{
                                            $penguji2=0;
                                          }
                                          if(!empty($nilaipenguji3)){
                                            $nilai_masuk=$nilai_masuk+1;
                                            $penguji3=$nilaipenguji3->total_nilai_angka;
                                          }
                                          else{
                                            $penguji3=0;
                                          }
                                          $nilaitotalpenguji=round(($penguji1+$penguji2+$penguji3)/$nilai_masuk);
                                          $nilai_masuk=0;
                                          
                                          if(!empty($nilaipembimbing1)){
                                            $nilai_masuk=$nilai_masuk+1;
                                            $pembimbing1=$nilaipembimbing1->total_nilai_angka;
                                          }
                                          else{
                                            $pembimbing1=0;
                                          }
                                          if(!empty($nilaipembimbing2)){
                                            $nilai_masuk=$nilai_masuk+1;
                                            $pembimbing2=$nilaipembimbing2->total_nilai_angka;
                                          }
                                          else{
                                            $pembimbing2=0;
                                          }
                                          if($nilai_masuk== 0){
                                            $nilai_masuk=1;
                                          }
                                          $nilaitotalpembimbing = round(($pembimbing1+$pembimbing2)/$nilai_masuk);
                                          $nilai_masuk_akhir=0;
                                          if($nilaitotalpenguji != 0){
                                            $nilai_masuk_akhir=$nilai_masuk_akhir+1;
                                            $penguji=$nilaitotalpenguji;
                                          }
                                          else{
                                            $penguji=0;
                                          }
                                          if($nilaitotalpembimbing != 0){
                                            $nilai_masuk_akhir=$nilai_masuk_akhir+1;
                                            $pembimbing=$nilaitotalpembimbing;
                                          }
                                          else{
                                            $pembimbing=0;
                                          }
                                          $total_nilai = ($penguji+$pembimbing);
                                          ?>
                                          {{$total_nilai}}
                        )                
                    </strong>
                    dan huruf mutu
                    <strong> (
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
                         )
                    </strong>
                    diberikan waktu hingga tanggal {{Carbon::parse($nextMonth)->translatedFormat('d F Y')}} untuk menyempurnakan Skripsi. Adapun hasil revisi skripsi wajib dilaporkan kepada : Pembimbing ( ), Penguji ( ). Apabila tidak menyelesaikan revisi skripsi sampai batas waktu yang ditentukan, maka hasil sidang ini dinyatakan BATAL dan mahasiswa yang bersangkutan harus melakukan sidang ulang.</td>
            </tr>
        </table>

        <table width="100%" style="font-family: Arial, sans-serif; margin-top:-15px;">
            <tr class="text2">
                <td>-&nbsp;<strong>TIDAK LULUS</strong> dengan alasan sebagai berikut :
                <br>
                ............................................................................. 
                <br>
                .............................................................................</td>
            </tr>
        </table>

        @else

        <table width="100%" style="font-family: Arial, sans-serif; margin-top:-15px;">
            <tr class="text2">
                <td>-&nbsp;<strong>LULUS</strong> dengan nilai angka 
                    <strong>()</strong>
                    dan huruf mutu
                    <strong>()</strong>
                    diberikan waktu hingga tanggal .................. untuk menyempurnakan Skripsi. Adapun hasil revisi skripsi wajib dilaporkan kepada : Pembimbing ( ), Penguji ( ). Apabila tidak menyelesaikan revisi skripsi sampai batas waktu yang ditentukan, maka hasil sidang ini dinyatakan BATAL dan mahasiswa yang bersangkutan harus melakukan sidang ulang.</td>
            </tr>
        </table>

        <table width="100%" style="font-family: Arial, sans-serif; margin-top:-15px;">
            <tr class="text2">
                <td>-&nbsp;<strong>TIDAK LULUS</strong> dengan alasan sebagai berikut :
                <br>
                {{ $penjadwalan->catatan }}
                </td>
            </tr>
        </table>

        @endif
    @elseif ($penjadwalan->pembimbingdua_nip != null && $penjadwalan->pengujitiga_nip != null)
        
        @if ((($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 +
        ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) >= 60)
        
        <table width="100%" style="font-family: Arial, sans-serif; margin-top:-15px;">
            <tr class="text2">
                <td>-&nbsp;<strong>LULUS</strong> dengan nilai angka 
                    <strong> (
                        <?php
                                          $nilai_masuk=0;
                                          if(!empty($nilaipenguji1)){
                                            $nilai_masuk=$nilai_masuk+1;
                                            $penguji1=$nilaipenguji1->total_nilai_angka;
                                          }
                                          else{
                                            $penguji1=0;
                                          }
                                          if(!empty($nilaipenguji2)){
                                            $nilai_masuk=$nilai_masuk+1;
                                            $penguji2=$nilaipenguji2->total_nilai_angka;
                                          }
                                          else{
                                            $penguji2=0;
                                          }
                                          if(!empty($nilaipenguji3)){
                                            $nilai_masuk=$nilai_masuk+1;
                                            $penguji3=$nilaipenguji3->total_nilai_angka;
                                          }
                                          else{
                                            $penguji3=0;
                                          }
                                          $nilaitotalpenguji=round(($penguji1+$penguji2+$penguji3)/$nilai_masuk);
                                          $nilai_masuk=0;
                                          
                                          if(!empty($nilaipembimbing1)){
                                            $nilai_masuk=$nilai_masuk+1;
                                            $pembimbing1=$nilaipembimbing1->total_nilai_angka;
                                          }
                                          else{
                                            $pembimbing1=0;
                                          }
                                          if(!empty($nilaipembimbing2)){
                                            $nilai_masuk=$nilai_masuk+1;
                                            $pembimbing2=$nilaipembimbing2->total_nilai_angka;
                                          }
                                          else{
                                            $pembimbing2=0;
                                          }
                                          if($nilai_masuk== 0){
                                            $nilai_masuk=1;
                                          }
                                          $nilaitotalpembimbing = round(($pembimbing1+$pembimbing2)/$nilai_masuk);
                                          $nilai_masuk_akhir=0;
                                          if($nilaitotalpenguji != 0){
                                            $nilai_masuk_akhir=$nilai_masuk_akhir+1;
                                            $penguji=$nilaitotalpenguji;
                                          }
                                          else{
                                            $penguji=0;
                                          }
                                          if($nilaitotalpembimbing != 0){
                                            $nilai_masuk_akhir=$nilai_masuk_akhir+1;
                                            $pembimbing=$nilaitotalpembimbing;
                                          }
                                          else{
                                            $pembimbing=0;
                                          }
                                          $total_nilai = ($penguji+$pembimbing);
                                          ?>
                                          {{$total_nilai}}
                        )                
                    </strong>
                    dan huruf mutu
                    <strong> (
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
                         )
                    </strong>
                    diberikan waktu hingga tanggal {{Carbon::parse($nextMonth)->translatedFormat('d F Y')}} untuk menyempurnakan Skripsi. Adapun hasil revisi skripsi wajib dilaporkan kepada : Pembimbing ( ), Penguji ( ). Apabila tidak menyelesaikan revisi skripsi sampai batas waktu yang ditentukan, maka hasil sidang ini dinyatakan BATAL dan mahasiswa yang bersangkutan harus melakukan sidang ulang.</td>
            </tr>
        </table>

        <table width="100%" style="font-family: Arial, sans-serif; margin-top:-15px;">
            <tr class="text2">
                <td>-&nbsp;<strong>TIDAK LULUS</strong> dengan alasan sebagai berikut :
                <br>
                ............................................................................. 
                <br>
                .............................................................................</td>
            </tr>
        </table>

        @else        

        <table width="100%" style="font-family: Arial, sans-serif; margin-top:-15px;">
            <tr class="text2">
                <td>-&nbsp;<strong>LULUS</strong> dengan nilai angka 
                    <strong>()</strong>
                    dan huruf mutu
                    <strong>()</strong>
                    diberikan waktu hingga tanggal .................. untuk menyempurnakan Skripsi. Adapun hasil revisi skripsi wajib dilaporkan kepada : Pembimbing ( ), Penguji ( ). Apabila tidak menyelesaikan revisi skripsi sampai batas waktu yang ditentukan, maka hasil sidang ini dinyatakan BATAL dan mahasiswa yang bersangkutan harus melakukan sidang ulang.</td>
            </tr>
        </table>

        <table width="100%" style="font-family: Arial, sans-serif; margin-top:-15px;">
            <tr class="text2">
                <td>-&nbsp;<strong>TIDAK LULUS</strong> dengan alasan sebagai berikut :
                <br>
                {{ $penjadwalan->catatan }}
                </td>
            </tr>
        </table>

        @endif
    
    @elseif ($penjadwalan->pembimbingdua_nip == null)
        
        @if (($nilaipembimbing1->total_nilai_angka + ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) >= 60)

            <table width="100%" style="font-family: Arial, sans-serif; margin-top:-15px;">
                <tr class="text2">
                    <td>-&nbsp;<strong>LULUS</strong> dengan nilai angka 
                        <strong> (
                            <?php
                                            $nilai_masuk=0;
                                            if(!empty($nilaipenguji1)){
                                                $nilai_masuk=$nilai_masuk+1;
                                                $penguji1=$nilaipenguji1->total_nilai_angka;
                                            }
                                            else{
                                                $penguji1=0;
                                            }
                                            if(!empty($nilaipenguji2)){
                                                $nilai_masuk=$nilai_masuk+1;
                                                $penguji2=$nilaipenguji2->total_nilai_angka;
                                            }
                                            else{
                                                $penguji2=0;
                                            }
                                            if(!empty($nilaipenguji3)){
                                                $nilai_masuk=$nilai_masuk+1;
                                                $penguji3=$nilaipenguji3->total_nilai_angka;
                                            }
                                            else{
                                                $penguji3=0;
                                            }
                                            $nilaitotalpenguji=round(($penguji1+$penguji2+$penguji3)/$nilai_masuk);
                                            $nilai_masuk=0;
                                            
                                            if(!empty($nilaipembimbing1)){
                                                $nilai_masuk=$nilai_masuk+1;
                                                $pembimbing1=$nilaipembimbing1->total_nilai_angka;
                                            }
                                            else{
                                                $pembimbing1=0;
                                            }
                                            if(!empty($nilaipembimbing2)){
                                                $nilai_masuk=$nilai_masuk+1;
                                                $pembimbing2=$nilaipembimbing2->total_nilai_angka;
                                            }
                                            else{
                                                $pembimbing2=0;
                                            }
                                            if($nilai_masuk== 0){
                                                $nilai_masuk=1;
                                            }
                                            $nilaitotalpembimbing = round(($pembimbing1+$pembimbing2)/$nilai_masuk);
                                            $nilai_masuk_akhir=0;
                                            if($nilaitotalpenguji != 0){
                                                $nilai_masuk_akhir=$nilai_masuk_akhir+1;
                                                $penguji=$nilaitotalpenguji;
                                            }
                                            else{
                                                $penguji=0;
                                            }
                                            if($nilaitotalpembimbing != 0){
                                                $nilai_masuk_akhir=$nilai_masuk_akhir+1;
                                                $pembimbing=$nilaitotalpembimbing;
                                            }
                                            else{
                                                $pembimbing=0;
                                            }
                                            $total_nilai = ($penguji+$pembimbing);
                                            ?>
                                            {{$total_nilai}}
                            )                
                        </strong>
                        dan huruf mutu
                        <strong> (
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
                            )
                        </strong>
                        diberikan waktu hingga tanggal {{Carbon::parse($nextMonth)->translatedFormat('d F Y')}} untuk menyempurnakan Skripsi. Adapun hasil revisi skripsi wajib dilaporkan kepada : Pembimbing ( ), Penguji ( ). Apabila tidak menyelesaikan revisi skripsi sampai batas waktu yang ditentukan, maka hasil sidang ini dinyatakan BATAL dan mahasiswa yang bersangkutan harus melakukan sidang ulang.</td>
                </tr>
            </table>

            <table width="100%" style="font-family: Arial, sans-serif; margin-top:-15px;">
                <tr class="text2">
                    <td>-&nbsp;<strong>TIDAK LULUS</strong> dengan alasan sebagai berikut :
                    <br>
                    ............................................................................. 
                    <br>
                    .............................................................................</td>
                </tr>
            </table>

        @else

            <table width="100%" style="font-family: Arial, sans-serif; margin-top:-15px;">
                <tr class="text2">
                    <td>-&nbsp;<strong>LULUS</strong> dengan nilai angka 
                        <strong>()</strong>
                        dan huruf mutu
                        <strong>()</strong>
                        diberikan waktu hingga tanggal .................. untuk menyempurnakan Skripsi. Adapun hasil revisi skripsi wajib dilaporkan kepada : Pembimbing ( ), Penguji ( ). Apabila tidak menyelesaikan revisi skripsi sampai batas waktu yang ditentukan, maka hasil sidang ini dinyatakan BATAL dan mahasiswa yang bersangkutan harus melakukan sidang ulang.</td>
                </tr>
            </table>

            <table width="100%" style="font-family: Arial, sans-serif; margin-top:-15px;">
                <tr class="text2">
                    <td>-&nbsp;<strong>TIDAK LULUS</strong> dengan alasan sebagai berikut :
                    <br>
                    {{ $penjadwalan->catatan }}
                    </td>
                </tr>
            </table>
        @endif              
    @elseif ($penjadwalan->pengujitiga_nip == null)
        
        @if ((($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 +
        ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka) / 2) >= 60)

            <table width="100%" style="font-family: Arial, sans-serif; margin-top:-15px;">
                    <tr class="text2">
                        <td>-&nbsp;<strong>LULUS</strong> dengan nilai angka 
                            <strong> (
                                <?php
                                                $nilai_masuk=0;
                                                if(!empty($nilaipenguji1)){
                                                    $nilai_masuk=$nilai_masuk+1;
                                                    $penguji1=$nilaipenguji1->total_nilai_angka;
                                                }
                                                else{
                                                    $penguji1=0;
                                                }
                                                if(!empty($nilaipenguji2)){
                                                    $nilai_masuk=$nilai_masuk+1;
                                                    $penguji2=$nilaipenguji2->total_nilai_angka;
                                                }
                                                else{
                                                    $penguji2=0;
                                                }
                                                if(!empty($nilaipenguji3)){
                                                    $nilai_masuk=$nilai_masuk+1;
                                                    $penguji3=$nilaipenguji3->total_nilai_angka;
                                                }
                                                else{
                                                    $penguji3=0;
                                                }
                                                $nilaitotalpenguji=round(($penguji1+$penguji2+$penguji3)/$nilai_masuk);
                                                $nilai_masuk=0;
                                                
                                                if(!empty($nilaipembimbing1)){
                                                    $nilai_masuk=$nilai_masuk+1;
                                                    $pembimbing1=$nilaipembimbing1->total_nilai_angka;
                                                }
                                                else{
                                                    $pembimbing1=0;
                                                }
                                                if(!empty($nilaipembimbing2)){
                                                    $nilai_masuk=$nilai_masuk+1;
                                                    $pembimbing2=$nilaipembimbing2->total_nilai_angka;
                                                }
                                                else{
                                                    $pembimbing2=0;
                                                }
                                                if($nilai_masuk== 0){
                                                    $nilai_masuk=1;
                                                }
                                                $nilaitotalpembimbing = round(($pembimbing1+$pembimbing2)/$nilai_masuk);
                                                $nilai_masuk_akhir=0;
                                                if($nilaitotalpenguji != 0){
                                                    $nilai_masuk_akhir=$nilai_masuk_akhir+1;
                                                    $penguji=$nilaitotalpenguji;
                                                }
                                                else{
                                                    $penguji=0;
                                                }
                                                if($nilaitotalpembimbing != 0){
                                                    $nilai_masuk_akhir=$nilai_masuk_akhir+1;
                                                    $pembimbing=$nilaitotalpembimbing;
                                                }
                                                else{
                                                    $pembimbing=0;
                                                }
                                                $total_nilai = ($penguji+$pembimbing);
                                                ?>
                                                {{$total_nilai}}
                                )                
                            </strong>
                            dan huruf mutu
                            <strong> (
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
                                )
                            </strong>
                            diberikan waktu hingga tanggal {{Carbon::parse($nextMonth)->translatedFormat('d F Y')}} untuk menyempurnakan Skripsi. Adapun hasil revisi skripsi wajib dilaporkan kepada : Pembimbing ( ), Penguji ( ). Apabila tidak menyelesaikan revisi skripsi sampai batas waktu yang ditentukan, maka hasil sidang ini dinyatakan BATAL dan mahasiswa yang bersangkutan harus melakukan sidang ulang.</td>
                    </tr>
            </table>

            <table width="100%" style="font-family: Arial, sans-serif; margin-top:-15px;">
                    <tr class="text2">
                        <td>-&nbsp;<strong>TIDAK LULUS</strong> dengan alasan sebagai berikut :
                        <br>
                        ............................................................................. 
                        <br>
                        .............................................................................</td>
                    </tr>
            </table>

        @else

            <table width="100%" style="font-family: Arial, sans-serif; margin-top:-15px;">
                <tr class="text2">
                    <td>-&nbsp;<strong>LULUS</strong> dengan nilai angka 
                        <strong>()</strong>
                        dan huruf mutu
                        <strong>()</strong>
                        diberikan waktu hingga tanggal .................. untuk menyempurnakan Skripsi. Adapun hasil revisi skripsi wajib dilaporkan kepada : Pembimbing ( ), Penguji ( ). Apabila tidak menyelesaikan revisi skripsi sampai batas waktu yang ditentukan, maka hasil sidang ini dinyatakan BATAL dan mahasiswa yang bersangkutan harus melakukan sidang ulang.</td>
                </tr>
            </table>

            <table width="100%" style="font-family: Arial, sans-serif; margin-top:-15px;">
                <tr class="text2">
                    <td>-&nbsp;<strong>TIDAK LULUS</strong> dengan alasan sebagai berikut :
                    <br>
                    {{ $penjadwalan->catatan }}
                    </td>
                </tr>
            </table>
        @endif
    @endif

    <table width="100%" style="font-family: Arial, sans-serif; margin-top:-15px;">
        <tr>
            <td><strong>Pengujian Sidang Skripsi:</strong></td>
        </tr>
    </table>

    <table width="100%" class="table1" style="font-family: Arial, sans-serif; margin-top:-8px; text-align:center;">
        <tr>
            <th class="table1" width="10px">N <br> o</th>
            <th class="table1">Nama</th>
            <th class="table1">Sebagai</th>
            <th class="table1">Tanda Tangan</th>
        </tr>
        <tr>
            <td class="table1">1</td>  
            <td class="table1">{{$penjadwalan->pembimbingsatu->nama}}</td>                
            <td class="table1">Pembimbing 1</td>
            <td class="table1"></td>                        
        </tr>
        
        <tr>
            <td class="table1">2</td>
            @if ($penjadwalan->pembimbingdua_nip != null)
            <td class="table1">{{ $penjadwalan->pembimbingdua->nama }}</td>
            @else
            <td class="table1">-</td>
            @endif
            <td class="table1">Pembimbing 2</td>                        
            <td class="table1"></td>
        </tr>
        
        <tr>
            <td class="table1">3</td>  
            <td class="table1">{{ $penjadwalan->pengujisatu->nama }}</td>                
            <td class="table1">Penguji 1</td>
            <td class="table1"></td>                        
        </tr>  

        <tr>
            <td class="table1">4</td>  
            <td class="table1">{{ $penjadwalan->pengujidua->nama }}</td>                
            <td class="table1">Penguji 2</td>                        
            <td class="table1"></td>
        </tr>  

        <tr>
            <td class="table1">5</td>
            @if ($penjadwalan->pengujitiga_nip != null)
            <td class="table1">{{ $penjadwalan->pengujitiga->nama }}</td>
            @else
            <td class="table1">-</td>
            @endif
            <td class="table1">Penguji 3</td>                        
            <td class="table1"></td>
        </tr>    
    </table>

    <table width="100%" style="font-family: Arial, sans-serif; ">
        <tr>
            <td align="left">
            </td>
            <td class="text" style="text-align: left;">
                @if ($penjadwalan->mahasiswa->prodi->id == 1)
                    <div class="container">
                        <p>Koordinator Skripsi,</p>
                        <div class="ttd">                            
                        </div>
                        <br><br><br><br>
                        <strong style="text-decoration: underline;">Firdaus, ST., MT</strong><br>NIP. 197705102005011002
                    </div>
                @elseif ($penjadwalan->mahasiswa->prodi->id == 2)
                    <div class="container">
                        <p>Koordinator Skripsi,</p>
                        <div class="ttd">                            
                        </div>
                        <br><br><br><br>
                        <strong style="text-decoration: underline;">Rahmat Rizal Andhi, ST., MT</strong><br>NIP. 198312032019031006
                    </div>
                @else
                    <div class="container">
                        <p>Koordinator Skripsi,</p>
                        <div class="ttd">                            
                        </div>
                        <br><br><br><br>
                        <strong style="text-decoration: underline;">Edi Susilo, S.Pd., M.Kom., M.Eng</strong><br>NIP. 199110292019031010
                    </div>
                @endif            
                <br>
            </td>
        </tr>
    </table>

    <table width="100%" style="font-family: Arial, sans-serif; margin-top:-170px;">
        <tr>
            <td width="65%" align="right">                
            </td>
            <td class="text" style="text-align: left;">                
                <div class="container">
                    <p>Pekanbaru, {{Carbon::parse($penjadwalan->tanggal)->translatedFormat('d F Y')}} </p>
                    <p>Ketua Tim Penguji,</p>
                    <div class="ttd">
                            {{ QrCode::size(50)->generate(url('/detail-skripsi'. '/' . $penjadwalan->id)); }}
                    </div>
                    <br><br><br><br>
                    <strong style="text-decoration: underline;">{{$penjadwalan->pengujisatu->nama}}</strong><br>NIP. {{$penjadwalan->pengujisatu->nip}}
                </div>                
                <br>
            </td>
        </tr>
    </table>

    <table width="100%" style="font-family: Arial, sans-serif; ">
        <tr>
            <td width="20%" align="center">                
            </td>
            <td class="text" style="text-align: left;">
                @if ($penjadwalan->mahasiswa->prodi->id == 1)
                    <div class="container">
                        <p>Koor. Program Studi Teknik Elektro D3 </p>
                        <p>Koordinator,</p>
                        <div class="ttd">                            
                        </div>
                        <br><br><br><br>
                        <strong style="text-decoration: underline;">Amir Hamzah, ST., MT</strong><br>NIP. 197507052002121003
                    </div>
                @elseif ($penjadwalan->mahasiswa->prodi->id == 2)
                    <div class="container">
                        <p>Koor. Program Studi Teknik Elektro S1 </p>
                        <p>Koordinator,</p>
                        <div class="ttd">                            
                        </div>
                        <br><br><br><br>
                        <strong style="text-decoration: underline;">Yusnita Rahayu, ST, M.Eng, Ph.D</strong><br>NIP. 197511042005012001
                    </div>
                @else
                    <div class="container">
                        <p>Koor. Program Studi Teknik Informatika </p>
                        <p>Koordinator,</p>
                        <div class="ttd">                            
                        </div>
                        <br><br><br><br>
                        <strong style="text-decoration: underline;">Dr. Feri Candra, ST., MT</strong><br>NIP. 197404282002121003
                    </div>
                @endif            
                <br>
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-top:200px;">
            <tr>
                <td>
                    <div class="logo2">
                        <img id="img" src="https://live.staticflickr.com/65535/51644220143_f5dba04544_o_d.png"
                            width="110" height="110">
                    </div>
                </td>
                <td>
                    <center>
                        <font size="4">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</font><br>
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

            <table width="100%" style="margin: 0%">
                <tr>
                    <td>
                        <hr style="margin: 1px; border: 2px solid black">
                        <hr style="margin: 1px; border: 1px solid black">
                    </td>
                </tr>
            </table>
        </table>

    <table class="tablesti15" width="100%" style="font-family: Arial, sans-serif; line-height: 1.5">
        <tr>
        <td style="font-weight:bold; text-decoration:underline;">LAMPIRAN - NILAI SIDANG SKRIPSI</td>
        </tr>

        <tr>
        <td style="font-weight:bold;">NILAI PEMBIMBING</td>
        </tr>

        <tr>
            <td width="30%">PEMBIMBING 1 &nbsp; ({{$penjadwalan->pembimbingsatu->nama}}) </td>
            <td>: &nbsp; {{$nilaipembimbing1->total_nilai_angka}} </td>
        </tr>

        <tr>
            @if ($penjadwalan->pembimbingdua_nip != null)
            <td>PEMBIMBING 2 &nbsp; ({{$penjadwalan->pembimbingdua->nama}})</td>
            <td>: &nbsp; {{$nilaipembimbing2->total_nilai_angka}} </td>
            @else
            <td>PEMBIMBING 2 &nbsp; (-)</td>
            <td>: &nbsp; - </td>
            @endif
        </tr>
    </table>

    <table class="tablesti15_6" width="69%" style="font-family: Arial, sans-serif; line-height: 1.5">
        <tr>
            <td style="font-weight:bold;">RATA-RATA NILAI PEMBIMBING</td>
            <td>:</td>
            <td>
            <?php
                                                $nilai_masuk1=0;
                                                
                                                if(!empty($nilaipembimbing1)){
                                                  $nilai_masuk1=$nilai_masuk1+1;
                                                  $pembimbing1=$nilaipembimbing1->total_nilai_angka;
                                                }
                                                else{
                                                  $pembimbing1=0;
                                                }
                                                if(!empty($nilaipembimbing2)){
                                                  $nilai_masuk1=$nilai_masuk1+1;
                                                  $pembimbing2=$nilaipembimbing2->total_nilai_angka;
                                                }
                                                else{
                                                  $pembimbing2=0;
                                                }
                                                $nilaitotalpembimbing = round(($pembimbing1+$pembimbing2)/$nilai_masuk1);
                                              ?>
                                          {{ $nilaitotalpembimbing }}
            </td>            
        </tr>
    </table> 

    <table class="tablesti15_2" width="100%" style="font-family: Arial, sans-serif; line-height: 1.5">
        <tr>
            <td style="font-weight:bold;">NILAI PENGUJI</td>
        </tr>
        <tr>
            <td width="30%">PENGUJI 1 &nbsp; ({{$penjadwalan->pengujisatu->nama}})</td>
            <td>: &nbsp; {{$nilaipenguji1->total_nilai_angka}} </td>
        </tr>

        <tr>
            <td>PENGUJI 2 &nbsp; ({{$penjadwalan->pengujidua->nama}})</td>
            <td>: &nbsp; {{$nilaipenguji2->total_nilai_angka}} </td>
        </tr>

        <tr>
            @if ($penjadwalan->pengujitiga_nip != null)
            <td>PENGUJI 3 &nbsp; ({{$penjadwalan->pengujitiga->nama}})</td>
            <td>: &nbsp; {{$nilaipenguji3->total_nilai_angka}} </td>
            @else
            <td>PENGUJI 3 &nbsp; (-)</td>
            <td>: &nbsp; - </td>
            @endif
        </tr>
    </table>

    <table class="tablesti15_6" width="70%" style="font-family: Arial, sans-serif; line-height: 1.5">
        <tr>
            <td style="font-weight:bold;">RATA-RATA NILAI PENGUJI</td>
            <td>:</td>
            <td>
            <?php
                                                $nilai_masuk=0;
                                                if(!empty($nilaipenguji1)){
                                                  $nilai_masuk=$nilai_masuk+1;
                                                  $penguji1=$nilaipenguji1->total_nilai_angka;
                                                }
                                                else{
                                                  $penguji1=0;
                                                }
                                                if(!empty($nilaipenguji2)){
                                                  $nilai_masuk=$nilai_masuk+1;
                                                  $penguji2=$nilaipenguji2->total_nilai_angka;
                                                }
                                                else{
                                                  $penguji2=0;
                                                }
                                                if(!empty($nilaipenguji3)){
                                                  $nilai_masuk=$nilai_masuk+1;
                                                  $penguji3=$nilaipenguji3->total_nilai_angka;
                                                }
                                                else{
                                                  $penguji3=0;
                                                }
                                                $nilaitotalpenguji=round(($penguji1+$penguji2+$penguji3)/$nilai_masuk);
                                                ?>
                                            {{ $nilaitotalpenguji }}
            </td>            
        </tr>
    </table>

    <table class="tablesti15_3" width="60%">
        <tr>
        <td><hr style="margin: 1px; border: 1px solid black"></td>
        <td>&#43;</td>
        </tr>
    </table>

    <table class="tablesti15_4" width="68%" style="font-family: Arial, sans-serif; line-height: 1.5">
        <tr>
            <td><b>TOTAL NILAI PEMBIMBING + PENGUJI</b></td>
            <td>:</td>
            <td>
            <?php
                                          $nilai_masuk=0;
                                          if(!empty($nilaipenguji1)){
                                            $nilai_masuk=$nilai_masuk+1;
                                            $penguji1=$nilaipenguji1->total_nilai_angka;
                                          }
                                          else{
                                            $penguji1=0;
                                          }
                                          if(!empty($nilaipenguji2)){
                                            $nilai_masuk=$nilai_masuk+1;
                                            $penguji2=$nilaipenguji2->total_nilai_angka;
                                          }
                                          else{
                                            $penguji2=0;
                                          }
                                          if(!empty($nilaipenguji3)){
                                            $nilai_masuk=$nilai_masuk+1;
                                            $penguji3=$nilaipenguji3->total_nilai_angka;
                                          }
                                          else{
                                            $penguji3=0;
                                          }
                                          $nilaitotalpenguji=round(($penguji1+$penguji2+$penguji3)/$nilai_masuk);
                                          $nilai_masuk=0;
                                          
                                          if(!empty($nilaipembimbing1)){
                                            $nilai_masuk=$nilai_masuk+1;
                                            $pembimbing1=$nilaipembimbing1->total_nilai_angka;
                                          }
                                          else{
                                            $pembimbing1=0;
                                          }
                                          if(!empty($nilaipembimbing2)){
                                            $nilai_masuk=$nilai_masuk+1;
                                            $pembimbing2=$nilaipembimbing2->total_nilai_angka;
                                          }
                                          else{
                                            $pembimbing2=0;
                                          }
                                          if($nilai_masuk== 0){
                                            $nilai_masuk=1;
                                          }
                                          $nilaitotalpembimbing = round(($pembimbing1+$pembimbing2)/$nilai_masuk);
                                          $nilai_masuk_akhir=0;
                                          if($nilaitotalpenguji != 0){
                                            $nilai_masuk_akhir=$nilai_masuk_akhir+1;
                                            $penguji=$nilaitotalpenguji;
                                          }
                                          else{
                                            $penguji=0;
                                          }
                                          if($nilaitotalpembimbing != 0){
                                            $nilai_masuk_akhir=$nilai_masuk_akhir+1;
                                            $pembimbing=$nilaitotalpembimbing;
                                          }
                                          else{
                                            $pembimbing=0;
                                          }
                                          $total_nilai = ($penguji+$pembimbing);
                                          ?>
                                          {{$total_nilai}}
            </td>           
        </tr>
        <tr>
            <td><b>NILAI AKHIR (HURUF)</b></td>
                <td>:</td>
                <td>
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
                </td>               
            </tr>
    </table>

    <table width="100%" style="font-family: Arial, sans-serif; margin-top:50px;">
        <tr>
            <td width="60%" align="right">
                <!-- Disini untuk perintah Qr code -->
            </td>
            <td class="text" style="text-align: left;">
                <div class="container">
                    <p>Pekanbaru, {{Carbon::parse($penjadwalan->tanggal)->translatedFormat('d F Y')}} </p>
                    <p>Ketua Tim Penguji,</p>
                    <div class="ttd">
                        {{ QrCode::size(80)->generate(url('/detail-skripsi'. '/' . $penjadwalan->id)); }}
                    </div>
                    <br><br><br><br><br><br>
                    <strong style="text-decoration: underline;">{{$penjadwalan->pengujisatu->nama}}</strong><br>NIP. {{$penjadwalan->pengujisatu->nip}}
                </div>
                <br>
            </td>
        </tr>
    </table>

    <table class="table2" style="font-family: Arial, sans-serif; text-align:center; margin-top:-10px;">
        <tr>
            <th class="table2">Nilai Angka</th>
            <th class="table2">Nilai <br> Mutu</th>
            <th class="table2">Angka <br> Mutu</th>
            <th class="table2">Sebutan <br> Mutu</th>
            <th class="table2">Publikasi</th>
        </tr>
        <tr>
            <td class="table2">X &ge; 85 </td>  
            <td class="table2">A</td>                
            <td class="table2">4,00</td>
            <td rowspan="2" class="table2">Sgt Baik</td>                        
            <td class="table2">Q1-Q4, Sinta 1, Sinta 2</td>                        
        </tr>
        
        <tr>
            <td class="table2">80 &le; X &lt; 85</td>  
            <td class="table2">A -</td>                
            <td class="table2">3,75</td>                
            <td class="table2">Sinta 3, Sinta 4, Conf (IEEE, IOP, SCOPUS))</td>                        
        </tr>
        
        <tr>
            <td class="table2">75 &le; X &lt; 80</td>  
            <td class="table2">B +</td>                
            <td class="table2">3,50</td>                
            <td rowspan="3" class="table2">Baik</td>
            <td rowspan="7" class="table2">-</td>                        
        </tr>  

        <tr>
            <td class="table2">70 &le; X &lt; 75</td>  
            <td class="table2">B</td>                
            <td class="table2">3,00</td>                
        </tr>  

        <tr>
            <td class="table2">65 &le; X &lt; 70</td>  
            <td class="table2">B -</td>                
            <td class="table2">2,75</td>                
        </tr>  

        <tr>
            <td class="table2">60 &le; X &lt; 65</td>  
            <td class="table2">C +</td>                
            <td class="table2">2,50</td>                
            <td rowspan="2" class="table2">Cukup</td>                        
        </tr>  

        <tr>
            <td class="table2">55 &le; X &lt; 60</td>  
            <td class="table2">C</td>                
            <td class="table2">2,00</td>                
        </tr>  

        <tr>
            <td class="table2">40 &le; X &lt; 55</td>  
            <td class="table2">D</td>                
            <td class="table2">1,00</td>                
            <td class="table2">Kurang</td>                        
        </tr>  

        <tr>
            <td class="table2">X &lt; 40</td>  
            <td class="table2">E</td>                
            <td class="table2">0,00</td>                
            <td class="table2">Sangat <br> Kurang</td>                        
        </tr>  
    </table>

    <table width="100%">
        <tr>
            <td style="font-size:10px;"><b>Catatan:</b></td>  
        </tr>
        
        <tr>
        <td style="font-size:10px;">Form ini dikembalikan ke koordinator skripsi melalui staf administrasi disertai form STI-13 dan STI-14.</td>                
        </tr>
    </table>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>
