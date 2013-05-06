<?php
/**
 * DataSetFixture
 *
 */
class DataSetFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'challenge_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'data_set_type_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'mappable' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'public' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'source_link' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'source_table' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'challenge_id' => 1,
			'data_set_type_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'mappable' => 1,
			'public' => 1,
			'source_link' => 'Lorem ipsum dolor sit amet',
			'source_table' => 'Lorem ipsum dolor sit amet'
		),
	);

}
