<?php
class ProductosVen
{ 
	 private $id;
 	 private $Descripcion;
     private $Precio;
     private $Cantidad;
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