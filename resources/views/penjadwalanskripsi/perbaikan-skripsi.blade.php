@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    Perbaikan Sidang | SIA ELEKTRO
@endsection

@section('sub-title')
    Perbaikan Sidang Skripsi
@endsection

@section('content')

<div>
    <div class="row">
        <div class="col">
        <ol class="list-group" style="box-shadow: 2px 2px 2px 2px #dbdbdb; border-radius:10px;">
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">NIM</div>
            <span>{{$penjadwalan->mahasiswa->nim}}</span>         
            </div>        
        </li> 
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">Nama</div> 
            <span>{{$penjadwalan->mahasiswa->nama}}</span>            
            </div>        
        </li>
        </ol>
        </div>
        <div class="col">
        <ol class="list-group" style="box-shadow: 2px 2px 2px 2px #dbdbdb; border-radius:10px;">
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold mb-2">Pembimbing</div>
                <span>1. {{$penjadwalan->pembimbingsatu->nama}}</span>
                <br>
                @if ($penjadwalan->pembimbingdua_nip != null)
                <span>2. {{$penjadwalan->pembimbingdua->nama}}</span>
                @endif                
            </div>        
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold mb-2">Penguji</div>
                <span>1. {{$penjadwalan->pengujisatu->nama}}</span>
                <br>
                <span>2. {{$penjadwalan->pengujidua->nama}}</span>
                <br>
                <span>3. {{$penjadwalan->pengujitiga->nama}}</span>
            </div>        
        </li>     
        </ol>
        </div>
    </div>
</div>

<div class="kol-judul mt-3">
    <div class="row">
        <div class="col">
        <ol class="list-group" style="box-shadow: 2px 2px 2px 2px #dbdbdb; border-radius:10px;">
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">Judul</div>
            <span>{{$penjadwalan->judul_skripsi}}</span>
            </div>        
        </li>   
        </ol>
        </div>
    </div>
</div>

<div class="kol-jadwal mt-3 mb-3">
    <div class="row">
        <div class="col">
        <ol class="list-group" style="box-shadow: 2px 2px 2px 2px #dbdbdb; border-radius:10px;">
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">Jadwal</div>
            <span>{{Carbon::parse($penjadwalan->tanggal)->translatedFormat('l, d F Y')}}, : {{$penjadwalan->waktu}}</span>             
            </div>        
        </li>   
        </ol>
        </div>
        <div class="col">
        <ol class="list-group" style="box-shadow: 2px 2px 2px 2px #dbdbdb; border-radius:10px;">
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">Lokasi</div>
            <span>{{$penjadwalan->lokasi}}</span>    
            </div>        
        </li>   
        </ol>
        </div>
    </div>
</div>

<div class="card-body bg-white">
    <div class="row">
        <div class="col">
        <table class="table table-bordered">
        <thead class="bg-success">
            <tr>
                <th style="width: 50px">#</th>
                <th style="width: 700px">Saran dan Perbaikan</th>                     
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{$penilaianpenguji->revisi_naskah1}}</td>                
            </tr>
            <tr>
                <td>2</td>
                <td>{{$penilaianpenguji->revisi_naskah2}}</td>                
            </tr>  
            <tr>
                <td>3</td>
                <td>{{$penilaianpenguji->revisi_naskah3}}</td>                
            </tr>  
            <tr>
                <td>4</td>
                <td>{{$penilaianpenguji->revisi_naskah4}}</td>                
            </tr>  
            <tr>
                <td>5</td>
                <td>{{$penilaianpenguji->revisi_naskah5}}</td>                
            </tr>             
        </tbody>
    </table>
        </div>
    </div>
</div>

@endsection   