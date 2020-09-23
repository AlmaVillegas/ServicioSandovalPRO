<?php

if(!empty($_POST)){
	if(isset($_POST["username"]) &&isset($_POST["password"])){
		if($_POST["username"]!=""&&$_POST["password"]!=""){
			include "conexion.php";
			
			$user_id=null;
			$sql1= "select * from usuario where (usuario=\"$_POST[username]\" and password=\"$_POST[password]\" )";
			$query = $con->query($sql1);
			while ($r=$query->fetch_array()) {
				$user_id=$r["usuario"];
				break;
			}
			if($user_id==null){
				print "<script>alert(\"Acceso invalido.\");window.location='../inicio.php';</script>";
			}else{
				session_start();
				 switch ($_SESSION["username"]=$_POST['username']) {
				 	case 'administrador':
				 	    print "<script>window.location='../usuario.php';</script>";
				 	    break;
				 	case 'cliente':
				 		print "<script>window.location='../productos.php';</script>";
				 		break;
				 	case 'empleado':
				 		print "<script>window.location='../venta.php';</script>";
				 		break;

				 }	
			}
		}
	}
}



?>