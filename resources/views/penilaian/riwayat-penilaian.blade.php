@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Riwayat Seminar
@endsection

@section('sub-title')
    Riwayat Seminar
@endsection

@section('content')

<div class="container card  p-4">
{{-- <ol class="breadcrumb col-lg-12" >
 
<div class="btn-group menu-dosen scrollable-btn-group col-md-12">

   <a href="/kp-skripsi/persetujuan-kp" class="btn bg-light border  border-bottom-0 "   style="border-top-left-radius: 15px;" >Persetujuan KP (<strong id="persetujuanKPCount"></strong>)</a>

   <a href="/kp-skripsi/penilaian-kp"  class="btn bg-light border  border-bottom-0" >
  <span class="button-text">Seminar KP (<strong id="seminarKPCount"></strong>)</span>
  <span class="badge-link">
    <a href="/kp-skripsi/riwayat-penilaian-kp" class="sejarah pt-2 bg-success "> <span class="p-1" data-bs-toggle="tooltip" title="Riwayat Seminar"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>

  @if (Str::length(Auth::guard('dosen')->user()) > 0)
         @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 || Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
  <a href="/kerja-praktek"  class="btn bg-light border  border-bottom-0 " >
  <span class="button-text">Data KP (<strong id="prodiKPCount"></strong>)</span>
  <span class="badge-link">
    <a href="/kerja-praktek/nilai-keluar" class="sejarah pt-2 bg-light "> <span class="p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>
  @endif
@endif

<a href="/pembimbing/kerja-praktek"  class="btn bg-light border  border-bottom-0 " >
  <span class="button-text">Bimbingan KP (<strong id="bimbinganKPCount"></strong>)</span>
  <span class="badge-link" >
    <a href="/kerja-praktek/pembimbing/nilai-keluar" class="sejarah pt-2  bg-light " style="border-top-right-radius: 15px;">
      <span class="p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>

</div>
</ol> --}}

<!-- <ol class="breadcrumb col-lg-12">
  <li class="breadcrumb-item"><a href="/kp-skripsi/penilaian-kp">Jadwal Seminar</a></li>  
  <li class="breadcrumb-item"><a class="breadcrumb-item active fw-bold text-black" href="/kp-skripsi/riwayat-penilaian-kp">Riwayat Penilaian</a></li>  
</ol> -->

<ol class="breadcrumb col-lg-12">
  <li><a href="/kp-skripsi/persetujuan-kp" class="px-1">Persetujuan</a></li>
  (<span id="waitingApprovalCount"></span>)
  <span class="px-2">|</span>      
  <li><a href="/kp-skripsi/penilaian-kp" class="px-1">Seminar</a></li>
  (<span id="seminarKPCount"></span>)  
  <span class="px-2">|</span>
  <li><a href="/kp-skripsi/riwayat-penilaian-kp" class="breadcrumb-item active fw-bold text-black px-1">Riwayat Seminar</a></li>
  (<span id=""></span>)
  <span class="px-2">|</span>

  @if (Str::length(Auth::guard('dosen')->user()) > 0)
        @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 || Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )

        <li><a href="/kerja-praktek" class="px-1">Data KP</a></li>
        (<span id="prodiKPCount"></span>)
        <span class="px-2">|</span>
        <li><a href="/kerja-praktek/nilai-keluar" class="px-1">Riwayat KP</a></li>
        (<span id=""></span>)
        <span class="px-2">|</span>

      @endif
  @endif

        <li><a href="/pembimbing/kerja-praktek" class="px-1">Bimbingan KP</a></li>
        (<span id="bimbinganKPCount"></span>)
        <span class="px-2">|</span>
        <li><a href="/kerja-praktek/pembimbing/nilai-keluar" class="px-1">Riwayat Bimbingan KP</a></li>
        (<span id=""></span>)
  
</ol>

<table class="table table-responsive-lg table-bordered table-striped" style="width:100%" id="datatables">
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
      <th class="text-center" scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>    

    @foreach ($penjadwalan_kps as $kp)    
        <tr>
          <td class="text-center">{{$kp->mahasiswa->nim}}</td>                             
          <td class="text-center">{{$kp->mahasiswa->nama}}</td>                     
          <td class="bg-primary text-center">{{$kp->jenis_seminar}}</td>                  
          <td class="text-center">{{$kp->prodi->nama_prodi}}</td>          
          <td class="text-center">{{Carbon::parse($kp->tanggal)->translatedFormat('l, d F Y')}}</td>                   
          <td class="text-center">{{$kp->waktu}}</td>                   
          <td class="text-center">{{$kp->lokasi}}</td>              
          <td class="text-center">
            <p>{{$kp->pembimbing->nama_singkat}}</p>            
          </td>         
          <td class="text-center">
            <p>{{$kp->penguji->nama_singkat}}</p>            
          </td>                    
          <td class="text-center">
            @if ($kp->penguji_nip == auth()->user()->nip)                    
              <a formtarget="_blank" target="_blank" href="/perbaikan-kp/{{Crypt::encryptString($kp->id)}}" class="badge bg-info p-2"style="border-radius:20px;">Perbaikan</a>
              <a formtarget="_blank" target="_blank" href="/nilai-kp/{{Crypt::encryptString($kp->id)}}" class="badge bg-success mt-2 p-2"style="border-radius:20px;">Form Nilai</a>
            @endif
            @if ($kp->pembimbing_nip == auth()->user()->nip)   
              <a formtarget="_blank" target="_blank" href="/perbaikan-pengujikp/{{Crypt::encryptString($kp->id)}}/{{$kp->penguji->nip}}" class="badge bg-info p-2"style="border-radius:20px;">Perbaikan Penguji</a>                               
              <a formtarget="_blank" target="_blank" href="/beritaacara-kp/{{Crypt::encryptString($kp->id)}}" class="badge bg-danger mt-2 p-2"style="border-radius:20px;">Berita Acara</a>
            @endif
          </td>                        
        </tr>               
    @endforeach

  </tbody>
</table>
</div>
@endsection

@section('footer')
<section class="bg-dark p-1">
<div class="container">
          <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <small> <span class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/fahril-hadi">Fahril Hadi, </a> 
          <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/rahul-ilsa-tajri-mukhti">Rahul Ilsa Tajri Mukhti </a> <span class="text-success fw-bold">&</span> 
          <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/m-seprinaldi"> M. Seprinaldi</a><span class="text-success fw-bold">)</span></small></p>
        </div>
</section>
@endsection




@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const seminarKPCount = {!! json_encode($jml_seminarkp->count()) !!};
    const seminarKPElement = document.getElementById('seminarKPCount');
       seminarKPElement.innerText = seminarKPCount;
});
</script>
@endpush()

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const persetujuanKPCount = {!! json_encode($jml_persetujuankp->count()) !!};
    const persetujuanKPElement = document.getElementById('persetujuanKPCount');
       persetujuanKPElement.innerText = persetujuanKPCount;
});
</script>
@endpush()

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const prodiKPCount = {!! json_encode($jml_prodikp->count()) !!};
    const prodiKPElement = document.getElementById('prodiKPCount');
       prodiKPElement.innerText = prodiKPCount;
});
</script>
@endpush()

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bimbinganKPCount = {!! json_encode($jml_bimbingankp->count()) !!};
    const bimbinganKPElement = document.getElementById('bimbinganKPCount');
       bimbinganKPElement.innerText = bimbinganKPCount;
});
</script>
@endpush()