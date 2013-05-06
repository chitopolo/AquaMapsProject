<?php
App::uses('DataSet', 'Model');

/**
 * DataSet Test Case
 *
 */
class DataSetTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.data_set',
		'app.challenge',
		'app.city',
		'app.country',
		'app.region',
		'app.user',
		'app.point',
		'app.point_type',
		'app.survey',
		'app.question',
		'app.unit',
		'app.unit_type',
		'app.type',
		'app.question_type',
		'app.question_answer',
		'app.survey_answer',
		'app.question_option',
		'app.data_set_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DataSet = ClassRegistry::init('DataSet');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DataSet);

		parent::tearDown();
	}

}
