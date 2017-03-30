<?php

return array(
     'controllers' => array(
         'invokables' => array(
             'Alumni\Controller\Index' => 'Alumni\Controller\IndexController',
         ),
     ),

     'router' => array(
         'routes' => array(
             'alumni' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/alumni[/:action][/id/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Alumni\Controller\Index',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'alumni' => __DIR__ . '/../view',
         ),
     ),
 );