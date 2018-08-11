	<?php

namespace Products\Form;

use Zend\Form\Form;

 class ProductsForm extends Form
 {
 	public function __construct($name = null)
 	{
 		parent::__construct('product');
 		//ID del producto
 		$this->add(array(
             'name' => 'productId',
             'type' => 'Hidden',
         ));
 		//Lista desplegables con las categorias (llena desde la base)
 		$this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'category_id',
             'options' => array(
                     'label' => 'Selecciona una categoria',
                     //'empty_option' => 'Selecciona...',
                     'value_options' => array(
                     ),
             )
     	));
     	//Área de texto para la descripción del producto
         $this->add(array(
             'name' => 'description',
             'type' => 'Textarea',
             'options' => array(
                 'label' => 'Descripción del producto: ',
             ),
         ));
         //Caja de texto para el código de barra de la categoria 
         $this->add(array(
             'name' => 'barcode',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Código de barras: ',
             ),
         ));
         //Caja para subir imagen a la base de texto.
         $this->add(array(
             'name' => 'image',
             'type' => 'Zend\Form\Element\File',
             'options' => array(
                 'label' => 'Selecciona la imagen: ',
             ),
         ));
         //Botón de enviar y/o guardar
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