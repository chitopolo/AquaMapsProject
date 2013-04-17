<?php
/**
 * Stores users.
 *
 * Users will be able to authenticate in the system to create points in the map.
 *
 * @package	Aquamaps
 * @author	Mauro Trigo <mauro.trigo@gmail.com>
 */
class User extends AppModel {
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
		)
	);
	
	var $hasMany = array(
		'Point'
	);
	/**
	* Este callback se ejecuta antes de guardar los datos del usuario
	* 
	*/
	public function beforeSave($options = array()) {
		//MT: antes de guardar un password, este se codifica con el método configurado en el componente Auth (por defecto MD5)
		if (!empty($this->data['User']['password'])) {
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);			
		}
        return true;
    }
}
?>