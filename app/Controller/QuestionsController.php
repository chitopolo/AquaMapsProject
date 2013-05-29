<?php
App::uses('AppController', 'Controller');
/**
 * Questions Controller
 *
 * @property Question $Question
 */
class QuestionsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Question->recursive = 0;
		$this->set('questions', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Question->id = $id;
		if (!$this->Question->exists()) {
			throw new NotFoundException(__('Invalid question'));
		}
		$this->set('question', $this->Question->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Question->create();
			
			foreach($this->request->data['QuestionOption'] as $key => $questionOption) {
				if (empty($questionOption['description']) || empty($questionOption['description'])) {
					unset($this->request->data['QuestionOption'][$key]);
				}
			}
			
			if ($this->Question->saveAssociated($this->request->data, array('deep'=>true))) {
				$this->Session->setFlash(__('La pregunta fue guardada.'));
//				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La pregunta no pudo ser guardada, por favor intente nuevamente.'));
			}
		}
		$this->redirect($this->referer());
		//$surveys = $this->Question->Survey->find('list');
		//$units = $this->Question->Unit->find('list');
		//$this->set(compact('surveys', 'units'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Question->id = $id;
		if (!$this->Question->exists()) {
			throw new NotFoundException(__('Invalid question'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Question->save($this->request->data)) {
				$this->Session->setFlash(__('The question has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Question->read(null, $id);
		}
		$surveys = $this->Question->Survey->find('list');
		$units = $this->Question->Unit->find('list');
		$this->set(compact('surveys', 'units'));
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
		$this->Question->id = $id;
		if (!$this->Question->exists()) {
			throw new NotFoundException(__('Invalid question'));
		}
		if ($this->Question->delete()) {
			$this->Session->setFlash(__('Question deleted'));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Question was not deleted'));
	//	$this->redirect(array('action' => 'index'));
		$this->redirect($this->referer());
	}
}
