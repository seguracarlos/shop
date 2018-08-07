<?php
namespace Products\Model\Entity;
use Zend\Db\Tablegateway\Tablegateway;
use Zend\Db\Adapter\Adapter;

class Usuarios extends Tablegateway
{
	private $product_id;
	private $category_id;
	private $description;
	private $barcode;
	private $image;

	public function __construct(Adapter $adapter = null, $database = null,
		ResultSet $selectResultPrototype = null)
	{
		return parent::__construct('product',$adapter,$database,
			$selectResultPrototype);
	}


	private function cargaAtributos($datos=array())
	{
		$this->product_id=$datos["product_id"];
		$this->category_id=$datos["category_id"];
		$this->description=$datos["description"];
		$this->barcode=$datos["barcode"];
		$this->image=$datos["image"];
	}


	public function getProducts()
	{
		$resultSet = $this->select();
		return $resultSet->toArray();
	}


	public function getProductsPorId($id)
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


	public function  addProduct( $data=array())
	{
		self::cargaAtributos($data);
		$array=array
		(
			'product_id' => $this->product_id,
			'category_id' => $this->category_id,
			'description' => $this->description,
			'barcode' => $this->barcode,
			'image' => $this->image
		);
		$this->insert($array);		
	}
	public function updateProduct($product_id, $category_id, $description,$barcode, $image)
	{
	$update=$this->update(array(
								"category_id"	=> $category_id
                                "description"   => $description,
                                "barcode"   	=> $barcode,
                                "image"    		=> $image
                                ),
                                array("product_id"=>$product_id));
         return $update;
	}
	public function deleteProduct($product_id)
	{
		$this->delete(array("product_id"=>$product_id));
	}
	
}