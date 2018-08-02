<?php
namespace Products\Model\Entity;
use Zend\Db\Tablegateway\Tablegateway;
use Zend\Db\Adapter\Adapter;

class Usuarios extends Tablegateway
{
	private $nombre;
	private $email;
	private $contrasena;


	public function __construct(Adapter $adapter = null, $database = null,
		ResultSet $selectResultPrototype = null)
	{
		return parent::__construct('usuarios',$adapter,$database,
			$selectResultPrototype);
	}


	private function cargaAtributos($datos=array())
	{
		$this->nombre=$datos["nombre"];
		$this->email=$datos["email"];
		$this->contrasena=$datos["contrasena"];
	}


	public function getUsuarios()
	{
		$resultSet = $this->select();
		return $resultSet->toArray();
	}


	public function getUsuarioPorId($id)
	{
		$id = (int) $id;
		$rowset = $this->select(array('id' => $id));
		$row = $rowset->current();
		if(!$row)
		{
			throw new \Exception("No hay registros asociados al valor $id");
			
		}
		return $row;
	}


	public function  addUsuario( $data=array())
	{
		self::cargaAtributos($data);
		//echo $this->nombre;
		$array=array
		(
			'nombre' => $this->nombre,
			'email' => $this->email,
			'contrasena' => $this->contrasena
		);
		$this->insert($array);		
	}
	public function updateUsuario($id, $nombre, $email,$contrasena)
	{
	$update=$this->update(array(
                                "nombre"    => $nombre,
                                "email"   => $email,
                                "contrasena"    => $contrasena
                                ),
                                array("id"=>$id));
         return $update;
	}
	public function deleteUsuario($id)
	{
		$this->delete(array("id"=>$id));
	}
	
}