<?php 
require_once("../../conexao.php");
require_once("campos.php");
@session_start();


$query = $pdo->query("SELECT * from $pagina order by id desc ");


echo <<<HTML
<table id="example" class="table table-striped table-light table-hover my-4">
<thead>
<tr>
<th>{$campo1}</th>
<th>Empresa</th>
<th >{$campo4}</th>	
<th style="width: 800px;">{$campo5}</th>	
<th>{$campo6}</th>
<th>{$campo7}</th>
<th>{$campo8}</th>	
<th>Tipo</th>	
<th>Ações</th>
</tr>
</thead>
<tbody>
HTML;



$res = $query->fetchAll(PDO::FETCH_ASSOC);
for($i=0; $i < @count($res); $i++){
	foreach ($res[$i] as $key => $value){} 

		$id = $res[$i]['id'];
		$cp1 = $res[$i]['cargo'];
		$cp2 = $res[$i]['situacao'];
		$cp3 = $res[$i]['nome_empresa'];
		$cp4 = $res[$i]['salario'];
		$cp5 = $res[$i]['descricao'];
		$cp6 = $res[$i]['id_nivel_cargo'];
		$cp7 = $res[$i]['area'];		
		$cp8 = $res[$i]['localidade'];
		$cp9 = $res[$i]['id_tipo_contrato'];		

		$cp4 = number_format($cp4, 2, ',', '.');

		$query1 = $pdo->query("SELECT * from nivel_cargo where id = $cp6");
		$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
		$nivel = @$res1[0]['descricao'];

		$query2 = $pdo->query("SELECT * from tipo_contrato where id = $cp9");		
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$tipo_contrato = @$res2[0]['descricao'];

		if($cp2 == '1'){
			$ativo = 'Desativar Vaga';
			$icone = 'bi-check-square';
			$ativar = '0';
			$inativa = '';
		}else{
			$ativo = 'Ativar Vaga';
			$icone = 'bi-square';
			$ativar = '1';
			$inativa = 'text-muted';
		}		

echo <<<HTML
	<tr class="{$inativa}">
	<td>{$cp1}</td>			
	<td>{$cp3}</td>	
	<td>R$ {$cp4}</td>	
	<td>{$cp5}</td>
	<td>{$nivel}</td>
	<td>{$cp7}</td>
	<td>{$cp8}</td>
	<td>{$tipo_contrato}</td>	
	<td>
	<a href="#" onclick="editar('{$id}', '{$cp1}', '{$cp2}', '{$cp3}', '{$cp4}', '{$cp5}', '{$cp6}', '{$cp7}', '{$cp8}', '{$cp9}')" title="Editar Registro">	<i class="bi bi-pencil-square text-primary"></i> </a>
	<a href="#" onclick="excluir('{$id}' , '{$cp2}')" title="Excluir Registro">	<i class="bi bi-trash text-danger"></i> </a>
	<a href="#" onclick="mudarStatus('{$id}', '{$ativar}')" title="{$ativo}"><i class="bi {$icone} text-secondary"></i></a>		
	<a href="#" onclick="candidatos('{$id}')" title="Adicionar Candidato"><i class="bi bi-person-plus-fill"></i></a>	

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


function editar(id, cp1, cp2, cp3, cp4, cp5, cp6, cp7, cp8, cp9){	
	$('#id').val(id);
	$('#<?=$campo1?>').val(cp1);
	$('#<?=$campo2?>').val(cp2);
	$('#<?=$campo3?>').val(cp3);
	$('#<?=$campo4?>').val(cp4);
	$('#<?=$campo5?>').val(cp5);
	$('#<?=$campo6?>').val(cp6);
	$('#<?=$campo6?>').val(cp6);
	$('#<?=$campo7?>').val(cp7);
	$('#<?=$campo8?>').val(cp8);		
	$('#<?=$campo9?>').val(cp9);		
	
	
	$('#tituloModal').text('Editar Registro');
	var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {		});
	myModal.show();
	$('#mensagem').text('');
}

function candidatos(id){	
	$('#id').val(id);
	$('#tituloModal').text('Adicionar Candidatos');
	var myModal = new bootstrap.Modal(document.getElementById('modalCandidatos'), {		});
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
	$('#<?=$campo8?>').val('');	
	$('#<?=$campo9?>').val('');
	
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










