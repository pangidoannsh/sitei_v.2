@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Daftar Peminjaman
@endsection

@section('sub-title')
    Daftar Peminjaman Barang
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="swal" data-swal="{{ session('message') }}"></div>
    @endif

    <div class="container card p-4">

        <ol class="breadcrumb col-lg-12">

            <li class="breadcrumb-item fw-bold "><a class="text-success" href="{{ route('peminjamanadm') }}">Daftar Pinjaman
                    ({{ $jumlah_pinjaman }})</a></li>
            <span class="px-2">|</span>
            <li class="breadcrumb-item"><a class="breadcrumb-item " href="{{ route('riwayatadm') }}">Riwayat Pinjaman
                    ({{ $jumlah_riwayat }})</a></li>
            <span class="px-2">|</span>
            <li class="breadcrumb-item"><a class="breadcrumb-item " href="{{ route('stok') }}">Daftar Barang
                    ({{ $jumlah_barang }})</a></li>

        </ol>



        <table class="table table-responsive-lg table-bordered table-striped" style="width:100%" id="datatables">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" scope="col">Barang</th>
                    <th class="text-center" scope="col">Nama Peminjam</th>
                    <th class="text-center" scope="col">Tujuan</th>
                    <th class="text-center" scope="col">Ruangan</th>
                    <th class="text-center" scope="col">Waktu Pinjam</th>
                    <th class="text-center" scope="col">Waktu Kembali</th>
                    <th class="text-center" scope="col">Jaminan</th>
                    <th class="text-center" scope="col">Status</th>
                    <th class="text-center" scope="col">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($pinjamans as $pinjaman)
                    {{-- <script>{{ $pinjaman }}</script> --}}
                    <tr>
                        <td class="">
                            @if ($pinjaman->barang_satu)
                                1. {{ $pinjaman->barang_satu }} <br />
                            @endif
                            @if ($pinjaman->barang_dua)
                                2. {{ $pinjaman->barang_dua }} <br />
                            @endif
                            @if ($pinjaman->barang_tiga)
                                3. {{ $pinjaman->barang_tiga }} <br />
                            @endif
                        </td>
                        <td class="text-center">{{ $pinjaman->peminjam }}</td>
                        <td class="text-center">{{ $pinjaman->tujuan }}</td>
                        <td class="text-center">{{ $pinjaman->ruangan }}</td>
                        <td class="text-center">{{ $pinjaman->waktu_pinjam }} <br />{{ $pinjaman->penerima }}</td>
                        <td class="text-center">{{ $pinjaman->waktu_kembali }} <br />{{ $pinjaman->pengembali }}</td>
                        <td class="text-center">{{ $pinjaman->jaminan }}</td>
                        @if ($pinjaman->status == 'Ditolak')
                            <td class="text-center bg-danger">{{ $pinjaman->status }}</td>
                        @elseif($pinjaman->status == 'Disetujui')
                            <td class="text-center bg-success">{{ $pinjaman->status }}</td>
                        @else
                            <td class="text-center bg-warning">{{ $pinjaman->status }}</td>
                        @endif

                        <td class="text-center">
                            <!-- Button trigger modal -->

                            @if ($pinjaman->status == 'Usulan')
                                <a href="{{ url('inventaris/tolak/' . $pinjaman->id) }}"
                                    class="badge bg-danger rounded border-0"><i><svg xmlns="http://www.w3.org/2000/svg"
                                            height="1em"
                                            viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <style>
                                                svg {
                                                    fill: #ffffff
                                                }
                                            </style>
                                            <path
                                                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                                        </svg>
                                    </i></a>
                                <a href="{{ url('inventaris/setuju/' . $pinjaman->id) }}"
                                    class="badge bg-success rounded border-0"><i><svg xmlns="http://www.w3.org/2000/svg"
                                            height="1em"
                                            viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <style>
                                                svg {
                                                    fill: #ffffff
                                                }
                                            </style>
                                            <path
                                                d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                                        </svg>
                                    </i></a>
                            @endif

                            @if ($pinjaman->status == 'Disetujui')
                                <p class="text-center">Dikembalikan</p>
                                <a href="{{ url('inventaris/kembali/' . $pinjaman->id) }}"
                                    class="badge bg-success rounded border-0"><i><svg xmlns="http://www.w3.org/2000/svg"
                                            height="1em"
                                            viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <style>
                                                svg {
                                                    fill: #ffffff
                                                }
                                            </style>
                                            <path
                                                d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                                        </svg>
                                    </i></a>
                            @endif
                        </td>

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
