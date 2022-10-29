@extends('layouts.main')

@section('title')
    Tambah Konsentrasi | SIA ELEKTRO
@endsection

@section('sub-title')
    Tambah Konsentrasi
@endsection

@section('content')

<div class="col-lg-6">
    <form action="{{url ('/konsentrasi/create')}}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Konsentrasi</label>
            <input type="text" name="nama_konsentrasi" class="form-control @error('nama_konsentrasi') is-invalid @enderror" value="{{ old('nama_konsentrasi') }}">
            @error('nama_konsentrasi')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success mb-5">Submit</button>

      </form>
</div>

@endsection