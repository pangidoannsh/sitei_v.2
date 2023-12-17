@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
   SITEI | Daftar Bimbingan Kerja Praktek
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

<li><a href="/pembimbing/kerja-praktek" class="breadcrumb-item active fw-bold text-success px-1">Bimbingan KP (<span>{{ $jml_kp }}</span>)</a></li>
  <span class="px-2">|</span>
  <li><a href="/pembimbing/skripsi" class="px-1">Bimbingan Skripsi (<span>{{ $jml_skripsi }}</span>)</a></li>
  <span class="px-2">|</span>
  <li><a href="/kp-skripsi/pembimbing-penguji/riwayat-bimbingan" class="px-1">Riwayat (<span>{{ $jml_riwayat_kp + $jml_riwayat_skripsi }}</span>)</a></li>

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
            <td class="text-center fw-bold">{{$kp->mahasiswa->nama}}</td>

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
            <td class="text-center"> Tanggal Usulan: <br><b> {{Carbon::parse($kp->tgl_created_usulan)->translatedFormat('l, d F Y')}}</b></td>
            @endif
            @if ($kp->status_kp == 'USULAN KP DITERIMA')           
            <td class="text-center"> Tanggal Diterima: <br><b>{{Carbon::parse($kp->tgl_disetujui_usulankp_kaprodi)->translatedFormat('l, d F Y')}}</b></td>
            @endif

             @if ($kp->status_kp == 'SURAT PERUSAHAAN')           
            <td class="text-center">Tanggal Usulan: <br><b>{{Carbon::parse($kp->tgl_created_balasan)->translatedFormat('l, d F Y')}}</b></td>
            @endif

            @if ($kp->status_kp == 'KP DISETUJUI')           
            <td class="text-center">Tanggal Disetujui: <br><b>{{Carbon::parse($kp->tgl_disetujui_balasan)->translatedFormat('l, d F Y')}}</b></td>
            @endif

            @if ($kp->status_kp == 'DAFTAR SEMINAR KP')           
            <td class="text-center">Tanggal Usulan: <br><b>{{Carbon::parse($kp->tgl_created_semkp)->translatedFormat('l, d F Y')}}</b></td>
            @endif
            @if ($kp->status_kp == 'DAFTAR SEMINAR KP DISETUJUI')           
            <td class="text-center">Tanggal Disetujui: <br><b>{{Carbon::parse($kp->tgl_created_semkp_kaprodi)->translatedFormat('l, d F Y')}}</b></td>
            @endif
            
            @if ($kp->status_kp == 'SEMINAR KP DIJADWALKAN')           
            <td class="text-center">Tanggal Dijadwalkan: <br><b>{{Carbon::parse($kp->tgl_dijadwalkan)->translatedFormat('l, d F Y')}}</b></td>
            @endif
            @if ($kp->status_kp == 'SEMINAR KP SELESAI')           
            <td class="text-center">Tanggal Selesai: <br><b>{{Carbon::parse($kp->tgl_selesai_semkp)->translatedFormat('l, d F Y')}}</b></td>
            @endif
            @if ($kp->status_kp == 'BUKTI PENYERAHAN LAPORAN')           
            <td class="text-center">Tanggal Usulan: <br><b>{{Carbon::parse($kp->tgl_created_kpti10)->translatedFormat('l, d F Y')}}</b></td>
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
    const waitingApprovalCount = {!! json_encode($jml_kp) !!};

    const totalKuota = {!! json_encode($kapasitas_bimbingan_kp) !!};
    const sisaKuota = totalKuota - waitingApprovalCount;

    if (waitingApprovalCount > 0 && waitingApprovalCount < totalKuota) {
      
        Swal.fire({
            title: 'Ini adalah halaman Bimbingan Kerja Praktek',
            html: `Ada <strong class="text-info"> ${waitingApprovalCount} Mahasiswa</strong> bimbingan Anda sedang melaksanakan kerja praktek. <br>
            Anda memiliki sisa <strong class="text-info">${sisaKuota} kuota </strong>Mahasiswa Bimbingan Kerja Praktek.`,
            icon: 'info',
            showConfirmButton: true,
            confirmButtonColor: '#28a745',
        });
    }else if(waitingApprovalCount >= totalKuota ){
        Swal.fire({
            title: 'Ini adalah halaman Bimbingan Kerja Praktek',
            html: `Ada <strong class="text-danger"> ${waitingApprovalCount} Mahasiswa</strong> bimbingan Anda sedang melaksanakan kerja praktek. <br>
            Kuota Mahasiswa Bimbingan Anda Sudah Penuh!`,
            icon: 'info',
            showConfirmButton: true,
            confirmButtonColor: '#28a745',
        });
    } else {

        Swal.fire({
            title: 'Ini adalah halaman Bimbingan Kerja Praktek',
            html: `Tidak ada mahasiswa dibawah bimbingan Anda. <br> Anda masih memiliki <strong class="text-info">${totalKuota} kuota</strong> mahasiswa bimbingan`,
            icon: 'info',
            showConfirmButton: true,
            confirmButtonColor: '#28a745',
        });
    }
});
</script>
@endpush()







