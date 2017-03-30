<?php
namespace Student\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController;

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
        die("kkk");
        $translator = $this->translator();
        $this->layout('layout/modal_layout.phtml');
        // Set title of popup
        // $this->layout()->setVariable('title', $translator(TaskTypeMessages::ADD_TITLE_TASK_TYPE));
        $form = new UserForm();
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

    /**
     * ription Edit Tasks Types
     */
    public function editTasktypeAction()
    {
        $this->layout('layout/modal_layout.phtml');
        $translator = $this->translator();
        // Set title of popup
        $this->layout()->setVariable('title', $translator(TaskTypeMessages::EDIT_TITLE_TASK_TYPE));
        $id = (int) $this->params()->fromRoute('id', 0);
        $mode = (int) $this->params()->fromRoute('mode', 0);
        if (! $id) {
            $this->flashMessenger()->addMessage(array(
                'success' => $translator(TaskTypeMessages::TASK_TYPE_NOT_FOUND)
            ));
            return $this->redirect()->toRoute('tasktype', array(
                'action' => 'add'
            ));
        }
        try {
            $tasktype = $this->getTasktypeTable()->getTasktype($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('Tasktype', array(
                'action' => 'index'
            ));
        }
        $form = new TasktypeForm();
        $form->bind($tasktype);
//         if($tasktype->approval_required == 0){
//             $form->get('approval_required')->setAttribute('checked', false);
//         }
        $request = $this->getRequest();
        $form->get('add')->setLabel($this->translator(MessageTypeMessages::EDIT));
        if ($request->isPost()) {
            $form->setInputFilter($tasktype->getInputFilter());
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                $loggedInUserId = $this->getSesionUserId();
                $this->getTasktypeTable()->saveTasktype($tasktype, $loggedInUserId);
                
                // Redirect to list of Tasktypes
                $this->flashMessenger()->addMessage(array(
                    'success' => $translator(TaskTypeMessages::EDIT_TASK_TYPE_SUCCESS)
                ));
                
                return $this->redirect()->toRoute('tasktype');
            }
        }
        
        $viewModel = new ViewModel(array(
            'id' => $id,
            'form' => $form
        ));
        return $viewModel;
    }

    /**
     * Description Soft delete Tasks Types
     */
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (! $id) {
            return $this->redirect()->toRoute('tasktype');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $loggedInUserId = $this->getSesionUserId();
                $this->getTasktypeTable()->deleteTasktype($id, $loggedInUserId);
            }
            return $this->redirect()->toRoute('tasktype');
        }
        return array(
            'id' => $id,
            'tasktype' => $this->getTasktypeTable()->getTasktype($id)
        );
    }

    /**
     * ription Get All Tasks Types
     */
    public function getTaskTypesAction()
    {
        $data = array();
        $translator = $this->translator();
        try {
            $translator = $this->translator();            
            $requestData = $this->getRequest()
                ->getPost()
                ->toArray();
            $totalRecords = $this->getTasktypeTable()->getDbRows($requestData);
            $eventtypes = $this->getTasktypeTable()->getTaskTypeData($requestData);
            
            if (! empty($eventtypes)) {
                $eventsValues = array_values($eventtypes);
            }
            
            if (! empty($eventsValues)) {
                foreach ($eventsValues as $eventValue) {
                    $tempArray = array_values($eventValue);
                    $tempId = $tempArray[1];
                    $tempArray[0] = "<pre>".htmlentities($tempArray[0])."</pre>";
//                     $tempArray[0] = htmlentities($tempArray[1]);
//                     echo $tempArray[0];die;
                    $tempArray[1] = '<a href="/tasktype/editTasktype/id/' . $tempId . '" data-toggle="modal" data-target="#modelDialog"><span title='.$translator("Edit").' class="glyphicon glyphicon-edit action-icon" aria-hidden="true"></span></a>';
//                      if($tempArray[2] == 1){
                         
//                             $tempArray[2] = $translator('Required');
//                         }
//                         else {
//                             $tempArray[2] = $translator('Not Required');
//                         }
                        $data[] = $tempArray;
                }
            }
            return new JsonModel(array(
                'data' => $data,
                'success' => true,
                'draw' => $requestData['draw'],
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords
            ));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Description Change the laguage
     */
    public function changeLanguageAction()
    {
        $langId = $this->params()->fromPost('langId');
        $session = new Container('UserLanguage');
        $session->offsetSet('langId', $langId);
        $month = time() + (60 * 60 * 24 * 30);        
        setcookie('language',$langId, $month,'/');
        return $this->getResponse()->setContent('success');
    }
    
    /**
     * Description Check for duplicate values
     */
    public function checkDuplicateAction()
    {
        $request = $this->getRequest();
        $data = $request->getPost()->toArray();
        $tasktypeTable = $this->getTasktypeTable();
        $status = $tasktypeTable->checkDuplicateRecord($data);
        return $this->getResponse()->setContent($status);
    }
}
