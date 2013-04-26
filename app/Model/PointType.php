<?php
/**
 * Classifies the points that are added to the map.
 *
 * @package	Aquamaps
 * @author	Mauro Trigo <mauro.trigo@gmail.com>
 */
class PointType extends Model {
	public $actsAs = array('Tree');
	
	public $displayField =  'name';
	
	public $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'Debe especificarse un nombre para el tipo de punto.',
		),
	);

	public $belongsTo = array(
		'Parent' => array(
			'className' => 'PointType',
			'foreignKey' => 'parent_id'
		)
	);

/**
 * Devuelve todos los datos simples (id y name) de los tipos de puntos, extraídos de la cache.
 *
 * @author Mauro Trigo
 *
 * @access public
 *
 * @return array $result.
 * @return bool false. If no result was fetched.
 */
	public function getThem() {
        $result = Cache::read('point_types', 'very_long');
        if (!$result) {
            $result = $this->generateTreeList(null, null, null, '_');
            Cache::write('point_types', $result, 'very_long');
        }
        return $result;
    }

/**
 * Devuelve los datos completos de un tipo de punto, extraído de la cache.
 *
 * @author Mauro Trigo
 *
 * @access public
 *
 * @param array $data. Array that will be modified with the parsed categories
 * @param array $item. Optional array that will be used to complete categories
 *
 * @return array $result.
 * @return bool false. If no result was fetched.
 */
	public function getOne($id) {
        $result = Cache::read('point_type_' . $id, 'very_long');
        if (!$result) {
			$this->recursive = -1;
            $result = $this->read(array('id', 'name', 'description'), $id);
            Cache::write('point_type_' . $id, $result['PointType'], 'very_long');
        }
        return $result;
    }
}
