<?php
namespace Student\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class StudentForm extends Form
{

    public function __construct($name = null)
    {
        $this->setAttribute('class', 'no-bottom-margin');
        parent::__construct('student');
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden'
        ));
        $this->add(array(
            'name' => 'task_type_name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Task Type Name'
            ),
            'attributes' => array(
                'class'=> 'form-control',
                'id' => 'task_type_name'
                )
        ));
//         $this->add(array(
//             'type' => 'Zend\Form\Element\Checkbox',
//             'name' => 'approval_required',
//             'options' => array(
        
        
//             ),
//             'attributes' => array(
//                 'id' => 'approval_required',
//                 'checked' => true,
//             )
//         ));
        
        $add = new Element\Button('add');
        $add->setLabel('Submit')
            ->setValue('Submit')
            ->setName('add')
            ->setAttribute('id', 'submitbutton')
            ->setAttribute('class', 'btn btn-default text-uppercase action-btn')
            ->setAttribute('type', 'submit');
        $this->add($add);

        $cancel = new Element\Button('cancel');
        $cancel->setLabel("cancel")
        ->setValue('cancel')
        ->setName('cancel')
        ->setAttribute('class', 'btn btn-default text-uppercase action-btn')
        ->setAttribute('data-dismiss', 'modal')
        ->setAttribute('type', 'button');
        $this->add($cancel);
    }
}