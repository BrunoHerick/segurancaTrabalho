<?php

class ConectaBanco
{
    public $movimentacao;
    public $nome;
    public $produto;
    public $qtd;
    public $dataSaida;
    function __construct($tipoMov, $nome, $produto, $quantidade, $dataSaida)
    {
        $this->movimentacao = $tipoMov;
        $this->nome = $nome;
        $this->produto = $produto;
        $this->qtd = $quantidade;
        $this->dataSaida = $dataSaida;
    }

    function inseriAoBanco()
    {
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
            $codigoSQL = "insert into tabelaMovimentacaoST (movimentacao, nome, produto, quantidade, dataSaida) values ('$this->movimentacao', '$this->nome', '$this->produto', $this->qtd, '$this->dataSaida');";
            $conexao->prepare($codigoSQL)->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $conexao = NULL;
    }
}

$tipMov = htmlspecialchars($_POST["tipoMovimentacao"]);
$nome = htmlspecialchars($_POST["nomeFunci"]);
$produto = htmlspecialchars($_POST["listaProdutos"]);
$qtd = htmlspecialchars($_POST["qtdProduto"]);
$dataSaida = htmlspecialchars($_POST["dataMov"]);
$aux = preg_replace("/\s/", "", $nome);
if (count($_POST) != 0) {
    if (preg_match("/[^A-z]/", $aux)) {
        echo "<script>alert('Digite um nome válido')</script>";
    } else {
        $enviar = new ConectaBanco($tipMov, $nome, $produto, $qtd, $dataSaida);
        $enviar->inseriAoBanco();
        $enviar = null;
        $_POST = null;
        echo "<script>alert('Dados enviados com sucesso')</script>";
    }
}