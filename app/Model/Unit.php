<?php
App::uses('AppModel', 'Model');
/**
 * Unit Model
 *
 * @property UnitType $UnitType
 * @property Question $Question
 * @property Type $Type
 */
class Unit extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'unit';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'UnitType' => array(
			'className' => 'UnitType',
			'foreignKey' => 'unit_type_id',
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
			'foreignKey' => 'unit_id',
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


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Type' => array(
			'className' => 'Type',
			'joinTable' => 'unit_types',
			'foreignKey' => 'unit_id',
			'associationForeignKey' => 'type_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
