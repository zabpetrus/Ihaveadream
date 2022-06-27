<!doctype html>
<html lang="pt-br">
  <head>
  	<title>5PJS - Projeto de Sistemas | Petshop | Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="contents/css/style.css">
		<link rel="icon" type="image/x-icon" href="contents/images/favicon.ico">

	</head>
	<body class="img js-fullheight" style="background-image: url(contents/images/bg.jpg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">

				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login</h2>
				</div>

			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Tem uma conta?</h3>
		      	<form action="validar-login.php" class="signin-form" method="POST">

		      		<div class="form-group">
		      			<input type="text" name="email" class="form-control" placeholder="E-mail" required>
		      		</div>

	            <div class="form-group">
	              <input id="password-field" name="senha" type="password" class="form-control" placeholder="Senha" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>

	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Entrar</button>
	            </div>

	            <div class="form-group d-md-flex">
	            	<div class="w-50">
		            	<label class="checkbox-wrap checkbox-primary">Lembre-Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
								</div>

								<div class="w-50 text-md-right">
									<a href="esqueci-senha.php" style="color: #fff">Esqueci a Senha</a>
								</div>
	            </div>
	            <p><br> Não possui cadastro?  <a href="../cadastrar.php"> Clique aqui!</a></p>
	          </form>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="contents/js/jquery.min.js"></script>
  <script src="contents/js/popper.js"></script>
  <script src="contents/js/bootstrap.min.js"></script>
  <script src="contents/js/main.js"></script>

	</body>
</html>
