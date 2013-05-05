<?php
App::uses('AppModel', 'Model');
/**
 * DataSetType Model
 *
 * @property DataSet $DataSet
 */
class DataSetType extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'DataSet' => array(
			'className' => 'DataSet',
			'foreignKey' => 'data_set_type_id',
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
