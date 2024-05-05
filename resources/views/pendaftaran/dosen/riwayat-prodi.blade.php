@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Riwayat
@endsection

@section('sub-title')
    Riwayat
@endsection

@section('content')

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="container card p-4">

        <ol class="breadcrumb col-lg-12">

            @if (Str::length(Auth::guard('dosen')->user()) > 0)
                @if (Auth::guard('dosen')->user()->role_id == 5 ||
                        Auth::guard('dosen')->user()->role_id == 6 ||
                        Auth::guard('dosen')->user()->role_id == 6 ||
                        Auth::guard('dosen')->user()->role_id == 7 ||
                        Auth::guard('dosen')->user()->role_id == 8 ||
                        Auth::guard('dosen')->user()->role_id == 9 ||
                        Auth::guard('dosen')->user()->role_id == 10 ||
                        Auth::guard('dosen')->user()->role_id == 11)
                    <li><a href="/prodi/kp-skripsi/seminar" class="px-1">Seminar
                        (<span>{{ $jml_seminar_kp + $jml_sempro + $jml_sidang }}</span>)</a></li>
                    <span class="px-2">|</span>
                    <li><a href="/kerja-praktek" class="px-1">Data
                            KP (<span>{{ $jml_prodi_kp }}</span>)</a></li>
                    <span class="px-2">|</span>
                    <li><a href="/skripsi" class="px-1">Data Skripsi (<span>{{ $jml_prodi_skripsi }}</span>)</a>
                    </li>
                    <span class="px-2">|</span>
                    <li><a href="/prodi/riwayat" class="breadcrumb-item active fw-bold text-success px-1">Riwayat
                            (<span>{{ $jml_riwayat_prodi_kp + $jml_riwayat_prodi_skripsi + $jml_riwayat_seminar_kp + $jml_riwayat_sempro + $jml_riwayat_skripsi }}</span>)</a>
                    </li>
                     <span class="px-2">|</span>
                    <li><a href="/statistik" class="px-1">Statistik (All)</a></li>
                @endif
            @endif

            @if (Str::length(Auth::guard('web')->user()) > 0)
                @if (Auth::guard('web')->user()->role_id == 1 ||
                        Auth::guard('web')->user()->role_id == 2 ||
                        Auth::guard('web')->user()->role_id == 3 ||
                        Auth::guard('web')->user()->role_id == 4)

                    @if (Auth::guard('web')->user()->role_id == 2 ||
                            Auth::guard('web')->user()->role_id == 3 ||
                            Auth::guard('web')->user()->role_id == 4)
                        <li><a href="/persetujuan/admin/index" class=" px-1">Persetujuan
                                (<span>{{ $jml_persetujuan_kp + $jml_persetujuan_skripsi }}</span>)</a></li>
                        <span class="px-2">|</span>
                    @endif
                    <li><a href="/form" class="px-1">Seminar
                            (<span>{{ $jml_seminar_kp + $jml_sempro + $jml_sidang }}</span>)</a></li>
                    <span class="px-2">|</span>
                    <li><a href="/kerja-praktek/admin/index" class="px-1">Data KP (<span>{{ $jml_prodi_kp }}</span>)</a>
                    </li>

                    <span class="px-2">|</span>
                    <li><a href="/sidang/admin/index" class="px-1">Data Skripsi
                            (<span>{{ $jml_prodi_skripsi }}</span>)</a></li>

                    <span class="px-2">|</span>
                    <li><a href="/prodi/riwayat" class="breadcrumb-item active fw-bold text-success px-1">Riwayat
                            (<span>{{ $jml_riwayat_prodi_kp + $jml_riwayat_prodi_skripsi + $jml_riwayat_seminar_kp + $jml_riwayat_sempro + $jml_riwayat_skripsi }}</span>)</a>
                    </li>
                     <span class="px-2">|</span>
                    <li><a href="/statistik" class="px-1">Statistik (All)</a></li>

                @endif
            @endif

        </ol>

        <div class="container-fluid">

            <div class="mb-4 rounded bg-light">
                <div class="p-2 pt-3">
                    <h5 class="">Riwayat KP dan Skripsi</h5>
                    <hr>
                </div>
            </div>
            
            @php
            // Kumpulkan semua status KP dan Skripsi
            $all_statuses = [];
            foreach ($pendaftaran_kp as $kp) {
                $all_statuses[] = $kp->status_kp;
            }
            foreach ($pendaftaran_skripsi as $skripsi) {
                $all_statuses[] = $skripsi->status_skripsi;
            }
            // Hapus duplikat status dan urutkan
            $unique_statuses = array_unique($all_statuses);
            sort($unique_statuses);
            @endphp
            
            @php
            // Tetapkan semua Prodi yang diinginkan
            $all_prodi = ['Teknik Elektro D3', 'Teknik Elektro S1', 'Teknik Informatika S1']; // Ganti dengan daftar Prodi yang sesuai dengan aplikasi Anda

            // Inisialisasi array untuk daftar Prodi
            $prodi_list = [];

            // Ambil data Prodi dari pendaftaran KP dan tambahkan ke dalam array
            foreach ($pendaftaran_kp as $kp) {
                $prodi_list[] = $kp->prodi->nama_prodi;
            }

            // Ambil data Prodi dari pendaftaran Skripsi dan tambahkan ke dalam array
            foreach ($pendaftaran_skripsi as $skripsi) {
                $prodi_list[] = $skripsi->prodi->nama_prodi;
            }

            // Hilangkan duplikasi data Prodi
            $prodi_list = array_unique($prodi_list);

            // Gabungkan semua Prodi yang ada dengan semua Prodi yang diinginkan
            $prodi_list = array_merge($all_prodi, $prodi_list);

            // Hilangkan duplikasi lagi (jika diperlukan)
            $prodi_list = array_unique($prodi_list);

            // Urutkan data Prodi
            sort($prodi_list);
            @endphp

            <!-- Desktop Version -->
            <div class="d-none d-md-flex justify-content-between mb-3 filter">
                <div class="d-flex align-items-center">
                    <div class="dataTables_length input-group" style="width: max-content;">
                        <label class="pt-2 pr-2" for="lengthMenuRiwayatKPSkripsiProdi">Tampilkan</label>
                        <select id="lengthMenuRiwayatKPSkripsiProdi" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="150">150</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                        </select>
                    </div>
                    <div class="input-group ml-3" style="width: max-content;">
                        <label class="pt-2 pr-2" for="statusFilterRiwayatKPSkripsiProdi">Status</label>
                        <select id="statusFilterRiwayatKPSkripsiProdi" class="custom-select custom-select-md rounded-3 py-1">
                            <option value="">Semua</option>
                            @foreach ($unique_statuses as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>                    
                    </div>
                    <div class="input-group ml-3" style="width: max-content;">
                        <label class="pt-2 pr-2" for="prodiFilterRiwayatKPSkripsiProdi">Prodi</label>
                        <select id="prodiFilterRiwayatKPSkripsiProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                            <option value="" selected>Semua</option>
                            @foreach ($prodi_list as $prodi)
                                <option value="{{ $prodi }}" class="text-capitalize">{{ $prodi }}</option>
                            @endforeach
                        </select>                    
                    </div>
                </div>
                <div class="dataTables_filter input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="searchFilterRiwayatKPSkripsiProdi">Cari</label>
                    <input type="search" class="form-control form-control-md rounded-3 py-1" id="searchFilterRiwayatKPSkripsiProdi" placeholder="">
                </div>
            </div>

            <!-- Tablet & Mobile Version -->
            <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
                <div class="dataTables_length input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="lengthMenuMobileRiwayatKPSkripsiProdi">Tampilkan</label>
                    <select id="lengthMenuMobileRiwayatKPSkripsiProdi" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                    </select>
                </div>
                <div class="input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="statusFilterMobileRiwayatKPSkripsiProdi">Status</label>
                    <select id="statusFilterMobileRiwayatKPSkripsiProdi" class="custom-select custom-select-md rounded-3 py-1" style="width: 83px;">
                        <option value="">Semua</option>
                        @foreach ($unique_statuses as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>                    
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center gap-3 mb-3 filter d-block d-md-none">
                <div class="input-group mt-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="prodiFilterMobileRiwayatKPSkripsiProdi">Prodi</label>
                    <select id="prodiFilterMobileRiwayatKPSkripsiProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($prodi_list as $prodi)
                            <option value="{{ $prodi }}" class="text-capitalize">{{ $prodi }}</option>
                        @endforeach
                    </select>                    
                </div>
                <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="searchFilterMobileRiwayatKPSkripsiProdi">Cari</label>
                    <input type="search" class="form-control form-control-md rounded-3 py-1" style="width: 83px; id="searchFilterMobileRiwayatKPSkripsiProdi" placeholder="">
                </div>
            </div>

            <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatablesriwayatkpskripsiprodi">
                <thead class="table-dark">
                    <tr>
                        <!-- <th class="text-center" scope="col">No.</th> -->
                        <th class="text-center" scope="col">NIM</th>
                        <th class="text-center" scope="col">Nama</th>
                        <th class="text-center" scope="col">Program Studi</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Durasi</th>
                        <th class="text-center" scope="col">Semester</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($pendaftaran_kp as $kp)
                        <div></div>
                        <tr>
                            {{-- <!-- <td class="text-center">{{ $loop->iteration }}</td>                              --> --}}
                            <td class="text-center">{{ $kp->mahasiswa->nim }}</td>
                            <td class="text-left pl-3 pr-1 fw-bold">{{ $kp->mahasiswa->nama }}</td>
                            <td class="text-left pl-3 pr-1">{{ $kp->prodi->nama_prodi }}</td>
                            <td class="text-center bg-info">{{ $kp->status_kp }}</td>
                            <!-- DURASI -->
                            @php
                                $tanggalMulaiKP = $kp->tgl_disetujui_balasan ? Carbon::parse($kp->tgl_disetujui_balasan) : null;
                                $tanggalSelesai = $kp->tgl_disetujui_kpti_10_kaprodi ? Carbon::parse($kp->tgl_disetujui_kpti_10_kaprodi) : null;

                                $durasiKP = $tanggalMulaiKP ? $tanggalMulaiKP->diffInMonths($tanggalSelesai) : null;
                                $bulan = $durasiKP ? floor($durasiKP) : null;
                                $hari = $tanggalMulaiKP ? $tanggalMulaiKP->addMonths($bulan)->diffInDays($tanggalSelesai) : null;
                            @endphp

                            <td class="text-center px-1 py-2">
                                <b>{{ $bulan ?? 0}}</b> <small>Bulan</small> <br> <b>{{ $hari }}</b> <small>Hari</small>
                            </td>

                            @php
                                    $tanggalSelesai = $kp->tgl_disetujui_kpti_10_koordinator;

                                    $semester = App\Models\Semester::where('tanggal_mulai', '<=', $tanggalSelesai)
                                        ->where('tanggal_selesai', '>=', $tanggalSelesai)
                                        ->first();
                            @endphp
                            <td class="text-center">
                                {{ $semester->semester ?? '-' }} {{ $semester->tahun_ajaran ?? '' }} 
                            </td>

                            <td class="text-center">
                                <a href="/kpti10-kp/detail/riwayat/{{ $kp->id }}" class="badge btn btn-info p-1"
                                    data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                            </td>

                        </tr>
                    @endforeach

                    @foreach ($pendaftaran_skripsi as $skripsi)
                        <div></div>
                        <tr>
                            <!-- <td class="text-center">{{ $loop->iteration }}</td>-->
                            <td class="text-center">{{ $skripsi->mahasiswa->nim }}</td>
                            <td class="text-left pl-3 pr-1 fw-bold">{{ $skripsi->mahasiswa->nama }}</td>
                            <td class="text-left pl-3 pr-1">{{ $skripsi->prodi->nama_prodi }}</td>

                            @if ($skripsi->status_skripsi == 'LULUS')
                                <td class="text-center bg-info">{{ $skripsi->status_skripsi }}</td>
                                <!-- DURASI -->

                                @php
                                $tanggalMulaiSkripsi = $skripsi->tgl_disetujui_usuljudul_kaprodi ? Carbon::parse($skripsi->tgl_disetujui_usuljudul_kaprodi) : null;
                                $tanggalSelesai = $skripsi->tgl_disetujui_sti_17_koordinator ? Carbon::parse($skripsi->tgl_disetujui_sti_17_koordinator) : null;

                                $durasiSkripsi = $tanggalMulaiSkripsi ? $tanggalMulaiSkripsi->diffInMonths($tanggalSelesai) : null;
                                $bulan = $durasiSkripsi ? floor($durasiSkripsi) : null;
                                $hari = $tanggalMulaiSkripsi ? $tanggalMulaiSkripsi->addMonths($bulan)->diffInDays($tanggalSelesai) : null;
                                @endphp

                                <td class="text-center px-1 py-2">
                                    <b>{{ $bulan ?? 0 }}</b> <small>Bulan</small> <br> <b>{{ $hari }}</b> <small>Hari</small>
                                </td>
                            @endif
                            <!-- ___________batas____________ -->

                             @php
                                    $tanggalLulus = $skripsi->tgl_disetujui_sti_17_koordinator;

                                    $semester = App\Models\Semester::where('tanggal_mulai', '<=', $tanggalLulus)
                                        ->where('tanggal_selesai', '>=', $tanggalLulus)
                                        ->first();
                            @endphp
                            <td class="text-center pl-3 pr-1">
                                {{ $semester->semester ?? '-' }} {{ $semester->tahun_ajaran ?? '' }} 
                            </td>

                            <!--<td class="text-center">{{ $skripsi->keterangan }}</td>-->
                            <!-- USUL JUDUL  -->
                            @if ($skripsi->status_skripsi == 'LULUS')
                                <td class="text-center">
                                    <a href="/bukti-buku-skripsi/riwayat/detail/{{ $skripsi->id }}"
                                        class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i
                                            class="fas fa-info-circle"></i></a> <br>
                                    <a formtarget="_blank" target="_blank"
                                    href="/berita-acara-final/{{ Crypt::encryptString($skripsi->id) }}"
                                    class="badge bg-danger mt-1 p-2"style="border-radius:20px;">Berita Acara (FT)</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach

                </tbody>


            </table>
        </div>
    </div>

    <div class="container card p-4 my-5">
        <div class="container-fluid">
            <!-- <hr class="pt-1 mt-2 bg-dark"> -->

            <div class="mb-4 rounded bg-light">
                <div class="p-2 pt-3">
                    <h5 class="">Riwayat Seminar</h5>
                    <hr>
                </div>
            </div>
            
            @php
                $jenis_seminar = [];

            // Ambil jenis seminar dari data seminar KP dan tambahkan ke dalam array
            foreach ($penjadwalan_kps as $kp) {
                $jenis_seminar[] = $kp->jenis_seminar;
            }

            // Ambil jenis seminar dari data seminar Sempro dan tambahkan ke dalam array
            foreach ($penjadwalan_sempros as $sempro) {
                $jenis_seminar[] = $sempro->jenis_seminar;
            }

            // Ambil jenis seminar dari data seminar Skripsi dan tambahkan ke dalam array
            foreach ($penjadwalan_skripsis as $skripsi) {
                $jenis_seminar[] = $skripsi->jenis_seminar;
            }

            // Hilangkan duplikasi jenis seminar
            $jenis_seminar = array_unique($jenis_seminar);

            // Tetapkan semua jenis seminar yang diinginkan
            $all_jenis_seminar = ['Seminar KP', 'Seminar Proposal', 'Sidang Skripsi'];

            // Gabungkan semua jenis seminar yang ada dengan semua jenis seminar yang diinginkan
            $jenis_seminar = array_merge($all_jenis_seminar, $jenis_seminar);

            // Hilangkan duplikasi lagi (jika diperlukan)
            $jenis_seminar = array_unique($jenis_seminar);

            @endphp

            @php
            // Tetapkan semua Prodi yang diinginkan
            $all_prodi = ['Teknik Elektro D3', 'Teknik Elektro S1', 'Teknik Informatika S1']; // Ganti dengan daftar Prodi yang sesuai dengan aplikasi Anda

            // Inisialisasi array untuk daftar Prodi
            $prodi_list = [];

            // Ambil data Prodi dari pendaftaran seminar Proposal dan tambahkan ke dalam array
            foreach ($batal_seminar as $sempro) {
                $prodi_list[] = $sempro->prodi->nama_prodi;
            }

            // Ambil data Prodi dari pendaftaran seminar Skripsi dan tambahkan ke dalam array
            foreach ($batal_seminar as $skripsi) {
                $prodi_list[] = $skripsi->prodi->nama_prodi;
            }

            // Hilangkan duplikasi data Prodi
            $prodi_list = array_unique($prodi_list);

            // Gabungkan semua Prodi yang ada dengan semua Prodi yang diinginkan
            $prodi_list = array_merge($all_prodi, $prodi_list);

            // Hilangkan duplikasi lagi (jika diperlukan)
            $prodi_list = array_unique($prodi_list);

            // Urutkan data Prodi
            sort($prodi_list);
            @endphp

            @php
            // Array tetap berisi semua nama bulan dalam bahasa Indonesia
            $bulan_tetap = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            // Inisialisasi array untuk opsi bulan
            $bulan_options = [];

            // Ambil bulan dari data seminar KP
            foreach ($penjadwalan_kps as $kp) {
                $bulan = Carbon::parse($kp->tanggal)->translatedFormat('F');
                if (!in_array($bulan, $bulan_options)) {
                    $bulan_options[] = $bulan;
                }
            }

            // Ambil bulan dari data seminar Sempro
            foreach ($penjadwalan_sempros as $sempro) {
                $bulan = Carbon::parse($sempro->tanggal)->translatedFormat('F');
                if (!in_array($bulan, $bulan_options)) {
                    $bulan_options[] = $bulan;
                }
            }

            // Ambil bulan dari data seminar Skripsi
            foreach ($penjadwalan_skripsis as $skripsi) {
                $bulan = Carbon::parse($skripsi->tanggal)->translatedFormat('F');
                if (!in_array($bulan, $bulan_options)) {
                    $bulan_options[] = $bulan;
                }
            }

            // Gabungkan semua nama bulan yang ditemukan dengan array tetap bulan
            $bulan_options = array_merge($bulan_tetap, $bulan_options);

            // Hilangkan duplikasi
            $bulan_options = array_unique($bulan_options);

            // Urutkan nama bulan sesuai dengan urutan bulan Indonesia
            usort($bulan_options, function($a, $b) use ($bulan_tetap) {
                return array_search($a, $bulan_tetap) - array_search($b, $bulan_tetap);
            });
            @endphp

            @php
            // Inisialisasi array untuk opsi tahun
            $tahun_options = [];

            // Ambil tahun dari data seminar KP
            foreach ($penjadwalan_kps as $kp) {
                $tahun = Carbon::parse($kp->tanggal)->year;
                if (!in_array($tahun, $tahun_options)) {
                    $tahun_options[] = $tahun;
                }
            }

            // Ambil tahun dari data seminar Sempro
            foreach ($penjadwalan_sempros as $sempro) {
                $tahun = Carbon::parse($sempro->tanggal)->year;
                if (!in_array($tahun, $tahun_options)) {
                    $tahun_options[] = $tahun;
                }
            }

            // Ambil tahun dari data seminar Skripsi
            foreach ($penjadwalan_skripsis as $skripsi) {
                $tahun = Carbon::parse($skripsi->tanggal)->year;
                if (!in_array($tahun, $tahun_options)) {
                    $tahun_options[] = $tahun;
                }
            }

            // Urutkan tahun dari yang terkecil
            sort($tahun_options);
            @endphp

            <!-- Desktop Version -->
            <div class="d-none d-md-flex justify-content-between mb-3 filter">
                <div class="d-flex align-items-center">
                    <div class="dataTables_length input-group" style="width: max-content;">
                        <label class="pt-2 pr-2" for="lengthMenuRiwayatSeminarProdi">Tampilkan</label>
                        <select id="lengthMenuRiwayatSeminarProdi" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="150">150</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                        </select>
                    </div>
                    <div class="input-group ml-3" style="width: max-content;">
                        <label class="pt-2 pr-2" for="seminarFilterRiwayatSeminarProdi">Seminar</label>
                        <select id="seminarFilterRiwayatSeminarProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                            <option value="" selected>Semua</option>
                            @foreach ($jenis_seminar as $jenis)
                                <option value="{{ $jenis }}" class="text-capitalize">{{ $jenis }}</option>
                            @endforeach
                        </select>                    
                    </div>
                    <div class="input-group ml-3" style="width: max-content;">
                        <label class="pt-2 pr-2" for="prodiFilterRiwayatSeminarProdi">Prodi</label>
                        <select id="prodiFilterRiwayatSeminarProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                            <option value="" selected>Semua</option>
                            @foreach ($prodi_list as $prodi)
                                <option value="{{ $prodi }}" class="text-capitalize">{{ $prodi }}</option>
                            @endforeach
                        </select>                    
                    </div>                    
                    <div class="input-group ml-3" style="width: max-content;">
                        <label class="pt-2 pr-2" for="bulanFilterRiwayatSeminarProdi">Bulan</label>
                        <select id="bulanFilterRiwayatSeminarProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                            <option value="" selected>Semua</option>
                            @foreach ($bulan_options as $bulan)
                                <option value="{{ $bulan }}" class="text-capitalize">{{ $bulan }}</option>
                            @endforeach
                        </select>                    
                    </div>
                    <div class="input-group ml-3" style="width: max-content;">
                        <label class="pt-2 pr-2" for="tahunFilterRiwayatSeminarProdi">Tahun</label>
                        <select id="tahunFilterRiwayatSeminarProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                            <option value="" selected>Semua</option>
                            @foreach ($tahun_options as $tahun)
                                <option value="{{ $tahun }}" class="text-capitalize">{{ $tahun }}</option>
                            @endforeach
                        </select>                    
                    </div>
                </div>
                <div class="dataTables_filter input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="searchFilterRiwayatSeminarProdi">Cari</label>
                    <input type="search" class="form-control form-control-md rounded-3 py-1"  id="searchFilterRiwayatSeminarProdi" placeholder="">
                </div>
            </div>

            <!-- Tablet & Mobile Version -->
            <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
                <div class="dataTables_length input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="lengthMenuMobileRiwayatSeminarProdi">Tampilkan</label>
                    <select id="lengthMenuMobileRiwayatSeminarProdi" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                    </select>
                </div>
                <div class="input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="seminarFilterMobileRiwayatSeminarProdi">Seminar</label>
                    <select id="seminarFilterMobileRiwayatSeminarProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($jenis_seminar as $jenis)
                            <option value="{{ $jenis }}" class="text-capitalize">{{ $jenis }}</option>
                        @endforeach
                    </select>                    
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
                <div class="input-group mt-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="prodiFilterMobileRiwayatSeminarProdi">Prodi</label>
                    <select id="prodiFilterMobileRiwayatSeminarProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($prodi_list as $prodi)
                            <option value="{{ $prodi }}" class="text-capitalize">{{ $prodi }}</option>
                        @endforeach
                    </select>                    
                </div>
                <div class="input-group mt-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="bulanFilterMobileRiwayatSeminarProdi">Bulan</label>
                    <select id="bulanFilterMobileRiwayatSeminarProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($bulan_options as $bulan)
                            <option value="{{ $bulan }}" class="text-capitalize">{{ $bulan }}</option>
                        @endforeach
                    </select>                    
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center gap-3 mb-3 filter d-block d-md-none">
                <div class="input-group mt-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="tahunFilterMobileRiwayatSeminarProdi">Tahun</label>
                    <select id="tahunFilterMobileRiwayatSeminarProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($tahun_options as $tahun)
                            <option value="{{ $tahun }}" class="text-capitalize">{{ $tahun }}</option>
                        @endforeach
                    </select>                    
                </div>
                <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="searchFilterMobileRiwayatSeminarProdi">Cari</label>
                    <input type="search" class="form-control form-control-md rounded-3 py-1" style="width: 83px;" id="searchFilterMobileRiwayatSeminarProdi" placeholder="">
                </div>
            </div>

            <table class="table table-responsive-lg table-bordered table-striped" style="width:100%" id="datatablesriwayatseminarprodi">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" scope="col">NIM</th>
                        <th class="text-center" scope="col">Nama</th>
                        <th class="text-center" scope="col">Seminar</th>
                        <th class="text-center" scope="col">Prodi</th>
                        <th class="text-center" scope="col">Tanggal</th>
                        <th class="text-center" scope="col">Waktu</th>
                        <th class="text-center" scope="col">Lokasi</th>
                        <th class="text-center" scope="col">Pembimbing</th>
                        <th class="text-center" scope="col">Penguji</th>
                        <!-- <th class="text-center" scope="col">Hasil</th> -->
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($penjadwalan_kps as $kp)
                        <tr>
                            <td class="text-center">{{ $kp->mahasiswa->nim }}</td>
                            <td class="text-left pl-3 pr-1 fw-bold">{{ $kp->mahasiswa->nama }}</td>
                            <td class="bg-primary text-center">{{ $kp->jenis_seminar }}</td>
                            <td class="text-center">{{ $kp->prodi->nama_prodi }}</td>
                            <td class="text-center">{{ Carbon::parse($kp->tanggal)->translatedFormat('l, d F Y') }}</td>
                            <td class="text-center">{{ $kp->waktu }}</td>
                            <td class="text-center">{{ $kp->lokasi }}</td>
                            <td class="text-center">
                                <p>{{ $kp->pembimbing->nama_singkat }}</p>
                            </td>
                            <td class="text-center">
                                <p>{{ $kp->penguji->nama_singkat }}</p>
                            </td>
                            <!-- @if ($kp->status_seminar == 1)
                                <td class="text-center">Lulus</td>
                            @else
                                <td class="text-center">Belum Lulus</td>
                            @endif -->

                            <td class="text-center">
                               <a formtarget="_blank" target="_blank"
                                    href="/perbaikan-pengujikp/{{ Crypt::encryptString($kp->id) }}/{{ $kp->penguji->nip }}"
                                    class="badge bg-info p-2"style="border-radius:20px;">Perbaikan Penguji</a>
                                <a formtarget="_blank" target="_blank" href="/nilai-kp/{{ Crypt::encryptString($kp->id) }}"
                                    class="badge bg-success mt-2 p-2"style="border-radius:20px;">Nilai Penguji</a>
                                <a formtarget="_blank" target="_blank"
                                    href="/beritaacara-kp/{{ Crypt::encryptString($kp->id) }}"
                                    class="badge bg-danger mt-2 p-2"style="border-radius:20px;">Berita Acara</a>
                            </td>
                        </tr>
                    @endforeach

                    @foreach ($penjadwalan_sempros as $sempro)
                        <tr>
                            <td class="text-center">{{ $sempro->mahasiswa->nim }}</td>
                            <td class="text-left pl-3 pr-1 fw-bold">{{ $sempro->mahasiswa->nama }}</td>
                            <td class="bg-success text-center">{{ $sempro->jenis_seminar }}</td>
                            <td class="text-center">{{ $sempro->prodi->nama_prodi }}</td>
                            <td class="text-center">{{ Carbon::parse($sempro->tanggal)->translatedFormat('l, d F Y') }}
                            </td>
                            <td class="text-center">{{ $sempro->waktu }}</td>
                            <td class="text-center">{{ $sempro->lokasi }}</td>
                            <td class="text-center">
                                @if ($sempro->pembimbingsatu == !null)
                                <p>1. {{ $sempro->pembimbingsatu->nama_singkat }}</p>
                                @endif
                                @if ($sempro->pembimbingdua == !null)
                                    <p>2. {{ $sempro->pembimbingdua->nama_singkat }}</p>
                                @endif
                            </td>
                            <td class="text-center">
                                <p>1. {{ $sempro->pengujisatu->nama_singkat }}</p>
                                <p>2. {{ $sempro->pengujidua->nama_singkat }}</p>
                                @if ($sempro->pengujitiga == !null)
                                    <p>3. {{ $sempro->pengujitiga->nama_singkat }}</p>
                                @endif
                            </td>
                            <!-- @if ($sempro->status_seminar == 1)
                                <td class="text-center">Lulus</td>
                            @else
                                <td class="text-center">Belum Lulus</td>
                            @endif -->

                            <td class="text-center">
                                @if ($sempro->pembimbingsatu == !null)
                               <a formtarget="_blank" target="_blank"
                                    href="/nilai-sempro-pembimbing/{{ Crypt::encryptString($sempro->id) }}/{{ $sempro->pembimbingsatu->nip }}"
                                    class="badge bg-primary p-2" style="border-radius:20px;">Nilai Pembimbing 1</a>
                                @endif
                                @if ($sempro->pembimbingdua == !null)
                                    <a formtarget="_blank" target="_blank"
                                        href="/nilai-sempro-pembimbing/{{ Crypt::encryptString($sempro->id) }}/{{ $sempro->pembimbingdua->nip }}"
                                        class="badge bg-info p-2 mt-1" style="border-radius:20px;">Nilai Pembimbing 2</a>
                                @endif
                                <a formtarget="_blank" target="_blank"
                                    href="/nilai-sempro-penguji/{{ Crypt::encryptString($sempro->id) }}/{{ $sempro->pengujisatu->nip }}"
                                    class="badge bg-danger p-2 mt-1" style="border-radius:20px;">Nilai Penguji 1</a>
                                <a formtarget="_blank" target="_blank"
                                    href="/nilai-sempro-penguji/{{ Crypt::encryptString($sempro->id) }}/{{ $sempro->pengujidua->nip }}"
                                    class="badge bg-warning p-2 mt-1" style="border-radius:20px;">Nilai Penguji 2</a>
                                @if ($sempro->pengujitiga == !null)
                                    <a formtarget="_blank" target="_blank"
                                        href="/nilai-sempro-penguji/{{ Crypt::encryptString($sempro->id) }}/{{ $sempro->pengujitiga->nip }}"
                                        class="badge bg-success p-2 mt-1" style="border-radius:20px;">Nilai Penguji 3</a>
                                @endif
                                <a formtarget="_blank" target="_blank"
                                    href="/perbaikan-pengujisempro/{{ Crypt::encryptString($sempro->id) }}/{{ $sempro->pengujisatu->nip }}"
                                    class="badge bg-danger p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 1</a>
                                <a formtarget="_blank" target="_blank"
                                    href="/perbaikan-pengujisempro/{{ Crypt::encryptString($sempro->id) }}/{{ $sempro->pengujidua->nip }}"
                                    class="badge bg-warning p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 2</a>
                                @if ($sempro->pengujitiga == !null)
                                    <a formtarget="_blank" target="_blank"
                                        href="/perbaikan-pengujisempro/{{ Crypt::encryptString($sempro->id) }}/{{ $sempro->pengujitiga->nip }}"
                                        class="badge bg-success p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji
                                        3</a>
                                @endif
                                <a formtarget="_blank" target="_blank"
                                    href="/penilaian-sempro/beritaacara-sempro/{{ Crypt::encryptString($sempro->id) }}"
                                    class="badge bg-primary p-2 mt-1" style="border-radius:20px;">Berita Acara</a>
                                @if (Str::length(Auth::guard('web')->user()) > 0)
                                @if (Auth::guard('web')->user()->role_id == 2 ||
                                Auth::guard('web')->user()->role_id == 3 ||
                                Auth::guard('web')->user()->role_id == 4)

                                @if ($sempro->revisi_proposal == !null)
                                    <a formtarget="_blank" target="_blank"
                                        href="/penilaian-sempro/riwayat-judul/{{ Crypt::encryptString($sempro->id) }}"
                                        class="badge bg-warning p-2 mt-1" style="border-radius:20px;">Revisi Judul</a>
                                @endif

                                @endif
                                @endif

                            </td>
                        </tr>
                    @endforeach

                    @foreach ($penjadwalan_skripsis as $skripsi)
                        <tr>
                            <td class="text-center">{{ $skripsi->mahasiswa->nim }}</td>
                            <td class="text-left pl-3 pr-1 fw-bold">{{ $skripsi->mahasiswa->nama }}</td>
                            <td class="bg-warning text-center">{{ $skripsi->jenis_seminar }}</td>
                            <td class="text-center">{{ $skripsi->prodi->nama_prodi }}</td>
                            <td class="text-center">{{ Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y') }}
                            </td>
                            <td class="text-center">{{ $skripsi->waktu }}</td>
                            <td class="text-center">{{ $skripsi->lokasi }}</td>
                            <td class="text-center">
                                @if ($skripsi->pembimbingsatu == !null)
                                <p>1. {{ $skripsi->pembimbingsatu->nama_singkat }}</p>
                                @endif
                                @if ($skripsi->pembimbingdua == !null)
                                    <p>2. {{ $skripsi->pembimbingdua->nama_singkat }}</p>
                                @endif
                            </td>
                            <td class="text-center">
                                <p>1. {{ $skripsi->pengujisatu->nama_singkat }}</p>
                                <p>2. {{ $skripsi->pengujidua->nama_singkat }}</p>
                                @if ($skripsi->pengujitiga == !null)
                                    <p>3. {{ $skripsi->pengujitiga->nama_singkat }}</p>
                                @endif
                            </td>

                            <!-- @if ($skripsi->status_seminar == 3)
                                <td class="text-center">Lulus</td>
                            @elseif ($skripsi->status_seminar == 2)
                                <td class="text-center">Menunggu persetujuan Koordinator Program Studi</td>
                            @elseif ($skripsi->status_seminar == 1)
                                <td class="text-center">Menunggu persetujuan Koordinator Skripsi</td>
                            @else
                                <td class="text-center">Belum Lulus</td>
                            @endif -->

                            <td class="text-center">
                                
                                @if ($skripsi->pembimbingsatu == !null)
                               <a formtarget="_blank" target="_blank"
                                    href="/nilai-skripsi-pembimbing/{{ Crypt::encryptString($skripsi->id) }}/{{ $skripsi->pembimbingsatu->nip }}"
                                    class="badge bg-primary p-2" style="border-radius:20px;">Nilai Pembimbing 1</a>
                                @endif
                                @if ($skripsi->pembimbingdua == !null)
                                    <a formtarget="_blank" target="_blank"
                                        href="/nilai-skripsi-pembimbing/{{ Crypt::encryptString($skripsi->id) }}/{{ $skripsi->pembimbingdua->nip }}"
                                        class="badge bg-info p-2 mt-1" style="border-radius:20px;">Nilai Pembimbing 2</a>
                                @endif
                                <a formtarget="_blank" target="_blank"
                                    href="/nilai-skripsi-penguji/{{ Crypt::encryptString($skripsi->id) }}/{{ $skripsi->pengujisatu->nip }}"
                                    class="badge bg-danger p-2 mt-1" style="border-radius:20px;">Nilai Penguji 1</a>
                                <a formtarget="_blank" target="_blank"
                                    href="/nilai-skripsi-penguji/{{ Crypt::encryptString($skripsi->id) }}/{{ $skripsi->pengujidua->nip }}"
                                    class="badge bg-warning p-2 mt-1" style="border-radius:20px;">Nilai Penguji 2</a>
                                @if ($skripsi->pengujitiga == !null)
                                    <a formtarget="_blank" target="_blank"
                                        href="/nilai-skripsi-penguji/{{ Crypt::encryptString($skripsi->id) }}/{{ $skripsi->pengujitiga->nip }}"
                                        class="badge bg-success p-2 mt-1" style="border-radius:20px;">Nilai Penguji 3</a>
                                @endif
                                <a formtarget="_blank" target="_blank"
                                    href="/perbaikan-pengujiskripsi/{{ Crypt::encryptString($skripsi->id) }}/{{ $skripsi->pengujisatu->nip }}"
                                    class="badge bg-danger p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 1</a>
                                <a formtarget="_blank" target="_blank"
                                    href="/perbaikan-pengujiskripsi/{{ Crypt::encryptString($skripsi->id) }}/{{ $skripsi->pengujidua->nip }}"
                                    class="badge bg-warning p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 2</a>
                                @if ($skripsi->pengujitiga == !null)
                                    <a formtarget="_blank" target="_blank"
                                        href="/perbaikan-pengujiskripsi/{{ Crypt::encryptString($skripsi->id) }}/{{ $skripsi->pengujitiga->nip }}"
                                        class="badge bg-success p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji
                                        3</a>
                                @endif
                                <a formtarget="_blank" target="_blank"
                                    href="/penilaian-skripsi/beritaacara-skripsi/{{ Crypt::encryptString($skripsi->id) }}"
                                    class="badge bg-primary p-2 mt-1" style="border-radius:20px;">Berita Acara</a>
                                @if (Str::length(Auth::guard('web')->user()) > 0)
                                @if (Auth::guard('web')->user()->role_id == 2 ||
                                Auth::guard('web')->user()->role_id == 3 ||
                                Auth::guard('web')->user()->role_id == 4)
                                
                                @if ($skripsi->revisi_skripsi == !null)
                                    <a formtarget="_blank" target="_blank"
                                        href="/penilaian-skripsi/riwayat-judul/{{ $skripsi->id }}"
                                        class="badge bg-warning p-2 mt-1" style="border-radius:20px;">Revisi Judul</a>
                                @endif

                                @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>


        </div>
        </div>
    
        <div class="container card p-4 my-5">
        <div class="container-fluid">
            <!-- <hr class="pt-1 mt-2 bg-dark"> -->

            <div class="mb-4 rounded bg-light">
                <div class="p-2 pt-3">
                    <h5 class="">Riwayat Seminar Dibatalkan/Diundur</h5>
                    <hr>
                </div>
            </div>
            
            @php
                $jenis_seminar = [];

            // Ambil jenis seminar dari data seminar Proposal dan tambahkan ke dalam array
            foreach ($batal_seminar as $sempro) {
                $jenis_seminar[] = $sempro->jenis_seminar;
            }

            // Ambil jenis seminar dari data seminar Skripsi dan tambahkan ke dalam array
            foreach ($batal_seminar as $skripsi) {
                $jenis_seminar[] = $skripsi->jenis_seminar;
            }

            // Hilangkan duplikasi jenis seminar
            $jenis_seminar = array_unique($jenis_seminar);

            // Tetapkan semua jenis seminar yang diinginkan
            $all_jenis_seminar = ['Seminar Proposal', 'Sidang Skripsi'];

            // Gabungkan semua jenis seminar yang ada dengan semua jenis seminar yang diinginkan
            $jenis_seminar = array_merge($all_jenis_seminar, $jenis_seminar);

            // Hilangkan duplikasi lagi (jika diperlukan)
            $jenis_seminar = array_unique($jenis_seminar);

            @endphp

            @php
            // Tetapkan semua Prodi yang diinginkan
            $all_prodi = ['Teknik Elektro D3', 'Teknik Elektro S1', 'Teknik Informatika S1']; // Ganti dengan daftar Prodi yang sesuai dengan aplikasi Anda

            // Inisialisasi array untuk daftar Prodi
            $prodi_list = [];

            // Ambil data Prodi dari pendaftaran seminar Proposal dan tambahkan ke dalam array
            foreach ($batal_seminar as $sempro) {
                $prodi_list[] = $sempro->prodi->nama_prodi;
            }

            // Ambil data Prodi dari pendaftaran seminar Skripsi dan tambahkan ke dalam array
            foreach ($batal_seminar as $skripsi) {
                $prodi_list[] = $skripsi->prodi->nama_prodi;
            }

            // Hilangkan duplikasi data Prodi
            $prodi_list = array_unique($prodi_list);

            // Gabungkan semua Prodi yang ada dengan semua Prodi yang diinginkan
            $prodi_list = array_merge($all_prodi, $prodi_list);

            // Hilangkan duplikasi lagi (jika diperlukan)
            $prodi_list = array_unique($prodi_list);

            // Urutkan data Prodi
            sort($prodi_list);
            @endphp

            @php
            // Array tetap berisi semua nama bulan dalam bahasa Indonesia
            $bulan_tetap = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            // Inisialisasi array untuk opsi bulan
            $bulan_options = [];

            // Ambil bulan dari data seminar Sempro
            foreach ($batal_seminar as $sempro) {
                $bulan = Carbon::parse($sempro->tanggal)->translatedFormat('F');
                if (!in_array($bulan, $bulan_options)) {
                    $bulan_options[] = $bulan;
                }
            }

            // Ambil bulan dari data seminar Skripsi
            foreach ($batal_seminar as $skripsi) {
                $bulan = Carbon::parse($skripsi->tanggal)->translatedFormat('F');
                if (!in_array($bulan, $bulan_options)) {
                    $bulan_options[] = $bulan;
                }
            }

            // Gabungkan semua nama bulan yang ditemukan dengan array tetap bulan
            $bulan_options = array_merge($bulan_tetap, $bulan_options);

            // Hilangkan duplikasi
            $bulan_options = array_unique($bulan_options);

            // Urutkan nama bulan sesuai dengan urutan bulan Indonesia
            usort($bulan_options, function($a, $b) use ($bulan_tetap) {
                return array_search($a, $bulan_tetap) - array_search($b, $bulan_tetap);
            });
            @endphp

            @php
            // Inisialisasi array untuk opsi tahun
            $tahun_options = [];

            // Ambil tahun dari data seminar Sempro
            foreach ($batal_seminar as $sempro) {
                $tahun = Carbon::parse($sempro->tanggal)->year;
                if (!in_array($tahun, $tahun_options)) {
                    $tahun_options[] = $tahun;
                }
            }

            // Ambil tahun dari data seminar Skripsi
            foreach ($batal_seminar as $skripsi) {
                $tahun = Carbon::parse($skripsi->tanggal)->year;
                if (!in_array($tahun, $tahun_options)) {
                    $tahun_options[] = $tahun;
                }
            }

            // Urutkan tahun dari yang terkecil
            sort($tahun_options);
            @endphp
            
            <!-- Desktop Version -->
            <div class="d-none d-md-flex justify-content-between mb-3 filter">
                <div class="d-flex align-items-center">
                    <div class="dataTables_length input-group" style="width: max-content;">
                        <label class="pt-2 pr-2" for="lengthMenuRiwayatSeminarDibatalkan">Tampilkan</label>
                        <select id="lengthMenuRiwayatSeminarDibatalkan" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="150">150</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                        </select>
                    </div>
                    <div class="input-group ml-3" style="width: max-content;">
                        <label class="pt-2 pr-2" for="seminarFilterRiwayatSeminarDibatalkan">Seminar</label>
                        <select id="seminarFilterRiwayatSeminarDibatalkan" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                            <option value="" selected>Semua</option>
                            @foreach ($jenis_seminar as $jenis)
                                <option value="{{ $jenis }}" class="text-capitalize">{{ $jenis }}</option>
                            @endforeach
                        </select>                    
                    </div>
                    <div class="input-group ml-3" style="width: max-content;">
                        <label class="pt-2 pr-2" for="prodiFilterRiwayatSeminarDibatalkan">Prodi</label>
                        <select id="prodiFilterRiwayatSeminarDibatalkan" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                            <option value="" selected>Semua</option>
                            @foreach ($prodi_list as $prodi)
                                <option value="{{ $prodi }}" class="text-capitalize">{{ $prodi }}</option>
                            @endforeach
                        </select>                    
                    </div>                    
                    <div class="input-group ml-3" style="width: max-content;">
                        <label class="pt-2 pr-2" for="bulanFilterRiwayatSeminarDibatalkan">Bulan</label>
                        <select id="bulanFilterRiwayatSeminarDibatalkan" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                            <option value="" selected>Semua</option>
                            @foreach ($bulan_options as $bulan)
                                <option value="{{ $bulan }}" class="text-capitalize">{{ $bulan }}</option>
                            @endforeach
                        </select>                    
                    </div>
                    <div class="input-group ml-3" style="width: max-content;">
                        <label class="pt-2 pr-2" for="tahunFilterRiwayatSeminarDibatalkan">Tahun</label>
                        <select id="tahunFilterRiwayatSeminarDibatalkan" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                            <option value="" selected>Semua</option>
                            @foreach ($tahun_options as $tahun)
                                <option value="{{ $tahun }}" class="text-capitalize">{{ $tahun }}</option>
                            @endforeach
                        </select>                    
                    </div>
                </div>
                <div class="dataTables_filter input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="searchFilterRiwayatSeminarDibatalkan">Cari</label>
                    <input type="search" class="form-control form-control-md rounded-3 py-1"  id="searchFilterRiwayatSeminarDibatalkan" placeholder="">
                </div>
            </div>

            <!-- Tablet & Mobile Version -->
            <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
                <div class="dataTables_length input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="lengthMenuMobileRiwayatSeminarDibatalkan">Tampilkan</label>
                    <select id="lengthMenuMobileRiwayatSeminarDibatalkan" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                    </select>
                </div>
                <div class="input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="seminarFilterMobileRiwayatSeminarDibatalkan">Seminar</label>
                    <select id="seminarFilterMobileRiwayatSeminarDibatalkan" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($jenis_seminar as $jenis)
                            <option value="{{ $jenis }}" class="text-capitalize">{{ $jenis }}</option>
                        @endforeach
                    </select>                    
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
                <div class="input-group mt-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="prodiFilterMobileRiwayatSeminarDibatalkan">Prodi</label>
                    <select id="prodiFilterMobileRiwayatSeminarDibatalkan" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($prodi_list as $prodi)
                            <option value="{{ $prodi }}" class="text-capitalize">{{ $prodi }}</option>
                        @endforeach
                    </select>                    
                </div>
                <div class="input-group mt-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="bulanFilterMobileRiwayatSeminarDibatalkan">Bulan</label>
                    <select id="bulanFilterMobileRiwayatSeminarDibatalkan" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($bulan_options as $bulan)
                            <option value="{{ $bulan }}" class="text-capitalize">{{ $bulan }}</option>
                        @endforeach
                    </select>                    
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center gap-3 mb-3 filter d-block d-md-none">
                <div class="input-group mt-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="tahunFilterMobileRiwayatSeminarDibatalkan">Tahun</label>
                    <select id="tahunFilterMobileRiwayatSeminarDibatalkan" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($tahun_options as $tahun)
                            <option value="{{ $tahun }}" class="text-capitalize">{{ $tahun }}</option>
                        @endforeach
                    </select>                    
                </div>
                <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="searchFilterMobileRiwayatSeminarDibatalkan">Cari</label>
                    <input type="search" class="form-control form-control-md rounded-3 py-1" style="width: 83px;" id="searchFilterMobileRiwayatSeminarDibatalkan" placeholder="">
                </div>
            </div>

            <table class="table table-responsive-lg table-bordered table-striped" style="width:100%" id="datatablesriwayatseminardibatalkan">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" scope="col">NIM</th>
                        <th class="text-center" scope="col">Nama</th>
                        <th class="text-center" scope="col">Seminar</th>
                        <th class="text-center" scope="col">Prodi</th>
                        <th class="text-center" scope="col">Tanggal</th>
                        <th class="text-center" scope="col">Waktu</th>
                        <th class="text-center" scope="col">Lokasi</th>
                        <th class="text-center" scope="col">Pembimbing</th>
                        <th class="text-center" scope="col">Penguji</th>
                        <th class="text-center " scope="col">Perihal Batal</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($batal_seminar as $sempro)
                        <tr>
                            <td class="text-center">{{ $sempro->mahasiswa->nim }}</td>
                            <td class="text-left pl-3 pr-1 fw-bold">{{ $sempro->mahasiswa->nama }}</td>
                            @if($sempro->jenis_seminar == 'Seminar Proposal')
                            <td class="bg-success text-center">{{ $sempro->jenis_seminar }}</td>
                            @else
                            <td class="bg-warning text-center">{{ $skripsi->jenis_seminar }}</td>
                            @endif
                            
                            <td class="text-center">{{ $sempro->prodi->nama_prodi }}</td>
                            <td class="text-center">{{ Carbon::parse($sempro->tanggal)->translatedFormat('l, d F Y') }}
                            </td>
                            <td class="text-center">{{ $sempro->waktu }}</td>
                            <td class="text-center">{{ $sempro->lokasi }}</td>
                            <td class="text-center">
                                @if ($sempro->pembimbingsatu == !null)
                                <p>1. {{ $sempro->pembimbingsatu->nama_singkat }}</p>
                                @endif
                                @if ($sempro->pembimbingdua == !null)
                                    <p>2. {{ $sempro->pembimbingdua->nama_singkat }}</p>
                                @endif
                            </td>
                            <td class="text-center">
                                <p>1. {{ $sempro->pengujisatu->nama_singkat }}</p>
                                <p>2. {{ $sempro->pengujidua->nama_singkat }}</p>
                                @if ($sempro->pengujitiga == !null)
                                    <p>3. {{ $sempro->pengujitiga->nama_singkat }}</p>
                                @endif
                            </td>

                            <td class="text-center bg-secondary">
                                {{ $sempro->alasan }}

                            </td>
                        </tr>
                    @endforeach

                    <!--@foreach ($batal_seminar as $skripsi)-->
                    <!--    <tr>-->
                    <!--        <td class="text-center">{{ $skripsi->mahasiswa->nim }}</td>-->
                    <!--        <td class="text-left pl-3 pr-1 fw-bold">{{ $skripsi->mahasiswa->nama }}</td>-->
                    <!--        <td class="bg-warning text-center">{{ $skripsi->jenis_seminar }}</td>-->
                    <!--        <td class="text-center">{{ $skripsi->prodi->nama_prodi }}</td>-->
                    <!--        <td class="text-center">{{ Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y') }}-->
                    <!--        </td>-->
                    <!--        <td class="text-center">{{ $skripsi->waktu }}</td>-->
                    <!--        <td class="text-center">{{ $skripsi->lokasi }}</td>-->
                    <!--        <td class="text-center">-->
                    <!--            @if ($skripsi->pembimbingsatu == !null)-->
                    <!--            <p>1. {{ $skripsi->pembimbingsatu->nama_singkat }}</p>-->
                    <!--            @endif-->
                    <!--            @if ($skripsi->pembimbingdua == !null)-->
                    <!--                <p>2. {{ $skripsi->pembimbingdua->nama_singkat }}</p>-->
                    <!--            @endif-->
                    <!--        </td>-->
                    <!--        <td class="text-center">-->
                    <!--            <p>1. {{ $skripsi->pengujisatu->nama_singkat }}</p>-->
                    <!--            <p>2. {{ $skripsi->pengujidua->nama_singkat }}</p>-->
                    <!--            @if ($skripsi->pengujitiga == !null)-->
                    <!--                <p>3. {{ $skripsi->pengujitiga->nama_singkat }}</p>-->
                    <!--            @endif-->
                    <!--        </td>-->

                    <!--        <td class="text-center bg-secondary">-->
                    <!--             {{ $skripsi->alasan }}-->
                               
                    <!--        </td>-->
                    <!--    </tr>-->
                    <!--@endforeach-->


                </tbody>
            </table>


        </div>
        </div>


@if (Str::length(Auth::guard('dosen')->user()) > 0)
                @if (Auth::guard('dosen')->user()->role_id == 6 ||
                        Auth::guard('dosen')->user()->role_id == 7 ||
                        Auth::guard('dosen')->user()->role_id == 8 ||
                        Auth::guard('dosen')->user()->role_id == 9 ||
                        Auth::guard('dosen')->user()->role_id == 10 ||
                        Auth::guard('dosen')->user()->role_id == 11)
        <!--<div class="container card p-4 mb-5">-->
            
        <!--    <div class="mb-4 rounded bg-light">-->
        <!--        <div class="p-2 pt-3">-->
        <!--            <h5 class="">Riwayat Persetujuan</h5>-->
        <!--            <hr>-->
        <!--        </div>-->
        <!--    </div>-->

        <!--    <table class="table table-responsive-lg table-bordered table-striped" style="width:100%" id="datatables4">-->
        <!--    <thead class="table-dark">-->
        <!--        <tr>-->
        <!--            <th class="text-center" scope="col">NIM</th>-->
        <!--            <th class="text-center" scope="col">Nama</th>-->
        <!--            <th class="text-center" scope="col">Seminar</th>-->
        <!--            <th class="text-center" scope="col">Prodi</th>-->
        <!--            <th class="text-center" scope="col">Tanggal</th>-->
        <!--            <th class="text-center" scope="col">Waktu</th>-->
        <!--            <th class="text-center" scope="col">Lokasi</th>-->
        <!--            <th class="text-center" scope="col">Pembimbing</th>-->
        <!--            <th class="text-center" scope="col">Penguji</th>-->
        <!--            <th class="text-center" scope="col">Aksi</th>-->
        <!--        </tr>-->
        <!--    </thead>-->
        <!--    <tbody>-->

        <!--        @foreach ($penjadwalan_skripsis as $skripsi)-->
        <!--            <tr>-->
        <!--                <td class="text-center">{{ $skripsi->mahasiswa->nim }}</td>-->
        <!--                <td class="text-left pl-3 pr-1 fw-bold">{{ $skripsi->mahasiswa->nama }}</td>-->
        <!--                <td class="bg-warning text-center">{{ $skripsi->jenis_seminar }}</td>-->
        <!--                <td class="text-center">{{ $skripsi->prodi->nama_prodi }}</td>-->
        <!--                <td class="text-center">{{ Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y') }}</td>-->
        <!--                <td class="text-center">{{ $skripsi->waktu }}</td>-->
        <!--                <td class="text-center">{{ $skripsi->lokasi }}</td>-->
        <!--                <td class="text-center">-->
        <!--                    @if ($skripsi->pembimbingdua == !null)-->
        <!--                    <p>1. {{ $skripsi->pembimbingsatu->nama_singkat }}</p>-->
        <!--                    @endif-->
        <!--                    @if ($skripsi->pembimbingdua == !null)-->
        <!--                        <p>2. {{ $skripsi->pembimbingdua->nama_singkat }}</p>-->
        <!--                    @endif-->
        <!--                </td>-->
        <!--                <td class="text-center">-->
        <!--                    <p>1. {{ $skripsi->pengujisatu->nama_singkat }}</p>-->
        <!--                    <p>2. {{ $skripsi->pengujidua->nama_singkat }}</p>-->
        <!--                    @if ($skripsi->pengujitiga == !null)-->
        <!--                        <p>3. {{ $skripsi->pengujitiga->nama_singkat }}</p>-->
        <!--                    @endif-->
        <!--                </td>-->
        <!--                <td class="text-center">-->
        <!--                    <a href="/penilaian-skripsi/cek-nilai/{{ Crypt::encryptString($skripsi->id) }}"-->
        <!--                        class="badge bg-success p-2"style="border-radius:20px;">Berita Acara</a>-->
        <!--                </td>-->
        <!--            </tr>-->
        <!--        @endforeach-->

        <!--    </tbody>-->
        <!--</table>-->


        <!--</div>-->
        @endif
        @endif

        <div class="d-flex align-items-end flex-column fixed-bottom bd-highlight mb-5">
        <div class="mt-auto p-2 bd-highlight ">
            <span onclick="scrollToTop()" id="scrollToTopBtn" title="Kembali ke Atas" style="width: 40px; height: 40px; cursor: pointer;"><i class="fas fa-chevron-circle-up fa-lg fs-2"></i></span>
        </div>
        </div>

<br>
<br>
<br>
<br>
    @endsection

    @section('footer')
        <section class="bg-dark p-1">
            <div class="container">
                <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <small> <span
                            class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank"
                            target="_blank" href="https://fahrilhadi.com">Fahril Hadi, </a>
                        <a class="text-success fw-bold" formtarget="_blank" target="_blank"
                            href="/developer/rahul-ilsa-tajri-mukhti">Rahul Ilsa Tajri Mukhti </a> <span
                            class="text-success fw-bold">&</span>
                        <a class="text-success fw-bold" formtarget="_blank" target="_blank"
                            href="/developer/m-seprinaldi"> M. Seprinaldi</a><span
                            class="text-success fw-bold">)</span></small></p>
            </div>
        </section>
    @endsection

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {  
                const Semua = {!! json_encode(
                    $jml_riwayat_prodi_kp + $jml_riwayat_prodi_skripsi + $jml_riwayat_seminar_kp + $jml_riwayat_sempro + $jml_riwayat_skripsi,
                ) !!};
                
                if (Semua > 0) {
                    Swal.fire({
                        title: 'Ini adalah halaman Riwayat',
                        html: `Ada <strong class="text-info"> ${Semua} Mahasiswa</strong> yang telah selesai KP, Skripsi dan Seminar`,
                        icon: 'info',
                        showConfirmButton: true,
                        confirmButtonColor: '#28a745',
                    });
                } 
                else {
                    Swal.fire({
                        title: 'Ini adalah halaman Riwayat',
                        html: `Belum ada mahasiswa yang selesai KP, Skripsi, dan Seminar.`,
                        icon: 'info',
                        showConfirmButton: true,
                        confirmButtonColor: '#28a745',
                    });
                }
            });
        </script>
    @endpush()
    
    @push('scripts')
        <script>
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
    window.onscroll = function() {
        scrollFunction();
    };

    function scrollFunction() {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            document.getElementById("scrollToTopBtn").style.display = "block";
        } else {
            document.getElementById("scrollToTopBtn").style.display = "none";
        }
    }
    </script>
    @endpush()
