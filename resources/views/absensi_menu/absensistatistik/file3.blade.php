<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Presensi Kehadiran</title>
</head>
<style>
    h3 {
        text-align: center;
        font-size: 18px;
        font-weight: bold;
    }

    h5 {
        text-align: center;
        font-size: 12px;
    }

    p {
        text-align: center;
        font-size: 14px;
        font-weight: bold;
    }

    div {
        text-align: center;
    }

    body {
        font-family: 'Nunito';
    }

    .absensi {
        display: flex;
        justify-content: flex-start;
    }

    .absensi .col-4 {
        flex-basis: 35%;
        /* Atur lebar kolom */
    }

    .absensi h6 span {
        display: inline-block;
        width: 35%;
        position: relative;
        padding-right: 5px;
        text-align: left;
        font-size: 14px;
        font-weight: bold;
    }

    .absensi h6 span::after {
        content: ":";
        position: absolute;
        right: 15px;
        /* Menambahkan jarak antara teks dan titik dua */
    }

    /* table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
table{
    width: 650px;
    margin-left: auto;
} */
    .center {
        margin-left: auto;
        margin-right: auto;
        margin-top: 20px;
    }
    .text-center{
        border: 1px solid black;"
    }
</style>

<body>
    <h3 style="margin-top: 20px;">FAKULTAS TEKNIK</h3>
    <p class="header font-weight-bold" style="margin-top: -15px;">Universitas Riau</p>
    <h3 style="margin-top: 5px;">DAFTAR PRESENSI KULIAH</h3>
    <div class="margin-top" style="margin-top: 10px">
        <table class="center" style="font-size: 13px; width: 680px; margin: auto; margin-bottom: 5px;">

                <tr>
                    <th style="text-align: left;">Mata Kuliah</th>
                    <td style="font-weight: bold">: {{ $mata_kuliah->mk}} </td>
                    <!-- Masukkan nilai nama mata kuliah dari data perkuliahan -->
                    <th style="text-align: left; padding-left: 20px;">Program Studi</th>
                    <td style="font-weight: bold">: {{ $mata_kuliah->prodi->nama_prodi ?? '-'}}</td>
                    <!-- Masukkan nilai program studi dari data kelas -->
                </tr>
                <tr>
                    <th style="text-align: left;">Kode Matakuliah</th>
                    <td style="font-weight: bold">: {{ $mata_kuliah->kode_mk}}</td>
                    <!-- Masukkan nilai kode mata kuliah dari data perkuliahan -->
                    <th style="text-align: left; padding-left: 20px;">Dosen</th>
                    <td style="font-weight: bold">: {{ $mata_kuliah->nip_dosen}}</td>
                    <!-- Masukkan nilai nama dosen dari data perkuliahan -->
                </tr>
                <tr>
                    <th style="text-align: left;">Semester</th>
                    <td style="font-weight: bold">: {{ $mata_kuliah->semester->semester ?? '-'}} {{ $mata_kuliah->semester->tahun_ajaran ?? '-'}}</td>
                    <!-- Masukkan nilai semester dari data perkuliahan -->
                    <th style="text-align: left; padding-left: 20px;">Kelas</th>
                    <td style="font-weight: bold">: {{ $mata_kuliah->kelas->nama_kelas ?? '-'}}</td>
                    <!-- Masukkan nilai nama kelas dari data kelas -->
                </tr>

        </table>
    </div>
    @php
    $totalStudentsPerColumn = [1 => 0, 2 => 0, 3 => 0, 4 => 0]; // Initialize column totals
    @endphp

    @foreach($groupedAttendances3 as $perkuliahanId => $attendances)
        @foreach($attendances as $attendance)
            @php
                // Count appearances in each column (excluding empty values)
                $totalStudentsPerColumn[1] += $attendance->keterangan !== '-' ? 1 : 0;
                $totalStudentsPerColumn[2] += ($attendance->keterangan === 'A') ? 1 : 0;
                $totalStudentsPerColumn[3] += ($attendance->keterangan === 'B') ? 1 : 0;
                $totalStudentsPerColumn[4] += ($attendance->keterangan === 'C') ? 1 : 0;
            @endphp
        @endforeach
    @endforeach


    <table class="center" border="1" style="border: 1px solid black;
  border-collapse: collapse; width: 670px; margin: auto; font-size: 14px;">  
    <thead>
        <tr>
            <th rowspan="2" class="text-center" scope="col">No. </th>
            <th rowspan="2" class="text-center" scope="col">NIM</th>
            <th rowspan="2" class="text-center" scope="col">Nama</th>
            <th colspan="4" class="text-center" scope="col">Keterangan</th>
            {{-- <th rowspan="2" class="text-center" scope="col">Materi</th> --}}
        </tr>
        <tr>
            <th class="text-center" style="width:76px">9</th>
            <th class="text-center" style="width:76px">10</th>
            <th class="text-center" style="width:76px">11</th>
            <th class="text-center" style="width:76px">12</th>
        </tr>
    </thead> 
        <tbody>
            @php
                $uniqueAttendances = collect(); 
            @endphp

                @foreach($groupedAttendances3 as $perkuliahanId => $attendances)
                    @foreach($attendances as $attendance)
                        @php
                            $uniqueAttendances[$attendance->student->nim ?? '-'] = $attendance->student; // Menyimpan entri unik berdasarkan id mahasiswa
                        @endphp
                    @endforeach
                @endforeach

                @foreach($sortedStudents as $student)
                <tr>
                    <td class="text-center" style="text-align: center">{{ $loop->iteration }}</td>
                    <td class="text-center" style="text-align: center">{{ $student->nim ?? '-' }}</td>
                    <td class="text-center" style="text-align: center">{{ $student->nama ?? '-'}}</td>
                    @php
                        $attendanceCounter = 0; // Counter untuk mengakses kehadiran per pertemuan
                    @endphp
                    @foreach($groupedAttendances3 as $perkuliahanId => $attendances)
                        @php
                            $attendance = $attendances->where('nim_mahasiswa', $student->nim ?? '-')->first(); // Cari kehadiran mahasiswa pada pertemuan tertentu
                        @endphp
                        <td class="text-center" style="text-align: center">
                            <!-- Periksa keterangan -->
                @if($attendance && $attendance->keterangan === 'Hadir')
                                <!-- Jika hadir, tampilkan kotak centang -->
                                <input type="checkbox" name="hadir[{{ $attendance->id }}]" checked>
                            @else
                                <!-- Jika tidak hadir, tampilkan keterangan asli -->
                {{ $attendance ? $attendance->keterangan : '' }}
                            @endif
                        </td>

                        @php
                            $attendanceCounter++;
                            if ($attendanceCounter >= 4) break; // Berhenti iterasi setelah mencapai 4 pertemuan
                        @endphp
                    @endforeach
                    @for ($i = $attendanceCounter; $i < 4; $i++)
                        <td class="text-center" style="text-align: center">-</td> <!-- Mengisi sisa kolom dengan tanda strip jika tidak ada data kehadiran -->
                    @endfor
                    {{-- <td class="text-center">{{ $attendances->first()->perkuliahan->materi }}</td> --}}
                </tr>
                @endforeach
                </tbody>
                
                <tr>
                <td colspan="3" class="text-center" >Jumlah Mahasiswa</td>
                @foreach($groupedAttendances3 as $perkuliahanId => $attendances)
        @php
            $totalStudents = $attendances->groupBy('nim_mahasiswa')->count(); // Menghitung jumlah mahasiswa yang hadir untuk setiap pertemuan
        @endphp
        <td class="text-center" style="text-align: center">{{ $totalStudents }}</td>
    @endforeach
    @for ($i = count($groupedAttendances3) + 1; $i <= 4; $i++)
        <!-- Jika jumlah pertemuan kurang dari 4, tampilkan sel kosong -->
        <td class="text-center" style="text-align: center">-</td>
    @endfor
                </tr>

                <tr>
    <td colspan="3" class="text-center" >Tanggal</td>
    @foreach ($groupedAttendances3 as $perkuliahanId => $attendances)
        <!-- Tampilkan tanggal untuk pertemuan -->
        <td class="text-center" style="text-align: center">{{ $tanggal3[$perkuliahanId] ?? '-' }}</td>
    @endforeach
    @for ($i = count($groupedAttendances3) + 1; $i <= 4; $i++)
        <!-- Jika jumlah pertemuan kurang dari 4, tampilkan sel kosong -->
        <td class="text-center" style="text-align: center">-</td>
    @endfor
</tr>

<tr>
    <td colspan="3" class="text-center" >Materi</td>
    @foreach ($groupedAttendances3 as $perkuliahanId => $attendances)
        <!-- Tampilkan materi untuk pertemuan -->
        <td class="text-center" style="text-align: center">{{ $materi3[$perkuliahanId] ?? '-' }}</td>
    @endforeach
    @for ($i = count($groupedAttendances3) + 1; $i <= 4; $i++)
        <!-- Jika jumlah pertemuan kurang dari 4, tampilkan sel kosong -->
        <td class="text-center" style="text-align: center">-</td>
    @endfor
</tr>



    </table>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>

</body>

</html>