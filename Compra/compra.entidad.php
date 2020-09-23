<?php
class Compra
{ 
	 private $id;
 	 private $Fecha;
 	 private $Id_proveedor;
     private $Total;
     private $Status;
     
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