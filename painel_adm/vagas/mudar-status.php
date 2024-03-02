<?php 

require_once("../../conexao.php");
require_once("campos.php");
$id = @$_POST['id'];
$ativo = @$_POST['ativar'];

$pdo->query("UPDATE $pagina SET situacao = '$ativo' where id = '$id'");
echo 'Alterado com Sucesso';

 ?>