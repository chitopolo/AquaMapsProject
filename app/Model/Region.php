<?php
App::uses('AppModel', 'Model');
/**
 * Region Model
 *
 * @property Challenge $Challenge
 * @property Country $Country
 */
class Region extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Challenge' => array(
			'className' => 'Challenge',
			'foreignKey' => 'region_id',
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
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'region_id',
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
