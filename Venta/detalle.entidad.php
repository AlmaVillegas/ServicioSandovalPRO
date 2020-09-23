<?php
class DetalleVenta
{ 
	 private $id;
	 private $Id_venta;
     private $Id_productosVenta;
     private $Descripcion;
     private $Cantidad;
     private $Precio;
     private $Importe;
     
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