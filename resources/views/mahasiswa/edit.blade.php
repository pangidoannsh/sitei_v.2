@extends('layouts.main')

@section('title')
    Edit Mahasiswa | SIA ELEKTRO
@endsection

@section('sub-title')
    Edit Mahasiswa
@endsection

@section('content')

<div class="col-lg-5">
    <form action="/mahasiswa/edit/{{$mahasiswa->id}}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf

        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ old('nim', $mahasiswa->nim) }}">
            @error('nim')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>  

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $mahasiswa->nama) }}">
            @error('nama')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $mahasiswa->email) }}">
            @error('email')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Angkatan</label>
            <input type="number" name="angkatan" class="form-control @error('angkatan') is-invalid @enderror" value="{{ old('angkatan', $mahasiswa->angkatan) }}">
            @error('angkatan')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="prodi_id" class="form-label">Program Studi</label>
            <select name="prodi_id" class="form-select @error('prodi_id') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($prodis as $prodi)
                    <option value="{{$prodi->id}}" {{old('prodi_id', $mahasiswa->prodi_id) == $prodi->id ? 'selected' : null}}>{{$prodi->nama_prodi}}</option>
                @endforeach
            </select>
            @error('prodi_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="konsentrasi_id" class="form-label">Konsentrasi</label>
            <select name="konsentrasi_id" class="form-select @error('konsentrasi_id') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($konsentrasis as $konsentrasi)
                    <option value="{{$konsentrasi->id}}" {{old('konsentrasi_id', $mahasiswa->konsentrasi_id) == $konsentrasi->id ? 'selected' : null}}>{{$konsentrasi->nama_konsentrasi}}</option>
                @endforeach
            </select>
            @error('konsentrasi_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>     
               
        <button type="submit" class="btn btn-success mb-5">Update</button>

      </form>
</div>

@endsection