<nav class="navbar navbar-default" role="navigation">
  <div class="jumbotron text-center">
  <h1>Servicio Sandoval</h1>
  <p>Servicios De Cambio De Aceite Y Afinación</p> 
</div>
<div class="container">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Menu</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">

      <?php if($_SESSION["username"]=="administrador"):?>
            <li><a  class="navbar-brand"  href="./usuario.php"><b>Usuario</b></a></li>
            <li><a  class="navbar-brand"  href="./cliente.php"><b>Cliente</b></a></li>
            <li><a  class="navbar-brand"  href="./proveedor.php"><b>Proveedor</b></a></li> 
            <li><a  class="navbar-brand"  href="./empleado.php"><b>Empleado</b></a></li>
            <li><a  class="navbar-brand"  href="./productos.php"><b>Productos</b></a></li> 
            <li><a  class="navbar-brand"  href="./caja2.php"><b>Compras</b></a></li>
            <li><a  class="navbar-brand"  href="./caja.php"><b>Venta</b></a></li>       
      <?php elseif($_SESSION["username"]=="empleado"):?>
            <li><a  class="navbar-brand"  href="./caja.php"><b>Venta</b></a></li>
      
      <?php endif;?>
            
       <li><a  href="php/logout.php"><b>Cerrar Sesión</b></a></li>
      
    </ul>
  </div><!-- /.navbar-collapse -->
</div>
</nav>