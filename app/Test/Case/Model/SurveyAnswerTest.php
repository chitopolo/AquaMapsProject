<?php
App::uses('SurveyAnswer', 'Model');

/**
 * SurveyAnswer Test Case
 *
 */
class SurveyAnswerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.survey_answer',
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
		'app.unit_type',
		'app.type',
		'app.question_option',
		'app.question_answer'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SurveyAnswer = ClassRegistry::init('SurveyAnswer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SurveyAnswer);

		parent::tearDown();
	}

}
