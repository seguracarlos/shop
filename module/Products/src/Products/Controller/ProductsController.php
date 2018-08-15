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
use Products\Model\Entity\Product;
use Products\Form\ProductsForm;

class ProductsController extends AbstractActionController
{

    protected $categoryTable;
    protected $productTable;

    public function getCategoryTable(){
        if(!$this->categoryTable){
            $sm = $this->getServiceLocator();
            $this->categoryTable = $sm->get('Products\Model\Entity\CategoryTable');
        }
        return $this->categoryTable;        
    }

    public function getProductTable(){
        if (!$this->productTable) {
            $sm = $this->getServiceLocator();
            $this->productTable = $sm->get('Products\Model\Entity\ProductTable');
        }
        return $this->productTable;
    }

    public function pruebaAction(){
    	return new ViewModel();
    }

    public function indexAction(){
        $products = $this->getProductTable()->getAllProductsWithCategory();

        return new ViewModel(array('products' => $products));
    }

    public function addProductAction(){
        $form = new ProductsForm();
        $form = $this->setFormSelectOptions($form, 0);
        
        $request = $this->getRequest();
        if ($request->isPost()) {

            $product = new Product();
            $form->setInputFilter($product->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                
                
                $product->exchangeArray($form->getData());
                $this->getProductTable()->addProduct($product);
                //$this->flashMessenger()->addSuccessMessage("Se guardó correctamente la serie ". $serie->model.".");
                return $this->redirect()->toRoute('products/shop', array('controller'=>'products', 'action' => 'index'));
                
            }
        }
        return array('form' => $form);   
    }

    public function updateProductAction(){
        
        $id = (int) $this->params()->fromRoute('id', 0);
        $product = null;
        if (!$id) {
            return $this->redirect()->toRoute('products/shop', array('controller'=>'products', 'action' => 'addProduct'));
        }
        try {
            $product = $this->getProductTable()->getProductById($id);
            
        }
        catch (\Exception $ex) {
            //$this->flashMessenger()->addErrorMessage("No se encontró una serie con el id: ". $id.".");
            echo "Hubo un error"; exit;
            return $this->redirect()->toRoute('products/shop', array('controller'=>'products', 'action' => 'index'));
            
        }
         
        $form  = new ProductsForm();
        $form = $this->setFormSelectOptions($form, $product->categoryId);
        $form->bind($product);
        $form->get('product_id')->setAttribute('value', $product->productId);
        //$form->get('category_name')->setAttribute('value', $category->categoryName); 
        $form->get('submit')->setAttribute('value', 'Editar');

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setInputFilter($product->getInputFilter());
            $form->setData($request->getPost());


            if ($form->isValid()) {
                $this->getProductTable()->addProduct($product);
                return $this->redirect()->toRoute('products/shop', array('controller'=>'products', 'action' => 'index'));
            }
        }
        
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteProductAction(){
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $productId = (int) $request->getPost('product_id');
            $this->getProductTable()->deleteProduct($productId);
            return $this->redirect()->toRoute('products/shop', array('controller'=>'products', 'action' => 'index'));
        }
    }

    private function setFormSelectOptions($formCategory, $valueDefault){
        $categorys = array();
        foreach ($this->getCategoryTable()->fetchAll() as $category)
        {
            $categorys += array($category->categoryId => $category->categoryName );
        }
        $formCategory->get('category_id')->setValueOptions($categorys);
        if($valueDefault != 0){
            $formCategory->get('category_id')->setValue($valueDefault);            
        }
        return $formCategory;
    }
    
}
