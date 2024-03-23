@extends('layouts.main')

@section('title')
    Riwayat Perkuliahan | SIA ELEKTRO
@endsection

@section('sub-title')
    Riwayat Absensi Perkuliahan
@endsection

@section('content')

@if (session()->has('message'))
<div class="swal" data-swal="{{session('message')}}"></div>
@endif

<div class="container card p-4">
        <h5 class="">Riwayat Perkuliahan Mata Kuliah : {{ $perkuliahan->mataKuliah->mk }}</h5>
        <hr/>
        <table class="table table-responsive-lg text-center table-bordered table-striped" style="width:100%" id="datatables">
        <thead class="table-dark">
            <tr>
            <th class="text-center" scope="col">#</th>    
            <th class="text-center" scope="col">Nomor Pertemuan</th>
            <th class="text-center" scope="col">Status</th>
            <th class="text-center" scope="col">Jam Mulai</th>
            <th class="text-center" scope="col">Jam Selesai</th>
            <th class="text-center" scope="col">Materi</th>  
            </tr>
        </thead>
        <tbody>
            @foreach ($perkuliahan->mataKuliah->perkuliahan->where('status', 'Perkuliahan Selesai') as $pertemuan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pertemuan->nomor_pertemuan }}</td>
                <td>{{ $pertemuan->status }}</td>
                <td>{{ \Carbon\Carbon::parse($pertemuan->attended_at)->format('H:i:s') }}</td>
                <td>{{ \Carbon\Carbon::parse($pertemuan->updated_at)->format('H:i:s') }}</td>
                <td>{{ $pertemuan->materi }}</td>
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
