@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Kerja Praktek | SIA ELEKTRO
@endsection

@section('sub-title')
    Pendaftaran Kerja Praktek
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif

<div class="container card p-4">
<ol class="breadcrumb col-lg-12">
 
<div class="btn-group scrollable-btn-group col-lg-12">
  @if (Str::length(Auth::guard('web')->user()) > 0)
   @if (Auth::guard('web')->user()->role_id == 2 || Auth::guard('web')->user()->role_id == 3 || Auth::guard('web')->user()->role_id == 4 )
<a href="/persetujuan/admin/index" class="btn bg-light  border  border-bottom-0 " style="border-top-left-radius: 40%; border-top : 2px;">Persetujuan</a>
@endif
@endif
  <a href="/kerja-praktek/admin/index"  class="btn bg-light  border  border-bottom-0 " >Kerja Praktek</a>
  <a href="/sempro/admin/index"  class="btn btn-outline-success  border  border-bottom-0  active" >Sempro</a>
  <a href="/sidang/admin/index" class="btn bg-light  border  border-bottom-0 "style="border-top-right-radius: 40%;">Skripsi</a>

</div>

</ol>

<div class="container-fluid">

          <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatables">
  <thead class="table-dark">
    <tr>      
        <th class="text-center" scope="col">No.</th>
        <th class="text-center" scope="col">NIM</th>
        <th class="text-center" scope="col">Nama</th>
        <th class="text-center" scope="col">Konsentrasi</th>
        <th class="text-center" scope="col">Angkatan</th>     
        <th class="text-center" scope="col">Jenis Usulan</th>
        <th class="text-center" scope="col">Status KP</th>
        <th class="text-center" scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($pendaftaran_skripsi as $skripsi)
<div></div>
        <tr>        
            <td class="text-center">{{$loop->iteration}}</td>                             
            <td class="text-center">{{$skripsi->mahasiswa->nim}}</td>                             
            <td class="text-center">{{$skripsi->mahasiswa->nama}}</td>
            <td class="text-center">{{$skripsi->konsentrasi->nama_konsentrasi}}</td>                   
            <td class="text-center">{{$skripsi->mahasiswa->angkatan}}</td>             
            <td class="text-center">{{$skripsi->jenis_usulan}}</td>             
            
            <td class="text-center bg-info">{{$skripsi->status_skripsi}}</td>

            <td class="text-center">
            <a href="/daftar-sempro/detail/ {{($skripsi->id)}}" class="badge bg-success p-2 fas fa-eye" > Lihat Detail</a>
            </td>


        </tr>

    @endforeach
  </tbody>


</table>
</div>
</div>


@endsection

