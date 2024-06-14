@extends('absensi_menu.main')

@section('title')
    Riwayat Perkuliahan | SIA ELEKTRO
@endsection

@section('sub-title')
    Riwayat Absensi Perkuliahan
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="swal" data-swal="{{ session('message') }}"></div>
    @endif

    <div class="container card p-4">

        <ol class="breadcrumb col-lg-12">

            <li><a href="/absensi" class="px-1">Absensi ({{ $jumlah_absensi }})</a></li>
            <span class="px-2">|</span>
            <li><a href="{{ route('riwayat-absensi') }}" class="breadcrumb-item  px-1 fw-bold text-success">Riwayat
                    ({{ $jumlah_riwayat }})</a></li>
            <span class="px-2">|</span>
            <li><a href="{{ route('ruangan-absensi') }}" class="breadcrumb-item  px-1">Ruangan ({{ $jumlah_ruangan }})</a>
            </li>
            @if (Auth::guard('dosen')->check() && in_array(Auth::guard('dosen')->user()->role_id, [5, 6, 7, 8]))
                <span class="px-2">|</span>
                <li><a href="/matakuliah" class="breadcrumb-item px-1">Pengelola ({{ $countMatakuliah }})</a></li>
                <span class="px-2">|</span>
                <li><a href="{{ route('riwayat') }}" class="breadcrumb-item  px-1">Riwayat Matakuliah
                        ({{ $count }})</a></li>
            @endif
        </ol>
        @php
            $all_semester = [
                'Ganjil 2017/2018',
                'Genap 2017/2018',
                'Ganjil 2018/2019',
                'Genap 2018/2019',
                'Ganjil 2019/2020',
                'Genap 2019/2020',
                'Ganjil 2020/2021',
                'Genap 2020/2021',
                'Ganjil 2021/2022',
                'Genap 2021/2022',
                'Ganjil 2022/2023',
                'Genap 2022/2023',
                'Ganjil 2023/2024',
                'Genap 2023/2024',
            ]; // Ganti dengan daftar Prodi yang sesuai dengan aplikasi Anda

            $semester_list = [];

            foreach ($riwayatAbsensi as $abs) {
                $semester_list[] = $abs->semester->semester;
            }

            foreach ($riwayatAbsensi as $abs) {
                $semester_list[] = $abs->semester->tahun_ajaran;
            }

            $semester_list = array_unique($semester_list);

            $semester_list = array_merge($all_semester);

            $semester_list = array_unique($semester_list);

            $semester_list_with_year = [];

            foreach ($semester_list as $semester) {
                foreach ($all_semester as $year) {
                    $semester_list_with_year[] = $semester . ' ' . $year;
                }
            }
            sort($semester_list_with_year);
        @endphp

        <!-- Desktop Version -->
        <div class="d-none d-md-flex justify-content-between mb-3 filter">
            <div class="d-flex align-items-center">
                <div class="dataTables_length input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="lengthMenuRiwayatSemester">Tampilkan</label>
                    <select id="lengthMenuRiwayatSemester" class="custom-select custom-select-md rounded-3 py-1"
                        style="width: 55px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                    </select>
                </div>
                <div class="input-group ml-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="semesterFilterRiwayat">Semester</label>
                    <select id="semesterFilterRiwayat" class="custom-select custom-select-md rounded-3 py-1 text-capitalize"
                        style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($semester_list as $semester)
                            <option value="{{ $semester }}" class="text-capitalize">{{ $semester }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="dataTables_filter input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterSemesterRiwayatProdi">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1"
                    id="searchFilterSemesterRiwayatProdi" placeholder="">
            </div>
        </div>

        <!-- Tablet & Mobile Version -->
        <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
            <div class="dataTables_length input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="lengthMenuMobileSemesterProdi">Tampilkan</label>
                <select id="lengthMenuMobileSemesterProdi" class="custom-select custom-select-md rounded-3 py-1"
                    style="width: 55px;">
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="150">150</option>
                    <option value="200">200</option>
                    <option value="250">250</option>
                </select>
            </div>

        </div>
        <div class="d-flex flex-wrap justify-content-center gap-3 mb-3 filter d-block d-md-none">
            <div class="input-group mt-3" style="width: max-content;">
                <label class="pt-2 pr-2" for="semesterFilterMobileProdi">Semester</label>
                <select id="semesterFilterMobileProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize"
                    style="width: 83px;">
                    <option value="" selected>Semua</option>
                    @foreach ($semester_list as $semester)
                        <option value="{{ $semester }}" class="text-capitalize">{{ $semester }}</option>
                    @endforeach
                </select>
            </div>
            <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterMobileRiwayatSemester">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1"
                    style="width: 83px; id="searchFilterMobileRiwayatSemester" placeholder="">
            </div>
        </div>

        <table class="table table-responsive-lg text-center table-bordered table-striped" width="100%"
            id="datatablesSemester">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" scope="col">#</th>
                    <th class="text-center" scope="col">Kode</th>
                    <th class="text-center" scope="col">Mata Kuliah</th>
                    <th class="text-center" scope="col">Kelas</th>
                    <th class="text-center" scope="col">SKS</th>
                    <th class="text-center" scope="col">Dosen</th>
                    <th class="text-center" scope="col">Semester</th>
                    <th class="text-center" scope="col">Hari</th>
                    <th class="text-center" scope="col">Waktu</th>
                    <th class="text-center" scope="col">Ruangan</th>
                    <th class="text-center" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayatAbsensi as $absensi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $absensi->kode_mk }}</td>
                        <td>{{ $absensi->mk }}</td>
                        @if ($absensi->kelas == !null)
                            <td>{{ $absensi->kelas->nama_kelas }}</td>
                        @endif
                        <td>{{ $absensi->sks }}</td>
                        <td>{{ $absensi->dosenmatkul->nama_singkat ?? '-' }}</td>
                        @if ($absensi->semester == !null)
                            <td>{{ $absensi->semester->semester }} {{ $absensi->semester->tahun_ajaran }}</td>
                        @endif
                        <td>{{ $absensi->hari }}</td>
                        <td>{{ $absensi->jam }}</td>
                        @if ($absensi->ruangan == !null)
                            <td>{{ $absensi->ruangan->nama_ruangan }}</td>
                        @endif
                        <td>
                            <a href="{{ route('detail.statistik', ['matakuliah_id' => $absensi->id]) }}"
                                class="badge bg-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i
                                    class="fas fa-info-circle" aria-hidden="true"></i></a>
                            <a href="{{ route('download_pdf', ['matakuliah_id' => $absensi->id]) }}"
                                class="badge bg-success p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i
                                    class="fas fa-download" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <br>
    <br>
    <br>
@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <small> <span
                        class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank"
                        target="_blank" href="/developer/imperia">Imperia Prestise Sinaga </a>)
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);

        $(document).ready(function() {
            // Fungsi untuk menghitung jumlah baris tabel dan memperbarui elemen absensiCount
            function updateAbsensiCount() {
                // Menghitung jumlah baris dalam tabel dengan ID datatablesAbsensi
                var rowCount = $('#datatablesSemester tbody tr').length;

                // Memperbarui nilai pada elemen dengan ID 'absensiCount'
                $('#riwayatCount').text(rowCount);
            }

            // Panggil fungsi updateAbsensiCount saat halaman dimuat sepenuhnya
            updateAbsensiCount();
        });
    </script>
@endpush()
