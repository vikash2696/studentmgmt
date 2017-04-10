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
   
   protected $columns = array(
       0 =>'task_type_name',
       1 => 'id',
//        2 => 'approval_required'
   );

    public function __construct(TableGateway $tableGateway){
        $this->tableGateway = $tableGateway;
    }

    /**
     * @description Fetch all data from Database
     * @author Abhishek Arora <abhishek.arora@osscube.com>
     * @return resultset
     */

       public function getCollectionList()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet->toArray();
    }


    public function fetchAll(){
        $resultSet = $this->tableGateway->select(array('is_deleted' => 'n'));
        return $resultSet;
    }

    /**
    * @description Fetch task type on the basis of id
    * @author Abhishek Arora <abhishek.arora@osscube.com>
    * @return data record
    */
    public function getTasktype($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        return $row;
    }

    /**
    * @description Save Task Type
    * @author Abhishek Arora <abhishek.arora@osscube.com>
    */
    public function saveTasktype(Tasktype $tasktype,$loggedInUserId=null){
        $data = array(
            'task_type_name' => $tasktype->task_type_name,
            'updated_by' => $loggedInUserId,
//             'approval_required' => $tasktype->approval_required,
        );

        $id = (int) $tasktype->id;
        try {
            if ($id == 0) {
               $data['created_at'] = date("Y-m-d H:i:s");
               $data['created_by'] = $loggedInUserId;
               $this->tableGateway->insert($data);
            } else {
               if ($this->getTasktype($id)) {
                   $this->tableGateway->update($data, array('id' => $id));
               } else {
                   throw new \Exception('Tasktype id does not exist');
               }
           }
       }catch (\Exception $e) {
                throw new \Exception($e->getPrevious()->getMessage());
        }
   }

    /**
    * @description Delete Task Type
    * @author Abhishek Arora <abhishek.arora@osscube.com>
    */
   public function deleteTasktype($id,$loggedInUserId=null){
        $data['updated_by']  = $loggedInUserId;
        $data['is_deleted']  = 'y';
        try {
            $this->tableGateway->update(
                $data, array('id' => $id)
            );
        }catch (\Exception $e) {
                throw new \Exception($e->getPrevious()->getMessage());
        }
   }
   
    /**
    * @description Fetch total records
    * @author Abhishek Arora <abhishek.arora@osscube.com>
    */
    public function getDbRows($requestData) {
            $total = 0;
            $select = $this->tableGateway->getSql ()->select();
            $select->columns(array('*'));
            if($requestData['search']['value']) $select->where->like('task_type_name', '%'.$requestData['search']['value'].'%');
            $select->order($this->columns[$requestData['order'][0]['column']].' '.$requestData['order'][0]['dir']);
            $resultSet = $this->tableGateway->selectWith($select)->count();
            return $resultSet;   
        }
    
    /**
    * @description Get Task type data
    * @author Abhishek Arora <abhishek.arora@osscube.com>
    */
    public function getTasktypeData($requestData)
    {
        try {
             
            $select = $this->tableGateway->getSql ()->select();
            $select->columns(array('task_type_name','id'));
            if($requestData['search']['value']) $select->where->like('task_type_name', '%'.$requestData['search']['value'].'%');
            $select->order($this->columns[$requestData['order'][0]['column']].' '.$requestData['order'][0]['dir']);
            $sqlStmt = $select->getSqlString();
            $sqlStmt  .= ' LIMIT '.(int)$requestData['start'].','.(int)$requestData['length'];
            $sqlStmt = str_replace('"','',$sqlStmt);
            $statement = $this->getDbAdapter()->query($sqlStmt, \Zend\Db\Adapter\Adapter::QUERY_MODE_EXECUTE)->toArray();
    
            return $statement;
            // }
        }
        catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    /**
     * @author Vikash kumar
     * function to get all task type
     * @throws \Exception'
     * @return task type id and name
     */
    public function getTaskTypeName()
    {
        try {
             $select = $this->tableGateway->getSql ()->select();
             $select->columns(array('id','task_type_name'));
             $select->order('task_type.task_type_name asc');
             $sqlStmt = $select->getSqlString();
             $sqlStmt = str_replace('"','',$sqlStmt);
             $statement = $this->getDbAdapter()->query($sqlStmt, \Zend\Db\Adapter\Adapter::QUERY_MODE_EXECUTE)->toArray();
             
             return $statement;
            }
            catch(\Exception $e) {
                throw new \Exception($e->getMessage());
            }
    }
}
