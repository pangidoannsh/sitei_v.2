@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Riwayat Seminar Mahasiswa Bimbingan
@endsection

@section('sub-title')
    Riwayat Seminar Mahasiswa Bimbingan
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
     
  <li><a href="/kp-skripsi/seminar-pembimbing-penguji" class="px-1">Seminar (<span>{{ $jml_seminar_kp + $jml_sempro + $jml_sidang }}</span>) </a></li>
  <span class="px-2">|</span>
  <li><a href="/kp-skripsi/pembimbing-penguji/riwayat-seminar" class="breadcrumb-item active fw-bold text-success px-1">Riwayat (<span>{{ $jml_riwayat_kp + $jml_riwayat_sempro + $jml_riwayat_sidang }}</span>)</a></li>
    
 
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

<table class="table table-responsive-lg table-bordered table-striped" style="width:100%" id="datatables2">
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
      <th class="text-center" scope="col">Status</th>          
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
           @if ($kp->status_seminar == 1)
          <td class="text-center">Lulus</td>
          @else
          <td class="text-center">Belum Lulus</td>
         @endif
         
          <td class="text-center">
            
            @if ($kp->penguji_nip == auth()->user()->nip && $kp->pembimbing_nip !== auth()->user()->nip)                    
              <a formtarget="_blank" target="_blank" href="/perbaikan-kp/{{Crypt::encryptString($kp->id)}}" class="badge bg-info mt-1 p-2"style="border-radius:20px;">Perbaikan</a>
              <a formtarget="_blank" target="_blank" href="/nilai-kp/{{Crypt::encryptString($kp->id)}}" class="badge bg-success mt-1 p-2"style="border-radius:20px;">Form Nilai</a>
            
            @elseif ($kp->pembimbing_nip == auth()->user()->nip && $kp->penguji_nip !== auth()->user()->nip )   
              <a formtarget="_blank" target="_blank" href="/perbaikan-pengujikp/{{Crypt::encryptString($kp->id)}}/{{$kp->penguji->nip}}" class="badge bg-info mt-1 p-2"style="border-radius:20px;">Perbaikan Penguji</a>                
              <a formtarget="_blank" target="_blank" href="/nilai-kp/{{Crypt::encryptString($kp->id)}}" class="badge bg-success mt-1 p-2"style="border-radius:20px;">Nilai Penguji</a>               
              <a formtarget="_blank" target="_blank" href="/beritaacara-kp/{{Crypt::encryptString($kp->id)}}" class="badge bg-danger mt-1 p-2"style="border-radius:20px;">Berita Acara</a>
            @elseif ($kp->pembimbing_nip == auth()->user()->nip && $kp->penguji_nip == auth()->user()->nip)   
              <a formtarget="_blank" target="_blank" href="/perbaikan-pengujikp/{{Crypt::encryptString($kp->id)}}/{{$kp->penguji->nip}}" class="badge bg-info mt-1 p-2"style="border-radius:20px;">Perbaikan</a>
              <a formtarget="_blank" target="_blank" href="/nilai-kp/{{Crypt::encryptString($kp->id)}}" class="badge bg-success mt-1 p-2"style="border-radius:20px;">Form Nilai</a>                               
              <a formtarget="_blank" target="_blank" href="/beritaacara-kp/{{Crypt::encryptString($kp->id)}}" class="badge bg-danger mt-1 p-2"style="border-radius:20px;">Berita Acara</a>
            @endif
          </td>                        
        </tr>               
    @endforeach

    @foreach ($penjadwalan_sempros as $sempro)
        <tr>
          <td class="text-center">{{$sempro->mahasiswa->nim}}</td>
          <td class="text-center">{{$sempro->mahasiswa->nama}}</td>                    
          <td class="bg-success text-center">{{$sempro->jenis_seminar}}</td>                                       
          <td class="text-center">{{$sempro->prodi->nama_prodi}}</td>          
          <td class="text-center">{{Carbon::parse($sempro->tanggal)->translatedFormat('l, d F Y')}}</td>                   
          <td class="text-center">{{$sempro->waktu}}</td>                   
          <td class="text-center">{{$sempro->lokasi}}</td>              
          <td class="text-center">
            <p>1. {{$sempro->pembimbingsatu->nama_singkat}}</p>
            @if ($sempro->pembimbingdua == !null)
            <p>2. {{$sempro->pembimbingdua->nama_singkat}}</p>                               
            @endif
          </td>         
          <td class="text-center">
            <p>1. {{$sempro->pengujisatu->nama_singkat}}</p>
            <p>2. {{$sempro->pengujidua->nama_singkat}}</p>
            @if ($sempro->pengujitiga == !null)
            <p>3. {{$sempro->pengujitiga->nama_singkat}}</p>                               
            @endif
          </td>  
           @if ($sempro->status_seminar == 1)
          <td class="text-center">Lulus</td>
          @else
          <td class="text-center">Belum Lulus</td>
         @endif                  
          <td class="text-center">            
            <a formtarget="_blank" target="_blank" href="/nilai-sempro/{{Crypt::encryptString($sempro->id)}}" class="badge bg-success p-2" style="border-radius:20px;">Lihat Nilai</a>

            @if ($sempro->pengujisatu_nip == auth()->user()->nip || $sempro->pengujidua_nip == auth()->user()->nip || $sempro->pengujitiga_nip == auth()->user()->nip)
            <a formtarget="_blank" target="_blank" href="/perbaikan-sempro/{{Crypt::encryptString($sempro->id)}}" class="badge bg-primary p-2 my-1" style="border-radius:20px;">Perbaikan</a>
            @endif

            @if ($sempro->pembimbingsatu_nip == auth()->user()->nip || $sempro->pembimbingdua_nip == auth()->user()->nip)
            <a formtarget="_blank" target="_blank" href="/perbaikan-pengujisempro/{{Crypt::encryptString($sempro->id)}}/{{$sempro->pengujisatu->nip}}" class="badge bg-danger p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 1</a>
            <a formtarget="_blank" target="_blank" href="/perbaikan-pengujisempro/{{Crypt::encryptString($sempro->id)}}/{{$sempro->pengujidua->nip}}" class="badge bg-warning p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 2</a>
            @if ($sempro->pengujitiga == !null)
            <a formtarget="_blank" target="_blank" href="/perbaikan-pengujisempro/{{Crypt::encryptString($sempro->id)}}/{{$sempro->pengujitiga->nip}}" class="badge bg-success p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 3</a>
            @endif
            @endif

            @if ($sempro->pengujisatu_nip == auth()->user()->nip)
              <a formtarget="_blank" target="_blank" href="/penilaian-sempro/beritaacara-sempro/{{Crypt::encryptString($sempro->id)}}" class="badge bg-warning p-2" style="border-radius:20px;">Berita Acara</a> 
            @endif
            
          </td>                        
        </tr>               
    @endforeach

    @foreach ($penjadwalan_skripsis as $skripsi)    
        <tr>                  
          <td class="text-center">{{$skripsi->mahasiswa->nim}}</td>                             
          <td class="text-center">{{$skripsi->mahasiswa->nama}}</td>
          <td class="bg-warning text-center">{{$skripsi->jenis_seminar}}</td>                                     
          <td class="text-center">{{$skripsi->prodi->nama_prodi}}</td>          
          <td class="text-center">{{Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y')}}</td>                   
          <td class="text-center">{{$skripsi->waktu}}</td>                   
          <td class="text-center">{{$skripsi->lokasi}}</td>                
          <td class="text-center">
            <p>1. {{$skripsi->pembimbingsatu->nama_singkat}}</p>
            @if ($skripsi->pembimbingdua == !null)
            <p>2. {{$skripsi->pembimbingdua->nama_singkat}}</p>                               
            @endif
          </td>         
          <td class="text-center">
            <p>1. {{$skripsi->pengujisatu->nama_singkat}}</p>
            <p>2. {{$skripsi->pengujidua->nama_singkat}}</p>
            @if ($skripsi->pengujitiga == !null)
            <p>3. {{$skripsi->pengujitiga->nama_singkat}}</p>
            @endif
          </td>   
           @if ($skripsi->status_seminar == 3)
          <td class="text-center">Lulus</td>
          @else
          <td class="text-center">Belum Lulus</td>
         @endif                 
          <td class="text-center">            
            <a formtarget="_blank" target="_blank" href="/nilai-skripsi/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-success p-2" style="border-radius:20px;">Lihat Nilai</a>
            @if ($skripsi->pengujisatu_nip == auth()->user()->nip || $skripsi->pengujidua_nip == auth()->user()->nip || $skripsi->pengujitiga_nip == auth()->user()->nip)
              <a formtarget="_blank" target="_blank" href="/perbaikan-skripsi/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-primary p-2 my-1" style="border-radius:20px;">Perbaikan</a>
            @endif

            @if ($skripsi->pembimbingsatu_nip == auth()->user()->nip || $skripsi->pembimbingdua_nip == auth()->user()->nip)
            <a formtarget="_blank" target="_blank" href="/perbaikan-pengujiskripsi/{{Crypt::encryptString($skripsi->id)}}/{{$skripsi->pengujisatu->nip}}" class="badge bg-danger p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 1</a>
            <a formtarget="_blank" target="_blank" href="/perbaikan-pengujiskripsi/{{Crypt::encryptString($skripsi->id)}}/{{$skripsi->pengujidua->nip}}" class="badge bg-warning p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 2</a>
            @if ($skripsi->pengujitiga == !null)
            <a formtarget="_blank" target="_blank" href="/perbaikan-pengujiskripsi/{{Crypt::encryptString($skripsi->id)}}/{{$skripsi->pengujitiga->nip}}" class="badge bg-success p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 3</a>
            @endif
            @endif

            @if ($skripsi->pengujisatu_nip == auth()->user()->nip)
              <a formtarget="_blank" target="_blank" href="/penilaian-skripsi/beritaacara-skripsi/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-warning p-2" style="border-radius:20px;">Berita Acara</a> 
            @endif
          </td>                        
        </tr>               
    @endforeach

    @foreach ($penjadwalan_skripsis_draf as $skripsi)    
        <tr>                  
          <td class="text-center">{{$skripsi->mahasiswa->nim}}</td>                             
          <td class="text-center">{{$skripsi->mahasiswa->nama}}</td>
          <td class="bg-warning text-center">{{$skripsi->jenis_seminar}}</td>                                     
          <td class="text-center">{{$skripsi->prodi->nama_prodi}}</td>          
          <td class="text-center">{{Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y')}}</td>                   
          <td class="text-center">{{$skripsi->waktu}}</td>                   
          <td class="text-center">{{$skripsi->lokasi}}</td>                
          <td class="text-center">
            <p>1. {{$skripsi->pembimbingsatu->nama_singkat}}</p>
            @if ($skripsi->pembimbingdua == !null)
            <p>2. {{$skripsi->pembimbingdua->nama_singkat}}</p>                               
            @endif
          </td>         
          <td class="text-center">
            <p>1. {{$skripsi->pengujisatu->nama_singkat}}</p>
            <p>2. {{$skripsi->pengujidua->nama_singkat}}</p>
            @if ($skripsi->pengujitiga == !null)
            <p>3. {{$skripsi->pengujitiga->nama_singkat}}</p>
            @endif
          </td>                    
          <td class="text-center">                                    
            <a href="/penilaian-skripsi/draft-ba/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-success p-2"style="border-radius:20px;">Draft BA</a>
          </td>                        
        </tr>               
    @endforeach

    @foreach ($penjadwalan_skripsis_draff as $skripsi)    
        <tr>                  
          <td class="text-center">{{$skripsi->mahasiswa->nim}}</td>                             
          <td class="text-center">{{$skripsi->mahasiswa->nama}}</td>
          <td class="bg-warning text-center">{{$skripsi->jenis_seminar}}</td>                                     
          <td class="text-center">{{$skripsi->prodi->nama_prodi}}</td>          
          <td class="text-center">{{Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y')}}</td>                   
          <td class="text-center">{{$skripsi->waktu}}</td>                   
          <td class="text-center">{{$skripsi->lokasi}}</td>                
          <td class="text-center">
            <p>{{$skripsi->pembimbingsatu->nama_singkat}}</p>
            @if ($skripsi->pembimbingdua == !null)
            <p>{{$skripsi->pembimbingdua->nama_singkat}}</p>                               
            @endif
          </td>         
          <td class="text-center">
            <p>{{$skripsi->pengujisatu->nama_singkat}}</p>
            <p>{{$skripsi->pengujidua->nama_singkat}}</p>
            @if ($skripsi->pengujitiga == !null)
            <p>{{$skripsi->pengujitiga->nama_singkat}}</p>
            @endif
          </td>                    
          <td class="text-center">                                    
            <a href="/penilaian-skripsi/draft-ba/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-success p-2"style="border-radius:20px;">Draft BA</a>
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
    const waitingApprovalCount = {!! json_encode($jml_riwayat_sidang + $jml_riwayat_sempro + $jml_riwayat_kp ) !!};
    if (waitingApprovalCount > 0) {
        Swal.fire({
            title: 'Ini adalah halaman Riwayat Seminar Pembimbing dan Penguji',
            html: `Ada <strong class="text-info"> ${waitingApprovalCount} Mahasiswa</strong> telah selesai melaksanakan seminar.`,
            icon: 'info',
            showConfirmButton: true,
            confirmButtonColor: '#28a745',
        });
    } else {
        Swal.fire({
            title: 'Ini adalah halaman Riwayat Seminar Pembimbing dan Penguji',
            html: `Belum ada mahasiswa selesai seminar.`,
            icon: 'info',
            showConfirmButton: true,
            confirmButtonColor: '#28a745',
        });
    }
});
</script>
@endpush()

