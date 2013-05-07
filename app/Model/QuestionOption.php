<?php
App::uses('AppModel', 'Model');
/**
 * QuestionOption Model
 *
 * @property Question $Question
 */
class QuestionOption extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		//'description' => array(
		//	'rule' => 'notempty',
		//	'message' => 'Este campo es requerido.'
		//),
		//'value' => array(
		//	'rule' => 'notempty',
		//	'message' => 'Este campo es requerido.'
		//)
	);

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
		)
	);
}
