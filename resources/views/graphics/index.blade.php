@extends('layouts.backend')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Información Gráfica</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="container" style="height: 400px;"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="pieChart" style="height: 400px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
    Highcharts.chart('container', {
        title: {
            text: 'Ventas diarias'
        },
        xAxis: {
            categories: [
                @foreach($data as $item)
                '{{ $item->date }}',
                @endforeach
            ]
        },
        yAxis: {
            title: {
                text: 'Dinero en CLP.'
            }
        },
        series: [{
            name: 'Ventas diario',
            data: [
                @foreach($data as $item) {
                    {
                        $item - > total_sales
                    }
                },
                @endforeach
            ]
        }]
    });

    Highcharts.chart('pieChart', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Distribución de ventas por categoría'
        },
        series: [{
            name: 'Ventas',
            colorByPoint: true,
            data: [{
                    name: 'Categoría 1',
                    y: 30
                },
                {
                    name: 'Categoría 2',
                    y: 20
                },
                {
                    name: 'Categoría 3',
                    y: 50
                }
            ]
        }]
    });
</script>

@endsection