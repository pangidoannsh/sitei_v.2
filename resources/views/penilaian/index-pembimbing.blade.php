@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Jadwal Seminar Pembimbing dan Penguji
@endsection

@section('sub-title')
    Jadwal Seminar Pembimbing dan Penguji
@endsection

@section('content')

    @if (session()->has('message'))
        <div class="swal" data-swal="{{ session('message') }}"></div>
    @endif

    @if (session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
        </div>
    @endif

    <div class="container card  p-4">

        <ol class="breadcrumb col-lg-12">
            <li>
                <a href="/persetujuan-kp-skripsi" class="px-1">Persetujuan 
                    @if (Auth::guard('dosen')->user()->role_id == 6 ||
                        Auth::guard('dosen')->user()->role_id == 7 ||
                        Auth::guard('dosen')->user()->role_id == 8 ||
                        Auth::guard('dosen')->user()->role_id == 9 ||
                        Auth::guard('dosen')->user()->role_id == 10 ||
                        Auth::guard('dosen')->user()->role_id == 11 )
                       (<span>{{ $jml_persetujuan_kp + $jml_persetujuan_skripsi + $jml_persetujuan_seminar }}</span>)
                      @endif
                    @if(Auth::guard('dosen')->user()->role_id == 5 || Auth::guard('dosen')->user()->role_id == null)
                        (<span>{{ $jml_persetujuan_kp + $jml_persetujuan_skripsi }}</span>)
                    @endif </a>
            </li>
            <span class="px-2">|</span>
            <li>
                <a href="/kp-skripsi/seminar-pembimbing-penguji"
                    class="breadcrumb-item active fw-bold text-success px-1">Seminar
                    (<span>{{ $jml_seminar_kp + $jml_sempro + $jml_sidang }}</span>) </a>
            </li>

            <span class="px-2">|</span>
            <li><a href="/pembimbing/kerja-praktek" class="px-1">Bimbingan KP (<span>{{ $jml_bimbingankp }}</span>)</a></li>
            <span class="px-2">|</span>
            <li><a href="/pembimbing/skripsi" class="px-1">Bimbingan Skripsi (<span>{{ $jml_bimbinganskripsi }}</span>)</a></li>
            <span class="px-2">|</span>
            <li><a href="/pembimbing-penguji/riwayat-bimbingan" class="px-1">Riwayat (<span>{{ $jml_riwayat_seminar_kp + $jml_riwayat_sempro + $jml_riwayat_sidang + $jml_riwayat_kp + $jml_riwayat_skripsi }}</span>)</a></li>
           <span class="px-2">|</span>
                    <li><a href="/statistik" class="px-1">Statistik (All)</a></li>

        </ol>
        
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

        <!-- Desktop Version -->
        <div class="d-none d-md-flex justify-content-between mb-3 filter">
            <div class="d-flex align-items-center">
                <div class="dataTables_length input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="lengthMenuJadwalSeminarPembimbingPenguji">Tampilkan</label>
                    <select id="lengthMenuJadwalSeminarPembimbingPenguji" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                    </select>
                </div>
                <div class="input-group ml-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="seminarFilterJadwalSeminarPembimbingPenguji">Seminar</label>
                    <select id="seminarFilterJadwalSeminarPembimbingPenguji" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($jenis_seminar as $jenis)
                            <option value="{{ $jenis }}" class="text-capitalize">{{ $jenis }}</option>
                        @endforeach
                    </select>                   
                </div>
            </div>
            <div class="dataTables_filter input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterJadwalSeminarPembimbingPenguji">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1" id="searchFilterJadwalSeminarPembimbingPenguji" placeholder="">
            </div>
        </div>

        <!-- Tablet & Mobile Version -->
        <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
            <div class="dataTables_length input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="lengthMenuMobileJadwalSeminarPembimbingPenguji">Tampilkan</label>
                <select id="lengthMenuMobileJadwalSeminarPembimbingPenguji" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="150">150</option>
                    <option value="200">200</option>
                    <option value="250">250</option>
                </select>
            </div>
            <div class="input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="seminarFilterMobileJadwalSeminarPembimbingPenguji">Seminar</label>
                <select id="seminarFilterMobileJadwalSeminarPembimbingPenguji" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                    <option value="" selected>Semua</option>
                    @foreach ($jenis_seminar as $jenis)
                        <option value="{{ $jenis }}" class="text-capitalize">{{ $jenis }}</option>
                    @endforeach
                </select>                    
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-center gap-3 mb-3 filter d-block d-md-none">
            <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterMobileJadwalSeminarPembimbingPenguji">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1" id="searchFilterMobileJadwalSeminarPembimbingPenguji" placeholder="">
            </div>
        </div>

        <table class="table table-responsive-lg table-bordered table-striped" style="width:100%" id="datatablesjadwalseminarpembimbingpenguji">
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
                    <th class="text-center"scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($penjadwalan_kps as $kp)
                    @if ($kp->tanggal == !null)
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
                            <td class="text-center">
                                @if ($kp->penilaian(Auth::user()->nip, $kp->id) == false)
                                    @if ($kp->status_seminar == '0')
                                        <a href="/penilaian-kp/create/{{ Crypt::encryptString($kp->id) }}"
                                            class="badge bg-primary"style="border-radius:20px; padding:7px;"> Input Nilai<a>
                                            @else
                                                <span class="badge bg-danger"style="border-radius:20px; padding:7px;">Belum
                                                    Dimulai</span>
                                    @endif
                                @else
                                    <a href="/penilaian-kp/edit/{{ Crypt::encryptString($kp->id) }}"
                                        class="badge bg-warning" style="border-radius:20px; padding:7px;"> Edit Nilai<a>
                                @endif
                                <a formtarget="_blank" target="_blank"
                                    href="/undangan-kp/{{ Crypt::encryptString($kp->id) }}"
                                    class="badge bg-info p-2 mt-2"style="border-radius:20px;">Undangan</a>
                            </td>
                        </tr>
                    @endif
                @endforeach

                @foreach ($penjadwalan_sempros as $sempro)
                    @if ($sempro->tanggal == !null)
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
                            <td class="text-center">
                                <!-- <a href="/daftar-sempro/detail/pembimbing/{{ $sempro->pendaftaranskripsi->mahasiswa_nim}}"
                                            class="badge bg-info my-2 px-2 py-2"><i class="fas fa-info-circle"></i></a> <br> -->

                                @if ($sempro->penilaian(Auth::user()->nip, $sempro->id) == false)
                                    @if ($sempro->status_seminar == '0')
                                        <a href="/penilaian-sempro/create/{{ Crypt::encryptString($sempro->id) }}"
                                            class="badge bg-primary"style="border-radius:20px; padding:7px;"> Input Nilai<a>
                                            @else
                                                <span class="badge bg-danger"style="border-radius:20px; padding:7px;">Belum
                                                    Dimulai</span>
                                    @endif
                                @else
                                    <a href="/penilaian-sempro/edit/{{ Crypt::encryptString($sempro->id) }}"
                                        class="badge bg-warning" style="border-radius:20px; padding:7px;"> Edit Nilai<a>
                                @endif
                                <a formtarget="_blank" target="_blank"
                                    href="/undangan-sempro/{{ Crypt::encryptString($sempro->id) }}"
                                    class="badge bg-info p-2 mt-2"style="border-radius:20px;">Undangan</a>
                            </td>
                        </tr>
                    @endif
                @endforeach

                @foreach ($penjadwalan_skripsis as $skripsi)
                    @if ($skripsi->tanggal == !null)
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
                            <td class="text-center">
                                @if ($skripsi->penilaian(Auth::user()->nip, $skripsi->id) == false)
                                    @if ($skripsi->status_seminar == '0')
                                        <a href="/penilaian-skripsi/create/{{ Crypt::encryptString($skripsi->id) }}"
                                            class="badge bg-primary"style="border-radius:20px; padding:7px;"> Input Nilai<a>
                                            @else
                                                <span class="badge bg-danger"style="border-radius:20px; padding:7px;">Belum
                                                    Dimulai</span>
                                    @endif
                                @else
                                    <a href="/penilaian-skripsi/edit/{{ Crypt::encryptString($skripsi->id) }}"
                                        class="badge bg-warning" style="border-radius:20px; padding:7px;"> Edit Nilai<a>
                                @endif
                                <a formtarget="_blank" target="_blank"
                                    href="/undangan-sidang/{{ Crypt::encryptString($skripsi->id) }}"
                                    class="badge bg-info p-2 mt-2"style="border-radius:20px;">Undangan</a>

                            </td>
                        </tr>
                    @endif
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
                        target="_blank" href="https://fahrilhadi.com">Fahril Hadi, </a>
                    <a class="text-success fw-bold" formtarget="_blank" target="_blank"
                        href="/developer/rahul-ilsa-tajri-mukhti">Rahul Ilsa Tajri Mukhti </a> <span
                        class="text-success fw-bold">&</span>
                    <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/m-seprinaldi">
                        M. Seprinaldi</a><span class="text-success fw-bold">)</span></small></p>
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
    </script>
@endpush()

@push('scripts')
    <script>
        const swal = $('.swal').data('swal');
        if (swal) {
            Swal.fire({
                title: 'Berhasil',
                text: swal,
                confirmButtonColor: '#28A745',
                icon: 'success'
            })
        }
    </script>
@endpush()

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const waitingApprovalCount = {!! json_encode($jml_seminar_kp + $jml_sempro + $jml_sidang) !!};
            if (waitingApprovalCount > 0) {
                Swal.fire({
                    title: 'Ini adalah halaman Seminar Pembimbing dan Penguji',
                    html: `Ada <strong class="text-info"> ${waitingApprovalCount} Mahasiswa</strong> akan melaksanakan seminar.`,
                    icon: 'info',
                    showConfirmButton: true,
                    confirmButtonColor: '#28a745',
                });
            } else {
                Swal.fire({
                    title: 'Ini adalah halaman Seminar Pembimbing dan Penguji',
                    html: `Belum ada mahasiswa yang akan melaksanakan seminar.`,
                    icon: 'info',
                    showConfirmButton: true,
                    confirmButtonColor: '#28a745',
                });
            }
        });
    </script>
@endpush()
