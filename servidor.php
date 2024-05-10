<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Situação</title>
    <style>
        * {
            box-sizing: border-box;
            font-size: 30px;
            font-family: Arial;
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>
    <?php
    include "./classes.php";

    $tipMov = htmlspecialchars($_POST["tipoMovimentacao"]);
    $nome = htmlspecialchars($_POST["nomeFunci"]);
    $produto = htmlspecialchars($_POST["listaProdutos"]);
    $qtd = htmlspecialchars($_POST["qtdProduto"]);
    $dataSaida = htmlspecialchars($_POST["dataMov"]);
    $aux = preg_replace("/\s/", "", $nome);
    if (count($_POST) != 0) {
        if (preg_match("/[^A-z]/", $aux)) {
            echo "<div>Digite um nome válido</div>";
        } else {
            $enviar = new ConectaBanco($tipMov, $nome, $produto, $qtd, $dataSaida);
            $enviar->inseriAoBanco();
            $enviar = null;
            $_POST = null;
            echo "<div>Dados enviados com sucesso</div>";
        }
    }
    ?>
    <a href="paginaFormulario.php">
        <button>Voltar ao formulário</button>
    </a>
    <a href="index.php">
        <button>Voltar á página inicial</button>
    </a>
</body>

</html>