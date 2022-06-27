<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Pet Shop - 5PJS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="contents/fonts/linearicons/style.css">
		<link rel="icon" type="image/png" href="contents/images/favicon.ico"/>
		<link rel="stylesheet" href="contents/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
		<link rel="stylesheet" href="contents/vendor/date-picker/css/datepicker.min.css">
		<link rel="stylesheet" href="contents/css/style.css">
		
		<!--===============================================================================================-->
		  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

		<!--===============================================================================================-->
	</head>
	<body>
		<script type="text/javascript">
			$(document).ready(function () { 
	        	var $seuCampoCpf = $("input#CPF");
	        	$seuCampoCpf.mask('000.000.000-00', {reverse: false});

	        	var $seuCampoTel = $("input#TEL");
	        	$seuCampoTel.mask('(00) 000000000', {reverse: false});
    		});
		</script>
		<div class="wrapper">
			<div class="inner">
				
				<form action="actions/cadastrar-usuario.php" method="POST">
					<h3>Cadastre-se</h3>
					<div class="form-row">
						<div class="form-wrapper">
							<label for="nome">Nome *</label>
							<input type="text" name="nome" class="form-control" placeholder="Seu nome" required>
						</div>
						<div class="form-wrapper">
							<label for="telefone">Telefone *</label>
							<input type="text" name="telefone" id="TEL" class="form-control" placeholder="Telefone" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-wrapper">
							<label for="endereco">Endereço *</label>
							<input type="text" name="endereco" class="form-control" placeholder="Endereço" required>
						</div>
						<div class="form-wrapper">
							<label for="data">Data de Nascimento *</label>
							<input type="date" name="data" class="form-control" placeholder="Data de Nascimento" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-wrapper">
							<label for="email">E-mail *</label>
							<input type="text" name="email" class="form-control" placeholder="E-mail" required>
						</div>
						<div class="form-wrapper">
							<label for="cpf">CPF *</label>
							<input type="text" name="cpf" id="CPF" class="form-control" placeholder="CPF" maxlength="14" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-wrapper">
							<label for="senha">Senha *</label>
							<input type="password" name="senha" class="form-control" placeholder="Senha">
						</div>
						<div class="form-wrapper">
							<label for="confirmar-senha">Confirme a Senha *</label>
							<input type="password" name="confirmar-senha" class="form-control" placeholder="Senha">
						</div>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="robo" value="1"> Eu não sou um robô ;)
							<span class="checkmark"></span>
						</label>
					</div>
					<button data-text="Cadastrando">
						<span>Cadastrar</span>
					</button>
					<br>
					<a href="admin/"> Já possuo login</a>
				</form>
			</div>
		</div>
		
		<script src="vendor/date-picker/js/datepicker.js"></script>
		<script src="vendor/date-picker/js/datepicker.en.js"></script>
		<script src="js/main.js"></script>
		
	</body>
</html>