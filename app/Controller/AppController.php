<?php
App::uses('Controller', 'Controller');

App::uses('Sanitize', 'Utility');

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
	
	protected $apiSettings = array(
		'findConditions' => array()
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
	
	protected function logThis($text, $appendTitle = true) {
		if (is_array($text)) {
			$text = json_encode($text);
		}

		$text = ($appendTitle ? "--------- " . $this->request->url . " > " . $this->modelClass . " " . $this->params['action'] . "  " . date('Y-m-d H:i:s') . " --------<br /><br />" : "") . $text . "<br /><br />";

		$txtFile = WWW_ROOT . 'files'. DS . 'tests' . DS . 'control.html';
		$configHandle = fopen($txtFile, 'a');
		fwrite($configHandle, $text);
		fclose($configHandle);
	}

	/**
	 *
	 * API METHODS
	 *
	*/
	
	public function api_index() {
		$response = array('status' => 0, 'message' => '');
		$conditions = array();
		$conditions = array();
		
		if (!empty($this->request->query)) {
			foreach ($this->request->query as $key => $value) {
				$key = Sanitize::paranoid($key, array('_'));
				$value = Sanitize::paranoid($value, array('_'));
				$conditions[] = $key . '=' . $value;
			}			
		}
		
		if (!empty($this->apiSettings['findConditions'])) {
			$conditions = Hash::merge($conditions, $this->apiSettings['findConditions']);
		}		
		
		$this->logThis($this->request->query);

		$findOptions = array(
		//	'fields' => $this->{$this->modelClass}->getFindFields(),
			'conditions' => $conditions,
		);
		
		if (!empty($this->apiSettings['contain'])) {
			$findOptions['recursive'] = $this->apiSettings['contain'];
		} else {
			$findOptions['recursive'] = -1;
		}
		
		if ($this->apiSettings['association']) {
			$targetClass = $this->apiSettings['association'];
			$targetModel = $this->{$this->modelClass}->{$targetClass};
		} else {
			$targetClass = $this->modelClass;
			$targetModel = $this->{$targetClass};
		}
		
		$results = $targetModel->find('all', $findOptions);
		
		if ($results) {
			$response['data'] = Set::extract('{n}.' . $targetClass, $results);
			$response['status'] = 1;
			$response['message'] = Inflector::pluralize($targetClass) . ' ' . __('found.');
		} else {
			$this->response->statusCode(204);
			$response['status'] = 1;
			$response['message'] = sprintf(__('No %s were found.'), strtolower(Inflector::pluralize($targetClass)));			
		}
		$this->logThis($response, false);

		$this->makeItJson($response);
	}

	public function api_view($id = null) {
		$response = array('status' => 0, 'message' => '');
		
		if (!$id) {
			$response['error'] = array(__('Invalid ID.'));
		} else {
			$this->{$this->modelClass}->id = $id;
			
			if (!$this->{$this->modelClass}->exists()) {
				$this->response->statusCode(404);
			}

			$fields = !empty($this->apiSettings['fields']) ? $this->apiSettings['fields'] : null;

			$result = $this->{$this->modelClass}->read($fields, $id);
	
			$this->logThis($id);
	
			if ($result) {
				$response[strtolower($this->modelClass)] = $result[$this->modelClass];
				$response['status'] = 1;
				$response['message'] = $this->modelClass . ' ' . __('found.');
			} else {
				$response['status'] = 1;
				$response['message'] = $this->modelClass . ' ' . $id . ' ' . __('was not found.');			
			}
		}
		$this->logThis($response, false);

		$this->makeItJson($response);
	}

	public function api_add() {
		$response = array('status' => 0, 'message' => '');
		if ($this->request->is('post')) {
			if (!empty($this->request->data)) {
				
				$this->logThis($this->request->data);
				
				if (!empty($_FILES)) {
					$this->logThis($_FILES, false);
				}
				
				$this->{$this->modelClass}->create();
				if ($this->User->save($this->request->data)) {
					$this->response->statusCode(201);
					
					$response['status'] = 1;
					$response['message'] = $this->modelClass . ' ' . __('saved.');		
					$response[strtolower($this->modelClass)]['id'] = $this->{$this->modelClass}->getInsertID();
				} else {
					$response['errors'] = $this->{$this->modelClass}->validationErrors;
				}
			} else {
				$response['message'] = __('No data was sent.');
			}
		} else {
			$this->response->statusCode(405);
			$response['message'] = __('Invalid HTTP method.');
		}
		$this->logThis($response, false);

		$this->makeItJson($response);
	}

	public function api_edit($id = null) {
		$response = array('status' => 0, 'message' => '');

		if (!$id) {
			$response['error'] = array(__('Id invalido'));
		} else {
			$this->{$this->modelClass}->id = $id;

			if (!$this->{$this->modelClass}->exists()) {
				$this->response->statusCode(404);
			}
	
			if ($this->request->is('post') || $this->request->is('put')) {
				if (!empty($this->request->data)) {
					$this->logThis($this->request->data);
					
					if (!empty($_FILES)) {
						$this->logThis($_FILES, false);
					}
					
					if ($this->{$this->modelClass}->save($this->request->data)) {
						$response['status'] = 1;
						$response['message'] = $this->modelClass . ' ' . __('updated.');
						$response[strtolower($this->modelClass)]['id'] = $id;
					} else {
						$response['errors'] = $this->{$this->modelClass}->validationErrors;
					}
				} else {
					$response['message'] = __('No data was sent.');
				}
			} else {
				$this->response->statusCode(405);
				$response['message'] = __('Invalid HTTP method.');
			}
		}
		$this->logThis($response, false);

		$this->makeItJson($response);
	}
}
