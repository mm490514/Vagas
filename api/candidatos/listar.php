<?php 

include_once('../conexao.php');

$postjson = json_decode(file_get_contents('php://input'), true);

$limite = (isset($_GET['limite'])) ? $_GET['limite'] : 5; 
$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1; 

$inicio = ($limite * $pagina) - $limite; 

$query = $pdo->prepare("SELECT * FROM candidatos ORDER BY id desc LIMIT $inicio, $limite");

$query->execute();

$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i=0; $i < count($res); $i++) { 
    $dados[] = array(
        'id' => $res[$i]['id'],
        'nome' => $res[$i]['nome'],
        'cpf' => $res[$i]['cpf'],
        'data_nasc' => $res[$i]['data_nasc'],
        'id_grau_escolaridade' => $res[$i]['id_grau_escolaridade'],
        'endereco' => $res[$i]['endereco'],
        'area_interesse' => $res[$i]['area_interesse'],
        'descricao' => $res[$i]['descricao'],
        'id_usuario' => $res[$i]['id_usuario'],        
    );
}



if(count($res) > 0){
    $result = json_encode(array('success'=>true, 'resultado'=>@$dados, 'totalItems'=>@count($dados) + ($inicio)));
}else{
    $result = json_encode(array('success'=>false, 'resultado'=>'0'));
}

echo $result;

?>