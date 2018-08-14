<?php
namespace Users;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
 
 use Zend\Db\Adapter\Adapter;
 use Users\Model\Roles;
 use Users\Model\RolesTable;
 use Users\Model\Users;
 use Users\Model\UsersTable;
 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\TableGateway\TableGateway;


class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
     public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
     public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'Users\Model\RolesTable' =>  function($sm) {
                     $tableGateway = $sm->get('RolesTableGateway');
                     $table = new RolesTable($tableGateway);
                     return $table;
                 },
                 'RolesTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Roles());
                     return new TableGateway('roles', $dbAdapter, null, $resultSetPrototype);
                 },
                 'Users\Model\UsersTable' =>  function($sm) {
                     $tableGateway = $sm->get('UsersTableGateway');
                     $table = new UsersTable($tableGateway);
                     return $table;
                 },
                 'UsersTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Users());
                     return new TableGateway('users', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }

 }
 



   
