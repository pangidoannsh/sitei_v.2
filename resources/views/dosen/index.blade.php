@extends('layouts.main')

@section('title')
    Daftar Dosen | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Dosen
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif

<a href="{{url ('/dosen/create')}}" class="btn btn-outline-dark mb-3">+ Dosen</a>

<table class="table text-center table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Foto</th>
      <th scope="col">NIP</th>
      <th scope="col">Nama</th>
      <th scope="col">Email</th>
      <th scope="col">Jabatan</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($dosens as $dosen)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>
            <img src="{{asset('storage/'. $dosen->gambar)}}" width="50px">
          </td>
          <td>{{$dosen->nip}}</td>
          <td>{{$dosen->nama}}</td>
          <td>{{$dosen->email}}</td>
          @if ($dosen->role_id === null)
          <td> - </td>
          @endif
          @if($dosen->role_id)
          <td>{{$dosen->role->role_akses}}</td>
          @endif
          <td>        
            <a href="/dosen/edit/{{$dosen->id}}" class="badge bg-warning"><i class="fas fa-pen"></i></a>
            <form action="/dosen/{{$dosen->id}}" method="POST" class="d-inline">
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