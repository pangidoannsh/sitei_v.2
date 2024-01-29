@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Inventaris Barang
@endsection

@section('sub-title')
    Daftar Barang
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="swal" data-swal="{{ session('message') }}"></div>
    @endif

    <!-- Button trigger modal -->
    <a href="{{ url('inventaris/tambahbarang-plp') }}" class="mb-4 w-85 btn btn-success rounded border">
        + Tambah Barang
    </a>

    <div class="container card p-4">

        <ol class="breadcrumb col-lg-12">
            <li class="breadcrumb-item"><a href="{{ route('peminjamanplp') }}">Daftar Pinjaman ({{ $jumlah_pinjaman }})</a>
            </li>
            <span class="px-2">|</span>
            <li class="breadcrumb-item"><a class="breadcrumb-item" href="{{ route('riwayatplp') }}">Riwayat Pinjaman
                    ({{ $jumlah_riwayat }})</a></li>
            <span class="px-2">|</span>
            <li class="breadcrumb-item active fw-bold"><a class="text-success" href="{{ route('stokplp') }}">Daftar Barang
                    ({{ $jumlah_barang }})</a></li>

        </ol>

        <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatables">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" scope="col">Kode Barang</th>
                    <th class="text-center" scope="col">Nama Barang</th>
                    <th class="text-center" scope="col">Jumlah</th>
                    <th class="text-center" scope="col">Status</th>
                    <th class="text-center" scope="col">Aksi</th>
                </tr>
            </thead>


            <tbody>
                @foreach ($barang as $barang)
                    <tr>
                        <td class="text-center">{{ $barang->kode_barang }}</td>
                        <td class="text-center">{{ $barang->nama_barang }}</td>
                        <td class="text-center">{{ $barang->jumlah }}</td>
                        @if ($barang->status == 'Dipinjam')
                            <td class="text-center bg-danger">{{ $barang->status }}</td>
                        @else
                            <td class="text-center bg-success">{{ $barang->status }}</td>
                        @endif
                        <td class="text-center">
                            <a type="button" href="{{ route('editbarangplp', $barang->id) }}"
                                class="badge p-2 bg-warning border-0">
                                <i class="fas fa-pen"></i>
                            </a>
                            <!-- <form action="{{ route('deletebarangplp', $barang->id) }}" method="POST" class="d-inline">
                @method('DELETE')
                @csrf
                <button class="badge bg-danger border-0">
                  <i><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                  </i>
                </button>
              </form>  -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>


    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);
    </script>
@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <small> <span
                        class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank"
                        target="_blank" href="/developer/ahmad-fajri">Ahmad Fajri, </a>
                    <a class="text-success" formtarget="_blank" target="_blank"
                        href="/developer/yabes-maychel">Yabes Maychel </a> <span
                        class="text-success">&</span>
                    <a class="text-success" formtarget="_blank" target="_blank" href="/developer/yasmine"> Yasmine R.A.S Vadri</a><span class="text-success fw-bold">)</span></small></p>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const swal = $('.swal').data('swal');
        if (swal) {
            Swal.fire({
                title: 'Berhasil',
                text: swal,
                confirmButtonColor: '#28A745',
                icon: 'success'
            })
        }
    </script>
@endpush()
