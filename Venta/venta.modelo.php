<?php
class VentaModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost; port=3306; dbname=serviciosandoval', 'root', 'ramona');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function Listar()
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("SELECT cliente.rfc, cliente.nombre,venta.fecha, venta.status
				FROM cliente
				right join venta
			    on cliente.id = venta.id_cliente");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$ven = new Venta();
				$cli = new Cliente();
				$cli->__SET('RFC', $r->rfc);
				$cli->__SET('Nombre', $r->nombre);
				$ven->__SET('Fecha', $r->fecha);
				$ven->__SET('Status', $r->status);
				$cli->__SET('ventas', $ven);
				$result[] = $cli;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
    public function Listar1()
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("SELECT venta.fecha, detalleventa.descripcion, detalleventa.cantidad, detalleventa.precio, detalleventa.importe, 
				 venta.status
				FROM detalleventa
				right join venta
			    on venta.id = detalleventa.id_venta;");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$ven = new Venta();
				$det = new DetalleVenta();
				$ven->__SET('Fecha', $r->fecha);
				$det->__SET('Descripcion',$r->descripcion);
				$det->__SET('Cantidad', $r->cantidad);
				$det->__SET('Precio', $r->precio);
				$det->__SET('Importe', $r->importe);
				$ven->__SET('Status', $r->status);
				$ven->__SET('detalles', $det);
				$result[] = $ven;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo->prepare("SELECT venta.id, venta.fecha, venta.id_cliente, venta.status FROM venta WHERE id = ?");
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$ven = new Venta();

			$ven->__SET('id', $r->id);
			$ven->__SET('Fecha', $r->fecha);
			$ven->__SET('Id_cliente', $r->id_cliente);
			$ven->__SET('Status', $r->status);

			return $ven;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Obtener1($id)
	{
		try 
		{
			$stm = $this->pdo->prepare("SELECT * FROM venta WHERE id = ?");
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$ven = new Venta();

			$ven->__SET('id', $r->id);
			$ven->__SET('Fecha', $r->fecha);
			$ven->__SET('Descripcion', $r->descripcion);
			$ven->__SET('Cantidad', $r->cantidad);
			$ven->__SET('PrecioUnitario', $r->preciounitario);
			$ven->__SET('Importe', $r->importe);
			$ven->__SET('Status', $r->status);
			return $ven;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Buscar($id)
	{
		try 
		{
			$stm = $this->pdo->prepare("SELECT * FROM venta WHERE id = ?");
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$ven = new Venta();

			$ven->__SET('id', $r->id);
			$ven->__SET('Fecha', $r->fecha);
			$ven->__SET('Id_cliente', $r->id_cliente);
			$ven->__SET('Id_productosVenta', $r->id_productosVenta);
			$ven->__SET('Descripcion', $r->descripcion);
			$ven->__SET('Cantidad', $r->cantidad);
			$ven->__SET('PrecioUnitario', $r->preciounitario);
			$ven->__SET('Importe', $r->importe);
			$ven->__SET('Status', $r->status);

			return $ven;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("UPDATE venta SET status='Inactivo' WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}

	public function Actualizar(Venta $data)
	{
		try 
		{
			$sql = "UPDATE venta SET 
						fecha               = ?,
						id_cliente        	= ?, 
				        WHERE      id = ? ";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('Fecha'),
					$data->__GET('Id_cliente'), 
					$data->__GET('id')
					)
				);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Venta $data)
	{
	     $sql = "INSERT INTO venta (fecha, id_cliente, status) 
		        VALUES ( ?,?, \"ACTIVO\")";
		try 
		{
			$this->pdo->prepare($sql)
              -> execute(
			array(
				$data->__GET('Fecha'),
				$data->__GET('Id_cliente'),
				//$data->__GET('Total')
				)
			);
		}
		catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}

	public function crearVenta(Venta $data, DetalleVenta $detalle)
	{
		 //crear venta
			$query ="INSERT INTO venta (fecha, id_cliente, total, status) 
		        VALUES ( ?, ?, ?, \"ACTIVO\")";
		 	$this->pdo->prepare($query)
              -> execute(
                $data->__GET('Fecha'),
				$data->__GET('Id_cliente'),
				$data->__GET('Total')
              );
         //rescatar la ultima venta(id)
             $query = "Select max(id) from venta";
             $res = $this->pdo->query($query);
              $idUltimaVenta = 0;
              if($reg =mysql_fetch_array($res))
              {
              	echo $idUltimaVenta = $reg[0];
              }
         // los insert en el detalle
              foreach ($detalle as $r) {
              	$query="INSERT INTO detalleventa (id_venta, id_productosventa, descripcion, cantidad, precio, importe) 
		        VALUES ('".$idUltimaVenta."',
		        '".$r->__GET('Id_productosVenta')."',
		        '".$r->__GET('Descripcion')."', 
		        '".$r->__GET('Cantidad')."',
		        '".$r->__GET('Precio')."', 
		        '".$r->__GET('Importe')."')";
		        $this->pdo->query($query);
              }
    }

}
?>

