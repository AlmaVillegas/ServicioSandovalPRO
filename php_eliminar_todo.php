<?php
session_start();
include('conexion.php'); 
if(!isset($_SESSION["username"]))
        {
           header("Location:../index.php");
        } 
$usuario=$_SESSION['username'];
$sql=mysql_query("TRUNCATE  caja_tmp;" );
if($sql)
{
	header('Location:caja.php?ddes=0');
}
else
	echo "error";
?>