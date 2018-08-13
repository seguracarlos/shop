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
use Products\Model\Entity\Category;

class CategoryController extends AbstractActionController
{
    protected $categoryTable;

    public function getCategoryTable(){
        if(!$this->categoryTable){
            $sm = $this->getServiceLocator();
            $this->categoryTable = $sm->get('Products\Model\Entity\CategoryTable');
        }
        return $this->categoryTable;        
    }

    public function indexAction(){
        $categorys = $this->getCategoryTable()->fetchAll();
        return new ViewModel(array('categorys' => $categorys));
    }

    public function addCategoryAction(){
        $form = new CategoryForm();
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $category = new Category();
            $form->setInputFilter($category->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                
                
                $category->exchangeArray($form->getData());
                $this->getCategoryTable()->addCategory($category);
                //$this->flashMessenger()->addSuccessMessage("Se guardó correctamente la serie ". $serie->model.".");
                return $this->redirect()->toRoute('products/shop', array('controller'=>'category', 'action' => 'index'));
                
            }
        }
        return array('form' => $form);   
    }

    public function updateCategoryAction(){
        
        $id = (int) $this->params()->fromRoute('id', 0);
        $category = null;
        if (!$id) {
            return $this->redirect()->toRoute('products/shop', array('controller'=>'category', 'action' => 'addCategory'));
        }
        try {
            $category = $this->getCategoryTable()->getCategoryById($id);
            
        }
        catch (\Exception $ex) {
            //$this->flashMessenger()->addErrorMessage("No se encontró una serie con el id: ". $id.".");
            echo "Hubo un error"; exit;
            return $this->redirect()->toRoute('products/shop', array('controller'=>'category', 'action' => 'index'));
            
        }
         
        $form  = new CategoryForm();
        $form->bind($category);
        $form->get('category_id')->setAttribute('value', $category->categoryId);
        $form->get('category_name')->setAttribute('value', $category->categoryName); 
        $form->get('submit')->setAttribute('value', 'Editar');

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setInputFilter($category->getInputFilter());
            $form->setData($request->getPost());


            if ($form->isValid()) {
                $this->getCategoryTable()->addCategory($category);
                return $this->redirect()->toRoute('products/shop', array('controller'=>'category', 'action' => 'index'));
            }
        }
        
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteCategoryAction(){
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $categoryId = (int) $request->getPost('category_id');
            $this->getCategoryTable()->deleteCategory($categoryId);
            return $this->redirect()->toRoute('products/shop', array('controller'=>'category', 'action' => 'index'));
        }
    }

        

}
