<?php

namespace Users\Form;

use Zend\Form\Form;

class RolesForm extends Form
 {
    public function __construct($name = null)
    {
        parent::__construct('roles');

        
        $this->add(array(
            'name' =>'rol_id',
            'type' => 'Hidden',
        ));

        $this->add(array(
             'type'=>'text',
             'name' => 'rol_name',
             'options' => array(
                     'label' => 'Ingresa el Rol :',
                     'label_attributes' => array(
                        'class' => '',
                        'for' => 'rol_model', 
                     ),
                      ),
             'attributes' => array(
                'id' => 'rol_model',
                 
                'class' => 'form-control',
                'placeholder' => 'Rol...',
             ),
              
        ));


        $this->add(array(
             'name' => 'description',
             'type' => 'Textarea',
             'options' => array(
                 'label' => 'Descripcion :',
                 'label_attributes' => array(
                    'class' => '',
                    'for' => 'roles_model',
                ),
             ),
             'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Descripcion',
                'id' => 'roles_model',
                'rows'=> '6',
             )
             
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