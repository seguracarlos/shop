<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Productos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\CategoryForm;
use Zend\Db\Adapter\Adapter;
use Productos\Model\Entity\Category;

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
}
