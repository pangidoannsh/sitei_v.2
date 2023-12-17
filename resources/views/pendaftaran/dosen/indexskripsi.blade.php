@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Data Skripsi Mahasiswa
@endsection

@section('sub-title')
Data Skripsi Mahasiswa
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
          @if (Auth::guard('dosen')->user()->role_id == 5 || Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 || Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
  <li><a href="/kp-skripsi/seminar" class="px-1">Seminar  (<span>{{ $jml_seminar_kp + $jml_sempro + $jml_sidang }}</span>) </a></li>

        <span class="px-2">|</span>
        <li><a href="/kerja-praktek" class="px-1">Kerja Praktek (<span>{{ $jml_prodi_kp }}</span>)</a></li>
        
        <span class="px-2">|</span>
        <li><a href="/skripsi" class="breadcrumb-item active fw-bold text-success px-1">Skripsi (<span>{{ $jml_prodi_skripsi }}</span>)</a></li>


        <span class="px-2">|</span>
        <li><a href="/kp-skripsi/prodi/riwayat" class="px-1">Riwayat (<span>{{ $jml_riwayat_prodi_kp + $jml_riwayat_prodi_skripsi + $jml_riwayat_seminar_kp + $jml_riwayat_sempro + $jml_riwayat_skripsi }}</span>)</a></li>
              @endif
  @endif
  
</ol>

<div class="container-fluid">

          <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatables">
  <thead class="table-dark">
    <tr>      
        <th class="text-center px-0" scope="col">No.</th>
        <th class="text-center" scope="col">NIM</th>
        <th class="text-center" scope="col">Nama</th>
        <!-- <th class="text-center" scope="col">Konsentrasi</th> -->
        <th class="text-center" scope="col">Jenis Usulan</th>
        <th class="text-center" scope="col">Status Skripsi</th>
        <th class="text-center" scope="col">Tanggal Penting</th>
        <th class="text-center" scope="col">Keterangan</th>     
        <th class="text-center" scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>

 @foreach ($pendaftaran_skripsi as $skripsi)
<div></div>
        <tr>        
            <td class="text-center ">{{$loop->iteration}}</td>                             
            <td class="text-center">{{$skripsi->mahasiswa->nim}}</td>                             
            <td class="text-center fw-bold">{{$skripsi->mahasiswa->nama}}</td>
            <td class="text-center">{{$skripsi->jenis_usulan}}</td>             
            @if ($skripsi->status_skripsi == 'USULAN JUDUL' || $skripsi->status_skripsi == 'DAFTAR SEMPRO'|| $skripsi->status_skripsi == 'DAFTAR SIDANG' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI' || $skripsi->status_skripsi == 'PERPANJANGAN 1' || $skripsi->status_skripsi == 'PERPANJANGAN 2' || $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI')           
            <td class="text-center bg-secondary">{{$skripsi->status_skripsi}}</td>
            @endif
            @if ($skripsi->status_skripsi == 'JUDUL DISETUJUI'||$skripsi->status_skripsi == 'SEMPRO SELESAI' || $skripsi->status_skripsi == 'SIDANG SELESAI' || $skripsi->status_skripsi == 'PERPANJANGAN 1 DISETUJUI' || $skripsi->status_skripsi == 'PERPANJANGAN 2 DISETUJUI' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI' || $skripsi->status_skripsi == 'SKRIPSI SELESAI' || $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI' || $skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI')           
            <td class="text-center bg-info">{{$skripsi->status_skripsi}}</td>
            @endif
            @if ($skripsi->status_skripsi == 'SEMPRO DIJADWALKAN' || $skripsi->status_skripsi == 'SIDANG DIJADWALKAN')           
            <td class="text-center bg-success">{{$skripsi->status_skripsi}}</td>
            @endif
            @if ($skripsi->status_skripsi == 'USULAN JUDUL DITOLAK' || $skripsi->status_skripsi == 'USULKAN JUDUL ULANG' || $skripsi->status_skripsi == 'DAFTAR SEMPRO ULANG' || $skripsi->status_skripsi == 'DAFTAR SIDANG ULANG' || $skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK' || $skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI DITOLAK' || $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK' )           
            <td class="text-center bg-danger">{{$skripsi->status_skripsi}}</td>
            @endif

            @if ($skripsi->status_skripsi == 'USULAN JUDUL')           
            <td class="text-center"> Tanggal Usulan: <br><b>{{Carbon::parse($skripsi->tgl_created_usuljudul)->translatedFormat('l, d F Y')}}</b></td>
            @endif

            @if ($skripsi->status_skripsi == 'JUDUL DISETUJUI')           
            <td class="text-center"> Tanggal Disetujui: <br><b>{{Carbon::parse($skripsi->tgl_disetujui_usuljudul_kaprodi)->translatedFormat('l, d F Y')}}</b></td>
            @endif
            
            @if ($skripsi->status_skripsi == 'DAFTAR SEMPRO')           
            <td class="text-center"> Tanggal Usulan: <br><b>{{Carbon::parse($skripsi->tgl_created_sempro)->translatedFormat('l, d F Y')}}</b></td>
            @endif

            @if ($skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI')           
            <td class="text-center"> Tanggal Disetujui: <br><b>{{Carbon::parse($skripsi->tgl_disetujui_sempro_admin)->translatedFormat('l, d F Y')}}</b></td>
            @endif
            
            @if ($skripsi->status_skripsi == 'SEMPRO DIJADWALKAN')           
            <td class="text-center"> Tanggal Dijadwalkan: <br><b>{{Carbon::parse($skripsi->tgl_disetujui_jadwalsempro)->translatedFormat('l, d F Y')}}</b></td>
            @endif

            @if ($skripsi->status_skripsi == 'PERPANJANGAN 1')           
            <td class="text-center"> Tanggal Usulan: <br><b>{{Carbon::parse($skripsi->tgl_created_perpanjangan1)->translatedFormat('l, d F Y')}}</b></td>
            @endif

            @if ($skripsi->status_skripsi == 'PERPANJANGAN 1 DISETUJUI')           
            <td class="text-center"> Tanggal Disetujui: <br><b>{{Carbon::parse($skripsi->tgl_disetujui_perpanjangan1_kaprodi)->translatedFormat('l, d F Y')}}</b></td>
            @endif
            
            @if ($skripsi->status_skripsi == 'PERPANJANGAN 2')           
            <td class="text-center"> Tanggal Usulan: <br><b>{{Carbon::parse($skripsi->tgl_created_perpanjangan2)->translatedFormat('l, d F Y')}}</b></td>
            @endif

            @if ($skripsi->status_skripsi == 'PERPANJANGAN 2 DISETUJUI')           
            <td class="text-center"> Tanggal Disetujui: <br><b>{{Carbon::parse($skripsi->tgl_disetujui_perpanjangan2_kaprodi)->translatedFormat('l, d F Y')}}</b></td>
            @endif
            
            @if ($skripsi->status_skripsi == 'DAFTAR SIDANG')           
            <td class="text-center"> Tanggal Usulan: <br><b>{{Carbon::parse($skripsi->tgl_created_sidang)->translatedFormat('l, d F Y')}}</b></td>
            @endif

            @if ($skripsi->status_skripsi == 'DAFTAR SIDANG')           
            <td class="text-center"> Tanggal Disetujui: <br><b>{{Carbon::parse($skripsi->tgl_disetujui_sidang_kaprodi)->translatedFormat('l, d F Y')}}</b></td>
            @endif

            @if ($skripsi->status_skripsi == 'SIDANG DIJADWALKAN')           
            <td class="text-center"> Tanggal Dijadwalkan: <br><b>{{Carbon::parse($skripsi->tgl_disetujui_jadwal_sidang)->translatedFormat('l, d F Y')}}</b></td>
            @endif

            @if ($skripsi->status_skripsi == 'PERPANJANGAN REVISI')           
            <td class="text-center"> Tanggal Usulan: <br><b>{{Carbon::parse($skripsi->tgl_created_revisi)->translatedFormat('l, d F Y')}}</b></td>
            @endif

            @if ($skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI')           
            <td class="text-center"> Tanggal Disetujui: <br><b>{{Carbon::parse($skripsi->tgl_disetujui_revisi_kaprodi)->translatedFormat('l, d F Y')}}</b></td>
            @endif

            @if ($skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI')           
            <td class="text-center"> Tanggal Usulan: <br><b>{{Carbon::parse($skripsi->tgl_created_sti_17)->translatedFormat('l, d F Y')}}</b></td>
            @endif


            
            @if ($skripsi->status_skripsi == 'USULAN JUDUL DITOLAK' || $skripsi->status_skripsi == 'USULKAN JUDUL ULANG' || $skripsi->status_skripsi == 'DAFTAR SEMPRO ULANG' || $skripsi->status_skripsi == 'DAFTAR SIDANG ULANG' || $skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK' || $skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI DITOLAK' || $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK' )
            <td class="text-center text-danger">{{$skripsi->keterangan}}</td>
            @else   
            <td class="text-center">{{$skripsi->keterangan}}</td>
            @endif 


            <!-- USUL JUDUL  -->
            @if ($skripsi->status_skripsi == 'USULAN JUDUL'|| $skripsi->status_skripsi == 'JUDUL DISETUJUI'  )
            <td class="text-center">
            
                <a href="/usuljudul/detail/{{($skripsi->id)}}" class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>

            </td>
            @endif

           <!-- DAFTAR SEMPRO -->
           @if ($skripsi->status_skripsi == 'DAFTAR SEMPRO' || $skripsi->status_skripsi == 'SEMPRO DIJADWALKAN'|| $skripsi->status_skripsi == 'SEMPRO SELESAI' || $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI') 
            <td class="text-center">
          <a href="/daftar-sempro/detail/{{($skripsi->id)}}" class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>
     @endif
            
            <!-- DAFTAR SIDANG -->
            @if ($skripsi->status_skripsi == 'DAFTAR SIDANG'  || $skripsi->status_skripsi == 'DAFTAR SIDANG ULANG' || $skripsi->status_skripsi == 'SIDANG DIJADWALKAN' || $skripsi->status_skripsi == 'SIDANG SELESAI' || $skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI') 

           <td class="text-center">
          <a href="/daftar-sidang/detail/{{($skripsi->id)}}" class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>
@endif
            @if ($skripsi->status_skripsi == 'PERPANJANGAN 1' || $skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK' || $skripsi->status_skripsi == 'PERPANJANGAN 1 DISETUJUI' ) 

           <td class="text-center">
          <a href="/perpanjangan-1/detail/{{($skripsi->id)}}" class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>
@endif
            @if ($skripsi->status_skripsi == 'PERPANJANGAN 2' || $skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK' || $skripsi->status_skripsi == 'PERPANJANGAN 2 DISETUJUI' ) 

           <td class="text-center">
          <a href="/perpanjangan-2/detail/{{($skripsi->id)}}" class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>
@endif
            @if ($skripsi->status_skripsi == 'PERPANJANGAN REVISI' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI DITOLAK' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI' ) 

           <td class="text-center">
          <a href="/perpanjangan-revisi/detail/{{($skripsi->id)}}" class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>
@endif
            @if ($skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI' || $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK' || $skripsi->status_skripsi == 'SKRIPSI SELESAI' ) 

           <td class="text-center">
          <a href="/bukti-buku-skripsi/detail/{{($skripsi->id)}}" class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>
@endif


    @endforeach
  </tbody>


</table>
</div>
</div>


@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const waitingApprovalCount = {!! json_encode($jml_prodi_skripsi) !!};
    if (waitingApprovalCount > 0) {
        Swal.fire({
            title: 'Ini adalah halaman Skripsi',
            html: `Ada <strong class="text-info"> ${waitingApprovalCount} Mahasiswa</strong> yang melaksanakan Skripsi.`,
            icon: 'info',
            showConfirmButton: true,
            confirmButtonColor: '#28a745',
        });
    } else {
        Swal.fire({
            title: 'Ini adalah halaman Skripsi',
            html: `Belum ada mahasiswa yang melaksanakan Skripsi.`,
            icon: 'info',
            showConfirmButton: true,
            confirmButtonColor: '#28a745',
        });
    }
});
</script>
@endpush()