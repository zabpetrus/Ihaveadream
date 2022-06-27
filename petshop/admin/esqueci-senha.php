<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="contents/images/favicon.ico">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="contents/css/esqueciSenha.style.css" rel="stylesheet" />
    <title>5PJS - Projeto de Sistemas | Petshop | Recuperar Senha</title>
</head>
<body>
    <?php include_once "menu.php"; ?>
    <main class="form-recuperar">

    <form id="recuperarsenha" method="post" action="./actions/reenviar-senha.php">
        <h1 class="h3 mb-3 fw-normal text-center">Recuperar Senha</h1>

        <div class="mb-3">
        <label for="email_field" class="label-email">Endereço de Email</label>
        <input type="email" class="form-control" id="email_field" placeholder="name@example.com">
        </div>            
        
        <button class="w-100 btn btn-lg btn-primary" type="submit">Envie-me um Email</button>
        <p class="mt-5 mb-3 text-muted text-center">&copy; 2017–2021</p>
    </form>
    </main>

    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(e) {        

        var formulario = $("#recuperarsenha");

        formulario.on("submit", function(e){

            e.preventDefault();
            var email_text = $("#email_field").val();
            var james = { email:  email_text };

            if(email_text != "")
            {
                $.post("./actions/reenviar-senha.php", james).done(function(data) {
                    alert("Email para recuperação de senha enviado para " + james.email);
                });
            }

           

        });
     
    });
</script>
</body>
</html>