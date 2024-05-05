@extends('layouts.main')

@section('title')
    SITEI| Edit Program Studi
@endsection

@section('sub-title')
    Edit Program Studi
@endsection

@section('content')
    <div class="col-lg-6">
        <form action="{{ route('prodi.update',$prodi->id) }}" method="POST">
            @csrf

            <div class="mb-3 field">
                <label class="form-label">Program Studi</label>
                <input type="text" name="nama_prodi" class="form-control @error('nama_prodi') is-invalid @enderror"
                    value="{{ $prodi->nama_prodi }}">
                @error('nama_prodi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 field">
                <label class="form-label">Visi</label>
                <input type="text" name="visi" class="form-control @error('visi') is-invalid @enderror"
                    value="{{ $prodi->visi }}">
                @error('visi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn updateprodi btn-success mb-5">Ubah</button>

        </form>
    </div>
<br>
<br>
<br>
@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <span
                    class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank" target="_blank"
                    href="https://fahrilhadi.com"> Fahril Hadi</a> <span class="text-success fw-bold"> & </span>
                <a class="text-success fw-bold" formtarget="_blank" target="_blank"
                    href="/developer/rahul-ilsa-tajri-mukhti">Rahul Ilsa Tajri Mukhti </a> <span
                    class="text-success fw-bold">)</span>
            </p>
        </div>
    </section>
@endsection
