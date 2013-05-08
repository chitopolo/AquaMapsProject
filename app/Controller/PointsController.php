<?php
App::uses('AppController', 'Controller');
/**
 * PointTypes Controller
 *
 * @property PointType $PointType
 */
class PointsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function indexa() {
		$this->Point->recursive = 0;
		$this->set('points', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Point->id = $id;
		if (!$this->Point->exists()) {
			throw new NotFoundException(__('Invalid point type'));
		}
		$this->set('pointType', $this->Point->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Point->create();
			if ($this->Point->save($this->request->data)) {
				$this->Session->setFlash(__('The point type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The point type could not be saved. Please, try again.'));
			}
		}
		$this->set(array(
			'response' => array(),
			'_serialize' => array('response')
		));
		//$this->set('parents', $this->PointType->Parent->find('list', array('recursive' => -1)));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Point->id = $id;
		if (!$this->Point->exists()) {
			throw new NotFoundException(__('Invalid point type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Point->save($this->request->data)) {
				$this->Session->setFlash(__('The point type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The point type could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Point->read(null, $id);
		}
		$this->set('parents', $this->PointType->Parent->find('list', array('recursive' => -1)));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Point->id = $id;
		if (!$this->Point->exists()) {
			throw new NotFoundException(__('Invalid point type'));
		}
		if ($this->Point->delete()) {
			$this->Session->setFlash(__('Point type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Point type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
* Agrega un punto de agua.
*  
* @author Mauro Trigo
*
* @access public 
*
* @param int $itemCode. Recibido como parametro de ingreso
*
* @return int 'itemCode'. Enviado a la vista mediante ->set
* @return bool ownerUser
* @return Array 'itemImages'
*
**/
	public function api_index() {
		$response = array('status' => 0, 'message' => '');

		$conditions = array();
		if (!empty($this->request->query['point_type'])) {
			$conditions[] = 'point_type_id = ' . $this->request->query['point_type'];
		}

		if (!empty($this->request->query['point1'])) {
			$conditions += $this->Point->findWithinConditions(
				$this->request->query['point1'],
				$this->request->query['point2']
			);
		}

		$points = $this->Point->find('all', array(
			'fields' => $this->Point->getFindFields(),
			'conditions' => $conditions,
			'recursive' => -1
		));

		if ($points) {
			$response['status'] = 1;
			$response['points'] = Set::extract('{n}.Point', $points);;
			$response['message'] = __('Puntos de agua encontrados!');
		} else {
			$response['message'] = __('No se encontraron puntos de agua.');
		}

		$this->makeItJson($response);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function api_view($id = null) {
		$response = array('status' => 0, 'message' => '');

		$this->Point->id = $id;
		if (!$this->Point->exists()) {
			throw new NotFoundException(__('Invalid point type'));
		}

		if (($response['point'] = $this->Point->read(null, $id)) != false) {			
			$response['status'] = 1;
			$response['message'] = __('Punto encontrado.');
		} else {
			$response['message'] = __('Punto no encontrado.');
		}

		$this->makeItJson($response);
	}

/**
* Agrega un punto de agua.
*  
* @author Mauro Trigo
*
* @access public 
*
* @param int $itemCode. Recibido como parametro de ingreso
*
* @return int 'itemCode'. Enviado a la vista mediante ->set
* @return bool ownerUser
* @return Array 'itemImages'
*
**/
	public function api_add() {
		$response = array('status' => 0, 'message' => '');
		echo '-----POST';
		var_dump($_POST);
		echo '-----$this->request->data';
		var_dump($this->request->data);
		echo '-----FILES';
		var_dump($_FILES);
		
		echo '-----HEADERS';
		pr(apache_request_headers());
		
		if ($this->request->is('post') && !empty($this->request->data)) {
			$this->Point->set($this->request->data);
			//echo '-----REQUEST BODY';
			//pr(http_get_request_body());
			
			
			$this->Point->create();
			if ($this->Point->save($this->request->data)) {
				$response['status'] = 1;
				$response['message'] = __('Punto guardado.');
				$response['point']['id'] = $this->Point->getInsertID();
				$response['point'] += $this->request->data;

				if (!empty($_FILES['image_field'])) {
					$this->request->data['image_field'] = $_FILES['image_field'];
				}

				if (!empty($this->request->data['image_field'])) {
					if (move_uploaded_file($this->request->data['image_field']['tmp_name'], WWW_ROOT . 'img' . DS . 'points' . DS . $response['point']['id'] . '.jpg')) {
						$response['point']['image'] = Router::url('/img/points/' . $response['point']['id'] . '.jpg');
						$this->Point->id = $response['point']['id'];
						$this->Point->saveField('image', 1);
					} else {
						$response['message'] = __('Punto guardado. Problemas con el guardado de la imagen.');
						$response['point']['image'] = 0;
					}
				}
			} else {
				$response['errors'] = $this->Point->validationErrors;
			}
		} else {
			$response['message'] = __('No hay datos enviados.');
		}
		
		$this->makeItJson($response);
	}
	
	public function mobileSimulator() {
		$this->data = array(
			'user_id' => rand(1, 4),
			'point_type_id' => rand(1, 4),
			'lat' => '-33.' . rand(391034, 434594),
			'lng' => '-70.' . rand(587141, 753996),
			'price' => rand(587141, 753996),
			//'image_file' => '@' . WWW_ROOT . 'img' . DS . 'reports' . DS . 'base' . DS . rand(1, 5) . '.jpg;type=image/jpeg',
		);
		parent::mobileSimulator();
	}
}
