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


    <div class="container">
  <div class="row ">
    <div class="col-lg-6 col-md-12">
      <div class="mb-3">
            <label for="formFile" class="form-label float-start">Resume Turnitin<span class="text-danger">*</span> </label>
            <input name="resume_turnitin" class="form-control @error ('resume_turnitin') is-invalid @enderror" value="{{ old('resume_turnitin') }}" type="file" id="formFile" autofocus required>

            @error('resume_turnitin')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
        </div>
    <div class="col-lg-6 col-md-12">
      <div class="mb-3 field">
            <label class="form-label float-start">Skor Turnitin<span class="text-danger">*</span></label>
            <input type="text" name="skor_turnitin" class="form-control @error ('skor_turnitin') is-invalid @enderror" value="{{ old('skor_turnitin') }}" required >
            @error('skor_turnitin')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
      <div class="mb-3">
            <label for="formFile" class="form-label float-start">Naskah Skripsi<span class="text-danger">*</span> <small class="text-secondary">(Format .pdf | Maks. 10 MB) </small></label>
            <input name="naskah" class="form-control @error ('naskah') is-invalid @enderror" value="{{ old('naskah') }}" type="file" id="formFile" required>

            @error('naskah')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    </div>
    <div class="col-lg-6 col-md-12">
      <div class="mb-3">
            <label for="formFile" class="form-label float-start">Dokumen Kelengkapan<span class="text-danger">*</span> <small class="text-secondary">(Format .pdf | Maks. 200 KB) </small></label>
            <input name="dokumen_kelengkapan" class="form-control @error ('dokumen_kelengkapan') is-invalid @enderror" value="{{ old('dokumen_kelengkapan') }}" type="file" id="formFile" required>

            @error('dokumen_kelengkapan')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    </div>
    <div class="col-lg-6 col-md-12">
      <div class="mb-3">
            <label for="formFile" class="form-label float-start">Bukti Pasang Desain Poster<span class="text-danger">*</span> <small class="text-secondary">(Format .pdf | Maks. 200 KB) </small></label>
            <input name="pasang_poster" class="form-control @error ('pasang_poster') is-invalid @enderror" value="{{ old('pasang_poster') }}" type="file" id="formFile" required>

            @error('pasang_poster')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    </div>
    <div class="col-lg-6 col-md-12">
      <div class="mb-3 field">
            <label class="form-label float-start">URL Poster Skripsi<span class="text-danger">*</span></label>
            <input type="text" name="url_poster" class="form-control @error ('url_poster') is-invalid @enderror" value="{{ old('url_poster') }}" required>
            @error('url_poster')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
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
            <label for="formFile" class="form-label float-start">STI-10/Surat Persetujuan Publikasi Skripsi <small class="text-secondary">(Format .pdf | Maks. 200 KB) </small></label>
            <input name="sti_10" class="form-control @error ('sti_10') is-invalid @enderror" value="{{ old('sti_10') }}" type="file" id="formFile">

            @error('sti_10')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    </div>
    <div class="col-lg-6 col-md-12">
      <div class="mb-3">
            <label for="formFile" class="form-label float-start">STI-30/Bukti Mengumpulkan Syarat Pendaftaran Sidang Skripsi<span class="text-danger">*</span> <small class="text-secondary">(Format .pdf | Maks. 200 KB) </small></label>
            <input name="sti_30" class="form-control @error ('sti_30') is-invalid @enderror" value="{{ old('sti_30') }}" type="file" id="formFile" required>

            @error('sti_30')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    </div>
    <div class="col-lg-6 col-md-12">
      <div class="mb-3">
            <label for="formFile" class="form-label float-start">STI-31/ Surat Persetujuan Sertifikat Pendamping Ijazah<span class="text-danger">*</span> <small class="text-secondary">(Format .pdf | Maks. 200 KB) </small></label>
            <input name="sti_31" class="form-control @error ('sti_31') is-invalid @enderror" value="{{ old('sti_31') }}" type="file" id="formFile" required>

            @error('sti_31')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    <button type="submit" class="btn btn-success  mt-4 mb-5 float-end">Daftar Sidang</button>    

    </div>
  </div>
</div>
</form>




    <!-- <div class="row">

    <div class="col">

    <div class="row">
   
          <div class="mb-3">
            <label for="formFile" class="form-label float-start">Resume Turnitin<span class="text-danger">*</span> </label>
            <input name="resume_turnitin" class="form-control @error ('resume_turnitin') is-invalid @enderror" value="{{ old('resume_turnitin') }}" type="file" id="formFile" autofocus required>

            @error('resume_turnitin')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
   
    </div>
   
      <div class="mb-3 field">
            <label class="form-label float-start">Skor Turnitin<span class="text-danger">*</span></label>
            <input type="text" name="skor_turnitin" class="form-control @error ('skor_turnitin') is-invalid @enderror" value="{{ old('skor_turnitin') }}" required >
            @error('skor_turnitin')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
      
   
  </div>

    <div class="mb-3">
            <label for="formFile" class="form-label float-start">Naskah Skripsi<span class="text-danger">*</span> <small class="text-secondary">( Format .pdf | Maks. 10 MB ) </small></label>
            <input name="naskah_skripsi" class="form-control @error ('naskah_skripsi') is-invalid @enderror" value="{{ old('naskah_skripsi') }}" type="file" id="formFile" required>

            @error('naskah_skripsi')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    <div class="mb-3">
            <label for="formFile" class="form-label float-start">Dokumen Kelengkapan<span class="text-danger">*</span> <small class="text-secondary">( Format .pdf | Maks. 200 KB ) </small></label>
            <input name="dokumen_kelengkapan" class="form-control @error ('dokumen_kelengkapan') is-invalid @enderror" value="{{ old('dokumen_kelengkapan') }}" type="file" id="formFile" required>

            @error('dokumen_kelengkapan')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    <div class="mb-3">
            <label for="formFile" class="form-label float-start">Bukti Pasang Desain Poster<span class="text-danger">*</span> <small class="text-secondary">( Format .pdf | Maks. 200 KB ) </small></label>
            <input name="pasang_poster" class="form-control @error ('pasang_poster') is-invalid @enderror" value="{{ old('pasang_poster') }}" type="file" id="formFile" required>

            @error('pasang_poster')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
        <div class="mb-3 field">
            <label class="form-label float-start">URL Poster Skripsi<span class="text-danger">*</span></label>
            <input type="text" name="url_poster" class="form-control @error ('url_poster') is-invalid @enderror" value="{{ old('url_poster') }}" required>
            @error('url_poster')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

    <div class="mb-3">
            <label for="formFile" class="form-label float-start">STI-9/Lembar Kontrol Perbaikan Proposal<span class="text-danger">*</span> <small class="text-secondary">( Format .pdf | Maks. 200 KB ) </small></label>
            <input name="sti_9" class="form-control @error ('sti_9') is-invalid @enderror" value="{{ old('sti_9') }}" type="file" id="formFile" required>

            @error('sti_9')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    
    <div class="mb-3">
            <label for="formFile" class="form-label float-start">STI-10/Surat Persetujuan Publikasi Skripsi <small class="text-secondary">( Format .pdf | Maks. 200 KB ) </small></label>
            <input name="sti_10" class="form-control @error ('sti_10') is-invalid @enderror" value="{{ old('sti_10') }}" type="file" id="formFile">

            @error('sti_10')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    

    <div class="mb-3">
            <label for="formFile" class="form-label float-start">STI-30/Bukti Mengumpulkan Syarat Pendaftaran Sidang Skripsi<span class="text-danger">*</span> <small class="text-secondary">( Format .pdf | Maks. 200 KB ) </small></label>
            <input name="sti_30_skripsi" class="form-control @error ('sti_30_skripsi') is-invalid @enderror" value="{{ old('sti_30_skripsi') }}" type="file" id="formFile" required>

            @error('sti_30_skripsi')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    
    <div class="mb-3">
            <label for="formFile" class="form-label float-start">STI-31/ Surat Persetujuan Sertifikat Pendamping Ijazah<span class="text-danger">*</span> <small class="text-secondary">( Format .pdf | Maks. 200 KB ) </small></label>
            <input name="sti_31_skripsi" class="form-control @error ('sti_31_skripsi') is-invalid @enderror" value="{{ old('sti_31_skripsi') }}" type="file" id="formFile" required>

            @error('sti_31_skripsi')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    <button type="submit" class="btn btn-success  mt-4 mb-5 float-end">Daftar Sidang</button>    

  </div>

 
        </div> -->


</form>



@endforeach
@endsection
