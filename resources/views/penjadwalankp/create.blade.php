@extends('layouts.main')

@section('title')
    Tambah Jadwal | SIA ELEKTRO
@endsection

@section('sub-title')
    Tambah Jadwal
@endsection

@section('content')

<div class="col-lg-5">
    <form action="{{url ('/form-kp/create')}}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="mahasiswa_nim" class="form-label">Mahasiswa</label>
            <select name="mahasiswa_nim" class="form-select @error('mahasiswa_nim') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($mahasiswas as $mhs)
                    <option value="{{$mhs->nim}}" {{old('mahasiswa_nim') == $mhs->nim ? 'selected' : null}}>{{$mhs->nama}}</option>
                @endforeach
            </select>
            @error('mahasiswa_nim')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>        

        <div class="mb-3">
            <label class="form-label">Judul Laporan Kerja Praktek</label>
            <input type="text" name="judul_kp" class="form-control @error('judul_kp') is-invalid @enderror" value="{{ old('judul_kp') }}"> 
            @error('judul_kp')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror           
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}">
            @error('tanggal')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Waktu</label>
            <input type="time" name="waktu" class="form-control @error('waktu') is-invalid @enderror" value="{{ old('waktu') }}">
            @error('waktu')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi') }}">  
            @error('lokasi')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror            
        </div>

        <div class="mb-3">
            <label for="pembimbing_nip" class="form-label">Pembimbing</label>
            <select name="pembimbing_nip" class="form-select @error('pembimbing_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pembimbing_nip') == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pembimbing_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="penguji_nip" class="form-label">Penguji</label>
            <select name="penguji_nip" class="form-select @error('penguji_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('penguji_nip') == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('penguji_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="jenis_seminar" class="form-label">Jenis Seminar</label>
            <select name="jenis_seminar" class="form-select">
                <option value="Seminar KP">Seminar KP</option>                
            </select>            
        </div>

        <button type="submit" class="btn btn-outline-dark mb-5">Save</button>

      </form>
</div>

@endsection