<?php

include_once "../admin/config/conexao.php";
include_once "../admin/funcoes/funcoes.php";

?>
  <header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
            <img class="header-logo-image" src="contents/dist/images/logo.svg" alt="Logo">
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 text-secondary">Home</a></li>
          <li><a href="agendamento.php" class="nav-link px-2 text-white">Agendamentos</a></li>  
          <li><a href="pedidos.php" class="nav-link px-2 text-white">Pedidos</a></li>     
        </ul>

        

        <div class="text-end">

        <?php
          $login = "Login";
          $redirect = "../admin/login_page.php";

          if(isset($_SESSION["usuarioNome"])){
            $login = $_SESSION["usuarioNome"];
            $redirect = "../admin/exit.php";
          }
         
        ?>
          <a href="<?php echo $redirect; ?>" class="btn btn-outline-light me-2"><?php echo $login; ?></a>
          <a href="../cadastrar.php" class="btn btn-warning">Cadastrar</a>

          <?php  

            if(array_key_exists('usuarioNiveisAcessoId', $_SESSION)){

             if($_SESSION['usuarioNiveisAcessoId'] == "1"){  

            ?>

          <a href="../admin/administrativo.php" class="btn btn-primary">Administração</a> 

          <?php } }  ?>

          <a class="btn text-white" href="../site/carrinho.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
              <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
          </a>

        </div>
      </div>
    </div>
  </header>