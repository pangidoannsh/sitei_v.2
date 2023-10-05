@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Riwayat Penilaian | SIA ELEKTRO
@endsection

@section('sub-title')
    Riwayat Penilaian Kerja Praktek
@endsection

@section('content')

<div class="container card  p-4">
<ol class="breadcrumb col-lg-12" >
 
<div class="btn-group menu-dosen scrollable-btn-group col-md-12">

   <a href="/kp-skripsi/persetujuan-kp" class="btn bg-light border  border-bottom-0 "   style="border-top-left-radius: 15px;" >Persetujuan (<strong id="persetujuanKPCount"></strong>)</a>

   <a href="/kp-skripsi/penilaian-kp"  class="btn bg-light border  border-bottom-0" >
  <span class="button-text">Seminar (<strong id="seminarKPCount"></strong>)</span>
  <span class="badge-link">
    <a href="/kp-skripsi/riwayat-penilaian-kp" class="sejarah pt-2 bg-success "> <span class="p-1" data-bs-toggle="tooltip" title="Riwayat Seminar"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>

  @if (Str::length(Auth::guard('dosen')->user()) > 0)
         @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 || Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
  <a href="/kerja-praktek"  class="btn bg-light border  border-bottom-0 " >
  <span class="button-text">KP Prodi (<strong id="prodiKPCount"></strong>)</span>
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
</ol>

<!-- <ol class="breadcrumb col-lg-12">
  <li class="breadcrumb-item"><a href="/kp-skripsi/penilaian-kp">Jadwal Seminar</a></li>  
  <li class="breadcrumb-item"><a class="breadcrumb-item active fw-bold text-black" href="/kp-skripsi/riwayat-penilaian-kp">Riwayat Penilaian</a></li>  
</ol> -->

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


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const waitingApprovalCount = {!! json_encode($penjadwalan_kps->count()) !!};
    if (waitingApprovalCount > 0) {
        Swal.fire({
            title: 'Ini adalah halaman Riwayat Seminar Kerja Paktek',
            html: `Ada <strong class="text-info"> ${waitingApprovalCount} Mahasiswa</strong> Selesai Seminar Kerja Praktek.`,
            icon: 'info',
            showConfirmButton: false,
            timer: 5000,
        });
    } else {
        Swal.fire({
            title: 'Ini adalah halaman Riwayat Seminar Kerja Paktek',
            html: `Tidak ada mahasiswa selesai Seminar Kerja Praktek.`,
            icon: 'info',
            showConfirmButton: false,
            timer: 5000,
        });
    }
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