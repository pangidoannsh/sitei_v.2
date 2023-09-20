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

<a href="{{url ('/user/create')}}" class="btn staff btn-success mb-3">+ Staff</a>

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
            <a href="#ModalDelete" data-toggle="modal" class="badge bg-danger"><i class="fas fa-trash"></i></a>
          </td>
        </tr>

        <div class="modal fade" id="ModalDelete">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Apakah Anda Yakin?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Data Yang Dihapus Tidak Akan Kembali!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <form action="/user/{{$user->id}}" method="POST" class="d-inline">
              @method('delete')
              @csrf
              <button type="submit" class="btn btn-success">Yakin</button>
        </form>        
      </div>
    </div>
  </div>
</div>
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

@push('scripts')
<script>
  const swal= $('.swal').data('swal');
  if (swal) {
    Swal.fire({
      title : 'Berhasil',
      text : swal,
      confirmButtonColor: '#28A745',
      icon : 'success'
    })    
  }
</script>
@endpush()