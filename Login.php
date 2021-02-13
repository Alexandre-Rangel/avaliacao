<?php
session_start();



if (isset($_POST['login'])) {



    include('includes/db.php');
    include('includes/Mensagens.php');
    include('includes/Funcoes.php');




    $Usu = $mysqli->real_escape_string($_POST['usuario']);




    $query = 'SELECT ID, SENHA FROM usuario WHERE NOME = ?';
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $Usu);
    $stmt->execute();

    $stmt->bind_result($idUsuario, $hash); // aqui tem que bater com os campos do select
    $stmt->fetch();

    if (password_verify($_POST['password'], $hash)) {

        $_SESSION['UserId'] = $idUsuario;
        $_SESSION['Usuario'] = $Usu;

        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?page=teste.php">';
    } else {
        $msgBox = Mensagem('Usuario e/ou senha invalidos');
    }
}






?>
<!doctype html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Teste técnico da empresa widepay">
    <meta name="author" content="Alexandre Chagas Rangel da Costa">

    <title>Validação de URL</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-signin">
        <form method="post" id="myForm_FORM" role="form">
            <img class="mb-4" src="https://www.widepay.com/tpl/themes/widepay/assets/images/logo-wide-pay.svg" alt="" width="172" height="157">
            <h1 class="h3 mb-3 fw-normal">Acesso Restrito</h1>
            <?php if ($msgBox) {
                echo $msgBox;
            } ?>

            <input style="color: Black;" placeholder="Usuario" class="form-control" name="usuario" type="text" required>
            <input type="password" name="password" id="password" class="form-control" placeholder="Senha" required>


            <button type="submit" name="login" class="btn btn-success btn-block">Acessar</button>



        </form>
    </main>



</body>

</html>