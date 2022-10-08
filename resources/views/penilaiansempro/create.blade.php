@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('header')
    Penilaian Sempro | SIA Elektro
@endsection

@section('sub-title')
    Penilaian Seminar Proposal
@endsection

@section('content')

<div class="row mb-5">
  <div class="col-6">
    <ol class="list-group" style="box-shadow: 2px 2px 2px 2px #dbdbdb; border-radius:20px;">
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">NIM</div>
          <span>{{$sempro->nim}}</span>
        </div>        
      </li> 
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Nama</div>
          <span>{{$sempro->nama}}</span>
        </div>        
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Judul</div>
          <span>{{ $sempro->revisi_naskah != null ? $sempro->revisi_naskah : $sempro->judul_proposal }}</span>
        </div>        
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Jadwal</div>          
          <span>{{Carbon::parse($sempro->tanggal)->translatedFormat('l, d F Y')}},  {{$sempro->waktu}}</span>             
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
    <ol class="list-group"style="box-shadow: 2px 2px 2px 2px #dbdbdb; border-radius:20px;">
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Pembimbing</div>
          <span>{{$sempro->pembimbingsatu->nama}}</span>                                      
          @if ($sempro->pembimbingdua == !null)
          <br>
          <br>
          <span>{{$sempro->pembimbingdua->nama}}</span>                             
          @endif
        </div>        
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Penguji</div>
          <span>{{$sempro->pengujisatu->nama}}</span> 
          <br>                   
          <br>                   
          <span>{{$sempro->pengujidua->nama}}</span>
          <br>                    
          <br>                    
          <span>{{$sempro->pengujitiga->nama}}</span>                    
        </div>        
      </li>     
    </ol>
  </div>
</div>


@if (auth()->user()->nip == $sempro->pembimbingsatu_nip || auth()->user()->nip == $sempro->pembimbingdua_nip)
  <div class="card card-success card-tabs">
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
                    <input class="form-check-input @error ('penguasaan_dasar_teori') is-invalid @enderror" type="radio" class="btn-check" id="penguasaan_dasar_teori1" name="penguasaan_dasar_teori" value="1.8" onclick="hasil()" {{ old('penguasaan_dasar_teori', $sempro->penguasaan_dasar_teori) == '1.8' ? 'checked' : null }} >
                    <label for="penguasaan_dasar_teori1" class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('penguasaan_dasar_teori') is-invalid @enderror" type="radio" id="penguasaan_dasar_teori2" name="penguasaan_dasar_teori" value="3.6" onclick="hasil()" {{ old('penguasaan_dasar_teori', $sempro->penguasaan_dasar_teori) == '3.6' ? 'checked' : null }} >
                    <label for="penguasaan_dasar_teori2" class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('penguasaan_dasar_teori') is-invalid @enderror" type="radio" id="penguasaan_dasar_teori3" name="penguasaan_dasar_teori" value="5.4" onclick="hasil()" {{ old('penguasaan_dasar_teori', $sempro->penguasaan_dasar_teori) == '5.4' ? 'checked' : null }} >
                    <label for="penguasaan_dasar_teori3" class="form-check-label">Biasa</label>
                  </div>  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('penguasaan_dasar_teori') is-invalid @enderror" type="radio" id="penguasaan_dasar_teori4" name="penguasaan_dasar_teori" value="7.2" onclick="hasil()" {{ old('penguasaan_dasar_teori', $sempro->penguasaan_dasar_teori) == '7.2' ? 'checked' : null }} >
                    <label for="penguasaan_dasar_teori4" class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('penguasaan_dasar_teori') is-invalid @enderror" type="radio" id="penguasaan_dasar_teori5" name="penguasaan_dasar_teori" value="9" onclick="hasil()" {{ old('penguasaan_dasar_teori', $sempro->penguasaan_dasar_teori) == '9' ? 'checked' : null }} >
                    <label for="penguasaan_dasar_teori5" class="form-check-label">Sangat Baik</label>
                  </div>                                                                   
                  
                </div>                                                         
              </div>
              @error('penguasaan_dasar_teori')
                  <div class="invalid-feedback">
                    Error
                  </div>
              @enderror
              
              <div class="mb-3">
                <label for="tingkat_penguasaan_materi" class="col-form-label">Tingkat Penguasaan Materi</label>
                <div class="radio2 d-inline">

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tingkat_penguasaan_materi') is-invalid @enderror" type="radio" id="tingkat_penguasaan_materi1" name="tingkat_penguasaan_materi" value="1.8" onclick="hasil()" {{ old('tingkat_penguasaan_materi', $sempro->tingkat_penguasaan_materi) == '1.8' ? 'checked' : null }} >
                    <label for="tingkat_penguasaan_materi1" class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tingkat_penguasaan_materi') is-invalid @enderror" type="radio" id="tingkat_penguasaan_materi2" name="tingkat_penguasaan_materi" value="3.6" onclick="hasil()" {{ old('tingkat_penguasaan_materi', $sempro->tingkat_penguasaan_materi) == '3.6' ? 'checked' : null }} >
                    <label for="tingkat_penguasaan_materi2" class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tingkat_penguasaan_materi') is-invalid @enderror" type="radio" id="tingkat_penguasaan_materi3" name="tingkat_penguasaan_materi" value="5.4" onclick="hasil()" {{ old('tingkat_penguasaan_materi', $sempro->tingkat_penguasaan_materi) == '5.4' ? 'checked' : null }} >
                    <label for="tingkat_penguasaan_materi3" class="form-check-label">Biasa</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tingkat_penguasaan_materi') is-invalid @enderror" type="radio" id="tingkat_penguasaan_materi4" name="tingkat_penguasaan_materi" value="7.2" onclick="hasil()" {{ old('tingkat_penguasaan_materi', $sempro->tingkat_penguasaan_materi) == '7.2' ? 'checked' : null }} >
                    <label for="tingkat_penguasaan_materi4" class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tingkat_penguasaan_materi') is-invalid @enderror" type="radio" id="tingkat_penguasaan_materi5" name="tingkat_penguasaan_materi" value="9" onclick="hasil()" {{ old('tingkat_penguasaan_materi', $sempro->tingkat_penguasaan_materi) == '9' ? 'checked' : null }} >
                    <label for="tingkat_penguasaan_materi5" class="form-check-label">Sangat Baik</label>
                  </div>                              
                </div>                                                         
              </div>
              @error('tingkat_penguasaan_materi')
                  <div class="invalid-feedback">
                    Error
                  </div>
              @enderror

              <div class="mb-3">
                <label for="tinjauan_pustaka" class="col-form-label">Tinjauan Pustaka</label>
                <div class="radio3 d-inline">

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tinjauan_pustaka') is-invalid @enderror" type="radio" id="tinjauan_pustaka1" name="tinjauan_pustaka" value="1.8" onclick="hasil()" {{ old('tinjauan_pustaka', $sempro->tinjauan_pustaka) == '1.8' ? 'checked' : null }}>
                    <label for="tinjauan_pustaka1" class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tinjauan_pustaka') is-invalid @enderror" type="radio" id="tinjauan_pustaka2" name="tinjauan_pustaka" value="3.6" onclick="hasil()" {{ old('tinjauan_pustaka', $sempro->tinjauan_pustaka) == '3.6' ? 'checked' : null }}>
                    <label for="tinjauan_pustaka2" class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tinjauan_pustaka') is-invalid @enderror" type="radio" id="tinjauan_pustaka3" name="tinjauan_pustaka" value="5.4" onclick="hasil()" {{ old('tinjauan_pustaka', $sempro->tinjauan_pustaka) == '5.4' ? 'checked' : null }}>
                    <label for="tinjauan_pustaka3" class="form-check-label">Biasa</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tinjauan_pustaka') is-invalid @enderror" type="radio" id="tinjauan_pustaka4" name="tinjauan_pustaka" value="7.2" onclick="hasil()" {{ old('tinjauan_pustaka', $sempro->tinjauan_pustaka) == '7.2' ? 'checked' : null }}>
                    <label for="tinjauan_pustaka4" class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tinjauan_pustaka') is-invalid @enderror" type="radio" id="tinjauan_pustaka5" name="tinjauan_pustaka" value="9" onclick="hasil()" {{ old('tinjauan_pustaka', $sempro->tinjauan_pustaka) == '9' ? 'checked' : null }}>
                    <label for="tinjauan_pustaka5" class="form-check-label">Sangat Baik</label>
                  </div>                           
                   
                </div>                                                         
              </div>
              @error('tinjauan_pustaka')
                  <div class="invalid-feedback">
                    Error
                  </div>
              @enderror

              <div class="mb-3">
                <label for="tata_tulis" class="col-form-label">Tata Tulis</label>
                <div class="radio4 d-inline">

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tata_tulis') is-invalid @enderror" type="radio" id="tata_tulis1" name="tata_tulis" value="1.8" onclick="hasil()" {{ old('tata_tulis', $sempro->tata_tulis) == '1.8' ? 'checked' : null }}>
                    <label for="tata_tulis1" class="form-check-label">Sangat Kurang Baik</label>       
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tata_tulis') is-invalid @enderror" type="radio" id="tata_tulis2" name="tata_tulis" value="3.6" onclick="hasil()" {{ old('tata_tulis', $sempro->tata_tulis) == '3.6' ? 'checked' : null }}>
                    <label for="tata_tulis2" class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tata_tulis') is-invalid @enderror" type="radio" id="tata_tulis3" name="tata_tulis" value="5.4" onclick="hasil()" {{ old('tata_tulis', $sempro->tata_tulis) == '5.4' ? 'checked' : null }}>
                    <label for="tata_tulis3" class="form-check-label">Biasa</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tata_tulis') is-invalid @enderror" type="radio" id="tata_tulis4" name="tata_tulis" value="7.2" onclick="hasil()" {{ old('tata_tulis', $sempro->tata_tulis) == '7.2' ? 'checked' : null }}>
                    <label for="tata_tulis4" class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tata_tulis') is-invalid @enderror" type="radio" id="tata_tulis5" name="tata_tulis" value="9" onclick="hasil()" {{ old('tata_tulis', $sempro->tata_tulis) == '9' ? 'checked' : null }}>
                    <label for="tata_tulis5" class="form-check-label">Sangat Baik</label>
                  </div>                        
                   
                </div>                                                         
              </div>
              @error('tata_tulis')
                  <div class="invalid-feedback">
                    Error
                  </div>
              @enderror

              <div class="mb-3">
                <label for="sikap_dan_kepribadian" class="col-form-label">Sikap dan Kepribadian Ketika Bimbingan</label>
                <div class="radio5 d-inline">
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('sikap_dan_kepribadian') is-invalid @enderror" type="radio" id="sikap_dan_kepribadian1" name="sikap_dan_kepribadian" value="1.8" onclick="hasil()" {{ old('sikap_dan_kepribadian', $sempro->sikap_dan_kepribadian) == '1.8' ? 'checked' : null }}>
                    <label for="sikap_dan_kepribadian1" class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('sikap_dan_kepribadian') is-invalid @enderror" type="radio" id="sikap_dan_kepribadian2" name="sikap_dan_kepribadian" value="3.6" onclick="hasil()" {{ old('sikap_dan_kepribadian', $sempro->sikap_dan_kepribadian) == '3.6' ? 'checked' : null }}>
                    <label for="sikap_dan_kepribadian2" class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('sikap_dan_kepribadian') is-invalid @enderror" type="radio" id="sikap_dan_kepribadian3" name="sikap_dan_kepribadian" value="5.4" onclick="hasil()" {{ old('sikap_dan_kepribadian', $sempro->sikap_dan_kepribadian) == '5.4' ? 'checked' : null }}>
                    <label for="sikap_dan_kepribadian3" class="form-check-label">Biasa</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('sikap_dan_kepribadian') is-invalid @enderror" type="radio" id="sikap_dan_kepribadian4" name="sikap_dan_kepribadian" value="7.2" onclick="hasil()" {{ old('sikap_dan_kepribadian', $sempro->sikap_dan_kepribadian) == '7.2' ? 'checked' : null }}>
                    <label for="sikap_dan_kepribadian4" class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('sikap_dan_kepribadian') is-invalid @enderror" type="radio" id="sikap_dan_kepribadian5" name="sikap_dan_kepribadian" value="9" onclick="hasil()" {{ old('sikap_dan_kepribadian', $sempro->sikap_dan_kepribadian) == '9' ? 'checked' : null }}>
                    <label for="sikap_dan_kepribadian5" class="form-check-label">Sangat Baik</label>
                  </div>                            
                   
                </div>                                                         
              </div>
              @error('sikap_dan_kepribadian')
                  <div class="invalid-feedback">
                    Error
                  </div>
              @enderror
              
              <div class="row g-3 align-items-center mb-3">
                <div class="col-auto totalnilaiangka">
                  <label for="total_nilai_angka" class="col-form-label">Total Nilai
                    <span class="badge badge-success ml-3">Angka</span>
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
                    <span class="badge badge-success ml-3">Huruf</span>
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
              <button type="submit" class="btn btn-success float-right">Save</button>
          </form> 
        </div>    
      </div>
    </div>  
  </div>
@endif

@if (auth()->user()->nip == $sempro->pengujisatu_nip || auth()->user()->nip == $sempro->pengujidua_nip || auth()->user()->nip == $sempro->pengujitiga_nip)
  
  <div class="card card-success card-tabs">
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
        @if (auth()->user()->nip == $sempro->pengujisatu_nip)
        <li class="nav-item">
          <a class="nav-link" id="custom-tabs-one-form-tab" data-toggle="pill"
            href="#custom-tabs-one-form" role="tab" aria-controls="custom-tabs-one-form"
            aria-selected="false">Revisi Judul</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="custom-tabs-one-setting-tab" data-toggle="pill"
            href="#custom-tabs-one-setting" role="tab" aria-controls="custom-tabs-one-setting"
            aria-selected="false">Berita Acara</a>
        </li>
        @endif               
      </ul>
    </div>

    <div class="card-body">
        <form action="/penilaian-sempro-penguji/create/{{$sempro->id}}" method="POST">
        @csrf
      <div class="tab-content" id="custom-tabs-one-tabContent">

          <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
            aria-labelledby="custom-tabs-one-home-tab">
            
            <div class="mb-3">
              <label for="presentasi" class="col-form-label">Presentasi</label>
              <div class="radio6 d-inline">

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('presentasi') is-invalid @enderror" type="radio" id="presentasi1" name="presentasi" value="1" onclick="total()" {{ old('presentasi', $sempro->presentasi) == '1' ? 'checked' : null }} >
                  <label for="presentasi1" class="form-check-label">Sangat Kurang Baik</label>
                </div>              

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('presentasi') is-invalid @enderror" type="radio" id="presentasi2" name="presentasi" value="2" onclick="total()" {{ old('presentasi', $sempro->presentasi) == '2' ? 'checked' : null }}>
                  <label for="presentasi2" class="form-check-label">Kurang Baik</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('presentasi') is-invalid @enderror" type="radio" id="presentasi3" name="presentasi" value="3" onclick="total()" {{ old('presentasi', $sempro->presentasi) == '3' ? 'checked' : null }}>
                  <label for="presentasi3" class="form-check-label">Biasa</label>
                </div>                  
                
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('presentasi') is-invalid @enderror" type="radio" id="presentasi4" name="presentasi" value="4" onclick="total()" {{ old('presentasi', $sempro->presentasi) == '4' ? 'checked' : null }}>
                  <label for="presentasi4" class="form-check-label">Baik</label>
                </div>                  

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('presentasi') is-invalid @enderror" type="radio" id="presentasi5" name="presentasi" value="5" onclick="total()" {{ old('presentasi', $sempro->presentasi) == '5' ? 'checked' : null }}>
                  <label for="presentasi5" class="form-check-label">Sangat Baik</label>
                </div>                                
                
              </div>                                                                       
            </div>
            @error('presentasi')
                <div class="invalid-feedback">
                  Error
                </div>
            @enderror

            <div class="mb-3">
              <label for="tingkat_penguasaan_materi" class="col-form-label">Tingkat Penguasaan Materi</label>
              <div class="radio7 d-inline">

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('tingkat_penguasaan_materi') is-invalid @enderror" type="radio" id="tingkat_penguasaan_materi1" name="tingkat_penguasaan_materi" value="1.6" onclick="total()" {{ old('tingkat_penguasaan_materi', $sempro->tingkat_penguasaan_materi) == '1.6' ? 'checked' : null }} >
                  <label for="tingkat_penguasaan_materi1" class="form-check-label">Sangat Kurang Baik</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('tingkat_penguasaan_materi') is-invalid @enderror" type="radio" id="tingkat_penguasaan_materi2" name="tingkat_penguasaan_materi" value="3.2" onclick="total()" {{ old('tingkat_penguasaan_materi', $sempro->tingkat_penguasaan_materi) == '3.2' ? 'checked' : null }} >
                  <label for="tingkat_penguasaan_materi2" class="form-check-label">Kurang Baik</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('tingkat_penguasaan_materi') is-invalid @enderror" type="radio" id="tingkat_penguasaan_materi3" name="tingkat_penguasaan_materi" value="4.8" onclick="total()" {{ old('tingkat_penguasaan_materi', $sempro->tingkat_penguasaan_materi) == '4.8' ? 'checked' : null }} >
                  <label for="tingkat_penguasaan_materi3" class="form-check-label">Biasa</label>
                </div>  
                
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('tingkat_penguasaan_materi') is-invalid @enderror" type="radio" id="tingkat_penguasaan_materi4" name="tingkat_penguasaan_materi" value="6.4" onclick="total()" {{ old('tingkat_penguasaan_materi', $sempro->tingkat_penguasaan_materi) == '6.4' ? 'checked' : null }} >
                  <label for="tingkat_penguasaan_materi4" class="form-check-label">Baik</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('tingkat_penguasaan_materi') is-invalid @enderror" type="radio" id="tingkat_penguasaan_materi5" name="tingkat_penguasaan_materi" value="8" onclick="total()" {{ old('tingkat_penguasaan_materi', $sempro->tingkat_penguasaan_materi) == '8' ? 'checked' : null }} >
                  <label for="tingkat_penguasaan_materi5" class="form-check-label">Sangat Baik</label>
                </div>                                                                   
                  
              </div>                                                         
            </div>
            @error('tingkat_penguasaan_materi')
                <div class="invalid-feedback">
                  Error
                </div>
            @enderror

            <div class="mb-3">
              <label for="keaslian" class="col-form-label">Keaslian</label>
              <div class="radio8 d-inline">

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('keaslian') is-invalid @enderror" type="radio" id="keaslian1" name="keaslian" value="1" onclick="total()" {{ old('keaslian', $sempro->keaslian) == '1' ? 'checked' : null }} >
                  <label for="keaslian1" class="form-check-label">Sangat Kurang Baik</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('keaslian') is-invalid @enderror" type="radio" id="keaslian2" name="keaslian" value="2" onclick="total()" {{ old('keaslian', $sempro->keaslian) == '2' ? 'checked' : null }} >
                  <label for="keaslian2" class="form-check-label">Kurang Baik</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('keaslian') is-invalid @enderror" type="radio" id="keaslian3" name="keaslian" value="3" onclick="total()" {{ old('keaslian', $sempro->keaslian) == '3' ? 'checked' : null }} >
                  <label for="keaslian3" class="form-check-label">Biasa</label>
                </div>  
                
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('keaslian') is-invalid @enderror" type="radio" id="keaslian4" name="keaslian" value="4" onclick="total()" {{ old('keaslian', $sempro->keaslian) == '4' ? 'checked' : null }} >
                  <label for="keaslian4" class="form-check-label">Baik</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('keaslian') is-invalid @enderror" type="radio" id="keaslian5" name="keaslian" value="5" onclick="total()" {{ old('keaslian', $sempro->keaslian) == '5' ? 'checked' : null }} >
                  <label for="keaslian5" class="form-check-label">Sangat Baik</label>
                </div>                                                                   
                
              </div>                                                         
            </div>
            @error('keaslian')
                <div class="invalid-feedback">
                  Error
                </div>
            @enderror

            <div class="mb-3">
              <label for="ketepatan_metodologi" class="col-form-label">Ketepatan Metodologi</label>
              <div class="radio9 d-inline">

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('ketepatan_metodologi') is-invalid @enderror" type="radio" id="ketepatan_metodologi1" name="ketepatan_metodologi" value="1.4" onclick="total()" {{ old('ketepatan_metodologi', $sempro->ketepatan_metodologi) == '1.4' ? 'checked' : null }} >
                  <label for="ketepatan_metodologi1" class="form-check-label">Sangat Kurang Baik</label>                    
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('ketepatan_metodologi') is-invalid @enderror" type="radio" id="ketepatan_metodologi2" name="ketepatan_metodologi" value="2.8" onclick="total()" {{ old('ketepatan_metodologi', $sempro->ketepatan_metodologi) == '2.8' ? 'checked' : null }} >
                  <label for="ketepatan_metodologi2" class="form-check-label">Kurang Baik</label>  
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('ketepatan_metodologi') is-invalid @enderror" type="radio" id="ketepatan_metodologi3" name="ketepatan_metodologi" value="4.2" onclick="total()" {{ old('ketepatan_metodologi', $sempro->ketepatan_metodologi) == '4.2' ? 'checked' : null }} >
                  <label for="ketepatan_metodologi3" class="form-check-label">Biasa</label>  
                </div>  
                
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('ketepatan_metodologi') is-invalid @enderror" type="radio" id="ketepatan_metodologi4" name="ketepatan_metodologi" value="5.6" onclick="total()" {{ old('ketepatan_metodologi', $sempro->ketepatan_metodologi) == '5.6' ? 'checked' : null }} >
                  <label for="ketepatan_metodologi4" class="form-check-label">Baik</label>  
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('ketepatan_metodologi') is-invalid @enderror" type="radio" id="ketepatan_metodologi5" name="ketepatan_metodologi" value="7" onclick="total()" {{ old('ketepatan_metodologi', $sempro->ketepatan_metodologi) == '7' ? 'checked' : null }} >
                  <label for="ketepatan_metodologi5" class="form-check-label">Sangat Baik</label>  
                </div>                                                                   
                
              </div>                                                         
            </div>
            @error('ketepatan_metodologi')
                <div class="invalid-feedback">
                  Error
                </div>
            @enderror

            <div class="mb-3">
              <label for="penguasaan_dasar_teori" class="col-form-label">Penguasaan Dasar Teori</label>
              <div class="radio10 d-inline">

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('penguasaan_dasar_teori') is-invalid @enderror" type="radio" id="penguasaan_dasar_teori1" name="penguasaan_dasar_teori" value="1.2" onclick="total()" {{ old('penguasaan_dasar_teori', $sempro->penguasaan_dasar_teori) == '1.2' ? 'checked' : null }} >
                  <label for="penguasaan_dasar_teori1" class="form-check-label">Sangat Kurang Baik</label>                    
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('penguasaan_dasar_teori') is-invalid @enderror" type="radio" id="penguasaan_dasar_teori2" name="penguasaan_dasar_teori" value="2.4" onclick="total()" {{ old('penguasaan_dasar_teori', $sempro->penguasaan_dasar_teori) == '2.4' ? 'checked' : null }} >
                  <label for="penguasaan_dasar_teori2" class="form-check-label">Kurang Baik</label> 
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('penguasaan_dasar_teori') is-invalid @enderror" type="radio" id="penguasaan_dasar_teori3" name="penguasaan_dasar_teori" value="3.6" onclick="total()" {{ old('penguasaan_dasar_teori', $sempro->penguasaan_dasar_teori) == '3.6' ? 'checked' : null }} >
                  <label for="penguasaan_dasar_teori3" class="form-check-label">Biasa</label> 
                </div>  
                
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('penguasaan_dasar_teori') is-invalid @enderror" type="radio" id="penguasaan_dasar_teori4" name="penguasaan_dasar_teori" value="4.8" onclick="total()" {{ old('penguasaan_dasar_teori', $sempro->penguasaan_dasar_teori) == '4.8' ? 'checked' : null }} >
                  <label for="penguasaan_dasar_teori4" class="form-check-label">Baik</label> 
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('penguasaan_dasar_teori') is-invalid @enderror" type="radio" id="penguasaan_dasar_teori5" name="penguasaan_dasar_teori" value="6" onclick="total()" {{ old('penguasaan_dasar_teori', $sempro->penguasaan_dasar_teori) == '6' ? 'checked' : null }} >
                  <label for="penguasaan_dasar_teori5" class="form-check-label">Sangat Baik</label> 
                </div>                                                                   
                
              </div>                                                         
            </div>
            @error('penguasaan_dasar_teori')
            <div class="invalid-feedback">
              Error
            </div>
            @enderror

            <div class="mb-3">
              <label for="kecermatan_perumusan_masalah" class="col-form-label">Kecermatan Perumusan Masalah</label>
              <div class="radio11 d-inline">

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('kecermatan_perumusan_masalah') is-invalid @enderror" type="radio" id="kecermatan_perumusan_masalah1" name="kecermatan_perumusan_masalah" value="1.2" onclick="total()" {{ old('kecermatan_perumusan_masalah', $sempro->kecermatan_perumusan_masalah) == '1.2' ? 'checked' : null }} >
                  <label for="kecermatan_perumusan_masalah1" class="form-check-label">Sangat Kurang Baik</label>                     
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('kecermatan_perumusan_masalah') is-invalid @enderror" type="radio" id="kecermatan_perumusan_masalah2" name="kecermatan_perumusan_masalah" value="2.4" onclick="total()" {{ old('kecermatan_perumusan_masalah', $sempro->kecermatan_perumusan_masalah) == '2.4' ? 'checked' : null }} >
                  <label for="kecermatan_perumusan_masalah2" class="form-check-label">Kurang Baik</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('kecermatan_perumusan_masalah') is-invalid @enderror" type="radio" id="kecermatan_perumusan_masalah3" name="kecermatan_perumusan_masalah" value="3.6" onclick="total()" {{ old('kecermatan_perumusan_masalah', $sempro->kecermatan_perumusan_masalah) == '3.6' ? 'checked' : null }} >
                  <label for="kecermatan_perumusan_masalah3" class="form-check-label">Biasa</label>
                </div>  
                
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('kecermatan_perumusan_masalah') is-invalid @enderror" type="radio" id="kecermatan_perumusan_masalah4" name="kecermatan_perumusan_masalah" value="4.8" onclick="total()" {{ old('kecermatan_perumusan_masalah', $sempro->kecermatan_perumusan_masalah) == '4.8' ? 'checked' : null }} >
                  <label for="kecermatan_perumusan_masalah4" class="form-check-label">Baik</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('kecermatan_perumusan_masalah') is-invalid @enderror" type="radio" id="kecermatan_perumusan_masalah5" name="kecermatan_perumusan_masalah" value="6" onclick="total()" {{ old('kecermatan_perumusan_masalah', $sempro->kecermatan_perumusan_masalah) == '6' ? 'checked' : null }} >
                  <label for="kecermatan_perumusan_masalah5" class="form-check-label">Sangat Baik</label>
                </div>                                                                   
                
              </div>                                                         
            </div>
            @error('kecermatan_perumusan_masalah')
            <div class="invalid-feedback">
              Error
            </div>
            @enderror

            <div class="mb-3">
              <label for="tinjauan_pustaka" class="col-form-label">Tinjauan Pustaka</label>
              <div class="radio12 d-inline">

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('tinjauan_pustaka') is-invalid @enderror" type="radio" id="tinjauan_pustaka1" name="tinjauan_pustaka" value="1.4" onclick="total()" {{ old('tinjauan_pustaka', $sempro->tinjauan_pustaka) == '1.4' ? 'checked' : null }} >
                  <label for="tinjauan_pustaka1" class="form-check-label">Sangat Kurang Baik</label>                    
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('tinjauan_pustaka') is-invalid @enderror" type="radio" id="tinjauan_pustaka2" name="tinjauan_pustaka" value="2.8" onclick="total()" {{ old('tinjauan_pustaka', $sempro->tinjauan_pustaka) == '2.8' ? 'checked' : null }} >
                  <label for="tinjauan_pustaka2" class="form-check-label">Kurang Baik</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('tinjauan_pustaka') is-invalid @enderror" type="radio" id="tinjauan_pustaka3" name="tinjauan_pustaka" value="4.2" onclick="total()" {{ old('tinjauan_pustaka', $sempro->tinjauan_pustaka) == '4.2' ? 'checked' : null }} >
                  <label for="tinjauan_pustaka3" class="form-check-label">Biasa</label>  
                </div>  
                
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('tinjauan_pustaka') is-invalid @enderror" type="radio" id="tinjauan_pustaka4" name="tinjauan_pustaka" value="5.6" onclick="total()" {{ old('tinjauan_pustaka', $sempro->tinjauan_pustaka) == '5.6' ? 'checked' : null }} >
                  <label for="tinjauan_pustaka4" class="form-check-label">Baik</label>  
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('tinjauan_pustaka') is-invalid @enderror" type="radio" id="tinjauan_pustaka5" name="tinjauan_pustaka" value="7" onclick="total()" {{ old('tinjauan_pustaka', $sempro->tinjauan_pustaka) == '7' ? 'checked' : null }} >
                  <label for="tinjauan_pustaka5" class="form-check-label">Sangat Baik</label>  
                </div>                                                                   
                
              </div>                                                         
            </div>
            @error('tinjauan_pustaka')
            <div class="invalid-feedback">
              Error
            </div>
            @enderror

            <div class="mb-3">
              <label for="tata_tulis" class="col-form-label">Tata Tulis</label>
              <div class="radio13 d-inline">

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('tata_tulis') is-invalid @enderror" type="radio" id="tata_tulis1" name="tata_tulis" value="1" onclick="total()" {{ old('tata_tulis', $sempro->tata_tulis) == '1' ? 'checked' : null }} >
                  <label for="tata_tulis1" class="form-check-label">Sangat Kurang Baik</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('tata_tulis') is-invalid @enderror" type="radio" id="tata_tulis2" name="tata_tulis" value="2" onclick="total()" {{ old('tata_tulis', $sempro->tata_tulis) == '2' ? 'checked' : null }} >
                  <label for="tata_tulis2" class="form-check-label">Kurang Baik</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('tata_tulis') is-invalid @enderror" type="radio" id="tata_tulis3" name="tata_tulis" value="3" onclick="total()" {{ old('tata_tulis', $sempro->tata_tulis) == '3' ? 'checked' : null }} >
                  <label for="tata_tulis3" class="form-check-label">Biasa</label>
                </div>  
                
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('tata_tulis') is-invalid @enderror" type="radio" id="tata_tulis4" name="tata_tulis" value="4" onclick="total()" {{ old('tata_tulis', $sempro->tata_tulis) == '4' ? 'checked' : null }} >
                  <label for="tata_tulis4" class="form-check-label">Baik</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('tata_tulis') is-invalid @enderror" type="radio" id="tata_tulis5" name="tata_tulis" value="5" onclick="total()" {{ old('tata_tulis', $sempro->tata_tulis) == '5' ? 'checked' : null }} >
                  <label for="tata_tulis5" class="form-check-label">Sangat Baik</label>
                </div>                                                                   
                
              </div>                                                         
            </div>
            @error('tata_tulis')
            <div class="invalid-feedback">
              Error
            </div>
            @enderror

            <div class="mb-3">
              <label for="sumbangan_pemikiran" class="col-form-label">Sumbangan Pemikiran Terhadap Ilmu Pengetahuan</label>
              <div class="radio14 d-inline">

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('sumbangan_pemikiran') is-invalid @enderror" type="radio" id="sumbangan_pemikiran1" name="sumbangan_pemikiran" value="1.2" onclick="total()" {{ old('sumbangan_pemikiran', $sempro->sumbangan_pemikiran) == '1.2' ? 'checked' : null }} >
                  <label for="sumbangan_pemikiran1" class="form-check-label">Sangat Kurang Baik</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('sumbangan_pemikiran') is-invalid @enderror" type="radio" id="sumbangan_pemikiran2" name="sumbangan_pemikiran" value="2.4" onclick="total()" {{ old('sumbangan_pemikiran', $sempro->sumbangan_pemikiran) == '2.4' ? 'checked' : null }} >
                  <label for="sumbangan_pemikiran2" class="form-check-label">Kurang Baik</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('sumbangan_pemikiran') is-invalid @enderror" type="radio" id="sumbangan_pemikiran3" name="sumbangan_pemikiran" value="3.6" onclick="total()" {{ old('sumbangan_pemikiran', $sempro->sumbangan_pemikiran) == '3.6' ? 'checked' : null }} >
                  <label for="sumbangan_pemikiran3" class="form-check-label">Biasa</label>
                </div>  
                
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('sumbangan_pemikiran') is-invalid @enderror" type="radio" id="sumbangan_pemikiran4" name="sumbangan_pemikiran" value="4.8" onclick="total()" {{ old('sumbangan_pemikiran', $sempro->sumbangan_pemikiran) == '4.8' ? 'checked' : null }} >
                  <label for="sumbangan_pemikiran4" class="form-check-label">Baik</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('sumbangan_pemikiran') is-invalid @enderror" type="radio" id="sumbangan_pemikiran5" name="sumbangan_pemikiran" value="6" onclick="total()" {{ old('sumbangan_pemikiran', $sempro->sumbangan_pemikiran) == '6' ? 'checked' : null }} >
                  <label for="sumbangan_pemikiran5" class="form-check-label">Sangat Baik</label>
                </div>                                                                   
                
              </div>                                                         
            </div>
            @error('sumbangan_pemikiran')
            <div class="invalid-feedback">
              Error
            </div>
            @enderror
                              
            <div class="row g-3 align-items-center mb-3">
              <div class="col-auto totalnilaiangka">
                <label for="total_nilai_angka" class="col-form-label">Total Nilai
                  <span class="badge badge-success ml-3">Angka</span>
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
                  <span class="badge badge-success ml-3">Huruf</span>
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
            </form> 
          </div>
                            
        @if (auth()->user()->nip == $sempro->pengujisatu_nip)

          <div class="tab-pane fade" id="custom-tabs-one-form" role="tabpanel"
            aria-labelledby="custom-tabs-one-form-tab">

            <form action="/revisi-naskah/create/{{$sempro->id}}" method="POST">
              @csrf
              <div class="mb-3">
                <label class="form-label">Judul Lama</label>
                <input type="text" class="form-control" value="{{$sempro->judul_proposal}}" readonly>  
              </div>
              <div class="mb-3">
                <label class="form-label">Judul Baru</label>
                <input type="text" name="revisi_naskah" class="form-control" value="{{ $sempro->revisi_naskah != null ? $sempro->revisi_naskah : '' }}" {{ $sempro->revisi_naskah != null ? 'readonly': '' }}>
              </div>              
              <button type="submit" class="btn btn-primary">Update</button>
            </form>

          </div>
        
          <div class="tab-pane fade" id="custom-tabs-one-setting" role="tabpanel"
            aria-labelledby="custom-tabs-one-setting-tab">
            <div>
              <div class="row">
                  <div class="col-lg-6">
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th style="width: 200px">Penilaian Penguji</th>
                                  <th class="bg-success" style="width: 30px">B</th>
                                  <th>Penguji 1</th>
                                  <th>Penguji 2</th>
                                  <th>Penguji 3</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>1</td>  
                                  <td>Presentasi</td>
                                  <td class="bg-secondary">5</td>
                                  <td>{{$nilaipenguji1 != '' ? $nilaipenguji1->presentasi : '-' }}</td>                            

                                  <td>{{$nilaipenguji2 != '' ? $nilaipenguji2->presentasi : '-'}}</td>                                           
                                  <td>{{$nilaipenguji3 != '' ? $nilaipenguji3->presentasi : '-'}}</td>                                           
                              </tr>
                              <tr>
                                  <td>2</td> 
                                  <td>Tingkat Penguasaan Materi</td>
                                  <td class="bg-secondary">8</td>
                                  <td>{{$nilaipenguji1 != '' ? $nilaipenguji1->tingkat_penguasaan_materi : '-'}}</td>                                           
                                  <td>{{$nilaipenguji2 != '' ? $nilaipenguji2->tingkat_penguasaan_materi : '-'}}</td>                                           
                                  <td>{{$nilaipenguji3 != '' ? $nilaipenguji3->tingkat_penguasaan_materi : '-'}}</td>                       
                              </tr>
                              <tr>
                                  <td>3</td>
                                  <td>Keaslian</td>
                                  <td class="bg-secondary">5</td>
                                  <td>{{$nilaipenguji1 != '' ? $nilaipenguji1->keaslian : '-'}}</td>                                           
                                  <td>{{$nilaipenguji2 != '' ? $nilaipenguji2->keaslian : '-'}}</td>                                         
                                  <td>{{$nilaipenguji3 != '' ? $nilaipenguji3->keaslian : '-'}}</td>
                              </tr>
                              <tr>
                                  <td>4</td> 
                                  <td>Ketepatan Metodologi</td>
                                  <td class="bg-secondary">7</td>
                                  <td>{{$nilaipenguji1 != '' ?$nilaipenguji1->ketepatan_metodologi : '-'}}</td>                                           
                                  <td>{{$nilaipenguji2 != '' ?$nilaipenguji2->ketepatan_metodologi : '-'}}</td>                                            
                                  <td>{{$nilaipenguji3 != '' ?$nilaipenguji3->ketepatan_metodologi : '-'}}</td> 
                              </tr>
                              <tr>
                                  <td>5</td> 
                                  <td>Penguasaan Dasar Teori</td>
                                  <td class="bg-secondary">6</td>
                                  <td>{{$nilaipenguji1 != '' ?$nilaipenguji1->penguasaan_dasar_teori : '-'}}</td>                                           
                                  <td>{{$nilaipenguji2 != '' ?$nilaipenguji2->penguasaan_dasar_teori : '-'}}</td>                                           
                                  <td>{{$nilaipenguji3 != '' ?$nilaipenguji3->penguasaan_dasar_teori : '-'}}</td>                        
                              </tr>
                              <tr>
                                  <td>6</td>       
                                  <td>Kecermatan Perumusan Masalah</td>
                                  <td class="bg-secondary">6</td>
                                  <td>{{$nilaipenguji1 != '' ?$nilaipenguji1->kecermatan_perumusan_masalah : '-'}}</td>                                           
                                  <td>{{$nilaipenguji2 != '' ?$nilaipenguji2->kecermatan_perumusan_masalah : '-'}}</td>                                           
                                  <td>{{$nilaipenguji3 != '' ?$nilaipenguji3->kecermatan_perumusan_masalah : '-'}}</td>                   
                              </tr>
                              <tr>
                                  <td>7</td>        
                                  <td>Tinjauan Pustaka</td>
                                  <td class="bg-secondary">7</td>
                                  <td>{{$nilaipenguji1 != '' ?$nilaipenguji1->tinjauan_pustaka : '-'}}</td>                                           
                                  <td>{{$nilaipenguji2 != '' ?$nilaipenguji2->tinjauan_pustaka : '-'}}</td>
                                  <td>{{$nilaipenguji3 != '' ?$nilaipenguji3->tinjauan_pustaka : '-'}}</td>
                              </tr>
                              <tr>
                                  <td>8</td>
                                  <td>Tata Tulis</td>
                                  <td class="bg-secondary">5</td>
                                  <td>{{$nilaipenguji1 != '' ? $nilaipenguji1->tata_tulis : '-'}}</td>                                           
                                  <td>{{$nilaipenguji2 != '' ? $nilaipenguji2->tata_tulis : '-'}}</td>                                          
                                  <td>{{$nilaipenguji3 != '' ? $nilaipenguji3->tata_tulis : '-'}}</td>
                              </tr>
                              <tr>
                                  <td>9</td>
                                  <td>Sumbangan Pemikiran Terhadap Ilmu Pengetahuan dan Penerapannya</td>
                                  <td class="bg-secondary">6</td>
                                  <td>{{$nilaipenguji1 != '' ? $nilaipenguji1->sumbangan_pemikiran : '-'}}</td>                                           
                                  <td>{{$nilaipenguji2 != '' ? $nilaipenguji2->sumbangan_pemikiran : '-'}}</td>                                           
                                  <td>{{$nilaipenguji3 != '' ? $nilaipenguji3->sumbangan_pemikiran : '-'}}</td>
                              </tr>
          
                              <tr>
                                  <td colspan="2">Total Nilai Penguji</td>
                                  <td class="bg-success">55</td>
                                  <td>{{$nilaipenguji1 != '' ?$nilaipenguji1->total_nilai_angka : '-'}}</td>                                           
                                  <td>{{$nilaipenguji2 != '' ?$nilaipenguji2->total_nilai_angka : '-'}}</td>                                           
                                  <td>{{$nilaipenguji3 != '' ?$nilaipenguji3->total_nilai_angka : '-'}}</td>
                              </tr>
                              <tr>
                                  <td colspan="3">Nilai Huruf Penguji</td>                        
                                  <td>{{$nilaipenguji1 != '' ? $nilaipenguji1->total_nilai_huruf : '-'}}</td>                                           
                                  <td>{{$nilaipenguji2 != '' ? $nilaipenguji2->total_nilai_huruf : '-'}}</td>                                           
                                  <td>{{$nilaipenguji3 != '' ? $nilaipenguji3->total_nilai_huruf : '-'}}</td>
                              </tr>
                              <tr>                        
                                  <td colspan="3">Rata Rata Nilai Penguji</td>
                                  <td class="text-center" colspan="3">
                                      <h3 class="text-bold">
                                        @if ($nilaipenguji1 && $nilaipenguji2 && $nilaipenguji3)
                                        {{round(($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) }}
                                        @else
                                        -
                                        @endif
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
                                <th class="bg-success">B</th>
                                <th>Pembimbing 1</th>
                                <th>Pembimbing 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Penguasaan Dasar Teori</td>
                                <td class="bg-secondary">9</td>
                                <td>{{ $nilaipembimbing1 != '' ? $nilaipembimbing1->penguasaan_dasar_teori : '-' }}
                                </td>
                                <td>{{ $nilaipembimbing2 != '' ? $nilaipembimbing2->penguasaan_dasar_teori : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Tingkat Penguasaan Materi</td>
                                <td class="bg-secondary">9</td>
                                <td>{{ $nilaipembimbing1 != '' ? $nilaipembimbing1->tingkat_penguasaan_materi : '-' }}
                                </td>
                                <td>{{ $nilaipembimbing2 != '' ? $nilaipembimbing2->tingkat_penguasaan_materi : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Tinjauan Pustaka</td>
                                <td class="bg-secondary">9</td>
                                <td>{{ $nilaipembimbing1 != '' ? $nilaipembimbing1->tinjauan_pustaka : '-' }}
                                </td>
                                <td>{{ $nilaipembimbing2 != '' ? $nilaipembimbing2->tinjauan_pustaka : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Tata Tulis</td>
                                <td class="bg-secondary">9</td>
                                <td>{{ $nilaipembimbing1 != '' ? $nilaipembimbing1->tata_tulis : '-' }}
                                </td>
                                <td>{{ $nilaipembimbing2 != '' ? $nilaipembimbing2->tata_tulis : '-' }}
                                </td>
                            </tr>                            
                            <tr>
                                <td>5</td>
                                <td>Sikap dan Kepribadian Ketika Bimbingan</td>
                                <td class="bg-secondary">9</td>
                                <td>{{ $nilaipembimbing1 != '' ? $nilaipembimbing1->sikap_dan_kepribadian : '-' }}
                                </td>
                                <td>{{ $nilaipembimbing2 != '' ? $nilaipembimbing2->sikap_dan_kepribadian : '-' }}
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">Total Nilai Pembimbing</td>
                                <td class="bg-success">45</td>
                                <td>{{ $nilaipembimbing1 != '' ? $nilaipembimbing1->total_nilai_angka : '-' }}
                                </td>
                                <td>{{ $nilaipembimbing2 != '' ? $nilaipembimbing2->total_nilai_angka : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">Nilai Huruf Pembimbing</td>
                                <td>{{ $nilaipembimbing1 != '' ? $nilaipembimbing1->total_nilai_huruf : '-' }}
                                </td>
                                <td>{{ $nilaipembimbing2 != '' ? $nilaipembimbing2->total_nilai_huruf : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">Rata Rata Nilai Pembimbing</td>
                                <td class="text-center" colspan="2">
                                    <h3 class="text-bold">
                                        @if ($penjadwalan->pembimbingdua_nip == null)
                                            @if ($nilaipembimbing1 != '')
                                                {{ $nilaipembimbing1->total_nilai_angka }}
                                            @else
                                                -
                                            @endif
                                        @else
                                            @if ($nilaipembimbing1 != '' && $nilaipembimbing2 != '')
                                                {{ round(($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2) }}
                                            @else
                                                -
                                            @endif
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
                                <td class="bg-success text-center">
                                    <h3 class="text-bold">
                                        @if ($penjadwalan->pembimbingdua_nip == null)
                                            @if ($nilaipembimbing1 != '')
                                                @if ($nilaipenguji1 == '' || $nilaipenguji2 == '' || $nilaipenguji3 == '')
                                                    -
                                                @else
                                                    {{ round(($nilaipembimbing1->total_nilai_angka + ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) / 2) }}
                                                @endif
                                            @endif
                                        @else
                                            @if ($nilaipembimbing1 != '' && $nilaipembimbing2 != '')
                                                @if ($nilaipenguji1 == '' || $nilaipenguji2 == '' || $nilaipenguji3 == '')
                                                    -
                                                @else
                                                    {{ round((($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 + ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) / 2) }}
                                                @endif
                                            @else
                                                -
                                            @endif
                                        @endif

                                    </h3>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 250px">NILAI HURUF</td>

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
                                              85)
                                              A
                                          @elseif (($nilaipembimbing1->total_nilai_angka +
                                              ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) /
                                              2 >=
                                              80)
                                              A-
                                          @elseif (($nilaipembimbing1->total_nilai_angka +
                                              ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) /
                                              2 >=
                                              75)
                                              B+
                                          @elseif (($nilaipembimbing1->total_nilai_angka +
                                              ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) /
                                              2 >=
                                              70)
                                              B
                                          @elseif (($nilaipembimbing1->total_nilai_angka +
                                              ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) /
                                              2 >=
                                              65)
                                              B-
                                          @elseif (($nilaipembimbing1->total_nilai_angka +
                                              ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) /
                                              2 >=
                                              60)
                                              C+
                                          @elseif (($nilaipembimbing1->total_nilai_angka +
                                              ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) /
                                              2 >=
                                              55)
                                              C
                                          @elseif (($nilaipembimbing1->total_nilai_angka +
                                              ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) /
                                              2 >=
                                              40)
                                              D
                                          @else
                                              E
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
                                                    2 >=
                                                    85)
                                                    A
                                                @elseif ((($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 +
                                                    ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) /
                                                    2 >=
                                                    80)
                                                    A-
                                                @elseif ((($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 +
                                                    ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) /
                                                    2 >=
                                                    75)
                                                    B+
                                                @elseif ((($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 +
                                                    ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) /
                                                    2 >=
                                                    70)
                                                    B
                                                @elseif ((($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 +
                                                    ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) /
                                                    2 >=
                                                    65)
                                                    B-
                                                @elseif ((($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 +
                                                    ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) /
                                                    2 >=
                                                    60)
                                                    C+
                                                @elseif ((($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 +
                                                    ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) /
                                                    2 >=
                                                    55)
                                                    C
                                                @elseif ((($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 +
                                                    ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) /
                                                    2 >=
                                                    40)
                                                    D
                                                @else
                                                    E
                                                @endif
                                            @endif
                                          @else
                                          -
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
                                            LAYAK LULUS                                            
                                        @else
                                            TIDAK LAYAK LULUS
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
                                                  LAYAK LULUS
                                              @else
                                                  TIDAK LAYAK LULUS
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
                  </div>
              </div>
            </div>  
                
                      @if ($penjadwalan->status_seminar == 0)
                      @if ($penjadwalan->cek($penjadwalan->id) == $penjadwalan->jmlpenilaian($penjadwalan->id))
                      @if ($penjadwalan->pengujisatu_nip == auth()->user()->nip)                    
                      <form action="/penilaian-sempro/approve/{{$penjadwalan->id}}" method="POST">
                          @method('put')
                          @csrf
                          <button type="submit" class="btn btn-lg btn-success float-right"> Approve Penilaian</button>
                      </form>
                      @endif
                      @endif
                      @endif                                                          
        
          </div>        
          
        @endif    
      </div>  
    </div>  
  </div>  

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
      else if(total_angka >= 80){
        $('input[name="total_nilai_huruf"]').val("A-");
      }
      else if(total_angka > 75){
        $('input[name="total_nilai_huruf"]').val("B+");
      }   
      else if(total_angka > 70){
        $('input[name="total_nilai_huruf"]').val("B");
      }   
      else if(total_angka > 65){
        $('input[name="total_nilai_huruf"]').val("B-");
      }
      else if(total_angka > 60){
        $('input[name="total_nilai_huruf"]').val("C+");
      }
      else if(total_angka > 55){
        $('input[name="total_nilai_huruf"]').val("C");
      }
      else if(total_angka > 40){
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
      else if(angka > 80){
        $('input[name="total_nilai_huruf"]').val("A-");
      }
      else if(angka > 75){
        $('input[name="total_nilai_huruf"]').val("B+");
      }   
      else if(angka > 70){
        $('input[name="total_nilai_huruf"]').val("B");
      }   
      else if(angka > 65){
        $('input[name="total_nilai_huruf"]').val("B-");
      }
      else if(angka > 60){
        $('input[name="total_nilai_huruf"]').val("C+");
      }
      else if(angka > 55){
        $('input[name="total_nilai_huruf"]').val("C");
      }
      else if(angka > 40){
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

@push('scripts')
  <script>
    window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
      });
    }, 2000);
  </script>
@endpush()