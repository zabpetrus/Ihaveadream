<?php
	
	session_start();
	include_once "config/conexao.php";
	include_once "funcoes/funcoes.php";

	if( (isset($_POST['nome'])) && (isset($_POST['telefone'])) && (isset($_POST['endereco'])) && (isset($_POST['data'])) && (isset($_POST['email'])) && (isset($_POST['nivelAcesso'])) ){

		if(!empty($_POST['senha'])){
		
			if ($_POST['senha'] != $_POST['confirmar-senha']){
				?>
				<script type="text/javascript">
					alert('As senhas não conferem, tente novamente!');
					location.href = "usuarios.php";
				</script>
				<?php
				return;
			}
		}else{
			$_POST['senha'] = "vazia";
		}
		
		$atualizando = atualizarUsuarioAdmin($conn, $_POST['nome'], $_POST['telefone'], $_POST['endereco'], $_POST['data'], $_POST['email'], $_POST['senha'], $_POST['nivelAcesso'], $_POST['id']);

		if($atualizando == true){
			header("Location: usuarios.php");
		}else{
			?>
			<script type="text/javascript">
				alert('Ocorreu algum erro, tente novamente!');
				location.href = "usuarios.php";
			</script>
			<?php
		}
	}else{
		?>
		<script type="text/javascript">
			alert('Os dados não foram preenchidos, verifique novamente!');
			location.href = "usuario.php";
		</script>
		<?php
	}

?>