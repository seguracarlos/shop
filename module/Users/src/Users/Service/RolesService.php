<?php
namespace Users\Service;

 class RolesService{
 	private $sm;
 	private $rolesTable;

 	public function __construct($sm){
 		$this->sm = $sm;
 	}

 	 public function getRolesTable(){
        if(!$this->rolesTable){
            //$sm = $this->getServiceLocator();
            $this->rolesTable = $this->sm->get('Users\Model\RolesTable');
        }
        return $this->rolesTable;        
    }
    public function getAllBrands(){
    	return $this->getBrandTable()->fetchAll();
    }
      private function setFormSelectOptions($formRoles, $valueDefault){
        $rol = array();
        foreach ($this->getRolesTable()->fetchAll() as $roles)
        {
            $rol += array($roles->rolId => $roles->rolName );
        }
        $formRoles->get('rol_id')->setValueOptions($rol);
        if($valueDefault != 0){
            $formRoles->get('rol_id')->setValue($valueDefault);            
        }
        return $formRoles;
    }
 }