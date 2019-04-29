<?php
// $erros[0]['nome_do_campo'] = 'nome';
// $erros[0]['mensagem'] = 'Nome muito grande';
// $erros[5]['nome_do_campo'] = 'quantidade';
// $erros[5]['mensagem'] = 'Quantidade nao pode ser negativa';

// $arr = array('status' => 'Ok', 'erros' => $erros);

// echo json_encode($arr);

    require_once("model/Produto.php");
    require_once("controller/ProdutoController.php");

    $produto = new Produto();

    $erro = false;

    $produto->setNome('nomeTESTE');
    $produto->setIdentificacao(15);
    $produto->setCatmat(58);
    $produto->setQuantidade(86);
    $produto->setEstoqueIdeal(86);
    $retorno = $produto->setPosicao(999999999999999);
    if($retorno != 1) 
        $erro = true;
    $produto->getCategoria()->setNome('Resistor');
    $produto->setDescricao('oi');

    $produtoController = ProdutoController::getInstance();

    if(!$erro){
        $resultadoQuery = $produtoController->cadastraProduto($produto,"1S2019");
    }else{
        $resultadoQuery = "Ocorreu um erro";
    }

    echo $resultadoQuery;
?>