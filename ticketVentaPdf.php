<?php 
	session_start();
	include('conexion.php');
  $factura=$_GET['factura'];
  //$tpagar=$_GET['tpagar'];
  //$ccpago=$_GET['ccpago'];
  //$cambio=$_GET['factura'];

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

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Reporte de venta</title>
 	<style type="text/css">
		
@page {
            margin-top: 0.1em;
            margin-left: 0.2em;
        }
    body{
    	font-size: xx-small;
    }
	</style>

 </head>
 <body>
   <table width="100px" border="0">
      <tr>
        <td>
        <strong>
        <?php echo $empresa; ?></strong><br />
        <?php echo $direccion; ?><br />
        <?php echo $telefono; ?><br />
        <?php echo $nit; ?><br /></td>
      </tr>
      <tr>
        <td><div><?php echo $fecha; ?></div></td>
      </tr>
      <tr>
        <td>CAJERO: <?php echo $cajera; ?></td>
      </tr>
      <tr>
        <td>N°Venta: <?php echo $factura; ?></td>
      </tr>
   </table><br>
   <table width="100px" border="0">
      <tr>
        <td width="45">CANT </td>
        <td width="50">DESCRIPCION</td>
         <td width="30">PRECIO</td>
        <td width="30"><div align="right">IMPORTE</div></td>
      </tr>
      <tr>
        <td colspan="4"><center>========================================</center></td>
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
        <td colspan="4"><center>NO. DE ARTICULOS: <?php echo $numero; ?></center></td>
      </tr>
      <br>
      <br>
      <br>
      <tr>
        <td colspan="4"><center>
          <strong>TOTAL: $ <?php echo number_format($valor,2); ?></strong>
        </center></td>
      </tr>
      <br>
      <br>
      <br>
      <br>
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

 </body>
 </html>
 