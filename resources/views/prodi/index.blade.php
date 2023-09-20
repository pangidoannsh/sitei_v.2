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

<a href="{{url ('/prodi/create')}}" class="btn prodi btn-success mb-3">+ Program Studi</a>

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
        <form action="/prodi/{{$prodi->id}}" method="POST" class="d-inline">
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