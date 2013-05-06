<?php
App::uses('DataSetsController', 'Controller');

/**
 * DataSetsController Test Case
 *
 */
class DataSetsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.data_set',
		'app.challenge',
		'app.city',
		'app.country',
		'app.region',
		'app.user',
		'app.point',
		'app.point_type',
		'app.survey',
		'app.question',
		'app.unit',
		'app.unit_type',
		'app.type',
		'app.question_type',
		'app.question_answer',
		'app.survey_answer',
		'app.question_option',
		'app.data_set_type'
	);

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
	}

}
