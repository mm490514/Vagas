<?php 

require_once("../conexao.php");
$pagina = 'candidatos';

$postjson = json_decode(file_get_contents('php://input'), true);

$id = @$postjson['id'];
$nome = @$postjson['nome'];
$cpf = @$postjson['cpf'];
$data_nasc = @$postjson['data_nasc'];
$id_grau_escolaridade = @$postjson['id_grau_escolaridade'];
$endereco = @$postjson['endereco'];
$area_interesse = @$postjson['area_interesse'];
$descricao = @$postjson['descricao'];
$id_usuario = @$postjson['id_usuario'];

$data = date('Y-m-d');


//VALIDAR CAMPO
$query = $pdo->query("SELECT * from $pagina where cpf = '$cpf'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$id_reg = @$res[0]['id'];
if($total_reg > 0 and $id_reg != $id){
	echo 'Este registro já está cadastrado!!';
	exit();
}


if($id == "" || $id == "0"){
	$res = $pdo->prepare("INSERT INTO $pagina set nome = :campo1, cpf = :campo2, data_nasc = :campo3, id_grau_escolaridade = :campo4, endereco = :campo5, area_interesse = :campo6,
	 descricao = :campo7, id_usuario = :campo8");	
}else{
	$res = $pdo->prepare("UPDATE $pagina  set nome = :campo1, cpf = :campo2, data_nasc = :campo3, id_grau_escolaridade = :campo4, endereco = :campo5, area_interesse = :campo6,
	descricao = :campo7, id_usuario = :campo8 WHERE id = '$id'");	
}

$res->bindValue(":campo1", "$nome");
$res->bindValue(":campo2", "$cpf");
$res->bindValue(":campo3", "$data_nasc");
$res->bindValue(":campo4", "$id_grau_escolaridade");
$res->bindValue(":campo5", "$endereco");
$res->bindValue(":campo6", "$area_interesse");
$res->bindValue(":campo7", "$descricao");
$res->bindValue(":campo8", "$id_usuario");


@$res->execute();

$result = json_encode(array('mensagem'=>'Salvo com sucesso!', 'sucesso'=>true));

echo $result;

?>