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

<script type="text/javascript">
    // Convertimos las variables PHP a variables JavaScript
    var salesData = @json($data);

    // Preparar datos para el gráfico
    var categories = salesData.map(item => item.sale_date);
    var salesAmounts = salesData.map(item => parseFloat(item.total_sales));

    // Convertir fechas a objetos Date y filtrar últimos 7 días
    var today = new Date();
    today.setHours(0, 0, 0, 0); // Ajustar a la medianoche
    var last7Days = salesData.filter(item => {
        var saleDate = new Date(item.sale_date);
        return saleDate >= new Date(today.getTime() - 6 * 24 * 60 * 60 * 1000); // últimos 7 días
    });

    // Actualizar categorías y montos con los últimos 7 días
    categories = last7Days.map(item => item.sale_date);
    salesAmounts = last7Days.map(item => parseFloat(item.total_sales));

    Highcharts.chart('container', {
        chart: {
            type: 'line' 
        },
        title: {
            text: 'Historia de compras'
        },
        xAxis: {
            categories: categories,
            title: {
                text: 'Fecha de ventas'
            }
        },
        yAxis: {
            title: {
                text: 'Monto adquirido'
            }
        },
        series: [{
            name: 'Monto obtenido',
            data: salesAmounts,
            colorByPoint: false,
            tooltip: {
                valuePrefix: '$'
            }
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
