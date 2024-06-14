@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Data Program MBKM
@endsection
@section('sub-title')
    Program MBKM
@endsection
@section('content')
    <button class="btn btn-success w-content mb-3 d-flex align-items-center justify-content-center fw-bold gap-2 rounded-2"
        data-target="#staticBackdrop" data-toggle="modal">
        <i class="fa-solid fa-plus"></i>
        Program MBKM
    </button>
    <div class="contariner card p-4">
        <table class="table table-responsive-lg table-bordered table-striped" style="width:100%" id="datatables">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" scope="col">Nama</th>
                    <th class="text-center" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($programs as $program)
                    <tr>
                        <td class="text-center">
                            {{ $program->name }}
                        </td>
                        <td class="text-center" style="width: max-content">
                            <div class="d-flex gap-lg-3 gap-2 justify-content-center" style="width: 100%">
                                {{-- <div>
                                    <a class="badge btn btn-warning p-1 rounded-lg text-white" style="cursor:pointer;"
                                        href="{{ route('logo.edit', $logo->id) }}" title="Edit logo">
                                        <i class="fa-solid fa-file-pen"></i>
                                    </a>
                                </div> --}}
                                {{-- Button Delete --}}
                                <form class="show-delete-confirm" method="POST"
                                    action="{{ route('program-mbkm.delete', $program->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="badge btn btn-danger p-1 rounded-lg"
                                        style="cursor:pointer;" title="Hapus Program">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-large">
            <div class="modal-content p-4 rounded-4 d-flex flex-column gap-4">
                <form action="{{ route('program-mbkm.store') }}" method="POST">
                    @csrf
                    <h5 class="modal-title">Tambah Program MBKM</h5>
                    <div class="divider-green mt-1"></div>
                    <div class="d-flex flex-column gap-3 mt-4">
                        <div class="field">
                            <label class="form-label" for="nama_program">Nama Program<span
                                    class="text-danger">*</span></label>
                            <input id="nama_program" name="nama_program" class="form-control "
                                value="{{ old('nama_program') }}" required>
                        </div>
                        <button type="submit" class="rounded-3 btn mt-3 btn-success py-3">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container d-flex justify-content-center">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI
                (<a class="text-success fw-bold" href="https://pangidoannsh.vercel.app" target="_blank">
                    Pangidoan Nugroho Syahputra Harahap
                </a>)
            </p>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $('.show-delete-confirm').submit((e) => {
            const form = $(this).closest("form");
            e.preventDefault();
            Swal.fire({
                title: 'Hapus Program',
                text: 'Apakah Anda Yakin?',
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Hapus',
                confirmButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.currentTarget.submit()
                }
            })
        })
    </script>
@endpush
