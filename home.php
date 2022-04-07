<?php

//conexão.......
require_once 'db_conect.php';

//sessão.......
session_start();
//guarda os dados do usuário num array $dados.......
$id = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuarios WHERE id = '$id'";
$resultado = mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($resultado);
mysqli_close($connect);
    //verifica se a sessão de login ainda está ativa.....
    if(!isset($_SESSION['logado'])):
        header('Location: index.php');
    endif;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Restrita</title>
</head>
<body>

    <h1>Olá, <?php echo $dados['nome']; ?></h1><hr>
    <h5>Seu número de registro é: <?php echo $dados['id']; ?></h5>
    <hr>
    <a href="logout.php"> Sair </a>

</body>
</html>