<?php
App::uses('AppController', 'Controller');
/**
 * DataSetTypes Controller
 *
 * @property DataSetType $DataSetType
 */
class DataSetTypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->DataSetType->recursive = 0;
		$this->set('dataSetTypes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->DataSetType->id = $id;
		if (!$this->DataSetType->exists()) {
			throw new NotFoundException(__('Invalid data set type'));
		}
		$this->set('dataSetType', $this->DataSetType->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DataSetType->create();
			if ($this->DataSetType->save($this->request->data)) {
				$this->Session->setFlash(__('The data set type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The data set type could not be saved. Please, try again.'));
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
		$this->DataSetType->id = $id;
		if (!$this->DataSetType->exists()) {
			throw new NotFoundException(__('Invalid data set type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->DataSetType->save($this->request->data)) {
				$this->Session->setFlash(__('The data set type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The data set type could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->DataSetType->read(null, $id);
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
		$this->DataSetType->id = $id;
		if (!$this->DataSetType->exists()) {
			throw new NotFoundException(__('Invalid data set type'));
		}
		if ($this->DataSetType->delete()) {
			$this->Session->setFlash(__('Data set type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Data set type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
