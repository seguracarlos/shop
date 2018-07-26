<?php 

 namespace Usuarios\Model;

  // Add these import statements
  use Zend\Db\TableGateway\TableGateway;
  use Zend\Db\Adapter\Adapter;
  use Zend\Db\Sql\Sql;
  use Zend\Db\ResultSet\ResultSet;

 class Usuario extends TableGateway
 {
     private $id;
     private $rol_id;
     private $email;
     private $password;
    

    public function __construct(Adapter $adapter = null, $databaseSchema=null,ResultSet $selectResultPrototype =null){
        return parent::__construct('usuario',$adapter, $databaseSchema,$selectResultPrototype);   
    }

    private function cargaAtributos($datos=array()){
         $this->id=$datos["id"];
         $this->rol_id=$datos["rol_id"];
         $this->email=$datos["email"];
         $this->password=$datos["password"];
    }

    public function  getUsuario(){
        $datos=$this->select();
        return $datos->toArray();
    }

    public function getUsuarioPorId($id){
        $id=(int) $id;
        $rowset=$this->select(array('id'=>$id));
        $row=$rowset->current();
        if(!$row){
            throw new \Exception("no hay registros asignados al valor $id");
        }
        return $row;
    }

    public function addUsuarios($data=array()){
        self::cargaAtributos($data);
        $array=array(
            "rol_id"=>$this->rol_id,
            "email"=>$this->email,
            "password"=>$this->password,
        );
        $this->insert($array);
    }

    public function updateUsuarios($id,$rol_id,$email,$password){
        $update=$this->update(array(
            "rol_id"=>$rol_id,
            "email"=>$email,
            "password"=>$password,
        ),
        array("id"=>$id));
        return $update;

    }
     public function deleteUsuarios($id){
         $delete=$this->delete(array("id"=>$id));
         return $delete;
        }
    }
    ?>