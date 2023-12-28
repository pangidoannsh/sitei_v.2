@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Riwayat Bimbingan Mahasiswa
@endsection

@section('sub-title')
    Riwayat Bimbingan Mahasiswa
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif

<div class="container card p-4">

<ol class="breadcrumb col-lg-12">
 
@if (Str::length(Auth::guard('dosen')->user()) > 0)

<li><a href="/pembimbing/kerja-praktek" class="px-1">Bimbingan KP (<span>{{ $jml_kp }}</span>)</a></li>
  <span class="px-2">|</span>
  <li><a href="/pembimbing/skripsi" class="px-1">Bimbingan Skripsi (<span>{{ $jml_skripsi }}</span>)</a></li>
  <span class="px-2">|</span>
  <li><a href="/pembimbing-penguji/riwayat-bimbingan" class="breadcrumb-item active fw-bold text-success px-1">Riwayat (<span>{{ $jml_riwayat_kp + $jml_riwayat_skripsi }}</span>)</a></li>
    
 
  @endif

@if (Str::length(Auth::guard('web')->user()) > 0)

@if (Str::length(Auth::guard('web')->user()) > 0)
 @if (Auth::guard('web')->user()->role_id == 2 || Auth::guard('web')->user()->role_id == 3 || Auth::guard('web')->user()->role_id == 4 )
  <a href="/persetujuan/admin/index" class="btn bg-light border  border-bottom-0" style="border-top-left-radius: 15px;">Persetujuan</a>
@endif
@endif
    <a href="/kerja-praktek/admin/index"  class="btn bg-light border  border-bottom-0 " >
  <span class="button-text">Kerja Praktek</span>
  <span class="badge-link">
    <a href="/kerja-praktek/pembimbing/nilai-keluar" class="sejarah pt-2 bg-success ">  
      <span class="p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>
    <a href="/sidang/admin/index"  class="btn bg-light border  border-bottom-0 " >
  <span class="button-text">Skripsi</span>
  <span class="badge-link">
    <a href="/skripsi/pembimbing/nilai-keluar" class="sejarah pt-2 bg-light " style="border-top-right-radius: 15px;">  
      <span class="p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>
  @endif

</ol>

<div class="container-fluid">

          <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatables">
  <thead class="table-dark">
    <tr>      
        <!-- <th class="text-center" scope="col">No.</th> -->
        <th class="text-center" scope="col">NIM</th>
        <th class="text-center" scope="col">Nama</th>
        <!-- <th class="text-center" scope="col">Konsentrasi</th>   -->
        <!-- <th class="text-center" scope="col">Jenis Usulan</th> -->
        <th class="text-center" scope="col">Status</th>
        <th class="text-center" scope="col">Keterangan</th>   
        <th class="text-center" scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($pendaftaran_kp as $kp)
<div></div>
        <tr>        
            <!-- <td class="text-center">{{$loop->iteration}}</td>                              -->
            <td class="text-center">{{$kp->mahasiswa->nim}}</td>                             
            <td class="text-center">{{$kp->mahasiswa->nama}}</td>
            <!-- <td class="text-center">{{$kp->mahasiswa->konsentrasi->nama_konsentrasi}}</td>            -->
            <!-- <td class="text-center">{{$kp->jenis_usulan}}</td>                       -->
            <td class="text-center bg-info">{{$kp->status_kp}}</td>
                               
            <td class="text-center">{{$kp->keterangan}}</td>  

            <td class="text-center">
            <a href="/kpti10/detail/riwayat/pembimbingprodi/{{($kp->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>

        </tr>

    @endforeach

     @foreach ($pendaftaran_skripsi as $skripsi)
<div></div>
        <tr>        
            <!-- <td class="text-center">{{$loop->iteration}}</td>-->
            <td class="text-center">{{$skripsi->mahasiswa->nim}}</td>                             
            <td class="text-center">{{$skripsi->mahasiswa->nama}}</td>
            <!-- <td class="text-center">{{$skripsi->konsentrasi->nama_konsentrasi}}</td>-->
                        
            <!-- <td class="text-center">{{$skripsi->jenis_usulan}}</td>    -->
            <!-- USUL JUDUL  -->
  
            @if ($skripsi->status_skripsi == 'LULUS')           
            <td class="text-center bg-info">{{$skripsi->status_skripsi}}</td>
            @endif
            <!-- ___________batas____________ -->

            <td class="text-center">{{$skripsi->keterangan}}</td> 
            <!-- USUL JUDUL  -->
              @if ($skripsi->status_skripsi == 'LULUS' ) 

           <td class="text-center">
          <a href="/kp-skripsi/riwayat/pembimbing/bukti-buku-skripsi/{{($skripsi->id)}}" class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>
          @endif
        </tr>

    @endforeach

  </tbody>


</table>

</div>
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
    const waitingApprovalCount = {!! json_encode($jml_riwayat_kp + $jml_riwayat_skripsi) !!};
    if (waitingApprovalCount > 0) {
        Swal.fire({
            title: 'Ini adalah halaman Riwayat Bimbingan',
            html: `Ada <strong class="text-info"> ${waitingApprovalCount} Mahasiswa</strong> bimbingan Anda telah selesai melaksanakan Kerja Praktek dan Skripsi.`,
            icon: 'info',
            showConfirmButton: true,
            confirmButtonColor: '#28a745',
        });
    } else {
        Swal.fire({
            title: 'Ini adalah halaman Riwayat Bimbingan',
            html: `Belum ada mahasiswa bimbingan Anda selesai Kerja Praktek dan Skripsi.`,
            icon: 'info',
            showConfirmButton: true,
            confirmButtonColor: '#28a745',
        });
    }
});
</script>
@endpush()
