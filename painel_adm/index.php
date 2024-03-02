<?php
@session_start();
require_once("../conexao.php");
require_once("verificar.php");
$id_usuario = $_SESSION['id_usuario'];
$niv_usuario = $_SESSION['nivel_usuario'];

if ($niv_usuario != 'Administrador') {
	$ocultar_menu = 'd-none';
} else {
	$ocultar_menu = 'd-block';
}
//RECUPERAR DADOS DO USUÁRIO
$query = $pdo->query("SELECT * from usuarios where id = '$id_usuario' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_usuario = $res[0]['nome'];
$email_usuario = $res[0]['login'];
$senha_usuario = $res[0]['senha'];
$nivel_usuario = $res[0]['nivel'];

if ($nivel_usuario != 'Administrador') {
	$ocultar_home = 'display: block;';
} else {
	$ocultar_home = 'display: none;';
}

//MENUS DO PAINEL
$menu1 = 'home';
$menu2 = 'vagas';
$menu3 = 'candidatos';

if (@$_GET['pag'] == "") {
	$pag = $menu1;
} else {
	$pag = $_GET['pag'];
}

$data_atual = date('Y-m-d');
$dataOntem = date('Y-m-d', strtotime("-1 day", strtotime($data_atual)));

$mes_atual = Date("m");
$ano_atual = Date("Y");
$data_inicial_mes_atual = $ano_atual . "-" . $mes_atual . "-01";

$data_inicial_mes_ant = date('Y-m-d', strtotime("-1 month", strtotime($data_inicial_mes_atual)));

$separar_data = explode("-", $data_inicial_mes_ant);
$mes_ant = $separar_data[1];

if ($mes_ant == '4' || $mes_atual == '6' || $mes_atual == '9' || $mes_atual == '11') {
	$data_final_mes_atual = $ano_atual . "-" . $mes_atual . "-30";
} else if ($mes_ant == '2') {
	$data_final_mes_atual = $ano_atual . "-" . $mes_atual . "-28";
} else {
	$data_final_mes_atual = $ano_atual . "-" . $mes_atual . "-31";
}

$data_final_mes_ant = date('Y-m-d', strtotime("-1 month", strtotime($data_final_mes_atual)));

?>

<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Hugo Vasconcelos">
	<title><?php echo $nome_sistema ?></title>

	<link href="../img/logo.png" rel="shortcut icon" type="image/x-icon">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>	

	<link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css" />
	<link rel="stylesheet" type="text/css" href="../css/style.css" />

	<script type="text/javascript" src="../DataTables/datatables.min.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #3074bc;">
		<div class="container-fluid">
			<div class="d-flex mr-4">
				<img class="img-profile rounded-circle" src="../img/user.jpg" width="40px" height="40px">

				<ul class="navbar-nav">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<?php echo @$nome_usuario; ?>
						</a>
						<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalPerfil">Editar Dados</a>

							

							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="../logout.php">Sair</a></li>
						</ul>
					</li>

				</ul>

			</div>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a style="<?php echo $ocultar_home ?>" class="nav-link" aria-current="page" <?php echo $ocultar_menu ?> href="index.php?pag=<?php echo $menu1 ?>">Home</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" aria-current="page" <?php echo $ocultar_menu ?> href="index.php?pag=<?php echo $menu2 ?>">Vagas</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" aria-current="page" <?php echo $ocultar_menu ?> href="index.php?pag=<?php echo $menu3 ?>">Candidatos</a>
					</li>
				</ul>
				<a class="navbar-brand" href="#"><img src="../img/logo.png" width="60px"></a>

			</div>
		</div>
	</nav>








	<div class="container-fluid mb-4 mx-400">
		<?php
		require_once($pag . '.php');
		?>
	</div>

	





</body>

</html>




<!-- Modal -->
<div class="modal fade" id="modalPerfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar Dados</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-perfil" method="post">
				<div class="modal-body">

					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Nome</label>
						<input type="text" class="form-control" name="nome-usuario" placeholder="Nome" value="<?php echo $nome_usuario ?>">
					</div>

					<div class="mb-3">
						<label for="exampleFormControlInput1"  class="form-label">Email</label>
						<input type="email" class="form-control" name="email-usuario" placeholder="Email" value="<?php echo $email_usuario ?>">
					</div>

					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Senha</label>
						<input type="text" class="form-control" name="senha-usuario" placeholder="Senha" value="<?php echo $senha_usuario ?>">
					</div>

					<small>
						<div id="mensagem-perfil" align="center"></div>
					</small>

					<input type="hidden" class="form-control" name="id-usuario" value="<?php echo $id_usuario ?>">


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-perfil">Fechar</button>
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Mascaras JS -->
<script type="text/javascript" src="../js/mascaras.js"></script>

<!-- Ajax para funcionar Mascaras JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<!-- Ajax para inserir ou editar dados -->
<script type="text/javascript">
	$(document).ready(function() {
		var cat = $('#cat-despesas-rel').val();
		console.log(cat)
		

		$('#cat-despesas-rel').change(function() {
			var cat = $(this).val();			
		});

	});


	$("#form-perfil").submit(function() {
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: "editar-perfil.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {
				$('#mensagem-perfil').removeClass()
				if (mensagem.trim() == "Salvo com Sucesso") {
					//$('#nome').val('');
					//$('#cpf').val('');
					$('#btn-fechar-perfil').click();
					window.location = "index.php";
				} else {
					$('#mensagem-perfil').addClass('text-danger')
				}

				$('#mensagem-perfil').text(mensagem)
			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});




	function mudarDataRel(data, data2) {
		$("#data-inicial-rel").val(data);
		$("#data-final-rel").val(data2);

		$("#data-inicial-rel-lucro").val(data);
		$("#data-final-rel-lucro").val(data2);

		$("#data-inicial-rel-lucroP").val(data);
		$("#data-final-rel-lucroP").val(data2);
	}





	
</script>






<script type="text/javascript">
	function carregarImgLogo() {
		var target = document.getElementById('targetLogo');
		var file = document.querySelector("#logo").files[0];

		var reader = new FileReader();

		reader.onloadend = function() {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>



<script type="text/javascript">
	function carregarImgIcone() {
		var target = document.getElementById('targetIcone');
		var file = document.querySelector("#icone").files[0];

		var reader = new FileReader();

		reader.onloadend = function() {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>


<script type="text/javascript">
	$("#form-config").submit(function() {
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: "editar-config.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {
				$('#mensagem-config').removeClass()
				if (mensagem.trim() == "Salvo com Sucesso") {
					//$('#nome').val('');
					//$('#cpf').val('');
					$('#btn-fechar-config').click();
					window.location = "index.php";
				} else {
					$('#mensagem-config').addClass('text-danger')
				}

				$('#mensagem-config').text(mensagem)
			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>