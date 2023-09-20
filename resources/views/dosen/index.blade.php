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

<a href="{{url ('/dosen/create')}}" class="btn dosen btn-success mb-3">+ Dosen</a>

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
        <form action="/dosen/{{$dosen->id}}" method="POST" class="d-inline">
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