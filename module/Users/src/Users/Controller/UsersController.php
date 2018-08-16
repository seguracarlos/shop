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
use Users\Form\UsersForm;
use Users\Model\Users;

class UsersController extends AbstractActionController
{
    protected $usersTable;
    protected $rolesTable;

     public function getUsersTable()
     {
         if (!$this->usersTable) {
             $sm = $this->getServiceLocator();
             $this->usersTable = $sm->get('Users\Model\UsersTable');
         }
         return $this->usersTable;
     }

     public function getRolesTable(){
        if(!$this->rolesTable){
            $sm = $this->getServiceLocator();
            $this->rolesTable = $sm->get('Users\Model\RolesTable');
        }
        return $this->rolesTable;        
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


     public function indexAction(){
        $users = $this->getUsersTable()->getAllUsersWithRoles();
        return new ViewModel(array('users' => $users));
          
     }

     public function addUserAction(){
        $form = new UsersForm();
        $form = $this->setFormSelectOptions($form, 0);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $users = new Users();
            $form->setInputFilter($users->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $users->exchangeArray($form->getData());
                $this->getUsersTable()->addUser($users);
                return $this->redirect()->toRoute('users/shop', array('controller'=>'users', 'action' => 'index'));
                
            }
        }
        return array('form' => $form);   
    }

    public function updateUserAction(){
        
        $id = (int) $this->params()->fromRoute('id', 0);
        $users = null;
        if (!$id) {
            return $this->redirect()->toRoute('users/shop', array('controller'=>'users', 'action' => 'addUser'));
        }
        try {
            $users = $this->getUsersTable()->getUserById($id);
            
        }
         catch (\Exception $ex) {
            echo "Hubo un error"; exit;
            return $this->redirect()->toRoute('users/shop', array('controller'=>'users', 'action' => 'index'));
            
        }
        $form  = new UsersForm();
        $form = $this->setFormSelectOptions($form, $users->rolId);
        $form->bind($users);
        $form->get('user_id')->setAttribute('value', $users->userId);
        
        //$form->get('rol_id')->setAttribute('value', $users->rolId);
        //$form->get('email')->setAttribute('value', $users->email); 
        //$form->get('password')->setAttribute('value', $users->password);
        /*$form->get('user_name')->setAttribute('value', $users->user_name);
        $form->get('first_name')->setAttribute('value', $users->firstName);
        $form->get('last_name')->setAttribute('value', $users->lastName);
        $form->get('address')->setAttribute('value', $users->address);
        $form->get('telephone')->setAttribute('value', $users->telephone);*/
        $form->get('submit')->setAttribute('value', 'Editar');

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setInputFilter($users->getInputFilter());
            $form->setData($request->getPost());

              if ($form->isValid()) {
                $this->getUsersTable()->addUser($users);
                return $this->redirect()->toRoute('users/shop', array('controller'=>'users', 'action' => 'index'));
            }
        }
           return array(
            'id' => $id,
            'form' => $form,
        );
    }

     public function deleteUserAction(){
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $userId = (int) $request->getPost('user_id');
            $this->getUsersTable()->deleteUser($userId);
            return $this->redirect()->toRoute('users/shop', array('controller'=>'users', 'action' => 'index'));
        }
    }



 }

 



