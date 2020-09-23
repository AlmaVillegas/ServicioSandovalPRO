<?php
class ClienteModel
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

			$stm = $this->pdo->prepare("SELECT cliente.id, cliente.rfc, cliente.nombre, cliente.paterno, cliente.materno,
				cliente.status,domicilio.calle, domicilio.numero, domicilio.estado, domicilio.CodigoPostal, domicilio.colonia, telefono.telefono, email.email FROM cliente 
										left outer join cliente_has_domicilio
										left join domicilio 
										on domicilio.id = cliente_has_domicilio.id_domicilio
										on cliente_has_domicilio.id_cliente=cliente.id
										left outer join cliente_has_telefono
										left join telefono 
										on telefono.id = cliente_has_telefono.id_telefono
										on cliente_has_telefono.id_cliente=cliente.id
										left outer join cliente_has_email
										left join email
										on email.id = cliente_has_email.id_email
										on cliente_has_email.id_cliente=cliente.id");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$cli = new Cliente();
				$dom = new Domicilio();
				$tel = new Telefono();
				$em  = new Email();
 
				$cli->__SET('id', $r->id);
				$cli->__SET('RFC', $r->rfc);
				$cli->__SET('Nombre', $r->nombre);
				$cli->__SET('Paterno', $r->paterno);
				$cli->__SET('Materno', $r->materno);
				$cli->__SET('Status', $r->status);
				$dom->__SET('Calle', $r->calle);
				$dom->__SET('Numero', $r->numero);
				$dom->__SET('Estado', $r->estado);
				$dom->__SET('CodigoPostal', $r->CodigoPostal);
				$dom->__SET('Colonia', $r->colonia);
				$cli->__SET('domicilios',$dom);
				$tel->__SET('Telefono', $r->telefono);
				$cli->__SET('telefonos',$tel);
				 $em->__SET('Email', $r->email);
				$cli->__SET('emails', $em);
				//echo $alm->__GET('domicilios')->__GET('Calle');
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

			$stm = $this->pdo->prepare("SELECT cliente.id, cliente.nombre
                                       from cliente ");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$cli = new Cliente();
				
				$cli->__SET('id', $r->id);
				$cli->__SET('Nombre', $r->nombre);
				$result[] = $cli;
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
			$stm = $this->pdo->prepare("SELECT * FROM cliente WHERE id = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$cli = new Cliente();

			$cli->__SET('id', $r->id);
			$cli->__SET('RFC', $r->rfc);
			$cli->__SET('Nombre', $r->nombre);
			$cli->__SET('Paterno', $r->paterno);
			$cli->__SET('Materno',$r->materno);
			$cli->__SET('Status', $r->status);

			return $cli;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Buscar($id)
	{
		try 
		{
			$stm = $this->pdo->prepare("SELECT * FROM cliente WHERE id = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$cli = new Cliente();

			$cli->__SET('id', $r->id);
			$cli->__SET('RFC',$r->rfc);
			$cli->__SET('Nombre', $r->nombre);
			$cli->__SET('Paterno', $r->paterno);
			$cli->__SET('Materno',$r->materno);
			$cli->__SET('Status', $r->status);

			return $cli;
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
			          ->prepare("UPDATE cliente SET status='Inactivo' WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}
	public function Id_cliente($nombre)
		{
          	$mysql="SELECT id from cliente
							where nombre= ? ";
		    try
		    {
		    	$this->pdo->prepare($mysql)
		    	->execute(array($nombre));
		    }
		    catch (Exception $e){
		    	die($e->getMessage());

		    }
		}

	public function Actualizar(Cliente $data)
	{
		try 
		{
			$sql = "UPDATE cliente SET 
						rfc            = ?,
						nombre         = ?, 
						paterno        = ?, 
						materno        = ?
				        WHERE      id = ? ";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('RFC'),
					$data->__GET('Nombre'), 
					$data->__GET('Paterno'), 
					$data->__GET('Materno'),
					$data->__GET('id')
					)
				);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Cliente $data)
	{
		$modelDo = new DomicilioModel();
		$modelTe = new TelefonoModel();
		$modelEm = new EmailModel();

         $this->pdo->beginTransaction();

	     $sql = "INSERT INTO cliente (rfc,nombre,paterno,materno,status) 
		        VALUES (?, ?, ?, ?, \"Activo\")";
		try 
		{
			$this->pdo->prepare($sql)
              -> execute(
			array(
				$data->__GET('RFC'),
				$data->__GET('Nombre'), 
				$data->__GET('Paterno'), 
				$data->__GET('Materno')
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
			$sql = "INSERT INTO cliente_has_domicilio (SELECT max(cliente.id), max(domicilio.id) from cliente, domicilio);";

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
			$sql = "INSERT INTO cliente_has_telefono (SELECT max(cliente.id), max(telefono.id) from cliente, telefono);";

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
			$sql = "INSERT INTO cliente_has_email (SELECT max(cliente.id), max(email.id) from cliente, email);";

			$this->pdo->prepare($sql)
			     ->execute(
				);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
       
	}
	
		

}
