<?php
class Venta
{ 
	 private $id;
 	 private $Fecha;
 	 private $Id_cliente;
     private $Status;
     private $detalles;
     
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