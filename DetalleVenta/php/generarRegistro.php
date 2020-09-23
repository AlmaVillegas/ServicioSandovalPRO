<?php
include('../class/classAsistencias.php');
$clase = new sistema;
$clase->conexion();

$codigo = $_POST['codigo'];
$fecha = date('Y-m-d');
$id_cliente= $_POST['cliente'];


$comprobar = mysql_num_rows(mysql_query("SELECT * FROM venta WHERE id_venta = '$codigo'"));

if($comprobar == 0){
	
	mysql_query("INSERT INTO venta (id_venta, fecha, id_cliente, status)VALUES('$codigo','$fecha','$id_cliente',\"PAGADO\") ");
	$_SESSION['id_venta'] = $codigo;

}else{
	
 	echo 'existe';
 
}
?>