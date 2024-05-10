<?php

$servidor = "seguratrabalho.mysql.uhserver.com";
$usuario = "brunoherick";
$senha = "271267Olimpo@";
$nomeBanco = "seguratrabalho";

try {
    $conexao = new PDO(
        "mysql:host=$servidor;dbname=$nomeBanco",
        $usuario,
        $senha
    );
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $preparaSelecao = $conexao->prepare("select * from tabelaMovimentacaoST;");
    $preparaSelecao->execute();

    $resultado = $preparaSelecao->setFetchMode(PDO::FETCH_ASSOC);
    $tabelaParaTexto = "ID;TIPO_MOVIMENTACAO;NOME;PRODUTO;QUANTIDADE;DATA_SAIDA;\n";
    foreach ($preparaSelecao->fetchAll() as $elemento) {
        $dia = explode("-", $elemento["dataSaida"]);
        $dia = "$dia[2]/$dia[1]/$dia[0]";
        $tabelaParaTexto = $tabelaParaTexto . $elemento["id"] . ";" . $elemento["movimentacao"] . ";" . $elemento["nome"] . ";" . $elemento["produto"] . ";" . $elemento["quantidade"] . ";" . $dia . ";\n";
    }
    $criarArquivo = fopen("relatorioDados.csv", "w") or die("deu merda para abrir o arquivo");
    fwrite($criarArquivo, $tabelaParaTexto);
    fclose($criarArquivo);
    if (file_exists("./relatorioDados.csv")) {
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=relatorioDados.csv");
        readfile("./relatorioDados.csv");
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

$conexao = NULL;
