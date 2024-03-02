<?php 
@session_start();
require_once("conexao.php");

$login = $_POST['email'];
$senha = $_POST['senha'];
$nivel = $_POST['nivel'];

if ($nivel == "2"){
$nivel = "Administrador";
} else {
$nivel = "Comum";
}

$query = $pdo->prepare("SELECT * from usuarios where login = :login");
$query->bindValue(":login", "$login");
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0){
	echo "<script>window.alert('Email já cadastrado!')</script>";
	echo "<script>window.location='criar_perfil.php'</script>";
}else{
	$query = $pdo->prepare("INSERT INTO usuarios set login = :campo1, senha = :campo2, nivel = :campo3");	

	$query->bindValue(":campo1", "$login");
	$query->bindValue(":campo2", "$senha");
	$query->bindValue(":campo3", "$nivel");

	$query->execute();

	echo 'Salvo com Sucesso';
	echo "<script>window.location='index.php'</script>";
}

 ?>