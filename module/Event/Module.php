<?php

namespace Event;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Event\Model\Event;
use Event\Model\EventTable;

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig11()
     {
         return array(
             'factories' => array(
                 'Student\Model\StudentTable' =>  function($sm) {
                     $tableGateway = $sm->get('StudentTableGateway');
                     $table = new StudentTable($tableGateway);
                     return $table;
                 },
                 'StudentTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Student());
                     return new TableGateway('users', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     } 

}
