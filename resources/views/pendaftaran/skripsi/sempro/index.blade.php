@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Kerja Praktek | SIA ELEKTRO
@endsection



@section('content')

<a href="/daftar" class="badge bg-success p-2 mb-3 fa fa-arrow-left"> Kembali <a>

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif


<div class="container-fluid">

@if (Str::length(Auth::guard('mahasiswa')->user()) > 0)

<div class="card card-timeline px-2 border-none"> 
@foreach ($pendaftaran_skripsi as $skripsi)
<h5 class="text-center">
<div class="row text-center justify-content-center mb-5">
        <div class="col-xl-6 col-lg-8">
            <h2 class="font-weight-bold mt-3">Timeline Progress Skripsi</h2>
            <!-- <p class="text-muted"></p> -->
        </div>
    </div>
      
    <ul class="bs4-order-skripsi">
    @if ($skripsi->status_skripsi == 'DAFTAR SEMPRO' || $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI PEMBIMBING' || $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI PEMBIMBING 1'|| $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI PEMBIMBING 2' || $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI KOORDINATOR SKRIPSI')
    <li class="step active"> 
            <div>
                <i class="fas fa-check"></i>
        </div> 
        <p class="mt-3"> USULAN JUDUL</p> 
        <span class="mt-3 "> Tanggal disetujui <br></span>
        <p class=" text-bold">{{ Carbon::parse($skripsi->tgl_disetujui_usuljudul)->translatedFormat('l, d F Y') }}</p> 
        </li> 
    <li class="step active"> 
            <div><i class="fas "></i>
        </div> <p class="mt-3"> DAFTAR SEMPRO </p>
     </li> 
     <li class="step"> 
            <div><i class="fas fa-truc"></i>
        </div><p class="mt-3"> SEMPRO DI JADWALKAN </p>
     </li> 
        <li class="step "> 
            <div><i class="fas "> </i>
        </div><p class="mt-3"> SELESAI SEMPRO  </p>
     </li> 
        <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> DAFTAR SIDANG </p>
     </li> 
        <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> SIDANG DI JADWALKAN </p>
     </li> 
        <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> SIDANG SELESAI </p>
     </li> 
        <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> SKRIPSI SELESAI </p>
     </li>
    @endif
    @if ($skripsi->status_skripsi == 'SEMPRO DISETUJUI' )
    <li class="step active"> 
            <div>
                <i class="fas fa-check"></i>
        </div> 
        <p class="mt-3"> USULAN JUDUL</p> 
        <span class="mt-3 "> Tanggal disetujui <br></span>
        <p class=" text-bold">{{ Carbon::parse($skripsi->tgl_disetujui_usuljudul)->translatedFormat('l, d F Y') }}</p> 
        </li> 
         <li class="step active"> 
            <div>
                <i class="fas fa-check"></i>
        </div> 
        <p class="mt-3"> DAFTAR SEMPRO </p> 
        <span class="mt-3 "> Tanggal disetujui <br></span>
        <p class=" text-bold">{{ Carbon::parse($skripsi->tgl_disetujui_sempro)->translatedFormat('l, d F Y') }}</p> 
        </li> 
        <li class="step"> 
            <div><i class="fas fa-truc"></i>
        </div><p class="mt-3"> SEMPRO DI JADWALKAN </p>
     </li> 
        <li class="step "> 
            <div><i class="fas "> </i>
        </div><p class="mt-3"> SELESAI SEMPRO  </p>
     </li> 
        <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> DAFTAR SIDANG </p>
     </li> 
        <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> SIDANG DI JADWALKAN </p>
     </li> 
        <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> SIDANG SELESAI </p>
     </li> 
        <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> SKRIPSI SELESAI </p>
     </li>
    @endif
    @if ($skripsi->status_skripsi == 'SEMPRO DIJADWALKAN' )
    <li class="step active"> 
            <div>
                <i class="fas fa-check"></i>
        </div> 
        <p class="mt-3 mb-4"> USULAN JUDUL</p> 
        <span class="mt-4 "> Tanggal disetujui <br></span>
        <p class=" text-bold">{{ Carbon::parse($skripsi->tgl_disetujui_usuljudul)->translatedFormat('l, d F Y') }}</p> 
        </li> 
         <li class="step active"> 
            <div>
                <i class="fas fa-check"></i>
        </div> 
        <p class="mt-3 mb-4"> DAFTAR SEMPRO </p> 
        <span class="mt-3 "> Tanggal disetujui <br></span>
        <p class=" text-bold">{{ Carbon::parse($skripsi->tgl_disetujui_sempro)->translatedFormat('l, d F Y') }}</p> 
        </li> 
        <li class="step active"> 
            <div><i class="fas fa-check"></i>
        </div><p class="mt-1 "> SEMPRO DI JADWALKAN </p>
        <span class="mt-0 "> Tanggal disetujui <br></span>
        <p class="text-bold">{{ Carbon::parse($skripsi->tgl_disetujui_sempro)->translatedFormat('l, d F Y') }}</p> 
     </li> 
        <li class="step "> 
            <div><i class="fas "> </i>
        </div><p class="mt-3"> SELESAI SEMPRO  </p>
     </li> 
        <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> DAFTAR SIDANG </p>
     </li> 
        <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> SIDANG DI JADWALKAN </p>
     </li> 
        <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> SIDANG SELESAI </p>
     </li> 
        <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> SKRIPSI SELESAI </p>
     </li>
    @endif
    @if ($skripsi->status_skripsi == 'SEMPRO SELESAI' )
    <li class="step active"> 
            <div>
                <i class="fas fa-check"></i>
        </div> 
        <p class="mt-3 mb-4"> USULAN JUDUL</p> 
        <span class="mt-4 "> Tanggal disetujui <br></span>
        <p class=" text-bold">{{ Carbon::parse($skripsi->tgl_disetujui_usuljudul)->translatedFormat('l, d F Y') }}</p> 
        </li> 
         <li class="step active"> 
            <div>
                <i class="fas fa-check"></i>
        </div> 
        <p class="mt-3 mb-4"> DAFTAR SEMPRO </p> 
        <span class="mt-3 "> Tanggal disetujui <br></span>
        <p class=" text-bold">{{ Carbon::parse($skripsi->tgl_disetujui_sempro)->translatedFormat('l, d F Y') }}</p> 
        </li> 
        <li class="step active"> 
            <div><i class="fas fa-check"></i>
        </div><p class="mt-1 "> SEMPRO DI JADWALKAN </p>
        <span class="mt-0 "> Tanggal disetujui <br></span>
        <p class="text-bold">{{ Carbon::parse($skripsi->tgl_disetujui_sempro)->translatedFormat('l, d F Y') }}</p> 
     </li> 
        <li class="step active"> 
            <div><i class="fas fa-check"></i>
        </div><p class="mt-3 mb-4"> SEMPRO SELESAI </p>
        <span class="mt-4 "> Tanggal disetujui <br></span>
        <p class="text-bold">{{ Carbon::parse($skripsi->tgl_disetujui_sempro)->translatedFormat('l, d F Y') }}</p> 
     </li> 
        <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> DAFTAR SIDANG </p>
     </li> 
        <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> SIDANG DI JADWALKAN </p>
     </li> 
        <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> SIDANG SELESAI </p>
     </li> 
        <li class="step "> 
            <div><i class="fas "></i>
        </div><p class="mt-3"> SKRIPSI SELESAI </p>
     </li>
    @endif
    
         
    </ul> 
</div>

<div class="container-fluid">


@if ($skripsi->status_skripsi == 'SEMPRO SELESAI' )
<div class="mt-2">
    <a href="/daftar-sidang/create/{{$skripsi->id}}" class="btn mahasiswa btn-success mb-3">Daftar Sidang Skripsi</a>
</div>

@endif

@endforeach
</div>

@endif

@foreach ($pendaftaran_skripsi as $skripsi)
<div class="card card-timeline px-2 border-none">

<div class="row  justify-content mb-2">
       
    </div>

<div class="row">
    
    <div class="col mb-3">
    
    <ol class=" mt-2">
    <a href="/daftar-sempro/detail/{{($skripsi->id)}}" class="badge bg-success p-2 mb-2 fas fa-eye"> Lihat Detail</a>
    <hr>
    <h5 class="font-weight-bold mt-3">Status Skripsi</h5>
    @if ($skripsi->status_skripsi == 'DAFTAR SEMPRO' || $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI KOORDINATOR SKRIPSI' ||$skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI PEMBIMBING' ||$skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI PEMBIMBING 1' ||$skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI PEMBIMBING 2' )
        <li class="list-group-item badge bg-secondary p-3 d-flex text-center ">
          <div class="ms-2 me-auto text-center gridratakiri">
            <!-- <div class="fw-bold ">NIM</div> -->
            <span class="fw-bold text-center ">{{$skripsi->status_skripsi}}</span>
          </div>        
        </li> 
        @endif
    @if ($skripsi->status_skripsi == 'SEMPRO DISETUJUI'  ||$skripsi->status_skripsi == 'SEMPRO DIJADWALKAN' || $skripsi->status_skripsi == 'SEMPRO SELESAI')
        <li class="list-group-item badge bg-info p-3 d-flex text-center ">
          <div class="ms-2 me-auto text-center gridratakiri">
            <!-- <div class="fw-bold ">NIM</div> -->
            <span class="fw-bold text-center ">{{$skripsi->status_skripsi}}</span>
          </div>        
        </li> 
        @endif
        <h5 class="font-weight-bold mt-3">Keterangan</h5>     
        <li class="list-group-item mt-3 d-flex justify-content-center align-items-start">
          <div class="ms-2 me-auto gridratakiri">
          
            <span class="fw-bold ">{{$skripsi->keterangan}}</span>
          </div>        
        </li>      
      </ol>
    </div>
    
    <div class="col-md">
    <!-- <ol class="mt-5">
        <li class="list-group d-flex">
        <a href="/permohonanskripsi/create/{{$skripsi->id}}" class="btn mahasiswa btn-success mb-3">Usul Permohonan KP</a>       
        </li>    
      </ol> -->
      
    </div>
    </div>
    
  </div>
@endforeach
    

</div>
<br>





@endsection

@push('scripts')
<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 2000);
</script>
@endpush()