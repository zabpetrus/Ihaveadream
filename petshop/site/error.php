<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Error</title>
</head>
<body>
	<script>
		//alert("Erro!");
		//window.redirect.replace("index.php");
	</script>
	<?php
error_reporting(E_ALL);

$conn = mysqli_connect("localhost", "root", "823543", "petshop");

$sql = "SELECT * FROM `ps_carrinho` WHERE `idLogin` = 8";
$todos = mysqli_query($conn, $sql);
$tr = mysqli_num_rows($todos);

if ($tr > 0){
	$data = date("d/m/y");
	while ($linha = mysqli_fetch_assoc($todos)){
		$query = "INSERT INTO `ps_pedidos` (`idLogin`, `idProduto`, `data`) VALUES ('$linha[idLogin]', '$linha[idProduto]', '$data')";
		if(!mysqli_query($conn, $query)){
			die('Error: ' . mysqli_error($conn));
		}else{
			
			removerEstoque($conn, $linha['idProduto'], $linha['Quantidade'] );

			$deletar = "DELETE FROM `ps_carrinho` WHERE `id` = '$linha[id]'";
			if(!mysqli_query($conn, $deletar)){
				?>
				<script type="text/javascript">
					alert('Erro no processamento, tente novamente!');
					location.href = "carrinho.php";
				</script>
				<?php
			}else{
				?>
				<script type="text/javascript">
					alert('Compra confirmada com sucesso!');
					location.href = "boleto.php";
				</script>
				<?php
			}
		}
	}
}


 ?>
</body>
</html>