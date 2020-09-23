<?php 
	session_start();
	include('conexion.php');
	$usuario=$_SESSION['username'];
	if(!empty($_GET['tipo']) and !empty($_GET['xdes'])){
		$tipo=$_GET['tipo'];
		$descuento=$_GET['xdes'];
	}
	if(!empty($_GET['xcodigo'])){$codigo=$_GET['xcodigo'];}
	if(!empty($descuento)){
		$cann=mysql_query("SELECT * FROM caja_tmp where cod='$codigo'");	
		if($datos=mysql_fetch_array($cann)){
			if($tipo=='d'){
				$venta=$descuento;
			}else{
				if($descuento>100){
					echo 'supero el 100%';
					$descuento=0;
				}
				$venta=$datos['venta']-($datos['venta']*$descuento/100);
			}
			$importe=$venta*$datos['cant'];
			$sqlx="Update caja_tmp Set venta='$venta', importe='$importe' Where cod='$codigo'";
			mysql_query($sqlx);
		}
		
	}
	header('location:caja.php?ddes='.$_SESSION['ddes']);
?>