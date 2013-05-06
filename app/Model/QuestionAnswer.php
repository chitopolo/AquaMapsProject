<?php
App::uses('AppModel', 'Model');
/**
 * QuestionAnswer Model
 *
 * @property Question $Question
 * @property SurveyAnswer $SurveyAnswer
 */
class QuestionAnswer extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'question_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'SurveyAnswer' => array(
			'className' => 'SurveyAnswer',
			'foreignKey' => 'survey_answer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
