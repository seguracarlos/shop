<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

 namespace Usuario\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;

 class UsuarioController extends AbstractActionController
 {
 	public $dbAdapter;

    public function indexAction(){
        return new ViewModel();
    }

    public function registroAction(){
		if($this->getRequest()->isPost()){
		$this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $u=new Usuarios($this->dbAdapter);
		$data=$this->request->getPost();
		$u->addUsuarios($data);
	return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/application/roles/registro/1');
		}else{
		$form=new Formularios("form");
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
        $u=new Usuarios($this->dbAdapter);
        $usuario=$u->getUsuarioPorId($id);
        $form=new Formularios("form");
        $form->setData($usuario);
        $vista=array("form"=>$form);
        if($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if($form->isValid()){
                $id=$this->request->getPost("id");
                $nombre=$this->request->getPost("nombre");
                $correo=$this->request->getPost("correo");
                $contrasena=$this->request->getPost("contrasena");
                 $telf=$this->request->getPost("telf");
                $update=$u->updateUsuarios($id, $nombre,$correo,$contrasena,$telf);
                if($update==true){
                    $this->flashMessenger()->setNamespace("add_correcto")->addMessage("Usuario modificado correctamente");
                    return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/application/index/index');
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
            $u=new Usuarios($this->dbAdapter);
            $delete=$u->deleteUsuarios($id);
                if($delete==true){
            $this->flashMessenger()->setNamespace("eliminado")->addMessage("Usuario eliminado correctamente");
               }else{
            $this->flashMessenger()->setNamespace("eliminado")->addMessage("El usuario no a podido ser eliminado");
               }   
       return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/application/');
    }
    	
}



 