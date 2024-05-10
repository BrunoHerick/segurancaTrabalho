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
            $codigoSQL = "insert into tabelaMovimentacaoST (movimentacao, nome, produto, quantidade, dataSaida) values ('$this->movimentacao', '$this->nome', '$this->produto', $this->qtd, '$this->dataSaida');";
            $conexao->prepare($codigoSQL)->execute();
            $conexao = NULL;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
