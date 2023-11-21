@extends('layouts.main')

@section('title')
    Daftar Staff | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Staff Jurusan
@endsection

@section('content')

@if (session()->has('message'))
<div class="swal" data-swal="{{session('message')}}"></div>
@endif 

<a href="{{url ('/user/create')}}" class="btn staff btn-success mb-4">+ Staff</a>

<div class="container card p-4">

<table class="table table-responsive-lg text-center table-bordered table-striped" style="width:100%" id="datatables">
  <thead class="table-dark">
    <tr>
      <th class="text-center" scope="col">#</th>
      <th class="text-center" scope="col">Username</th>
      <th class="text-center" scope="col">Nama</th>
      <th class="text-center" scope="col">Email</th>
      <th class="text-center" scope="col">Jabatan</th>
      <th class="text-center" scope="col">Aksi</th>
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
          </td>
        </tr>
    @endforeach
  </tbody>
</table>

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