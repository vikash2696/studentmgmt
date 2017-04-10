<?php
namespace Student\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController;
// use Student\Form\StudentForm;
// use Zend\Form\StudentForm;

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
        return new ViewModel(array(
            'listStudent' =>  $listStudent,     
        ));
    }

    /**
     * ription Add Tasks Types
     */
    public function addStudentAction()
    {
        $translator = $this->translator();
        // $this->layout('layout/modal_layout.phtml');
        // Set title of popup
        // $this->layout()->setVariable('title', $translator(TaskTypeMessages::ADD_TITLE_TASK_TYPE));
        $form = new StudentForm();
        print_r($form); die;
        $request = $this->getRequest();
        if ($request->isPost()) {
//             print_r($request->getPost()->toArray());die;
            $user = new user();
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $tasktype->exchangeArray($form->getData());
                $loggedInUserId = $this->getSesionUserId();
                $this->getTasktypeTable()->saveTasktype($tasktype, $loggedInUserId);
                $this->flashMessenger()->addMessage(array(
                    'success' => $translator(TaskTypeMessages::ADD_TASK_TYPE_SUCCESS)
                ));
                return $this->redirect()->toRoute('tasktype');
            }
        }
        return array(
            'form' => $form
        );
    }
}
