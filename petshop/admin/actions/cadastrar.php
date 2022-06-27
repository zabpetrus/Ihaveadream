<?php

	session_start();

	include_once "../config/conexao.php";
	include_once "../funcoes/funcoes.php";

	$file = $_FILES["img"];

	if( (!empty($_POST['nome'])) && (!empty($_POST['descricao'])) && (!empty($_POST['preco'])) && (!empty($_POST['qtd'])) && (isset($_FILES['img'])) ){

		$sql = "SELECT * FROM `ps_produtos` ORDER BY `id` DESC LIMIT 1";
		$dados = mysqli_query($conn, $sql) or die(mysql_error($conn));
		$linha = mysqli_fetch_assoc($dados);
		

		$exec = cadastrarProduto($_POST['nome'], $_POST['descricao'], $_POST['preco'], $_POST['qtd'], $_FILES['img'], $linha['id'], $conn);

		if($exec == true){
			?>
			<script type="text/javascript">
				alert('Produto cadastrado com sucesso!');
				location.href = "../produtos.php";
			</script>
			<?php
		}else{
			?>
			<script type="text/javascript">
				alert('Erro no processamento, tente novamente!'. $exec );
				location.href = "../cadastrar-produto.php";
			</script>
			<?php
		}
	}else{

		?>
		<script type="text/javascript">
			alert('É necessário informar todos os dados!');
			location.href = "../cadastrar-produto.php";
		</script>
		<?php
	}

?>