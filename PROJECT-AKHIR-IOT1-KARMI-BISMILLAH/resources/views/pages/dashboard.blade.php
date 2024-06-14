@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-sm-12 col-md-7">
        <div class="card iq-mb-3">
            <div class="card-body">
                <h4 class="card-title">Monitoring Sensor Gas</h4>
                <p class="card-text">Grafik berikut adalah monitoring sensor gas 3 menit terakhir.</p>

                <div id="chartGas"></div>

                <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-5">
        <div class="card iq-mb-3">
            <div class="card-body">
                <h4 class="card-title">Monitoring Gas</h4>
                <p class="card-text">Grafik berikut adalah monitoring sensor gas 3 menit terakhir.</p>

                <div id="gaugeGas"></div>

                <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-7">
        <div class="card iq-mb-3">
            <div class="card-body">
                <h4 class="card-title">Monitoring Sensor Hujan</h4>
                <p class="card-text">Grafik berikut adalah monitoring sensor hujan 3 menit terakhir.</p>

                <div id="chartHujan"></div>

                <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-5">
        <div class="card iq-mb-3">
            <div class="card-body">
                <h4 class="card-title">Monitoring Sensor Hujan</h4>
                <p class="card-text">Grafik berikut adalah monitoring sensor hujan 3 menit terakhir.</p>

                <div id="gaugeHujan"></div>

                <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
            </div>
        </div>
    </div>
</div>



@endsection

@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
    let chartGas, gaugeGas, chartHujan, gaugeHujan;
    const updateInterval = 1000;

    async function requestchartGas() {
        // load data
        const result = await fetch("{{ route('api.sensors.mq.index') }}");

        if (result.ok) {
            // cek jika berhasil
            const data = await result.json();
            const sensorData = data.data;

            // parse data
            const date = sensorData[0].created_at;
            const value = sensorData[0].value;

            // membuat point
            const point = [new Date(date).getTime(), Number(value)];

            // menambahkan point ke chart
            const series = chartGas.series[0],
                shift = series.data.length > 20;
            // shift if the series is
            // longer than 20

            // add the point
            chartGas.series[0].addPoint(point, true, shift);

            // refresh data setiap x detik
            setTimeout(requestchartGas, updateInterval); //1000ms = 1 detik
        }
    }

    async function requesGaugeGas() {
        // load data
        const result = await fetch("{{ route('api.sensors.mq.index') }}");

        if (result.ok) {
            // cek jika berhasil
            const data = await result.json();
            const sensorData = data.data;

            // parse data
            const value = sensorData[0].value;

            if (gaugeGas && !gaugeGas.renderer.forExport) {
                const point = gaugeGas.series[0].points[0];
                point.update(Number(value));
            }

            // refresh data setiap x detik
            setTimeout(requesGaugeGas, updateInterval); //1000ms = 1 detik
        }
    }

    window.addEventListener('load', function() {
        chartGas = new Highcharts.Chart({
            chart: {
                renderTo: 'chartGas',
                defaultSeriesType: 'spline',
                events: {
                    load: requestchartGas
                }
            },
            title: {
                text: ''
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150,
                maxZoom: 20 * 1000
            },
            yAxis: {
                minPadding: 0.2,
                maxPadding: 0.2,
                title: {
                    text: 'Value',
                    margin: 80
                }
            },
            series: [{
                name: 'Sensor Gas',
                data: []
            }]
        });

        gaugeGas = new Highcharts.Chart({

            chart: {
                renderTo: 'gaugeGas',
                type: 'gauge',
                plotBackgroundColor: null,
                plotBackgroundImage: null,
                plotBorderWidth: 0,
                plotShadow: false,
                height: '80%',
                events: {
                    load: requesGaugeGas
                }
            },

            title: {
                text: ''
            },

            pane: {
                startAngle: -90,
                endAngle: 89.9,
                background: null,
                center: ['50%', '75%'],
                size: '110%'
            },

            // the value axis
            yAxis: {
                min: 0,
                max: 1000,
                tickPixelInterval: 72,
                tickPosition: 'inside',
                tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
                tickLength: 20,
                tickWidth: 2,
                minorTickInterval: null,
                labels: {
                    distance: 20,
                    style: {
                        fontSize: '14px'
                    }
                },
                lineWidth: 0,
                plotBands: [{
                    from: 0,
                    to: 500,
                    color: '#55BF3B', // green
                    thickness: 20,

                }, {
                    from: 450,
                    to: 800,
                    color: '#DDDF0D', // yellow
                    thickness: 20,

                }, {
                    from: 750,
                    to: 1000,
                    color: '#DF5353', // red
                    thickness: 20,

                }]
            },

            series: [{
                name: 'Speed',
                data: [80],
                tooltip: {
                    valueSuffix: 'gas'
                },
                dataLabels: {
                    format: '{y} gas',
                    borderWidth: 0,
                    color: (
                        Highcharts.defaultOptions.title &&
                        Highcharts.defaultOptions.title.style &&
                        Highcharts.defaultOptions.title.style.color
                    ) || '#333333',
                    style: {
                        fontSize: '16px'
                    }
                },
                dial: {
                    radius: '80%',
                    backgroundColor: 'gray',
                    baseWidth: 12,
                    baseLength: '0%',
                    rearLength: '0%'
                },
                pivot: {
                    backgroundColor: 'gray',
                    radius: 6
                }

            }]

        });


    });

    async function requestchartHujan() {
        // load data
        const result = await fetch("{{ route('api.sensors.rain.index') }}");

        if (result.ok) {
            // cek jika berhasil
            const data = await result.json();
            const sensorData = data.data;

            // parse data
            const date = sensorData[0].created_at;
            const value = sensorData[0].value;

            // membuat point
            const point = [new Date(date).getTime(), Number(value)];

            // menambahkan point ke chart
            const series = chartHujan.series[0],
                shift = series.data.length > 20;
            // shift if the series is
            // longer than 20

            // add the point
            chartHujan.series[0].addPoint(point, true, shift);

            // refresh data setiap x detik
            setTimeout(requestchartHujan, updateInterval); //1000ms = 1 detik
        }
    }

    async function requesGaugeHujan() {
        // load data
        const result = await fetch("{{ route('api.sensors.rain.index') }}");

        if (result.ok) {
            // cek jika berhasil
            const data = await result.json();
            const sensorData = data.data;

            // parse data
            const value = sensorData[0].value;

            if (gaugeHujan && !gaugeHujan.renderer.forExport) {
                const point = gaugeHujan.series[0].points[0];
                point.update(Number(value));
            }

            // refresh data setiap x detik
            setTimeout(requesGaugeHujan, updateInterval); //1000ms = 1 detik
        }
    }

    window.addEventListener('load', function() {
        chartHujan = new Highcharts.Chart({
            chart: {
                renderTo: 'chartHujan',
                defaultSeriesType: 'spline',
                events: {
                    load: requestchartHujan
                }
            },
            title: {
                text: ''
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150,
                maxZoom: 20 * 1000
            },
            yAxis: {
                minPadding: 0.2,
                maxPadding: 0.2,
                title: {
                    text: 'Value',
                    margin: 80
                }
            },
            series: [{
                name: 'Sensor Hujan',
                data: []
            }]
        });

        gaugeHujan = new Highcharts.Chart({

            chart: {
                renderTo: 'gaugeHujan',
                type: 'gauge',
                plotBackgroundColor: null,
                plotBackgroundImage: null,
                plotBorderWidth: 0,
                plotShadow: false,
                height: '80%',
                events: {
                    load: requesGaugeHujan
                }
            },

            title: {
                text: ''
            },

            pane: {
                startAngle: -90,
                endAngle: 89.9,
                background: null,
                center: ['50%', '75%'],
                size: '110%'
            },

            // the value axis
            yAxis: {
                min: 0,
                max: 1000,
                tickPixelInterval: 72,
                tickPosition: 'inside',
                tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
                tickLength: 20,
                tickWidth: 2,
                minorTickInterval: null,
                labels: {
                    distance: 20,
                    style: {
                        fontSize: '14px'
                    }
                },
                lineWidth: 0,
                plotBands: [{
                    from: 0,
                    to: 500,
                    color: '#55BF3B', // green
                    thickness: 20,

                }, {
                    from: 450,
                    to: 800,
                    color: '#DDDF0D', // yellow
                    thickness: 20,

                }, {
                    from: 750,
                    to: 1000,
                    color: '#DF5353', // red
                    thickness: 20,

                }]
            },

            series: [{
                name: 'Speed',
                data: [80],
                tooltip: {
                    valueSuffix: 'hujan'
                },
                dataLabels: {
                    format: '{y} hujan',
                    borderWidth: 0,
                    color: (
                        Highcharts.defaultOptions.title &&
                        Highcharts.defaultOptions.title.style &&
                        Highcharts.defaultOptions.title.style.color
                    ) || '#333333',
                    style: {
                        fontSize: '16px'
                    }
                },
                dial: {
                    radius: '80%',
                    backgroundColor: 'gray',
                    baseWidth: 12,
                    baseLength: '0%',
                    rearLength: '0%'
                },
                pivot: {
                    backgroundColor: 'gray',
                    radius: 6
                }

            }]

        });


    });
</script>
@endpush