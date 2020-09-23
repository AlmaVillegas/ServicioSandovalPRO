<?php
class ProductosServicios
{ 
	 private $id;
 	 private $Descripcion;
 	 private $Precio;
 	 private $Venta;
     private $Cantidad;
     private $Minimo;
     private $Imagen; 
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