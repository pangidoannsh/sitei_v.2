@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('content')

<div class="row mb-5">

    <div class="col-6">
        <ol class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">NIM</div>
            <span>{{$penjadwalan->nim}}</span>         
            </div>        
        </li> 
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">Nama</div> 
            <span>{{$penjadwalan->nama}}</span>            
            </div>        
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">Judul</div>
            <span>{{$penjadwalan->judul_skripsi}}</span>
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
        <ol class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold mb-2">Pembimbing</div>
                <span>1. {{$penjadwalan->pembimbingsatu->nama}}</span>
                <br>
                @if ($penjadwalan->pembimbingdua_nip != null)
                <span>{{$penjadwalan->pembimbingdua->nama}}</span>
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

<div> 
    @if ($penilaianpenguji != null)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 100px">#</th>
                    <th style="width: 700px">Aspek Penilaian Penguji</th>
                    <th class="bg-danger" style="width: 30px">B</th>
                    <th>Nilai Penguji</th>                        
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>  
                    <td>Presentasi</td>
                    <td class="bg-secondary">2</td>
                    <td>{{$penilaianpenguji->presentasi}}</td>                        
                </tr>
                <tr>
                    <td>2</td> 
                    <td>Tingkat Penguasaan Materi</td>
                    <td class="bg-secondary">3</td>
                    <td>{{$penilaianpenguji->tingkat_penguasaan_materi}}</td>                        
                </tr>
                <tr>
                    <td>3</td>
                    <td>Keaslian</td>
                    <td class="bg-secondary">2</td>
                    <td>{{$penilaianpenguji->keaslian}}</td>                                                                      
                </tr>
                <tr>
                    <td>4</td> 
                    <td>Ketepatan Metodologi</td>
                    <td class="bg-secondary">4</td>
                    <td>{{$penilaianpenguji->ketepatan_metodologi}}</td>                                          
                </tr>
                <tr>
                    <td>5</td> 
                    <td>Penguasaan Dasar Teori</td>
                    <td class="bg-secondary">4</td>
                    <td>{{$penilaianpenguji->penguasaan_dasar_teori}}</td>                                       
                </tr>
                <tr>
                    <td>6</td>       
                    <td>Kecermatan Perumusan Masalah</td>
                    <td class="bg-secondary">3</td>
                    <td>{{$penilaianpenguji->kecermatan_perumusan_masalah}}</td>          
                </tr>
                <tr>
                    <td>7</td>        
                    <td>Tinjauan Pustaka</td>
                    <td class="bg-secondary">3</td>
                    <td>{{$penilaianpenguji->tinjauan_pustaka}}</td>                        
                </tr>
                <tr>
                    <td>8</td>
                    <td>Tata Tulis</td>
                    <td class="bg-secondary">2</td>
                    <td>{{$penilaianpenguji->tata_tulis}}</td>                                                                      
                </tr>
                <tr>
                    <td>9</td>
                    <td>Tools Yang Digunakan</td>
                    <td class="bg-secondary">2</td>
                    <td>{{$penilaianpenguji->tools}}</td>                                                                      
                </tr>
                <tr>
                    <td>10</td>
                    <td>Penyajian Data</td>
                    <td class="bg-secondary">3</td>
                    <td>{{$penilaianpenguji->penyajian_data}}</td>                                                                      
                </tr>
                <tr>
                    <td>11</td>
                    <td>Hasil</td>
                    <td class="bg-secondary">4</td>
                    <td>{{$penilaianpenguji->hasil}}</td>                                                                      
                </tr>
                <tr>
                    <td>12</td>
                    <td>Pembahasan</td>
                    <td class="bg-secondary">4</td>
                    <td>{{$penilaianpenguji->pembahasan}}</td>                                                                      
                </tr>
                <tr>
                    <td>13</td>
                    <td>Kesimpulan</td>
                    <td class="bg-secondary">3</td>
                    <td>{{$penilaianpenguji->kesimpulan}}</td>                                                                      
                </tr>
                <tr>
                    <td>14</td>
                    <td>Luaran</td>
                    <td class="bg-secondary">3</td>
                    <td>{{$penilaianpenguji->luaran}}</td>                                                                      
                </tr>
                <tr>
                    <td>15</td>
                    <td>Sumbangan Pemikiran Terhadap Ilmu Pengetahuan dan Penerapannya</td>
                    <td class="bg-secondary">3</td>
                    <td>{{$penilaianpenguji->sumbangan_pemikiran}}</td>                                               
                </tr>

                <tr>
                    <td colspan="2">Total Nilai Penguji</td>
                    <td class="bg-danger">45</td>
                    <td class="bg-warning">{{$penilaianpenguji->total_nilai_angka}}</td>                        
                </tr>
                <tr>
                    <td colspan="3">Nilai Huruf Penguji</td>                        
                    <td class="bg-warning">{{$penilaianpenguji->total_nilai_huruf}}</td>                       
                </tr>                    
            </tbody>
        </table>  
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 100px">#</th>
                    <th style="width: 700px">Aspek Penilaian Pembimbing</th>
                    <th class="bg-danger" style="width: 30px">B</th>
                    <th>Nilai Pembimbing</th>                        
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>  
                    <td>Penguasaan Dasar Teori</td>
                    <td class="bg-secondary">10</td>
                    <td>{{$penilaianpembimbing->penguasaan_dasar_teori}}</td>                        
                </tr>
                <tr>
                    <td>2</td> 
                    <td>Tingkat Penguasaan Materi</td>
                    <td class="bg-secondary">10</td>
                    <td>{{$penilaianpembimbing->tingkat_penguasaan_materi}}</td>                        
                </tr>
                <tr>
                    <td>3</td>
                    <td>Tinjauan Pustaka</td>
                    <td class="bg-secondary">9</td>
                    <td>{{$penilaianpembimbing->tinjauan_pustaka}}</td>                                                                      
                </tr>
                <tr>
                    <td>4</td> 
                    <td>Tata Tulis</td>
                    <td class="bg-secondary">8</td>
                    <td>{{$penilaianpembimbing->tata_tulis}}</td>                                          
                </tr>
                <tr>
                    <td>4</td> 
                    <td>Hasil dan Pembahasan</td>
                    <td class="bg-secondary">10</td>
                    <td>{{$penilaianpembimbing->hasil_dan_pembahasan}}</td>                                          
                </tr>
                <tr>
                    <td>6</td> 
                    <td>Sikap dan Kepribadian Ketika Bimbingan</td>
                    <td class="bg-secondary">8</td>
                    <td>{{$penilaianpembimbing->sikap_dan_kepribadian}}</td>                                       
                </tr>            

                <tr>
                    <td colspan="2">Total Nilai Pembimbing</td>
                    <td class="bg-danger">55</td>
                    <td class="bg-warning">{{$penilaianpembimbing->total_nilai_angka}}</td>                        
                </tr>
                <tr>
                    <td colspan="3">Nilai Huruf Pembimbing</td>                        
                    <td class="bg-warning">{{$penilaianpembimbing->total_nilai_huruf}}</td>                       
                </tr>                    
            </tbody>
        </table> 
    @endif            
</div>
@endsection   