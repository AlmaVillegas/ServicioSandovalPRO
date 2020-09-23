<?php
include('../class/classAsistencias.php');
$clase = new sistema;
$clase->conexion();

$codigo = $_POST['codigo'];
$fecha = date('Y-m-d');
$id_proveedor= $_POST['proveedor'];
$total= $_POST['total'];

$comprobar = mysql_num_rows(mysql_query("SELECT * FROM compra WHERE id_compra = '$codigo'"));

if($comprobar == 0){
	
	mysql_query("INSERT INTO compra (id_compra, fecha, id_proveedor, status)VALUES('$codigo','$fecha','$id_proveedor',\"PAGADO\") ");
	$_SESSION['id_compra'] = $codigo;

}else{
	
 	echo 'existe';
 
}
?>