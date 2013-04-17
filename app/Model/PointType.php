<?php
/**
 * Classifies the points that are added to the map.
 *
 * @package	Aquamaps
 * @author	Mauro Trigo <mauro.trigo@gmail.com>
 */
class PointType extends Model {
	var $actsAs = array('Tree');
	
	var $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'Debe especificarse un nombre para el tipo de punto.',
		),
	);

	var $belongsTo = array(
		'Parent' => array(
			'className' => 'PointType',
			'foreignKey' => 'parent_id'
		)
	);
}
