<?php
App::uses('AppController', 'Controller');
/**
 * SurveyAnswers Controller
 *
 * @property SurveyAnswer $SurveyAnswer
 */
class SurveyAnswersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->SurveyAnswer->recursive = 0;
		$this->set('surveyAnswers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->SurveyAnswer->id = $id;
		if (!$this->SurveyAnswer->exists()) {
			throw new NotFoundException(__('Invalid survey answer'));
		}
		$this->set('surveyAnswer', $this->SurveyAnswer->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SurveyAnswer->create();
			if ($this->SurveyAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The survey answer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The survey answer could not be saved. Please, try again.'));
			}
		}
		$surveys = $this->SurveyAnswer->Survey->find('list');
		$users = $this->SurveyAnswer->User->find('list');
		$points = $this->SurveyAnswer->Point->find('list');
		$this->set(compact('surveys', 'users', 'points'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->SurveyAnswer->id = $id;
		if (!$this->SurveyAnswer->exists()) {
			throw new NotFoundException(__('Invalid survey answer'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->SurveyAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The survey answer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The survey answer could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->SurveyAnswer->read(null, $id);
		}
		$surveys = $this->SurveyAnswer->Survey->find('list');
		$users = $this->SurveyAnswer->User->find('list');
		$points = $this->SurveyAnswer->Point->find('list');
		$this->set(compact('surveys', 'users', 'points'));
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
		$this->SurveyAnswer->id = $id;
		if (!$this->SurveyAnswer->exists()) {
			throw new NotFoundException(__('Invalid survey answer'));
		}
		if ($this->SurveyAnswer->delete()) {
			$this->Session->setFlash(__('Survey answer deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Survey answer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
