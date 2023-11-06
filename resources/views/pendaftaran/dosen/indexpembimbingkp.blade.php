@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
   SITEI ELEKTRO | Bimbingan Kerja Praktek
@endsection

@section('sub-title')
Daftar Bimbingan Kerja Praktek
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif

<div class="container card p-4">

<ol class="breadcrumb col-lg-12">
     
  <li><a href="/kp-skripsi/seminar-pembimbing-penguji" class="px-1">Seminar (<span id="seminarKPCount"></span>) </a></li>
   

  <span class="px-2">|</span>

          <li><a href="/pembimbing/kerja-praktek" class="breadcrumb-item active fw-bold text-success px-1">Bimbingan KP (<span id="bimbinganKPCount"></span>)</a></li>
          
          <span class="px-2">|</span>
          <li><a href="/pembimbing/skripsi" class="px-1">Bimbingan Skripsi (<span id=""></span>)</a></li>
          <span class="px-2">|</span>
          <li><a href="/riwayat" class="px-1">Riwayat (<span id=""></span>)</a></li>

</ol>

<div class="container-fluid">

          <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatables">
  <thead class="table-dark">
    <tr>      
        <th class="text-center px-0" scope="col">No.</th>
        <th class="text-center" scope="col">NIM</th>
        <th class="text-center" scope="col">Nama</th>
        <th class="text-center" scope="col">Status KP</th>
         <th class="text-center" scope="col">Tanggal Penting</th>
        <th class="text-center" scope="col">Keterangan</th>   
        <th class="text-center" scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($pendaftaran_kp as $kp)

    @php
  $tanggalDisetujui = $kp->tgl_disetujui_usulankp;
@endphp
@php
  $tanggalSaatIni = date('Y-m-d');
@endphp

<!-- Menghitung selisih hari -->
@php
  $waktuTersisa = strtotime($tanggalSaatIni) - strtotime($tanggalDisetujui);
  $selisihHari = floor($waktuTersisa / (60 * 60 * 24));
  $selisihHari30 = 30;
  $waktuMuncul = $selisihHari + $selisihHari30;
@endphp

<div></div>
        <tr>        
            <td class="text-center">{{$loop->iteration}}</td>                             
            <td class="text-center">{{$kp->mahasiswa->nim}}</td>                             
            <td class="text-center">{{$kp->mahasiswa->nama}}</td>

            @if ($kp->status_kp == 'USULAN KP' || $kp->status_kp == 'SURAT PERUSAHAAN' || $kp->status_kp == 'DAFTAR SEMINAR KP'|| $kp->status_kp == 'BUKTI PENYERAHAN LAPORAN')           
            <td class="text-center bg-secondary">{{$kp->status_kp}}</td>
            @endif
            @if ($kp->status_kp == 'USULAN KP DITERIMA' || $kp->status_kp == 'KP DISETUJUI' || $kp->status_kp == 'DAFTAR SEMINAR KP DISETUJUI' || $kp->status_kp == 'SEMINAR KP SELESAI'|| $kp->status_kp == 'KP SELESAI')           
            <td class="text-center bg-info">{{$kp->status_kp}}</td>
            @endif
            @if ( $kp->status_kp == 'SEMINAR KP DIJADWALKAN')           
            <td class="text-center bg-success">{{$kp->status_kp}}</td>
            @endif

           @if ( $kp->status_kp == 'SURAT PERUSAHAAN DITOLAK' || $kp->status_kp == 'DAFTAR SEMINAR KP DITOLAK' || $kp->status_kp == 'BUKTI PENYERAHAN LAPORAN DITOLAK' )           
            <td class="text-center bg-danger">{{$kp->status_kp}}</td>
            @endif
            
            @if ($kp->status_kp == 'USULAN KP')           
            <td class="text-center"> Tanggal Usulan: <br>{{Carbon::parse($kp->tgl_created_usulan)->translatedFormat('l, d F Y')}}</td>
            @endif
             @if ($kp->status_kp == 'USULAN KP DITERIMA')           
            <td class="text-center"> Batas Unggah Surat Balasan: <br>
@if ($waktuMuncul >= 0)
    <span class="text-danger"> {{ $waktuMuncul }}  hari lagi</span> ({{Carbon::parse($kp->tgl_disetujui_usulankp)->translatedFormat('l, d F Y')}})
  @else
    Batas Waktu Unggah Surat Balasan telah habis
  @endif
</td>
            @endif
             @if ($kp->status_kp == 'SURAT PERUSAHAAN')           
            <td class="text-center">Tanggal Usulan: <br>{{Carbon::parse($kp->tgl_created_balasan)->translatedFormat('l, d F Y')}}</td>
            @endif

            @if ($kp->status_kp == 'KP DISETUJUI')           
            <td class="text-center">Tanggal Usulan: <br>{{Carbon::parse($kp->tgl_disetujui_balasan)->translatedFormat('l, d F Y')}}</td>
            @endif

            @if ($kp->status_kp == 'DAFTAR SEMINAR KP' || $kp->status_kp == 'DAFTAR SEMINAR KP DISETUJUI')           
            <td class="text-center">Tanggal Usulan: <br>{{Carbon::parse($kp->tgl_created_semkp)->translatedFormat('l, d F Y')}}</td>
            @endif
            
            @if ( $kp->status_kp == 'SURAT PERUSAHAAN DITOLAK' || $kp->status_kp == 'DAFTAR SEMINAR KP DITOLAK' || $kp->status_kp == 'BUKTI PENYERAHAN LAPORAN DITOLAK')           
             <td class="text-center text-danger">{{$kp->keterangan}}</td>
             @else
              <td class="text-center">{{$kp->keterangan}}</td>
            @endif
       

            @if ($kp->status_kp == 'USULAN KP' || $kp->status_kp == 'USULAN KP DITERIMA'  )
            <td class="text-center">
              <a href="/usulan/detail/pembimbingprodi/{{($kp->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>
            @endif
            @if ($kp->status_kp == 'SURAT PERUSAHAAN' || $kp->status_kp == 'KP DISETUJUI' || $kp->status_kp == 'SURAT PERUSAHAAN DITOLAK' )
            <td class="text-center">
              <a href="/suratperusahaan/detail/pembimbingprodi/{{($kp->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>
            @endif

            @if ($kp->status_kp == 'DAFTAR SEMINAR KP' || $kp->status_kp == 'DAFTAR SEMINAR KP DISETUJUI' ||  $kp->status_kp == 'SEMINAR KP DIJADWALKAN' || $kp->status_kp == 'SEMINAR KP SELESAI' || $kp->status_kp == 'DAFTAR SEMINAR KP DITOLAK')
            <td class="text-center">
              <a href="/daftar-semkp/detail/pembimbing/{{($kp->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>
            @endif

            @if ($kp->status_kp == 'BUKTI PENYERAHAN LAPORAN' || $kp->status_kp == 'KP SELESAI' || $kp->status_kp == 'BUKTI PENYERAHAN LAPORAN DITOLAK')
            <td class="text-center">
              <a href="/kpti10/detail/pembimbingprodi/{{($kp->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const waitingApprovalCount = {!! json_encode($pendaftaran_kp->count()) !!};
    const waitingApprovalElement = document.getElementById('waitingApprovalCount');

    const totalKuota = 10;
    const sisaKuota = totalKuota - waitingApprovalCount;

    if (waitingApprovalCount > 0 && waitingApprovalCount < totalKuota) {
      waitingApprovalElement.innerText = waitingApprovalCount;
        Swal.fire({
            title: 'Ini adalah halaman Daftar Bimbingan Kerja Praktek',
            html: `Ada <strong class="text-info"> ${waitingApprovalCount} Mahasiswa</strong> dibawah bimbingan Anda. <br>
            Anda memiliki sisa <strong class="text-info">${sisaKuota} kuota </strong>Mahasiswa Bimbingan.`,
            icon: 'info',
            showConfirmButton: false,
            timer: 5000,
        });
    }else if(waitingApprovalCount >= 10){
        Swal.fire({
            title: 'Ini adalah halaman Daftar Bimbingan Kerja Praktek',
            html: `Ada <strong class="text-danger"> ${waitingApprovalCount} Mahasiswa</strong> dibawah bimbingan Anda. <br>
            Kuota Mahasiswa Bimbingan Anda Sudah Penuh!`,
            icon: 'info',
            showConfirmButton: false,
            timer: 5000,
        });
    } else {
    waitingApprovalElement.innerText = '0';
        Swal.fire({
            title: 'Ini adalah halaman Daftar Bimbingan Kerja Praktek',
            html: `Tidak ada mahasiswa dibawah bimbingan Anda. <br> Anda masih memiliki <strong class="text-info">10 kuota</strong> mahasiswa bimbingan`,
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



