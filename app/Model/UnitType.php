<?php
App::uses('AppModel', 'Model');
/**
 * UnitType Model
 *
 * @property Unit $Unit
 */
class UnitType extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Unit' => array(
			'className' => 'Unit',
			'foreignKey' => 'unit_type_id',
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
