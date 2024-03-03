<?php 

require_once("../conexao.php");

$idsSelecionados = $_POST['ids'];

// Preparar uma lista de marcadores de posição para a consulta SQL
$placeholders = rtrim(str_repeat('?,', count($idsSelecionados)), ',');

// Preparar a consulta SQL com os marcadores de posição
$sql = "DELETE FROM vagas WHERE id IN ($placeholders)";

// Preparar a declaração
$stmt = $pdo->prepare($sql);

// Executar a declaração com os IDs
$stmt->execute($idsSelecionados);




 ?>