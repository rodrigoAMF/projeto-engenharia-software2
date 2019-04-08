<?php

mysqli_report(MYSQLI_REPORT_STRICT);

function open_database() {
	try {
		$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		mysqli_set_charset($conn,"utf8");
		return $conn;
	} catch (Exception $e) {
		echo $e->getMessage();
		return null;
	}
}

function close_database($conn) {
	try {
		mysqli_close($conn);
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

function sortLista($produtos, $parametro){

	if($parametro == null) $parametro = 8;
	/*
	1- nome
	2- ident
	3- catmat
	4- categoria
	5- posicao
	6- estoque ideal
	7- quantidade
	8, default- crit
	*/
	if(abs($parametro) == 1){
		for($i=1;$i < sizeof($produtos);$i++) for($j=0;$j < sizeof($produtos) -$i;$j++){
			if($parametro > 0){
				if(strtoupper($produtos[$j]['nome']) > strtoupper($produtos[$j+1]['nome'])){
					$aux = $produtos[$j];
	                $produtos[$j] = $produtos[$j+1];
	                $produtos[$j+1] = $aux;
				}
			}else{
				if(strtoupper($produtos[$j]['nome']) < strtoupper($produtos[$j+1]['nome'])){
					$aux =  $produtos[$j];
	                $produtos[$j] = $produtos[$j+1];
	                $produtos[$j+1] = $aux;
				}
			}
		}
	}
	if(abs($parametro) == 2){
		for($i=1;$i < sizeof($produtos);$i++) for($j=0;$j < sizeof($produtos) -$i;$j++){
			if($parametro > 0){
				if(strtoupper($produtos[$j]['identificacao']) > strtoupper($produtos[$j+1]['identificacao'])){
					$aux =  $produtos[$j];
	                $produtos[$j] = $produtos[$j+1];
	                $produtos[$j+1] = $aux;
				}
			}else{
				if(strtoupper($produtos[$j]['identificacao']) < strtoupper($produtos[$j+1]['identificacao'])){
					$aux =  $produtos[$j];
	                $produtos[$j] = $produtos[$j+1];
	                $produtos[$j+1] = $aux;
				}
			}
		}
	}
	if(abs($parametro) == 3){
		$parametro /= 3;
		for($i=1;$i < sizeof($produtos);$i++) for($j=0;$j < sizeof($produtos) -$i;$j++){
			if($produtos[$j]['catmat']*$parametro > $produtos[$j+1]['catmat']*$parametro){
				$aux =  $produtos[$j];
                $produtos[$j] = $produtos[$j+1];
                $produtos[$j+1] = $aux;
			}
		}
	}
	if(abs($parametro) == 4){
		for($i=1;$i < sizeof($produtos);$i++) for($j=0;$j < sizeof($produtos) -$i;$j++){
			if($parametro > 0){
				if(strtoupper($produtos[$j]['categoria']) > strtoupper($produtos[$j+1]['categoria'])){
					$aux =  $produtos[$j];
	                $produtos[$j] = $produtos[$j+1];
	                $produtos[$j+1] = $aux;
				}
			}else{
				if(strtoupper($produtos[$j]['categoria']) < strtoupper($produtos[$j+1]['categoria'])){
					$aux =  $produtos[$j];
	                $produtos[$j] = $produtos[$j+1];
	                $produtos[$j+1] = $aux;
				}
			}
		}
	}
	if(abs($parametro) == 5){
		for($i=1;$i < sizeof($produtos);$i++) for($j=0;$j < sizeof($produtos) -$i;$j++){
			if($parametro > 0){
				if(strtoupper($produtos[$j]['posicao']) > strtoupper($produtos[$j+1]['posicao'])){
					$aux =  $produtos[$j];
	                $produtos[$j] = $produtos[$j+1];
	                $produtos[$j+1] = $aux;
				}
			}else{
				if(strtoupper($produtos[$j]['posicao']) < strtoupper($produtos[$j+1]['posicao'])){
					$aux =  $produtos[$j];
	                $produtos[$j] = $produtos[$j+1];
	                $produtos[$j+1] = $aux;
				}
			}
		}
	}
	if(abs($parametro) == 6){
		$parametro /= 6;
		for($i=1;$i < sizeof($produtos);$i++) for($j=0;$j < sizeof($produtos) -$i;$j++){
			if($produtos[$j]['estoque_ideal']*$parametro > $produtos[$j+1]['estoque_ideal']*$parametro){
				$aux =  $produtos[$j];
                $produtos[$j] = $produtos[$j+1];
                $produtos[$j+1] = $aux;
			}
		}
	}
	if(abs($parametro) == 7){
		$parametro /= 7;
		for($i=1;$i < sizeof($produtos);$i++) for($j=0;$j < sizeof($produtos) -$i;$j++){
			if($produtos[$j]['quantidade']*$parametro > $produtos[$j+1]['quantidade']*$parametro){
				$aux =  $produtos[$j];
                $produtos[$j] = $produtos[$j+1];
                $produtos[$j+1] = $aux;
			}
		}
	}
	if(abs($parametro) == 8){
		$parametro /= 8;
		for($i=1;$i < sizeof($produtos);$i++) for($j=0;$j < sizeof($produtos) -$i;$j++){
			if($produtos[$j]['porcentagem']*$parametro > $produtos[$j+1]['porcentagem']*$parametro){
				$aux =  $produtos[$j];
	            $produtos[$j] = $produtos[$j+1];
	            $produtos[$j+1] = $aux;
			}
		}
	}
	return $produtos;
}

// Retorna 1 produto do banco de dados a partir do seu ID
function getProdutoPorId($id){
    $conexao = open_database();

    $query = "SELECT p.nome, p.catmat, p.id, p.descricao,p.identificacao, p.posicao,p.estoque_ideal,p.quantidade, c.nome as categoria FROM produtos p, categoria c WHERE p.categoria = c.id AND p.id = " . $id;

    $resultado = $conexao->query($query);

    $dados = $resultado->fetch_all(MYSQLI_ASSOC);

    close_database($conexao);

    return $dados[0];
}

function cadastraProduto($nome, $identificacao, $catmat, $quantidade, $estoqueIdeal, $posicao, $categoria, $descricao){
	$conexao = open_database();

	$query = "INSERT INTO produtos(nome, descricao, identificacao, catmat, categoria, posicao, estoque_ideal, quantidade) values('"
	. $nome . "', '" . $descricao . "', '" . $identificacao . "', " . $catmat . ", " . $categoria . ", '" . $posicao . "', " . $estoqueIdeal . ",
			" . $quantidade . ")";

	echo $query;

	$resultado = $conexao->query($query);

    close_database($conexao);

	// query retorna false caso query falhe
	return true;

}

function cadastraCategoria($nome){
	$conexao = open_database();

	$query = "INSERT INTO categoria(nome) values('". $nome . "')";


	$resultado = $conexao->query($query);

    close_database($conexao);

	// query retorna false caso query falhe
	if(!resultado){
		return false;
	}else{
		return true;
	}

}


function getProdutos($busca, $filtro, $parametroOrdenacao){
	$conexao = open_database();

	if ($busca == null) {
		$query = "SELECT p.nome, p.catmat, p.id, p.descricao,p.identificacao, p.posicao,p.estoque_ideal,p.quantidade, c.nome as categoria FROM produtos p, categoria c WHERE p.categoria = c.id";
	}
	else
	{
		switch($filtro){
			case 1:
				$query = "SELECT p.nome, p.catmat, p.id, p.descricao,p.identificacao, p.posicao,p.estoque_ideal,p.quantidade, c.nome as categoria FROM produtos p, categoria c WHERE p.categoria = c.id AND p.nome LIKE '%" . $busca . "%'";
			break;
			case 2:
				$query = "SELECT p.nome, p.catmat, p.id, p.descricao,p.identificacao, p.posicao,p.estoque_ideal,p.quantidade, c.nome as categoria FROM produtos p, categoria c WHERE p.categoria = c.id AND p.identificacao LIKE '%" . $busca . "%'";
			break;
			case 3:
				$query = "SELECT p.nome, p.catmat, p.id, p.descricao,p.identificacao, p.posicao,p.estoque_ideal,p.quantidade, c.nome as categoria FROM produtos p, categoria c WHERE p.categoria = c.id AND p.catmat LIKE '%" . $busca . "%'";
			break;
			case 4:
				$query = "SELECT p.nome, p.catmat, p.id, p.descricao,p.identificacao, p.posicao,p.estoque_ideal,p.quantidade, c.nome as categoria FROM produtos p, categoria c WHERE p.categoria = c.id AND c.nome LIKE '%" . $busca . "%'";
			break;
			case 5:
				$query = "SELECT p.nome, p.catmat, p.id, p.descricao,p.identificacao, p.posicao,p.estoque_ideal,p.quantidade, c.nome as categoria FROM produtos p, categoria c WHERE p.categoria = c.id AND p.posicao LIKE '%" . $busca . "%'";
			break;
			case 6:
				$query = "SELECT p.nome, p.catmat, p.id, p.descricao,p.identificacao, p.posicao,p.estoque_ideal,p.quantidade, c.nome as categoria FROM produtos p, categoria c WHERE p.categoria = c.id AND p.estoque_ideal LIKE '%" . $busca . "%'";
			break;
			case 7:
				$query = "SELECT p.nome, p.catmat, p.id, p.descricao,p.identificacao, p.posicao,p.estoque_ideal,p.quantidade, c.nome as categoria FROM produtos p, categoria c WHERE p.categoria = c.id AND p.quantidade LIKE '%" . $busca . "%'";
			break;
		}
	}

    $resultado = $conexao->query($query);

    $dados = $resultado->fetch_all(MYSQLI_ASSOC);

    close_database($conexao);

	for ($i=0; $i < sizeof($dados); $i++) {
		$dados[$i]['porcentagem'] = floatval($dados[$i]['quantidade']/$dados[$i]['estoque_ideal']);
	}
	if($busca == null && $filtro == null){
		$dados = sortLista($dados, $parametroOrdenacao);
	}


	$produtos = "";

	foreach ($dados as $dados) {
		$rgb = pickColor($dados['porcentagem']);
		$produtos .= "<tr>";
		$produtos .= "<td style = 'background:rgb(" . $rgb[0] . ", " . $rgb[1] . ", ".$rgb[2].");'></td>";
		$produtos .= "<td>" . $dados['nome'] . "</td>";
		$produtos .= "<td>" . $dados['identificacao'] . "</td>";
		$produtos .= "<td>" . $dados['catmat'] . "</td>";
		$produtos .= "<td>" . $dados['categoria'] . "</td>";
		$produtos .= "<td>" . $dados['posicao'] . "</td>";
		$produtos .= "<td>" . $dados['estoque_ideal'] . "</td>";
		$produtos .= "<td>" . $dados['quantidade'] . "</td>";
		$produtos .= "<td><a class='delete-icon' href='excluir-produto.php?id=" . $dados['id'] . "'><i class='material-icons' id='delete-" . $dados['id'] . "'>delete_outline</i></a></td>";
		$produtos .= "<td><a href='editar-produto.php?id=" . $dados['id'] . "'>
		<i class='material-icons'>edit</i></a></td>";
		$produtos .= "</tr>";
	}

    return $produtos;
}

function getCategorias(){
	$conexao = open_database();

    $query = "SELECT * FROM categoria ORDER BY nome";

    $resultado = $conexao->query($query);

    $dados = $resultado->fetch_all(MYSQLI_ASSOC);

    close_database($conexao);

    return $dados;
}

function editarProduto($nome, $identificacao, $catmat, $quantidade, $estoqueIdeal, $posicao, $categoria, $descricao, $id){
	$conexao = open_database();

	$query = "UPDATE produtos SET nome = '" . $nome . "', identificacao  = '" . $identificacao . "', catmat= '" . $catmat . "', quantidade= '" . $quantidade . "',
				estoque_ideal= '" . $estoqueIdeal . "', posicao = '" . $posicao . "', categoria= '" . $categoria . "', descricao= '" . $descricao . "' WHERE
					id= " . $id . "";

	$resultado = $conexao->query($query);

    close_database($conexao);

	// query retorna false caso query falhe
	if(!$resultado){
		return false;
	}else{
		return true;
	}
}

function excluirProduto($id){
	$conexao = open_database();

    $query = "DELETE FROM produtos WHERE id = " . $id;

    $resultado = $conexao->query($query);

    close_database($conexao);

    return $resultado;
}

function getIDCategoriaPorNome($nome){
	$conexao = open_database();

    $query = "SELECT id FROM categoria WHERE nome = '" . $nome . "'";

    $resultado = $conexao->query($query);

    $dados = $resultado->fetch_all(MYSQLI_ASSOC);

    close_database($conexao);

    return $dados[0]['id'];
}
