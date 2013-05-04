<?php
App::uses('AppModel', 'Model');
/**
 * DataSource Model
 *
 * @property DataSource $ParentDataSource
 * @property Challenge $Challenge
 * @property DataSource $ChildDataSource
 */
class DataSource extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ParentDataSource' => array(
			'className' => 'DataSource',
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
		)
		'DataSourceType' => array(
			'className' => 'DataSourceType',
			'foreignKey' => 'data_source_type_id',
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
		'ChildDataSource' => array(
			'className' => 'DataSource',
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
