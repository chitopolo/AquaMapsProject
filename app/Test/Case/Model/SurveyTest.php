<?php
App::uses('Survey', 'Model');

/**
 * Survey Test Case
 *
 */
class SurveyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.survey',
		'app.challenge',
		'app.city',
		'app.country',
		'app.region',
		'app.user',
		'app.point',
		'app.point_type',
		'app.question',
		'app.unit',
		'app.question_option'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Survey = ClassRegistry::init('Survey');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Survey);

		parent::tearDown();
	}

}
