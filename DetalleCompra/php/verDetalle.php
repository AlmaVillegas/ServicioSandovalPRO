<?php
include('../class/classAsistencias.php');
$clase = new sistema;
$clase->conexion();

$cod = $_POST['codigo'];
$codigo = substr($cod,1,-1);

$resultado = mysql_query("SELECT * FROM detallecompra WHERE id_compra = '$codigo' ");

echo '<table class="table table-bordered table-condensed table-hover">';
echo '<tr>';
	echo '<th>'."Id_Producto ".'</th>';
	echo '<th>'."Descripcion ".'</th>';
	echo '<th>'."Precio ".'</th>';
	echo '<th>'."Cantidad ".'</th>';
	echo '<th>'."Importe".'</th>';
	echo '</tr>';
while($mostrar = mysql_fetch_array($resultado)){
	echo '<tr>';
	echo '<td>'.$mostrar['id_productoscompra'].'</td>';
	echo '<td>'.$mostrar['descripcion'].'</td>';
	echo '<td>'.$mostrar['precio'].'</td>';
	echo '<td>'.$mostrar['cantidad'].'</td>';
	echo '<td>'.$mostrar['importe'].'</td>';
	echo '</tr>';
}
echo '</table>';
?>