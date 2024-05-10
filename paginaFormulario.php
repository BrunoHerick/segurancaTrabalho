<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAST</title>
    <?php
    echo '<link rel="stylesheet" href="estilos.css">';
    ?>
</head>

<body>
    <div id="titulo">Sistema de Almoxarifado de Segurança do Trabalho</div>
    <ul>
        <a href="index.php">Dados de Estoque</a>
        <li>Registrar movimentação</li>
    </ul>
    <form action="./servidor.php" id="formulario" method="post">
        <div class="campos">
            <label for="tipoMovimentacao">Tipo de movimentação:</label>
            <select name="tipoMovimentacao" id="tipoMovimentacao" onchange="verificaMov()">
                <option value="entrada">Entrada</option>
                <option value="saida">Saída</option>
            </select>
        </div>
        <div class="campos">
            <label for="nomeFunci">Nome do funcionário:</label>
            <input type="text" name="nomeFunci" id="nomeFunci" disabled>
        </div>
        <div class="campos">
            <label for="listaProduto">Produto:</label>
            <select name="listaProdutos" id="listaProdutos">
                <option name="camisaPequena" value="camisaPequena">Camisa Pequena</option>
                <option name="camisaMedia" value="camisaMedia">Camisa Média</option>
                <option name="camisaGrande" value="camisaGrande">Camisa Grande</option>
                <option name="luvaPequena" value="luvaPequena">Luva Pequena</option>
                <option name="luvaMedia" value="luvaMedia">Luva Média</option>
                <option name="luvaGrande" value="luvaGrande">Luva Grande</option>
                <option name="bota" value="bota">Bota</option>
            </select>
        </div>
        <div class="campos">
            <label for="qtdProduto">Quantidade:</label>
            <input type="number" name="qtdProduto" id="qtdProduto" min="1" max="2000" value="1" required>
        </div>
        <div class="campos">
            <label for="dataMov">Data de movimentação:</label>
            <input type="date" name="dataMov" id="dataMov" required>
        </div>
        <div class="botoesForm">
            <input type="submit" id="submeter" name="submeter" value="Enviar">
            <input type="reset" value="Limpar">
        </div>
    </form>
    <?php echo '<script src="escripites.js"></script>'; ?>
</body>

</html>