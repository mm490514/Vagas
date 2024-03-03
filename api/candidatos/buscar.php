<?php 

include_once('../conexao.php');

$postjson = json_decode(file_get_contents('php://input'), true);

$buscar = '%' .@$_GET['buscar']. '%';

$query = $pdo->prepare("SELECT * from candidatos where nome LIKE '$buscar' or cpf LIKE '$buscar' order by id ASC");

$query->execute();

$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i=0; $i < count($res); $i++) { 
    foreach ($res[$i] as $key => $value) {  }    

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
    $result = json_encode(array('success'=>true, 'itens'=>$dados));
}else{
    $result = json_encode(array('success'=>false, 'resultado'=>'0'));
}

echo $result;

?>