@extends('absensi_menu.main')

@section('title')
    Daftar Mata Kuliah | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Mata Kuliah
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="swal" data-swal="{{ session('message') }}"></div>
    @endif

    @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 4)
        <a href="{{ url('/matakuliah/create') }}" class="btn mahasiswa btn-success mb-3">+ Mata Kuliah</a>
    @else
    @endif
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ url('/delete') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Apakah Anda Yakin?</h1>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="matkul_deleted_category" id="mata_kuliah_id">
                        <p>Data Yang Dihapus Tidak Akan Kembali!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-success">Yakin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container card p-4">

        @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 4)
            <ol class="breadcrumb col-lg-12">

                <li><a href="/matakuliah" class="px-1 fw-bold text-success">Mata Kuliah ({{ $count }})</a></li>

                <span class="px-2">|</span>
                <li><a href="{{ route('riwayat') }}" class="breadcrumb-item  px-1">Riwayat ({{ $countMatakuliah }})</a></li>
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
                <li><a href="/matakuliah" class="px-1 fw-bold text-success">Pengelola ({{ $count }})</a></li>
                <span class="px-2">|</span>
                <li><a href="{{ route('riwayat') }}" class="breadcrumb-item  px-1">Riwayat Matakuliah
                        ({{ $countMatakuliah }})</a></li>
            </ol>
        @else
        @endif
        @if (Auth::user()->role_id == 1)
            <ol class="breadcrumb col-lg-12">
                <li><a href="/matakuliah" class="px-1 fw-bold text-success">Mata Kuliah ({{ $count }})</a></li>
                <span class="px-2">|</span>
                <li><a href="{{ route('riwayat') }}" class="breadcrumb-item  px-1">Riwayat ({{ $countMatakuliah }})</a>
                </li>
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
            <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterMobileMatakuliahProdi">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1"
                    style="width: 83px; id="searchFilterMobileMatakuliahProdi" placeholder="">
            </div>
        </div>

        <table class="table table-responsive-lg text-center table-bordered table-striped" width="100%"
            id="datatablesMataKuliah">
            <thead class="table-dark">
                <tr>
                    @if (Auth::user()->role_id == 2 ||
                            Auth::user()->role_id == 3 ||
                            Auth::user()->role_id == 4 ||
                            Auth::user()->role_id == 6 ||
                            Auth::user()->role_id == 7 ||
                            Auth::user()->role_id == 8)
                        <th class="text-center" scope="col">#</th>
                    @endif
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
                    @if (Auth::user()->role_id == 1 ||
                            Auth::user()->role_id == 2 ||
                            Auth::user()->role_id == 3 ||
                            Auth::user()->role_id == 4 ||
                            Auth::user()->role_id == 5 ||
                            Auth::user()->role_id == 6 ||
                            Auth::user()->role_id == 7 ||
                            Auth::user()->role_id == 8)
                        <th class="text-center" scope="col">Aksi</th>
                    @else
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($matakuliah as $mtk)
                    <tr>
                        @if (Auth::user()->role_id == 2 ||
                                Auth::user()->role_id == 3 ||
                                Auth::user()->role_id == 4 ||
                                Auth::user()->role_id == 6 ||
                                Auth::user()->role_id == 7 ||
                                Auth::user()->role_id == 8)
                            <td>{{ $loop->iteration }}</td>
                        @endif
                        <td>{{ $mtk->kode_mk }}</td>
                        <td>{{ $mtk->mk }}</td>
                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 5)
                            <td>{{ $mtk->prodi->nama_prodi ?? '-' }}</td>
                        @endif
                        <td>{{ $mtk->kelas->nama_kelas ?? '-' }}</td>
                        <td>{{ $mtk->sks }}</td>
                        <td>{{ $mtk->semester->semester ?? '-' }} ({{ $mtk->semester->tahun_ajaran ?? '-' }})</td>
                        <td class="text-center">
                            <p>1. {{ $mtk->dosenmatkul->nama_singkat ?? '-' }} </p>
                            <p>2. {{ $mtk->dosenmatkul2->nama_singkat ?? '-' }}</p>
                        </td>
                        <td>{{ $mtk->hari }}</td>
                        <td>{{ $mtk->jam }}</td>
                        <td>{{ $mtk->ruangan->gedung->nama_gedung ?? '-' }} {{ $mtk->ruangan->nama_ruangan ?? '-' }}</td>
                        <td>{{ $mtk->kuota }}</td>
                        @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 4)
                            <td class=" text-start" style='white-space: nowrap'>
                                <a href="/matakuliah/edit/{{ $mtk->id }}" class="badge bg-warning mb-1"
                                    title="Edit" data-bs-toggle="tooltip"><i class="fas fa-pen"></i></a>
                                <a href="{{ route('detail.statistik', ['matakuliah_id' => $mtk->id]) }}"
                                    class="badge bg-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i
                                        class="fas fa-info-circle" aria-hidden="true"></i></a>
                                {{-- <button type="button" class="badge bg-danger border-0 text-center modalDeleted d-inline"
                                    title="Hapus" value="{{ $mtk->id }}">
                                    <i class="fas fa-trash-can"></i>
                                </button> --}}
                                <a href="{{ route('download_pdf', ['matakuliah_id' => $mtk->id]) }}"
                                    class="badge bg-success p-1 mb-1" data-bs-toggle="tooltip" title="Download"><i
                                        class="fas fa-download" aria-hidden="true"></i></a>
                            </td>
                        @elseif (Auth::user()->role_id == 1 ||
                                Auth::user()->role_id == 5 ||
                                Auth::user()->role_id == 6 ||
                                Auth::user()->role_id == 7 ||
                                Auth::user()->role_id == 8)
                            <td class=" text-center" style='white-space: nowrap'>
                                <a href="{{ route('detail.statistik', ['matakuliah_id' => $mtk->id]) }}"
                                    class="badge bg-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i
                                        class="fas fa-info-circle" aria-hidden="true"></i></a>
                                <a href="{{ route('download_pdf', ['matakuliah_id' => $mtk->id]) }}"
                                    class="badge bg-success p-1 mb-1" data-bs-toggle="tooltip" title="Download"><i
                                        class="fas fa-download" aria-hidden="true"></i></a>
                            </td>
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

        $(document).ready(function() {
            // Menghitung jumlah baris dalam tabel
            var rowCount = $('#datatablesMataKuliah tbody tr').length;

            // Memperbarui nilai pada elemen dengan id 'mataKuliahCount'
            $('#mataKuliahCount').text(rowCount);
        });
    </script>
@endpush()
