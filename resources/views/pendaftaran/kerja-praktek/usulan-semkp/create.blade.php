@extends('layouts.main')

@section('title')
    Daftar KP | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Seminar Kerja Praktek
@endsection

@section('content')

@foreach ($pendaftaran_kp as $kp)

<form action="/daftar-semkp/create/{{$kp->id}}" method="POST" enctype="multipart/form-data" >
@method('put')
        @csrf
    <div>
    <div class="row">


    <div class="col">

        <div class="mb-3 field">
            <label class="form-label">Judul Laporan<span class="text-danger">*</span> </label>
            <input type="text" name="judul_laporan" class="form-control @error ('judul_laporan') is-invalid @enderror" value="{{ old('judul_laporan') }}" required autofocus>
            @error('judul_laporan')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>  
        <div class="mb-3">
            <label for="formFile" class="form-label float-start">Laporan<span class="text-danger">*</span><small class="text-secondary">( Format .pdf | Maks.  5 MB ) </small></label>
            <input name="laporan_kp" class="form-control @error ('laporan_kp') is-invalid @enderror" value="{{ old('laporan_kp') }}" type="file" id="formFile" required>

            @error('laporan_kp')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>

                    <div class="mb-3">
            <label for="formFile" class="form-label float-start ">KPTI-11/Bukti Mengumpulkan Syarat Pendaftaran Seminar KP<span class="text-danger">*</span> <small class="text-secondary">( Format .pdf | Maks. 200 KB ) </small></label>
            <input name="kpti_11" class="form-control @error ('kpti_11') is-invalid @enderror" value="{{ old('kpti_11') }}" type="file" id="formFile" required>

            @error('kpti_11')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
        <div class="mb-3">
            <label for="formFile" class="form-label float-start">STI-31/Surat Persetujuan Sertifikat Pendamping  <small class="text-secondary">( Format .pdf | Maks. 200 KB ) </small></label>
            <input name="sti_31" class="form-control @error ('sti_31') is-invalid @enderror" value="{{ old('sti_31') }}" type="file" id="formFile" required>

            @error('sti_31')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    

    <button type="submit" class="btn btn-success mt-3 mb-5 float-end">Daftar Seminar KP</button>
                   
            </div>

        </div>
    </div>
</form>


@endforeach

@endsection
