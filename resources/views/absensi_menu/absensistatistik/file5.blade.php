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
                    <td style="font-weight: bold">: {{ $mata_kuliah->prodi->nama_prodi}}</td>
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
                    <td style="font-weight: bold">: {{ $mata_kuliah->semester->semester}} {{ $mata_kuliah->semester->tahun_ajaran}}</td>
                    <!-- Masukkan nilai semester dari data perkuliahan -->
                    <th style="text-align: left; padding-left: 20px;">Kelas</th>
                    <td style="font-weight: bold">: {{ $mata_kuliah->kelas->nama_kelas}}</td>
                    <!-- Masukkan nilai nama kelas dari data kelas -->
                </tr>

        </table>
    </div>

    <div style="margin-top: 20px;">
    <h4>Mahasiswa dengan Kehadiran Kurang dari 80%:</h4>
    <table class="center" border="1" style="border: 1px solid black;
  border-collapse: collapse; width: 670px; margin: auto; font-size: 14px;">
        <thead>
            <tr>
                <th class="text-center" scope="col">No</th>
                <th class="text-center" scope="col">Nama Mahasiswa</th>
                <th class="text-center" scope="col">Persentase Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($studentsUnderEightyPercent  as $key => $student)
            <tr>
                <td class="text-center" style="text-align: center">{{ $loop->iteration }}</td>
                <td class="text-center" style="text-align: left; margin-left:10px">{{ $student->nama ?? '-'}}</td>
                <td class="text-center" style="text-align: center">{{ number_format(($attendanceCounts[$student->nim ?? '-'] / 15) * 100, 2) }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>

</body>

</html>