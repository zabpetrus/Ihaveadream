<?php

	session_start();

	include_once "../admin/config/conexao.php";
	include_once "../admin/funcoes/funcoes.php";

	

	if (isset($_SESSION['login'])){

		$busca = "SELECT * FROM `ps_pedidos` WHERE `idLogin` = '$_SESSION[usuarioId]' ORDER BY `id`";

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

		$limite = mysqli_query($conn, "$busca LIMIT $inicio,$total_reg");
		$todos = mysqli_query($conn, "$busca");

		$tr = mysqli_num_rows($todos); // verifica o número total de registros
		$tp = $tr / $total_reg; // verifica o número total de páginas
		$fim = intval($tp);
?>
	<!DOCTYPE html>
	<html lang="pt_br">
	<head>
		<title>5PJS - Projeto de Sistemas | Petshop | Pedidos </title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="contents/images/favicon.ico"/>
		<link rel="stylesheet" href="contents/css/pedidos.styles.css" />
		<!-- CSS only -->
		<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	</head>
	<body>
		<?php include_once "menu.php";  ?>

		<div class="container-fluid">

			<div class="row">

				<div class="col-md-10 container">

					<?php
						if(array_key_exists('button', $_POST)) {
							if ($_POST['button'] == 2){
								cancelarPedido($_POST['remover'] , $conn);
							}else if ($_POST['button'] == 3){
								header("Location: boleto.php");
							}
						}
					?>

					<h2 class="mt-5 mb-5 text-light" >Pedidos</h2>

					<div class="p-4 bg-light">
					
							<div class="mb-3">

								<form method="POST">

									<table id="pedidos" class="table">

										<thead>
											<tr>
												<th>-</th>	
												<th>Nome</th>								
												<th>Endereço</th>
												<th>Produto</th>
												<th>Data do Pedido</th>
											</tr>									
										</thead>

										<tbody>

										<?php
											// se o número de resultados for maior que zero, mostra os dados
											if($tr > 0) {
												// inicia o loop que vai mostrar todos os dados
												while($linha = mysqli_fetch_assoc($limite)){
													
													$sql = "SELECT * FROM `ps_login` WHERE `id` = '$linha[idLogin]'";
													$query = mysqli_query($conn, $sql);
													$dados = mysqli_fetch_assoc($query);

													$sql2 = "SELECT * FROM `ps_produtos` WHERE `id` = '$linha[idProduto]'";
													$exec = mysqli_query($conn, $sql2);
													$produto = mysqli_fetch_assoc($exec);
										?>

											<tr>
												<td>
													<input type="radio" name="remover" value="<?=$linha['id']?>">
												</td>

												<td data-title="Nome">													
													<?=utf8_encode($dados['nome'])?>
												</td>

												<td data-title="Endereço" >
													<?=utf8_encode($dados['endereco'])?>
												</td>

												<td data-title="Produto">
													<?=utf8_encode($produto['nome'])?>
												</td>

												<td data-title="Data do Pedido">
													<?=$linha['data']?>
												</td>
											</tr>
										<?php												
												}// finaliza o loop que vai mostrar os dados											
										?>

										</tbody>
									</table >

									<!-- Botões -->
									<div class="text-center mt-3">
											<button type="button" class="btn btn-danger"  value="2" >Cancelar Pedido</button>
											<button type="button" class="btn btn-secondary" disabled >-</button>
											<button type="button" class="btn btn-success" value="3">Gerar Boleto</button>						
									</div>
									
									<?php
									
										} //endif  
										else{
									?>

									<div class="text-center">
										<p class="p-3 bg-primary text-light">Não há nenhum pedido ainda! </p>
									<?php } ?>
																		
								</form>	

							</div>						
						
						<!-- Paginação -->
						<div class="text-center">

							<form class="mx-auto" method="GET">									
								<?php
									$anterior = $pc -1;
									$proximo = $pc +1;

									if($_GET['pagina']!=1){
									echo " <a href='?pagina=1'> <button type='button' class='btn btn-secondary'> Primeira Página </button></a>";
									echo " "." ";
									}
									if ($pc>1) {
									echo " <a href='?pagina=$anterior'> <button type='button' class='btn btn-secondary'><- Anterior</button></a> ";
									}
									echo " "." ";
									if ($pc<$tp) {
									echo " <a href='?pagina=$proximo'> <button type='button' class='btn btn-secondary'>Próxima -></button></a> ";
									}
									echo " "." ";
									if ($tp >$fim){
										$fim=$fim+1;
									}
									if($_GET['pagina']!=$fim){
									echo " <a href='?pagina=$fim'> <button type='button' class='btn btn-secondary'> Última Página </button> </a>";
									}
								?>									
							</form>

						</div>

					</div> <!-- end bg-light -->

				</div>	<!-- end col-md-8 container -->
				
			</div>	<!-- end row -->							
						
		</div> <!-- end container-fluid -->			


		<!-- JavaScript Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript">

			$(document).ready(function() {
				$('#pedidos').DataTable({
					pageLength : 5,
					lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']]
				});
			});

		</script>
	</body>
	</html>
<?php 
		}else{
			header("Location: ../exit.php");
		} 
?>