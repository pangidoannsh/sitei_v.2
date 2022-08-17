@extends('layouts.main')

@section('title')
    Edit User | SIA ELEKTRO
@endsection

@section('sub-title')
    Edit User
@endsection

@section('content')

<div class="col-lg-5">
    <form action="/user/edit/{{$user->id}}" method="POST">
        @method('put')
        @csrf

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}">
            @error('username')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>  

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $user->nama) }}">
            @error('nama')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}">
            @error('email')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="role_id" class="form-label">Status</label>
            <select name="role_id" class="form-select @error('role_id') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($roles as $role)
                    <option value="{{$role->id}}" {{old('role_id',  $user->role_id) == $role->id ? 'selected' : null}}>{{$role->role_akses}}</option>
                @endforeach
            </select>
            @error('role_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-outline-dark mb-5">Update</button>

      </form>
</div>

@endsection