<?php

	session_start();

	include_once "../admin/config/conexao.php";
	include_once "../admin/funcoes/funcoes.php";

	include "menu.php";

	$sql = "SELECT * FROM `ps_produtos` WHERE `id` = '$_GET[idProduto]'";
	$dados = mysqli_query($conn, $sql) or die(mysql_error());
	$linha = mysqli_fetch_assoc($dados);

?>

<!DOCTYPE html>
<html lang="pt-br" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>5PJS - Projeto de Sistemas | Petshop | Produtos </title>
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" href="contents/dist/css/style.css">
    <link rel="stylesheet" type="text/css" href="contents/css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://unpkg.com/animejs@3.0.1/lib/anime.min.js"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
</head>
<body class="is-boxed has-animations">
    <?php
        if(array_key_exists('button', $_POST)) {
            $estoque = checkEstoque($_POST['button'], $conn);
            if($estoque == false){
                ?>
                <script type="text/javascript">
                    alert('Produto esgotado!');
                    location.href = "index.php";
                </script>
                <?php
            }else{
                $carrinho = adcCarrinho($_POST['button'], $_SESSION['usuarioId'], $estoque, $conn);
            }
        }
    ?>
    <div class="body-wrap">
        <header class="site-header">
            <div class="container">
                <div class="site-header-inner">
                    <div class="brand header-brand">
                        <h1 class="m-0">
							<a href="#">
								<img class="header-logo-image" src="dist/images/logo.svg" alt="Logo">
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
	                        <h1 class="hero-title mt-0">O Pet Shop do seu animal!</h1>
	                        <p class="hero-paragraph">"Seja a pessoa que seu cachorro pensa que você é.".</p>
	                        <div class="hero-cta"><a class="button button-primary" href="carrinho.php">Carrinho</a><a class="button" href="index.php">Continuar Comprando</a></div>
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
            <section class="pricing section">
                <div class="container-sm">
                    <div class="pricing-inner section-inner">
                        <div class="pricing-header text-center">
                            <h2 class="section-title mt-0"><?=$linha['nome']?></h2>
                            <p class="section-paragraph mb-0"><?=$linha['descricao']?></p>
                        </div>
						<div class="pricing-tables-wrap">
                            <div class="pricing-table">
                                <div class="pricing-table-inner is-revealing">
                                    <div class="pricing-table-main">
                                        <div class="pricing-table-header pb-24">
                                            <div class="pricing-table-price"><span class="pricing-table-price-currency h2">R$</span><span class="pricing-table-price-amount h1"><?=$linha['preco']?></span></div>
                                        </div>
										<div class="pricing-table-features-title text-xs pt-24 pb-24" ><img src="<?=$linha['img']?>" width="150px"></div>
                                        <ul class="pricing-table-features list-reset text-xs">
                                            <li>
                                                <span>Cachorros</span>
                                            </li>
                                            <li>
                                                <span>Gatos</span>
                                            </li>
                                            <li>
                                                <span>Aves</span>
                                            </li>
											<li>
												<span>Peixes</span>
											</li>
                                        </ul>
                                    </div>
                                    <div class="pricing-table-cta mb-8" >
                                        <form method="post"><div class="hero-cta"><button class="button button-primary" name="button" value="<?=$_GET['idProduto']?>">Adicionar ao Carrinho</button></div></form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

			<section class="cta section">
				<div class="container">
					<div class="cta-inner section-inner">
						<h3 class="section-title mt-0">Quer acessar o seu carrinho?</h3>
						<div class="cta-cta">
							<a class="button button-primary button-wide-mobile" href="carrinho.php">Clique Aqui</a>
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
							<img class="header-logo-image" src="contents/dist/images/logo.svg" alt="Logo">
						</a>
                    </div>
                    <div class="footer-copyright">&copy; 2021 Leandro Vitorino e Juan Silva, Todos os direitos reservados</div>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="contents/dist/js/main.min.js"></script>
</body>
</html>