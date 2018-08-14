<?php

namespace Users\Form;

use Zend\Form\Form;

class RolesForm extends Form
 {
 	public function __construct($name = null)
 	{
 		parent::__construct('roles');

 		/*Caja de texto del ID de la categoria*/
 		$this->add(array(
 			'name' =>'rol_id',
 			'type' => 'Hidden',
 		));

 		$this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'rol_name',
             'options' => array(
                     'label' => 'Selecciona una Rol :',
                     'options' => array(
                        0 => 'Jefe(encarjado)',
                        1 => 'Empleado',
                     ),
                      ),
                 'attributes' => array(
                'value' => 0 //set selected to "Nur Überweisung"
             )
        ));


 		$this->add(array(
             'name' => 'description',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Descripcion :',
             ),
             
         ));

 		
 		$this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Guardar',
                 'id' => 'submitbutton',
             ),
		 ));
 	}
 
 }
 ?>