<?php 
require_once("../conexao.php");
require_once("verificar.php");
$pagina = 'candidatos';
@session_start();
require_once($pagina."/campos.php");

?>

<div class="col-md-12 my-3">
	<a href="#" onclick="inserir()" type="button" class="btn btn-dark btn-sm">Novo Candidato</a>
</div>

<small>
	<div class="tabela bg-light" id="listar">

	</div>
</small>



<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Inserir Registro</span></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form" method="post">
				<div class="modal-body">

					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#dados" type="button" role="tab" aria-controls="home" aria-selected="true">Dados Vagas</a>
						</li>	
					</ul>
					
					<hr>

					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="dados" role="tabpanel" aria-labelledby="home-tab">

							<div class="row">
								<div class="col-md-4 col-sm-6">
									<div class="mb-3">
										<label for="exampleFormControlInput1" class="form-label"><?php echo $campo1 ?></label>
										<input type="text" class="form-control" name="<?php echo $campo1 ?>" placeholder="<?php echo $campo1 ?>" id="<?php echo $campo1 ?>" required>
									</div>
								</div>

								<div class="col-md-4 col-sm-6">
									<div class="mb-3">
										<label for="exampleFormControlInput1" class="form-label"><?php echo $campo2 ?></label>
										<input type="text" class="form-control" name="<?php echo $campo2 ?>" placeholder="<?php echo $campo2 ?>" id="<?php echo $campo2 ?>" required>
									</div>
								</div>

								<div class="col-md-4 col-sm-6">
									<div class="mb-3">
										<label for="exampleFormControlInput1" class="form-label">Data Nascimento</label>
										<input type="text" class="form-control" name="<?php echo $campo3 ?>" placeholder="00/00/0000" id="<?php echo $campo3 ?>" required>
									</div>
								</div>																
								
								<div class="col-md-3 col-sm-12">
									<div class="mb-3">
										<label for="exampleFormControlInput1" class="form-label"><?php echo $campo4 ?></label>										
										<select class="form-select" aria-label="Default select example" name="<?php echo $campo4 ?>" id="<?php echo $campo4 ?>">
										<option selected>Selecione</option>
										<option value="1">Ensino Fundamental Incompleto</option>
										<option value="2">Ensino Fundamental Completo</option>
										<option value="3">Ensino Medio Incompleto</option>
										<option value="4">Ensino Medio Completo</option>
										<option value="5">Ensino Superior Incompleto</option>
										<option value="6">Ensino Superior Completo</option>
										<option value="7">Pós-Graduação</option>										
										<option value="8">Mestrado</option>										
										<option value="9">Doutorado</option>										
										</select>
									</div>
								</div>

								<div class="col-md-4 col-sm-6">
										<div class="mb-3">
											<label for="exampleFormControlInput1" class="form-label"><?php echo $campo5 ?></label>
											<input type="text" class="form-control" name="<?php echo $campo5 ?>" placeholder="<?php echo $campo5 ?>" id="<?php echo $campo5 ?>" required>
										</div>
								</div>

								<div class="col-md-4 col-sm-6">
									<div class="mb-3">
										<label for="exampleFormControlInput1" class="form-label">Area Interessada</label>
										<input type="text" class="form-control" name="<?php echo $campo6 ?>" placeholder="Area Interessada" id="<?php echo $campo6 ?>" required>
									</div>
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-14 col-sm-12">
										<div class="mb-3">
											<label for="exampleFormControlInput1" class="form-label"><?php echo $campo7 ?></label>										
											<textarea type="text" class="form-control" name="<?php echo $campo7 ?>" id="<?php echo $campo7 ?>" cols="100" rows="5" required></textarea>
										</div>
								</div>
							</div>																		
						</div>
					</div>

					
					
					<small><div id="mensagem" align="center"></div></small>

					<input type="hidden" class="form-control" name="id"  id="id">


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar">Fechar</button>
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>




<!-- Modal -->
<div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Excluir Registro</span></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-excluir" method="post">
				<div class="modal-body">

					Deseja Realmente excluir este Registro: <span id="nome-excluido"></span>?

					<small><div id="mensagem-excluir" align="center"></div></small>

					<input type="hidden" class="form-control" name="id-excluir"  id="id-excluir">


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
					<button type="submit" class="btn btn-danger">Excluir</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalCandidatos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Excluir Registro</span></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-excluir" method="post">
				<div class="modal-body">

					Candidatos da vaga: <span id="nome-excluido"></span>

					<small><div id="mensagem-excluir" align="center"></div></small>

					<input type="hidden" class="form-control" name="id-excluir"  id="id-excluir">


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
					<button type="submit" class="btn btn-danger">Excluir</button>
				</div>
			</form>
		</div>
	</div>
</div>





<!-- Modal -->
<div class="modal fade" id="modalDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Produto <span id="campo2"></span></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			
			<div class="modal-body">
				<small>
					
					
					<span><b><?php echo $campo1 ?>:</b> <span id="campo1"></span></span>

					<span class="mx-4"><b><?php echo $campo10 ?>:</b> <span id="campo10"></span></span>
					
					<hr style="margin:6px;">

					<span><b><?php echo $campo4 ?>:</b> <span id="campo4"></span></span>
					<span class="mx-4"><b><?php echo $campo5 ?>:</b> R$ <span id="campo5" ></span>

					<span class="mx-4"><b><?php echo $campo6 ?>:</b> R$ <span id="campo6" ></span>
				</span>	
				<hr style="margin:6px;">


				<span><b><?php echo $campo7 ?>:</b> <span id="campo7"></span></span>
				<span class="mx-4"><b><?php echo $campo8 ?>:</b> <span id="campo8" ></span>

				<hr style="margin:6px;">
				<span><b>Nível Alerta Estoque:</b> <span id="nivel_dados"></span></span>
			
			</span>	


			<hr style="margin:6px;">


			<div class="my-2" align="center"><img id="imagem_dados" src="" width="60%"></div>
			<hr style="margin:6px;">


			<span ><b>Descrição:</b> <span id="campo3" ></span>
		</span>	






	</small>


</div>

</div>
</div>
</div>





<!-- Modal -->
<div class="modal fade" id="modalComprar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Comprar Produto <span id="nome-comprar"></span></span></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-comprar" method="post">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Quantidade</label>
								<input type="number" class="form-control" name="quantidade" id="quantidade" placeholder="Quantidade à comprar" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Valor Compra</label>
								<input type="text" class="form-control" name="<?php echo $campo5 ?>" id="<?php echo $campo5 ?>" placeholder="Valor da Compra" required>
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">% de Lucro (Opcional)</label>
								<input type="number" class="form-control" name="<?php echo $campo11 ?>" id="<?php echo $campo11 ?>" placeholder="Ex 50 em caso de 50%">
							</div>
						</div>

						<div class="col-md-6">

							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label"><?php echo $campo7 ?></label>
								<select class="form-select sel3" aria-label="Default select example" name="<?php echo $campo7 ?>" id="<?php echo $campo7 ?>" style="width:100%">
									


								</select>
							</div>
						</div>
					</div>



					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="true" id="alterar" name="alterar">
						<label class="form-check-label" for="flexCheckDefault">
							Alterar Valor do Produto conforme Lucro?
						</label>
					</div>
					
					
					<small><div id="mensagem-comprar" align="center"></div></small>

					<input type="hidden" class="form-control" name="id-comprar"  id="id-comprar">


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-comprar">Fechar</button>
					<button type="submit" class="btn btn-success">Comprar</button>
				</div>
			</form>
		</div>
	</div>
</div>


<script type="text/javascript">var pag = "<?=$pagina?>"</script>
<script src="../js/ajax.js"></script>
<script>
$(document).ready(function() {
    $('#Salario').on('input', function() {
        // Remove todos os caracteres que não são números ou ponto
        $(this).val($(this).val().replace(/[^0-9.]/g, ''));

        // Formata para o padrão de moeda (R$ 00,00)
        var salario = $(this).val();
        salario = salario.replace(/\D/g, ""); // Remove tudo o que não é dígito
        salario = salario.replace(/(\d)(\d{2})$/, "$1,$2"); // Adiciona a vírgula
        salario = salario.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."); // Adiciona os pontos
        $(this).val('R$ ' + salario);
    });
});
</script>





<script type="text/javascript">
	$("#form-comprar").submit(function () {
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: pag + "/comprar.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				$('#mensagem-comprar').text('');
				$('#mensagem-comprar').removeClass()
				if (mensagem.trim() == "Comprado com Sucesso") {
					$('#btn-fechar-comprar').click();
					listar();
				} else {

					$('#mensagem-comprar').addClass('text-danger')
					$('#mensagem-comprar').text(mensagem)
				}


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>


<script type="text/javascript">
		$(document).ready(function() {
			$('.sel2').select2({    	 
    	 dropdownParent: $('#modalForm')
    	});

			$('.sel3').select2({    	 
    	 dropdownParent: $('#modalComprar')
    	});

		});

	
	</script>

	<style type="text/css">
		.select2-selection__rendered {
			line-height: 36px !important;
			font-size:16px !important;
			color:#666666 !important;

		}

		.select2-selection {
			height: 36px !important;
			font-size:16px !important;
			color:#666666 !important;

		}
	</style>  