<?php
session_start();

include_once "../admin/config/conexao.php";
include_once "../admin/funcoes/funcoes.php";

$valor = 0.0;
if(isset($_SESSION["usuarioId"]))
{
    $sql = "SELECT * FROM `ps_login` WHERE `id` = '$_SESSION[usuarioId]'";
    $dados = mysqli_query($conn, $sql);
    $linha = mysqli_fetch_assoc($dados);
}
else{
    header("Location: index.php");
}

$query = "SELECT * FROM `ps_pedidos` WHERE `idLogin` = '$_SESSION[usuarioId]'";
$exec = mysqli_query($conn, $query);
$cont_produtos = mysqli_num_rows($exec);

while ($info = mysqli_fetch_assoc($exec)) {
  $consulta = "SELECT * FROM `ps_produtos` WHERE `id` = '$info[idProduto]'";
  $proc = mysqli_query($conn, $consulta);
  $val = mysqli_fetch_assoc($proc);

  $valor += $val['preco'];
  $valor_final = number_format($valor, 2, '.', '');
}

$i = strlen($valor_final)-1;
$final = " ";

for($i; $i < 9; $i++){
  $final .= 0;
}

$final .= ($valor_final*100);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>5PJS - Projeto de Sistemas | Petshop | Pagamento </title>
    <link rel="icon" type="image/x-icon" href="contents/icons/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="contents/css/pagamento.style.css" />
</head>
<body>
    <?php include_once "menu.php"; ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="p-3">
                        <H2 class="mt-3 mb-3" >Faturamento</H2>

                        <div class="bg-light p-4">

                            <p>Escolha a forma de pagamento:</p>                           

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="opcao" id="opcao1" value="1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Boleto
                                </label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="opcao" id="opcao2" checked value="2" >
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Cartão de Crédito
                                </label>

                                <hr class="mt-3 mb-3"/>
                                
                            </div>
                            <div id="pagboleto">

                                <p>Confirme os dados para pagamento: </p>
                                <form id="formboleto">

                                    <div class="mb-3">
                                        <label class="form-label">Nome</label>
                                        <input type="text" class="form-control"  aria-describedby="nome" name="nome" placeholder="Nome" value="<?=utf8_encode($linha['nome'])?>" >
                                    </div>


                                    <div class="row mb-3">    

                                        <div class="col">
                                            <label class="form-label">Endereço</label>
                                            <input type="text" class="form-control"  aria-describedby="endereco" name="endereco" placeholder="Endereço" value="<?=utf8_encode($linha['endereco'])?>" >
                                        </div>

                                        <div class="col">
                                            <label class="form-label">CPF</label>
                                            <input type="text" class="form-control"  aria-describedby="cpf" name="cpf" placeholder="cpf" value="<?=$linha['cpf']?>" >
                                        </div>

                                    </div>

                                    <div class="text-center">
                                        <button id="btn1" class="btn btn-primary" >Continuar</button> 
                                    </div>                                

                                </form>

                            </div>

                            <div id="cartaocredito">
                                <p>Entre com os dados do Cartão de Crédito: </p>
                                <form id="formcartao">

                                    <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="cc-nome">Nome no cartão</label>
                                        <input type="text" class="form-control" id="cc-nome" placeholder="" required>
                                        <small class="text-muted">Nome completo, como mostrado no cartão.</small>
                                        <div class="invalid-feedback">
                                        O nome que está no cartão é obrigatório.
                                    </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cc-numero">Número do cartão de crédito</label>
                                        <input type="text" class="form-control" id="cc-numero" placeholder="" required>
                                        <div class="invalid-feedback">
                                        O número do cartão de crédito é obrigatório.
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label for="cc-expiracao">Data de expiração</label>
                                        <input type="text" class="form-control" id="cc-expiracao" placeholder="" required>
                                        <div class="invalid-feedback">
                                        Data de expiração é obrigatória.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="cc-cvv">CVV</label>
                                        <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                                        <div class="invalid-feedback">
                                        Código de segurança é obrigatório.
                                        </div>
                                    </div>
                                    </div>

                                <div class="text-center">
                                   <button id="btn2" class="btn btn-primary" >Continuar</button> 
                                </div>

                                <form>

                            </div>


                        <div>                      

                </div>
                
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">

        $(document).ready(function(e){

            var a = $("#pagboleto");
            var b = $("#cartaocredito");

            a.hide();

            $("#btn1").on("click", function(e){
                $("#formboleto").submit();
                alert("O seu boleto está sendo gerado!");
                window.location.href = "boleto.php";
                return false;
            });

            $("#btn2").on("click", function(e){
                $("#formcartao").submit();
                alert("O pagamento foi feito com sucesso!");
                window.location.href = "index.php";
                return false;
            });

            $('input[type=radio][name=opcao]').change(function() {

                if (this.value == 1) {

                    a.show();
                    b.hide();

                }else if (this.value == 2) {

                    a.hide();
                    b.show();

                }

            });

        });

    </script>
</body>
</html>