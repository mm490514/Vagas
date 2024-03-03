<?php 

require_once("../../conexao.php");
require_once("campos.php");
$id_usuario = @$_POST['id_usuario'];
$id_vaga = @$_POST['id_vaga'];

$query2 = $pdo->query("SELECT * from candidatos where id_usuario = $id_usuario");		
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$id_candidato = @$res2[0]['id'];

$pdo->query("DELETE FROM candidaturas where id_candidato = $id_candidato AND id_vaga = $id_vaga");
echo 'Cancelado com Sucesso';

 ?>