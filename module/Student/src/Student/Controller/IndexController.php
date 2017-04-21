<?php
namespace Student\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController;
use Student\Form\StudentForm;
use Student\Model\StudentTable;

class IndexController extends AbstractActionController
{

    protected $studentTable;

    /**
     * ription List all tasks types
     */
    public function indexAction()
    {
        $sm = $this->getServiceLocator();
        $userTable = $sm->get('Student\Model\StudentTable');
        $listStudent = $userTable->getCollectionList(); 
        $headers = apache_request_headers();
        $is_ajax = (isset($headers['X-Requested-With']) && $headers['X-Requested-With'] == 'XMLHttpRequest');
        if($is_ajax) {
            $viewModel = new ViewModel();
            $viewModel->setVariables(array('listStudent' =>  $listStudent))
                  ->setTerminal(true);
             return $viewModel;
        }else {
            return new ViewModel(array(
                'listStudent' =>  $listStudent,     
            ));
         }
    }

    /**
     * ription Add Tasks Types
     */
    public function addStudentAction()
    {
        $form = new StudentForm();
        $request = $this->getRequest();
        if(isset($_POST) && !empty($_POST)) {
            $sm = $this->getServiceLocator();
            $userTable = $sm->get('Student\Model\StudentTable');
            $saveStudent = $userTable->saveStudentData(); 
        }
        $viewModel = new ViewModel();
        $viewModel->setVariables(array('form' => $form))
              ->setTerminal(true);

         return $viewModel;
    }
}
