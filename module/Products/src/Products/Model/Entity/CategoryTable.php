<?php
namespace Products\Model\Entity;


 use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Sql\Select;
 use Zend\Db\Sql\Sql;


 class CategoryTable
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

     public function getCategoryById($categoryId)
     {
         $categoryId  = (int) $categoryId;
         $rowset = $this->tableGateway->select(array('category_id' => $categoryId));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $categoryId");
         }
         return $row;
     }

     public function addCategory(Category $category)
     {
         $data = array(

             'category_name'    =>$category->categoryName,
             'description'      => $category->description,
         );

         $categoryId = (int) $category->categoryId;
         if ($categoryId == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getCategoryById($categoryId)) {
                 $this->tableGateway->update($data, array('category_id' => $categoryId));
             } else {
                 throw new \Exception('No existe categoria con este ID');
             }
         }
     }

     public function deleteCategory($categoryId)
     {
         $this->tableGateway->delete(array('category_id' => (int) $categoryId));
     }
 }

 ?>