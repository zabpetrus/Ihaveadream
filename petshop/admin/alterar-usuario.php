<?php
	error_reporting(0);
	session_start();

	include_once "config/conexao.php";
	include_once "funcoes/funcoes.php";

	$sql = "SELECT * FROM `ps_login` WHERE `id` = '$_POST[idLogin]'";
	$dados = mysqli_query($conn, $sql) or die(mysql_error());
	$linha = mysqli_fetch_assoc($dados);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>5PJS - Projeto de Sistemas | Petshop</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="contents/css/style.css">
		<link rel="icon" type="image/x-icon" href="contents/images/favicon.ico">

		<!--===============================================================================================-->
		  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<!--===============================================================================================-->
	</head>
	<body>
		
		<?php include_once "menu.php"; ?>

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
					<h3>Cadastre-se</h3>
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
						<div class="form-wrapper">
							<label for="senha">Nível de Acesso *</label>
							<?php 
							if($linha['niveis_acesso_id'] == 1){
								echo "<input type='radio' name='nivelAcesso' value='1' checked> Administrador";
								echo "<input type='radio' name='nivelAcesso' value='2'> Assinante";
							}else{
								echo "<input type='radio' name='nivelAcesso' value='1'> Administrador";
								echo "<input type='radio' name='nivelAcesso' value='2' checked> Assinante";
							}
							?>
						</div>
					<button name="id" value="<?=$linha['id']?>" data-text="Atualizando">
						<span>Atualizar</span>
					</button>
				</form>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<script src="contents/js/main.js"></script>
		
	</body>
</html>