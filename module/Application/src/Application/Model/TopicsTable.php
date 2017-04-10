<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Session\Container;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Where;


class TopicsTable
{

    protected $tableGateway;

    protected $userId;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @Description Fetch all data from Database
     *
     * @return resultset
     */
    public function getCollectionList()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet->toArray();
    }

}
