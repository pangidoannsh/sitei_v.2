@extends('layouts.main')

@section('title')
    Daftar KP | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Seminar Proposal
@endsection
<style>

  @media screen and (max-width: 768px){

  }
  </style>
@section('content')

@foreach ($pendaftaran_skripsi as $skripsi)

<form action="/daftar-sempro/create/{{$skripsi->id}}" method="POST" enctype="multipart/form-data">
@method('put')
        @csrf
    <div>
    <div class="row">


    <div class="col">

        <div class="mb-3">
            <label for="formFile" class="form-label">Naskah Proposal <small class="text-secondary">( Format .pdf | Maks. 1 MB ) </small> </label>
            <input name="proposal" class="form-control @error ('proposal') is-invalid @enderror" value="{{ old('proposal') }}" type="file" id="formFile" required autofocus>

            @error('proposal')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>

    <div class="mb-3">
            <label for="formFile" class="form-label">KRS Berjalan <small class="text-secondary">( Format .pdf .jpeg .png .jpg | Maks. 200 KB ) </small> </label>
            <input name="krs_berjalan_sempro" class="form-control @error ('krs_berjalan_sempro') is-invalid @enderror" value="{{ old('krs_berjalan_sempro') }}" type="file" id="formFile" required >

            @error('krs_berjalan_sempro')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    
    <div class="mb-3">
            <label for="formFile" class="form-label">Kartu Hasil Studi/KPTI-10 <small class="text-secondary">( Format .pdf .jpeg .png .jpg | Maks. 200 KB ) </small></label>
            <input name="khs_kpti_10" class="form-control @error ('khs_kpti_10') is-invalid @enderror" value="{{ old('khs_kpti_10') }}" type="file" id="formFile" required>

            @error('khs_kpti_10')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    
    <div class="mb-3">
            <label for="formFile" class="form-label">Logbook <small class="text-secondary">( Format .pdf | Maks. 200 KB ) </small></label>
            <input name="logbook" class="form-control @error ('logbook') is-invalid @enderror" value="{{ old('logbook') }}" type="file" id="formFile" required>

            @error('logbook')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    

    
    <div class="mb-3">
            <label for="formFile" class="form-label">STI-30/Bukti Mengumpulkan Syarat Pendaftaran Seminar Proposal <small class="text-secondary">( Format .pdf .jpeg .png .jpg | Maks. 200 KB ) </small> </label>
            <input name="sti_30" class="form-control @error ('sti_30') is-invalid @enderror" value="{{ old('sti_30') }}" type="file" id="formFile" required>

            @error('sti_30')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    
    <div class="mb-3">
            <label for="formFile" class="form-label">STI-31/Surat Persetujuan Sertifikat Pendamping <small class="text-secondary">( Format .pdf .jpeg .png .jpg | Maks. 200 KB ) </small></label>
            <input name="sti_31_sempro" class="form-control @error ('sti_31_sempro') is-invalid @enderror" value="{{ old('sti_31_sempro') }}" type="file" id="formFile" required>

            @error('sti_31_sempro')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
        
        <button type="submit" class="btn btn-success  mt-4 float-end">Daftar Sempro</button>

                   
            </div>

        </div>
    </div>
</form>


@endforeach
@endsection
