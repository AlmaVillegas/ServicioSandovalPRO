<?php
class DetalleModel
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
			$stm = $this->pdo->prepare("SELECT cliente.rfc, cliente.nombre, cliente.paterno, cliente.materno, 
				venta.fecha, venta.total, venta.status
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
				$cli->__SET('Paterno', $r->paterno);
				$cli->__SET('Materno', $r->materno);
				$ven->__SET('Fecha', $r->fecha);
				$ven->__SET('Total', $r->total);
				$ven->__SET('Status', $r->status);
				$ven->__SET('Materno', $r->materno);
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
			$stm = $this->pdo->prepare("SELECT * FROM detalleVenta");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$ven = new DetalleVenta();
				$ven->__SET('Id_venta',$r->id_venta);
				$ven->__SET('Descripcion', $r->descripcion);
				$ven->__SET('Cantidad', $r->cantidad);
				$ven->__SET('PrecioUnitario', $r->preciounitario);
				$ven->__SET('Importe', $r->importe);
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
			$stm = $this->pdo->prepare("SELECT * FROM detalleVenta WHERE id_venta = ?");
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$ven = new DetalleVenta();

			$ven->__SET('id_venta', $r->id);
			$ven->__SET('Id_productosVenta', $r->id_productosVenta);
			$ven->__SET('Descripcion', $r->descripcion);
			$ven->__SET('Cantidad', $r->cantidad);
			$ven->__SET('PrecioUnitario', $r->preciounitario);
			$ven->__SET('Importe', $r->importe);

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
			$stm = $this->pdo->prepare("SELECT * FROM detalleVenta WHERE id_venta = ?");
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$ven = new Venta();

			$ven->__SET('id_venta', $r->id);
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
			          ->prepare("UPDATE detalleventa SET status='Inactivo' WHERE id_venta = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}

	public function Actualizar(DetalleVenta $data)
	{
		try 
		{
			$sql = "UPDATE detalleventa SET  
						id_productosVenta  	= ?, 
						descripcion        	= ?,
						cantidad          	= ?,
						precio          	= ?,
						importe           	= ?
				        WHERE            id = ? ";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('Id_productosVenta'), 
					$data->__GET('Descripcion'),
					$data->__GET('Cantidad'),
					$data->__GET('Precio'),
					$data->__GET('Importe'),
					$data->__GET('id')
					)
				);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(DetalleVenta $data)
	{
	     $sql = "INSERT INTO detalleventa (id_venta, id_productosventa, descripcion, cantidad, precio, importe) 
		        VALUES (?, ?, ?, ?, ?, ?)";

		try 
		{
			$this->pdo->prepare($sql)
              -> execute(
			array(
				$data->__GET('Id_venta'), 
				$data->__GET('Id_productosVenta'),
				$data->__GET('Descripcion'),
				$data->__GET('Cantidad'), 
				$data->__GET('Precio'),
				$data->__GET('Importe'),
				)
			);
		}
		catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}

}