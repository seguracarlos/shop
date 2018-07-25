<?php

namespace Usuario\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\ResultSet\ResultSet;

class Roles extends TableGateway
{
	private $id;
	private $rol_name;
	private $description;

	public function __construct(Adapter $adapter = null, $databaseSchema=null,ResultSet $selectResultPrototype =null){
		return parent::__construct('roles',$adapter, $databaseSchema,$selectResultPrototype);	
	}

	private function cargaAtributos($datos=array()){
         $this->id=$datos["id"];
		 $this->nombre=$datos["rol_name"];
		 $this->correo=$datos["description"];
	}

	public function  getRoles(){
		$datos=$this->select();
		return $datos->toArray();
	}

	public function getRolesPorId($id){
		$id=(int) $id;
		$rowset=$this->select(array('id'=>$id));
		$row=$rowset->current();
		if(!$row){
			throw new \Exception("no hay registros asignados al valor $id");
		}
		return $row;
	}

	public function addRoles($data=array()){
		self::cargaAtributos($data);
		$array=array(
		    "rol_name"=>$this->rol_name,
		    "description"=>$this->description,
		);
		$this->insert($array);
	}

	public function updateRoles($id,$rol_name,$description){
		$update=$this->update(array(
			"rol_name"=>$rol_name,
			"description"=>$description,
		),
		array("id"=>$id));
		return $update;

	}
	 public function deleteRoles($id){
         $delete=$this->delete(array("id"=>$id));
         return $delete;
        }
    }
    ?>