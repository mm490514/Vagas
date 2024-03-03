<?php 
require_once("../../conexao.php");
require_once("campos.php");
@session_start();

$cp1 = $_POST[$campo1];
$cp2 = $_POST[$campo2];
$cp3 = $_POST[$campo3];
$cp4 = $_POST[$campo4];
$cp5 = $_POST[$campo5];
$cp6 = $_POST[$campo6];
$cp7 = $_POST[$campo7];
$cp8 = $_SESSION['id_usuario'];

$data_formatada = date("Y-m-d", strtotime(str_replace('/', '-', $cp3)));

$id = @$_POST['id'];

//VALIDAR CAMPO
$query = $pdo->query("SELECT * from $pagina where cpf = '$cp2'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$id_reg = @$res[0]['id'];
if($total_reg > 0 and $id_reg != $id){
	echo 'Este registro já está cadastrado!!';
	exit();
}

if($id == ""){
	$query = $pdo->prepare("INSERT INTO $pagina set nome = :campo1, cpf = :campo2, data_nasc = :campo3, id_grau_escolaridade = :campo4, endereco = :campo5, area_interesse = :campo6,
	 descricao = :campo7, id_usuario = :campo8");	
}else{
	$query = $pdo->prepare("UPDATE $pagina  set nome = :campo1, cpf = :campo2, data_nasc = :campo3, id_grau_escolaridade = :campo4, endereco = :campo5, area_interesse = :campo6,
	descricao = :campo7, id_usuario = :campo8 WHERE id = '$id'");	
}

$query->bindValue(":campo1", "$cp1");
$query->bindValue(":campo2", "$cp2");
$query->bindValue(":campo3", "$data_formatada");
$query->bindValue(":campo4", "$cp4");
$query->bindValue(":campo5", "$cp5");
$query->bindValue(":campo6", "$cp6");
$query->bindValue(":campo7", "$cp7");
$query->bindValue(":campo8", "$cp8");

$query->execute();

echo 'Salvo com Sucesso';
echo "<script>window.location='index.php'</script>";

?>