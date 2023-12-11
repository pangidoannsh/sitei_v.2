@extends('layouts.main')

@section('title')
    SITEI | Tambah Ruangan
@endsection

@section('sub-title')
    Tambah Ruangan
@endsection

@section('content')

<div class="col-lg-6">
    <form action="{{url ('/ruangan/create')}}" method="POST">
        @csrf

        <div class="mb-3 field">
            <label class="form-label">Ruangan</label>
            <input type="text" name="nama_ruangan" class="form-control @error('nama_ruangan') is-invalid @enderror" value="{{ old('nama_ruangan') }}">
            @error('nama_ruangan')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <button type="submit" class="btn submitruangan btn-success mb-5">Tambah</button>

      </form>
</div>

@endsection