<?php
App::uses('AppModel', 'Model');
/**
 * Question Model
 *
 * @property Survey $Survey
 * @property Unit $Unit
 * @property QuestionType $QuestionType
 * @property QuestionAnswer $QuestionAnswer
 * @property QuestionOption $QuestionOption
 */
class Question extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'rule' => 'notempty',
			'message' => 'Este campo es requerido.'
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Survey' => array(
			'className' => 'Survey',
			'foreignKey' => 'survey_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		//'Unit' => array(
		//	'className' => 'Unit',
		//	'foreignKey' => 'unit_id',
		//	'conditions' => '',
		//	'fields' => '',
		//	'order' => ''
		//),
		'QuestionType' => array(
			'className' => 'QuestionType',
			'foreignKey' => 'question_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'QuestionAnswer' => array(
			'className' => 'QuestionAnswer',
			'foreignKey' => 'question_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'QuestionOption' => array(
			'className' => 'QuestionOption',
			'foreignKey' => 'question_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public $apiSettings = array(
		'contain' => array(
			'QuestionType',
		),
		'virtualFields' => array(
			'question_type' => 'QuestionType.code'
		),
		'fields' => array('id', 'survey_id', 'question_type', 'name'),		
	);
}
