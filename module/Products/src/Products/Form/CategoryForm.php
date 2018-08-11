<?php 

 namespace Products\Form;

 use Zend\Form\Form;

 class CategoryForm extends Form
 {
     public function __construct($name = null)
     {
         parent::__construct('category');
         //ID de la categoria
         $this->add(array(
             'name' => 'category_id',
             'type' => 'Hidden',
         ));
         //Caja de texto para el nombre de la categoria	
         $this->add(array(
             'name' => 'category_name',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Nombre de la categoria: ',
             ),
         ));
         //Área de texto para la descripción de la categoria
         $this->add(array(
             'name' => 'description',
             'type' => 'Textarea',
             'options' => array(
                 'label' => 'Descripción de de categoria ',
             ),
         ));
         //Botón de enviar y/o guardar
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