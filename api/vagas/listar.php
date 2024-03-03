<?php 

include_once('../conexao.php');

$postjson = json_decode(file_get_contents('php://input'), true);

$limite = (isset($_GET['limite'])) ? $_GET['limite'] : 5; 
$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1; 

$inicio = ($limite * $pagina) - $limite; 

$query = $pdo->prepare("SELECT * FROM vagas ORDER BY id desc LIMIT $inicio, $limite");

$query->execute();

$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i=0; $i < count($res); $i++) { 
    $dados[] = array(
        'id' => $res[$i]['id'],
        'cargo' => $res[$i]['cargo'],
        'nome_empresa' => $res[$i]['nome_empresa'],
        'descricao' => $res[$i]['descricao'],
        'id_nivel_cargo' => $res[$i]['id_nivel_cargo'],
        'situacao' => $res[$i]['situacao'],
        'localidade' => $res[$i]['localidade'],
        'area' => $res[$i]['area'],
        'id_tipo_contrato' => $res[$i]['id_tipo_contrato'],
        'salario' => $res[$i]['salario'],
        'id_user_empresa' => $res[$i]['id_user_empresa'],
    );
}



if(count($res) > 0){
    $result = json_encode(array('success'=>true, 'resultado'=>@$dados, 'totalItems'=>@count($dados) + ($inicio)));
}else{
    $result = json_encode(array('success'=>false, 'resultado'=>'0'));
}

echo $result;

?>