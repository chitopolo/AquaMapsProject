<?php
App::uses('Unit', 'Model');

/**
 * Unit Test Case
 *
 */
class UnitTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.unit',
		'app.unit_type',
		'app.question',
		'app.survey',
		'app.challenge',
		'app.city',
		'app.country',
		'app.region',
		'app.user',
		'app.point',
		'app.point_type',
		'app.question_option',
		'app.type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Unit = ClassRegistry::init('Unit');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Unit);

		parent::tearDown();
	}

}
