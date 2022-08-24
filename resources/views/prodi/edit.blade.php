@extends('layouts.main')

@section('title')
    Edit Program Studi | SIA ELEKTRO
@endsection

@section('sub-title')
    Edit Program Studi
@endsection

@section('content')

<div class="col-lg-5">
    <form action="/prodi/edit/{{$prodi->id}}" method="POST">
        @method('put')
        @csrf

        <div class="mb-3">
            <label class="form-label">Program Studi</label>
            <input type="text" name="nama_prodi" class="form-control @error('nama_prodi') is-invalid @enderror" value="{{ old('nama_prodi', $prodi->nama_prodi) }}">
            @error('nama_prodi')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success mb-5">Update</button>

      </form>
</div>

@endsection