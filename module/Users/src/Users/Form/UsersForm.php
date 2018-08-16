<?php
 namespace Users\Form;

 use Zend\Form\Form;

 class UsersForm extends Form
 {
    public function __construct($name =null)
    {
        parent::__construct('users');

        $this->add(array(
            'name'=>'user_id',
            'type'=>'Hidden',
        ));

        $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'rol_id',
             'options' => array(
                     'label' => 'Selecciona una Rol',
                     'value_options' => array(
                     ),
             )
        ));

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
                 'label' => 'Contraseña',
             ),
         ));
        /*$this->add(array(
             'name' => 'user_name',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Nombre de Usuario;',
             ),
             
         ));
        $this->add(array(
             'name' => 'first_name',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Nombre;',
             ),
             
         ));
        $this->add(array(
             'name' => 'last_name',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Apellido',
             ),
             
         ));
        $this->add(array(
             'name' => 'address',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Direccion',
             ),
             
         ));
        $this->add(array(
             'name' => 'telephone',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Telefono:',
             ),

         ));*/
        $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Guardar',
                 'id' => 'submitsave',
             ),
         ));
    }
 
 }
 ?>