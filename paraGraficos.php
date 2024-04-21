<?php

echo '<script>
        const opcoesBarras = {
            chart: {
                type: "bar"
            },
            title: {
                text: "Estoque atual",
                align: "left"
            },
            subtitle: {
                text: "por produto",
                align: "left"
            },
            xAxis: {
                categories: ["Camisa P", "Camisa M", "Camisa G", "Luva P", "Luva M", "Luva G", "Bota"],
                title: {
                    text: null
                },
                gridLineWidth: 2,
                lineWidth: 0
            },
            yAxis: {
                min: 0,
                max: ' . (max($camP, $camM, $camG, $luvP, $luvM, $luvG, $bota) + 10) . ',
                title: {
                    text: null,
                    align: "middle"
                },
                labels: {
                    overflow: "justify"
                },
                gridLineWidth: 0
            },
            tooltip: {
                valueSuffix: " dólares"
            },
            plotOptions: {
                bar: {
                    borderRadius: "50%",
                    dataLabels: {
                        enabled: true
                    },
                    groupPadding: 0.1
                }
            },
            legend: {
                layout: "vertical",
                align: "right",
                verticalAlign: "top",
                x: -40,
                y: 20,
                floating: true,
                borderWidth: 1,
                backgroundColor: "#ffffff",
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: "Quantidade",
                data: [' . $camP . "," . $camM . "," . $camG . "," . $luvP . "," . $luvM . "," . $luvG . "," . $bota . ']
            }]
        }
        Highcharts.chart("grafico", opcoesBarras);
    </script>';

$total = $camP + $camM + $camG + $luvP + $luvM + $luvG + $bota;
$camPp = ($camP / $total) * 100;
$camMp = ($camM / $total) * 100;
$camGp = ($camG / $total) * 100;
$luvPp = ($luvP / $total) * 100;
$luvMp = ($luvM / $total) * 100;
$luvGp = ($luvG / $total) * 100;
$botap = ($bota / $total) * 100;
echo '<script>
    const opcoesPizza = {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: null,
                type: "pie"
            },
            title: {
                text: "Produtos em estoque (%)",
                align: "left"
            },
            tooltip: {
                pointFormat: "<b>{point.percentage:.1f}%</b>"
            },
            accessibility: {
                point: {
                    valueSuffix: "%"
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: "pointer",
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: "Produto",
                colorByPoint: true,
                data: [{
                    name: "Cam P",
                    y: ' . $camPp . '
                }, {
                    name: "Cam M",
                    y: ' . $camMp . '
                }, {
                    name: "Cam G",
                    y: ' . $camGp . '
                }, {
                    name: "Luva P",
                    y: ' . $luvPp . '
                }, {
                    name: "Luva M",
                    y: ' . $luvMp . '
                }, {
                    name: "Luva G",
                    y: ' . $luvGp . '
                }, {
                    name: "Bota",
                    y: ' . $botap . '
                }]
            }]
        }
        Highcharts.chart("grafico2", opcoesPizza);</script>';
