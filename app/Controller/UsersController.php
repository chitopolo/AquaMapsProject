<?php
class UsersController extends AppController {
	
	/**
	* MT:
	* Este callback se ejecuta antes de cualquier acción en el controlador. Si se ejecutar algo antes de cualquier acción en todo el sistema, hay que hacerlo en el beforeFilter del AppController, es por eso que en este caso, se llama al beforeFilter del AppController mediante parent::beforeFilter();
	* 
	*/
	public function beforeFilter() {
		//MT: llama al beforeFilter del parent (AppController.php)
		parent::beforeFilter();
		//MT: protege la acción "hello"
		$this->Auth->deny(array('hello'));
	}
	

	/**
	* MT:
	* Si hay datos (en POST o GET), intenta guardar el usuario. El password se encodifica en el modelo (User.php) justo antes de guardarse en el callback beforeSave
	* 
	*/
	public function register() {
		if ($this->request->is('post')) {
			if (!empty($this->data)) {
				$password = $this->data['User']['password'];
				$this->User->create();
				if ($this->User->save($this->data)) {
					$this->Session->setFlash(__('Felicidades! por favor entra a tu cuenta'));	
					$this->redirect(array('action' => 'login'));				
				} else {
					$this->Session->setFlash(__('Por favor, corrige los errores.'));
				}
			}
		}
	}

	/**
	* MT:
	* Si hay datos (en POST o GET), intenta guardar el usuario. El password se encodifica en el modelo (User.php) justo antes de guardarse en el callback beforeSave
	* 
	*/
	public function edit() {
		$this->User->id = $this->current['User']['id'];
	
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Cambios guardados'));
				$this->redirect(array('action' => 'hello'));
			} else {
				$this->Session->setFlash(__('Los cambios no pudieron ser guardados, por favor corrige los errores.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $this->User->id);
		}
	}

	public function editPassword() {
		$this->User->id = $this->current['User']['id'];

		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}

		$this->User->validate['password_current'] = array(
			'currentPassword' => array(
				'rule' => array('currentPassword'),
				'message' => 'Por favor, ingresa tu contraseña actual.',
				'allowEmpty' => false
			)
		);

		$this->User->validate['password_new'] = array(
			'length' => array(
				'rule' => array('between', 4, 15),
				'message' => 'Las contraseñas deben tener entre 4 y 15 caracteres.',
				'allowEmpty' => false
			)
		);

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Contraseña guardada.'));
				$this->redirect(array('action' => 'hello'));
			} else {
				$this->Session->setFlash(__('Los cambios no pudieron ser guardados, por favor corrige los errores.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $this->current['User']['id']);
		}
	}

	public function hello () {
		
	}
	
	/**
	* MT:
	* Esta acción toma los datos por POST y autentifica los datos de loggeo mediante el componente Auth. Este componente se configura en el AppController
	* 
	*/
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Username or password is incorrect'), 'default', array(), 'auth');
			}
		}
	}
	/**
	* MT:
	* Esta acción sirve para registrar/loggear a un usuario con su cuenta de Facebook
	* 
	*/
	public function loginFacebook() {		
		//MT importar la SDK de Facebook
		App::import('Vendor', 'facebook/facebook');
		//MT: estos datos se consiguen creando una app en Facebook
		$facebook = new Facebook(array('appId' => Configure::read('QConf.facebookAppId'), 'secret' => Configure::read('QConf.facebookSecret'), 'cookie' => true));
		
		//MT: recuperar el ID de usuario de Facebook
		$facebookUserId = $facebook->getUser();
		
		if (!empty($facebookUserId)) {
			try {
				///MT: recuperar el usuario completo de Facebook, sabiendo que está loggeado y autenticado
				$facebookUser = $facebook->api('/me');
			} catch (FacebookApiException $e) {
				error_log($e);
				$user = null;
			}

			//MT: si el usuario de Facebook ya nos ha permitido el acceso, verificar si tiene una cuenta, caso contrario, crear una
			$this->User->recursive = -1;
			$existingUser = $this->User->findByFacebookOauthUid($facebookUser['id']);
			
			if(empty($existingUser)) {
				//MT: buscar el usuario según su email
				$existingUser = $this->User->findByEmail($facebookUser['email']);
				if(empty($existingUser)) {
					//MT: el usuario es absolutamente nuevo y se creará una cuenta en base a sus datos de Facebook
					$newFacebookUser = array();
					$newFacebookUser['User']['facebook_oauth_uid'] = $facebookUser['id'];
					$newFacebookUser['User']['email'] = $facebookUser['email'];
					$newFacebookUser['User']['first_name'] = $facebookUser['first_name'];
					$newFacebookUser['User']['last_name'] = $facebookUser['last_name'];
					
					$newFacebookUser['User']['password_temp'] = $this->User->generatePassword();
					$newFacebookUser['User']['password'] = $newFacebookUser['User']['password_temp'];
					
					//MT: se crea el usuario
					$this->User->create();
					if ($this->User->save($newFacebookUser)) {
						$this->Auth->fields = array('username' => 'facebook_oauth_uid', 'password' => 'password');
						$this->Auth->login($newFacebookUser);
						$this->Session->setFlash(__('Genial! tu cuenta ('.$facebookUser['email'].') ha sido asociada con Facebook.', true));
					} else {
						$this->Session->setFlash(__('Oh oh. Ocurrió algún problema, por favor intenta nuevamente', true));
					}
				} else {
					//MT: asociar la cuenta de Facebook con el usuario existente
					$this->User->id = $existingUser['User']['id'];
					if ($this->User->saveField('facebook_oauth_uid', $facebookUser['id'])) {
						$this->Session->setFlash(__('Genial! tu cuenta ('.$facebookUser['email'].') ha sido asociada con Facebook.', true));
						$this->Auth->fields = array('username' => 'facebook_oauth_uid', 'password' => 'password');
						$existingUser['facebook_oauth_uid'] = $facebookUser['id'];
						$this->Auth->login($existingUser);
					}
				}
			} else {
				//MT: la cuenta de usuario ya está relacionada con su cuenta de Facebook, loggear al usuario
				$this->Auth->fields = array('username' => 'facebook_oauth_uid', 'password' => 'password');
				$this->Auth->login($existingUser);
			}
		} else {
			//MT: obtener la url de login de Facebook y redireccionar para la gestión de permisos
			$this->redirect($facebook->getLoginUrl(array('scope' => 'email, user_location, publish_stream')));			
		}
		$this->redirect($this->Auth->redirect());
	}	
	/**
	* MT:
	* Esta acción sirve para registrar/loggear a un usuario con su cuenta de Facebook
	* 
	*/
	public function loginGoogle() {		
		//MT importar la SDK de Facebook
		App::import('Vendor', 'google/apiClient');
		
		$googleClient = new apiClient();		

		//MT: estos datos se consiguen creando un Client ID en https://code.google.com/apis/console/?api=plus y dando de alta el Google+		
		$googleClient->setClientId(Configure::read('QConf.googleClientID'));
		$googleClient->setClientSecret(Configure::read('QConf.googleClientSecret'));
		
		//MT: una vez autenticado el usuario, la API de Google redireccionará a esta misma acción
		$googleClient->setRedirectUri(Router::url(array('controller' => 'users', 'action' => 'loginGoogle'), true));
		
		//MT: se determinan los permisos que nos dará el usuario en los "scopes"
		$googleClient->setScopes(array('https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/userinfo.profile'));
		
		//MT: "setAccessType" permite acceder solamente online
		$googleClient->setAccessType('online');
		
		//MT: "setApprovalPrompt" permite recordar la aceptación del usuario, de modo que no se solicite una confirmación cada vez que se registre
		$googleClient-> setApprovalPrompt('auto');		
		
		//MT: se inicializa el servicio Oauth
		//MT: IMPORTANTE: Google no permite agregar servicios después de autenticar
		App::import ('Vendor', 'google/contrib/apiOauth2Service');
		$oauth2Service = new apiOauth2Service($googleClient);
		
		//MT: empieza el proceso de "handshake" para la autenticación y autorización de los servicios google
		if (isset($_GET['code'])) {						
			$googleClient->authenticate();
			$_SESSION['token'] = $googleClient->getAccessToken();			
		}		
		
		if (isset($SESSION['token'])){
			$googleClient->setAccessToken($_SESSION['token']);
		}
		
		
		if ($googleClient->getAccessToken()) {
			$googleUser = $oauth2Service->userinfo->get();
			
			//MT: si el usuario de Google ya nos ha permitido el acceso, verificar si tiene una cuenta, caso contrario, crear una
			$this->User->recursive = -1;
			$existingUser = $this->User->findByGoogleOauthUid($googleUser['id']);
			
			if(empty($existingUser)) {
				//MT: buscar el usuario según su email
				$existingUser = $this->User->findByEmail($googleUser['email']);
				if(empty($existingUser)) {
					$newGoogleUser = array();
					$newGoogleUser['User']['google_oauth_uid'] = $googleUser['id'];
					$newGoogleUser['User']['email'] = $googleUser['email']; 
					$newGoogleUser['User']['first_name'] = $googleUser['given_name']; 
					$newGoogleUser['User']['last_name'] = $googleUser['family_name'];
					
					$newGoogleUser['User']['password_temp'] = $this->User->generatePassword();
					$newGoogleUser['User']['password'] = $newGoogleUser['User']['password_temp'];
					
					$this->User->create();
					if($this->User->save($newGoogleUser)) {
						$this->Auth->fields = array('username' => 'google_oauth_uid', 'password' => 'password');
						$this->Auth->login($newGoogleUser);
						$this->Session->setFlash(__('Genial! tu cuenta ('.$googleUser['email'].') ha sido asociada con Google.', true));
					} else {
						$this->Session->setFlash(__('Oh oh. Ocurrió algún problema, por favor intenta nuevamente', true));
					}
				} else {
					//MT: asociar la cuenta de Google con el usuario existente
					$this->User->id = $existingUser['User']['id'];
					if ($this->User->saveField('google_oauth_uid', $googleUser['id'])) {
						$this->Session->setFlash(__('Genial! tu cuenta ('.$googleUser['email'].') ha sido asociada con Google.', true));
						$this->Auth->fields = array('username' => 'google_oauth_uid', 'password' => 'password');
						$existingUser['google_oauth_uid'] = $googleUser['id'];
						$this->Auth->login($existingUser);
					}			
				}
			} else {
				//MT: la cuenta de usuario ya está relacionada con su cuenta de Google, loggear al usuario
				$this->Auth->fields = array('username' => 'oauth_uid', 'password' => 'password');
				$this->Auth->login($existingUser);
			}
		} else {
			//MT: obtener la url de login de Google y redireccionar para la gestión de permisos
			$this->redirect($googleClient->createAuthUrl());
		}
		$this->redirect($this->Auth->redirect());
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}

	/**
	* MT:
	* Esta acción toma los datos por POST y autentifica los datos de loggeo mediante el componente Auth. Este componente se configura en el AppController
	* 
	*/
	public function api_login() {
		$response = array('status' => 0, 'message' => '');

		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$response['status'] = 1;
				$response['message'] = $this->modelClass . ' ' . __('found.');
			} else {
				$response['message'] = $this->modelClass . ' ' . __('not found.');
			}
		}

		$this->makeItJson($response);
	}	
}