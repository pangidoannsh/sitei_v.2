@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Data Mata Kuliah
@endsection
@section('sub-title')
    Mata Kuliah
@endsection
@section('content')
    <a href="{{ route('matkul.create') }}"
        class="btn btn-success w-content mb-3 d-flex align-items-center justify-content-center fw-bold gap-2 rounded-2">
        <i class="fa-solid fa-plus"></i>
        Mata Kuliah
    </a>
    <div class="contariner card p-4">
        <table class="table table-responsive-lg table-bordered table-striped" style="width:100%" id="datatables">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" scope="col">Kode</th>
                    <th class="text-center" scope="col">Nama</th>
                    <th class="text-center" scope="col">Jumlah SKS</th>
                    <th class="text-center" scope="col">Jenis</th>
                    <th class="text-center" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($model as $matkul)
                    <tr>
                        <td class="text-center">
                            {{ $matkul->kode_mk }}
                        </td>
                        <td class="text-center">
                            {{ $matkul->mk }}
                        </td>
                        <td class="text-center">
                            {{ $matkul->sks }}
                        </td>
                        <td class="text-center">
                            @if ($matkul->jenis === 'W')
                                Wajib
                            @else
                                Peminatan
                            @endif
                        </td>
                        <td class="text-center" style="width: max-content">
                            <div class="d-flex gap-lg-3 gap-2 justify-content-center" style="width: 100%">
                                <a href="{{ route('matkul.edit', $matkul->id) }}" class="badge bg-warning p-2">
                                    <i class="fas fa-pen"></i>
                                </a>
                                {{-- Button Delete --}}
                                <form class="show-delete-confirm" method="POST"
                                    action="{{ route('matkul.delete', $matkul->id) }}">
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
@endsection

@push('scripts')
    <script>
        $('.show-delete-confirm').submit((e) => {
            const form = $(this).closest("form");
            e.preventDefault();
            Swal.fire({
                title: 'Hapus Mata Kuliah',
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
