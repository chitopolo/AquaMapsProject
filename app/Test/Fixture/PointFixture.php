<?php
/**
 * PointFixture
 *
 */
class PointFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 7),
		'point_type_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2),
		'photo' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'lat' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '10,6'),
		'lng' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '10,6'),
		'price' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '7,2', 'comment' => 'represents the amount of USD per metric cube of water'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'point_type_id' => 1,
			'photo' => 1,
			'lat' => 1,
			'lng' => 1,
			'price' => 1,
			'created' => '2013-05-04 17:44:19'
		),
	);

}
