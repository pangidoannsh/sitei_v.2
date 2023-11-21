@extends('layouts.main')

@section('title')
    Daftar Program Studi | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Program Studi
@endsection

@section('content')

@if (session()->has('message'))
<div class="swal" data-swal="{{session('message')}}"></div>
@endif 

<a href="{{url ('/prodi/create')}}" class="btn prodi btn-success mb-4">+ Program Studi</a>

<div class="container card p-4">

<table class="table text-center table-bordered table-striped" style="width:100%" id="datatables">
  <thead class="table-dark">
    <tr>
      <th class="text-center" scope="col">#</th>
      <th class="text-center" scope="col">Program Studi</th>
      <th class="text-center" scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($prodis as $prodi)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$prodi->nama_prodi}}</td>
          <td>        
            <a href="/prodi/edit/{{$prodi->id}}" class="badge bg-warning"><i class="fas fa-pen"></i></a>
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