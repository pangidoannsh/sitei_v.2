@extends('layouts.main')

@section('title')
    Daftar Mahasiswa | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Mahasiswa
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif

<a href="{{url ('/mahasiswa/create')}}" class="btn btn-success mb-3">+ Mahasiswa</a>

<table class="table text-center table-bordered table-striped" id="datatables">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>      
      <th scope="col">NIM</th>
      <th scope="col">Nama</th>
      <th scope="col">Angkatan</th>
      <th scope="col">Program Studi</th>
      <th scope="col">Konsentrasi</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($mahasiswas as $mhs)
        <tr>
          <td>{{$loop->iteration}}</td>          
          <td>{{$mhs->nim}}</td>
          <td>{{$mhs->nama}}</td>
          <td>{{$mhs->angkatan}}</td>
          <td>{{$mhs->prodi->nama_prodi}}</td>
          <td>{{$mhs->konsentrasi->nama_konsentrasi}}</td>
          <td>        
            <a href="/mahasiswa/edit/{{$mhs->id}}" class="badge bg-warning"><i class="fas fa-pen"></i></a>
            <form action="/mahasiswa/{{$mhs->id}}" method="POST" class="d-inline">
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