<?php
namespace Users\Form;

use Zend\Captcha\AdapterInterface as CaptchaAdapter;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Captcha;
use Zend\Form\Factory;

 class RolesForm extends Form {
 	public function __construct($name =null)
 	{
 		parent::__construct($name);

 		$this->add(array(
 			'name'=>'id',
 			'type'=>'Hidden',
 		));

	    $select=new Element\Select('rol_name');
	    $select->setLabel('selecciona tu rol');
	    $select->setAttribute('multiple', true);
	    $select->setValueOptions(array(
	             '0'=>'Encargado(jefe)',
				 '1'=>'vendedor',
				 
	    ));
	    $this->add($select);
	
	
 		$this->add(array(
             'name' => 'description',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Descripcion:',
             ),
             'attributes'=> array(
 				'type' => 'textarea',
 				'class' => 'input',
 				'required' =>true,
 				'id' 	=> 'description'
 			),
         ));

 		
 		$this->add(array(
	        'name'=>'zend',
	        'attributes'=>array(
	        'type'=>'submit',
		    'value'=>'Enviar',
		    'title'=>'Enviar'
		 ),
		 ));
 	}
 
 }
 ?>