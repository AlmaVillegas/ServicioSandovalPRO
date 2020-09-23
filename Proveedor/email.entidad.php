<?php
class Email
{ 
	 private $id;
 	 private $Email;
    
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