<?php
 namespace Users\Form;

 use Zend\Form\Form;

 class UsersForm extends Form
 {
 	public function __construct($name =null)
 	{
 		parent::__construct($name);

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
              'attributes' => array(
                'required'=>'required',
                'class' => 'input_email',
                'id' => 'input_email'
            ),
         ));
 		$this->add(array(
             'name' => 'password',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Contraseña',
             ),
         ));
 		$this->add(array(
             'name' => 'user_name',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Nombre de Usuario;',
             ),
             'attributes'=> array(
 				'type' => 'text',
 				'class' => 'input',
 				'id' 	=> 'user_name',
 				'required' => true,
 				'required pattern'=>'[A-Za-z]+'
 			),
         ));
 		$this->add(array(
             'name' => 'first_name',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Nombre;',
             ),
             'attributes'=> array(
 				'type' => 'text',
 				'class' => 'input',
 				'id' 	=> 'first_name',
 				'required' => true,
 				'required pattern'=>'[A-Za-z]+'
 			),
         ));
 		$this->add(array(
             'name' => 'last_name',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Apellido:',
             ),
             'attributes'=> array(
 				'type' => 'text',
 				'class' => 'input',
 				'id' 	=> 'last_name',
 				'required' => true,
 				'required pattern'=>'[A-Za-z]+'
 			),
         ));
 		$this->add(array(
             'name' => 'address',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Direccion:',
             ),
             'attributes'=> array(
 				'type' => 'text',
 				'class' => 'input',
 				'id' 	=> 'address',
 				'required' => true,
 				'required pattern'=>'[A-Za-z]+'
 			),
         ));
 		$this->add(array(
             'name' => 'telephone',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Telefono:',
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