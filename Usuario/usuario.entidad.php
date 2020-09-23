<?php
class Usuario
{		 
	 private $id;
 	 private $Usuario;
 	 private $Password;
     private $Nombre;
     private $Imagen;

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