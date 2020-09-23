<?php 
session_start();
include('conexion.php');
$usuario=$_SESSION['username'];

if(!empty($_POST['xcodigo'])){$codigo=$_POST['xcodigo'];}
if(!empty($_POST['cantidad'])){$cantidad=$_POST['cantidad'];}

if(!empty($_POST['tventa'])){	
	$_SESSION['tventa']=$_POST['tventa'];	
}

if(!$_SESSION['username']==""){

	if(!empty($cantidad)){
		$cann=mysql_query("SELECT * FROM caja_tmp2 where cod='$codigo'");	
		if($datos=mysql_fetch_array($cann)){
			if($cantidad<>0){
				$importe=$datos['compra']*$cantidad;
				$sql="Update caja_tmp2 Set cant='$cantidad', importe='$importe' Where cod='$codigo'";
				mysql_query($sql);
				echo $sql;
			}
		}
	}
	
	if($_SESSION["tventa"]=='precio'){
		$cann=mysql_query("SELECT * FROM caja_tmp2 where usu='$usuario'");	
		while($datos=mysql_fetch_array($cann)){
			$codp=$datos['cod'];	
			$cant=$datos['cant'];
			$can=mysql_query("SELECT * FROM productosyservicios where id='$codp'");	
			if($dato=mysql_fetch_array($can)){
				$valore=$dato['precio'];		
				$improtee=$valore*$cant;
				$sqld="Update caja_tmp2 Set compra='$valore', importe='$improtee' Where cod='$codp'";
				mysql_query($sqld);
			}
		}
	}
	//if($_SESSION['tventa']=='mayoreo'){
	//	$cann=mysql_query("SELECT * FROM caja_tmp where usu='$usuario'");	
	//	while($datos=mysql_fetch_array($cann)){
	//		$codp=$datos['cod'];	$cant=$datos['cant'];
	//		$can=mysql_query("SELECT * FROM producto where cod='$codp'");	
	//		if($dato=mysql_fetch_array($can)){
	//			$valore=$dato['mayor'];		
	//		    $improtee=$valore*$cant;
	//			$sqld="Update caja_tmp Set venta='$valore', importe='$improtee' Where cod='$codp'";
	//			mysql_query($sqld);
	//		}
	//	}
	//}
}
header('location:caja2.php?ddes='.$_SESSION['ddes']);
?>