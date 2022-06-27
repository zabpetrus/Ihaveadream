<?php
	
	session_start();
	include_once "../admin/config/conexao.php";
	include_once "../admin/funcoes/funcoes.php";

	if(!isset($_POST['robo']))
	{
	    ?>
	    <script type="text/javascript">
	    	alert('A confirmação não foi efetuada, por gentileza, verifique!');
	    	location.href = "../index.php";
	    </script>
	    <?php
	}else if( ($_POST['senha'] != $_POST['confirmar-senha']) ){
		header("Location: ../index.php");

	}else if( (isset($_POST['nome'])) && (isset($_POST['telefone'])) && (isset($_POST['endereco'])) && (isset($_POST['data'])) && (isset($_POST['email'])) && (isset($_POST['cpf'])) ){
		//$verificar_CPF = validaCPF($_POST['cpf']); // Função para verificar a veracidade do CPF
		$verificar_CPF = true; //Corrigir o algoritmo
		if($verificar_CPF == false){
			?>
			<script type="text/javascript">
				alert('O CPF informado não foi encontrado na Receita Federal.');
				location.href = "../index.php";
			</script>
			<?php
		}else{
			cadastrar($conn, $_POST['nome'], $_POST['telefone'], $_POST['endereco'], $_POST['data'], $_POST['email'], $_POST['cpf'], $_POST['senha']);
			$_SESSION['confirmar-cadastro'] = "Ok"; // Criar a sessão para a página de cadastrado
			header("Location: cadastrado.php");
		}
	}else{
		?>
		<script type="text/javascript">
			alert('Os dados não foram preenchidos, verifique novamente!');
			location.href = "../index.php";
		</script>
		<?php
	}

?>