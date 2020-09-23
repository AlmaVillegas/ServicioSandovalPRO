<?php
class ProductosModel
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

			$stm = $this->pdo->prepare("SELECT * FROM productosyservicios");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$ven = new ProductosServicios();
 				$ven->__SET('id', $r->id);
				$ven->__SET('Descripcion', $r->descripcion);
				$ven->__SET('Precio', $r->precio);
				$ven->__SET('Venta', $r->venta);
				$ven->__SET('Cantidad', $r->cantidad);
				$ven->__SET('Minimo', $r->minimo);
				$ven->__SET('Imagen', $r->imagen);	
				$ven->__SET('Status', $r->status);
				
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
			$stm = $this->pdo->prepare("SELECT * FROM productosyservicios WHERE id = ?");
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$ven = new ProductosServicios();

			$ven->__SET('id', $r->id);
			$ven->__SET('Descripcion', $r->descripcion);
			$ven->__SET('Precio', $r->precio);
			$ven->__SET('Venta', $r->venta);
			$ven->__SET('Cantidad', $r->cantidad);
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
			$stm = $this->pdo->prepare("SELECT * FROM productosyservicios WHERE id = ?");
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$ven = new ProductosServicios();

			$ven->__SET('id', $r->id);
			$ven->__SET('Descripcion', $r->descripcion);
			$ven->__SET('Precio', $r->precio);
			$ven->__SET('Cantidad', $r->cantidad);
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
			          ->prepare("UPDATE productosyservicios SET status='Inactivo' WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}

	public function Actualizar(ProductosServicios $data)
	{
		try 
		{
			$sql = "UPDATE productosyservicios SET 
						descripcion        	= ?, 
						precio    	        = ?,
						venta               = ?,
						cantidad      		= ?
				             WHERE       id = ? ";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('Descripcion'),
					$data->__GET('Precio'), 
					$data->__GET('Venta'),
					$data->__GET('Cantidad'),
					$data->__GET('id')
					)
				);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(ProductosServicios $data)
	{

		$nom=$_FILES['Imagen']['name'];
	    $tmp= $_FILES['Imagen']['tmp_name'];
	    $folder = 'Productos';	
	    move_uploaded_file($tmp, $folder.'/'.$nom);

		//extrigo los bytes del archivo
		$bytesArchivo=file_get_contents($folder.'/'.$nom);
		$data->__SET('Imagen',$bytesArchivo);
	     $sql = "INSERT INTO productosyservicios (descripcion, precio, venta, cantidad, minimo, imagen, status) 
		        VALUES (?, ?, ?, ?, 10, ?, \"ACTIVO\")";
		try 
		{
			$this->pdo->prepare($sql)
              -> execute(
			array(
				$data->__GET('Descripcion'),
				$data->__GET('Precio'),
				$data->__GET('Venta'), 
				$data->__GET('Cantidad'), 
				$data->__GET('Imagen')
				)
			);
		}
		catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}

	
}
