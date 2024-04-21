<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAST</title>
    <?php
    echo '<link rel="stylesheet" href="estilos.css">';
    ?>
    <?php
    echo '<script src="highcharts.js"></script>';
    ?>
</head>

<body>
    <?php include "apibanco.php" ?>
    <div id="titulo">Sistema de Almoxarifado de Segurança do Trabalho</div>
    <ul>
        <li>Dados de Estoque</li>
        <a href="paginaFormulario.php">Registrar movimentação</a>
    </ul>
    <div id="paginaTabela">
        <div id="graficos">
            <div id="grafico"></div>
            <div id="grafico2"></div>
        </div>
        <div class="botoesTabela">
            <form method="get" action="./baixarArquivo.php">
                <input type="submit" value="Baixar relatório em CSV">
            </form>
        </div>
    </div>
    <?php include "paraGraficos.php"; ?>
</body>

</html>