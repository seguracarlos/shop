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
                     'label' => 'Selecciona una Rol : ',
                     'label_attributes' => array(
                        //'class' => '',
                        'for' => 'rol_id', 
                     ),
                      
             ),
             'attributes' => array(
                'id' => 'rol_id',
                'class' => 'form-control',
             ),
        ));

        $this->add(array(
             'name' => 'email',
             'type' => 'Email',
             'options' => array(
                 'label' => 'Email :',
             'label_attributes' => array(
                    'class' => 'Email',
                    'for' => 'users_email', 
                    'placeholder'=> 'String,name@example.com',
                 ),
         ),
        'attributes' => array(
                     'class' => 'form-control',
                     'id' => 'users_email',
                     'placeholder'=> 'String,name@example.com',
                     
             )
              
         ));
        $this->add(array(
             'name' => 'password',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Contraseña :',
                 'label_attributes' => array(
                    'class' => 'Contraseña',
                    'for' => 'users_password', 
                    'placeholder'=> 'Password',
                 ),
             ),
                 'attributes' => array(
                     'class' => 'form-control',
                     'id' => 'users_password',
                     'placeholder'=> 'Password',
                     
             
             ),
         ));
        
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