<?php 
require_once("../../conexao.php");
require_once("campos.php");
@session_start();

$cp1 = $_POST[$campo1];
$cp3 = $_POST[$campo3];
$cp4 = $_POST[$campo4];
$cp5 = $_POST[$campo5];
$cp6 = $_POST[$campo6];
$cp7 = $_POST[$campo7];
$cp8 = $_POST[$campo8];
$cp9 = $_POST[$campo9];
$cp10 = $_SESSION['id_usuario'];

$cp4 = str_replace(".", "", $cp4);
$cp4 = str_replace(",", ".", $cp4);
$cp4 = str_replace("R$", "", $cp4);

$id = @$_POST['id'];

//VALIDAR CAMPO
$query = $pdo->query("SELECT * from $pagina where cargo = '$cp1' AND nome_empresa = '$cp3' AND descricao = '$cp5' AND id_nivel_cargo = '$cp6' AND area = '$cp7' AND 
id_tipo_contrato = '$cp9' AND salario = '$cp4'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$id_reg = @$res[0]['id'];
if($total_reg > 0 and $id_reg != $id){
	echo 'Este registro já está cadastrado!!';
	exit();
}

if($id == ""){
	$query = $pdo->prepare("INSERT INTO $pagina set cargo = :campo1, situacao = :campo2, nome_empresa = :campo3, salario = :campo4, descricao = :campo5, id_nivel_cargo = :campo6, area = :campo7,
	localidade = :campo8, id_tipo_contrato = :campo9, id_user_empresa = :campo10");	
}else{
	$query = $pdo->prepare("UPDATE $pagina  set cargo = :campo1, situacao = :campo2, nome_empresa = :campo3, salario = :campo4, descricao = :campo5, id_nivel_cargo = :campo6, area = :campo7,
	localidade = :campo8, id_tipo_contrato = :campo9, id_user_empresa = :campo10 WHERE id = '$id'");	
}

$query->bindValue(":campo1", "$cp1");
$query->bindValue(":campo2", "1");
$query->bindValue(":campo3", "$cp3");
$query->bindValue(":campo4", "$cp4");
$query->bindValue(":campo5", "$cp5");
$query->bindValue(":campo6", "$cp6");
$query->bindValue(":campo7", "$cp7");
$query->bindValue(":campo8", "$cp8");
$query->bindValue(":campo9", "$cp9");
$query->bindValue(":campo10", "$cp10");

$query->execute();

echo 'Salvo com Sucesso';

?>