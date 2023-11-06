@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Penilaian | SIA ELEKTRO
@endsection

@section('sub-title')
    Jadwal Seminar
@endsection

@section('content')

@if (session()->has('message'))
<div class="swal" data-swal="{{session('message')}}"></div>
@endif 

@if (session()->has('loginError'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{session('loginError')}}        
      </div>
@endif
<div class="container card  p-4">


<ol class="breadcrumb col-lg-12">

  <li><a href="/kp-skripsi/seminar" class="breadcrumb-item active fw-bold text-success px-1">Seminar  (<span id="waitingApprovalCount"></span>) </a></li>

  @if (Str::length(Auth::guard('dosen')->user()) > 0)
        @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 || Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
        <span class="px-2">|</span>
        <li><a href="/kerja-praktek" class="px-1">Kerja Praktek (<span id="prodiKPCount"></span>)</a></li>
        
        <span class="px-2">|</span>
        <li><a href="/skripsi" class="px-1">Skripsi (<span id=""></span>)</a></li>

      @endif
  @endif
        <span class="px-2">|</span>
        <li><a href="/riwayat" class="px-1">Riwayat (<span id="bimbinganKPCount"></span>)</a></li>
        
  
</ol>

<table class="table table-responsive-lg table-bordered table-striped" style="width:100%" id="datatables">
  <thead class="table-dark">
    <tr>      
      <th class="text-center" scope="col">NIM</th>
      <th class="text-center" scope="col">Nama</th>
      <th class="text-center" scope="col">Seminar KP</th>
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
          @if ($kp->penilaian(Auth::user()->nip, $kp->id) == false)
            @if (Carbon::now() >= $kp->tanggal && Carbon::now()->format('H:i:m') >= $kp->waktu)
            <a href="/penilaian-kp/create/{{Crypt::encryptString($kp->id)}}" class="badge bg-primary"style="border-radius:20px; padding:7px;"> Input Nilai<a>          
            @else
            <span class="badge bg-danger"style="border-radius:20px; padding:7px;">Belum Dimulai</span>
            @endif
          @else
            <a href="/penilaian-kp/edit/{{Crypt::encryptString($kp->id)}}" class="badge bg-warning" style="border-radius:20px; padding:7px;"> Edit Nilai<a>              
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
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 2000);
</script>
@endpush()

@push('scripts')
<script>
  const swal= $('.swal').data('swal');
  if (swal) {
    Swal.fire({
      title : 'Berhasil',
      text : swal,
      confirmButtonColor: '#28A745',
      icon : 'success'
    })    
  }
</script>
@endpush()


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const waitingApprovalCount = {!! json_encode($penjadwalan_kps->count()) !!};
    const waitingApprovalElement = document.getElementById('waitingApprovalCount');
    if (waitingApprovalCount > 0) {
      waitingApprovalElement.innerText = waitingApprovalCount;
        Swal.fire({
            title: 'Ini adalah halaman Jadwal Seminar Kerja Paktek',
            html: `Ada <strong class="text-info"> ${waitingApprovalCount} Mahasiswa</strong> dijadwalkan Seminar.`,
            icon: 'info',
            showConfirmButton: false,
            timer: 5000,
        });
    } else {
      waitingApprovalElement.innerText = '0';
        Swal.fire({
            title: 'Ini adalah halaman Jadwal Seminar Kerja Paktek',
            html: `Tidak ada mahasiswa dijadwalkan Seminar.`,
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