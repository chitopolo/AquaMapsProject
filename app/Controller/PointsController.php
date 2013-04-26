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
		//var_dump($this->request);

		$points = $this->Point->getPoints(33.32344, 33.234556);

		if ($points) {
			$response['status'] = 1;
			$response['points'] = $points;
			$response['message'] = __('Puntos de agua encontrados!');
		} else {
			$response['message'] = __('No se encontraron puntos de agua.');
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
		var_dump($this->request->is('rest'));
		$response = array('status' => 0, 'message' => '');
		if ($this->request->is('post')) {
			if (!empty($this->request->data)) {
				$this->Report->set($this->request->data);
				
				$this->Report->create();
				if ($this->Report->save($this->request->data)) {
					$response['status'] = 1;
					$response['message'] = __('Reporte guardado.');
					$response['report'] = $this->request->data;
					$response['report']['id'] = $this->Report->getInsertID();
					if (!empty($this->request->data['image'])) {
						$image = base64_decode($this->request->data['image']);
						if (file_put_contents(WWW_ROOT . 'img' . DS . 'reports' . DS . $response['report']['id'] . '.jpg', $image)) {						
							$response['report']['image'] = 1;
							$this->Report->id = $response['report']['id'];
							$this->Report->saveField('image', 1);
						} else {
							$response['message'] = __('Reporte guardado. Problemas con el guardado de la imagen.');
							$response['report']['image'] = 0;
						}
					}
				} else {
					$response['errors'] = $this->Report->validationErrors;
					//$this->Session->setFlash(__('Ocurrió un problema al guardar los datos.'));
				}
			} else {
				$response['message'] = __('No hay datos enviados.');
			}
		} else {
			$response['message'] = __('No hay datos enviados.');
		}
		
		$this->makeItJson($response);
	}

	private function makeItJson($response) {
		$this->set(array(
			'response' => $response,
			'_serialize' => array('response')
		));
		$this->layout = null;
		$this->render('../elements/json');
		$this->response->type('application/json');
	}
}
