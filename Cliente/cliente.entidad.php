<?php
class Cliente
{ 
	 private $id;
 	 private $RFC;
 	 private $Nombre;
     private $Paterno;
     private $Materno;
     private $Status;
     private $domicilios;
     private $telefonos;
     private $emails;
     private $ventas;
     
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