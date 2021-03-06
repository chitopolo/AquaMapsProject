<?php
App::uses('AppController', 'Controller');
/**
 * Challenges Controller
 *
 * @property Challenge $Challenge
 */
class ChallengesController extends AppController {

/**
 * before filter callback method
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny('add', 'edit');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Challenge->recursive = 0;
		$this->set('challenges', $this->paginate());
	}
	
	public function admin() {
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

		$this->loadModel('Question');
		$this->loadModel('Survey');
		$this->Challenge->id = $id;
		$this->Challenge->recursive = 4;

		$survey = $this->Survey->find('first', array('conditions'=>array("challenge_id"=>$id)));
		$conditions = array("survey_id" => $survey["Survey"]["id"]);

		$questions = $this->Question->find('all', array('conditions' => $conditions));
		if (!$this->Challenge->exists()) {
			throw new NotFoundException(__('Invalid challenge'));
		}
		$this->set('challenge', $this->Challenge->read(null, $id));
		$this->set('report', $report);
		$this->set('questions', $questions);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		//Configure::write('debug', 2);
		if ($this->request->is('post')) {
			unset($this->Challenge->Survey->validate['challenge_id']);
			//var_dump($this->request->data);
			$this->request->data['Survey'][0]['name'] = $this->request->data['Challenge']['title'];
			$this->Challenge->create();
			if ($this->Challenge->saveAssociated($this->request->data, array('deep'=>true))) {
				$this->Session->setFlash(__('El reto ha sido creado! Ahora llena los datos de la encuesta, por favor.'));
				
				$this->redirect(array('controller' => 'surveys', 'action' => 'manageQuestions', $this->Challenge->Survey->getInsertID()));
			} else {
				$this->Session->setFlash(__('Ocurrió un problema al guardar los datos. Por favor revisa los errores.'));
			}
		}
		
		if (!empty($this->data['Challenge']['country_id'])) {
			$cities = $this->Challenge->City->find('list', array('conditions' => 'country_id = ' . $this->data['Challenge']['country_id']));
		}
		
		$countries = $this->Challenge->Country->find('list');
		//$regions = $this->Challenge->Region->find('list');
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
	
	function api_view($id = null, $association = null) {
		$this->apiSettings['contain'] = array(
			
		);
		
		if ($association) {
			$this->apiSettings['findConditions'][] = 'challenge_id = ' . $id;
			$this->apiSettings['association'] = 'Survey';
			parent::api_index();
		} else {
			//$this->Challenge->recursive = 2;
			parent::api_view($id);			
		}
	}
}
