<?php
/**
 * ChallengeFixture
 *
 */
class ChallengeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'city_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'country_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'region_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'title' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'invitation' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1000, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'image' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'city_id' => 1,
			'country_id' => 1,
			'region_id' => 1,
			'user_id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'invitation' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet',
			'image' => 'Lorem ipsum dolor sit amet'
		),
	);

}
