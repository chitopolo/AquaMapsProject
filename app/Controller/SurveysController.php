<?php
App::uses('AppController', 'Controller');
/**
 * Surveys Controller
 *
 * @property Survey $Survey
 */
class SurveysController extends AppController {

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function manageQuestions($id = null) {
		$this->Survey->id = $id;
		if (!$this->Survey->exists()) {
			throw new NotFoundException(__('Invalid survey'));
		}
		
		$this->set('survey',
			$this->Survey->find('first', array(
				 'conditions' => $this->Survey->alias . '.id = ' . $id,
				 'contain' => array(
					'Challenge',
					 'Question' => array(
						 'QuestionOption'
					 )
				 )
			 ))
		);		
		$questionTypes = $this->Survey->Question->QuestionType->find('list');
		$this->set(compact('questionTypes'));
	}

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
	
	function api_view($id = null, $association = null) {		
		if ($association) {
			$this->apiSettings['findConditions'][] = 'survey_id = ' . $id;
			$this->apiSettings['association'] = 'Question';
			parent::api_index();
		} else {
			parent::api_view($id);			
		}
	}
	
	function testMe() {
		$this->request->data = array(
			'user_id' => 1,
			'point_type_id' => rand(1, 4),
			'lat' => '-33.' . rand(391034, 434594),
			'lng' => '-70.' . rand(587141, 753996),
			'price' => rand(587141, 753996),
			'image_file' => '@' . WWW_ROOT . 'img' . DS . 'placeholders' . DS . 'ch_ph_' . rand(1, 3) . '.jpg;type=image/jpeg',
			'current_survey_id' => rand(1, 3),
			'q_1_question_id' => rand(1, 50),
			'q_1_value' => 'value' . rand(1, 50),
			'q_2_question_id' => rand(1, 50),
			'q_2_value' => 'value' . rand(1, 50),
			'q_3_question_id' => rand(1, 50),
			'q_3_value' => 'value' . rand(1, 50),
			'q_4_question_id' => rand(1, 50),
			'q_4_value' => 'value' . rand(1, 50),
			'q_5_question_id' => rand(1, 50),
			'q_5_value' => 'value' . rand(1, 50),
		);
		
		$pointFields = array('user_id', 'point_type_id', 'image_field', 'lat', 'lng', 'price');
			
		foreach($this->request->data as $field => $value) {
			if (in_array($field, $pointFields)) {
				$this->request->data['Point'][$field] = $value;
				unset($this->request->data[$field]);
			}
			if (substr($field, 0, 2) == 'q_') {
				preg_match('/_(\d)+_/', $field, $index);
				preg_match('/(\d)+_(\w+)/', $field, $newField);
				$this->request->data['QuestionAnswer'][$index[1]][$newField[2]] = $value;
				unset($this->request->data[$field]);
			}
		}
		
		if (!empty($this->request->data['current_survey_id'])) {
			$this->request->data['SurveyAnswer']['survey_id'] = $this->request->data['current_survey_id'];
			unset($this->request->data['current_survey_id']);
			$this->request->data['SurveyAnswer']['user_id'] = $this->request->data['Point']['user_id'];
		}
		
		//pr($this->request->data);
		
		$this->Survey->SurveyAnswer->create();
		if ($this->Survey->SurveyAnswer->saveAssociated($this->request->data, array('deep'=>true))) {
			echo 'OK' . $this->Survey->SurveyAnswer->getInsertID();
			$this->Survey->SurveyAnswer->recursive = 2;
			pr($this->Survey->SurveyAnswer->read(null, $this->Survey->SurveyAnswer->getInsertID()));
		}
	}
	
	public function api_add() {
		$response = array('status' => 0, 'message' => '');

		if ($this->request->is('post') && !empty($this->request->data)) {
			//MT: parse survey data			
			//MT: point data
			$pointFields = array('user_id', 'point_type_id', 'image_field', 'lat', 'lng', 'price');
			
			foreach($this->request->data as $field => $value) {
				if (in_array($field, $pointFields)) {
					$this->request->data['Point'][$field] = $value;
					unset($this->request->data[$field]);
				}
				if (substr($field, 0, 2) == 'q_') {
					preg_match('/_(\d)+_/', $field, $index);
					preg_match('/(\d)+_(\w+)/', $field, $newField);
					$this->request->data['QuestionAnswer'][$index[1]][$newField[2]] = $value;
					unset($this->request->data[$field]);
				}
			}
			
			if (!empty($this->request->data['current_survey_id'])) {
				$this->request->data['SurveyAnswer']['survey_id'] = $this->request->data['current_survey_id'];
				unset($this->request->data['current_survey_id']);
				$this->request->data['SurveyAnswer']['user_id'] = $this->request->data['Point']['user_id'];
			}
			
			if (!empty($_FILES['image_field'])) {
				$this->request->data['Point']['image_field'] = $_FILES['image_field'];
				$this->logThis($_FILES, false);
			}
			
			$this->Survey->SurveyAnswer->create();
			if ($this->Survey->SurveyAnswer->saveAssociated($this->request->data, array('deep' => true))) {
				$response['status'] = 1;
				$response['message'] = __('Punto guardado.');
				$response['point']['id'] = $this->Survey->SurveyAnswer->Point->getInsertID();

				if (!empty($this->request->data['Point']['image_field'])) {
					if (move_uploaded_file($this->request->data['Point']['image_field']['tmp_name'], WWW_ROOT . 'img' . DS . 'points' . DS . $response['point']['id'] . '.jpg')) {
						//$response['point']['image'] = Router::url('/img/points/' . $response['point']['id'] . '.jpg');
						$this->Survey->SurveyAnswer->Point->id = $response['point']['id'];
						$this->Survey->SurveyAnswer->Point->saveField('image', 1);
					} else {
						$response['message'] = __('Punto guardado. Problemas con el guardado de la imagen.');
						$response['point']['image'] = 0;
					}
				}
			} else {
				$response['errors'] = $this->Survey->SurveyAnswer->validationErrors;
			}
		} else {
			$response['message'] = __('No hay datos enviados.');
		}

		$this->logThis($response, false);
		
		$this->makeItJson($response);
	}
	
	public function mobileSimulator() {
		$this->data = array(
			'user_id' => rand(1, 4),
			'point_type_id' => rand(1, 4),
			'lat' => '-33.' . rand(391034, 434594),
			'lng' => '-70.' . rand(587141, 753996),
			'price' => rand(587141, 753996),
			'image_file' => '@' . WWW_ROOT . 'img' . DS . 'placeholders' . DS . 'ch_ph_' . rand(1, 3) . '.jpg;type=image/jpeg',
			'current_survey_id' => rand(1, 50),
			'q_1_question_id' => rand(1, 50),
			'q_1_value' => 'value ' . rand(1, 50),
			'q_2_question_id' => rand(1, 50),
			'q_2_value' => 'value ' . rand(1, 50),
			'q_3_question_id' => rand(1, 50),
			'q_3_value' => 'value ' . rand(1, 50),
			'q_4_question_id' => rand(1, 50),
			'q_4_value' => 'value ' . rand(1, 50),
			'q_5_question_id' => rand(1, 50),
			'q_5_value' => 'value ' . rand(1, 50),
		);
		parent::mobileSimulator();
	}
}
