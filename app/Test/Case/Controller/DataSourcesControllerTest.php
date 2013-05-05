<?php
App::uses('DataSourcesController', 'Controller');

/**
 * DataSourcesController Test Case
 *
 */
class DataSourcesControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.data_source',
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
		'app.question_option',
		'app.data_source_type'
	);

}
