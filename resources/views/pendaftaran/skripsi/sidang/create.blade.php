@extends('layouts.main')

@section('title')
    SITEI | Daftar Sidang Skripsi
@endsection

@section('sub-title')
    Daftar Sidang Skripsi
@endsection

@section('content')

@foreach ($pendaftaran_skripsi as $skripsi)


<form action="/daftar-sidang/create/{{$skripsi->id}}" method="POST" enctype="multipart/form-data">
@method('put')
        @csrf

<div class="row">
   <div class="col-lg-6 col-md-12">
    <div class="row">
    <div class="col-6"><div class="mb-3">
            <label for="formFile" class="form-label float-start">Resume Turnitin<span class="text-danger">*</span> </label>
            <input name="resume_turnitin" class="form-control @error ('resume_turnitin') is-invalid @enderror" value="{{ old('resume_turnitin') }}" type="file" id="formFile" autofocus required>

            @error('resume_turnitin')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
</div>
    <div class="col-6"><div class="mb-3 field">
            <label class="form-label float-start">Skor Turnitin<span class="text-danger">*</span></label>
            <input type="text" name="skor_turnitin" class="form-control @error ('skor_turnitin') is-invalid @enderror" value="{{ old('skor_turnitin') }}" required >
            @error('skor_turnitin')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div></div></div>

        
        <div class="mb-3">
            <label for="formFile" class="form-label float-start">Naskah Skripsi<span class="text-danger">*</span> <small class="text-secondary">(Format .pdf | Maks. 10 MB) </small></label>
            <input name="naskah" class="form-control @error ('naskah') is-invalid @enderror" value="{{ old('naskah') }}" type="file" id="formFile" required>

            @error('naskah')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
<div class="mb-3">
            <label for="formFile" class="form-label float-start">Lembar Konsultasi Dosen Pembimbing Akademik (Sudah di TTD Lengkap)<span class="text-danger">*</span> <small class="text-secondary">(Format .pdf | Maks. 200 KB) </small></label>
            <input name="konsultasi_pa" class="form-control @error ('konsultasi_pa') is-invalid @enderror" value="{{ old('konsultasi_pa') }}" type="file" id="formFile" required>

            @error('konsultasi_pa')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    <div class="mb-3">
            <label for="formFile" class="form-label float-start">Transkip nilai<span class="text-danger">*</span> <small class="text-secondary">(Format .pdf | Maks. 200 KB) </small></label>
            <input name="transkip_nilai" class="form-control @error ('transkip_nilai') is-invalid @enderror" value="{{ old('transkip_nilai') }}" type="file" id="formFile" required>

            @error('transkip_nilai')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
     <div class="mb-3">
            <label for="formFile" class="form-label float-start">Kartu Hasil Studi (KHS)<span class="text-danger">*</span> <small class="text-secondary">(Format .pdf | Maks. 200 KB) </small></label>
            <input name="khs" class="form-control @error ('khs') is-invalid @enderror" value="{{ old('khs') }}" type="file" id="formFile" required>

            @error('khs')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    <div class="mb-3">
            <label for="formFile" class="form-label float-start">Sertifikat Toefl<span class="text-danger">*</span> <small class="text-secondary">(Format .pdf | Maks. 200 KB) </small></label>
            <input name="toefl" class="form-control @error ('toefl') is-invalid @enderror" value="{{ old('toefl') }}" type="file" id="formFile" required>

            @error('toefl')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    <div class="mb-3">
            <label for="formFile" class="form-label float-start">Logbook<span class="text-danger">*</span> <small class="text-secondary">(Mimimal 8 Kali Bimbingan) (Format .pdf | Maks. 200 KB) </small></label>
            <input name="logbook" class="form-control @error ('logbook') is-invalid @enderror" value="{{ old('logbook') }}" type="file" id="formFile" required>

            @error('logbook')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    <div class="mb-3">
            <label for="formFile" class="form-label float-start">STI-9/Lembar Kontrol Perbaikan Proposal<span class="text-danger">*</span> <small class="text-secondary">(Format .pdf | Maks. 200 KB) </small></label>
            <input name="sti_9" class="form-control @error ('sti_9') is-invalid @enderror" value="{{ old('sti_9') }}" type="file" id="formFile" required>

            @error('sti_9')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>



</div>
<div class="col-lg-6 col-md-12">
      <div class="mb-3">
            <label for="formFile" class="form-label float-start">STI-30/Bukti Mengumpulkan Syarat Daftar Sidang<span class="text-danger">*</span> <small class="text-secondary">(Format .pdf | Maks. 200 KB) </small></label>
            <input name="sti_30" class="form-control @error ('sti_30') is-invalid @enderror" value="{{ old('sti_30') }}" type="file" id="formFile" required>

            @error('sti_30')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
<div class="mb-3">
            <label for="formFile" class="form-label float-start">STI-10/Surat Persetujuan Publikasi Skripsi <small class="text-secondary">(Format .pdf | Maks. 200 KB) </small></label>
            <input name="sti_10" class="form-control @error ('sti_10') is-invalid @enderror" value="{{ old('sti_10') }}" type="file" id="formFile">

            @error('sti_10')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
<div class="mb-3">
            <label for="formFile" class="form-label float-start">Bukti Pasang Desain Poster<small class="text-secondary">(Format .pdf | Maks. 200 KB) </small></label>
            <input name="pasang_poster" class="form-control @error ('pasang_poster') is-invalid @enderror" value="{{ old('pasang_poster') }}" type="file" id="formFile">

            @error('pasang_poster')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    <div class="mb-3 field">
            <label class="form-label float-start">URL Poster Skripsi</label>
            <input type="text" name="url_poster" class="form-control @error ('url_poster') is-invalid @enderror" value="{{ old('url_poster') }}" >
            @error('url_poster')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label float-start">STI-31/ Surat Persetujuan Sertifikat Pendamping Ijazah <small class="text-secondary">(Format .pdf | Maks. 200 KB) </small></label>
            <input name="sti_31" class="form-control @error ('sti_31') is-invalid @enderror" value="{{ old('sti_31') }}" type="file" id="formFile">

            @error('sti_31')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>

    <!-- //JURNALL -->
    <div class="mb-3 field">
            <label for="indeksasi_jurnal" class="form-label">Indeksasi Jurnal</label>
            <select name="indeksasi_jurnal" class="form-select @error('indeksasi_jurnal') is-invalid @enderror">                                                                        
                <option value="Tanpa Jurnal">Tanpa Jurnal</option>                                    
                <option value="Q1">Q1</option>                
                <option value="Q2">Q2</option>                
                <option value="Q3">Q3</option>                
                <option value="Q4">Q4</option>                                         
                <option value="Sinta 1">Sinta 1</option>                
                <option value="Sinta 2">Sinta 2</option>                
                <option value="Sinta 3">Sinta 3</option>                
                <option value="Sinta 4">Sinta 4</option>                
                <option value="IEEE">IEEE</option>                
                <option value="IOP">IOP</option>                
                <option value="SCOPUS">SCOPUS</option>                
            </select>
            @error('indeksasi_jurnal')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

                <div class="mb-3 field">
            <label class="form-label">Judul Jurnal</label>
            <input type="text" name="judul_jurnal" class="form-control @error('judul_jurnal') is-invalid @enderror" value="{{ old('judul_jurnal') }}">
            @error('judul_jurnal')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

                        <div class="mb-3 field">
            <label for="status_publikasi_jurnal" class="form-label">Status Publikasi Jurnal</label>
            <select name="status_publikasi_jurnal" class="form-select @error('status_publikasi_jurnal') is-invalid @enderror">                                                                        
                <option class="fw-bold" value="">-Pilih Status Publikasi-</option>                                    
                <option value="Diterima">Diterima</option>                                    
                <option value="Sudah Dipublikasikan">Sudah Dipublikasikan</option>                
                <option value="Sudah Dipresentasikan">Sudah Dipresentasikan</option>               
               
            </select>
            @error('status_publikasi_jurnal')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>



</div>
</div>
 <a href="#ModalApprove"  data-toggle="modal" class="btn mt-4 btn-lg btn-success float-right">Daftar Sidang</a>  
                            <div class="modal fade"id="ModalApprove">
                                  <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content shadow-sm">
                                      <div class="modal-body">
                                        <div class="container px-5 pt-5 pb-2">
                                          <h3 class="text-center">Apakah Anda Yakin?</h3>
                                        <p class="text-center">Jika belum, silahkan cek kembali Data yang akan Anda Kirim.</p>
                                         <div class="row text-center">
                                              <div class="col-3">
                                              </div>
                                              <div class="col-3">
                                               <button type="button" class="btn p-2 px-3 btn-secondary" data-dismiss="modal">Tidak</button>
                                              </div>
                                              <div class="col-3">
                                              <button type="submit" class="btn btn-success py-2 px-3">Kirim</button>
                                              </div>
                                              <div class="col-3">
                                              </div>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
</form>


@endforeach

<br>
<br>
<br>
<br>
<br>
@endsection

@section('footer')
<section class="bg-dark p-1">
<div class="container">
          <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/m-seprinaldi">( M. Seprinaldi )</a></p>
        </div>
</section>
@endsection
