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
                            <div id="ventas" style="height: 400px;"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="categoriaChart" style="height: 400px;"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="ventas_2" style="height: 400px;"></div>
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
    // Función de animación personalizada
    (function(H) {
        H.seriesTypes.pie.prototype.animate = function(init) {
            const series = this,
                chart = series.chart,
                points = series.points,
                {
                    animation
                } = series.options,
                {
                    startAngleRad
                } = series;

            function fanAnimate(point, startAngleRad) {
                const graphic = point.graphic,
                    args = point.shapeArgs;

                if (graphic && args) {

                    graphic
                        .attr({
                            start: startAngleRad,
                            end: startAngleRad,
                            opacity: 1
                        })
                        .animate({
                            start: args.start,
                            end: args.end
                        }, {
                            duration: animation.duration / points.length
                        }, function() {
                            if (points[point.index + 1]) {
                                fanAnimate(points[point.index + 1], args.end);
                            }
                            if (point.index === series.points.length - 1) {
                                series.dataLabelsGroup.animate({
                                        opacity: 1
                                    },
                                    void 0,
                                    function() {
                                        points.forEach(point => {
                                            point.opacity = 1;
                                        });
                                        series.update({
                                            enableMouseTracking: true
                                        }, false);
                                        chart.update({
                                            plotOptions: {
                                                pie: {
                                                    innerSize: '40%',
                                                    borderRadius: 8
                                                }
                                            }
                                        });
                                    });
                            }
                        });
                }
            }

            if (init) {
                points.forEach(point => {
                    point.opacity = 0;
                });
            } else {
                fanAnimate(points[0], startAngleRad);
            }
        };
    }(Highcharts));

    Highcharts.setOptions({
        colors: ['#3c90df', '#3682c4', '#3174a9', '#2c668e', '#275973']
    });

    // Datos de ventas
    var salesData = @json($data);

    var categories = salesData.map(item => item.sale_date);
    var salesAmounts = salesData.map(item => parseFloat(item.total_sales));
    var totalQuantities = salesData.map(item => parseInt(item.total_quantity));

    var today = new Date();
    today.setHours(0, 0, 0, 0);
    var last7Days = salesData.filter(item => {
        var saleDate = new Date(item.sale_date);
        return saleDate >= new Date(today.getTime() - 6 * 24 * 60 * 60 * 1000);
    });

    categories = last7Days.map(item => item.sale_date);
    salesAmounts = last7Days.map(item => parseFloat(item.total_sales));
    totalQuantities = last7Days.map(item => parseInt(item.total_quantity));

    Highcharts.chart('ventas', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Historico De Compras'
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

    var topCategories = @json($topCategories);

    var pieData = Object.keys(topCategories).map(function(key) {
        return {
            name: key,
            y: topCategories[key]
        };
    });

    Highcharts.chart('categoriaChart', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Distribución De Ventas Por Categoría'
        },
        series: [{
            name: 'Ventas',
            enableMouseTracking: false, // Deshabilitar seguimiento del mouse al cargar
            animation: {
                duration: 2000
            },
            colorByPoint: true,
            data: pieData
        }],
        plotOptions: {
            pie: {
                allowPointSelect: true,
                borderWidth: 2,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>',
                    distance: 20
                }
            }
        }
    });

    Highcharts.chart('ventas_2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Historico de Productos Vendidos'
        },
        xAxis: {
            categories: categories,
            title: {
                text: 'Fecha de ventas'
            }
        },
        yAxis: {
            title: {
                text: 'Cantidad vendida'
            }
        },
        series: [{
            name: 'Cantidad vendida',
            data: totalQuantities,
            colorByPoint: false,
            tooltip: {
                valueSuffix: ' unidades'
            }
        }]
    });

    var topProducts = @json($topProducts);
    var productNames = Object.keys(topProducts);
    var productQuantities = Object.values(topProducts);

    Highcharts.chart('pieChart', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Top 10 Productos Más Vendidos'
        },
        series: [{
            name: 'Ventas',
            enableMouseTracking: false, // Deshabilitar seguimiento del mouse al cargar
            animation: {
                duration: 2000
            },
            colorByPoint: true,
            data: productNames.map((name, index) => {
                return {
                    name: name,
                    y: productQuantities[index]
                };
            })
        }],
        plotOptions: {
            pie: {
                allowPointSelect: true,
                borderWidth: 2,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y}',
                    distance: 20
                }
            }
        }
    });
</script>
@endsection