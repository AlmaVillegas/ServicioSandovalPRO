<?php
class EmailModel
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

			$stm = $this->pdo->prepare("SELECT * FROM email");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$em = new Email();
 
				$em->__SET('id', $r->id);
				$em->__SET('Email', $r->email);
				$result[] = $em;
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

			$stm = $this->pdo->prepare("SELECT id_email FROM proveedor_has_email  where proveedor_has_email.id_proveedor= ? ");
			$stm->execute(array($id));
			$r= $stm->fetch(PDO::FETCH_OBJ);

			$stm = $this->pdo->prepare("SELECT * FROM email WHERE id = ?");
			$stm->execute(array($r->id_email));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$em = new Email();

			$em->__SET('id', $r->id);
			$em->__SET('Email', $r->email);

			return $em;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Buscar($id)
	{
		try 
		{

			$stm = $this->pdo->prepare("SELECT id_email FROM proveedor_has_email  where proveedor_has_email.id_proveedor= ? ");
			$stm->execute(array($id));
			$r= $stm->fetch(PDO::FETCH_OBJ);

			$stm = $this->pdo->prepare("SELECT * FROM email WHERE id = ?");
			$stm->execute(array($r->id_email));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$em = new Email();

			$em->__SET('id', $r->id);
			$em->__SET('Email', $r->email);

			return $em;
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
			          ->prepare("UPDATE telefono SET status='INACTIVO' WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}

	public function Actualizar(Email $data)
	{
		try 
		{
			$sql = "UPDATE email SET 
						  email           = ?
				          WHERE id        = ? ";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('Email'),
					$data->__GET('id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Email $data)
	{
		try 
		{
		$sql = "INSERT INTO email (email) VALUES (?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('Email')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}


}