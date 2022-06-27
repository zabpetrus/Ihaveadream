
<?php

error_reporting(0);

function enviar_senha() : bool
{
    //Lógica de enviar senha 
    return true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reenvio de Senha</title>
    <style>
        body{ background-color: gray; }

    </style>
</head>
<body>

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') //start if server
{
    //Enviar requisição
    if(enviar_senha){
        header("Location: ../esqueci-senha.php");
    }
    else{
?>

<p>Houve um problema na requisição. Caso essa tela tenha aparecido, envie um email para foo@email.com</p>

<?php

    } //end else
} //end if server
?>

</body>
</html>