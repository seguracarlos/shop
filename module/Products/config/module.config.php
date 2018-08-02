<?php

return array(
        'controllers' => array(
            'invokables' => array(
                'Products\Controller\Products' => 'Products\Controller\ProductsController',
                'Products\Controller\Products' => 'Products\Controller\CategoryController'
            ),
        ),

        'router'=>array(
            'routes'=>array(
                'products'=>array(
                    'type'=>'Segment',
                        'options'=>array(

                            'route' => '/products[/[:action]]',
                            'constraints' => array(
                                    'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),

                            'defaults' => array(
                                'controller' =>'Products\Controller\Products',
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
            'products/index/index' => __DIR__ . '/../view/products/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
           'products' => __DIR__ . '/../view',
        ),
    ),
);