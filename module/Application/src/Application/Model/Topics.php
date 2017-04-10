<?php
namespace Application\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Topics
{

    public $id;

    public $c_name;

    public $c_place;

    public $description;
    

    public function exchangeArray($data)
    {
        $this->id = (! empty($data['id'])) ? $data['id'] : null;
        $this->t_name = (! empty($data['t_name'])) ? $data['t_name'] : null;
        $this->description = (! empty($data['description'])) ? $data['description'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}
