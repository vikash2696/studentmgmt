<?php

return array(
     'controllers' => array(
         'invokables' => array(
             'Assignment\Controller\Index' => 'Assignment\Controller\IndexController',
         ),
     ),

     'router' => array(
         'routes' => array(
             'assignment' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/assignment[/:action][/id/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Assignment\Controller\Index',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'assignment' => __DIR__ . '/../view',
         ),
     ),
 );