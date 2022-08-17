@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Penilaian Skripsi | SIA ELEKTRO
@endsection

@section('sub-title')
    Penilaian Sidang Skripsi
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif

<ol class="breadcrumb col-lg-3">
  <li class="breadcrumb-item"><a class="breadcrumb-item active" href="/penilaian-skripsi">Hari Ini</a></li>
  <li class="breadcrumb-item"><a href="#">Bulan Ini</a></li>  
  <li class="breadcrumb-item"><a href="/riwayat-penilaian-skripsi">Riwayat Penilaian</a></li>  
</ol>

<table class="table text-center table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">NIM</th>
      <th scope="col">Nama</th>
      <th scope="col">Seminar</th>
      <th scope="col">Tanggal</th>
      <th scope="col">Waktu</th>
      <th scope="col">Lokasi</th>              
      <th scope="col">Pembimbing</th>
      <th scope="col">Penguji</th>          
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>    
    @foreach ($penjadwalan_skripsis as $skripsi)    
        <tr>
          <td>{{$loop->iteration}}</td>          
          <td>{{$skripsi->mahasiswa->nim}}</td>
          <td>{{$skripsi->mahasiswa->nama}}</td>                   
          <td>{{$skripsi->jenis_seminar}}</td>                   
          <td>{{Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y')}}</td>                   
          <td>{{$skripsi->waktu}}</td>                   
          <td>{{$skripsi->lokasi}}</td>               
          <td>
            <p>{{$skripsi->pembimbingsatu->nama}}</p>
            @if ($skripsi->pembimbingdua == !null)
            <p>{{$skripsi->pembimbingdua->nama}}</p>                               
            @endif
          </td>         
          <td>
            <p>{{$skripsi->pengujisatu->nama}}</p>
            <p>{{$skripsi->pengujidua->nama}}</p>
            <p>{{$skripsi->pengujitiga->nama}}</p>
          </td>
          <td>
            @if ($skripsi->penilaian(Auth::user()->nip, $skripsi->id) == false)
              @if (Carbon::now() >= $skripsi->tanggal && Carbon::now()->format('H:i:m') >= $skripsi->waktu)
              <a href="/penilaian-skripsi/create/{{$skripsi->id}}" class="badge bg-primary"> Input Nilai<a>          
              @else
              <span class="badge bg-danger">Belum Dimulai</span>
              @endif
            @else
              <a href="/penilaian-skripsi/edit/{{$skripsi->id}}" class="badge bg-warning"> Edit Nilai<a>              
            @endif              
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