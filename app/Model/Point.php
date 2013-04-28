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
	
	function findNear($lat, $lng, $radius = .7) {
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

	function getFindFields() {
		return array('id', 'point_type_id', 'lat', 'lng');
	}
	
	
/**
 * Find reports within a rectangular area defined by two points.
 *
 * @author Mauro Trigo
 *
 * @access public
 *
 * @param mixed $point1 Latitude and longitude of point 1
 * @param mixed $point2 Latitude and longitude of point 2
 *
 * @return array Reports contained
 **/
	function findWithinConditions($point1, $point2) {
		$point1 = $this->parsePoint($point1);
		$point2 = $this->parsePoint($point2);

		if ($this->isPoint($point1) && $this->isPoint($point2)) {
			//MT: add and substract a tiny fraction of a degree to include the 2 points
			$latitudes = array(min($point1[0], $point2[0]) - 0.0001, max($point1[0], $point2[0]) + 0.0001);
			$longitudes = array(min($point1[1], $point2[1]) - 0.0001, max($point1[1], $point2[1]) + 0.0001);

			return array('(lat BETWEEN ' . $latitudes[0] . ' AND ' . $latitudes[1] . ')', '(lng BETWEEN ' . $longitudes[0] . ' AND ' . $longitudes[1] . ')');
		} else {
			$this->appNotices['error'] = __('Punto inválido');
			return null;
		}		
	}

/**
 * Parse a point.
 *
 * A point is an array with two values: latitude and longitude.
 *
 * @author Mauro Trigo
 * @access public
 * @param array $point Latitude and longitude.
 * @return bool
 **/
	function parsePoint($point) {
		if (!is_array($point)) {
			return explode(',', $point);
		} else {
			return $point;
		}
	}

/**
 * Validate a point.
 *
 * A point is an array with two values: latitude and longitude.
 *
 * @author Mauro Trigo
 * @access public
 * @param array $point Latitude and longitude.
 * @return bool
 **/
	function isPoint($point) {
		if (!empty($point)) {
			return true;
		} else {
			return false;
		}
	}
}
