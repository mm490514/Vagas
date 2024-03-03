<?php 

require_once("../conexao.php");
$pagina = 'vagas';

$postjson = json_decode(file_get_contents('php://input'), true);

$id = @$postjson['id'];
$cargo = @$postjson['cargo'];
$situacao = @$postjson['situacao'];
$nome_empresa = @$postjson['nome_empresa'];
$salario = @$postjson['salario'];
$descricao = @$postjson['descricao'];
$id_nivel_cargo = @$postjson['id_nivel_cargo'];
$area = @$postjson['area'];
$localidade = @$postjson['localidade'];
$id_tipo_contrato = @$postjson['id_tipo_contrato'];
$id_user_empresa = @$postjson['id_user_empresa'];

$data = date('Y-m-d');


//VALIDAR CAMPO
$query = $pdo->query("SELECT * from $pagina WHERE cargo = '$cargo' AND nome_empresa = '$nome_empresa' AND descricao = '$descricao' AND id_nivel_cargo = '$id_nivel_cargo' AND area = '$area' AND 
id_tipo_contrato = '$id_tipo_contrato' AND salario = '$salario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$id_reg = @$res[0]['id'];
if($total_reg > 0 and $id_reg != $id){
	
	$result = json_encode(array('mensagem'=>'CPF já Cadastrado!', 'sucesso'=>false));
	echo $result;
	exit();
}

if($id == "" || $id == "0"){
	$res = $pdo->prepare("INSERT INTO $pagina set cargo = :campo1, situacao = :campo2, nome_empresa = :campo3, salario = :campo4, descricao = :campo5, id_nivel_cargo = :campo6, area = :campo7,
	localidade = :campo8, id_tipo_contrato = :campo9, id_user_empresa = :campo10");	
}else{
	$res = $pdo->prepare("UPDATE $pagina  set cargo = :campo1, situacao = :campo2, nome_empresa = :campo3, salario = :campo4, descricao = :campo5, id_nivel_cargo = :campo6, area = :campo7,
	localidade = :campo8, id_tipo_contrato = :campo9, id_user_empresa = :campo10 WHERE id = '$id'");	
}

$res->bindValue(":campo1", "$cargo");
$res->bindValue(":campo2", "$situacao");
$res->bindValue(":campo3", "$nome_empresa");
$res->bindValue(":campo4", "$salario");
$res->bindValue(":campo5", "$descricao");
$res->bindValue(":campo6", "$id_nivel_cargo");
$res->bindValue(":campo7", "$area");
$res->bindValue(":campo8", "$localidade");
$res->bindValue(":campo9", "$id_tipo_contrato");
$res->bindValue(":campo10", "$id_user_empresa");


@$res->execute();

$result = json_encode(array('mensagem'=>'Salvo com sucesso!', 'sucesso'=>true));

echo $result;

?>