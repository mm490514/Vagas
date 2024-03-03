<?php 
@session_start();
require_once("../conexao.php");

$id_vaga = $_POST['id_vaga'];

$query = $pdo->prepare("SELECT cd.*, c.nome as nome from candidaturas cd 
INNER JOIN candidatos c ON (c.id = cd.id_candidato)
where id_vaga = :id_vaga");
$query->bindValue(":id_vaga", $id_vaga);

$query->execute();
$candidaturas = $query->fetchAll(PDO::FETCH_ASSOC);

$candidatos = array();

foreach ($candidaturas as $candidatura) {
    $candidatos[] = $candidatura['nome']; // Supondo que o nome do candidato está na coluna 'nome'
}

echo json_encode($candidatos);


 ?>