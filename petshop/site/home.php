<?php
    session_start();   
    include_once "../admin/config/conexao.php";
    include_once "../admin/funcoes/funcoes.php";  
?>

<!DOCTYPE html>
<html lang="pt-br" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>5PJS - Projeto de Sistemas | Petshop | Home</title>
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" href="contents/css/home.style.css">
    <link rel="icon" type="image/png" href="contents/images/favicon.ico"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://unpkg.com/animejs@3.0.1/lib/anime.min.js"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
</head>
<body class="is-boxed has-animations">
    <?php  

        include_once "menu.php";
        
        // Carregar informações dos produtos      

        if(array_key_exists('button', $_POST)) {

            $quantidade = $_POST['qte'];

            //function checkEstoque($produto, $conn) -> recebe o id do produto

            $estoque = checkEstoque($_POST['button'], $conn);

            if($estoque == false){
                ?>
                <script type="text/javascript">
                    alert('Produto esgotado!');
                    location.href = "index.php";
                </script>
                <?php
            }else{
                // function adcCarrinho($produto, $usuario, $quantidade, $conn)
               

                $carrinho = adcCarrinho( $_POST['button'], $_SESSION['usuarioId'], $quantidade, $conn);
            }
        }

        if(isset($_SESSION['login'])){
            $frase = "Quer acessar o seu carrinho?";
            $link = "carrinho.php";
            $palavra = "Carrinho";
            $agendamento = "agendamento.php";
            $agendar = "Banho & Tosa";
        }else{
            $frase = "Quer efetuar o seu login?";
            $link = "../admin";
            $palavra = "Login";
            $agendamento = "../";
            $agendar = "Cadastrar";
        }
    ?>
    <div class="body-wrap">
        <header class="site-header">
            <div class="container">
                <div class="site-header-inner">
                    <div class="brand header-brand">
                        <h1 class="m-0">
							<a href="#">
								<img class="header-logo-image" src="contents/dist/images/logo.svg" alt="Logo">
                            </a>
                        </h1>
                    </div>
                </div>
            </div>
        </header>
        <main>
        <section class="hero">
                <div class="container">
                    <div class="hero-inner">
						<div class="hero-copy">
	                        <h1 class="hero-title mt-0">Um Petshop Animal!!!</h1>
	                        <p class="hero-paragraph">"Seja a pessoa que seu cachorro pensa que você é.".</p>

	                        <div class="hero-cta">
                                <a class="button button-primary" href="<?=$link?>"><?=$palavra?></a>
                                <a class="button" href="<?=$agendamento?>"><?=$agendar?></a>
                            </div>

						</div>
						<div class="hero-figure anime-element">
							<svg class="placeholder" width="528" height="396" viewBox="0 0 528 396">
								<rect width="528" height="396" style="fill:transparent;" />
							</svg>
							<div class="hero-figure-box hero-figure-box-01" data-rotation="45deg"></div>
							<div class="hero-figure-box hero-figure-box-02" data-rotation="-45deg"></div>
							<div class="hero-figure-box hero-figure-box-03" data-rotation="0deg"></div>
							<div class="hero-figure-box hero-figure-box-04" data-rotation="-135deg"></div>
							<div class="hero-figure-box hero-figure-box-05"></div>
							<div class="hero-figure-box hero-figure-box-06"></div>
							<div class="hero-figure-box hero-figure-box-07"></div>
							<div class="hero-figure-box hero-figure-box-08" data-rotation="-22deg"></div>
							<div class="hero-figure-box hero-figure-box-09" data-rotation="-52deg"></div>
							<div class="hero-figure-box hero-figure-box-10" data-rotation="-50deg"></div>
						</div>
                    </div>
                </div>
            </section>

            <style>
                h5{color: blue;}
                .card{ background: none !important;}
                .card p{ color: white;  }

            </style>
            <section class="features section">
                <div class="container">
					<div class="features-inner section-inner has-bottom-divider">
                        <div class="features-wrap">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3"> <!--start Bootstrap -->
                            <?php

                                //********************************************************************************* */
                                $sql = "SELECT * FROM `ps_produtos` ORDER BY `id`";
                                $dados = mysqli_query($conn, $sql) or die(mysql_error($conn));
                                $tr = mysqli_num_rows($dados);

                                if($tr > 0){
                                while($linha = mysqli_fetch_assoc($dados)){  

                                //********************************************************************************* */
                            ?>
                                <div class="col">
                                    <div class="card shadow-sm">

                                        <img src="contents/<?=$linha['img']?>" class="img-responsive" title="<?=$linha['nome']?>" >

                                        <div class="card-body">

                                        <p class="card-text">
                                            <h5 class="text-primary mb-2" > <?=$linha['nome']?> </h5>
                                            <p>
                                                <?= $linha['descricao'] ?>
                                            </p>
                                        </p>
                                        <div class="container-fluid">
                                            <div class="row">
                                            <!--<button type="button" class="btn btn-outline-primary mb-2">Detalhes</button> -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#janelamodal<?= $linha['id']?>" >Adicionar ao Carrinho</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal -->
                                    <div class="modal fade" id="janelamodal<?= $linha['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel<?= $linha['id']?>" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel<?= $linha['id']?>"> <?=$linha['nome']?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <img src="contents/<?=$linha['img']?>" class="img-responsive" title="<?=$linha['nome']?> " >
                                                    </div>
                                                    <div class="col-md-8">
                                                    <p><?= $linha['descricao'] ?></p>
                                                        <div class="btn-group" role="group" aria-label="Basic example">

                                                            <button type="button" class="btn btn-outline-primary" onclick="remover(<?= $linha['id']?>)">-</button>                                                            
                                                            <button type="button" class="btn btn-outline-primary"><span id="contador<?= $linha['id']?>">1</span></button>
                                                            <button  type="button" class="btn btn-outline-primary" onclick="adicionar(<?= $linha['id']?>)">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <div class="modal-footer">
                                            <?php if(isset($_SESSION['login'])){     ?>

                                                <form id="addtocart" method="post">

                                                    <input type="hidden" name="qte" id="valor<?=$linha['id']?>" value="" />
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal"  name="button" value="<?=$linha['id']?>" onclick="adicionarValor(<?=$linha['id']?>)"   >Adicionar ao Carrinho</button>

                                                </form>
                                                <a class="btn btn-primary" href="carrinho.php" >Visualizar Carrinho</a>

                                            <?php } else {  ?>

                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continuar</button>
                                                <button class="btn btn-primary" onclick="advert()">Visualizar Carrinho</button>

                                            <?php } ?>

                                                
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                <!--end Modal -->                               

                            <?php 
                            //Iterator Block
                              } } 
                            //Iterator Block  
                            ?>
                            </div> <!--start Bootstrap -->
                        </div>
                    </div>
                </div>
            </section>

			<section class="cta section">
				<div class="container">
					<div class="cta-inner section-inner">
						<h3 class="section-title mt-0"><?=$frase?></h3>
						<div class="cta-cta">
							<a class="button button-primary button-wide-mobile" href="../cadastrar.php">Clique Aqui</a>
						</div>
					</div>
				</div>
			</section>


        </main>

        <footer class="site-footer">
            <div class="container">
                <div class="site-footer-inner">
                    <div class="brand footer-brand">
						<a href="#">
							<img class="header-logo-image" src="contents/dist/images/logo.svg" alt="Logo"> Voltar para o topo
						</a>
                    </div>
                    <div class="footer-copyright">&copy; 2021 Izabel Souza e Juan Silva, Todos os direitos reservados</div>
                </div>
            </div>
        </footer>
    </div>
    <script src="contents/dist/js/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">

        function advert(){
            alert("Para adicionar ao carrinho você precisa estar logado!");
            window.location.href="carrinho.php";
            return false;
        }
      

        function adicionar(id){
            var texto = $("#contador"+ id).html();
            var i = parseInt(texto);
            i += 1;
            $("#contador" + id).html(i);
            return false;
        }

        function remover(id){
            var texto = $("#contador" + id).html();
            var i = parseInt(texto);
            if(i > 1)
            {
                i -= 1;
            }
            
            $("#contador"+ id).html(i);
            return false;
        }

        function adicionarValor( id )
        {
            var valor = $("#contador"+ id).text();
            $("#valor"+id).val(valor);
        }     
       
    </script>
</body>
</html>