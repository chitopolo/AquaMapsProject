<?php
App::uses('AppController', 'Controller');
/**
 * PointTypes Controller
 *
 * @property PointType $PointType
 */
class PointTypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function testMe() {
		pr ($this->PointType->getThem());
		pr ($this->PointType->getOne(12));
		$this->render('../elements/nothing');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PointType->recursive = 0;
		$this->set('pointTypes', $this->paginate());
		pr ($this->PointType->getThem());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->PointType->id = $id;
		if (!$this->PointType->exists()) {
			throw new NotFoundException(__('Invalid point type'));
		}
		$this->set('pointType', $this->PointType->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PointType->create();
			if ($this->PointType->save($this->request->data)) {
				$this->Session->setFlash(__('The point type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The point type could not be saved. Please, try again.'));
			}
		}
		$this->set('parents', $this->PointType->Parent->find('list', array('recursive' => -1)));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->PointType->id = $id;
		if (!$this->PointType->exists()) {
			throw new NotFoundException(__('Invalid point type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PointType->save($this->request->data)) {
				$this->Session->setFlash(__('The point type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The point type could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PointType->read(null, $id);
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
		$this->PointType->id = $id;
		if (!$this->PointType->exists()) {
			throw new NotFoundException(__('Invalid point type'));
		}
		if ($this->PointType->delete()) {
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

		$pointTypes = $this->PointType->getThem();

		if ($pointTypes) {
			$response['status'] = 1;
			$response['points'] = $pointTypes;
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

		$this->PointType->id = $id;
		if (!$this->PointType->exists()) {
			throw new NotFoundException(__('Tipo de punto inexistente.'));
		}

		if (($response['pointTypes'] = $this->PointType->getOne($id)) != false) {			
			$response['status'] = 1;
			$response['message'] = __('Tipo de punto encontrado.');
		} else {
			$response['message'] = __('Tipo de punto no encontrado.');
		}

		$this->makeItJson($response);
	}
}
