<?php
class Domicilio
{ 
	 private $id;
 	 private $Calle;
 	 private $Numero;
     private $Estado;
     private $CodigoPostal;
     private $Colonia;
    
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