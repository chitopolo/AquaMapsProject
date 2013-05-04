<?php
App::uses('AppController', 'Controller');
/**
 * Challenges Controller
 *
 * @property Challenge $Challenge
 */
class ChallengesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Challenge->recursive = 0;
		$this->set('challenges', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Challenge->id = $id;
		if (!$this->Challenge->exists()) {
			throw new NotFoundException(__('Invalid challenge'));
		}
		$this->set('challenge', $this->Challenge->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Challenge->create();
			if ($this->Challenge->save($this->request->data)) {
				$this->Session->setFlash(__('The challenge has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The challenge could not be saved. Please, try again.'));
			}
		}
		$cities = $this->Challenge->City->find('list');
		$countries = $this->Challenge->Country->find('list');
		$regions = $this->Challenge->Region->find('list');
		$users = $this->Challenge->User->find('list');
		$this->set(compact('cities', 'countries', 'regions', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Challenge->id = $id;
		if (!$this->Challenge->exists()) {
			throw new NotFoundException(__('Invalid challenge'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Challenge->save($this->request->data)) {
				$this->Session->setFlash(__('The challenge has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The challenge could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Challenge->read(null, $id);
		}
		$cities = $this->Challenge->City->find('list');
		$countries = $this->Challenge->Country->find('list');
		$regions = $this->Challenge->Region->find('list');
		$users = $this->Challenge->User->find('list');
		$this->set(compact('cities', 'countries', 'regions', 'users'));
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
		$this->Challenge->id = $id;
		if (!$this->Challenge->exists()) {
			throw new NotFoundException(__('Invalid challenge'));
		}
		if ($this->Challenge->delete()) {
			$this->Session->setFlash(__('Challenge deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Challenge was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
