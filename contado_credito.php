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
		$can=mysql_query("SELECT MAX(id_venta) as maximo FROM venta");//codigo de la factura	
        if($dato=mysql_fetch_array($can))
        	{	
        		$cfactura=$dato['maximo']+1;	
        	}
		if($cfactura==1)
		{
			$cfactura=1000;
		}//si es primera factura colocar que empieze en 1000
		date_default_timezone_set("America/Mexico_city");
		$hoy=$fechay= date('Y-m-d');
		
		
		if($_GET['button']=='Cobrar Dinero Recibido'){ //contado
			$ccpago=$_GET['ccpago'];
			$tpagar=$_GET['tpagar'];
			$t_importe=0;
			if($tpagar<=$ccpago){
				//guarda tabla factura
				$factura_sql="INSERT INTO venta (id_venta, cajera, fecha, total, status) VALUES ('$cfactura','$nombre_usu','$hoy','$tpagar','PAGADO')";
				mysql_query($factura_sql);	
				//codigo de la factura / guarda en detalles
				$can=mysql_query("SELECT * FROM caja_tmp where usu='$nombre_usu'");	
				while($dato=mysql_fetch_array($can)){
					$cod=$dato['cod'];			$nom=$dato['nom'];			$cant=$dato['cant'];
					$venta=$dato['venta'];		$importe=$dato['importe'];	$t_importe=$t_importe+$importe;
					
					$detalle_sql="INSERT INTO detalleventa (id_venta, id_productosventa, descripcion, cantidad, precio, importe)
							VALUES ('$cfactura','$cod','$nom','$cant','$venta','$importe')";
					mysql_query($detalle_sql);
					////ACTUALIZAR LA EXISTENCIA//////////////////
					$ca=mysql_query("SELECT * FROM productosyservicios where id='$cod'");	
					if($date=mysql_fetch_array($ca)){
						$e_actual=$date['cantidad'];
					}
					$n_cantidad=$e_actual-$cant;
					if($n_cantidad<0)
					{
						$n_cantidad=0;	
					}// si la cantidad da negativo ponerlo en 0
					$sql="Update productosyservicios Set cantidad='$n_cantidad' Where id='$cod'";
					mysql_query($sql);	
					/////////////////////////////////////////////
				}
								
				$borrar_sql="DELETE FROM caja_tmp WHERE usu='$usuario'";//borrar todo de la caja temporal
				mysql_query($borrar_sql);
				
				header('location:contado.php?tpagar='.$tpagar.'&ccpago='.$ccpago.'&factura='.$cfactura);
			}else{
				header('location:contado.php?mensaje=error');
			}
		}
		$_SESSION['ddes']=0;
		
?>