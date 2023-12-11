@extends('layouts.main')

@section('title')
    SITEI | Edit Program Studi
@endsection

@section('sub-title')
    Edit Program Studi
@endsection

@section('content')

<div class="col-lg-6">
    <form action="/ruangan/edit/{{$ruangan->id}}" method="POST">
        @method('put')
        @csrf

        <div class="mb-3 field">
            <label class="form-label">Program Studi</label>
            <input type="text" name="nama_ruangan" class="form-control @error('nama_ruangan') is-invalid @enderror" value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}">
            @error('nama_ruangan')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <button type="submit" class="btn updateruangan btn-success mb-5">Ubah</button>

      </form>
</div>

@endsection