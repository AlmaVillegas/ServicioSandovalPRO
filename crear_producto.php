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
    <title>Inventario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="EstiloVenta/css/bootstrap.css" rel="stylesheet">
    <link href="EstiloVenta/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="EstiloVenta/css/docs.css" rel="stylesheet">
    <link href="EstiloVenta/js/google-code-prettify/prettify.css" rel="stylesheet">
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	<script src="EstiloVenta/js/jquery.js"></script>
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
<div align="center">
<table width="80%" border="0" class="table">
  <tr class="info">
    <td colspan="4"><center><strong>Actualizacion De Productos</strong></center></td>
  </tr>
   <tr>
    <td colspan="3">
    <div class="control-group info">
    
    </div>
    <?php 
		
		if(!empty($_POST['ccodigo']) or !empty($_GET['codigo'])){	
			$nom='';$costo='0';$cantidad='0';$minimo='0';$codigo='';
			$venta='0';
			$fechax=date("d").'/'.date("m").'/'.date("Y");
			$fechay=date("Y-m-d");
			if(!empty($_GET['codigo'])){
				$codigo=$_GET['codigo'];
			}
			if(!empty($_POST['ccodigo'])){
				$codigo=$_POST['ccodigo'];
			}
			$can=mysql_query("SELECT * FROM productosyservicios where id='$codigo'");
			if($dato=mysql_fetch_array($can)){
				//$prov=$dato['prov'];
				//$cprov=$dato['cprov'];
				$nom=$dato['descripcion'];
				$costo=$dato['precio'];
				$venta=$dato['venta'];
				$cantidad=$dato['cantidad'];
				$minimo=$dato['minimo'];
				$boton="Actualizar Producto";
				echo '	<div class="alert alert-success">
						  <button type="button" class="close" data-dismiss="alert">X</button>
						  <strong>Producto / Articulo '.$nom.' </strong> con el codigo '.$codigo.' ya existe
					</div>';	
			}else{
				$boton="Guardar Producto";
			}
	?>
    </td> 
    <center>   
    <div class="control-group info">
    <form name="form2" method="post" action="">
  	<tr>
    	<td width="24%">
        	<label>Codigo: </label><input type="text" name="codigo" id="codigo" pattern="^[0-9]+" value="<?php echo $codigo; ?>" readonly>
            <label>Nombre: </label><input type="text" name="nom" id="nom"  value="<?php echo $nom; ?>" readonly>
            <label>Precio Costo</label>
            <div class="input-prepend input-append">
                <span class="add-on">$</span>
                <input type="text" name="costo" id="costo" pattern="^[0-9]+" value="<?php echo $costo; ?>" readonly>
            </div>
            <label>Cantidad Actual: </label><input type="text" name="cantidad" id="cantidad" pattern="^[0-9]+" value="<?php echo $cantidad; ?>" required>
            <label>Cantidad Minima: </label><input type="text" name="minimo" id="minimo" pattern="^[0-9]+" value="<?php echo $minimo; ?>" >
            <label>Precio Venta: </label>
            <div class="input-prepend input-append">
                <input type="text" name="venta" id="venta" pattern="^[0-9]+" value="<?php echo $venta; ?>" readonly> 

            </div><br><br>
                <button type="submit" class="btn btn-primary"><?php echo $boton; ?></button> 
        </td>
    	<td width="28%">
              
        </td>
    	  
	</tr>
    </form>
    </center>
    </div>
	<?php } ?>  
  </table>
   <?php 
		if(!empty($_POST['nom'])){
			$gnom=$_POST['nom']; $gprecio=$_POST['costo'];
			$gventa=$_POST['venta'];	$gcantidad=$_POST['cantidad'];
			$gminimo=$_POST['minimo'];	$gcodigo=$_POST['codigo'];				
			$can=mysql_query("SELECT * FROM productosyservicios where id='$gcodigo'");
			if($dato=mysql_fetch_array($can)){
				$sql="Update productosyservicios Set  
											descripcion='$gnom',
											precio='$gprecio',
											venta='$gventa',
											cantidad='$gcantidad',
											minimo='$gminimo'		
							                Where id='$gcodigo'";
				mysql_query($sql);
				echo '	<div class="alert alert-success">
						  <button type="button" class="close" data-dismiss="alert">X</button>
						  <strong>Producto / Articulo '.$gnom.' </strong> Actualizado con Exito
					</div>';

				$descripcion='';$precio='0';$cantidad='0';$minimo='0';$codigo='';$venta='0';
			}
                else{
				$sql = "INSERT INTO productosyservicios (descripcion, precio, venta, cantidad, minimo, status) 
							 VALUES ($gnom','$gprecio','$gventa','$gcantidad','$gminimo',\"Activo\")";
				mysql_query($sql);	
				echo '	<div class="alert alert-success">
						  <button type="button" onClick="window.location=empresa.php" class="close" data-dismiss="alert">X</button>
						  <strong>Producto / Articulo '.$gnom.' </strong> Guardado con Exito
						</div>';
			}
			//subir la imagen del articulo
			//$nameimagen = $_FILES['imagen']['name'];
			//$tmpimagen = $_FILES['imagen']['tmp_name'];
			//$extimagen = pathinfo($nameimagen);
			//$ext = array("png","jpg");
			//$urlnueva = "articulo/".$gcodigo.".jpg";			
			//if(is_uploaded_file($tmpimagen)){
			//	if(array_search($extimagen['extension'],$ext)){
			//		copy($tmpimagen,$urlnueva);	
			//	}
			//}
		}
		?>
</div>
</body>
</html>