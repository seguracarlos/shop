	<?php

namespace Products\Form;

use Zend\Captcha\AdapterInterface as CaptchaAdapter;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Captcha;
use Zend\Form\Factory;

 class ProductosForm extends Form
 {
 	public function __construct($name = null)
 	{
 		parent::__construct($name);

 		/*Caja de texto del ID del producto*/
 		$this->add(array(
 			'name' =>'idprod',
 			'options' => array(
 				'label' =>'ID del producto: ',
 			),
 			'attributes'=> array(
 				'type' => 'text',
 				'class' => 'input',
 				'id' 	=> 'idprod',
 				'required' => true
 			),
 		));

 		/*Caja de texto del ID de la categoria*/
 		$this->add(array(
 			'name' =>'idcateg',
 			'options' => array(
 				'label' =>'ID de la categoria: ',
 			),
 			'attributes'=> array(
 				'type' => 'text',
 				'class' => 'input',
 				'id' 	=> 'idcateg',
 				'required' => true
 			),
 		));

 		/*Área de texto de la descripción del producto*/
 		$this->add(array(
 			'name' =>'desc',
 			'options' => array(
 				'label' =>'Descripción:',
 			),
 			'attributes'=> array(
 				'type' => 'textarea',
 				'class' => 'input',
 				'required' =>true,
 				'id' 	=> 'desc'
 			),
 		));

 		/*Caja de texto del código de barras del producto*/
 		$this->add(array(
 			'name' =>'barcode',
 			'options' => array(
 				'label' =>'Código de barras: ',
 			),
 			'attributes'=> array(
 				'type' => 'text',
 				'class' => 'input',
 				'id' 	=> 'barcode',
 				'required' => true,
 				'required pattern'=>'[0-9]+'
 			),
 		));

 		$factory = new Factory();

 		// File Input
        $file = new Element\File('image-file');
        $file->setLabel('Suba su foto')
             ->setAttribute('id', 'image-file');
        $this->add($file);

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