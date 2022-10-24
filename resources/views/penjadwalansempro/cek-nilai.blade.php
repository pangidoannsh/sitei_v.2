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
            <span>{{$penjadwalan->revisi_naskah != null ? $penjadwalan->revisi_naskah : $penjadwalan->judul_proposal }}</span>
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
    <div class="row">
        <div class="col-lg-6">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="width: 200px">Penilaian Penguji</th>
                        <th class="bg-danger" style="width: 30px">B</th>
                        <th>Penguji 1</th>
                        <th>Penguji 2</th>
                        <th>Penguji 3</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>  
                        <td>Presentasi</td>
                        <td class="bg-secondary">2</td>
                        <td>{{$nilaipenguji1->presentasi}}</td>                                           
                        <td>{{$nilaipenguji2->presentasi}}</td>                                           
                        <td>{{$nilaipenguji3->presentasi}}</td>                                           
                    </tr>
                    <tr>
                        <td>2</td> 
                        <td>Tingkat Penguasaan Materi</td>
                        <td class="bg-secondary">3</td>
                        <td>{{$nilaipenguji1->tingkat_penguasaan_materi}}</td>                                           
                        <td>{{$nilaipenguji2->tingkat_penguasaan_materi}}</td>                                           
                        <td>{{$nilaipenguji3->tingkat_penguasaan_materi}}</td>                       
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Keaslian</td>
                        <td class="bg-secondary">2</td>
                        <td>{{$nilaipenguji1->keaslian}}</td>                                           
                        <td>{{$nilaipenguji2->keaslian}}</td>                                           
                        <td>{{$nilaipenguji3->keaslian}}</td>                      
                    </tr>
                    <tr>
                        <td>4</td> 
                        <td>Ketepatan Metodologi</td>
                        <td class="bg-secondary">4</td>
                        <td>{{$nilaipenguji1->ketepatan_metodologi}}</td>                                           
                        <td>{{$nilaipenguji2->ketepatan_metodologi}}</td>                                           
                        <td>{{$nilaipenguji3->ketepatan_metodologi}}</td>                       
                    </tr>
                    <tr>
                        <td>5</td> 
                        <td>Penguasaan Dasar Teori</td>
                        <td class="bg-secondary">4</td>
                        <td>{{$nilaipenguji1->penguasaan_dasar_teori}}</td>                                           
                        <td>{{$nilaipenguji2->penguasaan_dasar_teori}}</td>                                           
                        <td>{{$nilaipenguji3->penguasaan_dasar_teori}}</td>                        
                    </tr>
                    <tr>
                        <td>6</td>       
                        <td>Kecermatan Perumusan Masalah</td>
                        <td class="bg-secondary">3</td>
                        <td>{{$nilaipenguji1->kecermatan_perumusan_masalah}}</td>                                           
                        <td>{{$nilaipenguji2->kecermatan_perumusan_masalah}}</td>                                           
                        <td>{{$nilaipenguji3->kecermatan_perumusan_masalah}}</td>                   
                    </tr>
                    <tr>
                        <td>7</td>        
                        <td>Tinjauan Pustaka</td>
                        <td class="bg-secondary">3</td>
                        <td>{{$nilaipenguji1->tinjauan_pustaka}}</td>                                           
                        <td>{{$nilaipenguji2->tinjauan_pustaka}}</td>                                           
                        <td>{{$nilaipenguji3->tinjauan_pustaka}}</td>                
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Tata Tulis</td>
                        <td class="bg-secondary">2</td>
                        <td>{{$nilaipenguji1->tata_tulis}}</td>                                           
                        <td>{{$nilaipenguji2->tata_tulis}}</td>                                           
                        <td>{{$nilaipenguji3->tata_tulis}}</td>                      
                    </tr>                   
                    <tr>
                        <td>9</td>
                        <td>Sumbangan Pemikiran Terhadap Ilmu Pengetahuan dan Penerapannya</td>
                        <td class="bg-secondary">3</td>
                        <td>{{$nilaipenguji1->sumbangan_pemikiran}}</td>                                           
                        <td>{{$nilaipenguji2->sumbangan_pemikiran}}</td>                                           
                        <td>{{$nilaipenguji3->sumbangan_pemikiran}}</td> 
                    </tr>

                    <tr>
                        <td colspan="2">Total Nilai Penguji</td>
                        <td class="bg-danger">45</td>
                        <td>{{$nilaipenguji1->total_nilai_angka}}</td>                                           
                        <td>{{$nilaipenguji2->total_nilai_angka}}</td>                                           
                        <td>{{$nilaipenguji3->total_nilai_angka}}</td> 
                    </tr>
                    <tr>
                        <td colspan="3">Nilai Huruf Penguji</td>                        
                        <td>{{$nilaipenguji1->total_nilai_huruf}}</td>                                           
                        <td>{{$nilaipenguji2->total_nilai_huruf}}</td>                                           
                        <td>{{$nilaipenguji3->total_nilai_huruf}}</td> 
                    </tr>
                    <tr>                        
                        <td colspan="3">Rata Rata Nilai Penguji</td>
                        <td class="text-center" colspan="3">
                            <h3 class="text-bold">
                                {{round(($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3)}}
                            </h3>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-lg-6">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th style="width: 230px">Penilaian Pembimbing</th>
                    <th class="bg-danger">B</th>
                    <th>Pembimbing 1</th>
                    <th>Pembimbing 2</th>                    
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>  
                        <td>Penguasaan Dasar Teori</td>
                        <td class="bg-secondary">10</td>
                        @if ($pembimbing->count() > 1)
                            <td>{{$nilaipembimbing1->penguasaan_dasar_teori}}</td>                                           
                            <td>{{$nilaipembimbing2->penguasaan_dasar_teori}}</td>                                           
                        @else
                            <td>{{$nilaipembimbing1->penguasaan_dasar_teori}}</td>
                            <td>-</td>
                        @endif                                              
                    </tr>
                    <tr>
                        <td>2</td> 
                        <td>Tingkat Penguasaan Materi</td>
                        <td class="bg-secondary">10</td>
                        @if ($pembimbing->count() > 1)
                            <td>{{$nilaipembimbing1->tingkat_penguasaan_materi}}</td>      
                            <td>{{$nilaipembimbing2->tingkat_penguasaan_materi}}</td>
                        @else
                            <td>{{$nilaipembimbing1->tingkat_penguasaan_materi}}</td>
                            <td>-</td>
                        @endif                                             
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Tinjauan Pustaka</td>
                        <td class="bg-secondary">9</td>
                        @if ($pembimbing->count() > 1)
                            <td>{{$nilaipembimbing1->tinjauan_pustaka}}</td>      
                            <td>{{$nilaipembimbing2->tinjauan_pustaka}}</td>
                        @else
                            <td>{{$nilaipembimbing1->tinjauan_pustaka}}</td>
                            <td>-</td>
                        @endif                                            
                    </tr>
                    <tr>
                        <td>4</td> 
                        <td>Tata Tulis</td>
                        <td class="bg-secondary">8</td>
                        @if ($pembimbing->count() > 1)
                            <td>{{$nilaipembimbing1->tata_tulis}}</td>      
                            <td>{{$nilaipembimbing2->tata_tulis}}</td> 
                        @else
                            <td>{{$nilaipembimbing1->tata_tulis}}</td>
                            <td>-</td>
                        @endif                                            
                    </tr>                    
                    <tr>
                        <td>5</td> 
                        <td>Sikap dan Kepribadian Ketika Bimbingan</td>
                        <td class="bg-secondary">8</td>
                        @if ($pembimbing->count() > 1)
                            <td>{{$nilaipembimbing1->sikap_dan_kepribadian}}</td>      
                            <td>{{$nilaipembimbing2->sikap_dan_kepribadian}}</td> 
                        @else
                            <td>{{$nilaipembimbing1->sikap_dan_kepribadian}}</td>
                            <td>-</td>
                        @endif                                            
                    </tr>                    

                    <tr>
                        <td colspan="2">Total Nilai Pembimbing</td>
                        <td class="bg-danger">55</td>
                        @if ($pembimbing->count() > 1)
                            <td>{{$nilaipembimbing1->total_nilai_angka}}</td>      
                            <td>{{$nilaipembimbing2->total_nilai_angka}}</td> 
                        @else
                            <td>{{$nilaipembimbing1->total_nilai_angka}}</td>
                            <td>-</td>
                        @endif                         
                    </tr>
                    <tr>
                        <td colspan="3">Nilai Huruf Pembimbing</td>                        
                        @if ($pembimbing->count() > 1)
                            <td>{{$nilaipembimbing1->total_nilai_huruf}}</td>      
                            <td>{{$nilaipembimbing2->total_nilai_huruf}}</td>
                        @else
                            <td>{{$nilaipembimbing1->total_nilai_huruf}}</td>
                            <td>-</td>
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

            <table class="table table-bordered">                
                <tbody>
                    <tr>                        
                        <td style="width: 250px">NILAI AKHIR</td>
                        <td class="bg-danger text-center">
                            <h3 class="text-bold">
                                @if ($pembimbing->count() > 1)                                
                                {{ round(((($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2) + (($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3)) / 2) }}  
                                @else
                                {{round(($nilaipembimbing1->total_nilai_angka + (($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3)) / 2, 0, PHP_ROUND_HALF_ODD)}}
                                @endif                          
                            </h3>
                        </td>                
                    </tr>
                    <tr>                        
                        <td style="width: 250px">NILAI HURUF</td>
                        <td class="bg-danger text-center">
                            <h3 class="text-bold">
                                @if ($pembimbing->count() > 1)                                
                                @if (((($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2) + (($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3)) / 2 >= 85 )                            
                                    A                            
                                @elseif (((($nilaipembimbing1->total_nilai_angka+ $nilaipembimbing2->total_nilai_angka) / 2) + (($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3))  / 2 >= 80 )
                                    A-                                
                                @elseif (((($nilaipembimbing1->total_nilai_angka+ $nilaipembimbing2->total_nilai_angka) / 2) + (($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3)) / 2 >= 75 )
                                    B+                            
                                @elseif (((($nilaipembimbing1->total_nilai_angka+ $nilaipembimbing2->total_nilai_angka) / 2) + (($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3)) / 2 >= 70 )
                                    B                                
                                @elseif (((($nilaipembimbing1->total_nilai_angka+ $nilaipembimbing2->total_nilai_angka) / 2) + (($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3))  / 2 >= 65 )
                                    B-                                
                                @elseif (((($nilaipembimbing1->total_nilai_angka+ $nilaipembimbing2->total_nilai_angka) / 2) + (($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3)) / 2 >= 60 )
                                    C+                                
                                @elseif (((($nilaipembimbing1->total_nilai_angka+ $nilaipembimbing2->total_nilai_angka) / 2) + (($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3))  / 2 >= 55 )
                                    C                                
                                @elseif (((($nilaipembimbing1->total_nilai_angka+ $nilaipembimbing2->total_nilai_angka) / 2) + (($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3)) / 2 >= 40 )
                                    D
                                @else
                                    E
                                @endif                                
                                @else
                                @if (($nilaipembimbing1->total_nilai_angka + (($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3)) / 2 >= 85 )
                                    A                                
                                @elseif (($nilaipembimbing1->total_nilai_angka + (($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3)) / 2 >= 80 )
                                A-                                
                                @elseif (($nilaipembimbing1->total_nilai_angka + (($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3)) / 2 >= 75 )
                                    B+                                
                                @elseif (($nilaipembimbing1->total_nilai_angka + (($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3)) / 2 >= 70 )
                                    B                                
                                @elseif (($nilaipembimbing1->total_nilai_angka + (($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3)) / 2 >= 65 )
                                    B-                                
                                @elseif (($nilaipembimbing1->total_nilai_angka + (($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3)) / 2 >= 60 )
                                    C+                                
                                @elseif (($nilaipembimbing1->total_nilai_angka + (($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3)) / 2 >= 55 )
                                    C                                
                                @elseif (($nilaipembimbing1->total_nilai_angka + (($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3)) / 2 >= 40 )
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
                              @if ($penjadwalan->pembimbingdua_nip == null)
                              @if ($nilaipembimbing1 == '')
                              -
                              @else
                              @if ($nilaipenguji1 == '' || $nilaipenguji2 == '' || $nilaipenguji3 == '')
                                  -
                              @else
                                  @if (($nilaipembimbing1->total_nilai_angka +
                                      ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) /
                                      2 >=
                                      60)
                                    LULUS                                            
                                  @else
                                    TIDAK LULUS
                                  @endif
                              @endif
                          @endif
                              @else
                                  @if ($nilaipembimbing1 != '' && $nilaipembimbing2 != '')
                                    @if ($nilaipenguji1 == '' || $nilaipenguji2 == '' || $nilaipenguji3 == '')
                                        -
                                    @else
                                        @if ((($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 +
                                            ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) /
                                            2 >= 60)
                                            LULUS
                                        @else
                                            TIDAK LULUS
                                        @endif
                                    @endif
                                  @else
                                  -
                                  @endif
                              @endif
                            </h3>
                        </td>
                    </tr>                                                                       
                </tbody>
            </table>

            @if ($penjadwalan->status_seminar == 0)
                <form action="/penilaian-sempro/approve/{{$penjadwalan->id}}" method="POST">
                    @method('put')
                    @csrf
                    <button type="submit" class="btn btn-lg btn-success float-right"> Approve Penilaian</button>
                </form>
            @endif

            @if ($penjadwalan->status_seminar == 1)
                <form action="/persetujuansempro-koordinator/approve/{{$penjadwalan->id}}" method="POST">
                    @method('put')
                    @csrf
                    <button type="submit" class="btn-lg btn-success float-right border-0 ml-3">SETUJUI</button>
                </form>
                <form action="/persetujuansempro-koordinator/tolak/{{$penjadwalan->id}}" method="POST">
                    @method('put')
                    @csrf
                    <button type="submit" class="btn-lg btn-danger float-right border-0">TOLAK</button>
                </form>
            @endif

            @if ($penjadwalan->status_seminar == 2)
                <form action="/persetujuansempro-kaprodi/approve/{{$penjadwalan->id}}" method="POST">
                    @method('put')
                    @csrf
                    <button type="submit" class="btn-lg btn-success float-right border-0 ml-3">SETUJUI</button>
                </form>
                <form action="/persetujuansempro-kaprodi/tolak/{{$penjadwalan->id}}" method="POST">
                    @method('put')
                    @csrf
                    <button type="submit" class="btn-lg btn-danger float-right border-0">TOLAK</button>
                </form>
            @endif

        </div>         

    </div>    
</div>
@endsection   