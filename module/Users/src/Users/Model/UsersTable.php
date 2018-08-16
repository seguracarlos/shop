<?php 

 namespace Users\Model;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Sql\Select;
 use Zend\Db\Sql\Sql;


 class UsersTable
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

     public function getUserById($userId)
     {
         $userId  = (int) $userId;
         $rowset = $this->tableGateway->select(array('user_id' => $userId));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $iserId");
         }
         return $row;
     }

       public function getAllUsersWithRoles(){
        
        $sql = new Sql($this->tableGateway->getAdapter());
        $select = new Select();
        $select->from(array('u' => 'users'))
        ->join(array('r' => 'roles'), 'r.rol_id = u.rol_id', array('roles' => 'rol_name'));    
        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        
        return $results;
     }


     public function addUser(Users $users)
     {
         $data = array(
             'rol_id' => $users->rolId,
             'email'  => $users->email,
             'password'  => $users->password,
             /*'user_name'  => $users->userName,
             'first_name'  => $users->firstName,
             'last_name'  => $users->lastName,
             'address'  => $users->address,
             'telephone'  => $users->telephone,*/
         );

         $userId = (int) $users->userId;
         if ($userId == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getUserById($userId)) {
                 $this->tableGateway->update($data, array('user_id' => $userId));
             } else {
                 throw new \Exception('Users id does not exist');
             }
         }
     }

     public function deleteUser($id)
     {
         $this->tableGateway->delete(array('user_id' => (int) $userId));
     }
 }

 ?>