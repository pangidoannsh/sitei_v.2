@extends('layouts.layout')

@php
    use Carbon\Carbon;
@endphp

@section('header')
    Penilaian Sempro | SIA Elektro
@endsection

@section('isi')

<div class="row mb-5">
  <div class="col-6">
    <ol class="list-group">
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">NIM</div>
          <span class="bg-primary py-1 px-1 rounded">{{$sempro->mahasiswa->nim}}</span>
        </div>        
      </li> 
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Nama</div>
          <span class="bg-primary py-1 px-1 rounded">{{$sempro->mahasiswa->nama}}</span>
        </div>        
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Judul</div>
          <span>{{$sempro->judul_proposal}}</span>
        </div>        
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Jadwal</div>          
          <span>{{Carbon::parse($sempro->tanggal)->translatedFormat('l, d F Y')}}, : {{$sempro->waktu}}</span>             
        </div>        
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Lokasi</div>
          <span>{{$sempro->lokasi}}</span>
        </div>        
      </li>   
    </ol>
  </div>
  
  <div class="col-6">
    <ol class="list-group">
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Pembimbing</div>
          <span class="bg-primary py-1 px-1 rounded">{{$sempro->pembimbingsatu->nama}}</span>                                      
          @if ($sempro->pembimbingdua == !null)
          <br>
          <br>
          <span class="bg-primary py-1 px-1 rounded">{{$sempro->pembimbingdua->nama}}</span>                             
          @endif
        </div>        
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Penguji</div>
          <span class="bg-primary py-1 px-1 rounded">{{$sempro->pengujisatu->nama}}</span> 
          <br>                   
          <br>                   
          <span class="bg-primary py-1 px-1 rounded">{{$sempro->pengujidua->nama}}</span>
          <br>                    
          <br>                    
          <span class="bg-primary py-1 px-1 rounded">{{$sempro->pengujitiga->nama}}</span>                    
        </div>        
      </li>     
    </ol>
  </div>
</div>


@if (auth()->user()->nip == $sempro->pembimbingsatu_nip || auth()->user()->nip == $sempro->pembimbingdua_nip)
  <div class="card card-primary card-tabs">
    <div class="card-header p-0">
      <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Form Nilai</a>
        </li>         
      </ul>
    </div>
    <div class="card-body">
      <div class="tab-content" id="custom-tabs-one-tabContent">
        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
          <form action="/penilaian-sempro-pembimbing/create/{{$sempro->id}}" method="POST">
            @csrf

              <div class="mb-3">
                <label for="penguasaan_dasar_teori" class="col-form-label">Penguasaan Dasar Teori</label>
                <div class="radio1 d-inline">

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="penguasaan_dasar_teori" value="1.8" onclick="hasil()">
                    <label class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="penguasaan_dasar_teori" value="3.6" onclick="hasil()">
                    <label class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="penguasaan_dasar_teori" value="5.4" onclick="hasil()">
                    <label class="form-check-label">Biasa</label>
                  </div>  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="penguasaan_dasar_teori" value="7.2" onclick="hasil()">
                    <label class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="penguasaan_dasar_teori" value="9" onclick="hasil()">
                    <label class="form-check-label">Sangat Baik</label>
                  </div>                                                                   
                   
                </div>                                                         
              </div>
              
              <div class="mb-3">
                <label for="penguasaan_dasar_teori" class="col-form-label">Tingkat Penguasaan Materi</label>
                <div class="radio2 d-inline">

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tingkat_penguasaan_materi" value="1.8" onclick="hasil()">
                    <label class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tingkat_penguasaan_materi" value="3.6" onclick="hasil()">
                    <label class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tingkat_penguasaan_materi" value="5.4" onclick="hasil()">
                    <label class="form-check-label">Biasa</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tingkat_penguasaan_materi" value="7.2" onclick="hasil()">
                    <label class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tingkat_penguasaan_materi" value="9" onclick="hasil()">
                    <label class="form-check-label">Sangat Baik</label>
                  </div>                              
                </div>                                                         
              </div>

              <div class="mb-3">
                <label for="penguasaan_dasar_teori" class="col-form-label">Tinjauan Pustaka</label>
                <div class="radio3 d-inline">

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tinjauan_pustaka" value="1.8" onclick="hasil()">
                    <label class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tinjauan_pustaka" value="3.6" onclick="hasil()">
                    <label class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tinjauan_pustaka" value="5.4" onclick="hasil()">
                    <label class="form-check-label">Biasa</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tinjauan_pustaka" value="7.2" onclick="hasil()">
                    <label class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tinjauan_pustaka" value="9" onclick="hasil()">
                    <label class="form-check-label">Sangat Baik</label>
                  </div>                           
                   
                </div>                                                         
              </div>

              <div class="mb-3">
                <label for="penguasaan_dasar_teori" class="col-form-label">Tata Tulis</label>
                <div class="radio4 d-inline">

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tata_tulis" value="1.8" onclick="hasil()">
                    <label class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tata_tulis" value="3.6" onclick="hasil()">
                    <label class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tata_tulis" value="5.4" onclick="hasil()">
                    <label class="form-check-label">Biasa</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tata_tulis" value="7.2" onclick="hasil()">
                    <label class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tata_tulis" value="9" onclick="hasil()">
                    <label class="form-check-label">Sangat Baik</label>
                  </div>                        
                   
                </div>                                                         
              </div>

              <div class="mb-3">
                <label for="penguasaan_dasar_teori" class="col-form-label">Sikap dan Kepribadian Ketika Bimbingan</label>
                <div class="radio5 d-inline">
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sikap_dan_kepribadian" value="1.8" onclick="hasil()">
                    <label class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sikap_dan_kepribadian" value="3.6" onclick="hasil()">
                    <label class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sikap_dan_kepribadian" value="5.4" onclick="hasil()">
                    <label class="form-check-label">Biasa</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sikap_dan_kepribadian" value="7.2" onclick="hasil()">
                    <label class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sikap_dan_kepribadian" value="9" onclick="hasil()">
                    <label class="form-check-label">Sangat Baik</label>
                  </div>                            
                   
                </div>                                                         
              </div>
              
              <div class="row g-3 align-items-center mb-3">
                <div class="col-auto totalnilaiangka">
                  <label for="total_nilai_angka" class="col-form-label">Total Nilai
                    <span class="badge badge-danger ml-3">Angka</span>
                  </label>
                </div>
                <div class="col-auto">
                  <input type="text" id="total_nilai_angka" class="form-control text-bold" name="total_nilai_angka" style="border-top-style: hidden;
                  border-right-style: hidden;
                  border-left-style: hidden;
                  border-bottom-style: hidden;
                  background-color: rgb(255, 255, 255);                                                
                " readonly>
                </div>
              </div>

              <div class="row g-3 align-items-center mb-3">
                <div class="col-auto totalnilaihuruf">
                  <label for="total_nilai_huruf" class="col-form-label">Total Nilai
                    <span class="badge badge-danger ml-3">Huruf</span>
                  </label>
                </div>
                <div class="col-auto">
                  <input type="text" id="total_nilai_huruf" class="form-control text-bold" name="total_nilai_huruf" style="border-top-style: hidden;
                  border-right-style: hidden;
                  border-left-style: hidden;
                  border-bottom-style: hidden;
                  background-color: rgb(255, 255, 255);
                " readonly>
                </div>
              </div>
              <button type="submit" class="btn btn-primary float-right">Save</button>
          </form> 
        </div>    
      </div>
    </div>  
  </div>
@endif

@if (auth()->user()->nip == $sempro->pengujisatu_nip || auth()->user()->nip == $sempro->pengujidua_nip || auth()->user()->nip == $sempro->pengujitiga_nip)

  <form action="/penilaian-sempro-penguji/create/{{$sempro->id}}" method="POST">
    @csrf
      <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
          <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                aria-selected="true">Form Nilai</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile"
                aria-selected="false">Saran Perbaikan</a>
            </li>              
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
              aria-labelledby="custom-tabs-one-home-tab">
              
              <div class="mb-3">
                <label for="presentasi" class="col-form-label">Presentasi</label>
                <div class="radio6 d-inline">

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="presentasi" value="1" onclick="total()">
                    <label class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="presentasi" value="2" onclick="total()">
                    <label class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="presentasi" value="3" onclick="total()">
                    <label class="form-check-label">Biasa</label>
                  </div>  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="presentasi" value="4" onclick="total()">
                    <label class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="presentasi" value="5" onclick="total()">
                    <label class="form-check-label">Sangat Baik</label>
                  </div>                                                                   
                  
                </div>                                                         
              </div>

              <div class="mb-3">
                <label for="tingkat_penguasaan_materi" class="col-form-label">Tingkat Penguasaan Materi</label>
                <div class="radio7 d-inline">

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tingkat_penguasaan_materi" value="1.6" onclick="total()">
                    <label class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tingkat_penguasaan_materi" value="3.2" onclick="total()">
                    <label class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tingkat_penguasaan_materi" value="4.8" onclick="total()">
                    <label class="form-check-label">Biasa</label>
                  </div>  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tingkat_penguasaan_materi" value="6.4" onclick="total()">
                    <label class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tingkat_penguasaan_materi" value="8" onclick="total()">
                    <label class="form-check-label">Sangat Baik</label>
                  </div>                                                                   
                    
                </div>                                                         
              </div>

              <div class="mb-3">
                <label for="keaslian" class="col-form-label">Keaslian</label>
                <div class="radio8 d-inline">

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="keaslian" value="1" onclick="total()">
                    <label class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="keaslian" value="2" onclick="total()">
                    <label class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="keaslian" value="3" onclick="total()">
                    <label class="form-check-label">Biasa</label>
                  </div>  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="keaslian" value="4" onclick="total()">
                    <label class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="keaslian" value="5" onclick="total()">
                    <label class="form-check-label">Sangat Baik</label>
                  </div>                                                                   
                  
                </div>                                                         
              </div>

              <div class="mb-3">
                <label for="ketepatan_metodologi" class="col-form-label">Ketepatan Metodologi</label>
                <div class="radio9 d-inline">

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ketepatan_metodologi" value="1.4" onclick="total()">
                    <label class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ketepatan_metodologi" value="2.8" onclick="total()">
                    <label class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ketepatan_metodologi" value="4.2" onclick="total()">
                    <label class="form-check-label">Biasa</label>
                  </div>  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ketepatan_metodologi" value="5.6" onclick="total()">
                    <label class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ketepatan_metodologi" value="7" onclick="total()">
                    <label class="form-check-label">Sangat Baik</label>
                  </div>                                                                   
                  
                </div>                                                         
              </div>

              <div class="mb-3">
                <label for="penguasaan_dasar_teori" class="col-form-label">Penguasaan Dasar Teori</label>
                <div class="radio10 d-inline">

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="penguasaan_dasar_teori" value="1.2" onclick="total()">
                    <label class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="penguasaan_dasar_teori" value="2.4" onclick="total()">
                    <label class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="penguasaan_dasar_teori" value="3.6" onclick="total()">
                    <label class="form-check-label">Biasa</label>
                  </div>  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="penguasaan_dasar_teori" value="4.8" onclick="total()">
                    <label class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="penguasaan_dasar_teori" value="6" onclick="total()">
                    <label class="form-check-label">Sangat Baik</label>
                  </div>                                                                   
                  
                </div>                                                         
              </div>

              <div class="mb-3">
                <label for="kecermatan_perumusan_masalah" class="col-form-label">Kecermatan Perumusan Masalah</label>
                <div class="radio11 d-inline">

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="kecermatan_perumusan_masalah" value="1.2" onclick="total()">
                    <label class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="kecermatan_perumusan_masalah" value="2.4" onclick="total()">
                    <label class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="kecermatan_perumusan_masalah" value="3.6" onclick="total()">
                    <label class="form-check-label">Biasa</label>
                  </div>  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="kecermatan_perumusan_masalah" value="4.8" onclick="total()">
                    <label class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="kecermatan_perumusan_masalah" value="6" onclick="total()">
                    <label class="form-check-label">Sangat Baik</label>
                  </div>                                                                   
                  
                </div>                                                         
              </div>

              <div class="mb-3">
                <label for="tinjauan_pustaka" class="col-form-label">Tinjauan Pustaka</label>
                <div class="radio12 d-inline">

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tinjauan_pustaka" value="1.4" onclick="total()">
                    <label class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tinjauan_pustaka" value="2.8" onclick="total()">
                    <label class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tinjauan_pustaka" value="4.2" onclick="total()">
                    <label class="form-check-label">Biasa</label>
                  </div>  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tinjauan_pustaka" value="5.6" onclick="total()">
                    <label class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tinjauan_pustaka" value="7" onclick="total()">
                    <label class="form-check-label">Sangat Baik</label>
                  </div>                                                                   
                  
                </div>                                                         
              </div>

              <div class="mb-3">
                <label for="tata_tulis" class="col-form-label">Tata Tulis</label>
                <div class="radio13 d-inline">

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tata_tulis" value="1" onclick="total()">
                    <label class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tata_tulis" value="2" onclick="total()">
                    <label class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tata_tulis" value="3" onclick="total()">
                    <label class="form-check-label">Biasa</label>
                  </div>  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tata_tulis" value="4" onclick="total()">
                    <label class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tata_tulis" value="5" onclick="total()">
                    <label class="form-check-label">Sangat Baik</label>
                  </div>                                                                   
                  
                </div>                                                         
              </div>

              <div class="mb-3">
                <label for="sumbangan_pemikiran" class="col-form-label">Sumbangan Pemikiran Terhadap Ilmu Pengetahuan</label>
                <div class="radio14 d-inline">

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sumbangan_pemikiran" value="1.2" onclick="total()">
                    <label class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sumbangan_pemikiran" value="2.4" onclick="total()">
                    <label class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sumbangan_pemikiran" value="3.6" onclick="total()">
                    <label class="form-check-label">Biasa</label>
                  </div>  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sumbangan_pemikiran" value="4.8" onclick="total()">
                    <label class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sumbangan_pemikiran" value="6" onclick="total()">
                    <label class="form-check-label">Sangat Baik</label>
                  </div>                                                                   
                  
                </div>                                                         
              </div>
                                
              <div class="row g-3 align-items-center mb-3">
                <div class="col-auto totalnilaiangka">
                  <label for="total_nilai_angka" class="col-form-label">Total Nilai
                    <span class="badge badge-danger ml-3">Angka</span>
                  </label>
                </div>
                <div class="col-auto">
                  <input type="text" id="total_nilai_angka" class="form-control text-bold" name="total_nilai_angka" style="border-top-style: hidden;
                  border-right-style: hidden;
                  border-left-style: hidden;
                  border-bottom-style: hidden;
                  background-color: rgb(255, 255, 255);                                                
                " readonly>
                </div>
              </div>

              <div class="row g-3 align-items-center mb-3">
                <div class="col-auto totalnilaihuruf">
                  <label for="total_nilai_huruf" class="col-form-label">Total Nilai
                    <span class="badge badge-danger ml-3">Huruf</span>
                  </label>
                </div>
                <div class="col-auto">
                  <input type="text" id="total_nilai_huruf" class="form-control text-bold" name="total_nilai_huruf" style="border-top-style: hidden;
                  border-right-style: hidden;
                  border-left-style: hidden;
                  border-bottom-style: hidden;
                  background-color: rgb(255, 255, 255);
                " readonly>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
              aria-labelledby="custom-tabs-one-profile-tab">
              <div class="input-group mb-3">
                <span class="input-group-text">1</span>
                <div class="form-floating">
                  <textarea name="revisi_naskah1" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px; width:600px;"></textarea>
                  <label for="floatingTextarea2">Perbaikan 1</label>
                </div>
              </div>
              
              <div class="input-group mb-3">
                <span class="input-group-text">2</span>
                <div class="form-floating">
                  <textarea name="revisi_naskah2" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px; width:600px;"></textarea>
                  <label for="floatingTextarea2">Perbaikan 2</label>
                </div>
              </div>

              <div class="input-group mb-3">
                <span class="input-group-text">3</span>
                <div class="form-floating">
                  <textarea name="revisi_naskah3" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px; width:600px;"></textarea>
                  <label for="floatingTextarea2">Perbaikan 3</label>
                </div>
              </div>

              <div class="input-group mb-3">
                <span class="input-group-text">4</span>
                <div class="form-floating">
                  <textarea name="revisi_naskah4" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px; width:600px;"></textarea>
                  <label for="floatingTextarea2">Perbaikan 4</label>
                </div>
              </div>

              <div class="input-group mb-3">
                <span class="input-group-text">5</span>
                <div class="form-floating">
                  <textarea name="revisi_naskah5" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px; width:600px;"></textarea>
                  <label for="floatingTextarea2">Perbaikan 5</label>
                </div>
              </div>
              <button type="submit" class="btn btn-primary float-right">Save</button>    
            </div>        
          </div>
        </div>
        <!-- /.card -->
      </div>
  </form>

@endif

@endsection

@push('scripts')
  <script>

  function hasil(){

    var penguasaan_dasar_teori = $('input[name="penguasaan_dasar_teori"]:checked').val();
    var tingkat_penguasaan_materi = $('input[name="tingkat_penguasaan_materi"]:checked').val();
    var tinjauan_pustaka = $('input[name="tinjauan_pustaka"]:checked').val();
    var tata_tulis = $('input[name="tata_tulis"]:checked').val();
    var sikap_dan_kepribadian = $('input[name="sikap_dan_kepribadian"]:checked').val();
    var total = parseFloat(penguasaan_dasar_teori) + parseFloat(tingkat_penguasaan_materi) + parseFloat(tinjauan_pustaka) + parseFloat(tata_tulis) + parseFloat(sikap_dan_kepribadian);
    var total_angka = parseFloat(total) * parseFloat(2.2222);

    if (!isNaN(total_angka)) {
      $('input[name="total_nilai_angka"]').val(Math.round(total_angka));
      if (total_angka >= 85) {
        $('input[name="total_nilai_huruf"]').val("A");
      }
      else if(total_angka > 79){
        $('input[name="total_nilai_huruf"]').val("A-");
      }
      else if(total_angka > 74){
        $('input[name="total_nilai_huruf"]').val("B+");
      }   
      else if(total_angka > 69){
        $('input[name="total_nilai_huruf"]').val("B");
      }   
      else if(total_angka > 64){
        $('input[name="total_nilai_huruf"]').val("B-");
      }
      else if(total_angka > 59){
        $('input[name="total_nilai_huruf"]').val("C+");
      }
      else if(total_angka > 54){
        $('input[name="total_nilai_huruf"]').val("C");
      }
      else if(total_angka > 39){
        $('input[name="total_nilai_huruf"]').val("D");
      } 
      else{
        $('input[name="total_nilai_huruf"]').val("E");
      } 
    }
    else{
      $('input[name="total_nilai_angka"]').val(0);
    }

  }

  function total() {
    var presentasi = $('input[name="presentasi"]:checked').val();
    var tingkat_penguasaan_materi = $('input[name="tingkat_penguasaan_materi"]:checked').val();
    var keaslian = $('input[name="keaslian"]:checked').val();
    var ketepatan_metodologi = $('input[name="ketepatan_metodologi"]:checked').val();
    var penguasaan_dasar_teori = $('input[name="penguasaan_dasar_teori"]:checked').val();
    var kecermatan_perumusan_masalah = $('input[name="kecermatan_perumusan_masalah"]:checked').val();
    var tinjauan_pustaka = $('input[name="tinjauan_pustaka"]:checked').val();
    var tata_tulis = $('input[name="tata_tulis"]:checked').val();
    var sumbangan_pemikiran = $('input[name="sumbangan_pemikiran"]:checked').val();
    var hasil = parseFloat(presentasi) + parseFloat(tingkat_penguasaan_materi) + parseFloat(keaslian) + parseFloat(ketepatan_metodologi) + parseFloat(penguasaan_dasar_teori) +parseFloat(kecermatan_perumusan_masalah) + parseFloat(tinjauan_pustaka) + parseFloat(tata_tulis) +parseFloat(sumbangan_pemikiran);
    var angka = parseFloat(hasil) * parseFloat(1.81818182);

    if (!isNaN(angka)) {
      $('input[name="total_nilai_angka"]').val(Math.round(angka));
      if (angka >= 85) {
        $('input[name="total_nilai_huruf"]').val("A");
      }
      else if(angka > 79){
        $('input[name="total_nilai_huruf"]').val("A-");
      }
      else if(angka > 74){
        $('input[name="total_nilai_huruf"]').val("B+");
      }   
      else if(angka > 69){
        $('input[name="total_nilai_huruf"]').val("B");
      }   
      else if(angka > 64){
        $('input[name="total_nilai_huruf"]').val("B-");
      }
      else if(angka > 59){
        $('input[name="total_nilai_huruf"]').val("C+");
      }
      else if(angka > 54){
        $('input[name="total_nilai_huruf"]').val("C");
      }
      else if(angka > 39){
        $('input[name="total_nilai_huruf"]').val("D");
      } 
      else{
        $('input[name="total_nilai_huruf"]').val("E");
      }
    }
    else{
      $('input[name="total_nilai_angka"]').val(0);
    }
  }

  </script>
@endpush