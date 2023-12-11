@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    Berita Acara Sidang | SIA ELEKTRO
@endsection

@section('sub-title')
    Berita Acara Sidang Skripsi
@endsection

@section('content')
<div class="container pb-3">
  <a href="/persetujuan-kp-skripsi" class="bg-success p-2 rounded-3"><i class="fas fa-arrow-left fa-xs"></i> Kembali</a>
</div>

<div class="container ">
  <div class="row shadow-sm rounded">
    <div class="bg-white col-lg-4 col-md-12 px-4 py-3 mb-2 rounded-start">
      <h5 class="text-bold">Mahasiswa</h5>
      <hr class="border border-success">
        <p class="card-title text-secondary text-sm " >Nama</p>
        <p class="card-text text-start" >{{$penjadwalan->mahasiswa->nama}}</p>
        <p class="card-title text-secondary text-sm " >NIM</p>
        <p class="card-text text-start" >{{$penjadwalan->mahasiswa->nim}}</p>
        <p class="card-title text-secondary text-sm " >Program Studi</p>
        <p class="card-text text-start" >{{$penjadwalan->mahasiswa->prodi->nama_prodi}}</p>
        <p class="card-title text-secondary text-sm " >Konsentrasi</p>
        <p class="card-text text-start" >{{$penjadwalan->mahasiswa->konsentrasi->nama_konsentrasi}}</p>
    </div>
    <div class="bg-white col-lg-4 col-md-12 px-4 py-3 mb-2">
        <h5 class="text-bold">Dosen Pembimbing</h5>
        <hr class="border border-success">
        @if ($penjadwalan->pembimbingdua == null )
        <p class="card-title text-secondary text-sm" >Nama</p>
        <p class="card-text text-start" >{{$penjadwalan->pembimbingsatu->nama}}</p>


        @elseif($penjadwalan->pembimbingdua !== null)
        <p class="card-title text-secondary text-sm" >Nama Pembimbing 1</p>
        <p class="card-text text-start" >{{$penjadwalan->pembimbingsatu->nama}}</p>

        <p class="card-title text-secondary text-sm" >Nama Pembimbing 2</p>
        <p class="card-text text-start" >{{$penjadwalan->pembimbingdua->nama}}</p>

        @endif
    </div>
    <div class="bg-white col-lg-4 col-md-12 px-4 py-3 mb-2 rounded-end">
        <h5 class="text-bold">Dosen Penguji</h5>
        <hr class="border border-success">
        @if ($penjadwalan->pengujitiga == null )
        <p class="card-title text-secondary text-sm" >Nama Penguji 1</p>
        <p class="card-text text-start" >{{$penjadwalan->pengujisatu->nama}}</p>
        <p class="card-title text-secondary text-sm" >Nama Penguji 2</p>
        <p class="card-text text-start" >{{$penjadwalan->pengujidua->nama}}</p>


        @elseif($penjadwalan->pengujitiga !== null)
        <p class="card-title text-secondary text-sm" >Nama Penguji 1</p>
        <p class="card-text text-start" >{{$penjadwalan->pengujisatu->nama}}</p>
        <p class="card-title text-secondary text-sm" >Nama Penguji 2</p>
        <p class="card-text text-start" >{{$penjadwalan->pengujidua->nama}}</p>
        <p class="card-title text-secondary text-sm" >Nama Penguji 3</p>
        <p class="card-text text-start" >{{$penjadwalan->pengujitiga->nama}}</p>

        @endif
    </div>
  </div>
</div>

<div class="container">
  <div class="row rounded shadow-sm">
    <div class="bg-white col-lg-6 col-md-12 px-4 py-3 mb-2 rounded-start">
      <h5 class="text-bold">Judul Skripsi</h5>
      <hr class="border border-success">
        <p class="card-title text-secondary text-sm " >Judul</p>
        <p class="card-text text-start" >{{ $penjadwalan->revisi_skripsi != null ? $penjadwalan->revisi_skripsi : $penjadwalan->judul_skripsi }}</p>
    </div>
    <div class="bg-white col-lg-6 col-md-12 px-4 py-3 mb-2 rounded-end">
      <h5 class="text-bold">Jadwal Seminar</h5>
      <hr class="border border-success">
        <p class="card-title text-secondary text-sm " >Hari/Tanggal</p>
        <p class="card-text text-start" >{{Carbon::parse($penjadwalan->tanggal)->translatedFormat('l, d F Y')}}, : {{$penjadwalan->waktu}}</p>
        <p class="card-title text-secondary text-sm " >Pukul</p>
        <p class="card-text text-start" >{{$penjadwalan->waktu}}</p>
        <p class="card-title text-secondary text-sm " >Lokasi</p>
        <p class="card-text text-start" >{{$penjadwalan->lokasi}}</p>
    </div>
  </div>
</div>


<!-- <div>
    <div class="row">
        <div class="col mb-3">
        <ol class="list-group" style="box-shadow: 1px 1px 1px 1px #dbdbdb; border-radius:5px;">
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto gridratakiri">
            <div class="fw-bold ">NIM</div>
            <span>{{$penjadwalan->mahasiswa->nim}}</span>         
            </div>        
        </li> 
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto gridratakiri">
            <div class="fw-bold ">Nama</div> 
            <span>{{$penjadwalan->mahasiswa->nama}}</span>            
            </div>        
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto gridratakiri">
            <div class="fw-bold ">Konsentrasi</div> 
            <span>{{$penjadwalan->mahasiswa->konsentrasi->nama_konsentrasi}}</span>            
            </div>        
        </li>
        </ol>
        </div>
        <div class="col-md">
        <ol class="list-group" style="box-shadow: 1px 1px 1px 1px #dbdbdb; border-radius:5px;">
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto gridratakiri">
                <div class="fw-bold ">Pembimbing</div>
                <span>1. {{$penjadwalan->pembimbingsatu->nama}}</span>
                <br>
                @if ($penjadwalan->pembimbingdua_nip != null)
                <span>2. {{$penjadwalan->pembimbingdua->nama}}</span>
                @endif                
            </div>        
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto gridratakiri">
                <div class="fw-bold ">Penguji</div>
                <span>1. {{$penjadwalan->pengujisatu->nama}}</span>
                <br>
                <span>2. {{$penjadwalan->pengujidua->nama}}</span>
                <br>
                @if ($penjadwalan->pengujitiga_nip != null)
                <span>3. {{$penjadwalan->pengujitiga->nama}}</span>
                @endif
            </div>        
        </li>     
        </ol>
        </div>
    </div>
</div>

<div class="kol-judul mt-3">
    <div class="row">
        <div class="col">
        <ol class="list-group" style="box-shadow: 1px 1px 1px 1px #dbdbdb; border-radius:5px;">
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto gridratakiri">
            <div class="fw-bold ">Judul</div>
            <span>{{ $penjadwalan->revisi_skripsi != null ? $penjadwalan->revisi_skripsi : $penjadwalan->judul_skripsi }}</span>
            </div>        
        </li>   
        </ol>
        </div>
    </div>
</div>

<div class="kol-jadwal mt-3 mb-3">
    <div class="row">
        <div class="col mb-3 kol-jadwal">
        <ol class="list-group" style="box-shadow: 1px 1px 1px 1px #dbdbdb; border-radius:5px;">
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto gridratakiri">
            <div class="fw-bold ">Jadwal</div>
            <span>{{Carbon::parse($penjadwalan->tanggal)->translatedFormat('l, d F Y')}}, : {{$penjadwalan->waktu}}</span>             
            </div>        
        </li>   
        </ol>
        </div>
        <div class="col-md">
        <ol class="list-group" style="box-shadow: 1px 1px 1px 1px #dbdbdb; border-radius:5px;">
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto gridratakiri">
            <div class="fw-bold ">Lokasi</div>
            <span>{{$penjadwalan->lokasi}}</span>    
            </div>        
        </li>   
        </ol>
        </div>
    </div>
</div> -->

<div class="card-body bg-white rounded-3 shadow-sm">
    <div class="row">
        <div class="col-lg-6">
            <table class="table table-bordered table-responsive-lg">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="width: 200px">Penilaian Penguji</th>
                        <th class="bg-success text-center" style="width: 30px">B</th>
                        <th>Penguji 1</th>
                        <th>Penguji 2</th>
                        <th>Penguji 3</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                                                    <td>1</td>
                                                    <td>Presentasi</td>
                                                    <td class="bg-secondary text-center">2</td>
                                                    <td class="text-center">{{ $nilaipenguji1 != '' ? $nilaipenguji1->presentasi : '-' }}
                                                    </td>

                                                    <td class="text-center">{{ $nilaipenguji2 != '' ? $nilaipenguji2->presentasi : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji3 != '' ? $nilaipenguji3->presentasi : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Tingkat Penguasaan Materi</td>
                                                    <td class="bg-secondary text-center">3</td>
                                                    <td class="text-center">{{ $nilaipenguji1 != '' ? $nilaipenguji1->tingkat_penguasaan_materi : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji2 != '' ? $nilaipenguji2->tingkat_penguasaan_materi : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji3 != '' ? $nilaipenguji3->tingkat_penguasaan_materi : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Keaslian</td>
                                                    <td class="bg-secondary text-center">2</td>
                                                    <td class="text-center">{{ $nilaipenguji1 != '' ? $nilaipenguji1->keaslian : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji2 != '' ? $nilaipenguji2->keaslian : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji3 != '' ? $nilaipenguji3->keaslian : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Ketepatan Metodologi</td>
                                                    <td class="bg-secondary text-center">4</td>
                                                    <td class="text-center">{{ $nilaipenguji1 != '' ? $nilaipenguji1->ketepatan_metodologi : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji2 != '' ? $nilaipenguji2->ketepatan_metodologi : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji3 != '' ? $nilaipenguji3->ketepatan_metodologi : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Penguasaan Dasar Teori</td>
                                                    <td class="bg-secondary text-center">4</td>
                                                    <td class="text-center">{{ $nilaipenguji1 != '' ? $nilaipenguji1->penguasaan_dasar_teori : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji2 != '' ? $nilaipenguji2->penguasaan_dasar_teori : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji3 != '' ? $nilaipenguji3->penguasaan_dasar_teori : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Kecermatan Perumusan Masalah</td>
                                                    <td class="bg-secondary text-center">3</td>
                                                    <td class="text-center">{{ $nilaipenguji1 != '' ? $nilaipenguji1->kecermatan_perumusan_masalah : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji2 != '' ? $nilaipenguji2->kecermatan_perumusan_masalah : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji3 != '' ? $nilaipenguji3->kecermatan_perumusan_masalah : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td>Tinjauan Pustaka</td>
                                                    <td class="bg-secondary text-center">3</td>
                                                    <td class="text-center">{{ $nilaipenguji1 != '' ? $nilaipenguji1->tinjauan_pustaka : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji2 != '' ? $nilaipenguji2->tinjauan_pustaka : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji3 != '' ? $nilaipenguji3->tinjauan_pustaka : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>8</td>
                                                    <td>Tata Tulis</td>
                                                    <td class="bg-secondary text-center">2</td>
                                                    <td class="text-center">{{ $nilaipenguji1 != '' ? $nilaipenguji1->tata_tulis : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji2 != '' ? $nilaipenguji2->tata_tulis : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji3 != '' ? $nilaipenguji3->tata_tulis : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>9</td>
                                                    <td>Tools Yang Digunakan</td>
                                                    <td class="bg-secondary text-center">2</td>
                                                    <td class="text-center">{{ $nilaipenguji1 != '' ? $nilaipenguji1->tools : '-' }}</td>
                                                    <td class="text-center">{{ $nilaipenguji2 != '' ? $nilaipenguji2->tools : '-' }}</td>
                                                    <td class="text-center">{{ $nilaipenguji3 != '' ? $nilaipenguji3->tools : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>10</td>
                                                    <td>Penyajian Data</td>
                                                    <td class="bg-secondary text-center">3</td>
                                                    <td class="text-center">{{ $nilaipenguji1 != '' ? $nilaipenguji1->penyajian_data : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji2 != '' ? $nilaipenguji2->penyajian_data : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji3 != '' ? $nilaipenguji3->penyajian_data : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>11</td>
                                                    <td>Hasil</td>
                                                    <td class="bg-secondary text-center">4</td>
                                                    <td class="text-center">{{ $nilaipenguji1 != '' ? $nilaipenguji1->hasil : '-' }}</td>
                                                    <td class="text-center">{{ $nilaipenguji2 != '' ? $nilaipenguji2->hasil : '-' }}</td>
                                                    <td class="text-center">{{ $nilaipenguji3 != '' ? $nilaipenguji3->hasil : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>12</td>
                                                    <td>Pembahasan</td>
                                                    <td class="bg-secondary text-center">4</td>
                                                    <td class="text-center">{{ $nilaipenguji1 != '' ? $nilaipenguji1->pembahasan : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji2 != '' ? $nilaipenguji2->pembahasan : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji3 != '' ? $nilaipenguji3->pembahasan : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>13</td>
                                                    <td>Kesimpulan</td>
                                                    <td class="bg-secondary text-center">3</td>
                                                    <td class="text-center">{{ $nilaipenguji1 != '' ? $nilaipenguji1->pembahasan : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji2 != '' ? $nilaipenguji2->pembahasan : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji3 != '' ? $nilaipenguji1->pembahasan : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>14</td>
                                                    <td>Luaran</td>
                                                    <td class="bg-secondary text-center">3</td>
                                                    <td class="text-center">{{ $nilaipenguji1 != '' ? $nilaipenguji1->luaran : '-' }}</td>
                                                    <td class="text-center">{{ $nilaipenguji2 != '' ? $nilaipenguji2->luaran : '-' }}</td>
                                                    <td class="text-center">{{ $nilaipenguji3 != '' ? $nilaipenguji3->luaran : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>15</td>
                                                    <td>Sumbangan Pemikiran Terhadap Ilmu Pengetahuan dan Penerapannya
                                                    </td>
                                                    <td class="bg-secondary text-center">3</td>
                                                    <td class="text-center">{{ $nilaipenguji1 != '' ? $nilaipenguji1->sumbangan_pemikiran : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji2 != '' ? $nilaipenguji2->sumbangan_pemikiran : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji3 != '' ? $nilaipenguji3->sumbangan_pemikiran : '-' }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2">Total Nilai Penguji</td>
                                                    <td class="bg-success text-center">45</td>
                                                    <td class="text-center">{{ $nilaipenguji1 != '' ? $nilaipenguji1->total_nilai_angka : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji2 != '' ? $nilaipenguji2->total_nilai_angka : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji3 != '' ? $nilaipenguji3->total_nilai_angka : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">Nilai Huruf Penguji</td>
                                                    <td class="text-center">{{ $nilaipenguji1 != '' ? $nilaipenguji1->total_nilai_huruf : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji2 != '' ? $nilaipenguji2->total_nilai_huruf : '-' }}
                                                    </td>
                                                    <td class="text-center">{{ $nilaipenguji3 != '' ? $nilaipenguji3->total_nilai_huruf : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                    <tr>                        
                        <td colspan="3">Rata Rata Nilai Penguji</td>
                        <td class="text-center" colspan="3">
                            <h3 class="text-bold">
                            @if ($nilaipenguji1 == '' && $nilaipenguji2 == '' && $nilaipenguji3 == '')
                                          -
                                          @else
                                              <?php
                                                $nilai_masuk=0;
                                                if(!empty($nilaipenguji1)){
                                                  $nilai_masuk=$nilai_masuk+1;
                                                  $penguji1=$nilaipenguji1->total_nilai_angka;
                                                }
                                                else{
                                                  $penguji1=0;
                                                }
                                                if(!empty($nilaipenguji2)){
                                                  $nilai_masuk=$nilai_masuk+1;
                                                  $penguji2=$nilaipenguji2->total_nilai_angka;
                                                }
                                                else{
                                                  $penguji2=0;
                                                }
                                                if(!empty($nilaipenguji3)){
                                                  $nilai_masuk=$nilai_masuk+1;
                                                  $penguji3=$nilaipenguji3->total_nilai_angka;
                                                }
                                                else{
                                                  $penguji3=0;
                                                }
                                                $nilaitotalpenguji=round(($penguji1+$penguji2+$penguji3)/$nilai_masuk);
                                                ?>
                                            {{ $nilaitotalpenguji }}
                                          @endif
                            </h3>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-lg-6">
            <table class="table table-bordered table-responsive-lg">
                <thead>
                <tr>
                    <th>#</th>
                    <th style="width: 200px">Penilaian Pembimbing</th>
                    <th class="bg-success text-center">B</th>
                    <th class="pb text-center">Pembimbing 1</th>
                    <th class="pb text-center">Pembimbing 2</th>                    
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>  
                        <td>Penguasaan Dasar Teori</td>
                        <td class="bg-secondary text-center">10</td>
                        @if ($pembimbing->count() > 1)
                            <td class="nilai1 text-center">{{$nilaipembimbing1->penguasaan_dasar_teori}}</td>                                           
                            <td class="nilai1 text-center">{{$nilaipembimbing2->penguasaan_dasar_teori}}</td>                                           
                        @else
                            <td class="nilai1 text-center">{{$nilaipembimbing1->penguasaan_dasar_teori}}</td>
                            <td class="nilai1 text-center">-</td>
                        @endif                                              
                    </tr>
                    <tr>
                        <td>2</td> 
                        <td>Tingkat Penguasaan Materi</td>
                        <td class="bg-secondary">10</td>
                        @if ($pembimbing->count() > 1)
                            <td class="nilai1 text-center">{{$nilaipembimbing1->tingkat_penguasaan_materi}}</td>      
                            <td class="nilai1 text-center">{{$nilaipembimbing2->tingkat_penguasaan_materi}}</td>
                        @else
                            <td class="nilai1 text-center">{{$nilaipembimbing1->tingkat_penguasaan_materi}}</td>
                            <td class="nilai1 text-center">-</td>
                        @endif                                             
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Tinjauan Pustaka</td>
                        <td class="bg-secondary text-center">9</td>
                        @if ($pembimbing->count() > 1)
                            <td class="nilai1 text-center">{{$nilaipembimbing1->tinjauan_pustaka}}</td>      
                            <td class="nilai1 text-center">{{$nilaipembimbing2->tinjauan_pustaka}}</td>
                        @else
                            <td class="nilai1 text-center">{{$nilaipembimbing1->tinjauan_pustaka}}</td>
                            <td class="nilai1 text-center">-</td>
                        @endif                                            
                    </tr>
                    <tr>
                        <td>4</td> 
                        <td>Tata Tulis</td>
                        <td class="bg-secondary text-center">8</td>
                        @if ($pembimbing->count() > 1)
                            <td class="nilai1 text-center">{{$nilaipembimbing1->tata_tulis}}</td>      
                            <td class="nilai1 text-center">{{$nilaipembimbing2->tata_tulis}}</td> 
                        @else
                            <td class="nilai1 text-center">{{$nilaipembimbing1->tata_tulis}}</td>
                            <td class="nilai1 text-center">-</td>
                        @endif                                            
                    </tr>
                    <tr>
                        <td>4</td> 
                        <td>Hasil dan Pembahasan</td>
                        <td class="bg-secondary text-center">10</td>
                        @if ($pembimbing->count() > 1)
                            <td class="nilai1 text-center">{{$nilaipembimbing1->hasil_dan_pembahasan}}</td>      
                            <td class="nilai1 text-center">{{$nilaipembimbing2->hasil_dan_pembahasan}}</td> 
                        @else
                            <td class="nilai1 text-center">{{$nilaipembimbing1->hasil_dan_pembahasan}}</td>
                            <td class="nilai1 text-center">-</td>
                        @endif                                            
                    </tr>
                    <tr>
                        <td>6</td> 
                        <td>Sikap dan Kepribadian Ketika Bimbingan</td>
                        <td class="bg-secondary text-center">8</td>
                        @if ($pembimbing->count() > 1)
                            <td class="nilai1 text-center">{{$nilaipembimbing1->sikap_dan_kepribadian}}</td>      
                            <td class="nilai1 text-center">{{$nilaipembimbing2->sikap_dan_kepribadian}}</td> 
                        @else
                            <td class="nilai1 text-center">{{$nilaipembimbing1->sikap_dan_kepribadian}}</td>
                            <td class="nilai1 text-center">-</td>
                        @endif                                            
                    </tr>                    

                    <tr>
                        <td colspan="2">Total Nilai Pembimbing</td>
                        <td class="bg-success text-center">55</td>
                        @if ($pembimbing->count() > 1)
                            <td class="nilai1 text-center">{{$nilaipembimbing1->total_nilai_angka}}</td>      
                            <td class="nilai1 text-center">{{$nilaipembimbing2->total_nilai_angka}}</td> 
                        @else
                            <td class="nilai1 text-center">{{$nilaipembimbing1->total_nilai_angka}}</td>
                            <td class="nilai1 text-center">-</td>
                        @endif                         
                    </tr>
                    <tr>
                        <td colspan="3">Nilai Huruf Pembimbing</td>                        
                        @if ($pembimbing->count() > 1)
                            <td class="nilai1 text-center">{{$nilaipembimbing1->total_nilai_huruf}}</td>      
                            <td class="nilai1 text-center">{{$nilaipembimbing2->total_nilai_huruf}}</td>
                        @else
                            <td class="nilai1 text-center">{{$nilaipembimbing1->total_nilai_huruf}}</td>
                            <td class="nilai1 text-center">-</td>
                        @endif                         
                    </tr>
                    <tr>
                        <td colspan="3">Rata Rata Nilai Pembimbing</td>
                        <td class="text-center" colspan="2">
                            <h3 class="text-bold">
                                @if ($pembimbing->count() > 1)                                
                                {{($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2}}   
                                @else
                                {{$nilaipembimbing1->total_nilai_angka}}
                                @endif    
                            </h3>
                        </td>
                    </tr>

                </tbody>
            </table>

            <table class="table table-bordered table-responsive-lg">                
                <tbody>
                    <tr>                        
                        <td style="width: 250px">NILAI AKHIR</td>
                        <td class="bg-success text-center">
                            <h3 class="text-bold">
                            @if ($nilaipenguji1 == '' && $nilaipenguji2 == '' && $nilaipenguji3 == '' && $nilaipembimbing1 =='' && $nilaipembimbing2 == '')
                                  -
                                  @else
                                        <?php
                                          $nilai_masuk=0;
                                          if(!empty($nilaipenguji1)){
                                            $nilai_masuk=$nilai_masuk+1;
                                            $penguji1=$nilaipenguji1->total_nilai_angka;
                                          }
                                          else{
                                            $penguji1=0;
                                          }
                                          if(!empty($nilaipenguji2)){
                                            $nilai_masuk=$nilai_masuk+1;
                                            $penguji2=$nilaipenguji2->total_nilai_angka;
                                          }
                                          else{
                                            $penguji2=0;
                                          }
                                          if(!empty($nilaipenguji3)){
                                            $nilai_masuk=$nilai_masuk+1;
                                            $penguji3=$nilaipenguji3->total_nilai_angka;
                                          }
                                          else{
                                            $penguji3=0;
                                          }
                                          $nilaitotalpenguji=round(($penguji1+$penguji2+$penguji3)/$nilai_masuk);
                                          $nilai_masuk=0;
                                          
                                          if(!empty($nilaipembimbing1)){
                                            $nilai_masuk=$nilai_masuk+1;
                                            $pembimbing1=$nilaipembimbing1->total_nilai_angka;
                                          }
                                          else{
                                            $pembimbing1=0;
                                          }
                                          if(!empty($nilaipembimbing2)){
                                            $nilai_masuk=$nilai_masuk+1;
                                            $pembimbing2=$nilaipembimbing2->total_nilai_angka;
                                          }
                                          else{
                                            $pembimbing2=0;
                                          }
                                          if($nilai_masuk== 0){
                                            $nilai_masuk=1;
                                          }
                                          $nilaitotalpembimbing = round(($pembimbing1+$pembimbing2)/$nilai_masuk);
                                          $nilai_masuk_akhir=0;
                                          if($nilaitotalpenguji != 0){
                                            $nilai_masuk_akhir=$nilai_masuk_akhir+1;
                                            $penguji=$nilaitotalpenguji;
                                          }
                                          else{
                                            $penguji=0;
                                          }
                                          if($nilaitotalpembimbing != 0){
                                            $nilai_masuk_akhir=$nilai_masuk_akhir+1;
                                            $pembimbing=$nilaitotalpembimbing;
                                          }
                                          else{
                                            $pembimbing=0;
                                          }
                                          $total_nilai = ($penguji+$pembimbing);
                                          ?>
                                          {{$total_nilai}}
                                    @endif
                            </h3>
                        </td>                
                    </tr>
                    <tr>                        
                        <td style="width: 250px">NILAI HURUF</td>
                        <td class="bg-success text-center">
                            <h3 class="text-bold">
                            @if ($nilaitotalpenguji == '' && $nilaitotalpembimbing == '')
                                    -
                                    @else
                                    
                                    @if ($total_nilai >= 85)
                                    A
                                    @elseif ($total_nilai >= 80)
                                    A-
                                    @elseif ($total_nilai >= 75)
                                    B+
                                    @elseif ($total_nilai >= 70)
                                    B
                                    @elseif ($total_nilai >= 65)
                                    B-
                                    @elseif ($total_nilai >= 60)
                                    C+
                                    @elseif ($total_nilai >= 55)
                                    C
                                    @elseif ($total_nilai >= 40)
                                    D
                                    @else
                                    E
                                    @endif
                                  @endif
                            </h3>
                        </td>  
                    </tr>                                                                                                   
                    <tr>
                        <td style="width: 250px">KETERANGAN</td>

                        <td class="bg-success text-center">
                            <h3 class="text-bold">
                            @if ($nilaitotalpenguji == '' && $nilaitotalpembimbing == '')
                                    -
                                    @else
                                    
                                    @if ($total_nilai >= 60)
                                    LULUS
                                    @else
                                    TIDAK LULUS
                                    @endif
                                  @endif
                            </h3>
                        </td>
                    </tr> 
                </tbody>
            </table>


            @if ($penjadwalan->pengujitiga == Auth::user()->nip)
            @if ($penjadwalan->status_seminar == 0 )
                <form action="/penilaian-skripsi/approve/{{$penjadwalan->id}}" method="POST">
                    @method('put')
                    @csrf
                    <button type="submit" class="btn btn-lg btn-danger float-right"> Selesai Sidang</button>
                </form>
            @endif
            @endif

            @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
            @if ($penjadwalan->status_seminar == 1)
            <a href="#ModalApproveKPTA"  data-toggle="modal" class="btn-lg btn-success float-right border-0 ml-3 mt-5">Setujui</a>
            <a href="#ModalTolakKPTA"  data-toggle="modal" class="btn-lg btn-danger float-right border-0 mt-5">Tolak</a>
        
            @endif
            @endif
            @endif

            @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 )
            @if ($penjadwalan->status_seminar == 2)
            <a href="#ModalApproveKoprodi"  data-toggle="modal" class="btn-lg btn-success float-right border-0 ml-3 mt-5">Setujui</a>
            <a href="#ModalTolakKoprodi"  data-toggle="modal" class="btn-lg btn-danger float-right border-0 mt-5">Tolak</a>
            
            @endif
            @endif
            @endif

        </div>         

    </div>    
    <div class="modal fade"id="ModalApproveKPTA">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h5 class="modal-title">Apakah Anda Yakin?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <div class="modal-body">
        <div class="container text-center px-5 pt-5 pb-3">
        <h4>Apakah Anda Yakin?</h4>
        <p>Data Tidak Bisa Dikembalikan!</p>
        <div class="row">
          <div class="col-3"></div>
          <div class="col-3"><button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button></div>
          <div class="col-3"><form action="/persetujuanskripsi-koordinator/approve/{{$penjadwalan->id}}" method="POST">
            @method('put')
            @csrf
            <button type="submit" class="btn btn-success">Setujui</button>
        </form></div>
        <div class="col-3"></div>
        </div>
        
      </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <form action="/persetujuanskripsi-koordinator/approve/{{$penjadwalan->id}}" method="POST">
            @method('put')
            @csrf
            <button type="submit" class="btn btn-success">Setujui</button>
        </form>
      </div> -->
    </div>
  </div>
    </div>

    <div class="modal fade"id="ModalTolakKPTA">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h5 class="modal-title">Apakah Anda Yakin?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <div class="modal-body">
        <div class="container text-center px-5 pt-5 pb-3">
        <h4>Apakah Anda Yakin?</h4>
        <p>Data Akan Dikembalikan Kepada Ketua Penguji!</p>
        <div class="row">
          <div class="col-3"></div>
          <div class="col-3"><button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button></div>
          <div class="col-3"><form action="/persetujuanskripsi-koordinator/tolak/{{$penjadwalan->id}}" method="POST">
                    @method('put')
                    @csrf
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </form></div>
        <div class="col-3"></div>
        </div>
        
      </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <form action="/persetujuanskripsi-koordinator/tolak/{{$penjadwalan->id}}" method="POST">
                    @method('put')
                    @csrf
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </form>
      </div> -->
    </div>
  </div>
    </div>

    <div class="modal fade"id="ModalApproveKoprodi">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h5 class="modal-title">Apakah Anda Yakin?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <div class="modal-body">
        <div class="container text-center px-5 pt-5 pb-3">
        <h4>Apakah Anda Yakin?</h4>
        <p>Data Tidak Bisa Dikembalikan!</p>
        <div class="row">
          <div class="col-3"></div>
          <div class="col-3"><button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button></div>
          <div class="col-3"><form action="/persetujuanskripsi-kaprodi/approve/{{$penjadwalan->id}}" method="POST">
            @method('put')
            @csrf
            <button type="submit" class="btn btn-success">Setujui</button>
        </form></div>
        <div class="col-3"></div>
        </div>
        
      </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <form action="/persetujuanskripsi-kaprodi/approve/{{$penjadwalan->id}}" method="POST">
                    @method('put')
                    @csrf
                    <button type="submit" class="btn btn-success">Setujui</button>
                </form>
        </form>
      </div> -->
    </div>
  </div>
    </div>

    <div class="modal fade"id="ModalTolakKoprodi">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h5 class="modal-title">Apakah Anda Yakin?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <div class="modal-body">
      <div class="container text-center px-5 pt-5 pb-3">
        <h4>Apakah Anda Yakin?</h4>
        <p>Data Akan Dikembalikan Kepada Ketua Penguji!</p>
        <div class="row">
          <div class="col-3"></div>
          <div class="col-3"><button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button></div>
          <div class="col-3"><form action="/persetujuanskripsi-kaprodi/tolak/{{$penjadwalan->id}}" method="POST">
                    @method('put')
                    @csrf
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </form></div>
        <div class="col-3"></div>
        </div>
        
      </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <form action="/persetujuanskripsi-kaprodi/tolak/{{$penjadwalan->id}}" method="POST">
                    @method('put')
                    @csrf
                    <button type="submit" class="btn btn-danger">Tolak</button>
        </form>
        </form>
      </div> -->
    </div>
  </div>
    </div>

    <!-- footer -->
</div>
@endsection   