@extends('layouts.layout')

@php
    use Carbon\Carbon;
@endphp

@section('header')
    Penilaian KP | SIA Elektro
@endsection

@section('isi')

<div class="row mb-5">
  <div class="col-6">
    <ol class="list-group">
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">NIM</div>
          <span class="bg-primary py-1 px-1 rounded">{{$kp->mahasiswa->nim}}</span>
        </div>        
      </li> 
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Nama</div>
          <span class="bg-primary py-1 px-1 rounded">{{$kp->mahasiswa->nama}}</span>
        </div>        
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Judul</div>
          <span>{{$kp->judul_kp}}</span>
        </div>        
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Jadwal</div>          
          <span>{{Carbon::parse($kp->tanggal)->translatedFormat('l, d F Y')}}, : {{$kp->waktu}}</span>             
        </div>        
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Lokasi</div>
          <span>{{$kp->lokasi}}</span>
        </div>        
      </li>   
    </ol>
  </div>
  
  <div class="col-6">
    <ol class="list-group">
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Pembimbing</div>
          <span class="bg-primary py-1 px-1 rounded">{{$kp->pembimbing->nama}}</span>
        </div>        
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold mb-2">Penguji</div>
          <span class="bg-primary py-1 px-1 rounded">{{$kp->penguji->nama}}</span>
        </div>        
      </li>     
    </ol>
  </div>
</div>



<form action="/penilaian-kp/create/{{$kp->id}}" method="POST">
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
                    
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-auto">
                          <label for="presentasi" class="col-form-label">Presentasi</label>
                        </div>

                        <div class="col-lg-3">
                          <input type="text" id="presentasi" class="form-control presentasi" name="presentasi" onkeyup="hasil()">
                        </div>                        
                    </div>

                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-auto">
                          <label for="materi" class="col-form-label">Materi</label>
                        </div>

                        <div class="col-lg-3">
                          <input type="text" id="materi" class="form-control materi" name="materi" onkeyup="hasil()">
                        </div>                        
                    </div>

                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-auto">
                          <label for="tanya_jawab" class="col-form-label">Tanya Jawab</label>
                        </div>

                        <div class="col-lg-3">
                          <input type="text" id="tanya_jawab" class="form-control tanya_jawab" name="tanya_jawab" onkeyup="hasil()">
                        </div>                        
                    </div>

                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-auto">
                            <label for="total_nilai_seminar" class="col-form-label">Total Nilai
                            <span class="badge badge-danger ml-3">Penguji</span>
                            </label>
                        </div>
                        <div class="col-lg-3 nilai_penguji">
                            <input type="text" id="total_nilai_seminar" class="form-control text-bold" name="total_nilai_seminar" readonly>
                        </div>
                    </div>

                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-auto">
                            <label for="nilai_pembimbing_kp" class="col-form-label">Nilai
                            <span class="badge badge-danger ml-3">Pembimbing KP</span>
                            </label>
                        </div>
                        <div class="col-lg-3 nilai_pembimbing_kp">
                            <input type="text" id="nilai_pembimbing_kp" class="form-control text-bold" name="nilai_pembimbing_kp" onkeyup="total()">
                        </div>
                    </div>

                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-auto">
                            <label for="nilai_pembimbing_lapangan" class="col-form-label">Nilai
                            <span class="badge badge-danger ml-3">Pembimbing Lapangan</span>
                            </label>
                        </div>
                        <div class="col-lg-3 nilai_pembimbing_lapangan">
                            <input type="text" id="nilai_pembimbing_lapangan" class="form-control text-bold" name="nilai_pembimbing_lapangan" onkeyup="total()">
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

@endsection

@push('scripts')
  <script>

  function hasil(){

    var presentasi = $('input[name="presentasi"]').val();
    var presentasi1 = parseFloat(presentasi) * parseFloat(0.2);
    var materi = $('input[name="materi"]').val();
    var materi1 = parseFloat(materi) * parseFloat(0.4);
    var tanya_jawab = $('input[name="tanya_jawab"]').val(); 
    var tanya_jawab1 = parseFloat(tanya_jawab) * parseFloat(0.4);   
    var total = parseFloat(presentasi1) + parseFloat(materi1) + parseFloat(tanya_jawab1);
    var total_angka = parseFloat(total) * parseFloat(0.3);

    if (!isNaN(total_angka)) {
      $('input[name="total_nilai_seminar"]').val(Math.round(total_angka));      
    }
    else{
      $('input[name="total_nilai_seminar"]').val(0);
    }
  }

  function total(){
    var nilai_pembimbing_kp = $('input[name="nilai_pembimbing_kp"]').val();
    var nilai_pembimbing_kp1 = parseFloat(nilai_pembimbing_kp) * parseFloat(0.3);
    var nilai_pembimbing_lapangan = $('input[name="nilai_pembimbing_lapangan"]').val();
    var nilai_pembimbing_lapangan1 = parseFloat(nilai_pembimbing_lapangan) * parseFloat(0.4);
    var total_angka = $('input[name="total_nilai_seminar"]').val();

    var total_akhir = parseFloat(total_angka) + parseFloat(nilai_pembimbing_kp1) + parseFloat(nilai_pembimbing_lapangan1);

    if (!isNaN(total_akhir)) {
      $('input[name="total_nilai_angka"]').val(Math.round(total_akhir));
      if (total_akhir >= 85) {
        $('input[name="total_nilai_huruf"]').val("A");
      }
      else if(total_akhir > 79){
        $('input[name="total_nilai_huruf"]').val("A-");
      }
      else if(total_akhir >= 75){
        $('input[name="total_nilai_huruf"]').val("B+");
      }   
      else if(total_akhir >= 70){
        $('input[name="total_nilai_huruf"]').val("B");
      }   
      else if(total_akhir >= 65){
        $('input[name="total_nilai_huruf"]').val("B-");
      }
      else if(total_akhir >= 60){
        $('input[name="total_nilai_huruf"]').val("C+");
      }
      else if(total_akhir >= 55){
        $('input[name="total_nilai_huruf"]').val("C");
      }
      else if(total_akhir >= 40){
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