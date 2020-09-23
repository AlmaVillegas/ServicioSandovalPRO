<?php
session_start();
include('conexion.php'); 
if(!isset($_SESSION["username"]))
        {
           header("Location:../index.php");
        } 
$usuario=$_SESSION['username'];
$idcode = $_GET['id'];
$sql=mysql_query("DELETE FROM caja_tmp where cod = ".$idcode);
if($sql)
{
	header('Location:caja.php?ddes=0');
}
else
	echo "error";
?>