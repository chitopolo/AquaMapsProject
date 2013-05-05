<?php
App::uses('DataSetType', 'Model');

/**
 * DataSetType Test Case
 *
 */
class DataSetTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.data_set_type',
		'app.data_set'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DataSetType = ClassRegistry::init('DataSetType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DataSetType);

		parent::tearDown();
	}

}
