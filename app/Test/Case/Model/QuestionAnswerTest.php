<?php
App::uses('QuestionAnswer', 'Model');

/**
 * QuestionAnswer Test Case
 *
 */
class QuestionAnswerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.question_answer',
		'app.question',
		'app.survey',
		'app.challenge',
		'app.city',
		'app.country',
		'app.region',
		'app.user',
		'app.point',
		'app.point_type',
		'app.unit',
		'app.unit_type',
		'app.type',
		'app.question_option',
		'app.survey_answer'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->QuestionAnswer = ClassRegistry::init('QuestionAnswer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->QuestionAnswer);

		parent::tearDown();
	}

}
