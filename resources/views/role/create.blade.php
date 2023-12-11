@extends('layouts.main')

@section('title')
    SITEI | Tambah Hak Akses
@endsection

@section('sub-title')
    Tambah Hak Akses
@endsection

@section('content')

<div class="col-lg-6">
    <form action="{{url ('/role/create')}}" method="POST">
        @csrf

        <div class="mb-3 field">
            <label class="form-label">Hak Akses</label>
            <input type="text" name="role_akses" class="form-control @error('role_akses') is-invalid @enderror" value="{{ old('role_akses') }}">
            @error('role_akses')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <button type="submit" class="btn submithakakses btn-success mb-5">Tambah</button>

      </form>
</div>

@endsection