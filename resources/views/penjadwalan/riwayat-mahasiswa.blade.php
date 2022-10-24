@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    Riwayat Mahasiswa | SIA ELEKTRO
@endsection

@section('sub-title')
    Riwayat Mahasiswa
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif

<table class="table table-bordered table-striped" id="datatables">
  <thead class="table-dark">
    <tr>
      <th scope="col">NIM</th>
      <th scope="col">Nama</th>
      <th scope="col">Seminar</th>
      <th scope="col">Prodi</th>
      <th scope="col">Tanggal</th>
      <th scope="col">Waktu</th>
      <th scope="col">Lokasi</th>              
      <th scope="col">Pembimbing</th>
      <th scope="col">Penguji</th>          
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($penjadwalan_kps as $kp)
        <tr>
          <td>{{$kp->mahasiswa->nim}}</td>                             
          <td>{{$kp->mahasiswa->nama}}</td>                     
          <td class="bg-primary">{{$kp->jenis_seminar}}</td>                     
          <td>{{$kp->prodi->nama_prodi}}</td>          
          <td>{{Carbon::parse($kp->tanggal)->translatedFormat('l, d F Y')}}</td>                   
          <td>{{$kp->waktu}}</td>                   
          <td>{{$kp->lokasi}}</td>                   
          <td>
            <p>{{$kp->pembimbing->nama}}</p>            
          </td> 
          <td>
            <p>{{$kp->penguji->nama}}</p>            
          </td>               
          <td>                        
            <a href="/perbaikan-pengujikp/{{$kp->id}}/{{$kp->penguji->nip}}" class="badge bg-info p-2"style="border-radius:20px;">Perbaikan Penguji</a>      
          </td>        
        </tr>
    @endforeach
    
    @foreach ($penjadwalan_sempros as $sempro)
      <tr>
        <td>{{$sempro->mahasiswa->nim}}</td>                             
        <td>{{$sempro->mahasiswa->nama}}</td>                     
        <td class="bg-success">{{$sempro->jenis_seminar}}</td>                     
        <td>{{$sempro->prodi->nama_prodi}}</td>          
        <td>{{Carbon::parse($sempro->tanggal)->translatedFormat('l, d F Y')}}</td>                   
        <td>{{$sempro->waktu}}</td>                   
        <td>{{$sempro->lokasi}}</td>                   
        <td>
          <p>1. {{$sempro->pembimbingsatu->nama}}</p>
          @if ($sempro->pembimbingdua == !null)
          <p>2. {{$sempro->pembimbingdua->nama}}</p>                               
          @endif
        </td> 
        <td>
          <p>1. {{$sempro->pengujisatu->nama}}</p>
          <p>2. {{$sempro->pengujidua->nama}}</p>
          <p>3. {{$sempro->pengujitiga->nama}}</p>
        </td>          
        <td>        
          <a href="/perbaikan-pengujisempro/{{$sempro->id}}/{{$sempro->pengujisatu->nip}}" class="badge bg-success">Perbaikan Penguji 1</a>
          <a href="/perbaikan-pengujisempro/{{$sempro->id}}/{{$sempro->pengujidua->nip}}" class="badge bg-primary">Perbaikan Penguji 2</a>
          <a href="/perbaikan-pengujisempro/{{$sempro->id}}/{{$sempro->pengujitiga->nip}}" class="badge bg-warning">Perbaikan Penguji 3</a>                         
        </td>                       
      </tr>
    @endforeach

    @foreach ($penjadwalan_skripsis as $skripsi)
      <tr>
        <td>{{$skripsi->mahasiswa->nim}}</td>                             
        <td>{{$skripsi->mahasiswa->nama}}</td>                     
        <td class="bg-warning">{{$skripsi->jenis_seminar}}</td>                     
        <td>{{$skripsi->prodi->nama_prodi}}</td>          
        <td>{{Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y')}}</td>                   
        <td>{{$skripsi->waktu}}</td>                   
        <td>{{$skripsi->lokasi}}</td>                   
        <td>
          <p>1. {{$skripsi->pembimbingsatu->nama}}</p>
          @if ($skripsi->pembimbingdua == !null)
          <p>2. {{$skripsi->pembimbingdua->nama}}</p>                               
          @endif
        </td> 
        <td>
          <p>1. {{$skripsi->pengujisatu->nama}}</p>
          <p>2. {{$skripsi->pengujidua->nama}}</p>
          <p>3. {{$skripsi->pengujitiga->nama}}</p>
        </td>          
        <td>        
          <a href="/perbaikan-pengujiskripsi/{{$skripsi->id}}/{{$skripsi->pengujisatu->nip}}" class="badge bg-success">Perbaikan Penguji 1</a>
          <a href="/perbaikan-pengujiskripsi/{{$skripsi->id}}/{{$skripsi->pengujidua->nip}}" class="badge bg-primary">Perbaikan Penguji 2</a>
          <a href="/perbaikan-pengujiskripsi/{{$skripsi->id}}/{{$skripsi->pengujitiga->nip}}" class="badge bg-warning">Perbaikan Penguji 3</a>                         
        </td>                       
      </tr>
    @endforeach

  </tbody>
</table>
    
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