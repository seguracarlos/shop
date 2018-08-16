<?php 

 namespace Users\Model;

  use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Sql\Select;
 use Zend\Db\Sql\Sql;

 class RolesTable
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

     public function getRolesById($rolId)
     {
         $rolId  = (int) $rolId;
         $rowset = $this->tableGateway->select(array('rol_id' => $rolId));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $rolId");
         }
         return $row;
     }

     public function addRoles(Roles $roles)
     {
         $data = array(
             'rol_name' => $roles->rolName,
             'description'  => $roles->description,
         );

         $rolId = (int) $roles->rolId;
         if ($rolId == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getRolesById($rolId)) {
                 $this->tableGateway->update($data, array('rol_id' => $rolId));
             } else {
                 throw new \Exception('Roles id does not exist');
             }
         }
     }

     public function deleteRoles($rolId)
     {
         $this->tableGateway->delete(array('rol_id' => (int) $rolId));
     }
 }

 ?>