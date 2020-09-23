<?php
class CompraModel
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

			$stm = $this->pdo->prepare("SELECT * FROM compra");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$com = new Compra();
 				$com->__SET('id', $r->id);
				$com->__SET('Fecha', $r->fecha);
				$com->__SET('Id_proveedor', $r->id_proveedor);
				$com->__SET('Id_productosCompra', $r->id_productosCompra);
				$com->__SET('Descripcion', $r->descripcion);
				$com->__SET('Cantidad', $r->cantidad);
				$com->__SET('PrecioUnitario', $r->preciounitario);
				$com->__SET('Total', $r->total);
				$com->__SET('Status', $r->status);
				
				$result[] = $com;
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
			$stm = $this->pdo->prepare("SELECT * FROM compra WHERE id = ?");
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$com = new Compra();

			$com->__SET('id', $r->id);
			$com->__SET('Fecha', $r->fecha);
			$com->__SET('Id_proveedor', $r->id_proveedor);
			$com->__SET('Id_productosCompra', $r->id_productosCompra);
			$com->__SET('Descripcion', $r->descripcion);
			$com->__SET('Cantidad', $r->cantidad);
			$com->__SET('PrecioUnitario', $r->preciounitario);
			$com->__SET('Total', $r->total);
			$com->__SET('Status', $r->status);

			return $com;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Buscar($id)
	{
		try 
		{
			$stm = $this->pdo->prepare("SELECT * FROM compra WHERE id = ?");
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$com = new Compra();

			$com->__SET('id', $r->id);
			$com->__SET('Fecha', $r->fecha);
			$com->__SET('Id_proveedor', $r->id_proveedor);
			$com->__SET('Id_productosCompra', $r->id_productosCompra);
			$com->__SET('Descripcion', $r->descripcion);
			$com->__SET('Cantidad', $r->cantidad);
			$com->__SET('PrecioUnitario', $r->preciounitario);
			$com->__SET('Total', $r->total);
			$com->__SET('Status', $r->status);

			return $com;
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
			          ->prepare("UPDATE compra SET status='Inactivo' WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}

	public function Actualizar(Compra $data)
	{
		try 
		{
			$sql = "UPDATE compra SET 
						fecha               = ?,
						id_proveedor        = ?, 
						id_productosCompra  = ?, 
						descripcion        	= ?,
						cantidad          	= ?,
						preciounitario    	= ?,
						total             	= ?
				        WHERE      id = ? ";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('Fecha'),
					$data->__GET('Id_proveedor'), 
					$data->__GET('Id_productosCompra'), 
					$data->__GET('Descripcion'),
					$data->__GET('Cantidad'),
					$data->__GET('PrecioUnitario'),
					$data->__GET('Total'),
					$data->__GET('id')
					)
				);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Compra $data)
	{
	     $sql = "INSERT INTO compra (fecha, id_proveedor, id_productosCompra, descripcion, cantidad, preciounitario, total, status) 
		        VALUES (?, ?, ?, ?, ?, ?, ?, \"ACTIVO\")";
		try 
		{
			$this->pdo->prepare($sql)
              -> execute(
			array(
				$data->__GET('Fecha'),
				$data->__GET('Id_proveedor'), 
				$data->__GET('Id_productosCompra'),
				$data->__GET('Descripcion'),
				$data->__GET('Cantidad'), 
				$data->__GET('PrecioUnitario'),
				$data->__GET('Total')
				)
			);
		}
		catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}

	
}
