<?php
class UsuarioModel
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

			$stm = $this->pdo->prepare("SELECT * FROM usuario");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$usu = new Usuario();
 				$usu->__SET('id', $r->id);
				$usu->__SET('Usuario', $r->usuario);
				$usu->__SET('Password', $r->password);
				$usu->__SET('Nombre', $r->nombre);
				$usu->__SET('Imagen', $r->imagen);				
				$result[] = $usu;
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
			$stm = $this->pdo->prepare("SELECT * FROM usuario WHERE id = ?");
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);
			$usu = new Usuario();
 			$usu->__SET('id', $r->id);
			$usu->__SET('Usuario', $r->usuario);
			$usu->__SET('Password', $r->password);
			$usu->__SET('Nombre', $r->nombre);
			$usu->__SET('Imagen', $r->imagen);	
			return $usu;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Buscar($id)
	{
		try 
		{
			$stm = $this->pdo->prepare("SELECT * FROM usuario WHERE id = ?");
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);
			$usu = new Usuario();
			$usu->__SET('id', $r->id);
			$usu->__SET('Usuario', $r->usuario);
			$usu->__SET('Password', $r->password);
			$usu->__SET('Nombre', $r->nombre);
			$usu->__SET('Imagen', $r->imagen);	

			return $usu;
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
			          ->prepare("DELETE FROM usuario WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}

	public function Actualizar(Usuario $data)
	{
		$nom=$_FILES['Imagen']['name'];
	    $tmp= $_FILES['Imagen']['tmp_name'];
	    $folder = 'imagenesUsuario';	
	    move_uploaded_file($tmp, $folder.'/'.$nom);

		//extrigo los bytes del archivo
		$bytesArchivo=file_get_contents($folder.'/'.$nom);
		$data->__SET('Imagen',$bytesArchivo);
		try 
		{
			$sql = "UPDATE usuario SET 
						usuario         = ?,
						password        = ?, 
						nombre  	    = ?,
						imagen   		=?
				        WHERE        id = ? ";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('Usuario'),
					$data->__GET('Password'), 
					$data->__GET('Nombre'),
					$data->__GET('Imagen'),
					$data->__GET('id')
					)
				);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Usuario $data)
	{
	    $nom=$_FILES['Imagen']['name'];
	    $tmp= $_FILES['Imagen']['tmp_name'];
	    $folder = 'imagenesUsuario';	
	    move_uploaded_file($tmp, $folder.'/'.$nom);

		//extrigo los bytes del archivo
		$bytesArchivo=file_get_contents($folder.'/'.$nom);
		$data->__SET('Imagen',$bytesArchivo);
	     
	    $this->pdo->beginTransaction(); 
	    $sql = "INSERT INTO usuario (usuario, password, nombre, imagen) 
		        VALUES (?, ?, ?, ?)";
		try 
		{
			
			$this->pdo->prepare($sql)
              -> execute(
			array(
				$data->__GET('Usuario'),
				$data->__GET('Password'), 
				$data->__GET('Nombre'),
				$data->__GET('Imagen')
			    )
			);
               $this->pdo->commit();
		}
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function InsertarImagen(Usuario $data)
	{
		$nom=$_FILES['Imagen']['name'];
	    $tmp= $_FILES['Imagen']['tmp_name'];
	    $folder = 'imagenesUsuario';	
	    move_uploaded_file($tmp, $folder.'/'.$nom);

		//extrigo los bytes del archivo
		$bytesArchivo=file_get_contents($folder.'/'.$nom);

		try 
		{
			$sql = "UPDATE usuario SET  
						imagen  	    = ?,
				        WHERE        id = ? ";

			$this->pdo->prepare($sql)
			     ->execute(
				array( 
					$data->__GET('$bytesArchivo'),
					$data->__GET('id')
					)
				);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}
}
