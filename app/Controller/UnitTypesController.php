<?php
App::uses('AppController', 'Controller');
/**
 * UnitTypes Controller
 *
 * @property UnitType $UnitType
 */
class UnitTypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UnitType->recursive = 0;
		$this->set('unitTypes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->UnitType->id = $id;
		if (!$this->UnitType->exists()) {
			throw new NotFoundException(__('Invalid unit type'));
		}
		$this->set('unitType', $this->UnitType->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UnitType->create();
			if ($this->UnitType->save($this->request->data)) {
				$this->Session->setFlash(__('The unit type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The unit type could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->UnitType->id = $id;
		if (!$this->UnitType->exists()) {
			throw new NotFoundException(__('Invalid unit type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UnitType->save($this->request->data)) {
				$this->Session->setFlash(__('The unit type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The unit type could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->UnitType->read(null, $id);
		}
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
		$this->UnitType->id = $id;
		if (!$this->UnitType->exists()) {
			throw new NotFoundException(__('Invalid unit type'));
		}
		if ($this->UnitType->delete()) {
			$this->Session->setFlash(__('Unit type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Unit type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
