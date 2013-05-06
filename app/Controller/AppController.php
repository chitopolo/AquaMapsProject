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

	//protected function goJson($response) {
	//	$this->set('response', $response);
	//	$this->layout = null;
	//	$this->render('../elements/json');
	//	$this->response->type('application/json');
	//}
	
	protected function makeItJson($response = array('status' => 0, 'message' => 'No data')) {
		$this->set('response', $response);
		$this->layout = null;
		echo json_encode($response);
		$this->response->type('application/json');
		$this->render(false);
	}
	
	public function mobileSimulator() {
		if (!empty($this->params['named']['test'])) {
			$test = $this->params['named']['test'];
		} else {
			$test = 'index';
		}

		if (!empty($this->params['named']['param'])) {
			$param = $this->params['named']['param'];
		} else {
			$param = null;
		}		
		
		if (!empty($this->data)) {
			$values = $this->data;
		} else {
			$values = array(
				'name' => 'hey vos, ' . rand(0, 3244),
			);
		}

		//$this->layout = 'test';
		switch($test) {
			case 'add': {
			}
			case 'edit': {
				$postFields = $values;
				break;
			}
		}

		$requestUrl =  Router::url('/api/' . lcfirst($this->name) . ($param ? '/' . $param : '') . '.json', true);

		$request = curl_init($requestUrl); // initiate curl object
		curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
		curl_setopt($request, CURLOPT_RETURNTRANSFER, true); // Returns response data instead of TRUE(1)		
		curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);

		if (!empty($postFields)) {
			curl_setopt($request, CURLOPT_POST, 1);
			curl_setopt($request, CURLOPT_POSTFIELDS, $postFields); // use HTTP POST to send form data
		} else {
			curl_setopt($request, CURLOPT_POST, 0);
		}

		$response = curl_exec($request); // execute curl post and store results in $post_response
		curl_close ($request); // close curl object
		
		$this->set('requestUrl', $requestUrl);
		$this->set('mobileOutput', $response);
		pr($response);
		$this->render('../elements/nothing');
	}
}
