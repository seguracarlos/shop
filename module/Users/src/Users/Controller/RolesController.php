<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

 namespace Users\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Zend\Db\Adapter\Adapter;
 use Zend\Form\RolesForm;
 use Zend\Model\Roles;
 use Zend\Model\ProcessRoles;

 

 class RolesController extends AbstractActionController
 {
 	public $dbAdapter;

    public function indexAction(){
       
        return new ViewModel();
    }

    public function verAction(){    
    $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
    $u=new Roles($this->dbAdapter);
    $id=(int) $this->params()->fromRoute('id',0);
    $valores=array(
        "titulo"=>"Detalles de un rol ",
        "datos" =>$u->getRolPorId($id)
    );
        return new ViewModel($valores);
    }

    public function registroAction(){
		if($this->getRequest()->isPost()){
		$this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $u=new Roles($this->dbAdapter);
		$data=$this->request->getPost();
		$u->addRoles($data);
	return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/users/users/registroRoles/1');
		}else{
		$form=new RolesForm("form");
		$id=(int)$this->params()->fromRoute('id',0);
		$valores=array("titulo"=>"Registros ",
		                "form"=>$form,
		                "url"=>$this->getRequest()->getBaseUrl(),
			        "id"=>$id
		);
             return new ViewModel($valores);
		}
	}


	public function modificarAction() {
        $id=( int ) $this ->params ( 'id' );
        $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $u=new Roles($this->dbAdapter);
        $usuario=$u->getRolesPorId($id);
        $form=new RolesForm("form");
        $form->setData($rol);
        $vista=array("form"=>$form);
        if($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if($form->isValid()){
                $id=$this->request->getPost("id");
                $rol_name=$this->request->getPost("rol_name");
                $description=$this->request->getPost("description");
                $update=$u->updateRoles($id, $rol_name,$description);
                if($update==true){
                    $this->flashMessenger()->setNamespace("add_correcto")->addMessage("Rol modificado correctamente");
                    return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/users/index/index');
                }else{
                    $this->flashMessenger()->setNamespace("duplicado")->addMessage("El usuario se ha modificado");
                    return $this->redirect()->refresh();
                }
            }else{
                $err=$form->getMessages();
                $vista=array("form"=>$form,'url'=>$this->getRequest()->getBaseUrl(),"error"=>$err);
            }
        }
         return new ViewModel($vista);
        }  
            
        
        public function eliminarAction(){
            $id=(int)$this->params('id');
            $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
            $u=new Roles($this->dbAdapter);
            $delete=$u->deleteRoles($id);
                if($delete==true){
            $this->flashMessenger()->setNamespace("eliminado")->addMessage("Rol eliminado correctamente");
               }else{
            $this->flashMessenger()->setNamespace("eliminado")->addMessage("El usuario no a podido ser eliminado");
               }   
       return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/users/');
    }
    public function recibeAction(){
        $data=$this->request->getPost();
        $processRoles=new ProcessRoles($data);
        $datos=$processRoles->getData();
        return new ViewModel(array('datos'=>$datos));
        }
    	
}



 