@extends('absensi_menu.main')

@section('title')
    Matakuliah | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Matakuliah Ruangan {{ $ruangan->nama_ruangan }}
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="swal" data-swal="{{ session('message') }}"></div>
    @endif


    <div class="container card p-4">

        <table class="table table-responsive-lg text-center table-bordered table-striped" style="width:100%" id="datatables">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" scope="col">#</th>
                    <th class="text-center" scope="col">Matakuliah</th>
                    <th class="text-center" scope="col">Dosen Pengampu</th>
                    <th class="text-center" scope="col">Dosen Pengampu</th>
                    <th class="text-center" scope="col">Hari</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matakuliah as $mtk)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mtk->mk ?? '-' }}</td>
                        <td>{{ $mtk->nip_dosen ?? '-' }}</td>
                        <td>{{ $mtk->dosen_2 ?? '-' }}</td>
                        <td>{{ $mtk->hari ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <br>
    <br>
    <br>
@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <small> <span
                        class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank"
                        target="_blank" href="/developer/imperia">Imperia Prestise Sinaga </a>)
        </div>
    </section>
@endsection
