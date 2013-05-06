<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 */
class CitiesController extends AppController {

/**
 * api index method
 *
 * @return void
 */
	public function api_index() {
		$response = array('status' => 0, 'message' => '');

		$conditions = array();
		if (!empty($this->request->query['country_id'])) {
			$conditions[] = 'country_id = ' . $this->request->query['country_id'];
		}

		$cities = $this->City->find('list', array(
			'conditions' => $conditions,
			'recursive' => -1
		));

		if ($cities) {
			$response['status'] = 1;
			$response['cities'] = $cities;
			$response['message'] = __('Ciudades encontradas!');
		} else {
			$response['message'] = __('No se encontraron ciudades.');
		}

		$this->makeItJson($response);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->City->recursive = 0;
		$this->set('cities', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->City->id = $id;
		if (!$this->City->exists()) {
			throw new NotFoundException(__('Invalid city'));
		}
		$this->set('city', $this->City->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->City->create();
			if ($this->City->save($this->request->data)) {
				$this->Session->setFlash(__('The city has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The city could not be saved. Please, try again.'));
			}
		}
		$countries = $this->City->Country->find('list');
		$this->set(compact('countries'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->City->id = $id;
		if (!$this->City->exists()) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->City->save($this->request->data)) {
				$this->Session->setFlash(__('The city has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The city could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->City->read(null, $id);
		}
		$countries = $this->City->Country->find('list');
		$this->set(compact('countries'));
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
		$this->City->id = $id;
		if (!$this->City->exists()) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->City->delete()) {
			$this->Session->setFlash(__('City deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('City was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
