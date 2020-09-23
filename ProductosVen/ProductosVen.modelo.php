<?php
class VentaPModel
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
			$stm = $this->pdo->prepare("SELECT productosventa.id, productosventa.descripcion 
				                        FROM productosventa");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$pventa = new ProductosVen(); 
				$pventa->__SET('id',$r->id);
				$pventa->__SET('Descripcion', $r->descripcion);
				$result[] = $pventa;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Buscar($Nombre)
	{
		try 
		{
			$stm = $this->pdo->prepare("SELECT * FROM productosventa WHERE Nombre = ?");
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
			          ->prepare("UPDATE productosventa SET status='Inactivo' WHERE id = ?");			          

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
			$sql = "UPDATE productosventa SET 
						nombre               = ?,
						Precio        		 = ?, 
						cantidad  			 = ? 
				        WHERE      			
				        id 					 = ? ";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('Nombre'),
					$data->__GET('Precio'), 
					$data->__GET('Cantidad'),
					$data->__GET('id')
					)
				);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(ProductoVen $data)
	{
	     $sql = "INSERT INTO productosventa (nombre, precio, cantidad, status) 
		        VALUES (?, ?, ?,  \"ACTIVO\")";
		try 
		{
			$this->pdo->prepare($sql)
              -> execute(
			array(
				$data->__GET('Nombre'),
				$data->__GET('Precio'), 
				$data->__GET('Cantidad')
				)
			);
		}
		catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}


	
}