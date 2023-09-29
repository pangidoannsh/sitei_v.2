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
        <link href="http://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css" rel="stylesheet" />
        <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
        
            <label class="form-label">Tanggal 2</label>
            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}">
            <script type="text/javascript">
                $("input").datepicker({
                beforeShowDay: function (tanggal) {
                var day = tanggal.getDay();
                return [day != 0 && day != 1 && day != 3 && day != 5 && day != 6];
            }
            });
            </script>
            @error('tanggal')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
</div>

<div class="mb-3 field">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" step="2" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}">
            @error('tanggal')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3 field">
            <label for="id_ruangan" class="form-label">Ruangan</label>
            <select name="id_ruangan" id="ruangan" class="form-select @error('id_ruangan') is-invalid @enderror">
            <option value="">-Pilih-</option>
                @foreach ($ruangans as $ruangan)
                    <option value="{{$ruangan->id_ruangan}}" {{old('id_ruangan') == $ruangan->id_ruangan ? 'selected' : null}}>{{$ruangan->nama_ruangan}}</option>
                @endforeach
            </select>
            @error('pembimbing_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            </div>
            
            <div class="mb-3 field">
            <label class="form-label">Lokasi</label>
            </script>
            <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi') }}">  
            @error('lokasi')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror            
        </div> 

        if ($carijam->count() == 0){
            if ($caritanggal->count() == 0){
                if ($caripembimbing->count() == 0){
                    PenjadwalanKP::create([
                        'mahasiswa_nim' => $request->mahasiswa_nim,
                        'pembimbing_nip' => $request->pembimbing_nip,
                        'penguji_nip' => $request->penguji_nip,                        
                        'prodi_id' => $request->prodi_id,            
                        'judul_kp' => $request->judul_kp,
                        'tanggal' => $request->tanggal,
                        'waktu' => $request->waktu,
                        'lokasi' => $request->lokasi,
                        'dibuat_oleh' => auth()->user()->username,
                    ]);
            
                    return redirect('/form')->with('message', 'Jadwal Berhasil Ditambahkan!');
                }
            }
        }

        <div class="mb-3 field">
            <label for="id_ruangan" class="form-label">Ruangan</label>
            <select name="id_ruangan" id="lokasi" class="form-select @error('id_ruangan') is-invalid @enderror">
            <option value="">-Pilih-</option>
                @foreach ($ruangans as $ruangan)
                    <option value="{{$ruangan->id_ruangan}}" {{old('id_ruangan') == $ruangan->id_ruangan ? 'selected' : null}}>{{$ruangan->nama_ruangan}}</option>
                @endforeach
            </select>
            @error('id_ruangan')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            </div> 



                  
        elseif ($request->pembimbingdua_nip == null) {
            PenjadwalanSempro::create([
                'mahasiswa_nim' => $validatedData['mahasiswa_nim'],                
                'pembimbingsatu_nip' => $validatedData['pembimbingsatu_nip'],                
                'pengujisatu_nip' => $validatedData['pengujisatu_nip'],
                'pengujidua_nip' => $validatedData['pengujidua_nip'],                
                'pengujitiga_nip' => $validatedData['pengujitiga_nip'],
                'prodi_id' => $validatedData['prodi_id'],                
                'judul_proposal' => $validatedData['judul_proposal'],
                'tanggal' => $validatedData['tanggal'],
                'waktu' => $validatedData['waktu'],
                'lokasi' => $validatedData['lokasi'],
                'dibuat_oleh' => auth()->user()->username,
            ]);
        }

        Schema::create('ruangan', function (Blueprint $table) {
            $table->id_ruangan();
            $table->string('nama_ruangan');
        });


        <div class="mb-3 field">
            <label for="waktu"class="form-label">Waktu <input type="checkbox" id="cekwaktu2"></label>
            <select name="waktu" id="waktu3" class="form-control @error('waktu') is-invalid @enderror" disabled>
            <option value="">-Pilih-</option>
            </select>
            <select name="waktu" id="waktu1" style="display:none" class="form-control @error('waktu') is-invalid @enderror" disabled>
                    <option value="">-Pilih-</option>
                    <option value="08.00-09.00">08.00-09.00</option>
                    <option value="09.30-10.30">09.30-10.30</option>
                    <option value="11.00-12.00">11.00-12.00</option>
            </select>
            <select name="waktu" style="display:none" id="waktu2" class="form-control @error('waktu') is-invalid @enderror" disabled>
                    <option value="">-Pilih-</option>
                    <option value="13.00-14.00">13.00-14.00</option>
                    <option value="14.30-15.30">14.30-15.30</option>
                    <option value="16.00-17.00">16.00-17.00</option>
            </select>
            @error('waktu')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        {
        $data = [
            'mahasiswa_nim' => 'required',
            'pembimbing_nip' => 'required',
            'penguji_nip' => 'required',
            'prodi_id' => 'required',                            
            'judul_kp' => 'required',
        ];

        if ($request->lokasi) {
            $data['lokasi'] = 'required';
        }

        if ($request->waktu) {
            $data['waktu'] = 'required';
        }

        if ($request->tanggal) {
            $data['tanggal'] = 'required';
        }

        $validatedData = $request->validate($data);

        if ($request->lokasi && $request->waktu && $request->tanggal)
        {
            PenjadwalanKP::create([
                'mahasiswa_nim' => $request->mahasiswa_nim,
                'pembimbing_nip' => $request->pembimbing_nip,                      
                'prodi_id' => $request->prodi_id,            
                'judul_kp' => $request->judul_kp,
                'penguji_nip' => $request->penguji_nip,  
                'lokasi' => $request->lokasi,
                'waktu' => $request->waktu,
                'tanggal' => $request->tanggal,
                'dibuat_oleh' => auth()->user()->username,
            ]);
        }
        elseif ($request->lokasi)
        {
            PenjadwalanKP::create([
                'mahasiswa_nim' => $request->mahasiswa_nim,
                'pembimbing_nip' => $request->pembimbing_nip,                      
                'prodi_id' => $request->prodi_id,            
                'judul_kp' => $request->judul_kp,
                'penguji_nip' => $request->penguji_nip,  
                'lokasi' => $request->lokasi,
                'dibuat_oleh' => auth()->user()->username,
            ]);
        }
        elseif ($request->waktu)
        {
            PenjadwalanKP::create([
                'mahasiswa_nim' => $request->mahasiswa_nim,
                'pembimbing_nip' => $request->pembimbing_nip,                      
                'prodi_id' => $request->prodi_id,            
                'judul_kp' => $request->judul_kp,
                'penguji_nip' => $request->penguji_nip,  
                'waktu' => $request->waktu,
                'dibuat_oleh' => auth()->user()->username,
            ]);
        }
        elseif ($request->tanggal)
        {
            PenjadwalanKP::create([
                'mahasiswa_nim' => $request->mahasiswa_nim,
                'pembimbing_nip' => $request->pembimbing_nip,                      
                'prodi_id' => $request->prodi_id,            
                'judul_kp' => $request->judul_kp,
                'penguji_nip' => $request->penguji_nip,  
                'tanggal' => $request->tanggal,
                'dibuat_oleh' => auth()->user()->username,
            ]);
        }
        elseif($request->lokasi && $request->waktu)
        {
            PenjadwalanKP::create([
                'mahasiswa_nim' => $request->mahasiswa_nim,
                'pembimbing_nip' => $request->pembimbing_nip,                      
                'prodi_id' => $request->prodi_id,            
                'judul_kp' => $request->judul_kp,
                'penguji_nip' => $request->penguji_nip,  
                'lokasi' => $request->lokasi,
                'waktu' => $request->waktu,
                'dibuat_oleh' => auth()->user()->username,
            ]); 
        }
        elseif($request->lokasi && $request->tanggal)
        {
            PenjadwalanKP::create([
                'mahasiswa_nim' => $request->mahasiswa_nim,
                'pembimbing_nip' => $request->pembimbing_nip,                      
                'prodi_id' => $request->prodi_id,            
                'judul_kp' => $request->judul_kp,
                'penguji_nip' => $request->penguji_nip,  
                'lokasi' => $request->lokasi,
                'tanggal' => $request->tanggal,
                'dibuat_oleh' => auth()->user()->username,
            ]); 
        }
        elseif($request->tanggal && $request->waktu)
        {
            PenjadwalanKP::create([
                'mahasiswa_nim' => $request->mahasiswa_nim,
                'pembimbing_nip' => $request->pembimbing_nip,                      
                'prodi_id' => $request->prodi_id,            
                'judul_kp' => $request->judul_kp,
                'penguji_nip' => $request->penguji_nip,  
                'waktu' => $request->waktu,
                'tanggal' => $request->tanggal,
                'dibuat_oleh' => auth()->user()->username,
            ]); 
        }
        elseif($request->lokasi == null && $request->waktu == null && $request->tanggal == null)
        {
            PenjadwalanKP::create([
                'mahasiswa_nim' => $request->mahasiswa_nim,
                'pembimbing_nip' => $request->pembimbing_nip,                      
                'prodi_id' => $request->prodi_id,            
                'judul_kp' => $request->judul_kp,
                'penguji_nip' => $request->penguji_nip,
                'dibuat_oleh' => auth()->user()->username,
            ]);
        }

        return redirect('/form')->with('message', 'Jadwal Berhasil Ditambahkan!');
    }


    <td class="text-center">
              @if($kp->tanggal == null)<p> </p>
              @elseif(Carbon::parse($kp->tanggal)->translatedFormat('l') == "Selasa")
              {{$kp->jamkpsel->jam_tersedia}}
              @elseif(Carbon::parse($kp->tanggal)->translatedFormat('l') == "Kamis")
              {{$kp->jamkpkam->jam_tersedia}}
              @else
              <p>Not Found</p>
            </td>
            @endif
    