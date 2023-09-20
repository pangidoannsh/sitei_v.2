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
<div class="swal" data-swal="{{session('message')}}"></div>
@endif 

<ol class="breadcrumb col-lg-12">
  <li class="breadcrumb-item"><a class="breadcrumb-item active" href="/penilaian-skripsi">Hari Ini</a></li>
  <li class="breadcrumb-item"><a href="#">Bulan Ini</a></li>  
  <li class="breadcrumb-item"><a href="/riwayat-penilaian-skripsi">Riwayat Penilaian</a></li>  
</ol>

<table class="table text-center table-bordered table-striped" id="datatables">
  <thead class="table-dark">
    <tr>
      <th class="text-center" scope="col">#</th>
      <th class="text-center" scope="col">NIM</th>
      <th class="text-center" scope="col">Nama</th>
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
    @foreach ($penjadwalan_skripsis as $skripsi)    
        <tr>
          <td>{{$loop->iteration}}</td>          
          <td>{{$skripsi->nim}}</td>                             
          <td>{{$skripsi->nama}}</td>                     
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
            @if ($skripsi->pengujitiga == !null)
            <p>3. {{$skripsi->pengujitiga->nama}}</p>
            @endif
          </td>
          <td>
            @if ($skripsi->penilaian(Auth::user()->nip, $skripsi->id) == false)
              @if (Carbon::now() >= $skripsi->tanggal && Carbon::now()->format('H:i:m') >= $skripsi->waktu)
              <a href="/penilaian-skripsi/create/{{$skripsi->id}}" class="badge bg-primary"style="border-radius:20px; padding:7px;"> Input Nilai<a>          
              @else
              <span class="badge bg-danger"style="border-radius:20px; padding:7px;">Belum Dimulai</span>
              @endif
            @else
              <a href="/penilaian-skripsi/edit/{{$skripsi->id}}" class="badge bg-warning"style="border-radius:20px; padding:7px;"> Edit Nilai<a>              
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