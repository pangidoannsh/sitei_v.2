<div class="container card  p-4">

    <ol class="breadcrumb col-lg-12">
        <li>
            <a href="/progress" class="px-1">Persetujuan
                (<span>{{ $jumlah }}</span>)
            </a>
        </li>

        <span class="px-2">|</span>
        <li>
            <a href="/progress/riwayat" class="breadcrumb-item active fw-bold text-success px-1">Riwayat
                (<span>{{ $jumlah_skripsi }}</span>) </a>
        </li>


    </ol>

    <div class="container-fluid">


        <div class="card mt-4 mb-4 rounded bg-success ">
            <div class="p-2 pt-3">
                <h5 class="text-center text-bold">
                    Laporan Kemajuan
                </h5>
            </div>
        </div>

        <div class="card pt-4 pb-4">
            <div class="row">
                <div class="col-lg-6 ">
                    <div id="statistik2" style="width:100%; height:400px;"></div>
                </div>
                <div class="col-lg-6 ">
                    <div id="statistik" style="width:100%; height:400px;"></div>
                </div>
            </div>
        </div>

        <div class="card mt-4 mb-4 rounded bg-success ">
            <div class="p-2 pt-3">
                <h5 class="text-center text-bold">
                    Riwayat
                </h5>
            </div>
        </div>

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
                        <td class="text-center ">{{ $skripsi->created_at->translatedFormat('l, d F Y') }}</td>
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

                            <a href='/progress/skripsi/{{ $skripsi->id }}' type="button"
                                class="badge bg-info rounded border-0"><i class="fa fa-circle-info"></i></a>

                            <a href='/progress/logbookSkripsi/{{ $skripsi->id }}' target="_blank" type="button"
                                class="badge bg-primary rounded border-0"><i class="fa-solid fa-download"></i></a>

                        </td>
                    </tr>
                @endforeach

                @foreach ($proposals as $proposal)
                    <tr>
                        <td class="text-center ">{{ $proposal->bimbingan }}</td>
                        <td class="text-center ">{{ $proposal->progress_report }} %</td>
                        <td class="text-center ">{{ $proposal->pembimbing_nama }}</td>
                        <td class="text-center bg-info ">{{ $proposal->status }}</td>
                        <td class="text-center ">{{ $proposal->created_at->translatedFormat('l, d F Y') }}</td>
                        @if (!$proposal->keterangan)
                            <td class="text-center ">{{ $proposal->keterangan }}</td>
                        @elseif ($proposal->keterangan == 'Sangat Baik' || $proposal->keterangan == 'Baik')
                            <td class="text-center bg-success ">{{ $proposal->keterangan }}</td>
                        @elseif ($proposal->keterangan == 'Diterima' || $proposal->keterangan == 'Cukup Diterima')
                            <td class="text-center bg-warning ">{{ $proposal->keterangan }}</td>
                        @else
                            <td class="text-center bg-danger ">{{ $proposal->keterangan }}</td>
                        @endif
                        <td class="text-center">

                            <a href='/progress/proposal/{{ $proposal->id }}' type="button"
                                class="badge bg-info rounded border-0"><i class="fa fa-circle-info"></i></a>

                            <a href='/progress/logbookProposal/{{ $proposal->id }}' target="_blank" type="button"
                                class="badge bg-primary rounded border-0"><i class="fa-solid fa-download"></i></a>

                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>

</div>

@push('scripts')
    <script>
        console.log('test');
        let dataProgresProposalBab1 = <?php echo json_encode($proposalSubBab1); ?>;
        let dataProgresProposalBab2 = <?php echo json_encode($proposalSubBab2); ?>;
        let dataProgresProposalBab3 = <?php echo json_encode($proposalSubBab3); ?>;
        let dataBimbinganProposal = <?php echo json_encode($bimbinganProposal); ?>;

        document.addEventListener('DOMContentLoaded', function() {
            const chart = Highcharts.chart('statistik2', {
                chart: {
                    type: 'column'
                },
                exporting: {
                    enabled: false
                },
                title: {
                    text: 'Persentase Progress Proposal',
                    align: 'center'
                },
                xAxis: {
                    categories: dataBimbinganProposal
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    labels: {
                        formatter: function() {
                            return this.value + "%";
                        }
                    },
                    title: {
                        text: 'Persentase Progress'
                    },
                    stackLabels: {
                        enabled: true
                    }
                },
                legend: {
                    align: 'left',
                    x: 100,
                    verticalAlign: 'top',
                    y: 45,
                    floating: true,
                    backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
                    borderColor: '#CCC',
                    borderWidth: 1,
                    shadow: false,
                    layout: 'vertical', // Atur layout menjadi vertical untuk membuat 2 kolom
                },
                tooltip: {
                    headerFormat: '<b>Bimbingan Ke {point.key}</b><br/>',
                    pointFormat: '{series.name}: {point.y} %<br/>Total: {point.stackTotal} %'
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true,
                            format: '{y} %',
                            style: {
                                textOutline: 'none'
                            }
                        }
                    }
                },
                series: [{
                        name: 'BAB 1',
                        data: dataProgresProposalBab1
                    },
                    {
                        name: 'BAB 2',
                        data: dataProgresProposalBab2
                    },
                    {
                        name: 'BAB 3',
                        data: dataProgresProposalBab3
                    },
                ]

            });
        });
    </script>

    <script>
        let dataProgresSkripsiBab1 = <?php echo json_encode($skripsiSubBab1); ?>;
        let dataProgresSkripsiBab2 = <?php echo json_encode($skripsiSubBab2); ?>;
        let dataProgresSkripsiBab3 = <?php echo json_encode($skripsiSubBab3); ?>;
        let dataProgresSkripsiBab4 = <?php echo json_encode($skripsiSubBab4); ?>;
        let dataProgresSkripsiBab5 = <?php echo json_encode($skripsiSubBab5); ?>;
        let dataBimbinganSkripsi = <?php echo json_encode($bimbinganSkripsi); ?>;

        document.addEventListener('DOMContentLoaded', function() {
            const chart = Highcharts.chart('statistik', {
                chart: {
                    type: 'column'
                },
                exporting: {
                    enabled: false
                },
                title: {
                    text: 'Persentase Progress Skripsi',
                    align: 'center'
                },
                xAxis: {
                    categories: dataBimbinganSkripsi
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    labels: {
                        formatter: function() {
                            return this.value + "%";
                        }
                    },
                    title: {
                        text: 'Persentase Progress'
                    },
                    stackLabels: {
                        enabled: true
                    }
                },
                legend: {
                    align: 'left',
                    x: 100,
                    verticalAlign: 'top',
                    y: 45,
                    floating: true,
                    backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
                    borderColor: '#CCC',
                    borderWidth: 1,
                    shadow: false,
                    layout: 'vertical', // Atur layout menjadi vertical untuk membuat 2 kolom
                },
                tooltip: {
                    headerFormat: '<b>Bimbingan Ke {point.key}</b><br/>',
                    pointFormat: '{series.name}: {point.y} %<br/>Total: {point.stackTotal} %'
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true,
                            format: '{y} %',
                            style: {
                                textOutline: 'none'
                            }
                        }
                    }
                },
                series: [{
                        name: 'BAB 1',
                        data: dataProgresSkripsiBab1
                    },
                    {
                        name: 'BAB 2',
                        data: dataProgresSkripsiBab2
                    },
                    {
                        name: 'BAB 3',
                        data: dataProgresSkripsiBab3
                    },
                    {
                        name: 'BAB 4',
                        data: dataProgresSkripsiBab4
                    },
                    {
                        name: 'BAB 5',
                        data: dataProgresSkripsiBab5
                    },
                ]

            });
        });
    </script>
@endpush
