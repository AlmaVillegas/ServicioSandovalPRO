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

			$stm = $this->pdo->prepare("SELECT empleado.id, empleado.rfc, empleado.nombre, empleado.paterno, empleado.materno, empleado.puesto, empleado.status,domicilio.calle, domicilio.numero, domicilio.estado, domicilio.CodigoPostal, domicilio.colonia, telefono.telefono FROM empleado
										left outer join empleado_has_domicilio
										left join domicilio 
										on domicilio.id = empleado_has_domicilio.id_domicilio
										on empleado_has_domicilio.id_empleado=empleado.id
										left outer join empleado_has_telefono
										left join telefono 
										on telefono.id = empleado_has_telefono.id_telefono
										on empleado_has_telefono.id_empleado=empleado.id");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$emp = new Empleado();
				$dom = new Domicilio();
				$tel = new Telefono();
			
 
				$emp->__SET('id', $r->id);
				$emp->__SET('RFC', $r->rfc);
				$emp->__SET('Nombre', $r->nombre);
				$emp->__SET('Paterno', $r->paterno);
				$emp->__SET('Materno', $r->materno);
				$emp->__SET('Puesto', $r->puesto);
				$emp->__SET('Status', $r->status);
				$dom->__SET('Calle', $r->calle);
				$dom->__SET('Numero', $r->numero);
				$dom->__SET('Estado', $r->estado);
				$dom->__SET('CodigoPostal', $r->CodigoPostal);
				$dom->__SET('Colonia', $r->colonia);
				$emp->__SET('domicilios',$dom);
				$tel->__SET('Telefono', $r->telefono);
				$emp->__SET('telefonos',$tel);
				//echo $alm->__GET('domicilios')->__GET('Calle');
				$result[] = $emp;
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
			$stm = $this->pdo->prepare("SELECT * FROM empleado WHERE id = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$emp = new Empleado();

			$emp->__SET('id', $r->id);
			$emp->__SET('RFC', $r->rfc);
			$emp->__SET('Nombre', $r->nombre);
			$emp->__SET('Paterno', $r->paterno);
			$emp->__SET('Materno', $r->materno);
			$emp->__SET('Puesto', $r->puesto);
			$emp->__SET('Status', $r->status);

			return $emp;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Buscar($id)
	{
		try 
		{
			$stm = $this->pdo->prepare("SELECT * FROM empleado WHERE id = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);
			$emp = new Empleado();

			$emp->__SET('id', $r->id);
			$emp->__SET('RFC', $r->rfc);
			$emp->__SET('Nombre', $r->nombre);
			$emp->__SET('Paterno',$r->paterno);
			$emp->__SET('Materno',$r->materno);
			$emp->__SET('Puesto',$r->puesto);
			$emp->__SET('Status', $r->status);

			return $emp;

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
			          ->prepare("UPDATE empleado SET status='INACTIVO' WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}

	public function Actualizar(Empleado $data)
	{
		try 
		{
			$sql = "UPDATE empleado SET 
						rfc            = ?,
						nombre         = ?,
						paterno        = ?,
						materno        = ?,
						puesto         = ?
				        WHERE      id = ? ";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('RFC'),
					$data->__GET('Nombre'), 
					$data->__GET('Paterno'),
					$data->__GET('Materno'),
					$data->__GET('Puesto'),
					$data->__GET('id')
					)
				);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Empleado $data)
	{
		$modelDo = new DomicilioModel();
		$modelTe = new TelefonoModel();

         $this->pdo->beginTransaction();

	     $sql = "INSERT INTO empleado (rfc,nombre,paterno,materno,puesto,status) 
		        VALUES (?, ?, ?, ?, ?, \"ACTIVO\")";
		try 
		{
			$this->pdo->prepare($sql)
              -> execute(
			array(
				$data->__GET('rfc'),
				$data->__GET('Nombre'), 
				$data->__GET('Paterno'),
				$data->__GET('Materno'),
				$data->__GET('Puesto'),
				)
			);
               
            $dom=$data->__GET('domicilios');
       		$modelDo->Registrar($dom);
       		$tel=$data->__GET('telefonos');
       		$modelTe->Registrar($tel);

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
			$sql = "INSERT INTO empleado_has_domicilio (SELECT max(empleado.id), max(domicilio.id) from empleado, domicilio);";

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
			$sql = "INSERT INTO empleado_has_telefono (SELECT max(empleado.id), max(telefono.id) from empleado, telefono);";

			$this->pdo->prepare($sql)
			     ->execute(
				);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
       
	}
}
