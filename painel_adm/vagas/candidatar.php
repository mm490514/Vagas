<?php 

require_once("../../conexao.php");
require_once("campos.php");
$id_usuario = @$_POST['id_usuario'];
$id_vaga = @$_POST['id_vaga'];

$query2 = $pdo->query("SELECT * from candidatos where id_usuario = $id_usuario");		
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$id_candidato = @$res2[0]['id'];

$pdo->query("INSERT INTO candidaturas(id_candidato, id_vaga) VALUES ($id_candidato, $id_vaga)");
echo 'Candidatado com Sucesso';

 ?>