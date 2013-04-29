<?php
/**
 * Stores users.
 *
 * Challenges will be able to authenticate in the system to create points in the map.
 *
 * @package	Aquamaps
 * @author	Mauro Trigo <mauro.trigo@gmail.com>
 */
class Challenge extends AppModel {
	var $useTable = null;
	
	var $validate = array(
		'first_name' => array(
			'rule' => 'notempty',
			'message' => 'Por favor, pon tu nombre completo.',
			'allowEmpty' => false
		),
		'email' => array(
			'validEmail' => array(
				'rule' => 'email',
				'message' => 'Por favor, pon un email válido.',
				'allowEmpty' => false
			),
            'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'Ya existe un usuario con este email, por favor entra a tu cuenta.',
				'allowEmpty' => false
			)
		),
		'password' => array(
			'rule' => array('between', 4, 15),
			'message' => 'Las contraseñas deben tener entre 4 y 15 caracteres.',
			'on' => 'create',
			'allowEmpty' => false
		),
	);
	
	var $hasMany = array(
		'Point'
	);
}
?>