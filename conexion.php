<?php
	if(!empty($_SESSION['username'])){
		$usu=$_SESSION['username'];
	}
	
	$conexion = mysql_connect("localhost:3306","root","ramona");
	mysql_select_db("serviciosandoval",$conexion);
	
	date_default_timezone_set("America/Mexico_city");
?>