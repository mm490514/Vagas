<?php 
require_once("../../conexao.php");
require_once("campos.php");
@session_start();

$niv_usuario = $_SESSION['nivel_usuario'];
$id_usuario = $_SESSION['id_usuario'];

if ($niv_usuario != 'Administrador') {
	$ocultar_home = 'display: block;';
	$query = $pdo->query("SELECT * from $pagina where id_usuario = '$id_usuario' order by id desc ");
} else {
	$ocultar_home = 'display: none;';
	$query = $pdo->query("SELECT * from $pagina order by id desc ");
}





echo <<<HTML
<table id="example" class="table table-striped table-light table-hover my-4">
<thead>
<tr>
<th style="width: 300px;">{$campo1}</th>
<th style="width: 150px;">{$campo2}</th>
<th>Data Nascimento</th>	
<th>Escolaridade</th>	
<th>{$campo5}</th>
<th>Area de Interesse</th>
<th style="width: 800px;">{$campo7}</th>	
<th>Ações</th>
</tr>
</thead>
<tbody>
HTML;



$res = $query->fetchAll(PDO::FETCH_ASSOC);
for($i=0; $i < @count($res); $i++){
	foreach ($res[$i] as $key => $value){} 

		$id = $res[$i]['id'];
		$cp1 = $res[$i]['nome'];
		$cp2 = $res[$i]['cpf'];
		$cp3 = $res[$i]['data_nasc'];
		$cp4 = $res[$i]['id_grau_escolaridade'];
		$cp5 = $res[$i]['endereco'];
		$cp6 = $res[$i]['area_interesse'];
		$cp7 = $res[$i]['descricao'];

		$data_formatada = date("d/m/Y", strtotime($cp3));
		
		$query1 = $pdo->query("SELECT * from grau_escolaridade where id = $cp4");
		$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
		$nivel = @$res1[0]['descricao'];

echo <<<HTML
	<tr>
	<td>{$cp1}</td>			
	<td>{$cp2}</td>	
	<td>{$data_formatada}</td>	
	<td>{$nivel}</td>	
	<td>{$cp5}</td>	
	<td>{$cp6}</td>	
	<td>{$cp7}</td>		
	<td>
	<a href="#" onclick="editar('{$id}', '{$cp1}', '{$cp2}', '{$cp3}', '{$cp4}', '{$cp5}', '{$cp6}', '{$cp7}')" title="Editar Registro" style="$ocultar_home">	<i class="bi bi-pencil-square text-primary"></i> </a>
	<a href="#" onclick="excluir('{$id}' , '{$cp1}')" title="Excluir Registro" style="$ocultar_home">	<i class="bi bi-trash text-danger"></i> </a>
	

	</td>
	</tr>
HTML;
} 
echo <<<HTML
</tbody>
</table>
HTML;

?>

<script>
$(document).ready(function() {    
	$('#example').DataTable({
		"ordering": false
	});

} );


function editar(id, cp1, cp2, cp3, cp4, cp5, cp6, cp7){	
	$('#id').val(id);
	$('#<?=$campo1?>').val(cp1);
	$('#<?=$campo2?>').val(cp2);
	$('#<?=$campo3?>').val(cp3);
	$('#<?=$campo4?>').val(cp4);
	$('#<?=$campo5?>').val(cp5);
	$('#<?=$campo6?>').val(cp6);
	$('#<?=$campo6?>').val(cp6);
	$('#<?=$campo7?>').val(cp7);
	
	$('#tituloModal').text('Editar Registro');
	var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {		});
	myModal.show();
	$('#mensagem').text('');
}




function limparCampos(){
	$('#id').val('');
	$('#<?=$campo1?>').val('');	
	$('#<?=$campo3?>').val('');
	$('#<?=$campo4?>').val('');
	$('#<?=$campo5?>').val('');
	$('#<?=$campo6?>').val('');
	$('#<?=$campo7?>').val('');	
}




function mostrarDados(id, cp1, cp2, cp3, cp4, cp5, cp6, cp7, cp8, cp9, cp10, nivel){
	
	$('#campo1').text(cp1);
	$('#campo2').text(cp2);
	$('#campo3').text(cp3);
	$('#campo4').text(cp4);
	$('#campo5').text(cp5);
	$('#campo6').text(cp6);	
	$('#campo7').text(cp7);	
	$('#campo8').text(cp8);
	$('#imagem_dados').attr('src','../img/'+pag+'/'+cp9);
	$('#campo10').text(cp10);
	$('#nivel_dados').text(nivel);
	
	
	
	var myModal = new bootstrap.Modal(document.getElementById('modalDados'), {		});
	myModal.show();
	
}
</script>










