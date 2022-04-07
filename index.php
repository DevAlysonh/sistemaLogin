<!DOCTYPE html>
<?php
    //conexão
    require_once 'db_conect.php';

    //sessão
    session_start();

    //testa se o botão submit foi acessado. 
    if(isset($_POST['bt-entrar'])):
        $erros = array();
        $login = mysqli_escape_string($connect, $_POST['login']);
        $senha = mysqli_escape_string($connect, $_POST['senha']);
            //testa se os campos do formulário foram preenchidos....
            if(empty($login) or empty($senha)):
                $erros[] = "<li> Os campos Login/Senha não podem estar vazios!</li>";

            else:
               //inicia a validação de login.........
                $sql = "SELECT login FROM usuarios WHERE login = '$login'";
                $resultado = mysqli_query($connect, $sql);
                
                if(mysqli_num_rows($resultado) > 0):
                    $senha = md5($senha);
                    $sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'";
                    $resultado = mysqli_query($connect, $sql);
                        if(mysqli_num_rows($resultado) == 1):
                            $dados = mysqli_fetch_array($resultado);
                            mysqli_close($connect);
                            $_SESSION['logado'] = true;
                            $_SESSION['id_usuario'] = $dados['id'];
                            header('Location: home.php');
                        else:
                            $erros[] = "<li> Usuário ou senha incorretos!</li>";
                        endif;

                else:
                    $erros[] = "<li>Usuário Inexistente!</li>";

                endif;

            endif;
             
    endif;





?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Login</h1>
    <hr>
    <?php
        if(!empty($erros)):
            foreach($erros as $erro):
                echo $erro;
            endforeach;

        endif;
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        Login: <input type="text" name="login"><br>
        Senha: <input type="password" name="senha"><br>
        <input type="submit" name="bt-entrar">

    </form>
</body>
</html>