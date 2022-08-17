@extends('layouts.main')

@section('title')
    Daftar Konsentrasi | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Konsentrasi
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show " role="alert">
  {{session('message')}}
</div>
@endif

<a href="{{url ('/konsentrasi/create')}}" class="btn btn-outline-dark mb-3">+ Konsentrasi</a>

<table class="table text-center table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Konsentrasi</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($konsentrasis as $konsentrasi)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$konsentrasi->nama_konsentrasi}}</td>
          <td>        
            <a href="/konsentrasi/edit/{{$konsentrasi->id}}" class="badge bg-warning"><i class="fas fa-pen"></i></a>
            <form action="/konsentrasi/{{$konsentrasi->id}}" method="POST" class="d-inline">
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
@endpush