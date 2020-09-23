<?php 
	session_start();
	include('conexion.php');
	$usu=$_SESSION['username'];
	if(!empty($_GET['tipo']) and !empty($_GET['xdes'])){
		$tipo=$_GET['tipo'];
		$descuento=$_GET['xdes'];
	}
	if(!empty($_GET['xcodigo']))
		{
			$codigo=$_GET['xcodigo'];
		}
	if(!empty($descuento)){
		$cann=mysql_query("SELECT * FROM caja_tmp2 where cod='$codigo'");	
		if($datos=mysql_fetch_array($cann)){
			if($tipo=='d'){
				$venta=$descuento;
			}else{
				if($descuento>100){
					echo 'supero el 100%';
					$descuento=0;
				}
				$venta=$datos['compra']-($datos['compra']*$descuento/100);
			}
			$importe=$descuento*$datos['cant'];
			$sqlx="Update caja_tmp2 Set compra='$descuento', importe='$importe' Where cod='$codigo'";
			mysql_query($sqlx);
		}
		
	}
	header('location:caja2.php?ddes='.$_SESSION['ddes']);
?>