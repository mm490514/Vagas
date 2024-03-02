<?php
require_once("conexao.php");


//CRIAR O USUÁRIO ADMINISTRADOR CASO ELE NÃO EXISTA
$query = $pdo->query("SELECT * from usuarios");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

//CRIAR O NÍVEL ADMINISTRADOR CASO ELE NÃO EXISTA
$query2 = $pdo->query("SELECT * from niveis where nivel = 'Administrador' ");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$total_reg2 = @count($res2);

if ($total_reg == 0) {
    $pdo->query("INSERT INTO usuarios SET nome = '$nome_admin', login = '$email_adm', senha = '123', nivel = 'Administrador' ");
}

if ($total_reg2 == 0) {
    $pdo->query("INSERT INTO niveis SET nivel = 'Administrador'");
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Hugo Vasconcelos">

    <link href="img/logo.png" rel="shortcut icon" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link href="css/estilo-login.css" rel="stylesheet">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>	
    <title><?php echo $nome_sistema ?></title>
</head>

<body class="bg-light">
    
<section class="vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-8 col-lg-6 col-xl-3">
        <div class="card shadow-lg">
            <img src="img/logo.png" class="img-fluid">
            <form id="loginform" class="needs-validation" action="autenticar.php" role="form" method="POST">
                <div class="mb-0 p-4">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" style="background:white;" required>
                </div>
                <div class="mb-3 p-4">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required>
                </div>
                <div class="form-group">
                    <div style="text-align: center; margin-bottom: 10px;">
                        <input type="submit" name="login" value="ENTRAR" class="btn btn-primary ms-auto">
                    </div>
                </div>
                <div style="text-align: center; margin-bottom: 10px; ">
                    <a href="criar_perfil.php" class="btn btn-outline-secondary">CRIAR PERFIL</a>
                </div>
            </form>            
        </div>
    </div>
</section>
</body>

</html>s