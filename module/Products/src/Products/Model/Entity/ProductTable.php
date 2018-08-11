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
         $productId  = (int) $id;
         $rowset = $this->tableGateway->select(array('product_id' => $productId));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $productId");
         }
         return $row;
     }

     public function getAllProductsWithCategory(){
        
        $sql = new Sql($this->tableGateway->getAdapter());
        $select = new Select();
        $select->from(array('p' => 'product'))  // tabla base
            ->join(array('c' => 'category'), 'p.product_id = c.category_id', array('categ' => 'category_name'));   // join tabla de unión con alias
        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        
        return $results;
     }

     public function saveProduct(Product $product)
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