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

    @if (session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
        </div>
    @endif
    <div class="container card  p-4">


        <ol class="breadcrumb col-lg-12">
            @if (Str::length(Auth::guard('dosen')->user()) > 0)
                @if (Auth::guard('dosen')->user()->role_id == 5 ||
                        Auth::guard('dosen')->user()->role_id == 6 ||
                        Auth::guard('dosen')->user()->role_id == 7 ||
                        Auth::guard('dosen')->user()->role_id == 8 ||
                        Auth::guard('dosen')->user()->role_id == 9 ||
                        Auth::guard('dosen')->user()->role_id == 10 ||
                        Auth::guard('dosen')->user()->role_id == 11)
                    <li><a href="/prodi/kp-skripsi/seminar" class="breadcrumb-item active fw-bold text-success px-1">Seminar
                            (<span>{{ $jml_seminar_kp + $jml_sempro + $jml_sidang }}</span>) </a></li>

                    <span class="px-2">|</span>
                    <li><a href="/kerja-praktek" class="px-1">Data KP (<span>{{ $jml_prodi_kp }}</span>)</a></li>

                    <span class="px-2">|</span>
                    <li><a href="/skripsi" class="px-1">Data Skripsi (<span>{{ $jml_prodi_skripsi }}</span>)</a></li>


                    <span class="px-2">|</span>
                    <li><a href="/prodi/riwayat" class="px-1">Riwayat
                            (<span>{{ $jml_riwayat_prodi_kp + $jml_riwayat_prodi_skripsi + $jml_riwayat_seminar_kp + $jml_riwayat_sempro + $jml_riwayat_skripsi }}</span>)</a>
                    </li>
                    <span class="px-2">|</span>
                    <li><a href="/statistik" class="px-1">Statistik (All)</a></li>
                @endif
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

        // Ambil data Prodi dari pendaftaran sidang Skripsi dan tambahkan ke dalam array
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

        <!-- Desktop Version -->
        <div class="d-none d-md-flex justify-content-between mb-3 filter">
            <div class="d-flex align-items-center">
                <div class="dataTables_length input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="lengthMenuJadwalSeminarProdi">Tampilkan</label>
                    <select id="lengthMenuJadwalSeminarProdi" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                    </select>
                </div>
                <div class="input-group ml-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="seminarFilterJadwalSeminarProdi">Seminar</label>
                    <select id="seminarFilterJadwalSeminarProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($jenis_seminar as $jenis)
                            <option value="{{ $jenis }}" class="text-capitalize">{{ $jenis }}</option>
                        @endforeach
                    </select>                   
                </div>
                <div class="input-group ml-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="prodiFilterJadwalSeminarProdi">Prodi</label>
                    <select id="prodiFilterJadwalSeminarProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($prodi_list as $prodi)
                            <option value="{{ $prodi }}" class="text-capitalize">{{ $prodi }}</option>
                        @endforeach
                    </select>                    
                </div>
            </div>
            <div class="dataTables_filter input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterJadwalSeminarProdi">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1" id="searchFilterJadwalSeminarProdi" placeholder="">
            </div>
        </div>

        <!-- Tablet & Mobile Version -->
        <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
            <div class="dataTables_length input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="lengthMenuMobileJadwalSeminarProdi">Tampilkan</label>
                <select id="lengthMenuMobileJadwalSeminarProdi" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="150">150</option>
                    <option value="200">200</option>
                    <option value="250">250</option>
                </select>
            </div>
            <div class="input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="seminarFilterMobileJadwalSeminarProdi">Seminar</label>
                <select id="seminarFilterMobileJadwalSeminarProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                    <option value="" selected>Semua</option>
                    @foreach ($jenis_seminar as $jenis)
                        <option value="{{ $jenis }}" class="text-capitalize">{{ $jenis }}</option>
                    @endforeach
                </select>                    
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-center gap-3 mb-3 filter d-block d-md-none">
            <div class="input-group mt-3" style="width: max-content;">
                <label class="pt-2 pr-2" for="prodiFilterMobileJadwalSeminarProdi">Prodi</label>
                <select id="prodiFilterMobileJadwalSeminarProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                    <option value="" selected>Semua</option>
                    @foreach ($prodi_list as $prodi)
                        <option value="{{ $prodi }}" class="text-capitalize">{{ $prodi }}</option>
                    @endforeach
                </select>                    
            </div>
            <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterMobileJadwalSeminarProdi">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1" style="width: 83px;" id="searchFilterMobileJadwalSeminarProdi" placeholder="">
            </div>
        </div>

        <table class="table table-responsive-lg table-bordered table-striped" style="width:100%" id="datatablesjadwalseminarprodi">
            <thead class="table-dark">

            @if (session()->has('message'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                               <i class="fas fa-check-circle fs-4 fa-lg"></i> {{ session('message') }} 
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
                    @if (Str::length(Auth::guard('dosen')->user()) > 0)
                        @if (Auth::guard('dosen')->user()->role_id == 9 ||
                                Auth::guard('dosen')->user()->role_id == 10 ||
                                Auth::guard('dosen')->user()->role_id == 11)
                            <th class="text-center"scope="col">Aksi</th>
                        @endif
                    @endif
                </tr>
            </thead>
            <tbody>

                @foreach ($penjadwalan_kps as $kp)
                    
                        <tr>
                            <td class="text-center">{{ $kp->mahasiswa->nim }}</td>
                            <td class="text-left pl-3 pr-1 fw-bold">{{ $kp->mahasiswa->nama }}</td>
                            <td class="bg-primary text-center">{{ $kp->jenis_seminar }}</td>
                            <td class="text-center">{{ $kp->prodi->nama_prodi }}</td>
                            <td class="text-center">
                                @if($kp->tanggal != null)
                                {{ Carbon::parse($kp->tanggal)->translatedFormat('l, d F Y') }}
                                @else
                                @endif
                                </td>
                            <td class="text-center">{{ $kp->waktu }}</td>
                            <td class="text-center">{{ $kp->lokasi }}</td>
                            <td class="text-center">
                                <p>{{ $kp->pembimbing->nama_singkat }}</p>
                            </td>
                            <td class="text-center">
                                <p>{{ $kp->penguji->nama_singkat }}</p>
                            </td>
                            @if (Str::length(Auth::guard('dosen')->user()) > 0)
                                @if (Auth::guard('dosen')->user()->role_id == 9 ||
                                        Auth::guard('dosen')->user()->role_id == 10 ||
                                        Auth::guard('dosen')->user()->role_id == 11)
                                    <td class="text-center">
                                        <!-- <a href="/form-kp/edit/koordinator/{{ Crypt::encryptString($kp->id) }}"
                                            class="badge bg-warning mt-2 p-2"><i class="fas fa-pen"></i></a> -->

                                            @if($kp->waktu == null)
                                            <a href="/form-kp/edit/koordinator/{{ Crypt::encryptString($kp->id) }}"
                                            class="badge bg-success p-2 mb-2"> Tambah Jadwal<a> <br>
                                        @else
                                            <a href="/form-kp/edit/koordinator/{{ Crypt::encryptString($kp->id) }}"
                                            class="badge bg-warning p-2 mb-2"> Edit<a><br>
                                        @endif
                                    </td>
                                @endif
                            @endif
                        </tr>
                   
                @endforeach


                @foreach ($penjadwalan_sempros as $sempro)
                    
                        <tr>
                            <td class="text-center">{{ $sempro->mahasiswa->nim }}</td>
                            <td class="text-left pl-3 pr-1 fw-bold">{{ $sempro->mahasiswa->nama }}</td>
                            <td class="bg-success text-center">{{ $sempro->jenis_seminar }}</td>
                            <td class="text-center">{{ $sempro->prodi->nama_prodi }}</td>
                            @if ($sempro->tanggal == !null)
                                <td class="text-center">{{ Carbon::parse($sempro->tanggal)->translatedFormat('l, d F Y') }}
                                </td>
                            @else
                                <td class="text-center"></td>
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
                            @if (Str::length(Auth::guard('dosen')->user()) > 0)
                                @if (Auth::guard('dosen')->user()->role_id == 9 ||
                                        Auth::guard('dosen')->user()->role_id == 10 ||
                                        Auth::guard('dosen')->user()->role_id == 11)
                                    <td class="text-center">
                                            <!-- <a href="/form-sempro/edit/koordinator/{{ Crypt::encryptString($sempro->id) }}"
                                            class="badge bg-warning mt-2 p-2"><i class="fas fa-pen"></i></a> -->

                                            @if($sempro->waktu == null)
                                            <a href="/form-sempro/edit/koordinator/{{ Crypt::encryptString($sempro->id) }}"
                                            class="badge bg-success p-2 mb-2"> Tambah Jadwal<a> <br>
                                        @else
                                            <a href="/form-sempro/edit/koordinator/{{ Crypt::encryptString($sempro->id) }}"
                                            class="badge bg-warning p-2 mb-2"> Edit<a><br>
                                        @endif

                                        @if($sempro->waktu != null)
                                            <button onclick="undurSempro({{ $sempro->id }})"
                                        class="btn btn-danger badge p-2 " data-bs-toggle="tooltip" title="Batal Jadwal Sempro">Batalkan Jadwal</button>
                                        @endif

                                    </td>
                                @endif
                            @endif
                        </tr>
                  
                @endforeach

                @foreach ($penjadwalan_skripsis as $skripsi)
                   
                        <tr>
                            <td class="text-center">{{ $skripsi->mahasiswa->nim }}</td>
                            <td class="text-left pl-3 pr-1 fw-bold">{{ $skripsi->mahasiswa->nama }}</td>
                            <td class="bg-warning text-center">{{ $skripsi->jenis_seminar }}</td>
                            <td class="text-center">{{ $skripsi->prodi->nama_prodi }}</td>
                            <td class="text-center">
                                @if($skripsi->tanggal != null)
                                {{ Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y') }}
                                @endif
                                
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

                            @if (Str::length(Auth::guard('dosen')->user()) > 0)
                                @if (Auth::guard('dosen')->user()->role_id == 9 ||
                                        Auth::guard('dosen')->user()->role_id == 10 ||
                                        Auth::guard('dosen')->user()->role_id == 11)
                                    <td class="text-center">
                                        <!-- <a href="/form-skripsi/edit/koordinator/{{ Crypt::encryptString($skripsi->id) }}"
                                            class="badge bg-warning mt-2 p-2"><i class="fas fa-pen"></i></a> -->

                                        @if($skripsi->waktu == null)
                                            <a href="/form-skripsi/edit/koordinator/{{ Crypt::encryptString($skripsi->id) }}"
                                            class="badge bg-success p-2 mb-2"> Tambah Jadwal<a> <br>
                                        @else
                                            <a href="/form-skripsi/edit/koordinator/{{ Crypt::encryptString($skripsi->id) }}"
                                            class="badge bg-warning p-2 mb-2"> Edit<a><br>
                                        @endif

                                        @if($skripsi->waktu != null)
                                            <button onclick="undurSidang({{ $skripsi->id }})"
                                        class="btn btn-danger badge p-2 " data-bs-toggle="tooltip" title="Batal Jadwal Sidang">Batalkan Jadwal</button>
                                        @endif
                                            
                                    </td>
                                @endif
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
                    <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/m-seprinaldi"> M.
                        Seprinaldi</a><span class="text-success fw-bold">)</span></small></p>
        </div>
    </section>
@endsection

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
                    title: 'Ini adalah halaman Jadwal Seminar',
                    html: `Ada <strong class="text-info"> ${waitingApprovalCount} Mahasiswa</strong> akan melaksanakan seminar.`,
                    icon: 'info',
                    showConfirmButton: true,
                    confirmButtonColor: '#28a745',
                });
            } else {
                Swal.fire({
                    title: 'Ini adalah halaman Jadwal Seminar',
                    html: `Belum ada mahasiswa yang akan melaksanakan seminar.`,
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
        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 5000);
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
                        <form id="myForm"  action="/sempro/undur/koordinator/${id}" method="POST">
                        @method('put')
                           @csrf
                            <label for="alasan">Alasan dibatalkan Jadwal :</label>
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

        var newAction = "/sempro/undur/koordinator" + encodeURIComponent(alasanValue);

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
                        <form id="myFormSidang"  action="/sidang/undur/koordinator/${id}" method="POST">
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

        var newAction = "/sidang/undur/koordinator" + encodeURIComponent(alasanValue);

        this.setAttribute('action', newAction);

        this.submit();
    });
</script>
@endpush()
