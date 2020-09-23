<?php
//session_start();
class sistema{
		public function conexion(){
			$host        = 'localhost:3306';
			$usuario  = 'root';
			$password = 'ramona';
			$dataBase  = 'serviciosandoval';
			
			$conexion = mysql_connect($host, $usuario, $password);
			$seleccion = mysql_select_db($dataBase, $conexion);
		
		}
		function mostrarAsistencias(){
			$sql = mysql_query("SELECT venta.id_venta,venta.fecha, venta.total
				FROM venta ");
			if(mysql_num_rows($sql)>0){
				while($mostrar = mysql_fetch_array($sql)){
					$productos = mysql_num_rows(mysql_query("SELECT * FROM detalleventa WHERE id_venta = '".$mostrar['id_venta']."' "));
					echo '<tr>
								<td>'.$mostrar['id_venta'].'</td>>
								<td>'.$mostrar['fecha'].'</td>
								<td>'.$productos.'</td>
								<td>'.$mostrar['total'].'</td>
								<td><input type="button" value="Detalle" class="btn btn-primary" onClick="verDetalle(/'.$mostrar['id_venta'].'/)"></td>
							</tr>';
				}
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
			}
		}
}