<?php
return array(
 'controllers' => array(
        'invokables' => array(
            'Usuarios\Controller\Usuarios' =>'Usuarios\Controller\UsuariosController'
        ),
    ),
        
    'router' => array(
        'routes' => array(
            'usuarios' => array(
                'type' => 'Segment',
                'options' => array(
                     'route' => '/usuarios[/[:action]]',
                    'constraints' => array(
                            'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'id'=>'[0-9]+',
                    ),
                    
                    'defaults' => array(
                        'controller' => 'Usuarios\Controller\Usuarios',
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
            'usuarios/index/index' => __DIR__ . '/../view/usuarios/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            'usuarios' => __DIR__ . '/../view',
        ),
    ),

);