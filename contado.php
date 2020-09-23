<?php
 		session_start();
		include('conexion.php');
		//contado.php?tpagar='.$tpagar.'&ccpago='.$ccpago');
      $tpagar=$_GET['tpagar'];
      $ccpago=$_GET['ccpago'];
      $factura=$_GET['factura'];
      $cambio=$ccpago-$tpagar;
		//if(!empty($_GET['tpagar']) and !empty($_GET['ccpago']) and !empty($_GET['id_venta'])){
      
      //$tpagar=$_GET['tpagar'];
      //$ccpago=$_GET['ccpago'];
			//$factura=$_GET['id_venta'];
			//$cambio=$ccpago-$tpagar;
      
		//}
		
		if(!empty($_GET['mensaje'])){
			$error='si';
		}else{
			$error='no';
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>Contado</title>
   <style type="text/css" media="print">
	#Imprime {
		height: auto;
		width: 310px;
		margin: 0px;
		padding: 0px;
		float: left;
		font-family: Arial, Helvetica, sans-serif;
		
		color: #000;
	}
	@page{
	   margin: 0;
	}
	</style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="EstiloVenta/css/bootstrap.css" rel="stylesheet">
    <link href="EstiloVenta/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="EstiloVenta/css/docs.css" rel="stylesheet">
    <link href="EstiloVenta/js/google-code-prettify/prettify.css" rel="stylesheet">
    <script language="javascript">

	  function imprSelec(nombre) {
	  ////////
		  var ficha = document.getElementById(nombre);
		  var ventimp = window.open(' ', 'popimpr');
		  ventimp.document.write( ficha.innerHTML );
		  ventimp.document.close();
		  ventimp.print( );
		  ventimp.close();
	  } 

	</script> 
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	<script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>
    <script src="js/bootstrap-affix.js"></script>
    <script src="js/holder/holder.js"></script>
    <script src="js/google-code-prettify/prettify.js"></script>
    <script src="js/application.js"></script>

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

<?php if($error=='no'){ ?>
<center><a href="caja.php?ddes=0" class="btn"><i class="icon-backward"></i> Regresar a Ventas</a>
<a href="CrearTicketPdf.php?factura=<?php echo $factura; ?>" class="btn"><i class="icon-print"></i> Imprimir Ticket</a>
</center><br>

<table width="100%" border="0">
  <tr>
    <td width="50%"><center>
        <pre style="font-size:24px"><strong class="text-success">Total a Pagar</strong></pre>
        <pre style="font-size:24px"><strong>$ <?php echo number_format($tpagar,2); ?></strong></pre>
        <pre style="font-size:24px"><strong class="text-success">Dinero Recibido</strong></pre>
        <pre style="font-size:24px"><strong>$ <?php echo number_format($ccpago,2); ?></strong></pre>
        <pre style="font-size:24px"><strong class="text-success">Cambio</strong></pre>
        <pre style="font-size:24px"><strong>$ <?php echo number_format($cambio,2); ?></strong></pre>
    </center></td>
    <td width="50%" rowspan="3">
    <?php 
	$can=mysql_query("SELECT * FROM empresa where id=1");	
    if($dato=mysql_fetch_array($can)){	
		$empresa=$dato['empresa'];		$direccion=$dato['direccion'];
		$telefono=$dato['tel1'];		$nit=$dato['nit'];
		$fecha=date("Y-m-d H:i:s");		$pagina=$dato['web'];
		$tama=$dato['tamano'];
	}
	$can=mysql_query("SELECT * FROM venta where id_venta='$factura'");	
    if($datos=mysql_fetch_array($can)){	
		$cajera=$datos['cajera'];
	}
	$can=mysql_query("SELECT * FROM usuario where nombre='$cajera'");	
    if($datos=mysql_fetch_array($can)){	
		$cajera=$datos['nombre'];
	}
?>
<!-- codigo imprimir -->
<center>
<div id="Imprime" style="font-size:<?php echo $tama.'px'; ?>"><br />
<!-- <iframe frameborder="0" height="100" width="300" src="></iframe> -->
    <table width="310px" border="0">
      <tr>
        <td>
        <strong><?php echo $empresa; ?></strong><br />
        <?php echo $direccion; ?><br />
        <?php echo $telefono; ?><br />
        <?php echo $nit; ?><br /></td>
      </tr>
      <tr>
        <td><div ><?php echo $fecha; ?></div></td>
      </tr>
      <tr>
        <td>CAJERO: <?php echo $cajera; ?></td>
        </tr>
              <tr>
        <td>N°Venta: <?php echo $factura; ?></td>
      </tr>
   </table><br>
   <table width="310px" border="0">
      <tr>
        <td width="30">CANT </td>
        <td width="150">DESCRIPCION</td>
         <td width="30">PRECIO</td>
        <td width="30"><div align="right">IMPORTE</div></td>
      </tr>
      <tr>
        <td colspan="4"><center>===================================</center></td>
      </tr>
      <?php 
	  	$numero=0;
      $valor=0;
	  	$can=mysql_query("SELECT * FROM detalleventa where id_venta='$factura'");	
    	while($dato=mysql_fetch_array($can)){
			$numero=$numero+$dato['cantidad'];
			$valor=$valor+$dato['importe'];
			$tipo="Contado";
				
	  ?>
      <tr>
        <td><?php echo $dato['cantidad']; ?></td>
        <td><?php echo $dato['descripcion'];?></td>
        <td>$ <?php echo number_format($dato['precio'],2); ?></td>
        <td>$ <?php echo number_format($dato['importe'],2); ?></td>
      </tr>
      <?php } ?>
      <tr>
        <td colspan="4"><center>
          TOTAL: $ <?php echo number_format($valor,2); ?>
        </center></td>
      </tr>
      <!--<tr>
        <td colspan="4"><center>
          Dinero Recibido: $ <?php echo number_format($ccpago,2); ?>
        </center></td>
      </tr>

      <tr>
        <td colspan="4"><center>
          Cambio: $ <?php echo number_format($cambio,2); ?>
        </center></td>
      </tr>-->
      <tr>
        <td colspan="4"><center>NO. DE ARTICULOS: <?php echo $numero; ?></center></td>
      </tr>

      <tr>
        <td colspan="4"><center><strong>* VENTA A CONTADO *</strong></center></td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4"><center>GRACIAS POR SU COMPRA</center></td>
      </tr>
      <tr>
        <td colspan="4"><center><?php echo $pagina; ?></center></td>
      </tr>
    </table>
  <br>
</div>
<!--<p><a href="CrearTicketPdf.php?factura=<?php echo $factura; ?>" class="btn"><i class="icon-print"></i> Imprimir Ticket</a></p>-->
<!-- fin del codigo factura --></center>
    </td>
  </tr>
  <tr>
    <td><center>
        <div class="alert alert-success">
            <strong>Pago realizado con exito</strong><br><a href="caja.php?ddes=0">Regresar a la caja</a>
        </div>
        
        <?php } 
            if($error=='si'){
        ?>
                    <div class="alert alert-error" align="center">
                      <strong>El dinero recibido es menor al valor a pagar</strong> <br>
                      <strong><a href="caja.php?ddes=<?php echo $_SESSION['ddes']; ?>">Regresar a la caja</a></strong>
                    </div>
        <?php } 
            if($error=='num'){
                echo '<div class="alert alert-error" align="center">
                      <strong>Solo debe de ingresar numeros en este campo</strong> <br>
                      <strong><a href="caja.php?ddes='.$_SESSION['ddes'].'">Regresar a la caja</a></strong>
                    </div>';
            }
        ?>
	</center>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<center>
  

<br>

</center>
</body>
</html>