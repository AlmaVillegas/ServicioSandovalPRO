<?php
class DomicilioModel
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

			$stm = $this->pdo->prepare("SELECT * FROM domicilio ");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$dom = new Domicilio();
 
				$dom->__SET('id', $r->id);
				$dom->__SET('Calle', $r->Calle);
				$dom->__SET('Numero', $r->Numero);
				$dom->__SET('Estado', $r->Estado);
				$dom->__SET('CodigoPostal',$r->CodigoPostal);
				$dom->__SET('Colonia', $r->Colonia);
				$result[] = $dom;
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

			$stm = $this->pdo->prepare("SELECT id_domicilio FROM empleado_has_domicilio  where empleado_has_domicilio.id_empleado= ? ");
			$stm->execute(array($id));
			$r= $stm->fetch(PDO::FETCH_OBJ);

			$stm = $this->pdo->prepare("SELECT * FROM domicilio WHERE id = ?");
			$stm->execute(array($r->id_domicilio));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$dom = new Domicilio();

			$dom->__SET('id', $r->id);
			$dom->__SET('Calle', $r->calle);
			$dom->__SET('Numero', $r->numero);
			$dom->__SET('Estado', $r->estado);
			$dom->__SET('CodigoPostal',$r->codigopostal);
			$dom->__SET('Colonia', $r->colonia);

			return $dom;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Buscar($id)
	{
		try 
		{

			$stm = $this->pdo->prepare("SELECT id_domicilio FROM empleado_has_domicilio  where empleado_has_domicilio.id_empleado= ? ");
			$stm->execute(array($id));
			$r= $stm->fetch(PDO::FETCH_OBJ);

			$stm = $this->pdo->prepare("SELECT * FROM domicilio WHERE id = ?");
			$stm->execute(array($r->id_domicilio));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$dom = new Domicilio();

			$dom->__SET('id', $r->id);
			$dom->__SET('Calle', $r->calle);
			$dom->__SET('Numero', $r->numero);
			$dom->__SET('Estado', $r->estado);
			$dom->__SET('CodigoPostal',$r->codigopostal);
			$dom->__SET('Colonia', $r->colonia);

			return $dom;
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
			          ->prepare("UPDATE domicilio SET status='inactivo' WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}

	public function Actualizar(Domicilio $data)
	{
		try 
		{
			$sql = "UPDATE domicilio SET 
						calle         = ?,
						numero        = ?, 
						estado        = ?,
						CodigoPostal  = ?,
						colonia       = ?
				         WHERE id = ? ";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('Calle'),
					$data->__GET('Numero'), 
					$data->__GET('Estado'), 
					$data->__GET('CodigoPostal'),
					$data->__GET('Colonia'),
					$data->__GET('id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Domicilio $data)
	{
		try 
		{
		$sql = "INSERT INTO domicilio (calle, numero, estado, codigopostal, Colonia) 
		        VALUES (?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('Calle'), 
				$data->__GET('Numero'),
				$data->__GET('Estado'), 
				$data->__GET('CodigoPostal'),
				$data->__GET('Colonia')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}


}