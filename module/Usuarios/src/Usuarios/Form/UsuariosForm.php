<?php
 namespace Usuarios\Form;

 use Zend\Form\Form;

 class UsuariosForm extends Form
 {
 	public function __construct($name =null)
 	{
 		parent::__construct('usuarios');

 		$this->add(array(
 			'name'=>'id',
 			'type'=>'Hidden',
 		));

 		$select=new Element\Select('rol_id');
	    $select->setLabel('selecciona tu rol');
	    $select->setAttribute('multiple', true);
	    $select->setValueOptions(array(
	             '0'=>'Encargado(jefe)',
				 '1'=>'vendedor',
				 
	    ));
	    $this->add($select);
	

 		$this->add(array(
             'name' => 'email',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Email',
             ),
         ));
 		$this->add(array(
             'name' => 'password',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Password',
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