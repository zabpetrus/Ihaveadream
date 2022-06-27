<?php 
    include_once "config/conexao.php";
    include_once "funcoes/funcoes.php";    
?>

<?php
    if($_SESSION['usuarioNiveisAcessoId'] == "1"){
?>

<style type="text/css">

  /** * Sobreposição ** */
  .text_light{
    color: white !important;
  }
</style>

<nav class="py-2 border-bottom bg-dark text-light">
    <div class="container d-flex flex-wrap">
      <ul class="nav me-auto">
        <li class="nav-item"><a href="administrativo.php" class="nav-link px-2 text-light" ><i class="fas fa-dog"></i></a></li>
        <li class="nav-item"><a href="usuarios.php" class="nav-link px-2 text-light">Usuários</a></li>
        <li class="nav-item"><a href="pedidos.php" class="nav-link px-2 text-light">Pedidos</a></li>
        <li class="nav-item"><a href="agendamento.php" class="nav-link px-2 text-light">Agendamentos</a></li>
        <li class="nav-item"><a href="produtos.php" class="nav-link px-2 text-light">Produtos</a></li>
        <li class="nav-item"><a href="../site" class="nav-link px-2 text-light">Site</a></li>
        <?php } else {  ?>

        <!-- 
        <li class="nav-item"><a href="#" class="nav-link link-dark px-2">About</a></li>
        <li class="nav-item"><a href="#" class="nav-link link-dark px-2">Home</a></li> 
        -->

        <?php } ?>
               
      </ul>
      <ul class="nav">        
        <li class="nav-item"><a href="usuario.php" class="nav-link px-2 text-light" ><?php echo " ". $_SESSION['usuarioNome'] ?></a></li>
        <li class="nav-item" ><a href="#" class="nav-link px-2 text-light">Login</a></li>
        <li class="nav-item"><a href="exit.php" class="nav-link px-2 text-light">Sair</a></li>
        
        <li class="nav-item">
            <?php
                $carrinho = checkCarrinho($_SESSION['usuarioId'], $conn);
                if($carrinho == false){
            ?>
            <a class="btn text-white" href="#">

              <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
              </svg>
              
            </a>

            <?php
                }else{
            ?>
                   <a href="../site/carrinho.php" class="nav-link link-dark px-2" ><i class="fa fa-cart-shopping text-light"></i></a>
            <?php
                }
            ?>
        </li>

      </ul>
    </div>
  </nav>


