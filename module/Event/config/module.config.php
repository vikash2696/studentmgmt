<?php

return array(
     'controllers' => array(
         'invokables' => array(
             'Event\Controller\Index' => 'Event\Controller\IndexController',
         ),
     ),

     'router' => array(
         'routes' => array(
             'event' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/event[/:action][/id/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Event\Controller\Index',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'event' => __DIR__ . '/../view',
         ),
     ),
 );