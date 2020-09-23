<?php
//session_start();
class sistema{
		public function conexion(){
			$host     = 'localhost:3306';
			$usuario  = 'root';
			$password = 'ramona';
			$dataBase = 'serviciosandoval';
			
			$conexion = mysql_connect($host, $usuario, $password);
			$seleccion = mysql_select_db($dataBase, $conexion);
		
		}
		function mostrarAsistencias(){
			$sql = mysql_query("SELECT compra.id_compra, proveedor.nombre, compra.fecha, compra.nota, compra.total
							    FROM proveedor
								right join compra
			    				on proveedor.id = compra.id_proveedor
			    				order by compra.id_compra");
			if(mysql_num_rows($sql)>0){
				while($mostrar = mysql_fetch_array($sql)){
					$productos = mysql_num_rows(mysql_query("SELECT * FROM detallecompra WHERE id_compra = '".$mostrar['id_compra']."' "));
					echo '<tr>
								<td>'.$mostrar['id_compra'].'</td>
								<td>'.$mostrar['nombre'].'</td>
								<td>'.$mostrar['fecha'].'</td>
								<td>'.$mostrar['total'].'</td>
								<td>'.$mostrar['nota'].'</td>
								<td><input type="button" value="Detalle" class="btn btn-primary" onClick="verDetalle(/'.$mostrar['id_compra'].'/)"></td>
							</tr>';
				}
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
			}
		}
}