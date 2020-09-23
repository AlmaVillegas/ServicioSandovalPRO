<?php
include('../class/classAsistencias.php');
$clase = new sistema;
$clase->conexion();
$suma=0;

$registro = $_SESSION['id_venta'];
$id_producto = $_POST['idp'];
$descripcion = $_POST['des'];
$precio = $_POST['pre'];
$cantidad =$_POST['can'];
$importe = $_POST['imp'];

mysql_query("INSERT INTO detalleventa (id_venta, id_productosventa, descripcion, precio, cantidad, importe)
	                            VALUES('$registro','$id_producto','$descripcion','$precio','$cantidad','$importe') ");

//DEVOLVER LOS NOMBRES DE LOS ESTUDIANTES REGISTRADOS
$resultado = mysql_query("SELECT * FROM detalleventa WHERE id_venta = '$registro' ");


echo '<table>';
while($mostrar = mysql_fetch_array($resultado)){
	echo $mostrar['id_productosventa'];
    echo ",  ";
	echo $mostrar['descripcion'];
    echo ",   ";
	echo $mostrar['precio'];
    echo ",  ";
	echo $mostrar['cantidad'];
	echo ",  ";
	echo $mostrar['importe'];
	echo "<br>";
	$suma+=$mostrar['importe'];
}
echo '</tr>';

echo '</table>';
echo "<input id='Total' value=".$suma." class= 'form-control' style='width:20%'; />";

mysql_query("UPDATE venta SET total='$suma' WHERE id_venta='$registro'");
?>