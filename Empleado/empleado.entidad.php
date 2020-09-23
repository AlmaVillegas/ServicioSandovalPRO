<?php
class Empleado
{ 
	 private $id;
 	 private $RFC;
 	 private $Nombre;
 	 private $Paterno;
 	 private $Materno;
 	 private $Puesto;
     private $Status;
     private $domicilios;
     private $telefonos;
     
	public function __GET($k)
	{ 
		return $this->$k; 
	}
	public function __SET($k, $v)
	{ 
		return $this->$k = $v; 
	}
}
?>