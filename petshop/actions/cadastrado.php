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
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="utf-8">
				<title>Pet Shop - 4MOD</title>
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<link rel="stylesheet" href="../contents/css/cadastrado.styles.css" />
				<link rel="icon" type="image/x-icon" href="../contents/images/favicon.ico">
										
				<!--===============================================================================================-->
				<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
				<!--===============================================================================================-->
			</head>
			<body class="d-flex h-100 text-center bg-dark">
				
				<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
					<div class="px-3 bg-light">

					<div class="p-5">
						<form action="../admin/login_page.php" action="admin">
							<h3>Cadastrado</h3>
							<div class="form-row">
								<p>Seu cadastro foi realizado com sucesso, efetue o login e confira o nosso site.</p>
							</div>
							<button class="btn btn-primary" data-text="Login">
								<span>Login</span>
							</button>
						</form>
					</div>
						
						
					</div>
				</div>
				
				<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
				<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
				
			</body>
		</html>
		<?php
	}
?>