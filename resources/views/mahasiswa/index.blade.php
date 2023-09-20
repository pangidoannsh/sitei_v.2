@extends('layouts.main')

@section('title')
    Daftar Mahasiswa | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Mahasiswa
@endsection

@section('content')

@if (session()->has('message'))
<div class="swal" data-swal="{{session('message')}}"></div>
@endif 

<a href="{{url ('/mahasiswa/create')}}" class="btn mahasiswa btn-success mb-3">+ Mahasiswa</a>

<table class="table table-responsive-lg text-center table-bordered table-striped" style="width:100%" id="datatables">
  <thead class="table-dark">
    <tr>
      <th class="text-center" scope="col">#</th>      
      <th class="text-center" scope="col">NIM</th>
      <th class="text-center" scope="col">Nama</th>
      <th class="text-center" scope="col">Angkatan</th>
      <th class="text-center" scope="col">Program Studi</th>      
      <th class="text-center" scope="col">Aksi</th>
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
          <td class="text-center">        
            <a href="/mahasiswa/edit/{{$mhs->id}}" class="badge bg-warning"><i class="fas fa-pen"></i></a>
            <!-- <a href="#ModalDelete" data-toggle="modal" class="badge bg-danger"><i class="fas fa-trash"></i></a> -->
            <form action="/mahasiswa/{{$mhs->id}}" class="delete_form" method="POST"> 
    @method('DELETE')
    @csrf
    <button class="btn btn-dark fas fa-trash"></button>
</form>
          </td>
        </tr>

        <!-- <div class="modal fade" id="ModalDelete">
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
                <form action="/mahasiswa/{{$mhs->id}}" method="POST" class="d-inline">
                      @method('delete')
                      @csrf
                      <button type="submit" class="btn btn-success">Yakin</button>
                </form>        
              </div>
            </div>
          </div>
        </div> -->
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

<!-- @push('scripts')
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
@endpush() -->

@push('scripts')
<script>
$('.delete_form').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            event.currentTarget.submit();
        }
    })
});
</script>
@endpush()