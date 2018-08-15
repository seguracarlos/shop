<?php
namespace Products\Model\Entity;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Sql\Select;
 use Zend\Db\Sql\Sql;


 class ProductTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getProductById($productId)
     {
         $productId  = (int) $productId;
         $rowset = $this->tableGateway->select(array('product_id' => $productId));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("No se encontró la columna con el ID: $productId");
         }
         return $row;
     }

     public function getAllProductsWithCategory(){
        
        $sql = new Sql($this->tableGateway->getAdapter());
        $select = new Select();
        $select->from(array('p' => 'product'))  // tabla base
            ->join(array('c' => 'category'), 'c.category_id = p.category_id', array('categoria' => 'category_name'));   // join tabla de unión con alias
        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        
        return $results;
     }

     public function addProduct(Product $product)
     {
         $data = array(
             'category_id'  => $product->categoryId,
             'description'  =>$product->description,
             'barcode'      => $product->barcode,
             'image'        =>$product->image,
         );

         $productId = (int) $product->productId;
         if ($productId == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getProductById($productId)) {
                 $this->tableGateway->update($data, array('product_id' => $productId));
             } else {
                 throw new \Exception('No existe producto con este ID');
             }
         }
     }

     public function deleteProduct($productId)
     {
         $this->tableGateway->delete(array('product_id' => (int) $productId));
     }
 }

 ?>