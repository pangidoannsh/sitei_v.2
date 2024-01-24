@extends('layouts.main')

@section('title')
    Tambah Mahasiswa | SIA ELEKTRO
@endsection

@section('sub-title')
    Tambah Mahasiswa
@endsection

@section('content')

<div class="container">
  <a href="/mahasiswa" class="btn btn-success py-1 px-2 mb-3 "><i class="fas fa-arrow-left fa-xs"></i> Kembali <a>
</div>

<form action="{{url ('/mahasiswa/create')}}" method="POST" enctype="multipart/form-data">
        @csrf
<div>
    <div class="row">
        <div class="col">
        <div class="mb-3 field">
            <label class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ old('nim') }}">
            @error('nim')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>  

        <div class="mb-3 field">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
            @error('nama')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3 field">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
            @error('email')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3 field">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
            @error('password')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        </div>
        <div class="col-md">
        <div class="mb-3 field">
            <label class="form-label">Angkatan</label>
            <input type="number" name="angkatan" class="form-control @error('angkatan') is-invalid @enderror" value="{{ old('angkatan') }}">
            @error('angkatan')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
        
        <div class="mb-3 field">
            <label for="prodi_id" class="form-label">Program Studi</label>
            <select name="prodi_id" class="form-select @error('prodi_id') is-invalid @enderror">                
            @if(auth()->user()->role_id == 2)                                                          
                <option value="1">Teknik Elektro D3</option>                
            @endif
            @if(auth()->user()->role_id == 3)                                                          
                <option value="2">Teknik Elektro S1</option>                
            @endif
            @if(auth()->user()->role_id == 4)                                                          
                <option value="3">Teknik Informatika S1</option>                
            @endif
            </select>
            @error('prodi_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div> 

        <div class="mb-3 field">
            <label for="konsentrasi_id" class="form-label">Konsentrasi</label>
            <select name="konsentrasi_id" class="form-select @error('konsentrasi_id') is-invalid @enderror">
                <option value="">-Belum Dipilih-</option>
                @foreach ($konsentrasis as $konsentrasi)
                    <option value="{{$konsentrasi->id}}" {{old('konsentrasi_id') == $konsentrasi->id ? 'selected' : null}}>{{$konsentrasi->nama_konsentrasi}}</option>
                @endforeach
            </select>
            @error('konsentrasi_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <!-- <div class="mb-3 field">
            <label for="role_id" class="form-label">Status</label>
            <select name="role_id" class="form-select @error('role_id') is-invalid @enderror">
                <option value="">-Belum Dipilih-</option>
                @foreach ($roles as $role)
                    <option value="{{$role->id}}" {{old('role_id') == $role->id ? 'selected' : null}}>{{$role->role_akses}}</option>
                @endforeach
            </select>
            @error('role_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div> -->

        <button type="submit" class="btn btn-success float-right mt-4">Tambah</button>
        </div>
    </div>
</div>
</form>

@endsection

@section('footer')
<section class="bg-dark p-1">
<div class="container">
          <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI  <span class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank" target="_blank" href="https://fahrilhadi.com"> Fahril Hadi</a> <span class="text-success fw-bold"> & </span>
          <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/rahul-ilsa-tajri-mukhti">Rahul Ilsa Tajri Mukhti </a> <span class="text-success fw-bold">)</span></p>
        </div>
</section>
@endsection

@push('scripts')
<script>

    function previewImgmhs(){

        const imagemhs = document.querySelector('#imgmhs');
        const imgPreviewmhs = document.querySelector('.img-preview-mhs');

        imgPreviewmhs.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(imagemhs.files[0]);

        oFReader.onload = function(oFREvent){
            imgPreviewmhs.src = oFREvent.target.result;            
        }

    }

</script>
@endpush()