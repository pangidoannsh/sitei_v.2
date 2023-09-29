<table class="table text-center table-bordered table-striped" style="width:100%" id="datatables">
  <thead class="table-dark">
    <tr>
        <th class="text-center" scope="col">NIM</th>
        <th class="text-center" scope="col">Nama</th>
        <th class="text-center" scope="col">Seminar</th>
        <th class="text-center" scope="col">Prodi</th>             
        <th class="text-center" scope="col">Pembimbing</th>
        <th class="text-center" scope="col">Tanggal</th>
        <th class="text-center" scope="col">Waktu</th>
        <th class="text-center" scope="col">Lokasi</th>
        <th class="text-center" scope="col">Penguji</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($penjadwalan_kps as $kp)
         <tr>
          <td>{{$kp->mahasiswa_nim}}</td>
          <td class="text-center">{{$kp->mahasiswa->nama}}</td>
          <td class="bg-primary text-center">{{$kp->jenis_seminar}}</td>
          <td class="text-center">{{$kp->prodi->nama_prodi}}</td>
          <td class="text-center">{{$kp->pembimbing->nama_singkat}}</td>
          <td class="text-center">{{$kp->Tanggal}}</td>  
          <td class="text-center">{{$kp->waktu}}</td>  
          <td class="text-center">{{$kp->lokasi}}</td>
          <td class="text-center">
          @if ($kp->penguji == null)<p>Belum</p>
          @else
          {{$kp->penguji}}
          @endif
          </td>  
        </tr>
    @endforeach

    @foreach ($penjadwalan_sempros as $sempro)
         <tr>
          <td>{{$sempro->mahasiswa_nim}}</td>
          <td class="text-center">{{$sempro->mahasiswa->nama}}</td>
          <td class="bg-primary text-center">{{$sempro->jenis_seminar}}</td>
          <td class="text-center">{{$sempro->prodi->nama_prodi}}</td>
          <td class="text-center">{{$sempro->pembimbingsatu->nama_singkat}}</td>
          <td class="text-center">{{$sempro->Tanggal}}</td>  
          <td class="text-center">{{$sempro->waktu}}</td>  
          <td class="text-center">{{$sempro->lokasi}}</td>
          <td class="text-center">
          @if ($sempro->pengujisatu == null)<p>Belum</p>
          @else
          {{$sempro->pengujisatu}}
          @endif
          </td>  
        </tr>
    @endforeach

    @foreach ($penjadwalan_skripsis as $skripsi)
         <tr>
          <td>{{$skripsi->mahasiswa_nim}}</td>
          <td class="text-center">{{$skripsi->mahasiswa->nama}}</td>
          <td class="bg-primary text-center">{{$skripsi->jenis_seminar}}</td>
          <td class="text-center">{{$skripsi->prodi->nama_prodi}}</td>
          <td class="text-center">{{$skripsi->pembimbingsatu->nama_singkat}}</td>
          <td class="text-center">{{$skripsi->Tanggal}}</td>  
          <td class="text-center">{{$skripsi->waktu}}</td>  
          <td class="text-center">{{$skripsi->lokasi}}</td>
          <td class="text-center">
          @if ($skripsi->pengujisatu == null)<p>Belum</p>
          @else
          {{$skripsi->pengujisatu}}
          @endif
          </td>  
        </tr>
    @endforeach
  </tbody>
</table>

@for($i = 0; $i < $hitungkps; $i++)
    {{$waktumulaikp = Carbon::now();}}
    <p>Pantat $waktumulaikp</p>
    $waktumulaikp->addMinutes(45)
  @endfor