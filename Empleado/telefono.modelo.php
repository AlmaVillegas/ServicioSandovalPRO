<?php
class TelefonoModel
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

			$stm = $this->pdo->prepare("SELECT * FROM telefono ");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$tel = new Telefono();
 
				$tel->__SET('id', $r->id);
				$tel->__SET('Telefono', $r->telefono);
				$result[] = $tel;
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

			$stm = $this->pdo->prepare("SELECT id_telefono FROM empleado_has_telefono  where empleado_has_telefono.id_empleado= ? ");
			$stm->execute(array($id));
			$r= $stm->fetch(PDO::FETCH_OBJ);

			$stm = $this->pdo->prepare("SELECT * FROM telefono WHERE id = ?");
			$stm->execute(array($r->id_telefono));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$tel = new Telefono();

			$tel->__SET('id', $r->id);
			$tel->__SET('Telefono', $r->telefono);

			return $tel;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Buscar($id)
	{
		try 
		{

			$stm = $this->pdo->prepare("SELECT id_telefono FROM empleado_has_telefono  where empleado_has_telefono.id_empleado= ? ");
			$stm->execute(array($id));
			$r= $stm->fetch(PDO::FETCH_OBJ);

			$stm = $this->pdo->prepare("SELECT * FROM telefono WHERE id = ?");
			$stm->execute(array($r->id_telefono));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$tel = new Telefono();

			$tel->__SET('id', $r->id);
			$tel->__SET('Telefono', $r->telefono);

			return $tel;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	public function Actualizar(Telefono $data)
	{
		try 
		{
			$sql = "UPDATE telefono SET 
						telefono         = ?
				         WHERE id        = ? ";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('Telefono'),
					$data->__GET('id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Telefono $data)
	{
		try 
		{
		$sql = "INSERT INTO telefono (telefono) 
		        VALUES ( ? )";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('Telefono') 
				));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}


}