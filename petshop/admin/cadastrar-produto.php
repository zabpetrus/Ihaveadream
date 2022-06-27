<?php

	session_start();

	include_once "config/conexao.php";
	include_once "funcoes/funcoes.php";	

	if($_SESSION['usuarioNiveisAcessoId'] == "1"){

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>5PJS - Projeto de Sistemas | Petshop</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/x-icon" href="contents/images/favicon.ico">
		<!--===============================================================================================-->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<!--===============================================================================================-->
		<link rel="stylesheet" href="contents/css/cadastrarproduto.style.css" >
		
	</head>
	
	<body>
	<?php include_once "menu.php"; ?>
		<div class="container-fluid">
			<div class="row">

				<div class="col-md-8 mx-auto">


					<h2 class="mt-5 mb-3" >Cadastrar Produto</h2>

					<div class="bg-light">

						<div class="row">
							<div class="col-md-8">
								<form action="actions/cadastrar.php" method="POST" enctype="multipart/form-data">
										
										<div class="p-4">

											<div class="mb-3">
												<label for="nome">Nome *</label>
												<input type="text" name="nome" class="form-control" placeholder="Nome do produto" required>
											</div>

											<div class="mb-3">
												<label for="telefone">Descrição *</label>
												<input type="text" name="descricao" class="form-control" placeholder="Descrição" required>
											</div>
										
											<div class="mb-3">									
												<label for="endereco">Preço *</label>
												<input type="text" name="preco" class="form-control" placeholder="Preço" required>
											</div>

											<div class="mb-3">
												<label for="data">Qtd no Estoque *</label>
												<input type="number" name="qtd" class="form-control" value="100" required>
											</div>
										
											<div class="mb-3">									
												<label for="email">Imagem do Produto *</label>
												<input class="form-control" type="file" name="img" accept="image/*" onchange="generatePreview(event)" required>									
											</div>
											<button class="btn btn-primary" data-text="Cadastrando">
												<span>Cadastrar</span>
											</button>
										</div>
									</form>
									
							</div>
							
							<div class="col-md-3 pt-5" >								
								<div class="setpreview"  >
									<img src="contents/images/preview.png" class="img-fluid" alt="..." id="thumb" >
								</div>								
							</div>

						</div>					
					</div>
				</div>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script type="text/javascript">

			function generatePreview(evt)
			{
				var imagem = document.getElementById('thumb');
				imagem.setAttribute('src', '');

				var reader = new FileReader();
				reader.onload = function(){
					var output = imagem;
					output.src = reader.result;
				};
				reader.readAsDataURL(event.target.files[0]);
			}

		</script>
	</body>
</html>
<?php
	}else{
		header("Location: login_page.php");
	}
?>

