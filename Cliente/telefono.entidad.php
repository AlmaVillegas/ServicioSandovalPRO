<?php
class Telefono
{ 
	 private $id;
 	 private $Telefono;
    
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