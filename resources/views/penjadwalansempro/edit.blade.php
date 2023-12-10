@extends('layouts.main')

@section('title')
    Edit Jadwal Sempro | SIA ELEKTRO
@endsection

@section('sub-title')
    Edit Jadwal Sempro
@endsection

@section('content')

<form action="/form-sempro/edit/{{$sempro->id}}" method="POST">
        @method('put')
        @csrf
    <div>
        <div class="row">
            <div class="col">
            <div class="mb-3 field">
            <label for="mahasiswa_nim" class="form-label">Mahasiswa</label>
            <input type="hidden" class="form-control" name="mahasiswa_nim" value="{{ old('mahasiswa_nim', $sempro->mahasiswa->nim ?? '') }}" readonly>
            <input class="form-control disable"  value="{{  $sempro->mahasiswa->nama }}" readonly>

 
            <!-- <select name="mahasiswa_nim" id="mhs" class="form-select @error('mahasiswa_nim') is-invalid @enderror" >
                <option value="">-Pilih-</option>
                @foreach ($mahasiswas as $mhs)    
                <option value="{{$mhs->nim}}" {{old('mahasiswa_nim', $sempro->mahasiswa_nim) == $mhs->nim ? 'selected' : null}} >{{$mhs->nama}}</option>
                @endforeach
            </select> -->
            
            @error('mahasiswa_nim')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3 field">
            <label for="prodi_id" class="form-label">Program Studi</label>
            <input type="hidden" name="prodi_id" class="form-control" value="{{old('prodi_id', $sempro->prodi_id ?? '')}}" readonly>
            <input class="form-control disable"  value="{{  $sempro->prodi->nama_prodi }}" readonly>


            <!-- <select name="prodi_id" class="form-select @error('prodi_id') is-invalid @enderror">                
            @if(auth()->user()->role_id == 2)                                                          
                <option value="1">Teknik Elektro D3</option>                
            @endif
            @if(auth()->user()->role_id == 3)                                                          
                <option value="2">Teknik Elektro S1</option>                
            @endif
            @if(auth()->user()->role_id == 4)                                                          
                <option value="3">Teknik Informatika S1</option>                
            @endif
            </select> -->
            @error('prodi_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>        

        <div class="mb-3 field">
            <label class="form-label">Judul Proposal</label>
            <input type="text" name="judul_proposal" class="form-control @error('judul_proposal') is-invalid @enderror" value="{{ old('judul_proposal', $sempro->judul_proposal) }}" readonly>
            @error('judul_proposal')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="row">
    <div class="col">
      <div class="mb-3 field">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $sempro->tanggal) }}">
            @error('tanggal')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
    </div>
    <div class="col">
      <div class="mb-3 field">
            <label class="form-label">Waktu</label>
            <input type="time" name="waktu" class="form-control @error('waktu') is-invalid @enderror" value="{{ old('waktu', $sempro->waktu) }}">
            @error('waktu')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
    </div>
  </div>


        <div class="mb-3 field">
            <label for="lokasi" class="form-label">Lokasi</label>

            <select name="lokasi" id="lokasi" class="form-select @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $sempro->lokasi) }}">
                <option value="">-Pilih-</option>
                @foreach ($ruangans as $ruangan)
                    <option value="{{$ruangan->nama_ruangan}}" {{old('lokasi') == $ruangan->id ? 'selected' : null}}>{{$ruangan->nama_ruangan}}</option>
                @endforeach
            </select>

              <!-- <select name="lokasi" id="lokasi" class="form-select @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $sempro->lokasi) }}">
                <option value="">-Pilih-</option>
                @foreach ($ruangans as $ruangan)
                    <option value="{{$ruangan->nama_ruangan}}" {{old('lokasi', $sempro->lokasi) ==  $ruangan->id ? 'selected' : null}}>{{$ruangan->nama_ruangan}}</option>
                @endforeach
            </select> -->

            <!-- <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $sempro->lokasi) }}"> -->
            @error('lokasi')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
            </div>
            <div class="col-md">
            <div class="mb-3 field">
            <label for="pembimbingsatu_nip" class="form-label">Pembimbing Satu</label>

            <input type="hidden" name="pembimbingsatu_nip" class="form-control" value="{{old('pembimbingsatu_nip', $sempro->pembimbingsatu_nip ?? '')}}" readonly>
            <input class="form-control disable"  value="{{  $sempro->pembimbingsatu->nama }}" readonly>

            <!-- <select name="pembimbingsatu_nip" id="pembimbing1" class="form-select @error('pembimbingsatu_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pembimbingsatu_nip', $sempro->pembimbingsatu_nip) == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select> -->
            @error('pembimbingsatu_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>        

        <div class="mb-3 field">
            <label for="pembimbingdua_nip" class="form-label">Pembimbing Dua</label>

           <input type="hidden" name="pembimbingdua_nip" class="form-control" value="{{old('pembimbingdua_nip', $sempro->pembimbingdua_nip ?? '')}}" readonly>
            <input class="form-control disable"  value="{{  $sempro->pembimbingdua->nama }}" readonly>

            <!-- <select name="pembimbingdua_nip" id="pembimbing2" class="form-select @error('pembimbingdua_nip') is-invalid @enderror">
                <option value="1">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pembimbingdua_nip', $sempro->pembimbingdua_nip) == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select> -->
            @error('pembimbingdua_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3 field">
            <label for="pengujisatu_nip" class="form-label">Penguji Satu</label>
            <select name="pengujisatu_nip" id="penguji1" class="form-select @error('pengujisatu_nip') is-invalid @enderror">
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

        <div class="mb-3 field">
            <label for="pengujidua_nip" class="form-label">Penguji Dua</label>
            <select name="pengujidua_nip" id="penguji2" class="form-select @error('pengujidua_nip') is-invalid @enderror">
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

        <div class="mb-3 field">
            <label for="pengujitiga_nip" class="form-label">Penguji Tiga</label>
            <select name="pengujitiga_nip" id="penguji3" class="form-select @error('pengujitiga_nip') is-invalid @enderror">
                <option value="1">-Pilih-</option>
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

         @if($semprop->keterangan == 'Menunggu Jadwal Seminar Proposal')
         <a href="#ModalApprove"  data-toggle="modal" class="btn mt-4 btn-lg btn-success float-right">Jadwalkan</a>  
                            <div class="modal fade"id="ModalApprove">
                                  <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content shadow-sm">
                                      <div class="modal-body">
                                        <div class="container px-5 pt-5 pb-2">
                                          <h3 class="text-center">Apakah Anda Yakin?</h3>
                                        <p class="text-center">Status Mahasiswa akan di Jadwalkan Seminar Proposal.</p>
                                         <div class="row text-center">
                                              <div class="col-3">
                                              </div>
                                              <div class="col-3">
                                               <button type="button" class="btn p-2 px-3 btn-secondary" data-dismiss="modal">Tidak</button>
                                              </div>
                                              <div class="col-3">
                                               <button type="submit" class="btn p-2 px-3 btn-success float-right">Jadwalkan</button>
                                              </div>
                                              <div class="col-3">
                                              </div>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div> 
        @else
        <button type="submit" class="btn btn-lg btn-success float-right mt-4">Perbarui</button>
        @endif

            </div>
            
      
    </div>   
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script>

    $(document).ready(function() {
       $('#mhs').select2();
    });
    $(document).ready(function() {
       $('#lokasi').select2();
    });

    $(document).ready(function() {
       $('#pembimbing1').select2();
    });

    $(document).ready(function() {
       $('#pembimbing2').select2();
    });


    $(document).ready(function() {
       $('#penguji1').select2();
    });

    $(document).ready(function() {
       $('#penguji2').select2();
    });


    $(document).ready(function() {
       $('#penguji3').select2();
    });


</script>
@endpush