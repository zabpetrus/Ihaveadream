<?php

	function senha(){
		$caracteres = "0123456789";
		return substr(str_shuffle($caracteres),5,48);
	}

	function cadastrar($conn, $nome, $telefone, $endereco, $data, $email, $cpf, $senha){
		$nome = strtolower($nome);
		$nome = ucwords($nome);
		$email = strtolower($email);

		$sql = "INSERT INTO `ps_login` (`nome`, `email`, `senha`, `telefone`, `endereco`, `cpf`, `niveis_acesso_id`, `data`) VALUES ('$nome', '$email', MD5('$senha'), '$telefone', '$endereco', '$cpf', '2', '$data')";
		$query = mysqli_query($conn, $sql);
	}

	function atualizarUsuario($conn, $nome, $telefone, $endereco, $data, $email, $senha, $login){
		$nome = strtolower($nome);
		$nome = ucwords($nome);
		$email = strtolower($email);

		if($senha == "vazia"){
			$query = "UPDATE `ps_login` SET `nome` = '$nome', `email` = '$email', `telefone` = '$telefone', `endereco` = '$endereco', `data` = '$data' WHERE `id` = '$login'";
		}else{
			$query = "UPDATE `ps_login` SET `nome` = '$nome', `email` = '$email', `senha` = MD5('$senha'), `telefone` = '$telefone', `endereco` = '$endereco', `data` = '$data' WHERE `id` = '$login'";
		}

		if(!mysqli_query($conn, $query)){
			die('Error: ' . mysqli_error($conn));
	   		return false;
		}else{
			return true;
		}
	}

	function atualizarUsuarioAdmin($conn, $nome, $telefone, $endereco, $data, $email, $senha, $nivelAcesso, $login){
		$nome = strtolower($nome);
		$nome = ucwords($nome);
		$email = strtolower($email);

		if($senha == "vazia"){
			$query = "UPDATE `ps_login` SET `nome` = '$nome', `email` = '$email', `telefone` = '$telefone', `endereco` = '$endereco', `niveis_acesso_id` = '$nivelAcesso', `data` = '$data' WHERE `id` = '$login'";
		}else{
			$query = "UPDATE `ps_login` SET `nome` = '$nome', `email` = '$email', `senha` = MD5('$senha'), `telefone` = '$telefone', `endereco` = '$endereco', `niveis_acesso_id` = '$nivelAcesso', `data` = '$data' WHERE `id` = '$login'";
		}

		if(!mysqli_query($conn, $query)){
			die('Error: ' . mysqli_error($conn));
	   		return false;
		}else{
			return true;
		}
	}

	function validaCPF($cpf) {
		// Verifica se um número foi informado
		if(empty($cpf)) {
			return false;
		}
		// Elimina possivel mascara
		$cpf = preg_replace("/[^0-9]/", "", $cpf);
		$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

		// Verifica se o numero de digitos informados é igual a 11 
		if (strlen($cpf) != 11) {
			return false;
		}
		// Verifica se nenhuma das sequências invalidas abaixo 
		// foi digitada. Caso afirmativo, retorna falso
		else if ($cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
			return false;
		 // Calcula os digitos verificadores para verificar se o CPF é válido
		 }else{
			for ($t = 9; $t < 11; $t++) {
				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{$c} * (($t + 1) - $c);
				}
				$d = ((10 * $d) % 11) % 10;
				if ($cpf{$c} != $d) {
					return false;
				}
			}
			return true;
		}
	}

	//Alteração: Adição da coluna quantidade

	function adcCarrinho($produto, $usuario, $quantidade, $conn){

		$sql = "INSERT INTO `ps_carrinho` (`idProduto`, `idLogin`, `Quantidade`) VALUES ('$produto', '$usuario', '$quantidade')";
		if (!mysqli_query($conn, $sql))
		{
   			die('Error: ' . mysqli_error($conn));
   			return false;
		}else{
			return true;
		}
	}

	function checkEstoque($produto, $conn){
		$sql = "SELECT * FROM `ps_produtos` WHERE `id` = '$produto'";
		$dados = mysqli_query($conn, $sql) or die(mysql_error());
		$linha = mysqli_fetch_assoc($dados);

		if($linha['qtd'] <= 0 ){
			return false;
		}else{
			return $linha['qtd'];
		}
	}

	function checkCarrinho($usuario, $conn){
		$sql = "SELECT * FROM `ps_carrinho` WHERE `idLogin` = '$usuario'";
		$dados = mysqli_query($conn, $sql) or die(mysql_error());
		$linha = mysqli_fetch_assoc($dados);
		$total = mysqli_num_rows($dados);

		if ($total > 0){
			return true;
		}else{
			return false;
		}
	}

	function esvaziarCarrinho($login, $conn){
		$sql = "DELETE FROM `ps_carrinho` WHERE `idLogin` = '$login'";
		if(!mysqli_query($conn, $sql)){
			die('Error: ' . mysqli_error($conn));
		}else{
			?>
			<script type="text/javascript">
				alert('Seu carrinho está vazio! Efetue as compras em nosso site :)');
				location.href = "index.php";
			</script>
			<?php
		}
	}

	function removerProdutoCarrinho($login, $produto, $conn){
		if(empty($produto)){
			?>
			<script type="text/javascript">
				alert('Selecione o produto que deseja remover!');
				location.href = "#";
			</script>
			<?php
		}else{
			$sql = "DELETE FROM `ps_carrinho` WHERE `idLogin` = '$login' && `idProduto` = '$produto'";
			if(!mysqli_query($conn, $sql)){
				die('Error: ' . mysqli_error($conn));
			}else{
				?>
				<script type="text/javascript">
					alert('Produto removido do seu carrinho!');
					location.href = "#";
				</script>
				<?php
			}
		}
	}

	//Alteração: Adição da coluna quantidade

	function removerEstoque($conn, $produto, $quantidade){
		$sql = "SELECT * FROM `ps_produtos` WHERE `id` = '$produto'";
		$dados = mysqli_query($conn, $sql);
		$qtdEst = mysqli_fetch_assoc($dados);

		$qtdEst['qtd'] = $qtdEst['qtd'] - $quantidade;

		$query = "UPDATE `ps_produtos` SET `qtd` = '$qtdEst[qtd]' WHERE `id` = '$produto'";
		$exec = mysqli_query($conn, $query) or die(mysql_error($conn));

	}

	function removerUsuario($idLogin, $conn){
		$sql = "DELETE FROM `ps_carrinho` WHERE `idLogin` = '$idLogin'";
		$exec = mysqli_query($conn, $sql);

		$query = "DELETE FROM `ps_pedidos` WHERE `idLogin` = '$idLogin'";
		$dados = mysqli_query($conn, $query);

		$processamento = "DELETE FROM `ps_login` WHERE `id` = '$idLogin'";
		if(!mysqli_query($conn, $processamento)){
			?>
			<script type="text/javascript">
				alert('Erro no processamento, tente novamente!');
				location.href = "usuarios.php";
			</script>
			<?php
		}else{
			?>
			<script type="text/javascript">
				alert('Usuário removido com sucesso!');
				location.href = "usuarios.php";
			</script>
			<?php
		}
	}

	function adicionarEstoque($produto, $conn, $quantidade){
		$sql = "SELECT * FROM `ps_produtos` WHERE `id` = '$produto'";
		$dados = mysqli_query($conn, $sql);
		$qtdEst = mysqli_fetch_assoc($dados);

		$qtdEst['qtd'] = $qtdEst['qtd'] + $quantidade ;

		$query = "UPDATE `ps_produtos` SET `qtd` = '$qtdEst[qtd]' WHERE `id` = '$produto'";
		if(!mysqli_query($conn, $query)){
			return false;
		}else{
			return true;
		}
	}

	function confirmarCompra($login, $conn){

		$sql = "SELECT * FROM `ps_carrinho` WHERE `idLogin` = '$login'";
		$todos = mysqli_query($conn, $sql);
		$tr = mysqli_num_rows($todos);

		if ($tr > 0){
			$data = date("d/m/y");
			while ($linha = mysqli_fetch_assoc($todos)){
				$query = "INSERT INTO `ps_pedidos` (`idLogin`, `idProduto`, `data`, `Quantidade`) VALUES ('$linha[idLogin]', '$linha[idProduto]', '$data', '$linha[Quantidade]')";
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
							location.href = "pagamento.php";
						</script>
						<?php
					}
				}
			}
		}
		
	}

	function cancelarPedido($pedido, $conn){
		$sql = "SELECT * FROM `ps_pedidos` WHERE `id` = '$pedido'";
		$dados = mysqli_query($conn, $sql);
		$linha = mysqli_fetch_assoc($dados);

		$estoque = adicionarEstoque($linha['idProduto'], $conn);

		if($estoque == true){
			$sql = "DELETE FROM `ps_pedidos` WHERE `id` = '$pedido'";
			if (!mysqli_query($conn, $sql)) {
					?>
					<script type="text/javascript">
						alert('Erro no processamento, tente novamente!');
						location.href = "pedidos.php";
					</script>
					<?php
			}else{
				?>
				<script type="text/javascript">
					alert('Pedido cancelado com sucesso!');
					location.href = "pedidos.php";
				</script>
				<?php
			}
		}else{
			?>
			<script type="text/javascript">
				alert('Erro no processamento, tente novamente!');
				location.href = "pedidos.php";
			</script>
			<?php
		}
	}

	function removerProduto($produto, $conn){
		$deletar = "DELETE FROM `ps_produtos` WHERE `id` = '$produto'";
		if(!mysqli_query($conn, $deletar)){
			return false;
		}else{
			return true;
		}
	}

	function cadastrarProduto($nome, $descricao, $preco, $qtd, $imagem, $id_anterior, $conn){


		try{

			$nome = strtolower($nome);
			$nome = ucwords($nome);
	
			if($id_anterior == NULL){exit(122); }
	
			$id_anterior++;
	
			// Tratamento da imagem
	
			$nome_temporario=$imagem["tmp_name"];
			$nome_real=$imagem["name"];
			
			$ponto = strpos($nome_real, ".");
			$extensao = substr($nome_real, $ponto, strlen($nome_real));
			$preco = floatval($preco);
	
			$inicio = "dist/images/";
			$img = $inicio.$id_anterior.$extensao;
	
			$sql = "INSERT INTO `ps_produtos` (`nome`, `descricao`, `preco`, `qtd`, `img`) VALUES ('$nome', '$descricao', '$preco', '$qtd', '$img')";
	
			if(!mysqli_query($conn, $sql)){	
			
				throw new Exception(mysqli_error($conn));
				return false;
	
			}else{			
				if(move_uploaded_file($nome_temporario, "../../site/contents/$img")){

					return true;
				}
				return true;
			}


		}catch(Exception $e){
			print($e->getMessage());
			exit(2);
		}


		
	}

	function validarNumero($numero){
		if(!is_numeric($numero)){
			return false;
		}else{
			return true;
		}
	}

	function agendar($nome, $pet, $tel, $email, $data, $hora, $conn){
		$nome = strtolower($nome);
		$nome = ucwords($nome);
		$email = strtolower($email);

		$sql = "INSERT INTO `ps_agendamentos` (`nome`, `pet`, `tel`, `email`, `data`, `hora`) VALUES ('$nome', '$pet', '$tel', '$email', '$data', '$hora')";
		if(!mysqli_query($conn, $sql)){
			return false;
		}else{
			return true;
		}
	}

	function cancelarConsulta($pedido, $conn){

		try{

			$validacao_interna="SELECT * FROM `ps_agendamentos` WHERE `id` = '$pedido'";

			$result = mysqli_query($conn, $validacao_interna);

			if( (mysqli_num_rows($result) <  0) || ( $pedido == "") ){
				throw new Exception( "Invalid Result" );
			}


			$deletar = "DELETE FROM `ps_agendamentos` WHERE `id` = '$pedido'";

			if(!mysqli_query($conn, $deletar)){

				throw new Exception( mysqli_error($conn) );
			?>
				<script type="text/javascript">
					alert('Erro no processamento, tente novamente!');
					location.href = "pedidos.php";
				</script>

			<?php
			}else{
				?>
				<script type="text/javascript">
					alert('Consulta cancelada!');
					location.href = "administrativo.php";
				</script>
			<?php
			}

		}catch(Exception $e){
			print("Error: " . $e->getMessage()) ;
		}	
	}	


	function cardIsValid($cardNumber)
	{
		$number = substr($cardNumber, 0, -1);
		$doubles = [];

		for ($i = 0, $t = strlen($number); $i < $t; ++$i) {
			$doubles[] = substr($number, $i, 1) * ($i % 2 == 0? 2: 1);
		}

		$sum = 0;

		foreach ($doubles as $double) {
			for ($i = 0, $t = strlen($double); $i < $t; ++$i) {
				$sum += (int) substr($double, $i, 1);
			}
		}

		return substr($cardNumber, -1, 1) == (10-$sum%10)%10;
	}


?>
