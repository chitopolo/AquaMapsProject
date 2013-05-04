<?php
App::uses('AppController', 'Controller');
/**
 * QuestionOptions Controller
 *
 * @property QuestionOption $QuestionOption
 */
class QuestionOptionsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->QuestionOption->recursive = 0;
		$this->set('questionOptions', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->QuestionOption->id = $id;
		if (!$this->QuestionOption->exists()) {
			throw new NotFoundException(__('Invalid question option'));
		}
		$this->set('questionOption', $this->QuestionOption->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->QuestionOption->create();
			if ($this->QuestionOption->save($this->request->data)) {
				$this->Session->setFlash(__('The question option has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question option could not be saved. Please, try again.'));
			}
		}
		$questions = $this->QuestionOption->Question->find('list');
		$this->set(compact('questions'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->QuestionOption->id = $id;
		if (!$this->QuestionOption->exists()) {
			throw new NotFoundException(__('Invalid question option'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->QuestionOption->save($this->request->data)) {
				$this->Session->setFlash(__('The question option has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question option could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->QuestionOption->read(null, $id);
		}
		$questions = $this->QuestionOption->Question->find('list');
		$this->set(compact('questions'));
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
		$this->QuestionOption->id = $id;
		if (!$this->QuestionOption->exists()) {
			throw new NotFoundException(__('Invalid question option'));
		}
		if ($this->QuestionOption->delete()) {
			$this->Session->setFlash(__('Question option deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Question option was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
