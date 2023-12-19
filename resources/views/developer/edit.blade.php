@extends('layouts.main')

@section('title')
    SITEI | Edit Developer
@endsection

@section('sub-title')
    Edit Developer
@endsection
<style>

  @media screen and (max-width: 768px){

  }
  </style>
@section('content')

<div class="container">
    <a href="/developer" class="btn btn-success py-1 px-2 mb-4"><i class="fas fa-arrow-left fa-xs"></i> Kembali <a>
</div>

<form action="/developer/edit/{{$dev->id}}" method="POST" enctype="multipart/form-data">
@method('put')
        @csrf
    <div class="container">
    <div class="row">
    <div class="col">
        <div class="row">
            <!-- <div class="col-6">
                <div class="mb-3">
            <label class="form-label pb-0">Nama<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama', $dev->nama ?? '') }}" autofocus>
            @error('nama')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
            </div> -->
            <!-- <div class="col-6">
                <div class="mb-3">
            <label class="form-label pb-0">NIM<span class="text-danger">*</span></label>
            <input type="number" class="form-control" name="nim" value="{{ old('nim', $dev->nim ?? '') }}" required>
            @error('nim')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div> 
            </div> -->
        </div>
     
    
    <div class="mb-3">
            <label class="form-label pb-0">Nama<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama', $dev->nama ?? '') }}" autofocus>
            @error('nama')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
    <div class="mb-3">
            <label class="form-label pb-0">NIM<span class="text-danger">*</span></label>
            <input type="number" class="form-control" name="nim" value="{{ old('nim', $dev->nim ?? '') }}" required>
            @error('nim')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div> 
    <div class="mb-3">
            <label class="form-label pb-0">Email<span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $dev->email ?? '') }}" required>
            @error('email')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div> 
    <div class="mb-3">
            <label class="form-label pb-0">Peran<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="peran" value="{{ old('peran', $dev->peran ?? '') }}" required>
            @error('peran')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div> 


   
</div>
<div class="col-lg-6">
    <div class="mb-3">
            <label class="form-label pb-0">Nama Aplikasi<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="nama_aplikasi" value="{{ old('nama_aplikasi', $dev->nama_aplikasi ?? '') }}" required>
            @error('nama_aplikasi')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div> 
    <div class="mb-3">
            <label class="form-label pb-0">Deskripsi Peran<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="deskripsi_peran" value="{{ old('deskripsi_peran', $dev->deskripsi_peran ?? '') }}" required>
            @error('deskripsi_peran')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div> 
    <!-- <div class="mb-3">
            <label for="formFile" class="form-label pb-0">Foto<span class="text-danger">*</span><small class="text-secondary">( Format .png .jpg .jpeg | Maks. 200 KB ) </small> </label>
            <input type="file" class="form-control" name="foto" value="{{ old('foto', $dev->foto ?? '') }}" required>

            @error('foto')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>  -->
        <div class="mb-3">
        <label class="form-label pb-0">Link Linkedin</label>
        <input type="text" class="form-control" name="linkedin" value="{{ old('linkedin', $dev->linkedin ?? '') }}" >
    </div> 
    <div class="mb-3">
            <label class="form-label pb-0">Link Github</label>
            <input type="text" class="form-control" name="github" value="{{ old('github', $dev->github ?? '') }}" >
    </div> 
          
</div>  

</div>
<button type="submit" class="btn btn-success px-3 py-2 mt-4 float-end">Perbarui</button>         
    </div>
</form>




@endsection

@section('footer')
<section class="bg-dark p-1">
<div class="container">
          <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/m-seprinaldi">( M. Seprinaldi )</a></p>
        </div>
</section>
@endsection
