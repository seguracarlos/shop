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
use Zend\Model\Usuers;

class UsersController extends AbstractActionController
{
	public $dbAdapter;

    public function indexAction()
    {
        return new ViewModel();
    }

    public function verAction(){    
    $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
    $u=new Users($this->dbAdapter);
    $id=(int) $this->params()->fromRoute('id',0);
    $valores=array(
        "titulo"=>"Usuarios ",
        "datos" =>$u->getUserPorId($id)
    );
        return new ViewModel($valores);
    }

    public function registroAction(){
		if($this->getRequest()->isPost()){
		$this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $u=new Users($this->dbAdapter);
		$data=$this->request->getPost();
		$u->addUsers($data);
	return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/users/roles/add/1');
		}else{
		$form=new UsersForm("form");
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
        $u=new Users($this->dbAdapter);
        $usuario=$u->getUserPorId($id);
        $form=new UsersForm("form");
        $form->setData($rol);
        $vista=array("form"=>$form);
        if($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if($form->isValid()){
                $id=$this->request->getPost("id");
                $rol_id=$this->request->getPost("rol_id")
                $email=$this->request->getPost("email");
                $password=$this->request->getPost("password");
                $user_name=$this->request->getPost("user_name");
                $first_name=$this->request->getPost("first_name");
                $last_name=$this->request->getPost("last_name");
                $address=$this->request->getPost("address");
                $telephone=$this->request->getPost("telephone");
                $update=$u->updateUsers($id, $rol_id,$email,$password,$user_name,$first_name,$last_name,$address,$telphone);
                if($update==true){
                    $this->flashMessenger()->setNamespace("add_correcto")->addMessage("User modificado correctamente");
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
            $u=new Users($this->dbAdapter);
            $delete=$u->deleteUser($id);
                if($delete==true){
            $this->flashMessenger()->setNamespace("eliminado")->addMessage("User eliminado correctamente");
               }else{
            $this->flashMessenger()->setNamespace("eliminado")->addMessage("El usuario no a podido ser eliminado");
               }   
       return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/users/');
    }
    public function recibeAction(){
        $data=$this->request->getPost();
        $procesa=new Procesa($data);
        $datos=$procesa->getData();
        return new ViewModel(array('datos'=>$datos));
        }
    	
}



 

 ?>