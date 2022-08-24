@extends('layouts.main')

@section('title')
    Daftar Program Studi | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Program Studi
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif

<a href="{{url ('/prodi/create')}}" class="btn btn-success mb-3">+ Program Studi</a>

<table class="table text-center table-bordered table-striped" id="datatables">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Program Studi</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($prodis as $prodi)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$prodi->nama_prodi}}</td>
          <td>        
            <a href="/prodi/edit/{{$prodi->id}}" class="badge bg-warning"><i class="fas fa-pen"></i></a>
            <form action="/prodi/{{$prodi->id}}" method="POST" class="d-inline">
              @method('delete')
              @csrf
              <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')" type="submit">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </td>
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