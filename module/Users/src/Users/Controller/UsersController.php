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

     public function getUsersTable()
     {
         if (!$this->usersTable) {
             $sm = $this->getServiceLocator();
             $this->usersTable = $sm->get('Users\Model\UsersTable');
         }
         return $this->usersTable;
     }


     public function indexAction()
     {
          return new ViewModel(array(
               'users' => $this->getUsersTable()->fetchAll(),
          ));
     }

     public function addUserAction(){
        $form = new UsersForm();
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $users = new Users();
            $form->setInputFilter($users->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $users->exchangeArray($form->getData());
                $this->getUsersTable()->addUser($users);
                //$this->flashMessenger()->addSuccessMessage("Se guardó correctamente la serie ". $serie->model.".");
                return $this->redirect()->toRoute('users/shop', array('controller'=>'users', 'action' => 'index'));
                
            }
        }
        return array('form' => $form);   
    }

    public function updateUserAction(){
        
        $userId = (int) $this->params()->fromRoute('user_id', 0);
        $users = null;
        if (!$userId) {
            return $this->redirect()->toRoute('users/shop', array('controller'=>'users', 'action' => 'addUser'));
        }
        try {
            $users = $this->getUsersTable()->getUserById($userId);
            
        }
         catch (\Exception $ex) {
            //$this->flashMessenger()->addErrorMessage("No se encontró una serie con el id: ". $id.".");
            echo "Hubo un error"; exit;
            return $this->redirect()->toRoute('users/shop', array('controller'=>'users', 'action' => 'index'));
            
        }
        $form  = new UsersForm();
        $form->bind($users);
        $form->get('user_id')->setAttribute('value', $users->userId);
        $form->get('rol_id')->setAttribute('value', $users->rolId);
        $form->get('email')->setAttribute('value', $users->email); 
        $form->get('password')->setAttribute('value', $users->password);
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
            'user_id' => $userId,
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

 



