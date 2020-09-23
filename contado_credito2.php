<?php 
		session_start();
		 include('conexion.php'); 
		 $usuario=$_SESSION["username"];
		 
		 if(!isset($_SESSION["username"]))
        {
           header("Location:../index.php");
        } 
		 $cans=mysql_query("SELECT * FROM usuario where usuario='$usuario'") or die(mysql_error());
		 
         if($datos=mysql_fetch_array($cans))
         {
           $nombre_usu=$datos['nombre'];
         }
         //echo($nombre_usu);
		$can=mysql_query("SELECT MAX(id_compra) as maximo FROM compra");//codigo de la factura	
        if($dato=mysql_fetch_array($can))
        	{	
        		$cfactura=$dato['maximo']+1;	
        	}
		if($cfactura==1)
		{
			$cfactura=1000;
		}//si es primera factura colocar que empieze en 1000
		date_default_timezone_set("America/Mexico_City");
		$hoy=$fechay= date('Y-m-d');
		
		
		if($_POST['button']=='Compra Realizada'){ //contado
			//$ccpago=$_GET['ccpago'];
			$tpagar=$_POST['tpagar'];
		    $nfolio=$_POST['folio'];
		    $nota=$_POST['nota'];
		    echo $nfolio;
		    $id_proveedor=$_POST['id_proveedor'];
		    echo $id_proveedor;
			$t_importe=0;

			if($tpagar<=$tpagar){
				//guarda tabla factura
				$factura_sql="INSERT INTO compra (id_compra, fecha, id_proveedor, total, NFolio, nota,status) 
							  VALUES ('$cfactura','$hoy','$id_proveedor','$tpagar','$nfolio','$nota','PAGADO')";
				mysql_query($factura_sql);	
				//codigo de la factura / guarda en detalles
				$can=mysql_query("SELECT * FROM caja_tmp2 where usu='$nombre_usu'");	
				while($dato=mysql_fetch_array($can)){
					$cod=$dato['cod'];			$nom=$dato['nom'];			$cant=$dato['cant'];
					$venta=$dato['compra'];		$importe=$dato['importe'];	$t_importe=$t_importe+$importe;
					
					$detalle_sql="INSERT INTO detallecompra (id_compra, id_productoscompra, descripcion, cantidad, precio, importe)
							VALUES ('$cfactura','$cod','$nom','$cant','$venta','$importe')";
					mysql_query($detalle_sql);
				
					$ca=mysql_query("SELECT * FROM productosyservicios where id='$cod'");	
					if($date=mysql_fetch_array($ca)){
						$e_actual=$date['cantidad'];
					}
					$n_cantidad=$e_actual+$cant;
					if($n_cantidad<0)
					{
						$n_cantidad=0;	
					}
					$sql="Update productosyservicios Set cantidad='$n_cantidad' Where id='$cod'";
					mysql_query($sql);	
					
				}
								
				$borrar_sql="DELETE FROM caja_tmp2 WHERE usu='$usuario'";//borrar todo de la caja temporal
				mysql_query($borrar_sql);
				
				//header('location:contado2.php?tpagar='.$tpagar.'&ccpago='.$ccpago.'&factura='.$cfactura);
				header('location:caja2.php?ddes=0');
			}else{
				header('location:caja2.php?mensaje=error');
			}
		}
		$_SESSION['ddes']=0;
		
?>