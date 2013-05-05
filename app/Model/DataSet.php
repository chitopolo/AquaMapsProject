<?php
App::uses('AppModel', 'Model');
/**
 * DataSet Model
 *
 * @property DataSet $ParentDataSet
 * @property Challenge $Challenge
 * @property DataSetType $DataSetType
 * @property DataSet $ChildDataSet
 */
class DataSet extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ParentDataSet' => array(
			'className' => 'DataSet',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Challenge' => array(
			'className' => 'Challenge',
			'foreignKey' => 'challenge_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'DataSetType' => array(
			'className' => 'DataSetType',
			'foreignKey' => 'data_set_type_id',
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
		'ChildDataSet' => array(
			'className' => 'DataSet',
			'foreignKey' => 'parent_id',
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
