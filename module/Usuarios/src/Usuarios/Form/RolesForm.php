<?php
 namespace Usuario\Form;

 use Zend\Form\Form;

 class RolesForm extends Form
 {
 	public function __construct($name =null)
 	{
 		parent::__construct('roles');

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
                 'label' => 'Description',
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