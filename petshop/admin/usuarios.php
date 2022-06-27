<?php

	session_start();

	include_once "config/conexao.php";
	include_once "funcoes/funcoes.php";
	$sql = "SELECT * FROM `ps_login`";
	$dados = mysqli_query($conn, $sql) or die(mysql_error($conn));
	$tr = mysqli_fetch_assoc($dados);

	if(array_key_exists('button', $_POST)) {
	    if ($_POST['button'] == 3){
	    	removerUsuario($_POST['idLogin'], $conn);
	    }
	}

	if ($_SESSION['usuarioNiveisAcessoId'] != 1){
		header("Location: ../usuario.php");
	}else{

?>
		<!DOCTYPE html>
		<html lang="pt_br">
		<head>
		<title>5PJS - Projeto de Sistemas | Petshop | Usuários </title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="contents/images/icons/favicon.ico"/>
		<link rel="stylesheet" href="contents/css/usuarios.style.css" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

		</head>
		<body>
		<?php include_once "menu.php";  ?>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8 mx-auto">
					<div class="p-2">
						<h2 class="mt-5 mb-5" >Usuários</h2>

							<div class="bg-light p-3">
								
								<form method="POST" >
					
									<table class="table">

										<thead>
											<tr>
												<th class="cell">Nome</th>								
												<th class="cell">E-mail</th>
												<th class="cell">Telefone</th>
												<th class="cell">Nivel de Acesso</th>
											</tr>
										</thead>

										<tbody>
										<?php
											//******************************************************************* */
											// se o número de resultados for maior que zero, mostra os dados
											if($tr > 0) {
												// inicia o loop que vai mostrar todos os dados
												while($linha = mysqli_fetch_assoc($dados)){

													if($linha['niveis_acesso_id'] == 1){
														$linha['niveis_acesso_id'] = "Administrador";
													}else{
														$linha['niveis_acesso_id'] = "Assinante";
													}
											//**************************************************************** */
										?>

											<tr>
												<td class="cell" data-title="Nome">
													<input type="radio" name="idLogin" value="<?=$linha['id']?>">
													<?=$linha['nome']?>	
												</td>								
												<td class="cell" data-title="E-mail" >
													<?=$linha['email']?>
												</td>
												<td class="cell" data-title="Telefone" >
													<?=$linha['telefone']?>
												</td>
												<td class="cell" data-title="Nível de Acesso" >
													<?=$linha['niveis_acesso_id']?>
												</td>
											</tr>

										<?php
												// finaliza o loop que vai mostrar os dados
												}
											}
										?>
										</tbody>
									</table>
									
									<div class="d-flex flex-row justify-contents-center">										
									
										<div class="mx-auto">
											<button class="btn btn-primary p-2" formaction="alterar-usuario.php" value="2">
												Alterar Usuário
											</button>	
										
											<button class="btn btn-secondary p-2" name="button" disabled>
												&nbsp;
											</button>									
										
											<button class="btn btn-success p-2" name="button" value="3">
												Remover Usuário
											</button>
										</div>	
									</div>
								
								</form>
							</div>	
					</div>
				</div>
			</div>
		</div>

		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		</body>
		</html>
<?php
	}
?>