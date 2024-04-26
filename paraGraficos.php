<?php

$servidor = "seguratrabalho.mysql.uhserver.com";
$usuario = "brunoherick";
$senha = "271267Olimpo@";
$nomeBanco = "seguratrabalho";
$camP = $camM = $camG = $luvP = $luvM = $luvG = $bota = 0;
try {
    $conexao = new PDO(
        "mysql:host=$servidor;dbname=$nomeBanco",
        $usuario,
        $senha
    );
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $preparaSelecao = $conexao->prepare("select produto, movimentacao, quantidade from tabelaMovimentacaoST;");
    $preparaSelecao->execute();

    $resultado = $preparaSelecao->setFetchMode(PDO::FETCH_ASSOC);
    foreach ($preparaSelecao->fetchAll() as $elemento) {
        $p = $elemento["produto"];
        $m = $elemento["movimentacao"];
        $q = $elemento["quantidade"];

        if ($p == "camisaPequena" && $m == "entrada") $camP+=$q;
        if ($p == "camisaPequena" && $m == "saida") $camP-=$q;

        if ($p == "camisaMedia" && $m == "entrada") $camM+=$q;
        if ($p == "camisaMedia" && $m == "saida") $camM-=$q;

        if ($p == "camisaGrande" && $m == "entrada") $camG+=$q;
        if ($p == "camisaGrande" && $m == "saida") $camG-=$q;

        if ($p == "luvaPequena" && $m == "entrada") $luvP+=$q;
        if ($p == "luvaPequena" && $m == "saida") $luvP-=$q;

        if ($p == "luvaMedia" && $m == "entrada") $luvM+=$q;
        if ($p == "luvaMedia" && $m == "saida") $luvM-=$q;

        if ($p == "luvaGrande" && $m == "entrada") $luvG+=$q;
        if ($p == "luvaGrande" && $m == "saida") $luvG-=$q;

        if ($p == "bota" && $m == "entrada") $bota+=$q;
        if ($p == "bota" && $m == "saida") $bota-=$q;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
$conexao = NULL;

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
if ($total == 0) $total = 1;
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
