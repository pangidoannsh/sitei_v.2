@extends('layouts.main')

@section('title')
    Edit Konsentrasi | SIA ELEKTRO
@endsection

@section('sub-title')
    Edit Konsentrasi
@endsection

@section('content')

<div class="col-lg-5">
    <form action="/konsentrasi/edit/{{$konsentrasi->id}}" method="POST">
        @method('put')
        @csrf

        <div class="mb-3">
            <label class="form-label">Konsentrasi</label>
            <input type="text" name="nama_konsentrasi" class="form-control @error('nama_konsentrasi') is-invalid @enderror" value="{{ old('nama_konsentrasi', $konsentrasi->nama_konsentrasi) }}">
            @error('nama_konsentrasi')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success mb-5">Update</button>

      </form>
</div>

@endsection