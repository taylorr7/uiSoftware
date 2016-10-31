<?php

include_once '../global.php';

$action = $_GET['action'];

$lc = new LoginController();
$lc->route($action);

class LoginController {
	public function route($action) {
		switch($action) {
            case 'login':
                $this->login();
                break;

            case 'processLogin':
				$username = $_POST['user'];
				$password = $_POST['pass'];
				$this->processLogin($username, $password);
				break;

            case 'logout':
                $this->logout();
                break;
		}
	}

    public function login() {
		if (LoginSession::isLoggedIn()) {
			header('Location: '. BASE_URL);
			exit();
		}

		$pageName = 'Login';
		include_once SYSTEM_PATH.'/view/login.tpl';
	}

    public function processLogin($u, $p) {
        LoginSession::logIn($u, $p);
        header('Location: '. BASE_URL);
	}

    public function logout() {
        LoginSession::logout();
        header('Location: '. BASE_URL);
    }
}
