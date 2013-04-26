<?php
/**
 * Stores points in the map.
 *
 * Points represent a sanitation location, which can be a bathroom or a water access point.
 *
 * @package	Aquamaps
 * @author	Mauro Trigo <mauro.trigo@gmail.com>
 */
class Point extends Model {
	
	var $validate = array(
		'lat' => array(
			'rule' => 'numeric',
			'message' => 'Debe especificarse un costo válido.',
		),
		'lat' => array(
			'rule' => 'decimal',
			'message' => 'Debe especificarse una latitud.',
			'allowEmpty' => false
		),
		'lng' => array(
			'rule' => 'decimal',
			'message' => 'Debe especificarse una longitud.',
			'allowEmpty' => false
		),
	);

	var $belongsTo = array(
		'User',
		'PointType'
	);
	
	function getNearPoints($lat, $lng, $radius = 1) {
		$distanceField = '(
			(
				ACOS( SIN( ' . $lat . ' * PI( ) /180 ) * SIN( lat * PI( ) /180 ) + COS( ' . $lat . ' * PI( ) /180 ) * COS( lat * PI( ) /180 ) * COS( (
				' . $lng . ' - lng
				) * PI( ) /180 ) ) *180 / PI( )
			) * 111.18957696
		)';
		return $this->find('all', array(
			'fields' => array('id', 'lat', 'lng', $distanceField . ' as distance'),
			'group' => 'id HAVING distance < ' . $radius,
			'order' => 'distance ASC',
			'recursive' => -1
		));
	}
}
