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

	/**
	* MT:
	* Este callback se ejecuta antes de guardar los datos del usuario
	* 
	*/
	public function beforeSave($options = array()) {
		//MT: antes de guardar un password, este se codifica con el método configurado en el componente Auth (por defecto MD5)
		if (!empty($this->data['User']['password'])) {
			$this->data[$this->name]['password'] = AuthComponent::password($this->data[$this->name]['password']);
		}
        return true;
    }

	public function generatePassword($length = 8) {
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
	
		srand((double)microtime() * 1000000);	
		$i = 0;	
		$newPassword = '';

		while ($i <= $length) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$newPassword = $newPassword . $tmp;
			$i++;
		}		
    	return $newPassword;
	}

	public function currentPassword($check) {
		$this->recursive = -1;
		$user = $this->read(array('password'));
		foreach($check as $key => $value) {
			if (AuthComponent::password($value) == $user[$this->name]['password']) {
				return true;
			} else {
				return false;
			}
		}
		return true;
	}

	public function validateas($field, $compareField) {
		$user = $this->read(array('pasword'));
		foreach($field as $key => $value ) {
			if ($value == AuthComponent::password($this->data[$this->name][$compareField])) {
				return true;
			} else {
				return false;
			}
		}
		return true;
	}
}
?>