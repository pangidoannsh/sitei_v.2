@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Data Statistik
@endsection

@section('sub-title')
    Data Statistik
@endsection

@section('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

    {{-- HIGHCHART TEKNIK INFORMATIKA S1 --}}

    <script>
        Highcharts.chart('container', {
    chart: {
        type: 'pie'
    },
    exporting: {
        enabled: false,
    },
    title: {
        text: 'Status Skripsi'
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.point.name + '</b>: ' + Highcharts.numberFormat(this.point.percentage, 1) + '%'; // Menggunakan properti point.percentage untuk mendapatkan persentase yang sesuai dengan data yang ditampilkan dalam chart
        }
    },
    // subtitle: {
    //     text:
    //         'Jurusan Teknik Elektro'
    // },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: [{
                enabled: true,
                distance: 20
            }, {
                enabled: true,
                distance: -40,
                format: '{point.percentage:.1f}%',
                style: {
                    fontSize: '1.0em',
                    color:'white',
                    textOutline: 'none',
                    opacity: 0.7
                },
                filter: {
                    operator: '>',
                    property: 'percentage',
                    value: 10
                }
            }]
        },
        pie: {
            showInLegend: true // Menampilkan legend
        },
    },
    series: [{
        name: 'Persentase',
        colorByPoint: true,
        data: [
            @foreach($teknikInformatikaData['statuses'] as $status => $count)
                {
                    name: '{{ $status }} ({{ $count }})',
                    y: {{ $count }},
                },
            @endforeach
        ]
    }]
});
    </script>

    <script>
        Highcharts.chart('containerKp', {
    chart: {
        type: 'pie'
    },
    exporting: {
        enabled: false,
    },
    title: {
        text: 'Status KP'
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.point.name + '</b>: ' + Highcharts.numberFormat(this.point.percentage, 1) + '%'; // Menggunakan properti point.percentage untuk mendapatkan persentase yang sesuai dengan data yang ditampilkan dalam chart
        }
    },
    // subtitle: {
    //     text:
    //         'Jurusan Teknik Elektro'
    // },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: [{
                enabled: true,
                distance: 20
            }, {
                enabled: true,
                distance: -40,
                format: '{point.percentage:.1f}%',
                style: {
                    fontSize: '1.0em',
                    color:'white',
                    textOutline: 'none',
                    opacity: 0.7
                },
                filter: {
                    operator: '>',
                    property: 'percentage',
                    value: 10
                }
            }]
        },
        pie: {
            showInLegend: true // Menampilkan legend
        },
    },
    series: [{
        name: 'Persentase',
        colorByPoint: true,
        data: [
            @foreach($teknikInformatikaDataKp['statuses'] as $status => $count)
                {
                    name: '{{ $status }} ({{ $count }})',
                    y: {{ $count }},
                },
            @endforeach
        ]
    }]
});
    </script>

    <script>
        Highcharts.chart('container2', {
            chart: {
                type: 'column'
            },
            exporting: {
                enabled: false
            },
            title: {
                text: 'Status Skripsi per Angkatan',
                align: 'center'
            },
            xAxis: {
                categories: {!! json_encode(array_keys($skripsiDataInformatikaByAngkatan)) !!}
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Skripsi'
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
                backgroundColor:
                    Highcharts.defaultOptions.legend.backgroundColor || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false,
                layout: 'vertical', // Atur layout menjadi vertical untuk membuat 2 kolom
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        style: {
                            textOutline: 'none'
                        }
                    }
                }
            },
            series: [
                @foreach($skripsiInformatikaStatuses as $status => $subStatuses)
                    {
                        name: '{{ $status }}',
                        data: {!! json_encode(array_values(array_map(function($angkatan) use ($status) {
                            return $angkatan[$status];
                        }, $skripsiDataInformatikaByAngkatan))) !!}
                    },
                @endforeach
            ]

        });
    </script>

    <script>
        Highcharts.chart('container2Kp', {
            chart: {
                type: 'column'
            },
            exporting: {
                enabled: false
            },
            title: {
                text: 'Status KP per Angkatan',
                align: 'center'
            },
            xAxis: {
                categories: {!! json_encode(array_keys($kpDataInformatikaByAngkatan)) !!}
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah KP'
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
                backgroundColor:
                    Highcharts.defaultOptions.legend.backgroundColor || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false,
                layout: 'vertical', // Atur layout menjadi vertical untuk membuat 2 kolom
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        style: {
                            textOutline: 'none'
                        }
                    }
                }
            },
            series: [
                @foreach($kpInformatikaStatuses as $status => $subStatuses)
                    {
                        name: '{{ $status }}',
                        data: {!! json_encode(array_values(array_map(function($angkatan) use ($status) {
                            return $angkatan[$status];
                        }, $kpDataInformatikaByAngkatan))) !!}
                    },
                @endforeach
            ]

        });
    </script>
    
    <script>
        Highcharts.chart('container2jumlahlulusan', {
            chart: {
                type: 'column'
            },
            exporting: {
                enabled: false
            },
            title: {
                text: 'Jumlah Lulusan per Tahun'
            },
            xAxis: {
                categories: {!! json_encode(array_keys($jumlahLulusanPerTahun)) !!}, // Menggunakan tahun sebagai kategori
                labels: {
                    formatter: function() {
                        var tahun = this.value;
                        var tahunAwal = tahun.substring(2, 4);
                        var tahunAkhir = parseInt(tahunAwal) + 1;
                        return tahunAwal + '/' + tahunAkhir;
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Lulusan'
                }
            },
            tooltip: {
                headerFormat: '<b>{point.key}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}',
                shared: true
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        style: {
                            textOutline: 'none'
                        }
                    }
                }
            },
            series: [{
                name: 'Jumlah Lulusan',
                data: {!! json_encode(array_values($jumlahLulusanPerTahun)) !!}
            }]
        });
    </script>

    <script>
        Highcharts.chart('container2lamapengerjaanskripsi', {
            chart: {
                type: 'column'
            },
            exporting: {
                enabled: false
            },
            title: {
                text: 'Durasi Pengerjaan Skripsi per Tahun Ajaran'
            },
            xAxis: {
                categories: {!! json_encode(array_keys($rataRataDurasiPerSemester)) !!}, // Menggunakan tahun sebagai kategori
                labels: {
                    formatter: function() {
                        var tahun = this.value;
                        var tahunAwal = tahun.substring(2, 4);
                        var tahunAkhir = parseInt(tahunAwal) + 1;
                        return tahunAwal + '/' + tahunAkhir;
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rerata Durasi'
                }
            },
            tooltip: {
                headerFormat: '<b>{point.key}</b><br/>',
                pointFormatter: function() {
                    var bulan = Math.floor(this.y); // Bagian bulan dari durasi
                    var hari = Math.round((this.y - bulan) * 30); // Bagian hari dari durasi
                    return this.series.name + ': ' + bulan + ' bulan ' + hari + ' hari';
                },
                shared: true
            },
            plotOptions: {
                column: {
                    stacking: null,
                    dataLabels: {
                        enabled: true,
                        style: {
                            textOutline: 'none'
                        },
                        formatter: function() {
                            var bulan = Math.floor(this.y); // Bagian bulan dari durasi
                            var hari = Math.round((this.y - bulan) * 30); // Bagian hari dari durasi
                            return bulan + ' bulan <br/> ' + hari + ' hari';
                        }
                    }
                }
            },
            series: [{
                name: 'Rerata Durasi',
                data: {!! json_encode(array_values($rataRataDurasiPerSemester)) !!}
            }]
        });
    </script>

    {{-- END HIGHCHART TEKNIK INFORMATIKA S1 --}}

    {{-- HIGHCHART TEKNIK ELEKTRO S1 --}}

    <script>
        Highcharts.chart('container3', {
    chart: {
        type: 'pie'
    },
    exporting: {
        enabled: false,
    },
    title: {
        text: 'Status Skripsi'
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.point.name + '</b>: ' + Highcharts.numberFormat(this.point.percentage, 1) + '%'; // Menggunakan properti point.percentage untuk mendapatkan persentase yang sesuai dengan data yang ditampilkan dalam chart
        }
    },
    // subtitle: {
    //     text:
    //         'Jurusan Teknik Elektro'
    // },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: [{
                enabled: true,
                distance: 20
            }, {
                enabled: true,
                distance: -40,
                format: '{point.percentage:.1f}%',
                style: {
                    fontSize: '1.0em',
                    color:'white',
                    textOutline: 'none',
                    opacity: 0.7
                },
                filter: {
                    operator: '>',
                    property: 'percentage',
                    value: 10
                }
            }]
        },
        pie: {
            showInLegend: true // Menampilkan legend
        },
    },
    series: [{
        name: 'Persentase',
        colorByPoint: true,
        data: [
            @foreach($teknikElektroS1Data['statuses'] as $status => $count)
                {
                    name: '{{ $status }} ({{ $count }})',
                    y: {{ $count }},
                },
            @endforeach
        ]
    }]
});
    </script>

    <script>
        Highcharts.chart('container3Kp', {
    chart: {
        type: 'pie'
    },
    exporting: {
        enabled: false,
    },
    title: {
        text: 'Status KP'
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.point.name + '</b>: ' + Highcharts.numberFormat(this.point.percentage, 1) + '%'; // Menggunakan properti point.percentage untuk mendapatkan persentase yang sesuai dengan data yang ditampilkan dalam chart
        }
    },
    // subtitle: {
    //     text:
    //         'Jurusan Teknik Elektro'
    // },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: [{
                enabled: true,
                distance: 20
            }, {
                enabled: true,
                distance: -40,
                format: '{point.percentage:.1f}%',
                style: {
                    fontSize: '1.0em',
                    color:'white',
                    textOutline: 'none',
                    opacity: 0.7
                },
                filter: {
                    operator: '>',
                    property: 'percentage',
                    value: 10
                }
            }]
        },
        pie: {
            showInLegend: true // Menampilkan legend
        },
    },
    series: [{
        name: 'Persentase',
        colorByPoint: true,
        data: [
            @foreach($teknikElektroS1DataKp['statuses'] as $status => $count)
                {
                    name: '{{ $status }} ({{ $count }})',
                    y: {{ $count }},
                },
            @endforeach
        ]
    }]
});
    </script>
    
    <script>
        Highcharts.chart('container3jumlahlulusan', {
            chart: {
                type: 'column'
            },
            exporting: {
                enabled: false
            },
            title: {
                text: 'Jumlah Lulusan per Tahun'
            },
            xAxis: {
                categories: {!! json_encode(array_keys($jumlahLulusanPerTahunElektroS1)) !!}, // Menggunakan tahun sebagai kategori
                labels: {
                    formatter: function() {
                        var tahun = this.value;
                        var tahunAwal = tahun.substring(2, 4);
                        var tahunAkhir = parseInt(tahunAwal) + 1;
                        return tahunAwal + '/' + tahunAkhir;
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Lulusan'
                }
            },
            tooltip: {
                headerFormat: '<b>{point.key}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}',
                shared: true
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        style: {
                            textOutline: 'none'
                        }
                    }
                }
            },
            series: [{
                name: 'Jumlah Lulusan',
                data: {!! json_encode(array_values($jumlahLulusanPerTahunElektroS1)) !!}
            }]
        });
    </script>

    <script>
        Highcharts.chart('container3lamapengerjaanskripsi', {
            chart: {
                type: 'column'
            },
            exporting: {
                enabled: false
            },
            title: {
                text: 'Durasi Pengerjaan Skripsi per Tahun Ajaran'
            },
            xAxis: {
                categories: {!! json_encode(array_keys($rataRataDurasiPerSemesterElektroS1)) !!}, // Menggunakan tahun sebagai kategori
                labels: {
                    formatter: function() {
                        var tahun = this.value;
                        var tahunAwal = tahun.substring(2, 4);
                        var tahunAkhir = parseInt(tahunAwal) + 1;
                        return tahunAwal + '/' + tahunAkhir;
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rerata Durasi'
                }
            },
            tooltip: {
                headerFormat: '<b>{point.key}</b><br/>',
                pointFormatter: function() {
                    var bulan = Math.floor(this.y); // Bagian bulan dari durasi
                    var hari = Math.round((this.y - bulan) * 30); // Bagian hari dari durasi
                    return this.series.name + ': ' + bulan + ' bulan ' + hari + ' hari';
                },
                shared: true
            },
            plotOptions: {
                column: {
                    stacking: null,
                    dataLabels: {
                        enabled: true,
                        style: {
                            textOutline: 'none'
                        },
                        formatter: function() {
                            var bulan = Math.floor(this.y); // Bagian bulan dari durasi
                            var hari = Math.round((this.y - bulan) * 30); // Bagian hari dari durasi
                            return bulan + ' bulan <br/> ' + hari + ' hari';
                        }
                    }
                }
            },
            series: [{
                name: 'Rerata Durasi',
                data: {!! json_encode(array_values($rataRataDurasiPerSemesterElektroS1)) !!}
            }]
        });
    </script>

    <script>
        Highcharts.chart('container4', {
            chart: {
                type: 'column'
            },
            exporting: {
                enabled: false
            },
            title: {
                text: 'Status Skripsi per Angkatan',
                align: 'center'
            },
            xAxis: {
                categories: {!! json_encode(array_keys($skripsiDataElektroS1ByAngkatan)) !!}
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Skripsi'
                },
                stackLabels: {
                    enabled: true
                }
            },
            legend: {
                align: 'left',
                x: 350,
                verticalAlign: 'top',
                y: 45,
                floating: true,
                backgroundColor:
                    Highcharts.defaultOptions.legend.backgroundColor || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false,
                layout: 'vertical', // Atur layout menjadi vertical untuk membuat 2 kolom
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        style: {
                            textOutline: 'none'
                        }
                    }
                }
            },
            series: [
                @foreach($skripsiElektroS1Statuses as $status => $subStatuses)
                    {
                        name: '{{ $status }}',
                        data: {!! json_encode(array_values(array_map(function($angkatan) use ($status) {
                            return $angkatan[$status];
                        }, $skripsiDataElektroS1ByAngkatan))) !!}
                    },
                @endforeach
            ]

        });
    </script>

    <script>
        Highcharts.chart('container4Kp', {
            chart: {
                type: 'column'
            },
            exporting: {
                enabled: false
            },
            title: {
                text: 'Status KP per Angkatan',
                align: 'center'
            },
            xAxis: {
                categories: {!! json_encode(array_keys($kpDataElektroS1ByAngkatan)) !!}
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah KP'
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
                backgroundColor:
                    Highcharts.defaultOptions.legend.backgroundColor || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false,
                layout: 'vertical', // Atur layout menjadi vertical untuk membuat 2 kolom
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        style: {
                            textOutline: 'none'
                        }
                    }
                }
            },
            series: [
                @foreach($kpElektroS1Statuses as $status => $subStatuses)
                    {
                        name: '{{ $status }}',
                        data: {!! json_encode(array_values(array_map(function($angkatan) use ($status) {
                            return $angkatan[$status];
                        }, $kpDataElektroS1ByAngkatan))) !!}
                    },
                @endforeach
            ]

        });
    </script>

    {{-- END HIGHCHART TEKNIK ELEKTRO S1 --}}

    {{-- HIGHCHART TEKNIK ELEKTRO D3 --}}

    <script>
        Highcharts.chart('container5', {
    chart: {
        type: 'pie'
    },
    exporting: {
        enabled: false,
    },
    title: {
        text: 'Status Skripsi'
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.point.name + '</b>: ' + Highcharts.numberFormat(this.point.percentage, 1) + '%'; // Menggunakan properti point.percentage untuk mendapatkan persentase yang sesuai dengan data yang ditampilkan dalam chart
        }
    },
    // subtitle: {
    //     text:
    //         'Jurusan Teknik Elektro'
    // },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: [{
                enabled: true,
                distance: 20
            }, {
                enabled: true,
                distance: -40,
                format: '{point.percentage:.1f}%',
                style: {
                    fontSize: '1.0em',
                    color:'white',
                    textOutline: 'none',
                    opacity: 0.7
                },
                filter: {
                    operator: '>',
                    property: 'percentage',
                    value: 10
                }
            }]
        },
        pie: {
            showInLegend: true // Menampilkan legend
        },
    },
    series: [{
        name: 'Persentase',
        colorByPoint: true,
        data: [
            @foreach($teknikElektroD3Data['statuses'] as $status => $count)
                {
                    name: '{{ $status }} ({{ $count }})',
                    y: {{ $count }},
                },
            @endforeach
        ]
    }]
});
    </script>

    <script>
        Highcharts.chart('container5Kp', {
    chart: {
        type: 'pie'
    },
    exporting: {
        enabled: false,
    },
    title: {
        text: 'Status KP'
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.point.name + '</b>: ' + Highcharts.numberFormat(this.point.percentage, 1) + '%'; // Menggunakan properti point.percentage untuk mendapatkan persentase yang sesuai dengan data yang ditampilkan dalam chart
        }
    },
    // subtitle: {
    //     text:
    //         'Jurusan Teknik Elektro'
    // },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: [{
                enabled: true,
                distance: 20
            }, {
                enabled: true,
                distance: -40,
                format: '{point.percentage:.1f}%',
                style: {
                    fontSize: '1.0em',
                    color:'white',
                    textOutline: 'none',
                    opacity: 0.7
                },
                filter: {
                    operator: '>',
                    property: 'percentage',
                    value: 10
                }
            }]
        },
        pie: {
            showInLegend: true // Menampilkan legend
        },
    },
    series: [{
        name: 'Persentase',
        colorByPoint: true,
        data: [
            @foreach($teknikElektroD3DataKp['statuses'] as $status => $count)
                {
                    name: '{{ $status }} ({{ $count }})',
                    y: {{ $count }},
                },
            @endforeach
        ]
    }]
});
    </script>
    
    <script>
        Highcharts.chart('container5jumlahlulusan', {
            chart: {
                type: 'column'
            },
            exporting: {
                enabled: false
            },
            title: {
                text: 'Jumlah Lulusan per Tahun'
            },
            xAxis: {
                categories: {!! json_encode(array_keys($jumlahLulusanPerTahunElektroD3)) !!}, // Menggunakan tahun sebagai kategori
                labels: {
                    formatter: function() {
                        var tahun = this.value;
                        var tahunAwal = tahun.substring(2, 4);
                        var tahunAkhir = parseInt(tahunAwal) + 1;
                        return tahunAwal + '/' + tahunAkhir;
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Lulusan'
                }
            },
            tooltip: {
                headerFormat: '<b>{point.key}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}',
                shared: true
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        style: {
                            textOutline: 'none'
                        }
                    }
                }
            },
            series: [{
                name: 'Jumlah Lulusan',
                data: {!! json_encode(array_values($jumlahLulusanPerTahunElektroD3)) !!}
            }]
        });
    </script>

    <script>
        Highcharts.chart('container5lamapengerjaanskripsi', {
            chart: {
                type: 'column'
            },
            exporting: {
                enabled: false
            },
            title: {
                text: 'Durasi Pengerjaan Skripsi per Tahun Ajaran'
            },
            xAxis: {
                categories: {!! json_encode(array_keys($rataRataDurasiPerSemesterElektroD3)) !!}, // Menggunakan tahun sebagai kategori
                labels: {
                    formatter: function() {
                        var tahun = this.value;
                        var tahunAwal = tahun.substring(2, 4);
                        var tahunAkhir = parseInt(tahunAwal) + 1;
                        return tahunAwal + '/' + tahunAkhir;
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rerata Durasi'
                }
            },
            tooltip: {
                headerFormat: '<b>{point.key}</b><br/>',
                pointFormatter: function() {
                    var bulan = Math.floor(this.y); // Bagian bulan dari durasi
                    var hari = Math.round((this.y - bulan) * 30); // Bagian hari dari durasi
                    return this.series.name + ': ' + bulan + ' bulan ' + hari + ' hari';
                },
                shared: true
            },
            plotOptions: {
                column: {
                    stacking: null,
                    dataLabels: {
                        enabled: true,
                        style: {
                            textOutline: 'none'
                        },
                        formatter: function() {
                            var bulan = Math.floor(this.y); // Bagian bulan dari durasi
                            var hari = Math.round((this.y - bulan) * 30); // Bagian hari dari durasi
                            return bulan + ' bulan <br/> ' + hari + ' hari';
                        }
                    }
                }
            },
            series: [{
                name: 'Rerata Durasi',
                data: {!! json_encode(array_values($rataRataDurasiPerSemesterElektroD3)) !!}
            }]
        });
    </script>

    <script>
        Highcharts.chart('container6', {
            chart: {
                type: 'column'
            },
            exporting: {
                enabled: false
            },
            title: {
                text: 'Status Skripsi per Angkatan',
                align: 'center'
            },
            xAxis: {
                categories: {!! json_encode(array_keys($skripsiDataElektroD3ByAngkatan)) !!}
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Skripsi'
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
                backgroundColor:
                    Highcharts.defaultOptions.legend.backgroundColor || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false,
                layout: 'vertical', // Atur layout menjadi vertical untuk membuat 2 kolom
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        style: {
                            textOutline: 'none'
                        }
                    }
                }
            },
            series: [
                @foreach($skripsiElektroD3Statuses as $status => $subStatuses)
                    {
                        name: '{{ $status }}',
                        data: {!! json_encode(array_values(array_map(function($angkatan) use ($status) {
                            return $angkatan[$status];
                        }, $skripsiDataElektroD3ByAngkatan))) !!}
                    },
                @endforeach
            ]

        });
    </script>

    <script>
        Highcharts.chart('container6Kp', {
            chart: {
                type: 'column'
            },
            exporting: {
                enabled: false
            },
            title: {
                text: 'Status KP per Angkatan',
                align: 'center'
            },
            xAxis: {
                categories: {!! json_encode(array_keys($kpDataElektroD3ByAngkatan)) !!}
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Skripsi'
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
                backgroundColor:
                    Highcharts.defaultOptions.legend.backgroundColor || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false,
                layout: 'vertical', // Atur layout menjadi vertical untuk membuat 2 kolom
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        style: {
                            textOutline: 'none'
                        }
                    }
                }
            },
            series: [
                @foreach($kpElektroD3Statuses as $status => $subStatuses)
                    {
                        name: '{{ $status }}',
                        data: {!! json_encode(array_values(array_map(function($angkatan) use ($status) {
                            return $angkatan[$status];
                        }, $kpDataElektroD3ByAngkatan))) !!}
                    },
                @endforeach
            ]

        });
    </script>

    {{-- END HIGHCHART TEKNIK ELEKTRO D3 --}}

@endsection


@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
        </div>
    @endif
<section class ="mb-5">
    <div class="container card p-4 mb-5">

        <ol class="breadcrumb col-lg-12">

            <li>
                <a href="/statistik" class="breadcrumb-item active fw-bold text-success px-1">Statistik</a>
            </li>

            <span class="px-2">|</span>
            <li><a href="/statistik/bimbingan-kp" class="px-1">Bimbingan KP</a></li>
            <span class="px-2">|</span>
            <li><a href="/statistik/bimbingan-skripsi" class="px-1">Bimbingan Skripsi</a></li>
            <span class="px-2">|</span>
            <li><a href="/statistik/riwayat-kp" class="px-1">Riwayat KP</a></li>
            <span class="px-2">|</span>
            <li><a href="/statistik/judul-skripsi-terdaftar" class="px-1">Riwayat Skripsi</a></li>

        </ol>

        <div class="container-fluid">
            <div class="card mt-4 mb-4 rounded bg-success">
                <div class="p-2 pt-3">
                    <h5 class="text-center text-bold">Prodi Teknik Informatika S1</h5>
                </div>
            </div>
            <div class="card pt-4 pb-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div id="container"></div>
                    </div>
                    <div class="col-lg-6">
                        <div id="container2"></div>
                    </div>
                </div>
                <div class="mt-4">
                    <hr>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <div id="container2jumlahlulusan"></div>
                    </div>
                    <div class="col-lg-6">
                        <div id="container2lamapengerjaanskripsi"></div>
                    </div>
                </div>
                <div class="mt-4">
                    <hr>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <div id="containerKp"></div>
                    </div>
                    <div class="col-lg-6">
                        <div id="container2Kp"></div>
                    </div>
                </div>
            </div>

            <div class="card mt-5 mb-4 rounded bg-success">
                <div class="p-2 pt-3">
                    <h5 class="text-center text-bold">Prodi Teknik Elektro S1</h5>
                </div>
            </div>
            <div class="card pt-4 pb-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div id="container3"></div>
                    </div>
                    <div class="col-lg-6">
                        <div id="container4"></div>
                    </div>
                </div>
                <div class="mt-4">
                    <hr>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <div id="container3jumlahlulusan"></div>
                    </div>
                    <div class="col-lg-6">
                        <div id="container3lamapengerjaanskripsi"></div>
                    </div>
                </div>
                <div class="mt-4">
                    <hr>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <div id="container3Kp"></div>
                    </div>
                    <div class="col-lg-6">
                        <div id="container4Kp"></div>
                    </div>
                </div>
            </div>
            
            @if (!empty($teknikElektroD3Data['statuses']))
            <div class="card mt-5 mb-4 rounded bg-success">
                <div class="p-2 pt-3">
                    <h5 class="text-center text-bold">Prodi Teknik Elektro D3</h5>
                </div>
            </div>
            <div class="card pt-4 pb-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div id="container5"></div>
                    </div>
                    <div class="col-lg-6">
                        <div id="container6"></div>
                    </div>
                </div>
                <div class="mt-4">
                    <hr>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <div id="container5jumlahlulusan"></div>
                    </div>
                    <div class="col-lg-6">
                        <div id="container5lamapengerjaanskripsi"></div>
                    </div>
                </div>
                <div class="mt-4">
                    <hr>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <div id="container5Kp"></div>
                    </div>
                    <div class="col-lg-6">
                        <div id="container6Kp"></div>
                    </div>
                </div>
            </div>
            @endif
        </div>

</section>
           
        </div>
    </div>
<br>
    <br>
    <br>
@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <a class="text-success fw-bold"
                    formtarget="_blank" target="_blank" href="https://fahrilhadi.com">( Fahril Hadi )</a></p>
        </div>
    </section>
@endsection