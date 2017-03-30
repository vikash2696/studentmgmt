<?php

return array(
     'controllers' => array(
         'invokables' => array(
             'Attendence\Controller\Index' => 'Attendence\Controller\IndexController',
         ),
     ),

     'router' => array(
         'routes' => array(
             'attendence' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/attendence[/:action][/id/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Attendence\Controller\Index',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'attendence' => __DIR__ . '/../view',
         ),
     ),
 );