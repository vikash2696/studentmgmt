<?php
namespace Student\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Expression;
use Zend\Db\Adapter\Adapter;

use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Select;

class StudentTable 
{
    protected $tableGateway;
    protected $userId;

    public function __construct(TableGateway $tableGateway){
        $this->tableGateway = $tableGateway;
    }

    public function getCollectionList()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet->toArray();
    }


    public function saveStudentData()
    {
       $id = (int) $_POST['id'];
       $data = array(
        'first_name' => $_POST['s_name'],
        'email' => $_POST['s_email'],
        'user_id' => $_POST['user_id'],
        );
       try {
            if ($id == 0) {
               $this->tableGateway->insert($data);
               return false;
            } 
        /*    else {
               if ($this->getTasktype($id)) {
                   $this->tableGateway->update($data, array('id' => $id));
               } else {
                   throw new \Exception('Tasktype id does not exist');
               }
           }*/
       }catch (\Exception $e) {
                throw new \Exception($e->getPrevious()->getMessage());
        }
    }
}
