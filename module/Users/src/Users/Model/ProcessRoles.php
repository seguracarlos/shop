<?php

namespace Users\Model;

class ProcessRoles {

	private $rol_name;
	private $description;

	public function __construct($datos=array()){
		$this->rol_name=$datos["rol_name"];
		$this->description=$datos["description"];
	}

	public function getData(){
		$array=array($this->rol_name,$this->description);
		return $array;
	}
}
?>