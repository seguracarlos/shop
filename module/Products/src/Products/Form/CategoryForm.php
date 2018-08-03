<?php

namespace Products\Form;

use Zend\Captcha\AdapterInterface as CaptchaAdapter;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Captcha;
use Zend\Form\Factory;

 class CategoryForm extends Form
 {
 	public function __construct($name = null)
 	{
 		parent::__construct($name);

 		/*Caja de texto del ID de la categoria*/
 		$this->add(array(
 			'name' =>'category_id',
 			'options' => array(
 				'label' =>'ID de la categoria: ',
 			),
 			'attributes'=> array(
 				'type' => 'text',
 				'class' => 'input',
 				'id' 	=> 'category_id',
 				'required' => true
 			),
 		));


 		/*Caja de texto del nombre de la categoria*/
 		$this->add(array(
 			'name' =>'category_name',
 			'options' => array(
 				'label' =>'Nombre de la categoria: ',
 			),
 			'attributes'=> array(
 				'type' => 'text',
 				'class' => 'input',
 				'id' 	=> 'categnom',
 				'required' => true,
 				'required pattern'=>'[A-Za-z]+'
 			),
 		));

 		/*Área de texto de la descripción de la categoria*/
 		$this->add(array(
 			'name' =>'description',
 			'options' => array(
 				'label' =>'Descripción:',
 			),
 			'attributes'=> array(
 				'type' => 'textarea',
 				'class' => 'input',
 				'required' =>true,
 				'id' 	=> 'description'
 			),
 		));	

 		/*Botón de enviar*/
 		$this->add(array(
 			'name' => 'send',
 			'attributes' => array(
 				'type' => 'submit',
 				'value' => 'Enviar',
 			),
 		));
 		

 	}
 }


?>