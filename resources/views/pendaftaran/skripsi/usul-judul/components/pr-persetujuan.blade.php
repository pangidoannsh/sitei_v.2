<div class="card p-4">
    <ol class="breadcrumb col-lg-12">
        <li>
            <a href="/usuljudul/index" class="breadcrumb-item active fw-bold text-success px-1">Persetujuan
                (<span>{{ $jumlah }}</span>)
            </a>
        </li>

        <span class="px-2">|</span>
        <li>
            <a href="/progress/riwayat" class="px-1">Riwayat
                (<span>{{ $jumlah_riwayat }}</span>) </a>
        </li>

    </ol>
    <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatables">
        <thead class="table-dark">
            <tr>
                <th class="text-center" scope="col">Bimbingan</th>
                <th class="text-center" scope="col">Progress</th>
                <th class="text-center" scope="col">Pembimbing</th>
                <th class="text-center" scope="col">Status</th>
                <th class="text-center" scope="col">Tanggal</th>
                <th class="text-center" scope="col">Keterangan</th>
                <th class="text-center " scope="col" style="padding-left: 50px; padding-right:50px;">Aksi
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($skripsis as $skripsi)
                <tr>
                    <td class="text-center ">{{ $skripsi->bimbingan }}</td>
                    <td class="text-center ">{{ $skripsi->progress_report }} %</td>
                    <td class="text-center ">{{ $skripsi->pembimbing_nama }}</td>
                    <td class="text-center bg-info ">{{ $skripsi->status }}</td>
                    <td class="text-center ">
                        {{ $skripsi->created_at->translatedFormat('l, d F Y') }}</td>
                    @if (!$skripsi->keterangan)
                        <td class="text-center ">{{ $skripsi->keterangan }}</td>
                    @elseif ($skripsi->keterangan == 'Sangat Baik' || $skripsi->keterangan == 'Baik')
                        <td class="text-center bg-success ">{{ $skripsi->keterangan }}</td>
                    @elseif ($skripsi->keterangan == ' Diterima' || $skripsi->keterangan == 'Cukup Diterima')
                        <td class="text-center bg-warning ">{{ $skripsi->keterangan }}</td>
                    @else
                        <td class="text-center bg-danger ">{{ $skripsi->keterangan }}</td>
                    @endif
                    <td class="text-center">
                        <div>
                            <a href='/progress/skripsi/{{ $skripsi->id }}' type="button"
                                class="badge bg-info rounded border-0"><i
                                    class="fa
                                         fa-circle-info"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach

            @foreach ($proposals as $proposal)
                <tr>
                    <td class="text-center ">{{ $proposal->bimbingan }}</td>
                    <td class="text-center ">{{ $proposal->progress_report }} %</td>
                    <td class="text-center ">{{ $proposal->pembimbing_nama }}</td>
                    <td class="text-center bg-info ">{{ $proposal->status }}</td>
                    <td class="text-center ">
                        {{ $proposal->created_at->translatedFormat('l, d F Y') }}</td>
                    @if (!$proposal->keterangan)
                        <td class="text-center ">{{ $proposal->keterangan }}</td>
                    @elseif ($proposal->keterangan == 'Sangat Baik' || $proposal->keterangan == 'Baik')
                        <td class="text-center bg-success ">{{ $proposal->keterangan }}</td>
                    @elseif ($proposal->keterangan == ' Diterima' || $proposal->keterangan == 'Cukup Diterima')
                        <td class="text-center bg-warning ">{{ $proposal->keterangan }}</td>
                    @else
                        <td class="text-center bg-danger ">{{ $proposal->keterangan }}</td>
                    @endif
                    <td class="text-center ">
                        <div>
                            <a href='/progress/proposal/{{ $proposal->id }}' type="button"
                                class="badge bg-info rounded border-0"><i class="fa fa-circle-info"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>
