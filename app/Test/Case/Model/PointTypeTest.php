<?php
App::uses('PointType', 'Model');

/**
 * PointType Test Case
 *
 */
class PointTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.point_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PointType = ClassRegistry::init('PointType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PointType);

		parent::tearDown();
	}

/**
 * testGetThem method
 *
 * @return void
 */
	public function testGetThem() {
	}

/**
 * testGetOne method
 *
 * @return void
 */
	public function testGetOne() {
	}

}
