@extends('layouts.main')

@section('title')
    Edit Dosen | SIA ELEKTRO
@endsection

@section('sub-title')
    Edit Dosen
@endsection

@section('content')

<form action="/dosen/edit/{{$dosen->id}}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf
<div>
    <div class="row">
        <div class="col">
        <div class="mb-3 field">
            <label class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip', $dosen->nip) }}">
            @error('nip')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>  

        <div class="mb-3 field">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $dosen->nama) }}">
            @error('nama')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3 field">
            <label class="form-label">Alias</label>
            <input type="text" name="nama_singkat" class="form-control @error('nama_singkat') is-invalid @enderror" value="{{ old('nama_singkat', $dosen->nama_singkat) }}">
            @error('nama_singkat')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
        </div>
        <div class="col-sm">
        <div class="mb-3 field">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $dosen->email) }}">
            @error('email')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
            <div class="mb-3 field">
            <label for="prodi_id" class="form-label">Program Studi</label>
            <select name="prodi_id" class="form-select @error('prodi_id') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($prodis as $prodi)
                    <option value="{{$prodi->id}}" {{old('prodi_id', $dosen->prodi_id) == $prodi->id ? 'selected' : null}}>{{$prodi->nama_prodi}}</option>
                @endforeach
            </select>
            @error('prodi_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3 field">
            <label for="role_id" class="form-label">Status</label>
            <select name="role_id" class="form-select @error('role_id') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($roles as $role)
                    <option value="{{$role->id}}" {{old('role_id', $dosen->role_id) == $role->id ? 'selected' : null}}>{{$role->role_akses}}</option>
                @endforeach
            </select>
            @error('role_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success float-right mt-4">Perbarui</button>        
        </div>        
    </div>
</div>
</form>

@endsection