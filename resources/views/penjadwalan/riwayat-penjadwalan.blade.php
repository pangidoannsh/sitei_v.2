@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Riwayat Penjadwalan Seminar
@endsection

@section('sub-title')
    Riwayat Penjadwalan Seminar
@endsection

@section('content')

<div class="container card p-4">

<ol class="breadcrumb col-lg-12">   
  
  <li><a href="/form" class="px-1">Jadwal (<span>{{ $jml_seminar_kp + $jml_sempro + $jml_sidang }}</span>)</a></li>

  <span class="px-2">|</span>      
  <li><a href="/riwayat-penjadwalan" class="breadcrumb-item active fw-bold text-success px-1">Riwayat Penjadwalan (<span>{{ $jml_riwayat_seminar_kp + $jml_riwayat_sempro + $jml_riwayat_sidang }}</span>)</a></li>
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
      @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)         
      <th class="text-center" scope="col">Aksi</th>
      @endif
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
          @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)      
          <td class="text-center">                        
            <a formtarget="_blank" target="_blank" href="/perbaikan-pengujikp/{{Crypt::encryptString($kp->id)}}/{{$kp->penguji->nip}}" class="badge bg-info p-2"style="border-radius:20px;">Perbaikan Penguji</a>           
            <a formtarget="_blank" target="_blank" href="/nilai-kp/{{Crypt::encryptString($kp->id)}}" class="badge bg-success mt-2 p-2"style="border-radius:20px;">Nilai Penguji</a>                  
            <a formtarget="_blank" target="_blank" href="/beritaacara-kp/{{Crypt::encryptString($kp->id)}}" class="badge bg-danger mt-2 p-2"style="border-radius:20px;">Berita Acara</a>
          </td>
          @elseif(auth()->user()->role_id == 1)      
          <td class="text-center"> 
            <a formtarget="_blank" target="_blank" href="/beritaacara-kp/{{Crypt::encryptString($kp->id)}}" class="badge bg-danger mt-2 p-2"style="border-radius:20px;">Berita Acara</a>
          </td>
          @endif                     
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
          @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)
          <td class="text-center">              
            <a formtarget="_blank" target="_blank" href="/nilai-sempro-pembimbing/{{Crypt::encryptString($sempro->id)}}/{{ $sempro->pembimbingsatu->nip }}" class="badge bg-primary p-2" style="border-radius:20px;">Nilai Pembimbing 1</a>
            @if ($sempro->pembimbingdua == !null)
            <a formtarget="_blank" target="_blank" href="/nilai-sempro-pembimbing/{{Crypt::encryptString($sempro->id)}}/{{ $sempro->pembimbingdua->nip }}" class="badge bg-info p-2 mt-1" style="border-radius:20px;">Nilai Pembimbing 2</a>                               
            @endif
            <a formtarget="_blank" target="_blank" href="/nilai-sempro-penguji/{{Crypt::encryptString($sempro->id)}}/{{ $sempro->pengujisatu->nip }}" class="badge bg-danger p-2 mt-1" style="border-radius:20px;">Nilai Penguji 1</a>          
            <a formtarget="_blank" target="_blank" href="/nilai-sempro-penguji/{{Crypt::encryptString($sempro->id)}}/{{ $sempro->pengujidua->nip }}" class="badge bg-warning p-2 mt-1" style="border-radius:20px;">Nilai Penguji 2</a>
            @if ($sempro->pengujitiga == !null)          
            <a formtarget="_blank" target="_blank" href="/nilai-sempro-penguji/{{Crypt::encryptString($sempro->id)}}/{{ $sempro->pengujitiga->nip }}" class="badge bg-success p-2 mt-1" style="border-radius:20px;">Nilai Penguji 3</a>
            @endif
            <a formtarget="_blank" target="_blank" href="/perbaikan-pengujisempro/{{Crypt::encryptString($sempro->id)}}/{{$sempro->pengujisatu->nip}}" class="badge bg-danger p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 1</a>
            <a formtarget="_blank" target="_blank" href="/perbaikan-pengujisempro/{{Crypt::encryptString($sempro->id)}}/{{$sempro->pengujidua->nip}}" class="badge bg-warning p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 2</a>
            @if ($sempro->pengujitiga == !null)
            <a formtarget="_blank" target="_blank" href="/perbaikan-pengujisempro/{{Crypt::encryptString($sempro->id)}}/{{$sempro->pengujitiga->nip}}" class="badge bg-success p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 3</a>
            @endif     
            <a formtarget="_blank" target="_blank" href="/penilaian-sempro/beritaacara-sempro/{{Crypt::encryptString($sempro->id)}}" class="badge bg-primary p-2 mt-1" style="border-radius:20px;">Berita Acara</a>
            @if ($sempro->revisi_proposal == !null)
            <a formtarget="_blank" target="_blank" href="/penilaian-sempro/riwayat-judul/{{Crypt::encryptString($sempro->id)}}" class="badge bg-warning p-2 mt-1" style="border-radius:20px;">Revisi Judul</a>
            @endif
          </td>                       
          @elseif(auth()->user()->role_id == 1)
          <td class="text-center">
            <a formtarget="_blank" target="_blank" href="/penilaian-sempro/beritaacara-sempro/{{Crypt::encryptString($sempro->id)}}" class="badge bg-primary p-2 mt-1" style="border-radius:20px;">Berita Acara</a>
          </td>                       
          @endif
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
          @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)
          <td class="text-center">              
            <a formtarget="_blank" target="_blank" href="/nilai-skripsi-pembimbing/{{Crypt::encryptString($skripsi->id)}}/{{ $skripsi->pembimbingsatu->nip }}" class="badge bg-primary p-2" style="border-radius:20px;">Nilai Pembimbing 1</a>
            @if ($skripsi->pembimbingdua == !null)
            <a formtarget="_blank" target="_blank" href="/nilai-skripsi-pembimbing/{{Crypt::encryptString($skripsi->id)}}/{{ $skripsi->pembimbingdua->nip }}" class="badge bg-info p-2 mt-1" style="border-radius:20px;">Nilai Pembimbing 2</a>                               
            @endif
            <a formtarget="_blank" target="_blank" href="/nilai-skripsi-penguji/{{Crypt::encryptString($skripsi->id)}}/{{ $skripsi->pengujisatu->nip }}" class="badge bg-danger p-2 mt-1" style="border-radius:20px;">Nilai Penguji 1</a>          
            <a formtarget="_blank" target="_blank" href="/nilai-skripsi-penguji/{{Crypt::encryptString($skripsi->id)}}/{{ $skripsi->pengujidua->nip }}" class="badge bg-warning p-2 mt-1" style="border-radius:20px;">Nilai Penguji 2</a>   
            @if ($skripsi->pengujitiga == !null)       
            <a formtarget="_blank" target="_blank" href="/nilai-skripsi-penguji/{{Crypt::encryptString($skripsi->id)}}/{{ $skripsi->pengujitiga->nip }}" class="badge bg-success p-2 mt-1" style="border-radius:20px;">Nilai Penguji 3</a>
            @endif
            <a formtarget="_blank" target="_blank" href="/perbaikan-pengujiskripsi/{{Crypt::encryptString($skripsi->id)}}/{{$skripsi->pengujisatu->nip}}" class="badge bg-danger p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 1</a>
            <a formtarget="_blank" target="_blank" href="/perbaikan-pengujiskripsi/{{Crypt::encryptString($skripsi->id)}}/{{$skripsi->pengujidua->nip}}" class="badge bg-warning p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 2</a>
            @if ($skripsi->pengujitiga == !null)
            <a formtarget="_blank" target="_blank" href="/perbaikan-pengujiskripsi/{{Crypt::encryptString($skripsi->id)}}/{{$skripsi->pengujitiga->nip}}" class="badge bg-success p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 3</a>         
            @endif
            <a formtarget="_blank" target="_blank" href="/penilaian-skripsi/beritaacara-skripsi/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-primary p-2 mt-1" style="border-radius:20px;">Berita Acara</a>
            @if ($skripsi->revisi_skripsi == !null)
            <a formtarget="_blank" target="_blank" href="/penilaian-skripsi/riwayat-judul/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-warning p-2 mt-1" style="border-radius:20px;">Revisi Judul</a>
            @endif
          </td>                       
          @elseif(auth()->user()->role_id == 1)
          <td class="text-center">              
            <a formtarget="_blank" target="_blank" href="/penilaian-skripsi/beritaacara-skripsi/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-primary p-2 mt-1" style="border-radius:20px;">Berita Acara</a>
          </td>                       
          @endif                    
        </tr>
    @endforeach
  </tbody>
</table>
</div>
    
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const jumlahJadwal = {!! json_encode($jml_riwayat_seminar_kp + $jml_riwayat_sempro + $jml_riwayat_sidang) !!};

    if (jumlahJadwal > 0) {
        Swal.fire({
            title: 'Ini adalah halaman Riwayat Seminar',
            html: `Ada <strong class="text-info"> ${jumlahJadwal} Mahasiswa</strong> telah melaksanakan seminar.`,
            icon: 'info',
            showConfirmButton: true,
            confirmButtonColor: '#28a745',
        });
    } else {
        Swal.fire({
            title: 'Ini adalah halaman Riwayat Seminar',
            html: `Belum ada mahasiswa yang melaksanakan seminar.`,
            icon: 'info',
            showConfirmButton: true,
            confirmButtonColor: '#28a745',
        });
    }
});
</script>
@endpush()