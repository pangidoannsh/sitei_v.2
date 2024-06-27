@extends('absensi_menu.main')

@section('title')
    Riwayat Mata Kuliah | SIA ELEKTRO
@endsection

@section('sub-title')
    Riwayat Mata Kuliah
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="swal" data-swal="{{ session('message') }}"></div>
    @endif

    <div class="container card p-4">

        @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 4)
            <ol class="breadcrumb col-lg-12">
                <li><a href="/matakuliah" class="px-1">Mata Kuliah ({{ $countMatakuliah }})</a></li>
                <span class="px-2">|</span>
                <li><a href="{{ route('riwayat') }}" class="breadcrumb-item  px-1 fw-bold text-success">Riwayat
                        ({{ $count }})</a></li>
                <span class="px-2">|</span>
                <li><a href="{{ route('ruangan-absensi-admin') }}" class="breadcrumb-item  px-1">Ruangan
                        ({{ $jumlah_ruangan }})</a></li>
            </ol>
        @else
        @endif
        @if (Auth::user()->role_id == 5 ||
                Auth::user()->role_id == 6 ||
                Auth::user()->role_id == 7 ||
                Auth::user()->role_id == 8)
            <ol class="breadcrumb col-lg-12">
                <li><a href="/absensi" class="breadcrumb-item px-1">Absensi ({{ $jumlah_absensi }})</a></li>
                <span class="px-2">|</span>
                <li><a href="{{ route('riwayat-absensi') }}" class="breadcrumb-item  px-1">Riwayat
                        ({{ $jumlah_riwayat }})</a></li>
                <span class="px-2">|</span>
                <li><a href="{{ route('ruangan-absensi') }}" class="breadcrumb-item  px-1">Ruangan
                        ({{ $jumlah_ruangan }})</a></li>
                <span class="px-2">|</span>
                <li><a href="/matakuliah" class="breadcrumb-item px-1">Pengelola ({{ $countMatakuliah }})</a></li>
                <span class="px-2">|</span>
                <li><a href="{{ route('riwayat') }}" class="breadcrumb-item  px-1 fw-bold text-success">Riwayat Matakuliah
                        ({{ $count }})</a></li>
            </ol>
        @else
        @endif
        @if (Auth::user()->role_id == 1)
            <ol class="breadcrumb col-lg-12">
                <li><a href="/matakuliah" class="px-1">Mata Kuliah ({{ $countMatakuliah }})</a></li>
                <span class="px-2">|</span>
                <li><a href="{{ route('riwayat') }}" class="breadcrumb-item  px-1 fw-bold text-success">Riwayat
                        ({{ $count }})</a></li>
            </ol>
        @else
        @endif

        @php
            $all_prodi = ['Teknik Elektro D3', 'Teknik Elektro S1', 'Teknik Informatika S1']; // Ganti dengan daftar Prodi yang sesuai dengan aplikasi Anda

            $prodi_list = [];

            foreach ($matakuliah as $mtk) {
                $prodi_list[] = $mtk->prodi->nama_prodi;
            }

            foreach ($matakuliah as $mtk) {
                $prodi_list[] = $mtk->prodi->nama_prodi;
            }

            $prodi_list = array_unique($prodi_list);

            $prodi_list = array_merge($all_prodi, $prodi_list);

            $prodi_list = array_unique($prodi_list);

            sort($prodi_list);

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
            ]; // Ganti dengan daftar Prodi yang sesuai dengan aplikasi Anda

            $semester_list = [];

            foreach ($matakuliah as $mtk) {
                $semester_list[] = $mtk->semester->semester;
            }

            foreach ($matakuliah as $mtk) {
                $semester_list[] = $mtk->semester->tahun_ajaran;
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
                    <label class="pt-2 pr-2" for="lengthMenuMatakuliahProdi">Tampilkan</label>
                    <select id="lengthMenuMatakuliahProdi" class="custom-select custom-select-md rounded-3 py-1"
                        style="width: 55px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                    </select>
                </div>
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 5)
                    <div class="input-group ml-3" style="width: max-content;">
                        <label class="pt-2 pr-2" for="prodiFilterMatakuliahProdi">Prodi</label>
                        <select id="prodiFilterMatakuliahProdi"
                            class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                            <option value="" selected>Semua</option>
                            @foreach ($prodi_list as $prodi)
                                <option value="{{ $prodi }}" class="text-capitalize">{{ $prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 5)
                    <div class="input-group ml-3" style="width: max-content;">
                        <label class="pt-2 pr-2" for="semesterFilterRiwayatMatakuliahKajur">Semester</label>
                        <select id="semesterFilterRiwayatMatakuliahKajur"
                            class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                            <option value="" selected>Semua</option>
                            @foreach ($semester_list as $semester)
                                <option value="{{ $semester }}" class="text-capitalize">{{ $semester }}</option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <div class="input-group ml-3" style="width: max-content;">
                        <label class="pt-2 pr-2" for="semesterFilterRiwayatMatakuliah">Semester</label>
                        <select id="semesterFilterRiwayatMatakuliah"
                            class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                            <option value="" selected>Semua</option>
                            @foreach ($semester_list as $semester)
                                <option value="{{ $semester }}" class="text-capitalize">{{ $semester }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>

            <div class="dataTables_filter input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterMatakuliahSkripsiProdi">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1"
                    id="searchFilterMatakuliahSkripsiProdi" placeholder="">
            </div>
        </div>

        <!-- Tablet & Mobile Version -->
        <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
            <div class="dataTables_length input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="lengthMenuMobileMatakuliahProdi">Tampilkan</label>
                <select id="lengthMenuMobileMatakuliahProdi" class="custom-select custom-select-md rounded-3 py-1"
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
            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 5)
                <div class="input-group mt-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="prodiFilterMobileMatakuliahProdi">Prodi</label>
                    <select id="prodiFilterMobileMatakuliahProdi"
                        class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($prodi_list as $prodi)
                            <option value="{{ $prodi }}" class="text-capitalize">{{ $prodi }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 5)
                <div class="input-group mt-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="semesterFilterMobileProdi">Semester</label>
                    <select id="semesterFilterMobileProdi"
                        class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($semester_list as $semester)
                            <option value="{{ $semester }}" class="text-capitalize">{{ $semester }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                <div class="input-group mt-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="semesterFilterMobileProdiKajur">Semester</label>
                    <select id="semesterFilterMobileProdiKajur"
                        class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($semester_list as $semester)
                            <option value="{{ $semester }}" class="text-capitalize">{{ $semester }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterMobileMatakuliahProdi">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1"
                    style="width: 83px; id="searchFilterMobileMatakuliahProdi" placeholder="">
            </div>
        </div>
        <table class="table table-responsive-lg text-center table-bordered table-striped" style="width:100%"
            id="datatablesRiwayatMataKuliah">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" scope="col">#</th>
                    <th class="text-center" scope="col">Kode</th>
                    <th class="text-center" scope="col">Mata Kuliah</th>
                    @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 5)
                        <th class="text-center" scope="col">Prodi</th>
                    @else
                    @endif
                    <th class="text-center" scope="col">Kelas</th>
                    <th class="text-center" scope="col">SKS</th>
                    <th class="text-center" scope="col">Semester</th>
                    <th class="text-center" scope="col">Dosen</th>
                    <th class="text-center" scope="col">Hari</th>
                    <th class="text-center" scope="col">Jam</th>
                    <th class="text-center" scope="col">Ruangan</th>
                    <th class="text-center" scope="col">Kuota</th>
                    @if (Auth::user()->role_id == 2 ||
                            Auth::user()->role_id == 3 ||
                            Auth::user()->role_id == 4 ||
                            Auth::user()->role_id == 6 ||
                            Auth::user()->role_id == 7 ||
                            Auth::user()->role_id == 8)
                        <th class="text-center" scope="col">Aksi</th>
                    @else
                    @endif
                    @if (Auth::user()->role_id == 1)
                        <th class="text-center" scope="col">Aksi</th>
                    @else
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($matakuliah as $riwayat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $riwayat->kode_mk }}</td>
                        <td>{{ $riwayat->mk }}</td>
                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 5)
                            <td>{{ $riwayat->prodi->nama_prodi ?? '-' }}</td>
                        @endif
                        @if ($riwayat->kelas == !null)
                            <td>{{ $riwayat->kelas->nama_kelas }}</td>
                        @endif
                        <td>{{ $riwayat->sks }}</td>
                        @if ($riwayat->semester == !null)
                            <td>{{ $riwayat->semester->semester }} {{ $riwayat->semester->tahun_ajaran }}</td>
                        @endif
                        <td class="text-center">
                            <p>1. {{ $mtk->dosenmatkul->nama_singkat ?? '-' }} </p>
                            <p>2. {{ $mtk->dosenmatkul2->nama_singkat ?? '-' }}</p>
                        </td>
                        <td>{{ $riwayat->hari }}</td>
                        <td>{{ $riwayat->jam }}</td>
                        <td>{{ $riwayat->ruangan->gedung->nama_gedung }} ({{ $riwayat->ruangan->nama_ruangan }})</td>
                        <td>{{ $riwayat->kuota }}</td>
                        @if (Auth::user()->role_id == 2 ||
                                Auth::user()->role_id == 3 ||
                                Auth::user()->role_id == 4 ||
                                Auth::user()->role_id == 6 ||
                                Auth::user()->role_id == 7 ||
                                Auth::user()->role_id == 8)
                            <td class=" text-center" style='white-space: nowrap'>
                                <a href="{{ route('detail.statistik', ['matakuliah_id' => $riwayat->id]) }}"
                                    class="badge bg-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i
                                        class="fas fa-info-circle" aria-hidden="true"></i></a>
                                <a href="{{ route('download_pdf', ['matakuliah_id' => $riwayat->id]) }}"
                                    class="badge bg-success p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i
                                        class="fas fa-download" aria-hidden="true"></i></a>
                            </td>
                        @else
                        @endif
                        @if (Auth::user()->role_id == 1)
                            <td class=" text-center" style='white-space: nowrap'>
                                <a href="{{ route('download_pdf', ['matakuliah_id' => $riwayat->id]) }}"
                                    class="badge bg-success p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i
                                        class="fas fa-download" aria-hidden="true"></i></a>
                            </td>
                        @else
                        @endif
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
            $('.modalDeleted').click(function(e) {
                e.preventDefault();

                var mata_kuliah_id = $(this).val();
                $('#mata_kuliah_id').val(mata_kuliah_id);
                $('#deleteModal').modal('show');
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const rowCount = $('#datatablesMataKuliah tbody tr').length;
            if (rowCount > 0) {
                Swal.fire({
                    title: 'Ini adalah halaman Riwayat Mata Kuliah',
                    html: `Ada <strong class="text-info"> ${rowCount} Mata Kuliah</strong>.`,
                    icon: 'info',
                    icon: 'info',
                    showConfirmButton: true,
                    confirmButtonColor: '#28a745',
                });
            } else {
                Swal.fire({
                    title: 'Ini adalah halaman Riwayat Mata Kuliah',
                    html: `Belum ada riwayat mata kuliah.`,
                    icon: 'info',
                    showConfirmButton: true,
                    confirmButtonColor: '#28a745',
                });
            }
        });
    </script>
@endpush()
