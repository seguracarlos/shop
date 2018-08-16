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
use Users\Form\RolesForm;
use Users\Model\Roles;

class RolesController extends AbstractActionController
{
    protected $rolesTable;

    public function getRolesTable(){
        if(!$this->rolesTable){
            $sm = $this->getServiceLocator();
            $this->rolesTable = $sm->get('Users\Model\RolesTable');
        }
        return $this->rolesTable;        
    }

    public function indexAction(){
        $roles = $this->getRolesTable()->fetchAll();
        return new ViewModel(array('roles' => $roles));
    }

    public function addRolesAction(){
        $form = new RolesForm();
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $roles = new Roles();
            $form->setInputFilter($roles->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                
                
                $roles->exchangeArray($form->getData());
                $this->getRolesTable()->addRoles($roles);
                //$this->flashMessenger()->addSuccessMessage("Se guardó correctamente la serie ". $serie->model.".");
                return $this->redirect()->toRoute('users/shop', array('controller'=>'roles', 'action' => 'index'));
                
            }
        }
        return array('form' => $form);   
    }

    public function updateRolesAction(){
        
        $id = (int) $this->params()->fromRoute('id', 0);
        $roles = null;
        if (!$id) {
            return $this->redirect()->toRoute('users/shop', array('controller'=>'roles', 'action' => 'addRoles'
        ));
        }
        try {
            $roles = $this->getRolesTable()->getRolesById($id);
            //$roles = $this->getRolesTable()->getRoles($rolId);
             
        }
         catch (\Exception $ex) {
            echo "Hubo un error"; exit;
            return $this->redirect()->toRoute('users/shop', array('controller'=>'roles', 'action' => 'index'));
            
        }
         
       $form  = new RolesForm();
        $form->bind($roles);
        $form->get('rol_id')->setAttribute('value', $roles->rolId);
        $form->get('rol_name')->setAttribute('value', $roles->rolName);
        //$form->get('description')->setAttribute('value', $roles->description);
        $form->get('submit')->setAttribute('value', 'Editar');

        $request = $this->getRequest();
         if ($request->isPost()) {
            $form->setInputFilter($roles->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getRolesTable()->addRoles($roles);
                return $this->redirect()->toRoute('users/shop', array('controller'=>'roles', 'action' => 'index'));
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteRolesAction(){
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $rolId = (int) $request->getPost('rol_id');
            $this->getRolesTable()->deleteRoles($rolId);
            return $this->redirect()->toRoute('users/shop', array('controller'=>'roles', 'action' => 'index'));
        }
    }

        

}