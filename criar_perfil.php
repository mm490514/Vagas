<?php
require_once("conexao.php");
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
        <div class="card shadow-lg p-3"> 
            <h2>Crie seu perfil gratuitamente</h2>
            <br>
            <form id="perfilform" class="needs-validation" action="cadastrar.php" role="form" method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Digite o Email" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label">Senha</label>
                    <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
                </div>
                <br>
                <div class="form-group">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">O que você procura?</label>
                        <select class="form-select" aria-label="Default select example" name="nivel" id="nivel" required>
                            <option selected></option>
                            <option value="1">Vagas</option>
                            <option value="2">Candidatos</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-center"> 
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
                <BR>
                <div style="text-align: center; margin-bottom: 10px; ">
                    <a href="index.php" class="btn btn-outline-secondary">Já tenho perfil</a>
                </div>
            </form>
        </div>
    </div>
</section>
</body>

</html>

<style>
    .card {
        border: 1px solid #ccc; /* Adicionando borda */
    }
</style>