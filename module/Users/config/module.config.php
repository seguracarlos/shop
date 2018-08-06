<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Users;

return array(
 'controllers' => array(
        'invokables' => array(
            'Users\Controller\Users' =>'Users\Controller\UsersController',
            'Users\Controller\Users' =>'Users\Controller\RolesController',
        ),
    ),
        
    'router' => array(
        'routes' => array(
            'users' => array(
                'type' => 'Segment',
                'options' => array(
                     'route' => '/users[/[:action]]',
                    'constraints' => array(
                            'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'id'=>'[0-9]+',
                    ),
                    
                    'defaults' => array(
                        'controller' => 'Users\Controller\Users',
                        'action'     => 'index',
                    ),
                ),
            ),
          ),
     ),
     
     //Cargarmos el view manager
      'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'users/index/index' => __DIR__ . '/../view/users/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            'users' => __DIR__ . '/../view',
        ),
    ),

);

