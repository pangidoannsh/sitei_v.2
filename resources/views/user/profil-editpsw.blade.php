@extends('layouts.main')

@section('title')
    Edit Password | SIA ELEKTRO
@endsection

@section('sub-title')
    Edit Password
@endsection

@section('content')

@if (session()->has('message'))
<div class="swal" data-swal="{{session('message')}}"></div>
@endif 

<div class="col-lg-6">
    <form action="/profil-staff/editpasswordstaff" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf

        <div class="mb-3 field">
            <label class="form-label">Password Lama</label>
            <input type="password" name="password_lama" class="form-control @error('password_lama') is-invalid @enderror">
            @error('password_lama')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div> 

        <div class="mb-3 field">
            <label class="form-label">Password Baru</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div> 

        <div class="mb-3 field">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
            @error('password_confirmation')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div> 

        <button type="submit" class="btn editpw btn-success mb-5">Perbarui</button>

      </form>
</div>

@endsection

@push('scripts')
<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 2000);
</script>
@endpush()