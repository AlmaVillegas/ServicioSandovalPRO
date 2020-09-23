<?php
session_start();
include('conexion.php'); 
if(!isset($_SESSION["username"]))
        {
           header("Location:../index.php");
        } 
$usuario=$_SESSION['username'];
$sql=mysql_query("TRUNCATE  caja_tmp2;" );
if($sql)
{
	header('Location:caja2.php?ddes=0');
}
else
	echo "error";
?>