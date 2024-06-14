@extends('absensi_menu.main')

@section('title')
    Ruangan | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Ruangan
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="swal" data-swal="{{ session('message') }}"></div>
    @endif

    @if (Auth::user()->role_id == 1)
        <a href="{{ url('/gedung/create-ruangan') }}" class="btn mahasiswa btn-success mb-3">+ Ruangan</a>
    @else
    @endif

    <div class="container card p-4">

        <ol class="breadcrumb col-lg-12">

            <li><a href="/absensi" class="px-1">Absensi ({{ $jumlah_absensi }})</a></li>
            <span class="px-2">|</span>
            <li><a href="{{ route('riwayat-absensi') }}" class="breadcrumb-item  px-1">Riwayat ({{ $jumlah_riwayat }})</a>
            </li>
            <span class="px-2">|</span>
            <li><a href="{{ route('ruangan-absensi') }}" class="breadcrumb-item  px-1 fw-bold text-success">Ruangan
                    ({{ $jumlah_ruangan }})</a></li>
            @if (Auth::guard('dosen')->check() && in_array(Auth::guard('dosen')->user()->role_id, [5, 6, 7, 8]))
                <span class="px-2">|</span>
                <li><a href="/matakuliah" class="breadcrumb-item px-1">Pengelola ({{ $countMatakuliah }})</a></li>
                <span class="px-2">|</span>
                <li><a href="{{ route('riwayat') }}" class="breadcrumb-item  px-1">Riwayat Matakuliah
                        ({{ $count }})</a></li>
            @endif
        </ol>

        @php
            $ruangan_list = [];
            $hari_list = [];

            foreach ($ruangan as $mtk) {
                $ruangan_list[] = $mtk->nama_ruangan;
                if ($mtk->waktu_mulai != '-') {
                    $hari_list[] = $mtk->waktu_mulai;
                }
            }

            $ruangan_list = array_unique($ruangan_list);
            $hari_list = array_unique($hari_list);
            sort($ruangan_list);
            sort($hari_list);
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
                    <label class="pt-2 pr-2" for="menuFilterRuangan">Ruangan</label>
                    <select id="menuFilterRuangan" class="custom-select custom-select-md rounded-3 py-1 text-capitalize"
                        style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($ruangan_list as $rgn)
                            <option value="{{ $rgn }}" class="text-capitalize">{{ $rgn }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group ml-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="menuFilterHari">Hari</label>
                    <select id="menuFilterHari" class="custom-select custom-select-md rounded-3 py-1 text-capitalize"
                        style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($hari_list as $hr)
                            <option value="{{ $hr }}" class="text-capitalize">{{ $hr }}</option>
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
                <label class="pt-2 pr-2" for="lengthMenuMobileRuangan">Tampilkan</label>
                <select id="lengthMenuMobileRuangan" class="custom-select custom-select-md rounded-3 py-1"
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
                <label class="pt-2 pr-2" for="menuRuanganFilterMobile">Ruangan</label>
                <select id="menuRuanganFilterMobile" class="custom-select custom-select-md rounded-3 py-1 text-capitalize"
                    style="width: 83px;">
                    <option value="" selected>Semua</option>
                    @foreach ($ruangan_list as $rgn)
                        <option value="{{ $rgn }}" class="text-capitalize">{{ $rgn }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mt-3" style="width: max-content;">
                <label class="pt-2 pr-2" for="menuHariFilterMobile">Hari</label>
                <select id="menuHariFilterMobile" class="custom-select custom-select-md rounded-3 py-1 text-capitalize"
                    style="width: 83px;">
                    <option value="" selected>Semua</option>
                    @foreach ($hari_list as $hr)
                        <option value="{{ $hr }}" class="text-capitalize">{{ $hr }}</option>
                    @endforeach
                </select>
            </div>

            <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterMobileMatakuliahRuangan">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1"
                    style="width: 83px; id="searchFilterMobileMatakuliahRuangan" placeholder="">
            </div>
        </div>
        <table class="table table-responsive-lg text-center table-bordered table-striped" style="width:100%"
            id="datatablesRuangan">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" scope="col">#</th>
                    <th class="text-center" scope="col">Gedung</th>
                    <th class="text-center" scope="col">Ruangan</th>
                    <th class="text-center" scope="col">Hari</th>
                    <th class="text-center" scope="col">Status</th>
                    <th class="text-center" scope="col">Mata Kuliah</th>
                    <th class="text-center" scope="col">Dosen Pengampu</th>
                    <th class="text-center" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ruangan as $rgn)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rgn->gedung->nama_gedung ?? '-' }}</td>
                        <td>{{ $rgn->nama_ruangan }}</td>
                        <td>
                            @if ($rgn['status'] == 'Sedang Digunakan')
                                {{ $rgn->waktu_mulai }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="{{ $rgn['status'] == 'Sedang Digunakan' ? 'bg-success' : '' }}">{{ $rgn['status'] }}
                        </td> <!-- Status ruangan -->
                        <td>
                            @if ($rgn['status'] == 'Sedang Digunakan')
                                {{ $rgn->mata_kuliah }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($rgn['status'] == 'Sedang Digunakan')
                                {{ $rgn->dosen_pengampu }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($rgn['status'] == 'Sedang Digunakan')
                                <a href="{{ route('detail.statistik', ['matakuliah_id' => $rgn->mata_kuliah_id]) }}"
                                    class="badge bg-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i
                                        class="fas fa-file-lines" aria-hidden="true"></i></a>
                            @else
                            @endif
                            <a href="{{ route('ruangan.matakuliah', ['id' => $rgn->id]) }}"
                                class="badge bg-primary p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Kelas"><i
                                    class="fas fa-info-circle" aria-hidden="true"></i></a>
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
            $('.modalDeleted').click(function(e) {
                e.preventDefault();

                var ruangan_id = $(this).val();
                $('#ruangan_id').val(ruangan_id);
                $('#deleteModal').modal('show');
            });
        });
        $(document).ready(function() {
            // Menghitung jumlah baris dalam tabel
            var rowCount = $('#datatables tbody tr').length;

            $('#ruanganCount').text(rowCount);
        });
    </script>
@endpush()

@push('scripts')
    <script>
        $(document).ready(function() {
            // Fungsi untuk menambah nilai pertemuan di form modal
            function updatePertemuanValue(modal) {
                modal.on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget); // Button yang memicu modal
                    var nextPertemuan = button.data(
                        'nomor-pertemuan'); // Dapatkan nilai nomor pertemuan berikutnya
                    $(this).find('.modal-body #pertemuan').val(
                        nextPertemuan); // Perbarui nilai input pertemuan di dalam modal
                });
            }
        });
    </script>
@endpush
