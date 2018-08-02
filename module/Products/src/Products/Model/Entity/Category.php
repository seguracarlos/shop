<?php
namespace Products\Model\Entity;
use Zend\Db\Tablegateway\Tablegateway;
use Zend\Db\Adapter\Adapter;

class Category extends Tablegateway
{
	private $category_id;
	private $category_name;
	private $description;

	/*Se crea el construtor*/
	public function __construct(Adapter $adapter = null, $database = null,
		ResultSet $selectResultPrototype = null)
	{
		return parent::__construct('category',$adapter,$database,
			$selectResultPrototype);
	}

	/*Metodo para cargar los atributos de la tabla*/
	private function cargaAtributos($datos=array())
	{
		$this->category_id=$datos["category_id"];
		$this->category_name=$datos["category_name"];
		$this->description=$datos["description"];
	}

	/*Metodo para cargar todas las categorias de la tabla Category*/
	public function getCategorias()
	{
		$resultSet = $this->select();
		return $resultSet->toArray();
	}

	/*Metodo para hacer una busqueda de una categoria por ID*/
	public function getCategoriaPorId($id)
	{
		$id = (int) $id;
		$rowset = $this->select(array('category_id' => $id));
		$row = $rowset->current();
		if(!$row)
		{
			throw new \Exception("No hay registros asociados al valor $id");
			
		}
		return $row;
	}

	/*Metodo para hacer una inserción a la tabla Category*/
	public function  addCategory( $data=array())
	{
		self::cargaAtributos($data);
		$array=array
		(

			'category_id' => $this->category_id,
			'category_name' => $this->category_name,
			'description' => $this->description
		);
		$this->insert($array);		
	}

	/*Metodo para actualizar los datos de una categoria*/
	public function updateUsuario($category_id, $category_name, $description)
	{
	$update=$this->update(array(
                                "category_name"    => $category_name,
                                "email"   => $description,
                                ),
                                array("category_id"=>$category_id));
         return $update;
	}

	/*Metodo para eliminar una categoria de la tabla*/
	public function deleteUsuario($id)
	{
		$this->delete(array("category_id"=>$category_id));
	}
	
}