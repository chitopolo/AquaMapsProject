<?php
App::uses('AppController', 'Controller');
/**
 * QuestionAnswers Controller
 *
 * @property QuestionAnswer $QuestionAnswer
 */
class QuestionAnswersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->QuestionAnswer->recursive = 0;
		$this->set('questionAnswers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->QuestionAnswer->id = $id;
		if (!$this->QuestionAnswer->exists()) {
			throw new NotFoundException(__('Invalid question answer'));
		}
		$this->set('questionAnswer', $this->QuestionAnswer->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->QuestionAnswer->create();
			if ($this->QuestionAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The question answer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question answer could not be saved. Please, try again.'));
			}
		}
		$questions = $this->QuestionAnswer->Question->find('list');
		$surveyAnswers = $this->QuestionAnswer->SurveyAnswer->find('list');
		$this->set(compact('questions', 'surveyAnswers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->QuestionAnswer->id = $id;
		if (!$this->QuestionAnswer->exists()) {
			throw new NotFoundException(__('Invalid question answer'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->QuestionAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The question answer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question answer could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->QuestionAnswer->read(null, $id);
		}
		$questions = $this->QuestionAnswer->Question->find('list');
		$surveyAnswers = $this->QuestionAnswer->SurveyAnswer->find('list');
		$this->set(compact('questions', 'surveyAnswers'));
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
		$this->QuestionAnswer->id = $id;
		if (!$this->QuestionAnswer->exists()) {
			throw new NotFoundException(__('Invalid question answer'));
		}
		if ($this->QuestionAnswer->delete()) {
			$this->Session->setFlash(__('Question answer deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Question answer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->QuestionAnswer->recursive = 0;
		$this->set('questionAnswers', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->QuestionAnswer->id = $id;
		if (!$this->QuestionAnswer->exists()) {
			throw new NotFoundException(__('Invalid question answer'));
		}
		$this->set('questionAnswer', $this->QuestionAnswer->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->QuestionAnswer->create();
			if ($this->QuestionAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The question answer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question answer could not be saved. Please, try again.'));
			}
		}
		$questions = $this->QuestionAnswer->Question->find('list');
		$surveyAnswers = $this->QuestionAnswer->SurveyAnswer->find('list');
		$this->set(compact('questions', 'surveyAnswers'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->QuestionAnswer->id = $id;
		if (!$this->QuestionAnswer->exists()) {
			throw new NotFoundException(__('Invalid question answer'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->QuestionAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The question answer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question answer could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->QuestionAnswer->read(null, $id);
		}
		$questions = $this->QuestionAnswer->Question->find('list');
		$surveyAnswers = $this->QuestionAnswer->SurveyAnswer->find('list');
		$this->set(compact('questions', 'surveyAnswers'));
	}

/**
 * admin_delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->QuestionAnswer->id = $id;
		if (!$this->QuestionAnswer->exists()) {
			throw new NotFoundException(__('Invalid question answer'));
		}
		if ($this->QuestionAnswer->delete()) {
			$this->Session->setFlash(__('Question answer deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Question answer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
