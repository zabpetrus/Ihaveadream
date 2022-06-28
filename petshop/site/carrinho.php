<?php
	error_reporting(0);
	session_start();

	include_once "../admin/config/conexao.php";
	include_once "../admin/funcoes/funcoes.php";

	include_once "menu.php";

	$carrinho = checkCarrinho($_SESSION['usuarioId'], $conn);

	if($carrinho == false){
		?>
		<script type="text/javascript">
			alert('Seu carrinho está vazio! Efetue as compras em nosso site :)');
			location.href = "index.php";
		</script>
		<?php
	}else{

		if (isset($_SESSION['login'])){

			$busca = "SELECT * FROM `ps_produtos` ORDER BY nome";

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
			$fim = intval($tp); //intval = função do php que retorna o valor inteiro da variável
?>
			<!DOCTYPE html>
			<html lang="pt_br">
			<head>
			<title>5PJS - Projeto de Sistemas | Petshop | Carrinho</title>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="icon" type="image/png" href="contents/images/icons/favicon.ico"/>
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
			<link rel="stylesheet" href="contents/css/carrinho.style.css" />
			</head>
			<body>

			<?php
			//PHP Script start here
			
				if(array_key_exists('button', $_POST)) {

					if(($_POST['button'] == 1 )){
						removerProdutoCarrinho($_SESSION['usuarioId'], $_POST['remover'], $conn);
					}else if ( ($_POST['button'] == 2 )){
						esvaziarCarrinho($_SESSION['usuarioId'] , $conn);
					}else if (($_POST['button'] == 3) ){						
						confirmarCompra($_SESSION['usuarioId'], $conn);						
					}
					
				}
			//PHP Script end here
			?>

			<div class="container-fluid">
				<div class="row">
					<div class="col-md-10 mx-auto bg-car">

						<h2>Meu Carrinho</h2>

						<div class="carrinho">

							<div class="p-0">
								<form method="POST">								
									
									<div class="p-2">
										
											<table class="table"><!-- start table -->

												<thead>
													<tr>
													<th scope="col">-</th>
													<th scope="col">Nome</th>								
													<th scope="col">Preço</th>
													<th scope="col">Estoque</th>
													<th scope="col">Descrição</th>
													<th scope="col">Quantidade</th>
													</tr>
												</thead>
												<tbody>
												<?php
													// ************************************************************
													// se o número de resultados for maior que zero, mostra os dados
													if($tr > 0) {
														// inicia o loop que vai mostrar todos os dados
														while($linha = mysqli_fetch_assoc($limite)){
															
															$sql = "SELECT * FROM `ps_carrinho` WHERE `idLogin` = '$_SESSION[usuarioId]' && `idProduto` = '$linha[id]'";
															$query = mysqli_query($conn, $sql);
															$dados = mysqli_fetch_assoc($query);

															if($dados['idProduto'] == $linha['id']){ // TEM QUE TER WHILE PARA RODAR OS DADOS DO CARRINHO
													// ***********************************************************************************
												?>
														
													<tr>
														<td class="cell" >																
															<input type="radio" name="remover" value="<?=$dados['idProduto']?>">																
														</td>
														<td data-title="Nome">
															<?=utf8_encode($linha['nome'])?>															
														</td>						
														<td class="cell" data-title="Preço">
															<?=$linha['preco']?>
														</td>
														<td class="cell" data-title="Estoque">
															<?=$linha['qtd']?>
														</td>
														<td class="cell" data-title="Descrição">
															<?=utf8_encode($linha['descricao'])?>
														</td>
														<td class="cell" data-title="Quantidade">
															<?=$dados['Quantidade']?>
														</td>
													</tr>
														
													<?php
														//************************************************************* */
															// finaliza o loop que vai mostrar os dados

																} //endif
																
															}//endwhile
														}
														//************************************************************** */
													?>
												</tbody>
											</table>

											<div class="text-center mt-3">

												<button class="btn btn-primary" name="button" value="2">Esvaziar Lixeira</button>

												<button class="btn btn-danger" name="button" value="1">Remover Produto</button>

												<button class="btn btn-success" name="button"  value="3">Confirmar Compra</button>
											</div>

									</div> <!-- end p-2 -->											

								</form><!-- end form -->		
							</div>	

							<div class="text-center">
								<form method="GET">
									<p>
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
									</p>
									
								</form>		
							</div><!-- end text-center -->							

						</div><!-- end carrinho -->
					</div>
				</div>
			</div>
	
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

			</body>
			</html>
	<?php 
		//end array_key_exists('button', $_POST)
		}else{
			
			header("Location: ../exit.php");
		}
	} 
?>