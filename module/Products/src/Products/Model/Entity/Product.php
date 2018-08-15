<?php
namespace Products\Model\Entity;
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;

class Product implements InputFilterAwareInterface
{
	 public $productId;
     public $categoryId;
     public $description;
     public $barcode;
     public $image;
     protected $inputFilter;

     public function exchangeArray($data)
     {
         $this->productId     = (!empty($data['product_id'])) ? $data['product_id'] : null;
         $this->categoryId = (!empty($data['category_id'])) ? $data['category_id'] : null;
         $this->description = (!empty($data['description'])) ? $data['description'] : null;
         $this->barcode = (!empty($data['barcode'])) ? $data['barcode'] : null;
         $this->image = (!empty($data['image'])) ? $data['image'] : null;
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
                 'name'     => 'product_id',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'category_id',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'description',
                 'required' => true,
                 'filters'  => array(
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
             $inputFilter->add(array(
                 'name'     => 'barcode',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'image',
                 'required' => false,
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

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
	
}
?>