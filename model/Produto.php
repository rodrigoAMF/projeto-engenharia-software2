<?php

class Produto{
    private $nome, $identificacao, $posicao, $descricao; // string
    private $catmat, $quantidade, $estoqueIdeal; // int
    private $categoria; // Categoria

    public function __construct() {
        $this->categoria = new Categoria();
    }

    public function getCategoria(): Categoria{
        return $this->categoria;
    }

    public function getNome(): string{
        return $this->nome;
    }

    public function getIdentificacao(): string{
        return $this->identificacao;
    }

    public function getPosicao(): string{
        return $this->posicao;
    }

    public function getDescricao(): string{
        return $this->descricao;
    }

    public function getCatmat(): int{
        return $this->catmat;
    }

    public function getQuantidade(): int{
        return $this->quantidade;
    }

    public function getEstoqueIdeal(): int{
        return $this->estoqueIdeal;
    }

    public function setNome(string $nome){
        $this->nome = $nome;
    }

    public function setIdentificacao(string $identificacao){
        $this->identificacao = $identificacao;
    }

    public function setPosicao(string $posicao){
         $this->posicao = $posicao;
    }

    public function setDescricao(string $descricao){
        $this->descricao = $descricao;
    }

    public function setCatmat(int $catmat){
        $this->catmat = $catmat;
    }

    public function setQuantidade(int $quantidade){
        $this->quantidade = $quantidade;
    }

    public function setEstoqueIdeal(int $estoqueIdeal){
        $this->estoqueIdeal = $estoqueIdeal;
    }
}
