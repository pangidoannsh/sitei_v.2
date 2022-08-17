@extends('layouts.main')

@section('title')
    Daftar Staff | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Staff Jurusan
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif

<a href="{{url ('/user/create')}}" class="btn btn-outline-dark mb-3">+ Staff</a>

<table class="table text-center table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Nama</th>
      <th scope="col">Email</th>
      <th scope="col">Jabatan</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$user->username}}</td>
          <td>{{$user->nama}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->role->role_akses}}</td>
          <td>        
            <a href="/user/edit/{{$user->id}}" class="badge bg-warning"><i class="fas fa-pen"></i></a>
            <form action="/user/{{$user->id}}" method="POST" class="d-inline">
              @method('delete')
              @csrf
              <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')" type="submit">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
    @endforeach
  </tbody>
</table>
    
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