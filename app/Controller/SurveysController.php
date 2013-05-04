<?php
App::uses('AppController', 'Controller');
/**
 * Surveys Controller
 *
 * @property Survey $Survey
 */
class SurveysController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Survey->recursive = 0;
		$this->set('surveys', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Survey->id = $id;
		if (!$this->Survey->exists()) {
			throw new NotFoundException(__('Invalid survey'));
		}
		$this->set('survey', $this->Survey->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Survey->create();
			if ($this->Survey->save($this->request->data)) {
				$this->Session->setFlash(__('The survey has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The survey could not be saved. Please, try again.'));
			}
		}
		$challenges = $this->Survey->Challenge->find('list');
		$this->set(compact('challenges'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Survey->id = $id;
		if (!$this->Survey->exists()) {
			throw new NotFoundException(__('Invalid survey'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Survey->save($this->request->data)) {
				$this->Session->setFlash(__('The survey has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The survey could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Survey->read(null, $id);
		}
		$challenges = $this->Survey->Challenge->find('list');
		$this->set(compact('challenges'));
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
		$this->Survey->id = $id;
		if (!$this->Survey->exists()) {
			throw new NotFoundException(__('Invalid survey'));
		}
		if ($this->Survey->delete()) {
			$this->Session->setFlash(__('Survey deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Survey was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
