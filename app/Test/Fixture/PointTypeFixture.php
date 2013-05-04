<?php
/**
 * PointTypeFixture
 *
 */
class PointTypeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'parent_id' => 1,
			'lft' => 1,
			'rght' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet'
		),
	);

}
