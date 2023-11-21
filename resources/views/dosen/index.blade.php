@extends('layouts.main')

@section('title')
    Daftar Dosen | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Dosen
@endsection

@section('content')

@if (session()->has('message'))
<div class="swal" data-swal="{{session('message')}}"></div>
@endif 

<a href="{{url ('/dosen/create')}}" class="btn dosen btn-success mb-4">+ Dosen</a>

<div class="container card p-4">

<table class="table table-responsive-lg table-bordered table-striped text-center" style="width:100%" id="datatables">
  <thead class="table-dark">
    <tr>
      <th class="text-center" scope="col">#</th>      
      <th class="text-center" scope="col">NIP</th>
      <th class="text-center" scope="col">Nama</th>
      <th class="text-center" scope="col">Email</th>
      <th class="text-center" scope="col">Jabatan</th>
      <th class="text-center" scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($dosens as $dosen)
        <tr>
          <td>{{$loop->iteration}}</td>          
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