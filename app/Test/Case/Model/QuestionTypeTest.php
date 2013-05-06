<?php
App::uses('QuestionType', 'Model');

/**
 * QuestionType Test Case
 *
 */
class QuestionTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.question_type',
		'app.question',
		'app.survey',
		'app.challenge',
		'app.city',
		'app.country',
		'app.region',
		'app.user',
		'app.point',
		'app.point_type',
		'app.survey_answer',
		'app.question_answer',
		'app.unit',
		'app.unit_type',
		'app.type',
		'app.question_option'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->QuestionType = ClassRegistry::init('QuestionType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->QuestionType);

		parent::tearDown();
	}

}
