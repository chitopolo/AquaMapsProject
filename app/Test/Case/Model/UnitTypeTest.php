<?php
App::uses('UnitType', 'Model');

/**
 * UnitType Test Case
 *
 */
class UnitTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.unit_type',
		'app.unit',
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
		$this->UnitType = ClassRegistry::init('UnitType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UnitType);

		parent::tearDown();
	}

}
