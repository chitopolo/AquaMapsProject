<?php
App::uses('Point', 'Model');

/**
 * Point Test Case
 *
 */
class PointTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.point',
		'app.user',
		'app.point_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Point = ClassRegistry::init('Point');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Point);

		parent::tearDown();
	}

/**
 * testFindNear method
 *
 * @return void
 */
	public function testFindNear() {
	}

/**
 * testGetFindFields method
 *
 * @return void
 */
	public function testGetFindFields() {
	}

/**
 * testFindWithinConditions method
 *
 * @return void
 */
	public function testFindWithinConditions() {
	}

/**
 * testParsePoint method
 *
 * @return void
 */
	public function testParsePoint() {
	}

/**
 * testIsPoint method
 *
 * @return void
 */
	public function testIsPoint() {
	}

}
