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
    public function CategRecordAction()
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
              $this->getRequest()->getBaseUrl().'/products/category'
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
}
