@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('header')
    Penilaian Skripsi | SIA Elektro
@endsection

@section('sub-title')
    Penilaian Sidang Skripsi
@endsection

@section('content')

<div class="row mb-5">
  <div class="col-6">
    <ol class="list-group"style="box-shadow: 2px 2px 2px 2px #dbdbdb; border-radius:20px;">
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">NIM</div>
          <span>{{$skripsi->nim}}</span>
        </div>        
      </li> 
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Nama</div>
          <span>{{$skripsi->nama}}</span>
        </div>        
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Judul</div>
          <span>{{$skripsi->judul_skripsi}}</span>
        </div>        
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Jadwal</div>          
          <span>{{Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y')}}, {{$skripsi->waktu}}</span>
        </div>        
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Lokasi</div>
          <span>{{$skripsi->lokasi}}</span>
        </div>        
      </li>   
    </ol>
  </div>
  
  <div class="col-6">
    <ol class="list-group"style="box-shadow: 2px 2px 2px 2px #dbdbdb; border-radius:20px;">
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Pembimbing</div>
          <span>{{$skripsi->pembimbingsatu->nama}}</span>                                      
          @if ($skripsi->pembimbingdua == !null)
          <br>
          <br>
          <span>{{$skripsi->pembimbingdua->nama}}</span>                             
          @endif
        </div>        
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Penguji</div>
          <span>{{$skripsi->pengujisatu->nama}}</span> 
          <br>                   
          <br>                   
          <span>{{$skripsi->pengujidua->nama}}</span>
          <br>                    
          <br>                    
          <span>{{$skripsi->pengujitiga->nama}}</span>                    
        </div>        
      </li>     
    </ol>
  </div>
</div>


@if (auth()->user()->nip == $skripsi->pembimbingsatu_nip || auth()->user()->nip == $skripsi->pembimbingdua_nip)
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
          <form action="/penilaian-skripsi-pembimbing/create/{{$skripsi->id}}" method="POST">
            @csrf              

              <div class="mb-3">
                <label for="penguasaan_dasar_teori" class="col-form-label">Penguasaan Dasar Teori</label>
                <div class="radio1 d-inline">

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('penguasaan_dasar_teori') is-invalid @enderror" type="radio" id="penguasaan_dasar_teori1" name="penguasaan_dasar_teori" value="2" onclick="hasil()" {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == '2' ? 'checked' : null }} >
                    <label for="penguasaan_dasar_teori1" class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('penguasaan_dasar_teori') is-invalid @enderror" type="radio" id="penguasaan_dasar_teori2" name="penguasaan_dasar_teori" value="4" onclick="hasil()" {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == '4' ? 'checked' : null }} >
                    <label for="penguasaan_dasar_teori2" class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('penguasaan_dasar_teori') is-invalid @enderror" type="radio" id="penguasaan_dasar_teori3" name="penguasaan_dasar_teori" value="6" onclick="hasil()" {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == '6' ? 'checked' : null }} >
                    <label for="penguasaan_dasar_teori3" class="form-check-label">Biasa</label>
                  </div>  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('penguasaan_dasar_teori') is-invalid @enderror" type="radio" id="penguasaan_dasar_teori4" name="penguasaan_dasar_teori" value="8" onclick="hasil()" {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == '8' ? 'checked' : null }} >
                    <label for="penguasaan_dasar_teori4" class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('penguasaan_dasar_teori') is-invalid @enderror" type="radio" id="penguasaan_dasar_teori5" name="penguasaan_dasar_teori" value="10" onclick="hasil()" {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == '10' ? 'checked' : null }} >
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
                    <input class="form-check-input @error ('tingkat_penguasaan_materi') is-invalid @enderror" type="radio" id="tingkat_penguasaan_materi1" name="tingkat_penguasaan_materi" value="2" onclick="hasil()" {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == '2' ? 'checked' : null }} >
                    <label for="tingkat_penguasaan_materi1" class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tingkat_penguasaan_materi') is-invalid @enderror" type="radio" id="tingkat_penguasaan_materi2" name="tingkat_penguasaan_materi" value="4" onclick="hasil()" {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == '4' ? 'checked' : null }} >
                    <label for="tingkat_penguasaan_materi2" class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tingkat_penguasaan_materi') is-invalid @enderror" type="radio" id="tingkat_penguasaan_materi3" name="tingkat_penguasaan_materi" value="6" onclick="hasil()" {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == '6' ? 'checked' : null }} >
                    <label for="tingkat_penguasaan_materi3" class="form-check-label">Biasa</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tingkat_penguasaan_materi') is-invalid @enderror" type="radio" id="tingkat_penguasaan_materi4" name="tingkat_penguasaan_materi" value="8" onclick="hasil()" {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == '8' ? 'checked' : null }} >
                    <label for="tingkat_penguasaan_materi4" class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tingkat_penguasaan_materi') is-invalid @enderror" type="radio" id="tingkat_penguasaan_materi5" name="tingkat_penguasaan_materi" value="10" onclick="hasil()" {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == '10' ? 'checked' : null }} >
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
                    <input class="form-check-input @error ('tinjauan_pustaka') is-invalid @enderror" type="radio" id="tinjauan_pustaka1" name="tinjauan_pustaka" value="1.8" onclick="hasil()" {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == '1.8' ? 'checked' : null }}>
                    <label for="tinjauan_pustaka1" class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tinjauan_pustaka') is-invalid @enderror" type="radio" id="tinjauan_pustaka2" name="tinjauan_pustaka" value="3.6" onclick="hasil()" {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == '3.6' ? 'checked' : null }}>
                    <label for="tinjauan_pustaka2" class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tinjauan_pustaka') is-invalid @enderror" type="radio" id="tinjauan_pustaka3" name="tinjauan_pustaka" value="5.4" onclick="hasil()" {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == '5.4' ? 'checked' : null }}>
                    <label for="tinjauan_pustaka3" class="form-check-label">Biasa</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tinjauan_pustaka') is-invalid @enderror" type="radio" id="tinjauan_pustaka4" name="tinjauan_pustaka" value="7.2" onclick="hasil()" {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == '7.2' ? 'checked' : null }}>
                    <label for="tinjauan_pustaka4" class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tinjauan_pustaka') is-invalid @enderror" type="radio" id="tinjauan_pustaka5" name="tinjauan_pustaka" value="9" onclick="hasil()" {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == '9' ? 'checked' : null }}>
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
                    <input class="form-check-input @error ('tata_tulis') is-invalid @enderror" type="radio" id="tata_tulis1" name="tata_tulis" value="1.6" onclick="hasil()" {{ old('tata_tulis', $skripsi->tata_tulis) == '1.6' ? 'checked' : null }}>
                    <label for="tata_tulis1" class="form-check-label">Sangat Kurang Baik</label>       
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tata_tulis') is-invalid @enderror" type="radio" id="tata_tulis2" name="tata_tulis" value="3.2" onclick="hasil()" {{ old('tata_tulis', $skripsi->tata_tulis) == '3.2' ? 'checked' : null }}>
                    <label for="tata_tulis2" class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tata_tulis') is-invalid @enderror" type="radio" id="tata_tulis3" name="tata_tulis" value="4.8" onclick="hasil()" {{ old('tata_tulis', $skripsi->tata_tulis) == '4.8' ? 'checked' : null }}>
                    <label for="tata_tulis3" class="form-check-label">Biasa</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tata_tulis') is-invalid @enderror" type="radio" id="tata_tulis4" name="tata_tulis" value="6.4" onclick="hasil()" {{ old('tata_tulis', $skripsi->tata_tulis) == '6.4' ? 'checked' : null }}>
                    <label for="tata_tulis4" class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tata_tulis') is-invalid @enderror" type="radio" id="tata_tulis5" name="tata_tulis" value="8" onclick="hasil()" {{ old('tata_tulis', $skripsi->tata_tulis) == '8' ? 'checked' : null }}>
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
                <label for="hasil_dan_pembahasan" class="col-form-label">Hasil dan Pembahasan</label>
                <div class="radio15 d-inline">

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('hasil_dan_pembahasan') is-invalid @enderror" type="radio" id="hasil_dan_pembahasan1" name="hasil_dan_pembahasan" value="2" onclick="hasil()" {{ old('hasil_dan_pembahasan', $skripsi->hasil_dan_pembahasan) == '2' ? 'checked' : null }}>
                    <label for="hasil_dan_pembahasan1" class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('hasil_dan_pembahasan') is-invalid @enderror" type="radio" id="hasil_dan_pembahasan2" name="hasil_dan_pembahasan" value="4" onclick="hasil()" {{ old('hasil_dan_pembahasan', $skripsi->hasil_dan_pembahasan) == '4' ? 'checked' : null }}>
                    <label for="hasil_dan_pembahasan2" class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('hasil_dan_pembahasan') is-invalid @enderror" type="radio" id="hasil_dan_pembahasan3" name="hasil_dan_pembahasan" value="6" onclick="hasil()" {{ old('hasil_dan_pembahasan', $skripsi->hasil_dan_pembahasan) == '6' ? 'checked' : null }}>
                    <label for="hasil_dan_pembahasan3" class="form-check-label">Biasa</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('hasil_dan_pembahasan') is-invalid @enderror" type="radio" id="hasil_dan_pembahasan4" name="hasil_dan_pembahasan" value="8" onclick="hasil()" {{ old('hasil_dan_pembahasan', $skripsi->hasil_dan_pembahasan) == '8' ? 'checked' : null }}>
                    <label for="hasil_dan_pembahasan4" class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('hasil_dan_pembahasan') is-invalid @enderror" type="radio" id="hasil_dan_pembahasan5" name="hasil_dan_pembahasan" value="10" onclick="hasil()" {{ old('hasil_dan_pembahasan', $skripsi->hasil_dan_pembahasan) == '10' ? 'checked' : null }}>
                    <label for="hasil_dan_pembahasan5" class="form-check-label">Sangat Baik</label>
                  </div>                        
                   
                </div>                                                         
              </div>
              @error('hasil_dan_pembahasan')
                  <div class="invalid-feedback">
                    Error
                  </div>
              @enderror

              <div class="mb-3">
                <label for="sikap_dan_kepribadian" class="col-form-label">Sikap dan Kepribadian Ketika Bimbingan</label>
                <div class="radio5 d-inline">
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('sikap_dan_kepribadian') is-invalid @enderror" type="radio" id="sikap_dan_kepribadian1" name="sikap_dan_kepribadian" value="1.6" onclick="hasil()" {{ old('sikap_dan_kepribadian', $skripsi->sikap_dan_kepribadian) == '1.6' ? 'checked' : null }}>
                    <label for="sikap_dan_kepribadian1" class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('sikap_dan_kepribadian') is-invalid @enderror" type="radio" id="sikap_dan_kepribadian2" name="sikap_dan_kepribadian" value="3.2" onclick="hasil()" {{ old('sikap_dan_kepribadian', $skripsi->sikap_dan_kepribadian) == '3.2' ? 'checked' : null }}>
                    <label for="sikap_dan_kepribadian2" class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('sikap_dan_kepribadian') is-invalid @enderror" type="radio" id="sikap_dan_kepribadian3" name="sikap_dan_kepribadian" value="4.8" onclick="hasil()" {{ old('sikap_dan_kepribadian', $skripsi->sikap_dan_kepribadian) == '4.8' ? 'checked' : null }}>
                    <label for="sikap_dan_kepribadian3" class="form-check-label">Biasa</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('sikap_dan_kepribadian') is-invalid @enderror" type="radio" id="sikap_dan_kepribadian4" name="sikap_dan_kepribadian" value="6.4" onclick="hasil()" {{ old('sikap_dan_kepribadian', $skripsi->sikap_dan_kepribadian) == '6.4' ? 'checked' : null }}>
                    <label for="sikap_dan_kepribadian4" class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('sikap_dan_kepribadian') is-invalid @enderror" type="radio" id="sikap_dan_kepribadian5" name="sikap_dan_kepribadian" value="8" onclick="hasil()" {{ old('sikap_dan_kepribadian', $skripsi->sikap_dan_kepribadian) == '8' ? 'checked' : null }}>
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

@if (auth()->user()->nip == $skripsi->pengujisatu_nip || auth()->user()->nip == $skripsi->pengujidua_nip || auth()->user()->nip == $skripsi->pengujitiga_nip)

  <form action="/penilaian-skripsi-penguji/create/{{$skripsi->id}}" method="POST">
    @csrf
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
            @if (auth()->user()->nip == $skripsi->pengujisatu_nip)
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-setting-tab" data-toggle="pill"
                    href="#custom-tabs-one-setting" role="tab"
                    aria-controls="custom-tabs-one-setting" aria-selected="false">Berita Acara</a>
            </li>
            @endif            
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
                    <input class="form-check-input @error ('presentasi') is-invalid @enderror" type="radio" id="presentasi1" name="presentasi" value="0.4" onclick="total()" {{ old('presentasi', $skripsi->presentasi) == '0.4' ? 'checked' : null }} >
                    <label for="presentasi1" class="form-check-label">Sangat Kurang Baik</label>
                  </div>              

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('presentasi') is-invalid @enderror" type="radio" id="presentasi2" name="presentasi" value="0.8" onclick="total()" {{ old('presentasi', $skripsi->presentasi) == '0.8' ? 'checked' : null }}>
                    <label for="presentasi2" class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('presentasi') is-invalid @enderror" type="radio" id="presentasi3" name="presentasi" value="1.2" onclick="total()" {{ old('presentasi', $skripsi->presentasi) == '1.2' ? 'checked' : null }}>
                    <label for="presentasi3" class="form-check-label">Biasa</label>
                  </div>                  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('presentasi') is-invalid @enderror" type="radio" id="presentasi4" name="presentasi" value="1.6" onclick="total()" {{ old('presentasi', $skripsi->presentasi) == '1.6' ? 'checked' : null }}>
                    <label for="presentasi4" class="form-check-label">Baik</label>
                  </div>                  

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('presentasi') is-invalid @enderror" type="radio" id="presentasi5" name="presentasi" value="2" onclick="total()" {{ old('presentasi', $skripsi->presentasi) == '2' ? 'checked' : null }}>
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
                    <input class="form-check-input @error ('tingkat_penguasaan_materi') is-invalid @enderror" type="radio" id="tingkat_penguasaan_materi1" name="tingkat_penguasaan_materi" value="0.6" onclick="total()" {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == '0.6' ? 'checked' : null }} >
                    <label for="tingkat_penguasaan_materi1" class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tingkat_penguasaan_materi') is-invalid @enderror" type="radio" id="tingkat_penguasaan_materi2" name="tingkat_penguasaan_materi" value="1.2" onclick="total()" {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == '1.2' ? 'checked' : null }} >
                    <label for="tingkat_penguasaan_materi2" class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tingkat_penguasaan_materi') is-invalid @enderror" type="radio" id="tingkat_penguasaan_materi3" name="tingkat_penguasaan_materi" value="1.8" onclick="total()" {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == '1.8' ? 'checked' : null }} >
                    <label for="tingkat_penguasaan_materi3" class="form-check-label">Biasa</label>
                  </div>  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tingkat_penguasaan_materi') is-invalid @enderror" type="radio" id="tingkat_penguasaan_materi4" name="tingkat_penguasaan_materi" value="2.4" onclick="total()" {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == '2.4' ? 'checked' : null }} >
                    <label for="tingkat_penguasaan_materi4" class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tingkat_penguasaan_materi') is-invalid @enderror" type="radio" id="tingkat_penguasaan_materi5" name="tingkat_penguasaan_materi" value="3" onclick="total()" {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == '3' ? 'checked' : null }} >
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
                    <input class="form-check-input @error ('keaslian') is-invalid @enderror" type="radio" id="keaslian1" name="keaslian" value="0.4" onclick="total()" {{ old('keaslian', $skripsi->keaslian) == '0.4' ? 'checked' : null }} >
                    <label for="keaslian1" class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('keaslian') is-invalid @enderror" type="radio" id="keaslian2" name="keaslian" value="0.8" onclick="total()" {{ old('keaslian', $skripsi->keaslian) == '0.8' ? 'checked' : null }} >
                    <label for="keaslian2" class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('keaslian') is-invalid @enderror" type="radio" id="keaslian3" name="keaslian" value="1.2" onclick="total()" {{ old('keaslian', $skripsi->keaslian) == '1.2' ? 'checked' : null }} >
                    <label for="keaslian3" class="form-check-label">Biasa</label>
                  </div>  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('keaslian') is-invalid @enderror" type="radio" id="keaslian4" name="keaslian" value="1.6" onclick="total()" {{ old('keaslian', $skripsi->keaslian) == '1.6' ? 'checked' : null }} >
                    <label for="keaslian4" class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('keaslian') is-invalid @enderror" type="radio" id="keaslian5" name="keaslian" value="2" onclick="total()" {{ old('keaslian', $skripsi->keaslian) == '2' ? 'checked' : null }} >
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
                    <input class="form-check-input @error ('ketepatan_metodologi') is-invalid @enderror" type="radio" id="ketepatan_metodologi1" name="ketepatan_metodologi" value="0.8" onclick="total()" {{ old('ketepatan_metodologi', $skripsi->ketepatan_metodologi) == '0.8' ? 'checked' : null }} >
                    <label for="ketepatan_metodologi1" class="form-check-label">Sangat Kurang Baik</label>                    
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('ketepatan_metodologi') is-invalid @enderror" type="radio" id="ketepatan_metodologi2" name="ketepatan_metodologi" value="1.6" onclick="total()" {{ old('ketepatan_metodologi', $skripsi->ketepatan_metodologi) == '1.6' ? 'checked' : null }} >
                    <label for="ketepatan_metodologi2" class="form-check-label">Kurang Baik</label>  
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('ketepatan_metodologi') is-invalid @enderror" type="radio" id="ketepatan_metodologi3" name="ketepatan_metodologi" value="2.4" onclick="total()" {{ old('ketepatan_metodologi', $skripsi->ketepatan_metodologi) == '2.4' ? 'checked' : null }} >
                    <label for="ketepatan_metodologi3" class="form-check-label">Biasa</label>  
                  </div>  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('ketepatan_metodologi') is-invalid @enderror" type="radio" id="ketepatan_metodologi4" name="ketepatan_metodologi" value="3.2" onclick="total()" {{ old('ketepatan_metodologi', $skripsi->ketepatan_metodologi) == '3.2' ? 'checked' : null }} >
                    <label for="ketepatan_metodologi4" class="form-check-label">Baik</label>  
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('ketepatan_metodologi') is-invalid @enderror" type="radio" id="ketepatan_metodologi5" name="ketepatan_metodologi" value="4" onclick="total()" {{ old('ketepatan_metodologi', $skripsi->ketepatan_metodologi) == '4' ? 'checked' : null }} >
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
                    <input class="form-check-input @error ('penguasaan_dasar_teori') is-invalid @enderror" type="radio" id="penguasaan_dasar_teori1" name="penguasaan_dasar_teori" value="0.8" onclick="total()" {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == '0.8' ? 'checked' : null }} >
                    <label for="penguasaan_dasar_teori1" class="form-check-label">Sangat Kurang Baik</label>                    
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('penguasaan_dasar_teori') is-invalid @enderror" type="radio" id="penguasaan_dasar_teori2" name="penguasaan_dasar_teori" value="1.6" onclick="total()" {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == '1.6' ? 'checked' : null }} >
                    <label for="penguasaan_dasar_teori2" class="form-check-label">Kurang Baik</label> 
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('penguasaan_dasar_teori') is-invalid @enderror" type="radio" id="penguasaan_dasar_teori3" name="penguasaan_dasar_teori" value="2.4" onclick="total()" {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == '2.4' ? 'checked' : null }} >
                    <label for="penguasaan_dasar_teori3" class="form-check-label">Biasa</label> 
                  </div>  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('penguasaan_dasar_teori') is-invalid @enderror" type="radio" id="penguasaan_dasar_teori4" name="penguasaan_dasar_teori" value="3.2" onclick="total()" {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == '3.2' ? 'checked' : null }} >
                    <label for="penguasaan_dasar_teori4" class="form-check-label">Baik</label> 
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('penguasaan_dasar_teori') is-invalid @enderror" type="radio" id="penguasaan_dasar_teori5" name="penguasaan_dasar_teori" value="4" onclick="total()" {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == '4' ? 'checked' : null }} >
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
                    <input class="form-check-input @error ('kecermatan_perumusan_masalah') is-invalid @enderror" type="radio" id="kecermatan_perumusan_masalah1" name="kecermatan_perumusan_masalah" value="0.6" onclick="total()" {{ old('kecermatan_perumusan_masalah', $skripsi->kecermatan_perumusan_masalah) == '0.6' ? 'checked' : null }} >
                    <label for="kecermatan_perumusan_masalah1" class="form-check-label">Sangat Kurang Baik</label>                     
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('kecermatan_perumusan_masalah') is-invalid @enderror" type="radio" id="kecermatan_perumusan_masalah2" name="kecermatan_perumusan_masalah" value="1.2" onclick="total()" {{ old('kecermatan_perumusan_masalah', $skripsi->kecermatan_perumusan_masalah) == '1.2' ? 'checked' : null }} >
                    <label for="kecermatan_perumusan_masalah2" class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('kecermatan_perumusan_masalah') is-invalid @enderror" type="radio" id="kecermatan_perumusan_masalah3" name="kecermatan_perumusan_masalah" value="1.8" onclick="total()" {{ old('kecermatan_perumusan_masalah', $skripsi->kecermatan_perumusan_masalah) == '1.8' ? 'checked' : null }} >
                    <label for="kecermatan_perumusan_masalah3" class="form-check-label">Biasa</label>
                  </div>  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('kecermatan_perumusan_masalah') is-invalid @enderror" type="radio" id="kecermatan_perumusan_masalah4" name="kecermatan_perumusan_masalah" value="2.4" onclick="total()" {{ old('kecermatan_perumusan_masalah', $skripsi->kecermatan_perumusan_masalah) == '2.4' ? 'checked' : null }} >
                    <label for="kecermatan_perumusan_masalah4" class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('kecermatan_perumusan_masalah') is-invalid @enderror" type="radio" id="kecermatan_perumusan_masalah5" name="kecermatan_perumusan_masalah" value="3" onclick="total()" {{ old('kecermatan_perumusan_masalah', $skripsi->kecermatan_perumusan_masalah) == '3' ? 'checked' : null }} >
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
                    <input class="form-check-input @error ('tinjauan_pustaka') is-invalid @enderror" type="radio" id="tinjauan_pustaka1" name="tinjauan_pustaka" value="0.6" onclick="total()" {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == '0.6' ? 'checked' : null }} >
                    <label for="tinjauan_pustaka1" class="form-check-label">Sangat Kurang Baik</label>                    
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tinjauan_pustaka') is-invalid @enderror" type="radio" id="tinjauan_pustaka2" name="tinjauan_pustaka" value="1.2" onclick="total()" {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == '1.2' ? 'checked' : null }} >
                    <label for="tinjauan_pustaka2" class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tinjauan_pustaka') is-invalid @enderror" type="radio" id="tinjauan_pustaka3" name="tinjauan_pustaka" value="1.8" onclick="total()" {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == '1.8' ? 'checked' : null }} >
                    <label for="tinjauan_pustaka3" class="form-check-label">Biasa</label>  
                  </div>  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tinjauan_pustaka') is-invalid @enderror" type="radio" id="tinjauan_pustaka4" name="tinjauan_pustaka" value="2.4" onclick="total()" {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == '2.4' ? 'checked' : null }} >
                    <label for="tinjauan_pustaka4" class="form-check-label">Baik</label>  
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tinjauan_pustaka') is-invalid @enderror" type="radio" id="tinjauan_pustaka5" name="tinjauan_pustaka" value="3" onclick="total()" {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == '3' ? 'checked' : null }} >
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
                    <input class="form-check-input @error ('tata_tulis') is-invalid @enderror" type="radio" id="tata_tulis1" name="tata_tulis" value="0.4" onclick="total()" {{ old('tata_tulis', $skripsi->tata_tulis) == '0.4' ? 'checked' : null }} >
                    <label for="tata_tulis1" class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tata_tulis') is-invalid @enderror" type="radio" id="tata_tulis2" name="tata_tulis" value="0.8" onclick="total()" {{ old('tata_tulis', $skripsi->tata_tulis) == '0.8' ? 'checked' : null }} >
                    <label for="tata_tulis2" class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tata_tulis') is-invalid @enderror" type="radio" id="tata_tulis3" name="tata_tulis" value="1.2" onclick="total()" {{ old('tata_tulis', $skripsi->tata_tulis) == '1.2' ? 'checked' : null }} >
                    <label for="tata_tulis3" class="form-check-label">Biasa</label>
                  </div>  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tata_tulis') is-invalid @enderror" type="radio" id="tata_tulis4" name="tata_tulis" value="1.6" onclick="total()" {{ old('tata_tulis', $skripsi->tata_tulis) == '1.6' ? 'checked' : null }} >
                    <label for="tata_tulis4" class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('tata_tulis') is-invalid @enderror" type="radio" id="tata_tulis5" name="tata_tulis" value="2" onclick="total()" {{ old('tata_tulis', $skripsi->tata_tulis) == '2' ? 'checked' : null }} >
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
                  <label for="tools" class="col-form-label">Tools yang digunakan</label>
                  <div class="radio16 d-inline">
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('tools') is-invalid @enderror" type="radio" id="tools1" name="tools" value="0.4" onclick="total()" {{ old('tools', $skripsi->tools) == '0.4' ? 'checked' : null }} >
                      <label for="tools1" class="form-check-label">Sangat Kurang Baik</label>
                    </div>
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('tools') is-invalid @enderror" type="radio" id="tools2" name="tools" value="0.8" onclick="total()" {{ old('tools', $skripsi->tools) == '0.8' ? 'checked' : null }} >
                      <label for="tools2" class="form-check-label">Kurang Baik</label>
                    </div>
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('tools') is-invalid @enderror" type="radio" id="tools3" name="tools" value="1.2" onclick="total()" {{ old('tools', $skripsi->tools) == '1.2' ? 'checked' : null }} >
                      <label for="tools3" class="form-check-label">Biasa</label>
                    </div>  
                    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('tools') is-invalid @enderror" type="radio" id="tools4" name="tools" value="1.6" onclick="total()" {{ old('tools', $skripsi->tools) == '1.6' ? 'checked' : null }} >
                      <label for="tools4" class="form-check-label">Baik</label>
                    </div>
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('tools') is-invalid @enderror" type="radio" id="tools5" name="tools" value="2" onclick="total()" {{ old('tools', $skripsi->tools) == '2' ? 'checked' : null }} >
                      <label for="tools5" class="form-check-label">Sangat Baik</label>
                    </div>                                                                   
                    
                  </div>                                                         
              </div>
              @error('tools')
              <div class="invalid-feedback">
                Error
              </div>
              @enderror

              <div class="mb-3">
                  <label for="penyajian_data" class="col-form-label">Penyajian Data</label>
                  <div class="radio17 d-inline">
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('penyajian_data') is-invalid @enderror" type="radio" id="penyajian_data1" name="penyajian_data" value="0.6" onclick="total()" {{ old('penyajian_data', $skripsi->penyajian_data) == '0.6' ? 'checked' : null }} >
                      <label for="penyajian_data1" class="form-check-label">Sangat Kurang Baik</label>
                    </div>
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('penyajian_data') is-invalid @enderror" type="radio" id="penyajian_data2" name="penyajian_data" value="1.2" onclick="total()" {{ old('penyajian_data', $skripsi->penyajian_data) == '1.2' ? 'checked' : null }} >
                      <label for="penyajian_data2" class="form-check-label">Kurang Baik</label>
                    </div>
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('penyajian_data') is-invalid @enderror" type="radio" id="penyajian_data3" name="penyajian_data" value="1.8" onclick="total()" {{ old('penyajian_data', $skripsi->penyajian_data) == '1.8' ? 'checked' : null }} >
                      <label for="penyajian_data3" class="form-check-label">Biasa</label>
                    </div>  
                    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('penyajian_data') is-invalid @enderror" type="radio" id="penyajian_data4" name="penyajian_data" value="2.4" onclick="total()" {{ old('penyajian_data', $skripsi->penyajian_data) == '2.4' ? 'checked' : null }} >
                      <label for="penyajian_data4" class="form-check-label">Baik</label>
                    </div>
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('penyajian_data') is-invalid @enderror" type="radio" id="penyajian_data5" name="penyajian_data" value="3" onclick="total()" {{ old('penyajian_data', $skripsi->penyajian_data) == '3' ? 'checked' : null }} >
                      <label for="penyajian_data5" class="form-check-label">Sangat Baik</label>
                    </div>                                                                   
                    
                  </div>                                                         
              </div>
              @error('penyajian_data')
              <div class="invalid-feedback">
                Error
              </div>
              @enderror

              <div class="mb-3">
                  <label for="hasil" class="col-form-label">Hasil</label>
                  <div class="radio18 d-inline">
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('hasil') is-invalid @enderror" type="radio" id="hasil1" name="hasil" value="0.8" onclick="total()" {{ old('hasil', $skripsi->hasil) == '0.8' ? 'checked' : null }} >
                      <label for="hasil1" class="form-check-label">Sangat Kurang Baik</label>
                    </div>
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('hasil') is-invalid @enderror" type="radio" id="hasil2" name="hasil" value="1.6" onclick="total()" {{ old('hasil', $skripsi->hasil) == '1.6' ? 'checked' : null }} >
                      <label for="hasil2" class="form-check-label">Kurang Baik</label>
                    </div>
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('hasil') is-invalid @enderror" type="radio" id="hasil3" name="hasil" value="2.4" onclick="total()" {{ old('hasil', $skripsi->hasil) == '2.4' ? 'checked' : null }} >
                      <label for="hasil3" class="form-check-label">Biasa</label>
                    </div>  
                    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('hasil') is-invalid @enderror" type="radio" id="hasil4" name="hasil" value="3.2" onclick="total()" {{ old('hasil', $skripsi->hasil) == '3.2' ? 'checked' : null }} >
                      <label for="hasil4" class="form-check-label">Baik</label>
                    </div>
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('hasil') is-invalid @enderror" type="radio" id="hasil5" name="hasil" value="4" onclick="total()" {{ old('hasil', $skripsi->hasil) == '4' ? 'checked' : null }} >
                      <label for="hasil5" class="form-check-label">Sangat Baik</label>
                    </div>                                                                   
                    
                  </div>                                                         
              </div>
              @error('hasil')
              <div class="invalid-feedback">
                Error
              </div>
              @enderror

              <div class="mb-3">
                  <label for="pembahasan" class="col-form-label">Pembahasan</label>
                  <div class="radio19 d-inline">
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('pembahasan') is-invalid @enderror" type="radio" id="pembahasan1" name="pembahasan" value="0.8" onclick="total()" {{ old('pembahasan', $skripsi->pembahasan) == '0.8' ? 'checked' : null }} >
                      <label for="pembahasan1" class="form-check-label">Sangat Kurang Baik</label>     
                    </div>
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('pembahasan') is-invalid @enderror" type="radio" id="pembahasan2" name="pembahasan" value="1.6" onclick="total()" {{ old('pembahasan', $skripsi->pembahasan) == '1.6' ? 'checked' : null }} >
                      <label for="pembahasan2" class="form-check-label">Kurang Baik</label> 
                    </div>
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('pembahasan') is-invalid @enderror" type="radio" id="pembahasan3" name="pembahasan" value="2.4" onclick="total()" {{ old('pembahasan', $skripsi->pembahasan) == '2.4' ? 'checked' : null }} >
                      <label for="pembahasan3" class="form-check-label">Biasa</label> 
                    </div>  
                    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('pembahasan') is-invalid @enderror" type="radio" id="pembahasan4" name="pembahasan" value="3.2" onclick="total()" {{ old('pembahasan', $skripsi->pembahasan) == '3.2' ? 'checked' : null }} >
                      <label for="pembahasan4" class="form-check-label">Baik</label> 
                    </div>
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('pembahasan') is-invalid @enderror" type="radio" id="pembahasan5" name="pembahasan" value="4" onclick="total()" {{ old('pembahasan', $skripsi->pembahasan) == '4' ? 'checked' : null }} >
                      <label for="pembahasan5" class="form-check-label">Sangat Baik</label> 
                    </div>                                                                   
                    
                  </div>                                                         
              </div>
              @error('hasil')
              <div class="invalid-feedback">
                Error
              </div>
              @enderror

              <div class="mb-3">
                  <label for="kesimpulan" class="col-form-label">Kesimpulan</label>
                  <div class="radio20 d-inline">
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('kesimpulan') is-invalid @enderror" type="radio" id="kesimpulan1" name="kesimpulan" value="0.6" onclick="total()" {{ old('kesimpulan', $skripsi->kesimpulan) == '0.6' ? 'checked' : null }} >
                      <label for="kesimpulan1" class="form-check-label">Sangat Kurang Baik</label>    
                    </div>
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('kesimpulan') is-invalid @enderror" type="radio" id="kesimpulan2" name="kesimpulan" value="1.2" onclick="total()" {{ old('kesimpulan', $skripsi->kesimpulan) == '1.2' ? 'checked' : null }} >
                      <label for="kesimpulan2" class="form-check-label">Kurang Baik</label>
                    </div>
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('kesimpulan') is-invalid @enderror" type="radio" id="kesimpulan3" name="kesimpulan" value="1.8" onclick="total()" {{ old('kesimpulan', $skripsi->kesimpulan) == '1.8' ? 'checked' : null }} >
                      <label for="kesimpulan3" class="form-check-label">Biasa</label>
                    </div>  
                    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('kesimpulan') is-invalid @enderror" type="radio" id="kesimpulan4" name="kesimpulan" value="2.4" onclick="total()" {{ old('kesimpulan', $skripsi->kesimpulan) == '2.4' ? 'checked' : null }} >
                      <label for="kesimpulan4" class="form-check-label">Baik</label>
                    </div>
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('kesimpulan') is-invalid @enderror" type="radio" id="kesimpulan5" name="kesimpulan" value="3" onclick="total()" {{ old('kesimpulan', $skripsi->kesimpulan) == '3' ? 'checked' : null }} >
                      <label for="kesimpulan5" class="form-check-label">Sangat Baik</label>
                    </div>                                                                   
                      
                  </div>                                                         
              </div>
              @error('kesimpulan')
              <div class="invalid-feedback">
                Error
              </div>
              @enderror

              <div class="mb-3">
                  <label for="luaran" class="col-form-label">Luaran</label>
                  <div class="radio21 d-inline">
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('luaran') is-invalid @enderror" type="radio" id="luaran1" name="luaran" value="0.6" onclick="total()" {{ old('luaran', $skripsi->luaran) == '0.6' ? 'checked' : null }} >
                      <label for="luaran1" class="form-check-label">Sangat Kurang Baik</label>
                    </div>
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('luaran') is-invalid @enderror" type="radio" id="luaran2" name="luaran" value="1.2" onclick="total()" {{ old('luaran', $skripsi->luaran) == '1.2' ? 'checked' : null }} >
                      <label for="luaran2" class="form-check-label">Kurang Baik</label>
                    </div>
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('luaran') is-invalid @enderror" type="radio" id="luaran3" name="luaran" value="1.8" onclick="total()" {{ old('luaran', $skripsi->luaran) == '1.8' ? 'checked' : null }} >
                      <label for="luaran3" class="form-check-label">Biasa</label>
                    </div>  
                    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('luaran') is-invalid @enderror" type="radio" id="luaran4" name="luaran" value="2.4" onclick="total()" {{ old('luaran', $skripsi->luaran) == '2.4' ? 'checked' : null }} >
                      <label for="luaran4" class="form-check-label">Baik</label>
                    </div>
    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error ('luaran') is-invalid @enderror" type="radio" id="luaran5" name="luaran" value="3" onclick="total()" {{ old('luaran', $skripsi->luaran) == '3' ? 'checked' : null }} >
                      <label for="luaran5" class="form-check-label">Sangat Baik</label>
                    </div>                                                                   
                      
                  </div>                                                         
              </div>
              @error('luaran')
              <div class="invalid-feedback">
                Error
              </div>
              @enderror
              
              <div class="mb-3">
                <label for="sumbangan_pemikiran" class="col-form-label">Sumbangan Pemikiran Terhadap Ilmu Pengetahuan</label>
                <div class="radio14 d-inline">

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('sumbangan_pemikiran') is-invalid @enderror" type="radio" id="sumbangan_pemikiran1" name="sumbangan_pemikiran" value="0.6" onclick="total()" {{ old('sumbangan_pemikiran', $skripsi->sumbangan_pemikiran) == '0.6' ? 'checked' : null }} >
                    <label for="sumbangan_pemikiran1" class="form-check-label">Sangat Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('sumbangan_pemikiran') is-invalid @enderror" type="radio" id="sumbangan_pemikiran2" name="sumbangan_pemikiran" value="1.2" onclick="total()" {{ old('sumbangan_pemikiran', $skripsi->sumbangan_pemikiran) == '1.2' ? 'checked' : null }} >
                    <label for="sumbangan_pemikiran2" class="form-check-label">Kurang Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('sumbangan_pemikiran') is-invalid @enderror" type="radio" id="sumbangan_pemikiran3" name="sumbangan_pemikiran" value="1.8" onclick="total()" {{ old('sumbangan_pemikiran', $skripsi->sumbangan_pemikiran) == '1.8' ? 'checked' : null }} >
                    <label for="sumbangan_pemikiran3" class="form-check-label">Biasa</label>
                  </div>  
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('sumbangan_pemikiran') is-invalid @enderror" type="radio" id="sumbangan_pemikiran4" name="sumbangan_pemikiran" value="2.4" onclick="total()" {{ old('sumbangan_pemikiran', $skripsi->sumbangan_pemikiran) == '2.4' ? 'checked' : null }} >
                    <label for="sumbangan_pemikiran4" class="form-check-label">Baik</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('sumbangan_pemikiran') is-invalid @enderror" type="radio" id="sumbangan_pemikiran5" name="sumbangan_pemikiran" value="3" onclick="total()" {{ old('sumbangan_pemikiran', $skripsi->sumbangan_pemikiran) == '3' ? 'checked' : null }} >
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

              <button type="submit" class="btn btn-success float-right">Save</button>    

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
              <button type="submit" class="btn btn-success float-right">Save</button>    
            </div> 
            
            @if (auth()->user()->nip == $skripsi->pengujisatu_nip)
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
                                                        <td class="bg-secondary">2</td>
                                                        <td>{{ $nilaipenguji1 != '' ? $nilaipenguji1->presentasi : '-' }}
                                                        </td>

                                                        <td>{{ $nilaipenguji2 != '' ? $nilaipenguji2->presentasi : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji3 != '' ? $nilaipenguji3->presentasi : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Tingkat Penguasaan Materi</td>
                                                        <td class="bg-secondary">3</td>
                                                        <td>{{ $nilaipenguji1 != '' ? $nilaipenguji1->tingkat_penguasaan_materi : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji2 != '' ? $nilaipenguji2->tingkat_penguasaan_materi : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji3 != '' ? $nilaipenguji3->tingkat_penguasaan_materi : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Keaslian</td>
                                                        <td class="bg-secondary">2</td>
                                                        <td>{{ $nilaipenguji1 != '' ? $nilaipenguji1->keaslian : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji2 != '' ? $nilaipenguji2->keaslian : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji3 != '' ? $nilaipenguji3->keaslian : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Ketepatan Metodologi</td>
                                                        <td class="bg-secondary">4</td>
                                                        <td>{{ $nilaipenguji1 != '' ? $nilaipenguji1->ketepatan_metodologi : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji2 != '' ? $nilaipenguji2->ketepatan_metodologi : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji3 != '' ? $nilaipenguji3->ketepatan_metodologi : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>Penguasaan Dasar Teori</td>
                                                        <td class="bg-secondary">4</td>
                                                        <td>{{ $nilaipenguji1 != '' ? $nilaipenguji1->penguasaan_dasar_teori : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji2 != '' ? $nilaipenguji2->penguasaan_dasar_teori : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji3 != '' ? $nilaipenguji3->penguasaan_dasar_teori : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>Kecermatan Perumusan Masalah</td>
                                                        <td class="bg-secondary">3</td>
                                                        <td>{{ $nilaipenguji1 != '' ? $nilaipenguji1->kecermatan_perumusan_masalah : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji2 != '' ? $nilaipenguji2->kecermatan_perumusan_masalah : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji3 != '' ? $nilaipenguji3->kecermatan_perumusan_masalah : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>7</td>
                                                        <td>Tinjauan Pustaka</td>
                                                        <td class="bg-secondary">3</td>
                                                        <td>{{ $nilaipenguji1 != '' ? $nilaipenguji1->tinjauan_pustaka : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji2 != '' ? $nilaipenguji2->tinjauan_pustaka : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji3 != '' ? $nilaipenguji3->tinjauan_pustaka : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>8</td>
                                                        <td>Tata Tulis</td>
                                                        <td class="bg-secondary">2</td>
                                                        <td>{{ $nilaipenguji1 != '' ? $nilaipenguji1->tata_tulis : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji2 != '' ? $nilaipenguji2->tata_tulis : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji3 != '' ? $nilaipenguji3->tata_tulis : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>9</td>
                                                        <td>Tools Yang Digunakan</td>
                                                        <td class="bg-secondary">2</td>
                                                        <td>{{ $nilaipenguji1 != '' ? $nilaipenguji1->tools : '-' }}</td>
                                                        <td>{{ $nilaipenguji2 != '' ? $nilaipenguji2->tools : '-' }}</td>
                                                        <td>{{ $nilaipenguji3 != '' ? $nilaipenguji3->tools : '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>10</td>
                                                        <td>Penyajian Data</td>
                                                        <td class="bg-secondary">3</td>
                                                        <td>{{ $nilaipenguji1 != '' ? $nilaipenguji1->penyajian_data : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji2 != '' ? $nilaipenguji2->penyajian_data : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji3 != '' ? $nilaipenguji3->penyajian_data : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>11</td>
                                                        <td>Hasil</td>
                                                        <td class="bg-secondary">4</td>
                                                        <td>{{ $nilaipenguji1 != '' ? $nilaipenguji1->hasil : '-' }}</td>
                                                        <td>{{ $nilaipenguji2 != '' ? $nilaipenguji2->hasil : '-' }}</td>
                                                        <td>{{ $nilaipenguji3 != '' ? $nilaipenguji3->hasil : '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>12</td>
                                                        <td>Pembahasan</td>
                                                        <td class="bg-secondary">4</td>
                                                        <td>{{ $nilaipenguji1 != '' ? $nilaipenguji1->pembahasan : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji2 != '' ? $nilaipenguji2->pembahasan : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji3 != '' ? $nilaipenguji3->pembahasan : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>13</td>
                                                        <td>Kesimpulan</td>
                                                        <td class="bg-secondary">3</td>
                                                        <td>{{ $nilaipenguji1 != '' ? $nilaipenguji1->pembahasan : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji2 != '' ? $nilaipenguji2->pembahasan : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji3 != '' ? $nilaipenguji1->pembahasan : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>14</td>
                                                        <td>Luaran</td>
                                                        <td class="bg-secondary">3</td>
                                                        <td>{{ $nilaipenguji1 != '' ? $nilaipenguji1->luaran : '-' }}</td>
                                                        <td>{{ $nilaipenguji2 != '' ? $nilaipenguji2->luaran : '-' }}</td>
                                                        <td>{{ $nilaipenguji3 != '' ? $nilaipenguji3->luaran : '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>15</td>
                                                        <td>Sumbangan Pemikiran Terhadap Ilmu Pengetahuan dan Penerapannya
                                                        </td>
                                                        <td class="bg-secondary">3</td>
                                                        <td>{{ $nilaipenguji1 != '' ? $nilaipenguji1->sumbangan_pemikiran : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji2 != '' ? $nilaipenguji2->sumbangan_pemikiran : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji3 != '' ? $nilaipenguji3->sumbangan_pemikiran : '-' }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2">Total Nilai Penguji</td>
                                                        <td class="bg-success">45</td>
                                                        <td>{{ $nilaipenguji1 != '' ? $nilaipenguji1->total_nilai_angka : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji2 != '' ? $nilaipenguji2->total_nilai_angka : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji3 != '' ? $nilaipenguji3->total_nilai_angka : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">Nilai Huruf Penguji</td>
                                                        <td>{{ $nilaipenguji1 != '' ? $nilaipenguji1->total_nilai_huruf : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji2 != '' ? $nilaipenguji2->total_nilai_huruf : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipenguji3 != '' ? $nilaipenguji3->total_nilai_huruf : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">Rata Rata Nilai Penguji</td>
                                                        <td class="text-center" colspan="3">
                                                            <h3 class="text-bold">
                                                                @if ($nilaipenguji1 && $nilaipenguji2 && $nilaipenguji3)
                                                                    {{ round(($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) }}
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
                                                        <td class="bg-secondary">10</td>
                                                        <td>{{ $nilaipembimbing1 != '' ? $nilaipembimbing1->penguasaan_dasar_teori : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipembimbing2 != '' ? $nilaipembimbing2->penguasaan_dasar_teori : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Tingkat Penguasaan Materi</td>
                                                        <td class="bg-secondary">10</td>
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
                                                        <td class="bg-secondary">8</td>
                                                        <td>{{ $nilaipembimbing1 != '' ? $nilaipembimbing1->tata_tulis : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipembimbing2 != '' ? $nilaipembimbing2->tata_tulis : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>Hasil dan Pembahasan</td>
                                                        <td class="bg-secondary">10</td>
                                                        <td>{{ $nilaipembimbing1 != '' ? $nilaipembimbing1->hasil_dan_pembahasan : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipembimbing2 != '' ? $nilaipembimbing2->hasil_dan_pembahasan : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>Sikap dan Kepribadian Ketika Bimbingan</td>
                                                        <td class="bg-secondary">8</td>
                                                        <td>{{ $nilaipembimbing1 != '' ? $nilaipembimbing1->sikap_dan_kepribadian : '-' }}
                                                        </td>
                                                        <td>{{ $nilaipembimbing2 != '' ? $nilaipembimbing2->sikap_dan_kepribadian : '-' }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2">Total Nilai Pembimbing</td>
                                                        <td class="bg-success">55</td>
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
                                                    <tr>
                                                </tbody>
                                            </table>
        </form>

        @if ($penjadwalan->status_seminar == 0)
            @if ($penjadwalan->cek($penjadwalan->id) == $penjadwalan->jmlpenilaian($penjadwalan->id))
                @if ($penjadwalan->pengujisatu_nip == auth()->user()->nip)
                    <form action="/penilaian-skripsi/approve/{{ $penjadwalan->id }}" method="POST">
                        @method('put')
                        @csrf
                        <button type="submit" class="btn btn-lg btn-success float-right"> Approve Penilaian</button>
                    </form>
                @endif
            @endif
        @endif

        </div>

        </div>
        </div>

    @endif
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
    var hasil_dan_pembahasan = $('input[name="hasil_dan_pembahasan"]:checked').val();
    var sikap_dan_kepribadian = $('input[name="sikap_dan_kepribadian"]:checked').val();
    var total = parseFloat(penguasaan_dasar_teori) + parseFloat(tingkat_penguasaan_materi) + parseFloat(tinjauan_pustaka) + parseFloat(tata_tulis) + parseFloat(hasil_dan_pembahasan) + parseFloat(sikap_dan_kepribadian);
    var total_angka = parseFloat(total) * parseFloat(1.81818182);;

    if (!isNaN(total_angka)) {
      $('input[name="total_nilai_angka"]').val(Math.round(total_angka));
      if (total_angka >= 85) {
        $('input[name="total_nilai_huruf"]').val("A");
      }
      else if(total_angka > 80){
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
    var tools = $('input[name="tools"]:checked').val();
    var penyajian_data = $('input[name="penyajian_data"]:checked').val();
    var hasil = $('input[name="hasil"]:checked').val();
    var pembahasan = $('input[name="pembahasan"]:checked').val();
    var kesimpulan = $('input[name="kesimpulan"]:checked').val();
    var luaran = $('input[name="luaran"]:checked').val();
    var sumbangan_pemikiran = $('input[name="sumbangan_pemikiran"]:checked').val();
    var jumlah = parseFloat(presentasi) + parseFloat(tingkat_penguasaan_materi) + parseFloat(keaslian) + parseFloat(ketepatan_metodologi) + parseFloat(penguasaan_dasar_teori) +parseFloat(kecermatan_perumusan_masalah) + parseFloat(tinjauan_pustaka) + parseFloat(tata_tulis) + parseFloat(tools) + parseFloat(penyajian_data) + parseFloat(hasil) + parseFloat(pembahasan) + parseFloat(kesimpulan) + parseFloat(luaran) +parseFloat(sumbangan_pemikiran);
    var angka = parseFloat(jumlah) * parseFloat(2.2222);

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