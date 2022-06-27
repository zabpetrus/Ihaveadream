<?php
	session_start();

	if(!isset($_SESSION['confirmar-cadastro'])){
		?>
		<script type="text/javascript">
			alert('Efetue o cadastro em nosso site!');
			location.href = "index.php";
		</script>
		<?php
	}else{
		?>
		<html>
			<head>
				<meta charset="utf-8">
				<title>Pet Shop - 4MOD</title>
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<link rel="stylesheet" href="../fonts/linearicons/style.css">
				<link rel="stylesheet" href="../fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
				<link rel="stylesheet" href="../vendor/date-picker/css/datepicker.min.css">
				<link rel="stylesheet" href="../css/style.css">
				
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
						
						<form action="../admin/login_page.php" action="admin">
							<h3>Cadastrado</h3>
							<div class="form-row">
								<p>Seu cadastro foi realizado com sucesso, efetue o login e confira o nosso site.</p>
							</div>
							<button data-text="Login">
								<span>Login</span>
							</button>
						</form>
					</div>
				</div>
				
				<script src="../vendor/date-picker/js/datepicker.js"></script>
				<script src="../vendor/date-picker/js/datepicker.en.js"></script>
				<script src="../js/main.js"></script>
				
			</body>
		</html>
		<?php
	}
?>