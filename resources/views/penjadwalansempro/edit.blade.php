@extends('layouts.main')

@section('title')
    Edit Jadwal Sempro | SIA ELEKTRO
@endsection

@section('sub-title')
    Edit Jadwal Sempro
@endsection

@section('content')

<div class="col-lg-5">
    <form action="/form-sempro/edit/{{$sempro->id}}" method="POST">
        @method('put')
        @csrf

        <div class="mb-3">
            <label for="mahasiswa_nim" class="form-label">Mahasiswa</label>
            <select name="mahasiswa_nim" class="form-select @error('mahasiswa_nim') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($mahasiswas as $mhs)
                    <option value="{{$mhs->id}}" {{old('mahasiswa_nim', $sempro->mahasiswa_nim) == $mhs->id ? 'selected' : null}}>{{$mhs->nama}}</option>
                @endforeach
            </select>
            @error('mahasiswa_nim')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="prodi_id" class="form-label">Program Studi</label>
            <select name="prodi_id" class="form-select @error('prodi_id') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($prodis as $prodi)
                    <option value="{{$prodi->id}}" {{old('prodi_id', $sempro->prodi_id) == $prodi->id ? 'selected' : null}}>{{$prodi->nama_prodi}}</option>
                @endforeach
            </select>
            @error('prodi_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>      

        <div class="mb-3">
            <label class="form-label">Judul Proposal</label>
            <input type="text" name="judul_proposal" class="form-control @error('judul_proposal') is-invalid @enderror" value="{{ old('judul_proposal', $sempro->judul_proposal) }}">
            @error('judul_proposal')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="pembimbingsatu_nip" class="form-label">Pembimbing Satu</label>
            <select name="pembimbingsatu_nip" class="form-select @error('pembimbingsatu_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pembimbingsatu_nip', $sempro->pembimbingsatu_nip) == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pembimbingsatu_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>        

        <div class="mb-3">
            <label for="pembimbingdua_nip" class="form-label">Pembimbing Dua</label>
            <select name="pembimbingdua_nip" class="form-select @error('pembimbingdua_nip') is-invalid @enderror">
                <option value="1">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pembimbingdua_nip', $sempro->pembimbingdua_nip) == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pembimbingdua_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="pengujisatu_nip" class="form-label">Penguji Satu</label>
            <select name="pengujisatu_nip" class="form-select @error('pengujisatu_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pengujisatu_nip', $sempro->pengujisatu_nip) == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pengujisatu_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div> 

        <div class="mb-3">
            <label for="pengujidua_nip" class="form-label">Penguji Dua</label>
            <select name="pengujidua_nip" class="form-select @error('pengujidua_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pengujidua_nip', $sempro->pengujidua_nip) == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pengujidua_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div> 

        <div class="mb-3">
            <label for="pengujitiga_nip" class="form-label">Penguji Tiga</label>
            <select name="pengujitiga_nip" class="form-select @error('pengujitiga_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pengujitiga_nip', $sempro->pengujitiga_nip) == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pengujitiga_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div> 

        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $sempro->tanggal) }}">
            @error('tanggal')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Waktu</label>
            <input type="time" name="waktu" class="form-control @error('waktu') is-invalid @enderror" value="{{ old('waktu', $sempro->waktu) }}">
            @error('waktu')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>


        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $sempro->lokasi) }}">
            @error('lokasi')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        {{-- <div class="mb-3">
            <label for="jenis_seminar" class="form-label">Jenis Seminar</label>
            <select name="jenis_seminar" class="form-select">
                <option value="Seminar Proposal">Seminar Proposal</option>                
            </select>            
        </div>  --}}

        <button type="submit" class="btn btn-outline-dark mb-5">Update</button>

      </form>
</div>

@endsection