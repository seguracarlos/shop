<?php
 namespace Users\Model;

 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;

class Roles implements InputFilterAwareInterface{
    public $rolId;
    public $rolName;
    public $description;
    protected $inputFilter;


     public function exchangeArray($data)
    {

         $this->rolId     = (!empty($data['rol_id'])) ? $data['rol_id'] : null;
         $this->rolName     = (!empty($data['rol_name'])) ? $data['rol_name'] : null;
         $this->description     = (!empty($data['description'])) ? $data['description'] : null;
        
    }

    public function getArrayCopy()
     {
         return get_object_vars($this);
     }
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }
     public function getInputFilter()
     {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();

             $inputFilter->add(array(
                 'name'     => 'rol_id',
                 'required' => true,
                 'filters'  => array(
                    array('name' => 'Int'),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'rol_name',
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
                             'max'      => 45,
                         ),
                     ),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'description',
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
                             'max'      => 200,
                         ),
                     ),
                 ),
             ));

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
 }

 ?>