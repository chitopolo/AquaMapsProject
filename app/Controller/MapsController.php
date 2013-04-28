<?php

App::uses('AppController', 'Controller');

class MapsController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Maps';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * MT
 * prueba de inclusión de un mapa
 *
 * @param mixed What page to display
 * @return void
 */
	public function add() {
		$this->layout = 'map';
		$this->set(array(
			'response' => array(),
			'_serialize' => array('response')
		));
	}
	
	public function example() {
		
	}
}
