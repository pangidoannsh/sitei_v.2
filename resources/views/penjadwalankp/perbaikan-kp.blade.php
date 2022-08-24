@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    Perbaikan KP | SIA ELEKTRO
@endsection

@section('sub-title')
    Perbaikan Seminar KP
@endsection

@section('content')

<div class="row mb-5">

    <div class="col-6">
        <ol class="list-group" style="box-shadow: 2px 2px 2px 2px #dbdbdb; border-radius:20px;">
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
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">Judul</div>
            <span>{{$penjadwalan->judul_kp}}</span>
            </div>        
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">Jadwal</div>
            <span>{{Carbon::parse($penjadwalan->tanggal)->translatedFormat('l, d F Y')}}, : {{$penjadwalan->waktu}}</span>             
            </div>        
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">Lokasi</div>
            <span>{{$penjadwalan->lokasi}}</span>    
            </div>        
        </li>   
        </ol>
    </div>

    <div class="col-6">
        <ol class="list-group" style="box-shadow: 2px 2px 2px 2px #dbdbdb; border-radius:20px;">
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold mb-2">Penguji</div>
                <span>{{$penilaianpenguji->penguji->nama}}</span>                
            </div>        
        </li>     
        </ol>
    </div>

</div>

<div>    
    <table class="table table-bordered mb-5" style="background-color:white;">
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
@endsection   