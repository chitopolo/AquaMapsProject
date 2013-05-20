<?php
App::uses('AppModel', 'Model');
/**
 * Challenge Model
 *
 * @property City $City
 * @property Country $Country
 * @property Region $Region
 * @property User $User
 * @property Survey $Survey
 */
class Challenge extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'rule' => 'notempty',
			'message' => 'Este campo es requerido.'
		),
		'invitation' => array(
			'rule' => 'notempty',
			'message' => 'Este campo es requerido.'
		)
	);
 
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'city_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Region' => array(
			'className' => 'Region',
			'foreignKey' => 'region_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Survey' => array(
			'className' => 'Survey',
			'foreignKey' => 'challenge_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

/**
 * 
 *
 * @var array
 */
	public $apiSettings = array(
		'contain' => array(
			'Country',
			'Region',
			'City'
		),
		'virtualFields' => array(
			'location' => 'CONCAT(City.name, ", ", Region.name, ", ", Country.name)'
		),
		'fields' => array('id', 'title', 'location', 'invitation', 'description', 'image'),		
	);
	
	
	public function beforeSave() {
		if (!empty($this->data[$this->alias]['image'])) {
			if (is_array($this->data[$this->alias]['image']) && !empty($this->data[$this->alias]['image']['name'])) {
				$imagePrefix = rand(33, 99) . '_';
				$newImage = $this->getImagePath() . $imagePrefix . $this->data[$this->alias]['image']['name'];
				if (move_uploaded_file($this->data[$this->alias]['image']['tmp_name'], $newImage)) {
					$this->data[$this->alias]['image'] = $imagePrefix . $this->data[$this->alias]['image']['name'];
				} else {
					unset($this->data[$this->alias]['image']);
				}
			} else {
				unset($this->data[$this->alias]['image']);
			}
		}
	}
	
	public function getImagePath() {
		return WWW_ROOT . 'img' . DS . strtolower(Inflector::pluralize($this->alias)) . DS;
	}


	public function getPopular(){
		return $this->find('all');
	}

}
