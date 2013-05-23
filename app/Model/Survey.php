<?php
App::uses('AppModel', 'Model');
/**
 * Survey Model
 *
 * @property Challenge $Challenge
 * @property Question $Question
 * @property SurveyAnswer $SurveyAnswer
 */
class Survey extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Challenge' => array(
			'className' => 'Challenge',
			'foreignKey' => 'challenge_id',
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
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'survey_id',
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
		'SurveyAnswer' => array(
			'className' => 'SurveyAnswer',
			'foreignKey' => 'survey_id',
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
