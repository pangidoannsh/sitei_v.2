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

@section('footer')
<section class="bg-dark p-1">
<div class="container">
          <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI  <span class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank" target="_blank" href="https://fahrilhadi.com"> Fahril Hadi</a> <span class="text-success fw-bold"> & </span>
          <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/rahul-ilsa-tajri-mukhti">Rahul Ilsa Tajri Mukhti </a> <span class="text-success fw-bold">)</span></p>
        </div>
</section>
@endsection