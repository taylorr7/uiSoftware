<?php

include_once '../global.php';

/*
 * Get action to route to.
 */
$action = $_GET['action'];

$lc = new LoginController();
$lc->route($action);

/*
 * Class to control login.
 */
class LoginController {
	/*
	 * Route to appropriate function.
	 */
	public function route($action) {
		switch($action) {
        case 'login': $this->login(); break;

        case 'processLogin':
					$username = $_POST['user'];
					$password = $_POST['pass'];
					$this->processLogin($username, $password);
					break;

        case 'logout': $this->logout(); break;

				default: header('Location: '.BASE_URL);	exit();
		}
	}

	/*
	 * Login function.
	 */
  public function login() {
	 if (LoginSession::isLoggedIn()) {
			header('Location: '. BASE_URL);
			exit();
	 }

		$pageName = 'Login';
		include_once SYSTEM_PATH.'/view/login.tpl';
	}

	/*
	 * Process login function.
	 */
  public function processLogin($u, $p) {
    LoginSession::logIn($u, $p);
    header('Location: '. BASE_URL);
	}

  /*
	 * Logout function.
	 */
  public function logout() {
    LoginSession::logout();
    header('Location: '. BASE_URL);
  }
}
