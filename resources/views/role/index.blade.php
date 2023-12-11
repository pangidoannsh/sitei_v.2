@extends('layouts.main')

@section('title')
    SITEI | Daftar Hak Akses
@endsection

@section('sub-title')
    Daftar Hak Akses
@endsection

@section('content')

@if (session()->has('message'))
<div class="swal" data-swal="{{session('message')}}"></div>
@endif 

<a href="{{url ('/role/create')}}" class="btn role btn-success mb-4">+ Hak Akses</a>

<div class="container card p-4">

<table class="table text-center table-bordered table-striped" style="width:100%" id="datatables">
  <thead class="table-dark">
    <tr>
      <th class="text-center" scope="col">#</th>
      <th class="text-center" scope="col">Hak Akses</th>
      <th class="text-center" scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($roles as $role)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$role->role_akses}}</td>
          <td>        
            <a href="/role/edit/{{$role->id}}" class="badge bg-warning"><i class="fas fa-pen"></i></a>
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