<?php

	session_start();

	include_once "config/conexao.php";
	include_once "funcoes/funcoes.php";



		if (isset($_SESSION['login'])){

			$data = date("Y-m-d");

			$busca = "SELECT * FROM `ps_agendamentos` WHERE `data` >= '$data' ORDER BY `id`";

			//**** start Paginação **** */

			$total_reg = "25"; // número de registros por página
			if (empty($_GET['pagina'])) {
				$_GET['pagina']=1;
			}
			$pagina=$_GET['pagina'];
			if (!$pagina) {
			$pc = "1";
			} else {
			$pc = $pagina;
			}

			$inicio = $pc - 1;
			$inicio = $inicio * $total_reg;

			//**** end Paginação **** */

			$limite = mysqli_query($conn, "$busca LIMIT $inicio,$total_reg");
			$todos = mysqli_query($conn, "$busca");

			$tr = mysqli_num_rows($todos); // verifica o número total de registros
			$tp = $tr / $total_reg; // verifica o número total de páginas
			$fim = intval($tp);
?>
			<!DOCTYPE html>
			<html lang="pt_br">
			<head>
			<title>5PJS - Projeto de Sistemas | Petshop</title>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="icon" type="image/x-icon" href="contents/images/favicon.ico">
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
			<link rel="stylesheet" href="contents/css/agendamento.style.css" >

			</head>
			<body>
			<?php include_once "menu.php"; ?>

			<?php
				if(array_key_exists('button', $_POST)) {
					if ($_POST['button'] == 2){
						cancelarConsulta($_POST['remover'] , $conn);
					}
				}
			?>
			
			<div class="container-fluid">

				<div class="row">

					<div class="container col-md-8">

						<h2 class="mt-5 mb-5" >Agendamentos</h2>

						<div class="bg-light p-4">

							<form method="POST">
							
								<table class="table">

									<thead>
										<tr>
											<th>-</th>
											<th class="cell">Nome</th>								
											<th class="cell">Telefone</td>
											<th class="cell">Data</th>
											<th class="cell">Hora</th>
										</tr>
									</thead>

									<tbody>
									<?php
										// se o número de resultados for maior que zero, mostra os dados
										if($tr > 0) {
											// inicia o loop que vai mostrar todos os dados
											while($linha = mysqli_fetch_assoc($limite)){
									?>

										<tr>
											<td>
												<input type="radio" name="remover" value="<?=$linha['id']?>">
											</td>

											<td class="cell" data-title="Nome">
												<?=utf8_encode($linha['nome'])?>
											</td>

											<td class="cell" data-title="Telefone">
												<?=$linha['tel']?>
											</td>

											<td class="cell" data-title="Data" >
												<?=$linha['data']?>
											</td>

											<td class="cell" data-title="Hora">
												<?=$linha['hora']?>h
											</td>
										</tr>
									<?php
											// finaliza o loop que vai mostrar os dados
											}
										}
									?>
									</tbody>
								</table>

								<div class="text-center">
									<button class="btn btn-danger" name="button" value="2">
										Cancelar Agendamento
									</button>
								</div>										
							</form>

						</div>
						

						<form method="GET"> <!-- Navgation php/bootstrap -->

							<nav aria-label="Page navigation example">
								<ul class="pagination justify-content-center">							
									<?php					
										$anterior = $pc -1;
										$proximo = $pc +1;

										if($_GET['pagina']!=1){
										echo "<li class='page-item'><a class='page-link' href='?pagina=1'> Primeira Página </a></li>";
										echo " "." ";
										}
										if ($pc>1) {
										echo "<li class='page-item'><a class='page-link' href='?pagina=$anterior'>Anterior </a></li>";
										}
										echo " "." ";
										if ($pc<$tp) {
										echo "<li class='page-item'><a class='page-link' href='?pagina=$proximo'> Próxima </a></li>";
										}
										echo " "." ";
										if ($tp >$fim){
											$fim=$fim+1;
										}
										if($_GET['pagina']!=$fim){
										echo "<li class='page-item'><a class='page-link' href='?pagina=$fim'> Última Página </a></li>";
										}
									?>
								</ul>
							</nav>

						</form>

					</div>

				</div>

			</div>

			
			
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
			<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>



			</body>
			</html>
<?php 
		}else{
			header("Location: ../exit.php");
		} 
?>