<?php
/**
 * SurveyAnswerFixture
 *
 */
class SurveyAnswerFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'survey_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'point_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'image' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'survey_id' => 1,
			'user_id' => 1,
			'point_id' => 1,
			'image' => 'Lorem ipsum dolor sit amet'
		),
	);

}
