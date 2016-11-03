<?php

return array(
     'controllers' => array(
         'invokables' => array(
             'Student\Controller\Index' => 'Student\Controller\IndexController',
         ),
     ),

     'router' => array(
         'routes' => array(
             'student' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/student[/:action][/id/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Student\Controller\Index',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'student' => __DIR__ . '/../view',
         ),
     ),
 );