
@extends('layouts.main')

@section('title')
    SITEI | Tambah Jadwal Seminar KP
@endsection

@section('sub-title')
    Tambah Jadwal Seminar KP
@endsection

@section('content')

<form action="{{url ('/form-kp/create')}}" method="POST">
        @csrf
    <div>
        <div class="row">
            <div class="col">
            <div class="mb-3 field">
            <label for="mahasiswa_nim" class="form-label">Mahasiswa</label>
            <select name="mahasiswa_nim" id="mhs" class="form-select @error('mahasiswa_nim') is-invalid @enderror">
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
        
        <div class="mb-3 field">
            <label for="prodi_id" class="form-label">Program Studi</label>
            <select name="prodi_id" class="form-select @error('prodi_id') is-invalid @enderror">                
            @if(auth()->user()->role_id == 2)                                                          
                <option value="1">Teknik Elektro D3</option>                
            @endif
            @if(auth()->user()->role_id == 3)                                                          
                <option value="2">Teknik Elektro S1</option>                
            @endif
            @if(auth()->user()->role_id == 4)                                                          
                <option value="3">Teknik Informatika S1</option>                
            @endif
            </select>
            @error('prodi_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>              

        <div class="mb-3 field">
            <label class="form-label">Judul Laporan Kerja Praktek</label>
            <input type="text" name="judul_kp" class="form-control @error('judul_kp') is-invalid @enderror" value="{{ old('judul_kp') }}"> 
            @error('judul_kp')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror           
        </div>

        <div class="mb-3 field">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi') }}">  
            @error('lokasi')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror            
        </div>           
            </div>
            <div class="col-md">
        
        <div class="mb-3 field">
            <label for="pembimbing_nip" class="form-label">Pembimbing</label>
            <select name="pembimbing_nip" id="pembimbing" class="form-select @error('pembimbing_nip') is-invalid @enderror">
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

        <div class="mb-3 field">
            <label for="penguji_nip" class="form-label">Penguji</label>
            <select name="penguji_nip" id="penguji" class="form-select @error('penguji_nip') is-invalid @enderror">
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

        <div class="mb-3 field">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}">
            @error('tanggal')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3 field">
            <label class="form-label">Waktu</label>
            <input type="time" name="waktu" class="form-control @error('waktu') is-invalid @enderror" value="{{ old('waktu') }}">
            @error('waktu')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
        <!-- <div class="mb-3 field">
            <label class="form-label">Status Kerja Praktek</label>
            <input type="text" name="status_kp" class="form-control @error('status_kp') is-invalid @enderror" value="{{ old('status_kp') }}"> 
            @error('status_kp')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror           
        </div> -->

        <button type="submit" class="btn btn-success float-right mt-4">Tambah</button>
        </div>
        </div>
    </div>
</form>


@endsection

@section('footer')
<section class="bg-dark p-1">
<div class="container">
          <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <small> <span class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/fahril-hadi">Fahril Hadi, </a> 
          <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/rahul-ilsa-tajri-mukhti">Rahul Ilsa Tajri Mukhti </a> <span class="text-success fw-bold">&</span> 
          <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/m-seprinaldi"> M. Seprinaldi</a><span class="text-success fw-bold">)</span></small></p>
        </div>
</section>
@endsection



@push('scripts')
<script>

    $(document).ready(function() {
       $('#mhs').select2();
    });

    $(document).ready(function() {
       $('#pembimbing').select2();
    });

    $(document).ready(function() {
       $('#penguji').select2();
    });

</script>
@endpush