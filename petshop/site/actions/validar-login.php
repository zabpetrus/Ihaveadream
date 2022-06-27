<?php
    session_start(); 
    include_once("../admin/config/conexao.php");
    
    if((isset($_POST['email'])) && (isset($_POST['senha']))){
        $usuario = mysqli_real_escape_string($conn, $_POST['email']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
        $senha = mysqli_real_escape_string($conn, $_POST['senha']);
        $senha = md5($senha);
            
        $result_usuario = "SELECT * FROM ps_login WHERE email = '$usuario' && senha = '$senha' LIMIT 1";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        $resultado = mysqli_fetch_assoc($resultado_usuario);
        
        if(isset($resultado)){
            $_SESSION['usuarioId'] = $resultado['id'];
            $_SESSION['usuarioNome'] = $resultado['nome'];
            $_SESSION['usuarioNiveisAcessoId'] = $resultado['niveis_acesso_id'];
            $_SESSION['usuarioEmail'] = $resultado['email'];
            $_SESSION['login'] = "Logado";

            if($_SESSION['usuarioNiveisAcessoId'] == "1"){
                header("Location: ../admin/administrativo.php");
            }else{
                //era header("Location: ../site/"); mas não funcionou aqui
                header("Location: index.php");
            }
        }else{    
            $_SESSION['loginErro'] = "Usuário ou senha Inválido";
            header("Location: error.php");
        }
    }else{
        $_SESSION['loginErro'] = "Usuário ou senha inválido";
        header("Location: error.php");
    }
?>