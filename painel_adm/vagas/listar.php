<?php 
require_once("../../conexao.php");
require_once("campos.php");
@session_start();

$id_usuario = $_SESSION['id_usuario'];

$niv_usuario = $_SESSION['nivel_usuario'];

if ($niv_usuario != 'Administrador') {
	$ocultar_home = 'display: none;';
	$ocultar_cand = 'display: block;';
	$query = $pdo->query("SELECT * from $pagina where situacao <> 0 order by id desc ");
} else {
	$ocultar_home = '';
	$ocultar_cand = 'display: none;';
	$query = $pdo->query("SELECT * from $pagina where id_user_empresa  = '$id_usuario' order by id desc ");
}





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

		if ($niv_usuario != 'Administrador') {

			$query5 = $pdo->query("SELECT * from candidatos where id_usuario = $id_usuario");		
			$res5 = $query5->fetchAll(PDO::FETCH_ASSOC);
			$id_candidato = @$res5[0]['id'];

			$query3 = $pdo->query("SELECT * from candidaturas where id_candidato = $id_candidato and id_vaga = $id");			
			$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
			$id_candidatura = @$res3[0]['id'];
	
			if ($id_candidatura){
				$botao_sim = 'display: none;';
				$botao_cancelar = 'display: block;';
			} else {
				$botao_sim = 'display: block;';
				$botao_cancelar = 'display: none;';
			}
		
		} else {
			$botao_sim = 'display: none;';
			$botao_cancelar = 'display: none;';
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
	<a href="#" onclick="editar('{$id}', '{$cp1}', '{$cp2}', '{$cp3}', '{$cp4}', '{$cp5}', '{$cp6}', '{$cp7}', '{$cp8}', '{$cp9}')" title="Editar Registro">	<i class="bi bi-pencil-square text-primary" style="$ocultar_home"></i> </a>
	<a href="#" onclick="excluir('{$id}' , '{$cp2}')" title="Excluir Registro" style="$ocultar_home">	<i class="bi bi-trash text-danger"></i> </a>
	<a href="#" onclick="mudarStatus('{$id}', '{$ativar}')" title="{$ativo}" style="$ocultar_home"><i class="bi {$icone} text-secondary"></i></a>		
	<a href="#" onclick="candidatos('{$id}')" title="Adicionar Candidato" style="$ocultar_home"><i class="bi bi-person-fill text-dark"></i></a>		
	<button onclick="candidatar('{$id_usuario}', '{$id}')" title="Candidatar-se"  type="button" style="$botao_sim" class="btn btn-primary">Candidatar</button>
	<button onclick="descandidatar('{$id_usuario}', '{$id}')" title="Cancelar"  type="button" style="$botao_cancelar" class="btn btn-danger">Cancelar</button>

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

function candidatos(id_vaga){  
    $('#id').val(id_vaga);
    $('#tituloModal').text('Adicionar Candidatos');
    
    // Fazer solicitação AJAX para obter candidatos
    $.ajax({
        url: 'retorna_candidatos.php',
        type: 'post',
        data: {id_vaga: id_vaga},
        dataType: 'json',
        success: function(response) {

			var modalBody = $('#modalCandidatos .modal-body'); 
            
            modalBody.empty();         
            
            $.each(response, function(index, candidato) {
        		modalBody.append('<a>' + candidato + '</a><br>'); // Adiciona os candidatos ao corpo do modal
    		});           
            
            var myModal = new bootstrap.Modal(document.getElementById('modalCandidatos'), {});
			myModal.show();
			$('#mensagem').text('');
        },
        error: function(xhr, status, error) {
            // Lidar com erros de requisição, se houver
            console.error(xhr.responseText);
        }
    });
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










