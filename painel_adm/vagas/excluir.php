<?php 
require_once("../../conexao.php");
require_once("campos.php");
$id = @$_POST['id-excluir'];

//BUSCAR A IMAGEM PARA EXCLUIR DA PASTA
$query_con = $pdo->query("SELECT * FROM vagas WHERE id = '$id'");
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);

$pdo->query("DELETE from $pagina where id = '$id'");
echo 'Excluído com Sucesso';

 ?>