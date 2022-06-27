<?php

	session_start();

	include_once "../admin/config/conexao.php";
	include_once "../admin/funcoes/funcoes.php";

	if( (isset($_POST['nome'])) && (isset($_POST['pet'])) && (isset($_POST['tel'])) && (isset($_POST['email'])) && (isset($_SESSION['data'])) && (isset($_POST['hora'])) ){
		$agendamento = agendar($_POST['nome'], $_POST['pet'], $_POST['tel'], $_POST['email'], $_SESSION['data'], $_POST['hora'], $conn);

		if($agendamento == true){
			?>
			<script type="text/javascript">
				alert('Agendamento efetuado com sucesso!');
				location.href = "agendamento.php";
			</script>
			<?php
		}else{
			?>
			<script type="text/javascript">
				alert('Erro no processamento, tente novamente!');
				location.href = "agendamento.php";
			</script>
			<?php
		}
	}else{
		?>
		<script type="text/javascript">
			alert('Preencha todos os dados!');
			location.href = "agendamento.php";
		</script>
		<?php
	}

?>