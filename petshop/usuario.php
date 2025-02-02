<?php

	session_start();

	include_once "admin/config/conexao.php";
	include_once "admin/funcoes/funcoes.php";

	$sql = "SELECT * FROM `ps_login` WHERE `id` = '$_SESSION[usuarioId]'";
	$dados = mysqli_query($conn, $sql) or die(mysql_error());
	$linha = mysqli_fetch_assoc($dados);

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Pet Shop - 4MOD</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="contents/fonts/linearicons/style.css">
		<link rel="stylesheet" href="contents/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
		<link rel="stylesheet" href="contents/vendor/date-picker/css/datepicker.min.css">
		<link rel="stylesheet" href="contents/css/style.css">

		
		<!--===============================================================================================-->
		 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
		 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<!--===============================================================================================-->
	</head>
	<body>
	<?php include_once "menu.php";  ?>
	
		<script type="text/javascript">
			$(document).ready(function () { 
	        	var $seuCampoCpf = $("input#CPF");
	        	$seuCampoCpf.mask('000.000.000-00', {reverse: false});

	        	var $seuCampoTel = $("input#TEL");
	        	$seuCampoTel.mask('(00) 000000000', {reverse: false});

	        	var $seuCampoNasc = $("input#NASC");
	        	$seuCampoNasc.mask('00/00/0000', {reverse: false});
    		});
		</script>
		<div class="wrapper">
			<div class="inner">
				
				<form action="atualizar.php" method="POST">
					<h3>Meus Dados</h3>
					<div class="form-row">
						<div class="form-wrapper">
							<label for="nome">Nome *</label>
							<input type="text" name="nome" class="form-control" value="<?=$linha['nome']?>" required>
						</div>
						<div class="form-wrapper">
							<label for="telefone">Telefone *</label>
							<input type="text" name="telefone" id="TEL" class="form-control" value="<?=$linha['telefone']?>" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-wrapper">
							<label for="endereco">Endereço *</label>
							<input type="text" name="endereco" class="form-control" value="<?=$linha['endereco']?>" required>
						</div>
						<div class="form-wrapper">
							<label for="data">Data de Nascimento *</label>
							<input type="text" name="data" id="NASC" class="form-control" value="<?=$linha['data']?>" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-wrapper">
							<label for="email">E-mail *</label>
							<input type="text" name="email" class="form-control" value="<?=$linha['email']?>" required>
						</div>
						<div class="form-wrapper">
							<label for="cpf">CPF *</label>
							<input type="text" name="cpf" id="CPF" class="form-control" value="<?=$linha['cpf']?>" maxlength="14" disabled >
						</div>
					</div>
					<div class="form-row">
						<div class="form-wrapper">
							<label for="senha">Senha *</label>
							<input type="password" name="senha" class="form-control" placeholder="Senha (Deixe em branco caso não queira alterar)">
						</div>
						<div class="form-wrapper">
							<label for="confirmar-senha">Confirme a Senha *</label>
							<input type="password" name="confirmar-senha" class="form-control" placeholder="Senha (Deixe em branco caso não queira alterar)">
						</div>
					</div>
					<button data-text="Atualizando">
						<span>Atualizar</span>
					</button>
				</form>
			</div>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
			<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		
		<script src="contents/vendor/date-picker/js/datepicker.js"></script>
		<script src="contents/vendor/date-picker/js/datepicker.en.js"></script>
		<script src="contents/js/main.js"></script>
		
	</body>
</html>