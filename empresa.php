<?php
 		session_start();
     include('conexion.php'); 
        if(!isset($_SESSION["username"]))
        {
           header("Location:../index.php");
        } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Principal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="EstiloVenta/css/bootstrap.css" rel="stylesheet">
    <link href="EstiloVenta/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="EstiloVenta/css/docs.css" rel="stylesheet">
    <link href="EstiloVenta/js/google-code-prettify/prettify.css" rel="stylesheet">
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	<script src="js/jquery.js"></script>
    <script src="EstiloVenta/js/bootstrap-transition.js"></script>
    <script src="EstiloVenta/js/bootstrap-alert.js"></script>
    <script src="EstiloVenta/js/bootstrap-modal.js"></script>
    <script src="EstiloVenta/js/bootstrap-dropdown.js"></script>
    <script src="EstiloVenta/js/bootstrap-scrollspy.js"></script>
    <script src="EstiloVenta/js/bootstrap-tab.js"></script>
    <script src="EstiloVenta/js/bootstrap-tooltip.js"></script>
    <script src="EstiloVenta/js/bootstrap-popover.js"></script>
    <script src="EstiloVenta/js/bootstrap-button.js"></script>
    <script src="EstiloVenta/js/bootstrap-collapse.js"></script>
    <script src="EstiloVenta/js/bootstrap-carousel.js"></script>
    <script src="EstiloVenta/js/bootstrap-typeahead.js"></script>
    <script src="EstiloVenta/js/bootstrap-affix.js"></script>
    <script src="EstiloVenta/js/holder/holder.js"></script>
    <script src="EstiloVenta/js/google-code-prettify/prettify.js"></script>
    <script src="EstiloVenta/js/application.js"></script>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/ico/favicon.png">

</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
<center>
<div align="right">
	<a href="PDFestado_inventario.php" class="btn"><i class="icon-print"></i> Reporte PDF</a> 
    <!-- Button to trigger modal -->
<table width="80%" border="0" class="table table-hover">
<thead>
  <tr>
    <td colspan="6"><strong><center>Productos de Baja Existencia</center></strong></td>
    </tr>
  <tr>
    <td width="15%"><strong>Codigo</strong></td>
    <td width="26%"><strong>Descripcion del Producto</strong></td>
    <td width="13%"><div align="right"><strong>Costo</strong></div></td>
    <td width="16%"><div align="right"><strong>Valor Venta</strong></div></td>
    <td width="14%"><strong><center>Existencia</center></strong></td>
  </tr>
</thead>
<tbody>
<?php 
	$mensaje='no';
    $can=mysql_query("SELECT * FROM productosyservicios");	
    while($dato=mysql_fetch_array($can)){
		$cant=$dato['cantidad'];
		$minima=$dato['minimo'];
		if($cant<=$minima){
			$mensaje='si';
?>

  <tr>
    <td><?php echo $dato['id']; ?></td>
    <td><a href="crear_producto.php?codigo=<?php echo $dato['id']; ?>">
      <?php echo $dato['descripcion']; ?> </a>
	<!--<?php if($dato['clase']=='tmp'){echo '<span class="label label-info">TMP</span>';} ?></td>-->
    <td><div align="right">$ <?php echo number_format($dato['precio'],2,",","."); ?></div></td>
    <td><div align="right">$ <?php echo number_format($dato['venta'],2,",","."); ?></div></td>
    <td><center><span class="badge badge-important"><?php echo $cant; ?></span></center></td>
  </tr>
<?php }
} ?>
  </tbody>
</table>
<?php	if($mensaje=='no'){	
  echo '<div class="alert alert-success" align="center"><strong>No existen articulos bajos de stock!</strong></div>'; 
  } ?>
<br>
<br>
<table width="80%" border="0" class="table table-hover">
<thead>
  <tr>
    <td colspan="6"><strong><center>Listado y Totales de Productos</center></strong></td>
    </tr>
  <tr>
    <td width="15%"><strong>Codigo</strong></td>
    <td width="26%"><strong>Descripcion del Producto</strong></td>
    <td width="13%"><div align="right"><strong>Costo</strong></div></td>
    <td width="16%"><div align="right"><strong>Valor Venta</strong></div></td>
    <td width="14%"><strong><center>Existencia</center></strong></td>
  </tr>
</thead>
<tbody>
<?php 
	$mensaje2='no';$precio=0;$mayor=0;$venta=0;$art=0;
    $can=mysql_query("SELECT * FROM productosyservicios");	
    while($dato=mysql_fetch_array($can)){
		$cant=$dato['cantidad'];
		$minima=$dato['minimo'];
		$mensaje2='si';
		$art=$art+$cant;
		$precio=$precio+($dato['precio']*$dato['cantidad']);
		$venta=$mayor+($dato['venta']*$dato['cantidad']);
		if($cant<=$minima){
			$cantidad='<span class="badge badge-important">'.$cant.'</span>';
		}else{
			$cantidad='<span class="badge badge-success">'.$cant.'</span>';
		}
?>

  <tr>
    <td><?php echo $dato['id']; ?></td>
    <td><a href="crear_producto.php?codigo=<?php echo $dato['id']; ?>"><?php echo $dato['descripcion']; ?></a></td>
    <td><div align="right">$ <?php echo number_format($dato['precio'],2,",","."); ?></div></td>
    <td><div align="right">$ <?php echo number_format($dato['venta'],2,",","."); ?></div></td>
    <td><center><?php echo $cantidad; ?></center></td>
  </tr>
  <?php } 
  	if($mensaje2=='2'){
  ?>
   <tr>
    <td colspan="6">
    		<div class="alert alert-error">
              <strong>No hay Articulos registrados actualmente</strong>
            </div></td>
    </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td><div align="right"><strong>Totales:</strong></div></td>
    <td><div align="right"><strong>$ <?php echo number_format($precio,2,",","."); ?></strong></div></td>
    <td><div align="right"><strong>$ <?php echo number_format($venta,2,",","."); ?></strong></div></td>
    <td><CENTER><span class="badge badge-warning"><?php echo $art; ?></span></CENTER></td>
  </tr>

  </tbody>
</table>
</body>
</html>