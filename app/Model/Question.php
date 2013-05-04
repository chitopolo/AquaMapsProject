<?php
App::uses('AppModel', 'Model');
/**
 * Question Model
 *
 * @property Survey $Survey
 * @property Unit $Unit
 * @property QuestionOption $QuestionOption
 */
class Question extends AppModel {


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
		'Unit' => array(
			'className' => 'Unit',
			'foreignKey' => 'unit_id',
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
		'QuestionOption' => array(
			'className' => 'QuestionOption',
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
		)
	);

}
