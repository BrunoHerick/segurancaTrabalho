<?php

$servidor = "localhost";
$usuario = "root";
$senha = "12345678";
$nomeBanco = "segurancaTrabalho";

try {
    $conexao = new PDO(
        "mysql:host=$servidor;dbname=$nomeBanco",
        $usuario,
        $senha
    );
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $preparaSelecao = $conexao->prepare("select produto, movimentacao, quantidade from tabelaMovimentacaoST;");
    $preparaSelecao->execute();

    $camP = $camM = $camG = $luvP = $luvM = $luvG = $bota = 0;

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