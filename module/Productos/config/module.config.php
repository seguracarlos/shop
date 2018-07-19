<?php

return array(
        'controllers' => array(
            'invokables' => array(
                'Productos\Controller\Productos' => 'Productos\Controller\ProductosController'
            ),
        ),

        'router'=>array(
            'routes'=>array(
                'productos'=>array(
                    'type'=>'Segment',
                        'options'=>array(

                            'route' => '/productos[/[:action]]',
                            'constraints' => array(
                                    'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),

                            'defaults' => array(
                                'controller' =>'Productos\Controller\Productos',
                                'action' => 'index'
                            ),
                        ),
                ),
            ),
        ),

        //Cargamos el view manager
        'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'productos/index/index' => __DIR__ . '/../view/productos/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
           'productos' => __DIR__ . '/../view',
        ),
    ),
);