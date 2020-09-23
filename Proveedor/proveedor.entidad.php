<?php
class Proveedor
{ 
	 private $id;
 	 private $RFC;
 	 private $Nombre;
     private $Status;
     private $domicilios;
     private $telefonos;
     private $emails;
     
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