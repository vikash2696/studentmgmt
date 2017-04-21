<?php
namespace Student\Model;

 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterInterface;
 

 class Student
 {
     public $id;
     public $user_id;
//      public $approval_required;
     public $email;
     public $s_name;

     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->user_id = (!empty($data['user_id'])) ? $data['user_id'] : null;
         $this->email = (!empty($data['email'])) ? $data['email'] : null;
         $this->s_name = (!empty($data['first_name'])) ? $data['first_name'] : null;
     }
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }
	public function getArrayCopy() {
		return get_object_vars ( $this );
	}
      public function getInputFilter()
     {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();

             $inputFilter->add(array(
                 'first_name'     => 'id',
                 'required' => true,
                 'filters'  => array(
                     array('first_name' => 'Int'),
                 ),
             ));

/*
              $inputFilter->add(array(
                 'name'     => 'task_type_name',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));
*/
             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }

 }
