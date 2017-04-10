<?php

return array(
     'controllers' => array(
         'invokables' => array(
             'Professor\Controller\Index' => 'Professor\Controller\IndexController',
         ),
     ),

     'router' => array(
         'routes' => array(
             'professor' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/professor[/:action][/id/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Professor\Controller\Index',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'professor' => __DIR__ . '/../view',
         ),
     ),
 );