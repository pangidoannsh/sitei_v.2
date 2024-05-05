@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Jadwal Seminar
@endsection

@section('sub-title')
    Jadwal Seminar
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="swal" data-swal="{{ session('message') }}"></div>
    @endif

    <div class="container card p-4">

        <ol class="breadcrumb col-lg-12">

            @if (Str::length(Auth::guard('web')->user()) > 0)
                @if (Auth::guard('web')->user()->role_id == 2 ||
                        Auth::guard('web')->user()->role_id == 3 ||
                        Auth::guard('web')->user()->role_id == 4)
                    <li><a href="/persetujuan/admin/index" class="px-1">Persetujuan
                            (<span>{{ $jml_persetujuan_kp + $jml_persetujuan_skripsi }}</span>)</a></li>
                    <span class="px-2">|</span>
                @endif
                <li><a href="/form" class="breadcrumb-item active fw-bold text-success px-1">Seminar
                        (<span>{{ $jml_seminar_kp + $jml_sempro + $jml_sidang }}</span>)</a></li>
                <span class="px-2">|</span>

                @if (Auth::guard('web')->user()->role_id == 1)
                    <li><a href="/kerja-praktek/admin/index" class="px-1">Data KP (<span>{{ $jml_prodi_kp }}</span>)</a>
                    </li>
                    <span class="px-2">|</span>
                    <li><a href="/sidang/admin/index" class="px-1">Data Skripsi
                            (<span>{{ $jml_prodi_skripsi }}</span>)</a></li>
                    <span class="px-2">|</span>
                    <li><a href="/prodi/riwayat" class="px-1">Riwayat
                            (<span>{{ $jml_riwayat_prodi_kp + $jml_riwayat_prodi_skripsi + $jml_riwayat_seminar_kp + $jml_riwayat_sempro + $jml_riwayat_skripsi }}</span>)</a>
                    </li>
                    <span class="px-2">|</span>
                    <li><a href="/statistik" class="px-1">Statistik (All)</a></li>
                @endif

                @if (Auth::guard('web')->user()->role_id == 2 ||
                        Auth::guard('web')->user()->role_id == 3 ||
                        Auth::guard('web')->user()->role_id == 4)
                    <li><a href="/kerja-praktek/admin/index" class="px-1">Data KP (<span>{{ $jml_prodikp }}</span>)</a>
                    </li>
                    <span class="px-2">|</span>
                    <li><a href="/sidang/admin/index" class="px-1">Data Skripsi
                            (<span>{{ $jml_prodiskripsi }}</span>)</a></li>
                    <span class="px-2">|</span>
                    <li><a href="/prodi/riwayat" class="px-1">Riwayat
                            (<span>{{ $jml_riwayatkp + $jml_riwayatskripsi + $jml_jadwal_kps + $jml_jadwal_sempros + $jml_jadwal_skripsis }}</span>)</a>
                    </li>
                    <span class="px-2">|</span>
                    <li><a href="/statistik" class="px-1">Statistik (All)</a></li>
                @endif

               <!-- @if (Auth::guard('web')->user()->role_id == 1)
                    <span class="px-2">|</span>
                    <li><a href="/kapasitas-bimbingan/index" class="px-1">Kuota Bimbingan</a></li>
                @endif -->
            @endif


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

        @if (Auth::guard('web')->user()->role_id == 1)
            @php
            // Tetapkan semua Prodi yang diinginkan
            $all_prodi = ['Teknik Elektro D3', 'Teknik Elektro S1', 'Teknik Informatika S1']; // Ganti dengan daftar Prodi yang sesuai dengan aplikasi Anda

            // Inisialisasi array untuk daftar Prodi
            $prodi_list = [];

            // Ambil data Prodi dari pendaftaran seminar KP dan tambahkan ke dalam array
            foreach ($penjadwalan_kps as $kp) {
                $prodi_list[] = $kp->prodi->nama_prodi;
            }

            // Ambil data Prodi dari pendaftaran seminar Proposal dan tambahkan ke dalam array
            foreach ($penjadwalan_sempros as $sempro) {
                $prodi_list[] = $sempro->prodi->nama_prodi;
            }

            // Ambil data Prodi dari pendaftaran seminar Proposal dan tambahkan ke dalam array
            foreach ($penjadwalan_skripsis as $skripsi) {
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
        @endif

        <!-- Desktop Version -->
        <div class="d-none d-md-flex justify-content-between mb-3 filter">
            <div class="d-flex align-items-center">
                <div class="dataTables_length input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="lengthMenuJadwalSeminarAdminProdi">Tampilkan</label>
                    <select id="lengthMenuJadwalSeminarAdminProdi" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                    </select>
                </div>
                <div class="input-group ml-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="seminarFilterJadwalSeminarAdminProdi">Seminar</label>
                    <select id="seminarFilterJadwalSeminarAdminProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($jenis_seminar as $jenis)
                            <option value="{{ $jenis }}" class="text-capitalize">{{ $jenis }}</option>
                        @endforeach
                    </select>                   
                </div>
                @if (Auth::guard('web')->user()->role_id == 1)
                <div class="input-group ml-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="prodiFilterJadwalSeminarAdminProdi">Prodi</label>
                    <select id="prodiFilterJadwalSeminarAdminProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($prodi_list as $prodi)
                            <option value="{{ $prodi }}" class="text-capitalize">{{ $prodi }}</option>
                        @endforeach
                    </select>                    
                </div>
                @endif
            </div>
            <div class="dataTables_filter input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterJadwalSeminarAdminProdi">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1" id="searchFilterJadwalSeminarAdminProdi" placeholder="">
            </div>
        </div>

        <!-- Tablet & Mobile Version -->
        <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
            <div class="dataTables_length input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="lengthMenuMobileJadwalSeminarAdminProdi">Tampilkan</label>
                <select id="lengthMenuMobileJadwalSeminarAdminProdi" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="150">150</option>
                    <option value="200">200</option>
                    <option value="250">250</option>
                </select>
            </div>
            <div class="input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="seminarFilterMobileJadwalSeminarAdminProdi">Seminar</label>
                <select id="seminarFilterMobileJadwalSeminarAdminProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                    <option value="" selected>Semua</option>
                    @foreach ($jenis_seminar as $jenis)
                        <option value="{{ $jenis }}" class="text-capitalize">{{ $jenis }}</option>
                    @endforeach
                </select>                    
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-center gap-3 mb-3 filter d-block d-md-none">
            @if (Auth::guard('web')->user()->role_id == 1)
            <div class="input-group mt-3" style="width: max-content;">
                <label class="pt-2 pr-2" for="prodiFilterMobileJadwalSeminarAdminProdi">Prodi</label>
                <select id="prodiFilterMobileJadwalSeminarAdminProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                    <option value="" selected>Semua</option>
                    @foreach ($prodi_list as $prodi)
                        <option value="{{ $prodi }}" class="text-capitalize">{{ $prodi }}</option>
                    @endforeach
                </select>                    
            </div>
            @endif
            <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterMobileJadwalSeminarAdminProdi">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1" style="width: 83px;" id="searchFilterMobileJadwalSeminarAdminProdi" placeholder="">
            </div>
        </div>

        <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatablesjadwalseminaradminprodi">
            @if (Auth::guard('web')->user()->role_id == 2 ||
                    Auth::guard('web')->user()->role_id == 3 ||
                    Auth::guard('web')->user()->role_id == 4)
                <!--<div>-->
                <!--    <a href="{{ url('/form-kp/create') }}" class="btn kp btn-success mb-4">+ KP</a>-->
                <!--    <a href="{{ url('/form-sempro/create') }}" class="btn sempro btn-success mb-4">+ Sempro</a>-->
                <!--    <a href="{{ url('/form-skripsi/create') }}" class="btn skripsi btn-success mb-4">+ Skripsi</a>-->
                <!--</div>-->
            @endif
            <thead class="table-dark">
                @if (session()->has('message'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                               <i class="fas fa-check fs-4 fa-lg"></i> {{ session('message') }} 
                            </div>
                        @endif
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
                    @if (auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)
                        <th class="text-center" scope="col">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>


                @foreach ($penjadwalan_kps as $kp)
                    <tr>
                        <td class="text-center">{{ $kp->mahasiswa->nim }}</td>
                        <td class="text-left pl-3 pr-1 py-2 fw-bold">{{ $kp->mahasiswa->nama }}</td>
                        <td class="bg-primary text-center">{{ $kp->jenis_seminar }}</td>
                        <td class="text-center">{{ $kp->prodi->nama_prodi }}</td>
                        {{-- <td class="text-center">
              @if ($kp->tanggal == null)
              <p> </p>
              @else
              {{Carbon::parse($kp->tanggal)->translatedFormat('l')}}
              </td>
              @endif --}}

                        <td class="text-center">
                            @if ($kp->tanggal == null)
                                <p> </p>
                            @else
                                {{ Carbon::parse($kp->tanggal)->translatedFormat('l, d F Y') }}
                        </td>
                @endif

                <td class="text-center">{{ $kp->waktu }}</td>
                <td class="text-center">{{ $kp->lokasi }}</td>

                <td class="text-center">{{ $kp->pembimbing->nama_singkat}}</td>
                @if ($kp->penguji == !null)
                    <td class="text-center">{{ $kp->penguji->nama_singkat }}</td>
                @else
                    <td class="text-center"></td>
                @endif

                @if (auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)
                    <td class="text-center">
                        <!-- <a href="/form-kp/edit/{{ Crypt::encryptString($kp->id) }}" class="badge bg-warning p-2"><i
                                class="fas fa-pen"></i></a> -->

                                @if($kp->waktu == null)
                                            <a href="/form-kp/edit/{{ Crypt::encryptString($kp->id) }}"
                                            class="badge bg-success p-2 mb-2"> Tambah Jadwal<a> <br>
                                        @else
                                            <a href="/form-kp/edit/{{ Crypt::encryptString($kp->id) }}"
                                            class="badge bg-warning p-2 mb-2"> Edit<a><br>
                                        @endif

                                        <!-- @if($kp->waktu != null)
                                            <a href="/form-kp/undur/admin/{{ Crypt::encryptString($kp->id) }}"
                                            class="badge bg-danger p-2">Reschedule<a>
                                        @endif -->

                    </td>
                @endif
                </tr>
                @endforeach

                @foreach ($penjadwalan_sempros as $sempro)
                    <tr>
                        <td class="text-center">{{ $sempro->mahasiswa->nim }}</td>
                        <td class="text-left pl-3 pr-1 py-2 fw-bold">{{ $sempro->mahasiswa->nama }}</td>
                        <td class="bg-success text-center">{{ $sempro->jenis_seminar }}</td>
                        <td class="text-center">{{ $sempro->prodi->nama_prodi }}</td>
                        {{-- <td class="text-center">
              @if ($sempro->tanggal == null)
              <p> </p>
              @else
              {{Carbon::parse($sempro->tanggal)->translatedFormat('l')}}
              </td>
              @endif  --}}
                        <td class="text-center">
                            @if ($sempro->tanggal == null)
                                <p> </p>
                            @else
                                {{ Carbon::parse($sempro->tanggal)->translatedFormat('l, d F Y') }}
                        </td>
                @endif
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

                @if ($sempro->pengujisatu == !null || $sempro->pengujisatu == !null || $sempro->pengujitiga == !null)
                    <td class="text-center">
                        <p>1. {{ $sempro->pengujisatu->nama_singkat }}</p>
                        @if ($sempro->pengujidua == !null)
                            <p>2. {{ $sempro->pengujidua->nama_singkat }}</p>
                        @endif
                        @if ($sempro->pengujitiga == !null)
                            <p>3. {{ $sempro->pengujitiga->nama_singkat }}</p>
                        @endif
                    </td>
                @else
                    <td class="text-center"></td>
                @endif




                @if (auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)
                    <td class="text-center">
                        <!-- <a href="/form-sempro/edit/{{ Crypt::encryptString($sempro->id) }}"
                            class="badge bg-warning p-2"><i class="fas fa-pen"></i></a> -->

                            @if($sempro->waktu == null)
                                            <a href="/form-sempro/edit/{{ Crypt::encryptString($sempro->id) }}"
                                            class="badge bg-success p-2 mb-2"> Tambah Jadwal<a> <br>
                                        @else
                                            <a href="/form-sempro/edit/{{ Crypt::encryptString($sempro->id) }}"
                                            class="badge bg-warning p-2 mb-2"> Edit<a><br>
                                        @endif

                                        @if($sempro->waktu != null)
                                            <!-- <a href="/sempro/undur/admin/{{ $sempro->id }}"
                                            class="badge bg-danger p-2">Reschedule<a> -->
                                            <button onclick="undurSempro({{ $sempro->id }})"
                                        class="btn btn-danger badge p-2 " data-bs-toggle="tooltip" title="Batalkan Jadwal Sempro">Batalkan Jadwal</button>
                                        @endif
                    </td>
                @endif
                </tr>
                @endforeach

                @foreach ($penjadwalan_skripsis as $skripsi)
                    <tr>
                        <td class="text-center">{{ $skripsi->mahasiswa->nim }}</td>
                        <td class="text-left pl-3 pr-1 py-2 fw-bold">{{ $skripsi->mahasiswa->nama }}</td>
                        <td class="bg-warning text-center">{{ $skripsi->jenis_seminar }}</td>
                        <td class="text-center">{{ $skripsi->prodi->nama_prodi }}</td>
                        {{-- <td class="text-center">
              @if ($skripsi->tanggal == null)
              <p> </p>
              @else
              {{Carbon::parse($skripsi->tanggal)->translatedFormat('l')}}
              </td>
              @endif  --}}
                        <td class="text-center">
                            @if ($skripsi->tanggal == null)
                                <p> </p>
                            @else
                                {{ Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y') }}
                        </td>
                @endif
                <td class="text-center">{{ $skripsi->waktu }}</td>
                <td class="text-center">{{ $skripsi->lokasi }}</td>
                <td class="text-center">
                    @if ($sempro->pembimbingsatu == !null)
                    <p>1. {{ $skripsi->pembimbingsatu->nama_singkat }}</p>
                    @endif
                    @if ($skripsi->pembimbingdua == !null)
                        <p>2. {{ $skripsi->pembimbingdua->nama_singkat }}</p>
                    @endif
                </td>

                @if ($skripsi->pengujisatu == !null || $skripsi->pengujisatu == !null || $skripsi->pengujitiga == !null)
                    <td class="text-center">
                        <p>1. {{ $skripsi->pengujisatu->nama_singkat }}</p>
                        @if ($skripsi->pengujidua == !null)
                            <p>2. {{ $skripsi->pengujidua->nama_singkat }}</p>
                        @endif
                        @if ($skripsi->pengujitiga == !null)
                            <p>3. {{ $skripsi->pengujitiga->nama_singkat }}</p>
                        @endif
                    </td>
                @else
                    <td class="text-center"></td>
                @endif

                @if (auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)
                    <td class="text-center">
                        @if($skripsi->waktu == null)
                                            <a href="/form-skripsi/edit/{{ Crypt::encryptString($skripsi->id) }}"
                                            class="badge bg-success p-2 mb-2"> Tambah Jadwal<a> <br>
                                        @else
                                            <a href="/form-skripsi/edit/{{ Crypt::encryptString($skripsi->id) }}"
                                            class="badge bg-warning p-2 mb-2"> Edit<a><br>
                                        @endif

                                        @if($skripsi->waktu != null)
                                            <button onclick="undurSidang({{ $skripsi->id }})"
                                        class="btn btn-danger badge p-2 " data-bs-toggle="tooltip" title="Batalkan Jadwal Sidang">Batalkan Jadwal</button>
                                        @endif
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
        document.addEventListener('DOMContentLoaded', function() {
            const jumlahJadwal = {!! json_encode($jml_seminar_kp + $jml_sempro + $jml_sidang) !!};

            if (jumlahJadwal > 0) {
                Swal.fire({
                    title: 'Ini adalah halaman Jadwal Seminar',
                    html: `Ada <strong class="text-info"> ${jumlahJadwal} Mahasiswa</strong> dijadwalkan seminar.`,
                    icon: 'info',
                    icon: 'info',
                    showConfirmButton: true,
                    confirmButtonColor: '#28a745',
                });
            } else {
                Swal.fire({
                    title: 'Ini adalah halaman Jadwal Seminar',
                    html: `Belum ada mahasiswa yang menunggu dan dijadwalkan seminar.`,
                    icon: 'info',
                    showConfirmButton: true,
                    confirmButtonColor: '#28a745',
                });
            }
        });
    </script>
@endpush()


@push('scripts')
    @foreach ($penjadwalan_sempros as $sempro)
        <script>
            function undurSempro(id) {
                Swal.fire({
                    title: 'Batalkan Jadwal Sempro',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({

                            title: 'Batalkan Jadwal Sempro',
                            html: `
                        <form id="myForm"  action="/sempro/undur/admin/${id}" method="POST">
                        @method('put')
                           @csrf
                            <label for="alasan">Alasan dibatalkan jadwal :</label>
                            <textarea class="form-control @error('alasan') is-invalid @enderror" value="{{ old('alasan') }}" name="alasan" rows="4" cols="50" autofocus required></textarea>
                            @error('alasan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <br>
                            <button type="submit"  class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                      
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }

        </script>
    @endforeach
@endpush()

@push('scripts')
<script>
    document.getElementById('myForm').addEventListener('submit', function(event) {
        event.preventDefault(); 

        var alasanValue = document.querySelector('textarea[name="alasan"]').value;

        var newAction = "/sempro/undur/admin" + encodeURIComponent(alasanValue);

        this.setAttribute('action', newAction);

        this.submit();
    });
</script>
@endpush()


@push('scripts')
    @foreach ($penjadwalan_skripsis as $skripsi)
        <script>
            function undurSidang(id) {
                Swal.fire({
                    title: 'Batalkan Jadwal Sidang',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({

                            title: 'Batalkan Jadwal Sidang',
                            html: `
                        <form id="myFormSidang"  action="/sidang/undur/admin/${id}" method="POST">
                        @method('put')
                           @csrf
                            <label for="alasan">Alasan dibatalkan jadwal :</label>
                            <textarea class="form-control @error('alasan') is-invalid @enderror" value="{{ old('alasan') }}" name="alasan" rows="4" cols="50" autofocus required></textarea>
                            @error('alasan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <br>
                            <button type="submit"  class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                      
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }

        </script>
    @endforeach
@endpush()

@push('scripts')
<script>
    document.getElementById('myFormSidang').addEventListener('submit', function(event) {
        event.preventDefault(); 

        var alasanValue = document.querySelector('textarea[name="alasan"]').value;

        var newAction = "/sidang/undur/admin" + encodeURIComponent(alasanValue);

        this.setAttribute('action', newAction);

        this.submit();
    });
</script>
@endpush()


@push('scripts')
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 5000);
    </script>
@endpush()