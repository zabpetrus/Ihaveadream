<?php

	session_start();
	
	if($_SESSION['usuarioNiveisAcessoId'] != "1"){
		header("Location: ../site/");
		}else{
		
		if(isset($_SESSION['login'])){
		    
		?>
			<!DOCTYPE html>
			<html lang="pt-br" class="no-js">
			<head>
			    <meta charset="utf-8">
			    <meta http-equiv="X-UA-Compatible" content="IE=edge">
			    <meta name="viewport" content="width=device-width, initial-scale=1">
			    <title>5PJS - Projeto de Sistemas | Petshop</title>
			    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,600" rel="stylesheet">
				<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
				<link rel="icon" type="image/x-icon" href="contents/images/favicon.ico">

			    <link rel="stylesheet" href="contents/dist/css/style.css">
			    <link rel="stylesheet" type="text/css" href="contents/css/estilo.css">
				<script src="https://unpkg.com/animejs@3.0.1/lib/anime.min.js"></script>
			    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
			</head>
			<body class="is-boxed has-animations">

				<?php include_once "menu.php"; ?>
			
			    <div class="body-wrap">
			        <header class="site-header">
			            <div class="container">
			                <div class="site-header-inner">
			                    <div class="brand header-brand">
			                        <h1 class="m-0">
										<a href="administrativo.php">
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
				                        <h1 class="hero-title mt-0">Administração</h1>
				                        <p class="hero-paragraph">"Seja sempre bem vindo!".</p>
				                        <div class="hero-cta"><a class="button button-primary" href="produtos.php">Produtos</a><a class="button" href="pedidos.php">Pedidos</a></div>
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

						<section class="cta section">
							<div class="container">
								<div class="cta-inner section-inner">
									<h3 class="section-title mt-0">Quer analisar os agendamentos?</h3>
									<div class="cta-cta">
										<a class="button button-primary button-wide-mobile" href="agendamento.php">Clique Aqui</a>
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
			                    <div class="footer-copyright">&copy; 2022 Izabel Souza e Juan Silva, Todos os direitos reservados</div>
			                </div>
			            </div>
			        </footer>
			    </div>
			    <script src="contents/dist/js/main.min.js"></script>
				<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

			</body>
			</html>
	<?php

		}else{
			?>
			<script type="text/javascript">
				alert('Permissão não autorizada, efetue o login novamente!');
				window.location= "login_page.php";
			</script>
			<?php
		}
	}
?>