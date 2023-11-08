@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Kerja Praktek | SIA ELEKTRO
@endsection

@section('sub-title')
    Persetujuan Kerja Praktek dan Skripsi
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif

<div class="container card p-4">

<ol class="breadcrumb col-lg-12">

    @if (Str::length(Auth::guard('web')->user()) > 0)
    @if (Auth::guard('web')->user()->role_id == 2 || Auth::guard('web')->user()->role_id == 3 || Auth::guard('web')->user()->role_id == 4 )
    <li><a href="/persetujuan/admin/index" class="breadcrumb-item active fw-bold text-success px-1">Persetujuan</a></li>
    (<span id="waitingApprovalCount"></span>)
    <span class="px-2">|</span> 
    <li><a href="/kerja-praktek/admin/index" class="px-1">Data KP</a></li>
    (<span id="seminarKPCount"></span>)  
    <span class="px-2">|</span>
    <li><a href="/sidang/admin/index" class="px-1">Data Skripsi</a></li>
    (<span id="seminarKPCount"></span>)  
    <span class="px-2">|</span>
    <li><a href="/kp-skripsi/prodi/riwayat" class="px-1">Riwayat</a></li>
    (<span id=""></span>)
    
    @endif
    @endif
</ol>

<div class="container-fluid">
    
    <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatables">
        <thead class="table-dark">
            <tr>      
                <!-- <th class="text-center p-2" scope="col">No.</th> -->
                <th class="text-center" scope="col">NIM</th>
                <th class="text-center" scope="col">Nama</th>
                <!-- <th class="text-center" scope="col">Jenis Usulan</th> -->
                <th class="text-center" scope="col">Status </th>
                <th class="text-center" scope="col">Tanggal Usulan</th>    
                <th class="text-center" scope="col">Keterangan</th> 
                <th class="text-center" scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            
            <div></div>
            @foreach ($pendaftaran_kp as $kp)
            <tr>        
            <!-- <td class="text-center">{{$loop->iteration}}</td> -->
            <td class="text-center">{{$kp->mahasiswa_nim}}</td>                             
            <td class="text-center">{{$kp->mahasiswa->nama}}</td>
                       
            <!-- <td class="text-center">{{$kp->jenis_usulan}}</td>       -->
            
            @if ($kp->status_kp == 'USULAN KP' || $kp->status_kp == 'SURAT PERUSAHAAN' || $kp->status_kp == 'DAFTAR SEMINAR KP'|| $kp->status_kp == 'BUKTI PENYERAHAN LAPORAN')           
            <td class="text-center bg-secondary">{{$kp->status_kp}}</td>
            @endif
            @if ($kp->status_kp == 'USULAN KP DITERIMA' || $kp->status_kp == 'KP DISETUJUI'|| $kp->status_kp == 'SEMINAR KP SELESAI' || $kp->status_kp == 'KP SELESAI')           
            <td class="text-center bg-info">{{$kp->status_kp}}</td>
            @endif
            

            @if ($kp->status_kp == 'SEMINAR KP DIJADWALKAN')           
            <td class="text-center bg-success">{{$kp->status_kp}}</td>
            @endif
            
            @if ($kp->status_kp == 'USULAN KP')           
            <td class="text-center">{{Carbon::parse($kp->tgl_created_usulan)->translatedFormat('l, d F Y')}}</td>
            @endif
            @if ($kp->status_kp == 'DAFTAR SEMINAR KP')           
            <td class="text-center">{{Carbon::parse($kp->tgl_created_semkp)->translatedFormat('l, d F Y')}}</td>
            @endif


            <td class="text-center">{{$kp->keterangan}}</td> 

            @if ($kp->status_kp == 'USULAN KP' || $kp->status_kp == 'USULAN KP DITERIMA'  )
            <td class="text-center">
  @if (Str::length(Auth::guard('web')->user()) > 0)
  @if (Auth::guard('web')->user()->role_id == 2 || Auth::guard('web')->user()->role_id == 3 || Auth::guard('web')->user()->role_id == 4 )
    @if ($kp->keterangan == 'Menunggu persetujuan Admin Prodi' && $kp->status_kp == 'USULAN KP' )
    <div class="row">
    
    <div class="col-12 py-2 py-md-0 col-lg-4">
        <button onclick="tolakUsulanKPAdmin({{$kp->id}})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-12 py-2 py-md-0 col-lg-4">
      <a href="/kp-skripsi/persetujuan/usulankp/{{($kp->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
    </div>
    <div class="col-12 py-2 py-md-0 col-lg-4">
        <form action="/usulankp/admin/approve/{{$kp->id}}" class="setujui-usulankp-admin" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 "><i class="fas fa-check-circle"></i></button>
</form>
    </div>
  </div>
             @endif
    @endif
    @endif
            </td>
            @endif


            @if ($kp->status_kp == 'DAFTAR SEMINAR KP')
            <td class="text-center">
  @if (Str::length(Auth::guard('web')->user()) > 0)
  @if (Auth::guard('web')->user()->role_id == 2 || Auth::guard('web')->user()->role_id == 3 || Auth::guard('web')->user()->role_id == 4 )
    @if ($kp->keterangan == 'Menunggu persetujuan Admin Prodi' && $kp->status_kp == 'DAFTAR SEMINAR KP' )
    <div class="row">
    
    <div class="col-12 py-2 py-md-0 col-lg-4">
        <button onclick="tolakSemKPAdmin({{$kp->id}})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-12 py-2 py-md-0 col-lg-4">
      <a href="/kp-skripsi/persetujuan/semkp/{{($kp->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
    </div>
    <div class="col-12 py-2 py-md-0 col-lg-4">
        <form action="/semkp/admin/approve/{{$kp->id}}" class="setujui-semkp-admin" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 "><i class="fas fa-check-circle"></i></button>
</form>
    </div>
  </div>
             @endif
    @endif
    @endif
            </td>
            @endif

            @if ($kp->status_kp == 'DAFTAR SEMINAR KP DISETUJUI')
            <td class="text-center">
  @if (Str::length(Auth::guard('web')->user()) > 0)
  @if (Auth::guard('web')->user()->role_id == 2 || Auth::guard('web')->user()->role_id == 3 || Auth::guard('web')->user()->role_id == 4 )
    @if ($kp->keterangan == 'Menunggu Jadwal Seminar KP' && $kp->status_kp == 'DAFTAR SEMINAR KP DISETUJUI' )
    <div class="row">
    
    <div class="col-12 py-2 py-md-0 col-lg-4">
        <button onclick="tolakSemKPAdmin({{$kp->id}})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-12 py-2 py-md-0 col-lg-4">
      <a href="/kp-skripsi/persetujuan/semkp/{{($kp->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
    </div>
    <div class="col-12 py-2 py-md-0 col-lg-4">
        <form action="/semkp/admin/approve/{{$kp->id}}" class="setujui-semkp-admin" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 "><i class="fas fa-check-circle"></i></button>
</form>
    </div>
  </div>
             @endif
    @endif
    @endif
            </td>
            @endif

        
        </tr>

    @endforeach
 @foreach ($pendaftaran_skripsi as $skripsi)
<div></div>
        <tr>        
            <!--<td class="text-center">{{$loop->iteration}}</td>                             -->
            <td class="text-center">{{$skripsi->mahasiswa->nim}}</td>                             
            <td class="text-center">{{$skripsi->mahasiswa->nama}}</td>
            <!-- <td class="text-center">{{$skripsi->konsentrasi->nama_konsentrasi}}</td> -->
            <!-- <td class="text-center">{{$skripsi->jenis_usulan}}</td>          -->
            <!-- USUL JUDUL  -->
            @if ($skripsi->status_skripsi == 'USULAN JUDUL' || $skripsi->status_skripsi == 'DAFTAR SEMPRO' || $skripsi->status_skripsi == 'DAFTAR SIDANG' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI')           
            <td class="text-center bg-secondary">{{$skripsi->status_skripsi}}</td>
            @endif
            @if ($skripsi->status_skripsi == 'JUDUL DISETUJUI' || $skripsi->status_skripsi == 'SEMPRO SELESAI' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI' || $skripsi->status_skripsi == 'SIDANG SELESAI')           
            <td class="text-center bg-info">{{$skripsi->status_skripsi}}</td>
            @endif
           
            @if ($skripsi->status_skripsi == 'SEMPRO DIJADWALKAN' || $skripsi->status_skripsi == 'SIDANG DIJADWALKAN')           
            <td class="text-center bg-success">{{$skripsi->status_skripsi}}</td>
            @endif

            <!-- ___________batas____________ -->

            @if ($skripsi->status_skripsi == 'USULAN JUDUL')           
            <td class="text-center">{{Carbon::parse($skripsi->tgl_created_usuljudul)->translatedFormat('l, d F Y')}}</td>
            @endif
               
            <td class="text-center">{{$skripsi->keterangan}}</td> 


            <!-- USUL JUDUL  -->
            @if ($skripsi->status_skripsi == 'USULAN JUDUL'|| $skripsi->status_skripsi == 'JUDUL DISETUJUI'  )
            
            @if ($skripsi->keterangan == 'Menunggu persetujuan Admin Prodi' && $skripsi->status_skripsi == 'USULAN JUDUL' )
            <td class="text-center">
            <div class="row">
    <div class="col-12 py-2 py-md-0 col-lg-4">
        <button onclick="tolakUsulJudulAdmin({{$skripsi->id}})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-12 py-2 py-md-0 col-lg-4">
                <a href="/persetujuan/admin/detail/usulanjudul/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-12 py-2 py-md-0 col-lg-4">
        <form action="/usuljudul/admin/approve/{{$skripsi->id}}" class="setujui-usulanjudul-admin" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 "><i class="fas fa-check-circle"></i></button>
</form>
    </div>

</td>
    @endif
    @endif



           <!-- DAFTAR SEMPRO -->
           @if ($skripsi->status_skripsi == 'DAFTAR SEMPRO' || $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI') 
            <td class="text-center">
                 <div class="row">
    <div class="col-12 py-2 py-md-0 col-lg-4">
        <button onclick="tolakSemproAdmin({{$skripsi->id}})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-12 py-2 py-md-0 col-lg-4">
                <a href="/persetujuan/admin/detail/sempro/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-12 py-2 py-md-0 col-lg-4">
        <form action="/daftar-sempro/admin/approve/{{$skripsi->id}}" class="setujui-sempro-admin"  data-bs-toggle="tooltip" title="Setujui & Tandai Terjadwal" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 "><i class="fas fa-check-circle"></i></button>
</form>
    </div>
            </td>
            @endif
            
            <!-- DAFTAR SIDANG -->
            @if ($skripsi->status_skripsi == 'DAFTAR SIDANG' || $skripsi->status_skripsi == 'SIDANG DIJADWALKAN' || $skripsi->status_skripsi == 'SIDANG SELESAI') 
             <td class="text-center">
                 <div class="row">
    <div class="col-12 py-2 py-md-0 col-lg-4">
        <button onclick="tolakSidangAdmin({{$skripsi->id}})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-12 py-2 py-md-0 col-lg-4">
                <a href="/persetujuan/admin/detail/sidang/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-12 py-2 py-md-0 col-lg-4">
        <form action="/daftar-sidang/admin/approve/{{$skripsi->id}}" class="setujui-sidang-admin"  data-bs-toggle="tooltip" title="Setujui & Tandai Terjadwal" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 "><i class="fas fa-check-circle"></i></button>
</form>
    </div>
            </td>
             @endif

        </tr>

    @endforeach

  </tbody>


</table>
</div>
</div>


@endsection

@push('scripts')
@foreach ($pendaftaran_kp as $kp)
<script>
$('.setujui-usulankp-admin').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Usulan KP!',
        text: "Apakah Anda Yakin?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#28a745',
        cancelButtonColor: 'grey',
        confirmButtonText: 'Setuju'
    }).then((result) => {
        if (result.isConfirmed) {
            event.currentTarget.submit();
        }
    })
});

 function tolakUsulanKPAdmin(id) {
     Swal.fire({
            title: 'Tolak Usulan KP',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan KP',
                    html: `
                        <form id="reasonForm" action="/usulankp/admin/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                    showCancelButton: false,
                    showConfirmButton: false,
                });
            }
        });
    }

$('.setujui-semkp-admin').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Usulan Daftar Seminar KP!',
        text: "Apakah Anda Yakin?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#28a745',
        cancelButtonColor: 'grey',
        confirmButtonText: 'Setuju'
    }).then((result) => {
        if (result.isConfirmed) {
            event.currentTarget.submit();
        }
    })
});

 function tolakUsulanKPAdmin(id) {
     Swal.fire({
            title: 'Tolak Usulan Daftar Seminar KP',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan Daftar Seminar KP',
                    html: `
                        <form id="reasonForm" action="/semkp/admin/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
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
@foreach ($pendaftaran_skripsi as $skripsi)
<script>
//SKRIPSI


$('.setujui-usulanjudul-admin').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Usulan Judul Skripsi!',
        text: "Apakah Anda Yakin?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#28a745',
        cancelButtonColor: 'grey',
        confirmButtonText: 'Setuju'
    }).then((result) => {
        if (result.isConfirmed) {
            event.currentTarget.submit();
        }
    })
});

function tolakUsulJudulAdmin(id) {
     Swal.fire({
            title: 'Tolak Usulan Judul Skripsi',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan Judul Skripsi',
                    html: `
                        <form id="reasonForm" action="/usuljudul/admin/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                    showCancelButton: false,
                    showConfirmButton: false,
                });
            }
        });
    }



//SEMPRO
$('.setujui-sempro-admin').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Daftar Sempro!',
        text: "Apakah Anda Yakin?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#28a745',
        cancelButtonColor: 'grey',
        confirmButtonText: 'Setuju'
    }).then((result) => {
        if (result.isConfirmed) {
            event.currentTarget.submit();
        }
    })
});

function tolakSemproAdmin(id) {
     Swal.fire({
            title: 'Tolak Daftar Seminar Proposal',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Daftar Seminar Proposal',
                    html: `
                        <form id="reasonForm" action="/daftar-sempro/admin/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                    showCancelButton: false,
                    showConfirmButton: false,
                });
            }
        });
    }


//SIDANG
$('.setujui-sidang-admin').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Daftar Sidang Skripsi!',
        text: "Apakah Anda Yakin?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#28a745',
        cancelButtonColor: 'grey',
        confirmButtonText: 'Setuju'
    }).then((result) => {
        if (result.isConfirmed) {
            event.currentTarget.submit();
        }
    })
});

function tolakSidangAdmin(id) {
     Swal.fire({
            title: 'Tolak Daftar Sidang Skripsi',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Daftar Sidang Skripsi',
                    html: `
                        <form id="reasonForm" action="/daftar-sidang/admin/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
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