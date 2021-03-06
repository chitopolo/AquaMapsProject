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
				),
				'Basic' => array(
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
//pr($this->request);
		if (isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'api') {
			if (isset($this->request->query['test'])) {
				Configure::write('debug', 2);
				unset($this->request->query['test']);
			}
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

		$this->layout = 'test';
		switch($test) {
			case 'add': {
			}
			case 'edit': {
				$postFields = $values;
				break;
			}
		}

		$requestUrl =  Router::url('/api/' . lcfirst($this->name) . ($param ? '/' . $param : '') . '.json?test=1', true);

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
	
	protected function parseFields($fields) {
		return explode(',', $fields);
	}
	
	protected function parseOrder($order) {
		return $order;
	}
	
	protected function parseList($list) {
		return $list;
	}
	
	public function api_index() {
		$response = array('status' => 0, 'message' => '');
		
		$findOptions = array(
			'limit' => 20 //MT: arbitrary limit
		);
		$conditions = array();
		
		//MT: eval query options
		if (!empty($this->request->query)) {
			
			$queryOptions = array(
				'fields',
				'order',
				'list'
			);
			
			foreach ($this->request->query as $key => $value) {
				$key = Sanitize::paranoid($key, array('_'));
				$value = Sanitize::paranoid($value, array('_'));

				if (in_array($key, $queryOptions)) {
					$findOptions[$key] = $this->{'parse' . ucfirst($key)}($value);
				} else {
					$conditions[] = $key . '=' . $value;
				}
			}			
		}
		
		if (!empty($this->apiSettings['findConditions'])) {
			$conditions = Hash::merge($conditions, $this->apiSettings['findConditions']);
		}
		
		$this->logThis($this->request->query);

		$findOptions['conditions'] = $conditions;
		
		if (!empty($this->apiSettings['association'])) {
			$targetClass = $this->apiSettings['association'];
			$targetModel = $this->{$this->modelClass}->{$targetClass};
		} else {
			$targetClass = $this->modelClass;
			$targetModel = $this->{$targetClass};
		}
		
		if (!empty($targetModel->apiSettings['virtualFields'])) {
			$targetModel->virtualFields = Hash::merge($targetModel->virtualFields, $targetModel->apiSettings['virtualFields']);
		}
		
		$findOptions['fields'] = !empty($targetModel->apiSettings['fields']) ? $targetModel->apiSettings['fields'] : null;
		
		$findOptions['contain'] = !empty($targetModel->apiSettings['contain']) ? $targetModel->apiSettings['contain'] : null;
		
		//if (!empty($findOptions['contain'])) {
		//	$findOptions['recursive'] = $this->apiSettings['contain'];
		//} else {
		//	$findOptions['recursive'] = -1;
		//}
		if (empty($findOptions['contain'])) {
			$findOptions['recursive'] = -1;
		}
		if (isset($findOptions['list'])) {
			$findType = 'list';
			unset($findOptions['list']);
			unset($findOptions['limit']);
		} else {
			$findType = 'all';
		}
		
		//pr($findOptions);
		
		$results = $targetModel->find($findType, $findOptions);
		
		if ($results) {
			if ($findType == 'all') {
				$response['data'] = Set::extract('{n}.' . $targetClass, $results);
			} else {
				$response['data'] = $results;
			}
			
			$response['status'] = 1;
			$response['message'] = Inflector::pluralize($targetClass) . ' ' . __('found.');
		} else {
			//$this->response->statusCode(204);
			$response['status'] = 1;
			$response['message'] = sprintf(__('No %s were found.'), strtolower(Inflector::pluralize($targetClass)));			
		}
		$this->logThis($response, false);

		$this->makeItJson($response);
	}

	public function api_view($id = null) {
		$response = array('status' => 0, 'message' => '');
		
		if (!$id) {
			$this->response->statusCode(404);
			$response['error'] = array(__('Invalid ID.'));
		} else {
			$this->{$this->modelClass}->id = $id;
			
			if (!$this->{$this->modelClass}->exists()) {
				$this->response->statusCode(404);
			}

			if (!empty($this->{$this->modelClass}->apiSettings['virtualFields'])) {
				$this->{$this->modelClass}->virtualFields = Hash::merge($this->{$this->modelClass}->virtualFields, $this->{$this->modelClass}->apiSettings['virtualFields']);
			}
			
			$fields = !empty($this->{$this->modelClass}->apiSettings['fields']) ? $this->{$this->modelClass}->apiSettings['fields'] : null;

			$result = $this->{$this->modelClass}->find('first', array(
				'conditions' => $this->modelClass . '.id = ' . $id,
				'fields' => $fields,
				'contain' => !empty($this->{$this->modelClass}->apiSettings['contain']) ? $this->{$this->modelClass}->apiSettings['contain'] : null
			));
	
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
