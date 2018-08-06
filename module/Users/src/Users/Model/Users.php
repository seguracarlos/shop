<?php 

 namespace Users\Model;

  // Add these import statements
  use Zend\Db\TableGateway\TableGateway;
  use Zend\Db\Adapter\Adapter;
  use Zend\Db\Sql\Sql;
  use Zend\Db\ResultSet\ResultSet;

 class Users extends TableGateway
 {
     private $id;
     private $rol_id;
     private $email;
     private $password;
     private $user_name;
     private $first_name;
     private $last_name;
     private $address;
     private $telephone;
  

    public function __construct(Adapter $adapter = null, $databaseSchema = null,
      ResultSet $selectResultPrototype = null)
    {
        return parent::__construct('users',$adapter, $databaseSchema,$selectResultPrototype);   
    }

    private function cargaAtributos($datos=array()){
         $this->id=$datos["id"];
         $this->rol_id=$datos["rol_id"];
         $this->email=$datos["email"];
         $this->password=$datos["password"];
         $this->user_name=$datos["user_name"];
         $this->first_name=$datos["first_name"];
         $this->last_name=$datos["last_name"];
         $this->address=$datos["address"];
         $this->telephone=$datos["telephone"];
    }

    public function  getUser(){
        $datos=$this->select();
        return $datos->toArray();
    }

    public function getUserPorId($id){
        $id=(int) $id;
        $rowset=$this->select(array('id'=>$id));
        $row=$rowset->current();
        if(!$row){
            throw new \Exception("no hay registros asignados al valor $id");
        }
        return $row;
    }

    public function addUser($data=array()){
        self::cargaAtributos($data);
        $array=array(
            "rol_id"=>$this->rol_id,
            "email"=>$this->email,
            "password"=>$this->password,
            "user_name"=>$this->user_name,
            "first_name"=>$this->first_name,
            "last_name"=>$this->last_name,
            "address"=>$this->address,
            "telephone"=>$this->telephone,
        );
        $this->insert($array);
    }

    public function updateUser($id,$rol_id,$email,$password,$user_name,$first_name,$last_name,$address,$telphone){
        $update=$this->update(array(
            "rol_id"=>$rol_id,
            "email"=>$email,
            "password"=>$password,
            "user_name"=>$user_name,
            "first_name"=>$first_name,
            "last_name"=>$last_name,
            "address"=>$address,
            "telephone"=>$telephone,
        ),
        array("id"=>$id));
        return $update;

    }
     public function deleteUser($id){
         $delete=$this->delete(array("id"=>$id));
         return $delete;
        }
    }
    ?>