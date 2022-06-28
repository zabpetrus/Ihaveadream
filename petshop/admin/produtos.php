<?php

	session_start();

	include_once "config/conexao.php";
	include_once "funcoes/funcoes.php";


		if (isset($_SESSION['login'])){

			$busca = "SELECT * FROM `ps_produtos` ORDER BY `nome`";

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
<title>5PJS - Projeto de Sistemas | Petshop | Produtos </title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="contents/images/icons/favicon.ico"/>
<link rel="stylesheet" href="contents/css/produtos.style.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php include_once "menu.php"; ?>
<?php
			if(array_key_exists('button', $_POST)) {
			    if ($_POST['button'] == 2){
			    	$remocao = removerProduto($_POST['remover'] , $conn);
			    	if ($remocao == true){
			    		?>
			    		<script type="text/javascript">
			    			alert('Produto removido com sucesso!');
			    			location.href "produtos.php";
			    		</script>
			    		<?php
			    	}else{
			    		?>
			    		<script type="text/javascript">
			    			alert('Erro no processamento, tente novamente!');
			    			location.href "produtos.php";
			    		</script>
			    		<?php
			    	}
			    }else if ($_POST['button'] == 3){
			    	header("location: cadastrar-produto.php");
			    }
			}
?>

<div class="container-fluid">
	<div class="row">

		<div class="col-md-8 container">

			<div class="d-flex justify-content-between flex-row align-items-center">
				<h2 class="mt-5 mb-5 text-light" >Produtos</h2>
				<div><a href="cadastrar-produto.php" class="btn btn-primary">Cadastrar Produto</a></div>
			</div>
			

			<div class="bg-light p-3">
				<form method="POST">

					<table class="table">
						<thead>
							<tr>
								<th class="cell">&nbsp;</th>	
								<th class="cell">Nome</th>								
								<th class="cell">Preço</th>
								<th class="cell">Estoque</th>
								<th class="cell">Descrição</th>
							</tr>
						</thead>
						<tbody>

							<?php
							//******************************************************************** */
								// se o número de resultados for maior que zero, mostra os dados
								if($tr > 0) {
									// inicia o loop que vai mostrar todos os dados
									while($linha = mysqli_fetch_assoc($limite)){

							//****************************************************** */
							?>

							<tr>
								<td class="cell"><input type="radio" name="remover" value="<?=$linha['id']?>"></td>
								<td class="cell" data-title="Nome">									
									<?=utf8_encode($linha['nome'])?>
									</td>								
								<td class="cell" data-title="Endereço" >
									<?=$linha['preco']?>
								</td>
								<td class="cell" data-title="Produto" >
									<?=$linha['qtd']?>
								</td>
								<td class="cell" data-title="Data do Pedido" >
									<?=utf8_encode($linha['descricao'])?>
								</td>
							</tr>
							<?php
									// finaliza o loop que vai mostrar os dados
									}
								}
							?>
						</tbody>
					</table>

					<div class="d-flex justify-contents-center">
						<div class="mx-auto">
							<button class="btn btn-primary"  name="button" value="2">
								Remover Produto
							</button>

							<button class="btn btn-secondary"  name="button" disabled></button>
							
							<button class="btn btn-success"  name="button" value="3">
								Cadastrar Produto
							</button>
						</div>
					</div>

				</form>

				<form method="GET">
								
											<?php
												$anterior = $pc -1;
												$proximo = $pc +1;

												if($_GET['pagina']!=1){
												echo " <a href='?pagina=1'> <button type='button' class='contact100-form-btn'> Primeira Página </button></a>";
												echo " "." ";
												}
												if ($pc>1) {
												echo " <a href='?pagina=$anterior'> <button type='button' class='contact100-form-btn'><- Anterior</button></a> ";
												}
												echo " "." ";
												if ($pc<$tp) {
												echo " <a href='?pagina=$proximo'> <button type='button' class='contact100-form-btn'>Próxima -></button></a> ";
												}
												echo " "." ";
												if ($tp >$fim){
													$fim=$fim+1;
												}
												if($_GET['pagina']!=$fim){
												echo " <a href='?pagina=$fim'> <button type='button' class='contact100-form-btn'> Última Página </button> </a>";
												}
											?>
									
									</form>



						</div>
					<div>
				</div>

			</div> <!-- end bg-light p-3 -->

		</div><!-- end col-md-8 container -->

	</div><!-- end row -->

</div><!-- end container-fluid -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
<?php 
		}else{
			header("Location: ../exit.php");
		} 
?>