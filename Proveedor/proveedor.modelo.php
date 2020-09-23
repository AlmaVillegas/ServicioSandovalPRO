<?php
class ProveedorModel
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

			$stm = $this->pdo->prepare("SELECT proveedor.id, proveedor.rfc, proveedor.nombre, proveedor.status,domicilio.calle, domicilio.numero, domicilio.estado, domicilio.CodigoPostal, domicilio.colonia, telefono.telefono, email.email FROM proveedor
										left outer join proveedor_has_domicilio
										left join domicilio 
										on domicilio.id = proveedor_has_domicilio.id_domicilio
										on proveedor_has_domicilio.id_proveedor=proveedor.id
										left outer join proveedor_has_telefono
										left join telefono 
										on telefono.id = proveedor_has_telefono.id_telefono
										on proveedor_has_telefono.id_proveedor=proveedor.id
										left outer join proveedor_has_email
										left join email
										on email.id = proveedor_has_email.id_email
										on proveedor_has_email.id_proveedor=proveedor.id");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$pro = new Proveedor();
				$dom = new Domicilio();
				$tel = new Telefono();
				$em  = new Email();
 
				$pro->__SET('id', $r->id);
				$pro->__SET('RFC', $r->rfc);
				$pro->__SET('Nombre', $r->nombre);
				$pro->__SET('Status', $r->status);
				$dom->__SET('Calle', $r->calle);
				$dom->__SET('Numero', $r->numero);
				$dom->__SET('Estado', $r->estado);
				$dom->__SET('CodigoPostal', $r->CodigoPostal);
				$dom->__SET('Colonia', $r->colonia);
				$pro->__SET('domicilios',$dom);
				$tel->__SET('Telefono', $r->telefono);
				$pro->__SET('telefonos',$tel);
				 $em->__SET('Email', $r->email);
				$pro->__SET('emails', $em);
				//echo $alm->__GET('domicilios')->__GET('Calle');
				$result[] = $pro;
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

			$stm = $this->pdo->prepare("SELECT * From proveedor");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$pro = new Proveedor();
				$pro->__SET('id', $r->id);
				$pro->__SET('RFC', $r->rfc);
				$pro->__SET('Nombre', $r->nombre);
				$pro->__SET('Status', $r->status);
				//echo $alm->__GET('domicilios')->__GET('Calle');
				$result[] = $pro;
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
			$stm = $this->pdo->prepare("SELECT * FROM proveedor WHERE id = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$pro = new Proveedor();

			$pro->__SET('id', $r->id);
			$pro->__SET('RFC', $r->rfc);
			$pro->__SET('Nombre', $r->nombre);
			$pro->__SET('Status', $r->status);

			return $pro;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Buscar($id)
	{
		try 
		{
			$stm = $this->pdo->prepare("SELECT * FROM proveedor WHERE id = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$pro = new Proveedor();

			$pro->__SET('id', $r->id);
			$pro->__SET('RFC',$r->rfc);
			$pro->__SET('Nombre', $r->nombre);
			$pro->__SET('Status', $r->status);

			return $pro;
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
			          ->prepare("UPDATE proveedor SET status='INACTIVO' WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}

	public function Actualizar(Proveedor $data)
	{
		try 
		{
			$sql = "UPDATE proveedor SET 
						rfc            = ?,
						nombre         = ?
				        WHERE      id = ? ";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('RFC'),
					$data->__GET('Nombre'), 
					$data->__GET('id')
					)
				);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Proveedor $data)
	{
		$modelDo = new DomicilioModel();
		$modelTe = new TelefonoModel();
		$modelEm = new EmailModel();

         $this->pdo->beginTransaction();

	     $sql = "INSERT INTO proveedor (rfc,nombre,status) 
		        VALUES (?, ?, \"ACTIVO\")";
		try 
		{
			$this->pdo->prepare($sql)
              -> execute(
			array(
				$data->__GET('RFC'),
				$data->__GET('Nombre'), 
				)
			);
               
            $dom=$data->__GET('domicilios');
       		$modelDo->Registrar($dom);
       		$tel=$data->__GET('telefonos');
       		$modelTe->Registrar($tel);
       		$em=$data->__GET('emails');
       		$modelEm->Registrar($em);

            $this->pdo->commit();
		}
		catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}

	public function ObtenerDomicilio()
	{
		try 
		{
			$sql = "INSERT INTO proveedor_has_domicilio (SELECT max(proveedor.id), max(domicilio.id) from proveedor, domicilio);";

			$this->pdo->prepare($sql)
			     ->execute(
				);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
       
	}

	public function ObtenerTelefono()
	{
		try 
		{
			$sql = "INSERT INTO proveedor_has_telefono (SELECT max(proveedor.id), max(telefono.id) from proveedor, telefono);";

			$this->pdo->prepare($sql)
			     ->execute(
				);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
       
	}

	public function ObtenerEmail()
	{
		try 
		{
			$sql = "INSERT INTO proveedor_has_email (SELECT max(proveedor.id), max(email.id) from proveedor, email);";

			$this->pdo->prepare($sql)
			     ->execute(
				);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
       
	}
}
