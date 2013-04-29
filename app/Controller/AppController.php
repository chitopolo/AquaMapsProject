<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {
	public $components = array(
		'Auth' => array(
			'loginAction' => array(
				'controller' => 'users',
				'action' => 'login',
			),
			'loginRedirect' => array(
				'controller' => 'users',
				'action' => 'hello',
			),
			'authError' => 'Sorry, necesitas estar loggeado para entrar a esa sección.',
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username' => 'email')
				)
			)
		),
		'Session',
		'RequestHandler'
	);
	
	public $current = array();
	/**
	* MT:
	* Este callback se ejecuta antes de cualquier acción en cualquier controlador (porque todos los contoladores heredan de AppController).
	* 
	*/
	public function beforeFilter() {
		//MT: por defecto, que todas las acciones del sitio estén abiertas, a menos que se las prohiba explícitamente.
		$this->Auth->allow();
		
		//MT: guardamos los datos de usuario en la variable current.
		if ($this->Auth->user()) {
			//MT: normalizar los datos del usuario al ponerlos en current, porque se guardan de manera diferente según cómo se haga el login (Facebook, Google o normal)
			if ($this->Auth->user('User')) {
				$this->current['User'] = $this->Auth->user('User');				
			} else {
				$this->current['User'] = $this->Auth->user();				
			}
		} else {
			$this->current['User'] = null;
		}
	}	
	/**
	* MT:
	* Este callback se ejecuta justo antes renderear cualquier vista de cualquier acción de todos los controladores.
	* 
	*/
	public function beforeRender() {
		//MT: hacemos que $current esté disponible en las vistas.
		$this->set('current', $this->current);
	}

	protected function makeItJson($response) {
		$this->set(array(
			'response' => $response,
			'_serialize' => array('response')
		));
		$this->layout = null;
		$this->render('../elements/json');
		$this->response->type('application/json');
	}
}
