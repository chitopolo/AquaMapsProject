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
	public function index() {
		$this->PointType->recursive = 0;
		$this->set('pointTypes', $this->paginate());
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
}
