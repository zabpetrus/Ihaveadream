<?php

error_reporting(0);
session_start();

include_once "../admin/config/conexao.php";
include_once "../admin/funcoes/funcoes.php";

if(isset($_SESSION['login'])){
    $frase = "Quer acessar o seu carrinho?";
    $link = "carrinho.php";
    $palavra = "Carrinho";
    $agendamento = "index.php";
    $agendar = "Site";
}else{
    $frase = "Quer efetuar o seu login?";
    $link = "../admin";
    $palavra = "Login";
    $agendamento = "../";
    $agendar = "Cadastrar";
}

$userid = "";

if(isset($_SERVER["usuarioId"])){
    $userid = $_SESSION['usuarioId'];    
}




$usuario = "SELECT * FROM `ps_login` WHERE `id` = '$userid' ";
$exec = mysqli_query($conn, $usuario);
$info = mysqli_fetch_assoc($exec);

?>


<!DOCTYPE html>
<html lang="pt-br" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>5PJS - Projeto de Sistemas | Petshop | Agendamento</title>
    <link rel="stylesheet" href="dist/css/style.css">
    <link rel="stylesheet" type="text/css" href="contents/css/agendamento.style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body class="is-boxed has-animations">
    <?php   include_once "menu.php"; ?>

    <div class="body-wrap">

        <header class="site-header">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <section>
                        <h2 class="hero-title mt-3">Banho & Tosa</h2>               
                    </section>
                </div>
            </div>            
        </header>

        <main>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 mx-auto">                       

                        <section id="forms_rand" >

                        <?php

                            if($_SERVER['REQUEST_METHOD'] == "POST"){
                                
                                $sql = "SELECT * FROM `ps_agendamentos` WHERE `data` = '$_POST[data]'";
                                $dados = mysqli_query($conn, $sql) or die(mysql_error($conn));
                                $linha = mysqli_fetch_assoc($dados);
                                $tr = mysqli_num_rows($dados);
                                ?>
                                <section class="features section">
                                    <div class="container">
                                        <div class="features-inner section-inner has-bottom-divider">
                                            <div class="features-wrap">
                                                <form action="agendar.php" method="POST">

                                                    <h2 class="text-white">Agendamento de Banho & Tosa</h1>
                                                    
                                                    <div class="hero-cta text-white">

                                                    <div class="mb-3">
                                                    <label class="form-label">Nome</label>
                                                    <input type="text" class="input" name="nome" value="<?=$_POST['nome']?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                    <label class="form-label">Pet</label>
                                                    <input type="text" class="input mt-0" name="pet" value="<?=$_POST['pet']?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                    <label class="form-label">Telefone</label>
                                                    <input type="text" class="input mt-0" name="tel" id="TEL" value="<?=$_POST['tel']?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="text" class="input mt-0" name="email" value="<?=$_POST['email']?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                    <label class="form-label">Data Selecionada</label>
                                                    <input type="date" class="input mt-0"  value="<?=$_POST['data']?>" disabled>
                                                    </div>

                                                        
                                                        <h5 class="hero-title"> Horarios Disponíveis: </h5> 
                                                        <?php
                                                            $_SESSION['data'] = $_POST['data'];
                                                            for($i=10; $i<17; $i++){
                                                                $query = "SELECT * FROM `ps_agendamentos` WHERE `data` = '$_POST[data]' && `hora` = '$i'";
                                                                $resultado = mysqli_query($conn, $sql) or die(mysql_error($conn));
                                                                $linha = mysqli_fetch_assoc($resultado);

                                                                if($linha['hora'] != $i){
                                                                    ?>
                                                                    <input type="radio" name="hora" value="<?=$i?>"> <?=$i?>:00h
                                                                    <?php
                                                                    $result = empty($result);
                                                                }
                                                            }
                                                        ?>
                                                    </div>
                                                    <div class="hero-cta">
                                                        <button class="button button-primary" type="submit">Agendar</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <?php
                            }else{
                            ?>
                                <section class="features section">
                                    <div class="container">
                                        <div class="section-inner has-bottom-divider">
                                            <div class="">
                                                <form action="agendamento.php" method="POST">
                                                    <h2 class="text-white mt-0 mb-5">Agendamento de Banho & Tosa</h2>
                                                    <div class="hero-cta text-white">

                                                        <div class="mb-3">
                                                        <label class="form-label">Nome</label>
                                                        <input type="text" class="input mt-0" name="nome" value="<?=$info['nome']?>" required>
                                                        </div>

                                                        <div class="mb-3">
                                                        <label class="form-label">Pet</label>
                                                        <input type="text" class="input mt-0" name="pet" placeholder="Nome do seu Pet" required>
                                                        </div>

                                                        <div class="mb-3">
                                                        <label class="form-label">Telefone</label>
                                                        <input type="text" class="input mt-0" name="tel" id="TEL" value="<?=$info['telefone']?>" required>
                                                        </div>

                                                        <div class="mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="text" class="input mt-0" name="email" value="<?=$info['email']?>" required>
                                                        </div>

                                                        <div class="mb-3">
                                                        <label class="form-label">Data Selecionada</label>
                                                        <input type="date" class="input mt-0" name="data" required>
                                                        </div>                 
                                                        
                                                        
                                                        
                                                        
                                                        <br>
                                                        <div class="hero-cta">
                                                            <button class="button button-primary" type="submit" style="align: center;">Avançar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            <?php
                            }
                            ?>
                        </section> <!-- end forms_rand -->

                        <section class="cta section">
                            <div class="container">
                                <div class="cta-inner section-inner">
                                    <h3 class="section-title mt-0"><?=$frase?></h3>
                                    <div class="cta-cta">
                                        <a class="button button-primary button-wide-mobile" href="<?=$link?>">Clique Aqui</a>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </main>			

        <footer class="site-footer">
            <div class="container">
                <div class="site-footer-inner">
                    <div class="brand footer-brand">
						<a href="#">
							<img class="header-logo-image" src="contents/dist/images/logo.svg" alt="Logo">
						</a>
                    </div>
                    <div class="footer-copyright">&copy; Todos os direitos reservados</div>
                </div>
            </div>
        </footer>

    </div><!-- end body-wrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="contents/dist/js/main.min.js"></script>
</body>
</html>