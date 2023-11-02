@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Kerja Praktek | SIA ELEKTRO
@endsection

@section('sub-title')
    Riwayat Kerja Praktek Mahasiswa
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
 
  <li><a href="/kp-skripsi/persetujuan-kp" class="px-1">Persetujuan</a></li>
  (<span id="waitingApprovalCount"></span>)
  <span class="px-2">|</span>      
  <li><a href="/kp-skripsi/penilaian-kp" class="px-1">Seminar</a></li>
  (<span id="seminarKPCount"></span>)  
  <span class="px-2">|</span>
  <li><a href="/kp-skripsi/riwayat-penilaian-kp" class="px-1">Riwayat Seminar</a></li>
  (<span id=""></span>)
  <span class="px-2">|</span>

  @if (Str::length(Auth::guard('dosen')->user()) > 0)
        @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 || Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )

        <li><a href="/kerja-praktek" class="px-1">Data KP</a></li>
        (<span id="prodiKPCount"></span>)
        <span class="px-2">|</span>
        <li><a href="/kerja-praktek/nilai-keluar" class="breadcrumb-item active fw-bold text-black px-1">Riwayat KP</a></li>
        (<span id=""></span>)
        <span class="px-2">|</span>

  @endif
@endif
          <li><a href="/pembimbing/kerja-praktek" class="px-1">Bimbingan KP</a></li>
          (<span id="bimbinganKPCount"></span>)
          <span class="px-2">|</span>
          <li><a href="/kerja-praktek/pembimbing/nilai-keluar" class="px-1">Riwayat Bimbingan KP</a></li>
          (<span id=""></span>)
 
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
    <a href="/kerja-praktek/nilai-keluar" class="sejarah pt-2 bg-success ">  
      <span class="p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>
    <a href="/sidang/admin/index"  class="btn bg-light border  border-bottom-0 " >
  <span class="button-text">Skripsi</span>
  <span class="badge-link">
    <a href="/skripsi/nilai-keluar" class="sejarah pt-2 bg-light " style="border-top-right-radius: 15px;">  
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
        <th class="text-center px-0" scope="col">No.</th>
        <th class="text-center" scope="col">NIM</th>
        <th class="text-center" scope="col">Nama</th>
        <th class="text-center" scope="col">Status KP</th>
        <th class="text-center" scope="col">Keterangan</th>   
        <th class="text-center" scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($pendaftaran_kp as $kp)
<div></div>
        <tr>        
            <td class="text-center">{{$loop->iteration}}</td>                             
            <td class="text-center">{{$kp->mahasiswa->nim}}</td>                             
            <td class="text-center">{{$kp->mahasiswa->nama}}</td>
            <td class="text-center bg-info">{{$kp->status_kp}}</td>
                               
            <td class="text-center">{{$kp->keterangan}}</td>  

            <td class="text-center">
            <a href="/kpti10-kp/detail/{{($kp->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>

        </tr>

    @endforeach
  </tbody>


</table>
</div>
</div>


@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const waitingApprovalCount = {!! json_encode($pendaftaran_kp->count()) !!};
    if (waitingApprovalCount > 0) {
        Swal.fire({
            title: 'Ini adalah halaman Riwayat Kerja Praktek Mahasiswa',
            html: `Ada <strong class="text-info"> ${waitingApprovalCount} Mahasiswa </strong> telah selesai melaksanakan Kerja Praktek.`,
            icon: 'info',
            showConfirmButton: false,
            timer: 5000,
        });
    } else {
        Swal.fire({
            title: 'Ini adalah halaman Riwayat Kerja Praktek Mahasiswa',
            html: `Belum ada mahasiswa selesai Kerja Praktek.`,
            icon: 'info',
            showConfirmButton: false,
            timer: 5000,
        });
    }
});
</script>
@endpush()

{{-- @push('scripts')
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
    const seminarKPCount = {!! json_encode($jml_seminarkp->count()) !!};
    const seminarKPElement = document.getElementById('seminarKPCount');
       seminarKPElement.innerText = seminarKPCount;
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
@endpush() --}}

