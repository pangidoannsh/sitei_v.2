@extends('layouts.main')

@section('title')
    Daftar Hak Ases| SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Hak Akses
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif

<a href="{{url ('/role/create')}}" class="btn btn-success mb-3">+ Hak Akses</a>

<table class="table text-center table-bordered table-striped" id="datatables">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Hak Akses</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($roles as $role)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$role->role_akses}}</td>
          <td>        
            <a href="/role/edit/{{$role->id}}" class="badge bg-warning"><i class="fas fa-pen"></i></a>
            <form action="/role/{{$role->id}}" method="POST" class="d-inline">
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