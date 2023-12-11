@extends('layouts.main')

@section('title')
    SITEI | Edit Hak Akses
@endsection

@section('sub-title')
    Edit Hak Akses
@endsection

@section('content')

<div class="col-lg-6">
    <form action="/role/edit/{{$role->id}}" method="POST">
        @method('put')
        @csrf

        <div class="mb-3 field">
            <label class="form-label">Hak Akses</label>
            <input type="text" name="role_akses" class="form-control @error('role_akses') is-invalid @enderror" value="{{ old('role_akses', $role->role_akses) }}">
            @error('role_akses')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <button type="submit" class="btn updatehakakses btn-success mb-5">Ubah</button>

      </form>
</div>

@endsection