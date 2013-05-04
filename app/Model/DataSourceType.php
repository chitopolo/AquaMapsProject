<?php
App::uses('AppModel', 'Model');
/**
 * DataSourceType Model
 *
 */
class DataSourceType extends AppModel {
	
	public $hasMany = array(
		'DataSource' => array(
			'className' => 'DataSource',
			'foreignKey' => 'data_source_type_id',
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
