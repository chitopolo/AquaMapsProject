<?php
App::uses('AppController', 'Controller');
/**
 * DataSets Controller
 *
 * @property DataSet $DataSet
 */
class DataSetsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->DataSet->recursive = 0;
		$this->set('dataSets', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->DataSet->id = $id;
		if (!$this->DataSet->exists()) {
			throw new NotFoundException(__('Invalid data set'));
		}
		$this->set('dataSet', $this->DataSet->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DataSet->create();
			if ($this->DataSet->save($this->request->data)) {
				$this->Session->setFlash(__('The data set has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The data set could not be saved. Please, try again.'));
			}
		}
		$parentDataSets = $this->DataSet->ParentDataSet->find('list');
		$challenges = $this->DataSet->Challenge->find('list');
		$dataSetTypes = $this->DataSet->DataSetType->find('list');
		$this->set(compact('parentDataSets', 'challenges', 'dataSetTypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->DataSet->id = $id;
		if (!$this->DataSet->exists()) {
			throw new NotFoundException(__('Invalid data set'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->DataSet->save($this->request->data)) {
				$this->Session->setFlash(__('The data set has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The data set could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->DataSet->read(null, $id);
		}
		$parentDataSets = $this->DataSet->ParentDataSet->find('list');
		$challenges = $this->DataSet->Challenge->find('list');
		$dataSetTypes = $this->DataSet->DataSetType->find('list');
		$this->set(compact('parentDataSets', 'challenges', 'dataSetTypes'));
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
		$this->DataSet->id = $id;
		if (!$this->DataSet->exists()) {
			throw new NotFoundException(__('Invalid data set'));
		}
		if ($this->DataSet->delete()) {
			$this->Session->setFlash(__('Data set deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Data set was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
