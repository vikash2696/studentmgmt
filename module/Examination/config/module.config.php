<?php

return array(
     'controllers' => array(
         'invokables' => array(
             'Examination\Controller\Index' => 'Examination\Controller\IndexController',
         ),
     ),

     'router' => array(
         'routes' => array(
             'examination' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/examination[/:action][/id/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Examination\Controller\Index',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'examination' => __DIR__ . '/../view',
         ),
     ),
 );