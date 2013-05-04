<?php
App::uses('DataSourceType', 'Model');

/**
 * DataSourceType Test Case
 *
 */
class DataSourceTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.data_source_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DataSourceType = ClassRegistry::init('DataSourceType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DataSourceType);

		parent::tearDown();
	}

}
