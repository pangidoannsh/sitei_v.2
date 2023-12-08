@extends('layouts.main')

@section('title')
    Daftar KP | SIA ELEKTRO
@endsection

@section('sub-title')
    Bukti Penyerahan Laporan Kerja Praktek
@endsection

@section('content')

@foreach ($pendaftaran_kp as $kp)

<form action="/kpti10-kp/create/{{$kp->id}}" method="POST" enctype="multipart/form-data">
@method('put')
        @csrf
    <div>
    <div class="row">
    <div class="col">
        <div class="mb-3">
        <label for="formFile" class="form-label">Laporan KP<span class="text-danger">*</span> <small class="text-secondary">( Format .pdf | Maks. 1 MB ) </small></label>
        <input name="laporan_akhir" class="mb-3 form-control @error ('laporan_akhir') is-invalid @enderror" value="{{ old('laporan_akhir') }}" type="file" id="formFile" required autofocus>

        @error('laporan_akhir')
          <div class="invalid-feedback">
              {{$message}}
          </div>
        @enderror
            <label for="formFile" class="form-label">KPTI-10/Bukti Penyerahan Laporan KP<span class="text-danger">*</span> <small class="text-secondary">( Format .pdf | Maks. 200 KB ) </small></label>
            <input name="kpti_10" class="form-control mb-2 @error ('kpti_10') is-invalid @enderror" value="{{ old('kpti_10') }}" type="file" id="formFile" required autofocus>

            @error('kpti_10')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>

        <button type="submit" class="btn btn-lg mt-4 btn-success float-end">Kirim</button>

                   
            </div>
        </div>
    </div>
</form>



@endforeach
@endsection
