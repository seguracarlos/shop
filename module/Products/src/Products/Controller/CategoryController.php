<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Products\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Products\Form\CategoryForm;
use Zend\Db\Adapter\Adapter;
use Products\Model\Entity\Category;

class CategoryController extends AbstractActionController
{
    public $dbAdapter;
    public function indexAction()
    {
        $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
    	$u=new Category($this->dbAdapter);
    	$titulo=array(
    		"titulo"	=>"Categorias",
    		"datos"		=> $u->getCategorias()

    	);
        return new ViewModel($titulo);
    }
    public function addCategoryAction()
    {
        
        if ($this->getRequest()->isPost()) 
        {
            $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
            $u=new Category($this->dbAdapter);
            $data=$this->request->getPost();
            $u->addCategory($data);
            $form = new CategoryForm("form");

            $valores=array
            (
                'titulo'=>"Registro de Categoria Exitoso",
                "form"=>$form,
                'url'=>$this->getRequest()->getBaseUrl(),
                
            );
            return $this->redirect()->toUrl(
              $this->getRequest()->getBaseUrl().'/products'
         );
            
        }else
        {

            //Zona del formulario
            $form = new CategoryForm("form");
            $valores=array
            (
                'titulo'=>"Registro de categoria",
                "form"=>$form,
                'url'=>$this->getRequest()->getBaseUrl(),
                
            );
            return new ViewModel($valores);
            }
    }
    public function viewAction()
    {
        $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $u=new Category($this->dbAdapter);
        $form = new CategoryForm("form");
        $id = (int) $this->params()->fromRoute('id',0);
        $titulo=array(
            "titulo"    =>"Mostrando detalle de la categoria",
            "form"      =>$form,
            "datos"     => $u->getCategoriaPorId($id)

        );
        return new ViewModel($titulo);
    }
    public function updateCategoryAction()
    {
        $id=$this->params()->fromRoute("id",null);
        $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
 
        $category=new Category($this->dbAdapter);         
        $categoria=$category->getCategoriaPorId($id);
 
        $form=new CategoryForm("form");
        $form->setData($categoria);
         
        $vista=array("form"=>$form);
        if($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if($form->isValid()){
                //Recogemos los datos del formulario
                $category_name=$this->request->getPost("category_name");
                $description=$this->request->getPost("description");
                 
                //Insertamos en la bd
                $update=$category->updateCategory($id, $category_name, $description);
                 return $this->redirect()->toUrl(
              $this->getRequest()->getBaseUrl().'/products'
         );

            }else{
                $vista=array("form"=>$form,'url'=>$this->getRequest()->getBaseUrl(),"error"=>$err);
            }
        }
         return new ViewModel($vista); 
    }

    public function deleteCategoryAction()
    {
         $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $u=new Category($this->dbAdapter);
        $form = new CategoryForm("form");
        $id = (int) $this->params()->fromRoute('id',null);
        $titulo=array(
            "titulo"    =>"Datos de la categoria eliminado",
            "datos"     => $u->deleteCategory($id)

        );
        return $this->redirect()->toUrl(
              $this->getRequest()->getBaseUrl().'/products'
         );
    }
}
