@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Kerja Praktek | SIA ELEKTRO
@endsection

@section('sub-title')
    Kerja Praktek
@endsection

@section('content')


@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif

<!-- __ BATAS WAKTU TOMBOL MUNCUL__ -->
 @php
  $tanggalDisetujuiUsulanKP = $pendaftaran_kp->tgl_disetujui_usulankp;
@endphp

 @php
  $tanggalMulaiKP = $pendaftaran_kp->tanggal_mulai;
@endphp

@php
 $tanggalSelesaiSemKP = $pendaftaran_kp->tgl_selesai_semkp;
@endphp


<div class="container-fluid">

@if (Str::length(Auth::guard('mahasiswa')->user()) > 0)

<div class="card card-timeline px-2 border-none"> 
<h5 class="text-center">
<div class="row text-center justify-content-center mb-5">
        <div class="col-xl-6 col-lg-8">
            <!-- <h2 class="font-weight-bold mt-3">Timeline Progress Kerja Praktek</h2> -->
            <!-- <p class="text-muted">We’re very proud of the path we’ve taken. Explore the history that made us the company we are today.</p> -->
        </div>
    </div>
      
    <ul class="bs4-order-tracking">
    @if ($pendaftaran_kp->status_kp == 'USULAN KP DITOLAK' )
         <li class="step aktip"> 
            <div>
                <i class="fas"></i>
        </div> 
        <p class="mt-3"> USULAN KP</p> 
        </li> 
        <li class="step "> 
            <div><i class="fas "></i>
        </div> <p class="mt-3"> SURAT PERUSAHAAN </p>
     </li>
        <li class="step "> 
            <div><i class="fas "></i>
        </div> <p class="mt-3"> SEMINAR KP </p>
     </li>
         <li class="step"> 
            <div><i class="fas fa-truc"></i>
        </div><p class="mt-3">PENYERAHAN LAPORAN</p>
     </li> 

    @endif
    @if ($pendaftaran_kp->status_kp == 'USULKAN KP ULANG' )
         <li class="step aktip"> 
            <div>
                <i class="fas"></i>
        </div> 
        <p class="mt-3"> USULAN KP</p> 
        </li> 
        <li class="step "> 
            <div><i class="fas "></i>
        </div> <p class="mt-3"> SURAT PERUSAHAAN </p>
     </li>
        <li class="step "> 
            <div><i class="fas "></i>
        </div> <p class="mt-3"> SEMINAR KP </p>
     </li>
         <li class="step"> 
            <div><i class="fas fa-truc"></i>
        </div><p class="mt-3"> PENYERAHAN LAPORAN</p>
     </li> 

    @endif
    @if ($pendaftaran_kp->status_kp == 'USULAN KP' )
         <li class="step active"> 
            <div>
                <i class="fas"></i>
        </div> 
        <p class="mt-3"> USULAN KP</p> 
        </li> 
        <li class="step "> 
            <div><i class="fas "></i>
        </div> <p class="mt-3"> SURAT PERUSAHAAN </p>
     </li>
        <li class="step "> 
            <div><i class="fas "></i>
        </div> <p class="mt-3"> SEMINAR KP </p>
     </li>
         <li class="step"> 
            <div><i class="fas fa-truc"></i>
        </div><p class="mt-3"> PENYERAHAN LAPORAN</p>
     </li> 

    @endif
    @if ($pendaftaran_kp->status_kp == 'USULAN KP DITERIMA' )
         <li class="step active"> 
            <div>
                <i class="fas fa-check"></i>
        </div> 
        <p class="mt-3"> USULAN KP</p> 
        </li> 
        <li class="step "> 
            <div><i class="fas "></i>
        </div> <p class="mt-3"> SURAT PERUSAHAAN </p>

     </li>
        <li class="step "> 
            <div><i class="fas "></i>
        </div> <p class="mt-3"> SEMINAR KP </p>
     </li>
         <li class="step"> 
            <div><i class="fas fa-truc"></i>
        </div><p class="mt-3"> PENYERAHAN LAPORAN</p>
     </li> 
        <!-- <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> KP SELESAI </p>
     </li>  -->
    @endif
    @if ($pendaftaran_kp->status_kp == 'SURAT PERUSAHAAN' )
         <li class="step active"> 
            <div>
                <i class="fas fa-check"></i>
        </div> 
        <p class="mt-3"> USULAN KP</p> 
        </li> 
        <li class="step active"> 
            <div><i class="fas "></i>
        </div> <p class="mt-3"> SURAT PERUSAHAAN </p>
     </li>
        <li class="step "> 
            <div><i class="fas "></i>
        </div> <p class="mt-3"> SEMINAR KP </p>
     </li>
         <li class="step"> 
            <div><i class="fas fa-truc"></i>
        </div><p class="mt-3"> PENYERAHAN LAPORAN</p>
     </li> 
        <!-- <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> KP SELESAI </p>
     </li>  -->
    @endif
    @if ($pendaftaran_kp->status_kp == 'SURAT PERUSAHAAN DITOLAK' )
         <li class="step active"> 
            <div>
                <i class="fas fa-check"></i>
        </div> 
        <p class="mt-3"> USULAN KP</p> 
        </li> 
        <li class="step aktip"> 
            <div><i class="fas "></i>
        </div> <p class="mt-3"> SURAT PERUSAHAAN </p>
     </li>
        <li class="step "> 
            <div><i class="fas "></i>
        </div> <p class="mt-3"> SEMINAR KP </p>
     </li>
         <li class="step"> 
            <div><i class="fas fa-truc"></i>
        </div><p class="mt-3"> PENYERAHAN LAPORAN</p>
     </li> 
        <!-- <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> KP SELESAI </p>
     </li>  -->
    @endif
    @if ($pendaftaran_kp->status_kp == 'KP DISETUJUI' )
         <li class="step active"> 
            <div>
                <i class="fas fa-check"></i>
        </div> 
        <p class="mt-3"> USULAN KP</p> 
        </li> 
        <li class="step active"> 
            <div><i class="fas fa-check"></i>
        </div> <p class="mt-3"> SURAT PERUSAHAAN </p> 
     </li>
        <li class="step "> 
            <div><i class="fas "></i>
        </div> <p class="mt-3"> SEMINAR KP </p>
     </li>
         <li class="step"> 
            <div><i class="fas fa-truc"></i>
        </div><p class="mt-3"> PENYERAHAN LAPORAN</p>
     </li> 
        <!-- <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> KP SELESAI </p>
     </li>  -->
    @endif
    @if ($pendaftaran_kp->status_kp == 'DAFTAR SEMINAR KP DITOLAK' )
         <li class="step active"> 
            <div>
                <i class="fas fa-check"></i>
        </div> 
        <p class="mt-3"> USULAN KP</p> 
        </li> 
        <li class="step active"> 
            <div><i class="fas fa-check"></i>
        </div> <p class="mt-3"> SURAT PERUSAHAAN </p>
  
     </li>
        <li class="step aktip"> 
            <div><i class="fas "></i>
        </div> <p class="mt-3"> SEMINAR KP </p>

     </li>
         <li class="step"> 
            <div><i class="fas fa-truc"></i>
        </div><p class="mt-3"> PENYERAHAN LAPORAN</p>
     </li> 
        <!-- <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> KP SELESAI </p>
     </li>  -->
    @endif
   

    @if ($pendaftaran_kp->status_kp == 'DAFTAR SEMINAR KP' || $pendaftaran_kp->status_kp == 'SEMINAR KP DIJADWALKAN' )
         <li class="step active"> 
            <div>
                <i class="fas fa-check"></i>
        </div> 
        <p class="mt-3"> USULAN KP</p> 
        </li> 
        <li class="step active"> 
            <div><i class="fas fa-check"></i>
        </div> <p class="mt-3"> SURAT PERUSAHAAN </p>
     </li>
        <li class="step active"> 
            <div><i class="fas "></i>
        </div> <p class="mt-3"> SEMINAR KP </p>
     </li>
         <li class="step"> 
            <div><i class="fas fa-truc"></i>
        </div><p class="mt-3"> PENYERAHAN LAPORAN</p>
     </li> 
        <!-- <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> KP SELESAI </p>
     </li>  -->
    @endif
    @if ($pendaftaran_kp->status_kp == 'SEMINAR KP SELESAI' )
         <li class="step active"> 
            <div>
                <i class="fas fa-check"></i>
        </div> 
        <p class="mt-3"> USULAN KP</p> 
        </li> 
        <li class="step active"> 
            <div><i class="fas fa-check"></i>
        </div> <p class="mt-3"> SURAT PERUSAHAAN </p> 
     </li>
        <li class="step active"> 
            <div><i class="fas fa-check"></i>
        </div> <p class="mt-3"> SEMINAR KP </p> 
     </li>
         <li class="step"> 
            <div><i class="fas fa-truc"></i>
        </div><p class="mt-3"> PENYERAHAN LAPORAN</p>
     </li> 
        <!-- <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> KP SELESAI </p>
     </li>  -->
    @endif
    @if ($pendaftaran_kp->status_kp == 'BUKTI PENYERAHAN LAPORAN DITOLAK' )
         <li class="step active"> 
            <div>
                <i class="fas fa-check"></i>
        </div> 
        <p class="mt-3"> USULAN KP</p> 
        </li> 
        <li class="step active"> 
            <div><i class="fas fa-check"></i>
        </div> <p class="mt-3"> SURAT PERUSAHAAN </p> 
     </li>
        <li class="step active"> 
            <div><i class="fas fa-check"></i>
        </div> <p class="mt-3"> SEMINAR KP </p> 
     </li>
         <li class="step aktip"> 
            <div><i class="fas fa-truc"></i>
        </div><p class="mt-3"> PENYERAHAN LAPORAN</p>
     </li> 
        <!-- <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> KP SELESAI </p>
     </li>  -->
    @endif
       
    @if ($pendaftaran_kp->status_kp == 'BUKTI PENYERAHAN LAPORAN' )
         <li class="step active"> 
            <div>
                <i class="fas fa-check"></i>
        </div> 
        <p class="mt-3"> USULAN KP</p> 
        </li> 
        <li class="step active"> 
            <div><i class="fas fa-check"></i>
        </div> <p class="mt-3"> SURAT PERUSAHAAN </p> 
     </li>
        <li class="step active"> 
            <div><i class="fas fa-check"></i>
        </div> <p class="mt-3"> SEMINAR KP </p> 
     </li>
         <li class="step active"> 
            <div><i class="fas fa-truc"></i>
        </div><p class="mt-3"> PENYERAHAN LAPORAN</p>
     </li> 
        <!-- <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> KP SELESAI </p>
     </li>  -->
    @endif
    @if ($pendaftaran_kp->status_kp == 'KP SELESAI' )
         <li class="step active"> 
            <div><i class="fas fa-check"></i>
        </div> 
        <p class="mt-3"> USULAN KP</p> 
        </li> 
        <li class="step active"> 
            <div><i class="fas fa-check"></i>
        </div> <p class="mt-3"> SURAT PERUSAHAAN </p>
     </li>
        <li class="step active"> 
            <div><i class="fas fa-check"></i>
        </div> <p class="mt-3"> SEMINAR KP </p>
           </li>
         <li class="step active"> 
            <div><i class="fas fa-check"></i>
        </div><p class="mt-3"> PENYERAHAN LAPORAN</p>
     </li> 

    @endif
   </ul>

    <!-- -------------BATAS---------------->
    @if ($pendaftaran_kp->status_kp == 'USULAN KP DITERIMA')
    <div class="row biru mb-4">
    <div class="col">
         <span class="mt-3 "> Tanggal Diterima <br></span>
        <span class="mt-3  text-bold">{{Carbon::parse($pendaftaran_kp->tgl_disetujui_usulan)->translatedFormat('l, d F Y')}}</span>
    </div>
    <div class="col">         <span class="mt-3 text-danger"> Batas Unggah <br></span>
         <strong class="mt-3 text-danger"><strong class="text-bold" id="timer-batas-balasan"></strong><br></strong>
    </div>
    <div class="col">
    </div>
    <div class="col">
       
    </div>
  </div>
@endif
    @if ($pendaftaran_kp->status_kp == 'SURAT PERUSAHAAN DITOLAK' || $pendaftaran_kp->status_kp == 'SURAT PERUSAHAAN')
    <div class="row biru mb-4">
    <div class="col">
         <span class="mt-3 "> Tanggal Diterima <br></span>
        <span class="mt-3  text-bold">{{Carbon::parse($pendaftaran_kp->tgl_disetujui_usulan)->translatedFormat('l, d F Y')}}</span>
    </div>
    <div class="col">
    </div>
    <div class="col">
    </div>
    <div class="col">
       
    </div>
  </div>
@endif
    @if ($pendaftaran_kp->status_kp == 'DAFTAR SEMINAR KP DITOLAK' || $pendaftaran_kp->status_kp == 'KP DISETUJUI' )
    <div class="row biru mb-4">
    <div class="col">
         <span class="mt-3 "> Tanggal Diterima <br></span>
        <span class="mt-3  text-bold">{{Carbon::parse($pendaftaran_kp->tgl_disetujui_usulan)->translatedFormat('l, d F Y')}}</span>
    </div>
    <div class="col">
         <span class="mt-3  "> Tanggal Disetujui <br></span>
        <span class="mt-3  text-bold">{{Carbon::parse($pendaftaran_kp->tgl_disetujui_balasan)->translatedFormat('l, d F Y')}}</span>
    </div>
    <div class="col">          <span class="mt-3 text-danger"> Batas Daftar Seminar <br></span>
        <strong class="mt-3 text-danger"><strong class="text-bold" id="timer-batas-semkp"></strong><br></strong>
    </div>
    <div class="col">
       
    </div>
  </div>
@endif
    @if ($pendaftaran_kp->status_kp == 'DAFTAR SEMINAR KP' || $pendaftaran_kp->status_kp == 'SEMINAR KP DIJADWALKAN')
    <div class="row biru mb-4">
    <div class="col">
         <span class="mt-3 "> Tanggal Diterima <br></span>
        <span class="mt-3  text-bold">{{Carbon::parse($pendaftaran_kp->tgl_disetujui_usulan)->translatedFormat('l, d F Y')}}</span>
    </div>
    <div class="col">
         <span class="mt-3  "> Tanggal Disetujui <br></span>
        <span class="mt-3  text-bold">{{Carbon::parse($pendaftaran_kp->tgl_disetujui_balasan)->translatedFormat('l, d F Y')}}</span>
    </div>
    <div class="col">
    </div>
    <div class="col">
        
    </div>
  </div>
@endif
    @if ($pendaftaran_kp->status_kp == 'BUKTI PENYERAHAN LAPORAN DITOLAK' || $pendaftaran_kp->status_kp == 'BUKTI PENYERAHAN LAPORAN' || $pendaftaran_kp->status_kp == 'SEMINAR KP SELESAI' )
    <div class="row biru mb-4">
    <div class="col">
         <span class="mt-3 "> Tanggal Diterima <br></span>
        <span class="mt-3  text-bold">{{Carbon::parse($pendaftaran_kp->tgl_disetujui_usulan)->translatedFormat('l, d F Y')}}</span>
    </div>
    <div class="col">
         <span class="mt-3  "> Tanggal Disetujui <br></span>
        <span class="mt-3  text-bold">{{Carbon::parse($pendaftaran_kp->tgl_disetujui_balasan)->translatedFormat('l, d F Y')}}</span>
    </div>
    <div class="col">
         <span class="mt-3  "> Tanggal Selesai <br></span>
        <span class="mt-3  text-bold">{{Carbon::parse($pendaftaran_kp->tgl_selesai_semkp)->translatedFormat('l, d F Y')}}</span>
    </div>
    <div class="col">
        <span class="mt-3 text-danger"> Batas Unggah <br></span>
        <strong class="mt-3 text-danger"><strong class="text-bold" id="timer-batas-kpti10"></strong><br></strong>
        
    </div>
  </div>
@endif
        @if ($pendaftaran_kp->status_kp == 'KP SELESAI' )
    <div class="row biru mb-4">
    <div class="col">
         <span class="mt-3 "> Tanggal disetujui <br></span>
        <span class="mt-3  text-bold">{{Carbon::parse($pendaftaran_kp->tgl_disetujui_usulan)->translatedFormat('l, d F Y')}}</span>
    </div>
    <div class="col">
         <span class="mt-3  "> Tanggal disetujui <br></span>
        <span class="mt-3  text-bold">{{Carbon::parse($pendaftaran_kp->tgl_disetujui_balasan)->translatedFormat('l, d F Y')}}</span>
    </div>
    <div class="col">
         <span class="mt-3  "> Tanggal disetujui <br></span>
        <span class="mt-3  text-bold">{{Carbon::parse($pendaftaran_kp->tgl_selesai_semkp)->translatedFormat('l, d F Y')}}</span>
    </div>
    <div class="col">
         <span class="mt-3  "> Tanggal disetujui <br></span>
        <span class="mt-3  text-bold">{{Carbon::parse($pendaftaran_kp->tgl_disetujui_kpti_10)->translatedFormat('l, d F Y')}}</span>
    </div>
  </div>
@endif
  
       
    
  
</div>

<div class="container-fluid">

@if ($pendaftaran_kp->status_kp == 'USULAN KP DITOLAK' )
<div class="alert alert-danger" role="alert"> 
    <i class="fas fa-exclamation-triangle pr-2"></i><span class="fw-bold">{{ $pendaftaran_kp->alasan }}</span>, Silahkan Usulkan KP ulang!
 
</div>
@endif
@if ($pendaftaran_kp->status_kp == 'USULKAN KP ULANG' )
<div class="alert alert-danger" role="alert"> 
    <i class="fas fa-exclamation-triangle pr-2"></i><span class="fw-bold">{{ $pendaftaran_kp->alasan }}</span>, Silahkan Usulkan KP ulang!
 
</div>
@endif

@if ($pendaftaran_kp->status_kp == 'SURAT PERUSAHAAN DITOLAK')
<div class="alert alert-danger" role="alert"> 
    <i class="fas fa-exclamation-triangle pr-2"></i><span class="fw-bold">{{ $pendaftaran_kp->alasan }}</span>, Silahkan Unggah Ulang Surat Balasan Perusahaan!
 
</div>
@endif
@if ($pendaftaran_kp->status_kp == 'DAFTAR SEMINAR KP DITOLAK' )
<div class="alert alert-danger" role="alert"> 
    <i class="fas fa-exclamation-triangle pr-2"></i><span class="fw-bold">{{ $pendaftaran_kp->alasan }}</span>, Silahkan Daftar Seminar KP Ulang!
 
</div>
@endif

@if ($pendaftaran_kp->status_kp == 'BUKTI PENYERAHAN LAPORAN DITOLAK')
<div class="alert alert-danger" role="alert"> 
    <i class="fas fa-exclamation-triangle pr-2"></i><span class="fw-bold">{{ $pendaftaran_kp->alasan }}</span>, Silahkan Unggah Ulang KPTI-10/Bukti Penyerahan Laporan KP!
 
</div>
@endif

@if ($pendaftaran_kp->status_kp == 'KP DISETUJUI' && $pendaftaran_kp->keterangan == 'Kerja Praktek disetujui' )
@if ($pendaftaran_kp->status_kp == 'KP DISETUJUI' && (now()->subMonth() >= \Carbon\Carbon::parse($tanggalMulaiKP)) )

<div class="alert alert-info" role="alert">
    <img height="25" width="25" src="/assets/img/wink.png"  alt="..." class="bg-light rounded-pill"> <span class="px-2">Silahkan Daftar Seminar KP. </span> 

</div>
@endif
@endif


</div>

@endif


<div class="card p-4">

          <table class="table table-responsive-lg table-bordered table-striped" width="100%">
  <thead class="table-dark">
    <tr> 
        <th class="text-center" scope="col">NIM</th>
        <th class="text-center" scope="col">Nama</th>
        <!-- <th class="text-center" scope="col">Konsentrasi</th> -->
        <th class="text-center" scope="col">Jenis Usulan</th>
        <th class="text-center" scope="col">Status KP</th>
        <th class="text-center" scope="col">Keterangan</th>     
        <th class="text-center px-5" scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>


<div></div>
@foreach($kp as $kp)
        <tr>                              
            <td class="text-center">{{$kp->mahasiswa->nim}}</td>                             
            <td class="text-center">{{$kp->mahasiswa->nama}}</td>
            <!-- <td class="text-center">{{$kp->mahasiswa->konsentrasi->nama_konsentrasi}}</td>                              -->
            <td class="text-center">{{$kp->jenis_usulan}}</td>             
            @if ($kp->status_kp == 'USULAN KP' || $kp->status_kp == 'SURAT PERUSAHAAN'|| $kp->status_kp == 'DAFTAR SEMINAR KP' || $kp->status_kp == 'BUKTI PENYERAHAN LAPORAN')           
            <td class="text-center bg-secondary">{{$kp->status_kp}}</td>
            @endif
             @if ($kp->status_kp == 'USULAN KP DITOLAK' || $kp->status_kp == 'USULKAN KP ULANG'  || $kp->status_kp == 'SURAT PERUSAHAAN DITOLAK' || $kp->status_kp == 'DAFTAR SEMINAR KP DITOLAK' || $kp->status_kp == 'BUKTI PENYERAHAN LAPORAN DITOLAK' )           
            <td class="text-center bg-danger">{{$kp->status_kp}}</td>
            @endif
            @if ($kp->status_kp == 'USULAN KP DITERIMA' ||$kp->status_kp == 'KP DISETUJUI' ||$kp->status_kp == 'SEMINAR KP SELESAI' || $kp->status_kp == 'KP SELESAI' )           
            <td class="text-center bg-info">{{$kp->status_kp}}</td>
            @endif
            @if ($kp->status_kp == 'SEMINAR KP DIJADWALKAN')           
            <td class="text-center bg-success">{{$kp->status_kp}}</td>
            @endif


            @if ($kp->status_kp == 'USULAN KP DITOLAK' || $kp->status_kp == 'USULKAN KP ULANG' || $kp->keterangan == 'Unggah Ulang Surat Balasan Perusahaan' || $kp->keterangan == 'Unggah Ulang KPTI-10/Bukti Penyerahan Laporan KP' || $kp->status_kp == 'DAFTAR SEMINAR KP DITOLAK' )           
            <td class="text-center text-danger">{{$kp->keterangan}}</td>
            @else
            <td class="text-center">{{$kp->keterangan}}</td>
            @endif
           

             

            @if ($kp->status_kp == 'USULAN KP' || $kp->status_kp == 'USULAN KP DITERIMA' || $kp->status_kp == 'USULAN KP DITOLAK' || $kp->status_kp == 'USULKAN KP ULANG'  )
            <td class="text-center">

      <a href="/usulan/detail/{{($kp->id)}}" class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>

                @if ($kp->status_kp == 'USULAN KP DITOLAK' || $kp->status_kp == 'USULKAN KP ULANG'  )
                <a href="/usulankp/create" class="badge " data-bs-toggle="tooltip" title="Daftar KP Ulang"><img height="25" width="25" src="/assets/img/add.png"  alt="..." class="zoom-image"></a>
                <!-- <a href="/usulankp-ulang/create/{{$kp->id}}" class="badge " data-bs-toggle="tooltip" title="Daftar KP Ulang"><img height="25" width="25" src="/assets/img/add.png"  alt="..." class="zoom-image"></a> -->
                @endif
                @if ($kp->status_kp == 'USULAN KP DITERIMA' )
                <a href="/balasankp/create/{{$kp->id}}" class="badge  " data-bs-toggle="tooltip" title="Unggah Surat Balasan Perusahaan"><img height="25" width="25" src="/assets/img/add.png"  alt="..." class="zoom-image"></a>
                @endif

          
            </td>
            @endif
            
            @if ($kp->status_kp == 'SURAT PERUSAHAAN'  || $kp->status_kp == 'SURAT PERUSAHAAN DITOLAK' || $kp->status_kp == 'KP DISETUJUI' )
            <td class="text-center">
            <a href="/balasan-kp/detail/{{($kp->id)}}" class="badge btn btn-info " data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a> 

                @if ($kp->status_kp == 'KP DISETUJUI')
                <a href="/daftar-semkp/create/{{$kp->id}}" class="badge " data-bs-toggle="tooltip" title="Daftar Seminar KP"><img height="25" width="25" src="/assets/img/add.png"  alt="..." class="zoom-image"></a>
                @endif
                @if ($kp->status_kp == 'SURAT PERUSAHAAN DITOLAK')
                <a href="/balasankp/create/{{$kp->id}}" class="badge  " data-bs-toggle="tooltip" title="Unggah Surat Balasan Perusahaan"><img height="25" width="25" src="/assets/img/add.png"  alt="..." class="zoom-image"></a>
                @endif
                <!-- @if ($kp->status_kp == 'KP DISETUJUI' && (now()->subMonth() >= \Carbon\Carbon::parse($tanggalMulaiKP)) )
                <a href="/daftar-semkp/create/{{$kp->id}}" class="badge " data-bs-toggle="tooltip" title="Daftar Seminar KP"><img height="25" width="25" src="/assets/img/add.png"  alt="..." class="zoom-image"></a>
                @endif -->
   
                
            </td>
            @endif

            @if ($kp->status_kp == 'DAFTAR SEMINAR KP' || $kp->status_kp == 'SEMINAR KP DIJADWALKAN' ||$kp->status_kp == 'SEMINAR KP SELESAI' || $kp->status_kp == 'DAFTAR SEMINAR KP DITOLAK')
            <td class="text-center">

             <a href="/daftar-semkp/detail/ {{($kp->id)}}" class="badge btn btn-info " data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>

                @if ($kp->status_kp == 'SEMINAR KP DIJADWALKAN')
                <a href="/jadwal" class="badge" data-bs-toggle="tooltip" title="Lihat Jadwal"><img height="25" width="25" src="/assets/img/calendar.png"  alt="..." class="zoom-image"></a>
                @endif
                @if ($kp->status_kp == 'DAFTAR SEMINAR KP DITOLAK')
                <a href="/daftar-semkp/create/{{$kp->id}}" class="badge " data-bs-toggle="tooltip" title="Daftar Seminar KP"><img height="25" width="25" src="/assets/img/add.png"  alt="..." class="zoom-image"></a>
                @endif

                @if ($kp->status_kp == 'SEMINAR KP SELESAI' )
                <a href="/seminar" class="badge btn btn-dark " data-bs-toggle="tooltip" title="Riwayat Seminar KP"><i class="fas fa-history"></i></a>
                <a href="/kpti10-kp/create/{{$kp->id}}" class="badge" data-bs-toggle="tooltip" title="Upload Bukti Penyerahan Laporan"><img height="25" width="25" src="/assets/img/add.png"  alt="..." class="zoom-image"></a>
                @endif
            </td>
            @endif

            @if ($kp->status_kp == 'BUKTI PENYERAHAN LAPORAN' || $kp->status_kp == 'KP SELESAI' || $kp->status_kp == 'BUKTI PENYERAHAN LAPORAN DITOLAK' )
            <td class="text-center">
            <a href="/kpti10-kp/detail/ {{($kp->id)}}" class="badge btn btn-info " data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            <a href="/seminar" class="badge btn btn-dark " data-bs-toggle="tooltip" title="Lihat Riwayat Seminar KP"><i class="fas fa-history"></i></a>
            @if ($kp->status_kp == 'BUKTI PENYERAHAN LAPORAN DITOLAK' )

                <a href="/kpti10-kp/create/{{$kp->id}}" class="badge" data-bs-toggle="tooltip" title="Upload Bukti Penyerahan Laporan"><img height="25" width="25" src="/assets/img/add.png"  alt="..." class="zoom-image"></a>
                @endif
            </td>
            @endif

        </tr>
@endforeach

  </tbody>


</table>
</div>
    
<!-- <img height="190" width="280" src="/assets/img/il5.png" class="rounded mx-auto d-block" alt="...">  -->
</div>
<br>
@endsection

<!-- Script untuk mengurangi jumlah hari setiap hari -->
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
@endpush()
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"></script>
@endpush()

@push('scripts')
<script>
// Fungsi untuk menghitung waktu tersisa
     moment.locale('id');


      function hitungWaktuBatasBalasan(targetDate) {

        var tanggalDisetujuiUsulanKP = moment(targetDate);

        var tanggalTerakhir = tanggalDisetujuiUsulanKP.add(1, 'months');
        
        var formatTanggalTerakhir = tanggalTerakhir.format('dddd, D MMMM YYYY');

        document.getElementById("timer-batas-balasan").textContent = formatTanggalTerakhir;
    }
    
    hitungWaktuBatasBalasan("{{ $tanggalDisetujuiUsulanKP }}");

    

    // Fungsi untuk menghitung waktu tersisa
    // function hitungWaktuTersisa(targetDate) {

    //     var tanggalMulaiKP = moment(targetDate);

    //     // Menambahkan satu bulan ke tanggal disetujui KP
    //     var tanggalSeminarKP = tanggalMulaiKP.add(1, 'months');

    //     var formatTanggal = tanggalSeminarKP.format('dddd, D MMMM YYYY');

    //     document.getElementById("timer").textContent = formatTanggal;
    // }
    // hitungWaktuTersisa("{{ $tanggalMulaiKP }}");

    // function hitungWaktuBatasSemKP(targetDate) {

    //     var tanggalMulaiKP = moment(targetDate);
    //     var tanggalTerakhirDaftarSeminarKP = tanggalMulaiKP.add(3, 'months');

    //     var formatTanggalTerakhirDaftar = tanggalTerakhirDaftarSeminarKP.format('dddd, D MMMM YYYY');

    //     document.getElementById("timer-batas-semkp").textContent = formatTanggalTerakhirDaftar;
    // }
    
    // hitungWaktuBatasSemKP("{{ $tanggalMulaiKP }}");




    //MENAMPILKAN DALAM BENTUK JAM MENIT DETIK
    // // Fungsi untuk menghitung waktu tersisa
    // function hitungWaktuTersisa(targetDate) {
    //     // Mengambil tanggal sekarang
    //     var now = moment();

    //     // Mengubah tanggal disetujui KP menjadi objek moment
    //     var tanggalMulaiKP = moment(targetDate);

    //     // Menambahkan satu bulan ke tanggal disetujui KP
    //     tanggalMulaiKP.add(1, 'months');

    //     // Menghitung selisih waktu dalam milidetik
    //     var selisihWaktu = tanggalMulaiKP.diff(now);

    //     // Menghitung hari, jam, menit, dan detik yang tersisa
    //     var durasi = moment.duration(selisihWaktu);
    //     var hari = durasi.days();
    //     var jam = durasi.hours();
    //     var menit = durasi.minutes();
    //     var detik = durasi.seconds();

    //     // Menampilkan waktu tersisa di dalam elemen dengan id "timer"
    //     document.getElementById("timer").textContent = hari + " hari, " + jam + " jam, " + menit + " menit, " + detik + " detik";
    // }

    // // Memanggil fungsi hitungWaktuTersisa dengan tanggal disetujui KP
    // hitungWaktuTersisa("{{ $tanggalMulaiKP }}");

    // // Memperbarui waktu tersisa setiap detik
    // setInterval(function() {
    //     hitungWaktuTersisa("{{ $tanggalMulaiKP }}");
    // }, 1000);
</script>
@endpush()

@push('scripts')
<script>

    function hitungWaktuBatasSemKP(targetDate) {

        var tanggalMulaiKP = moment(targetDate);
        var tanggalTerakhirDaftarSeminarKP = tanggalMulaiKP.add(3, 'months');

        var formatTanggalTerakhirDaftar = tanggalTerakhirDaftarSeminarKP.format('dddd, D MMMM YYYY');

        document.getElementById("timer-batas-semkp").textContent = formatTanggalTerakhirDaftar;
    }
    
    hitungWaktuBatasSemKP("{{ $tanggalMulaiKP }}");


</script>

@endpush()

@push('scripts')
<script>

    function hitungWaktuBatasKPTI10(targetDate) {

        var tanggalSelesaiSemKP = moment(targetDate);
        var tanggalTerakhirKPTI10 = tanggalSelesaiSemKP.add(1, 'months');

        var formatTanggalTerakhirDaftar = tanggalTerakhirKPTI10.format('dddd, D MMMM YYYY');

        document.getElementById("timer-batas-kpti10").textContent = formatTanggalTerakhirDaftar;
    }
    
    hitungWaktuBatasKPTI10("{{ $tanggalSelesaiSemKP }}");


</script>

@endpush()
