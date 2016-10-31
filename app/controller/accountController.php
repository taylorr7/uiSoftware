<?php

include_once '../global.php';

$action = $_GET['action'];

$lc = new LoginController();
$lc->route($action);

class LoginController {
	public function route($action) {
		switch($action) {
			case 'processRegister':
				$this->processRegister($_POST);
				break;

            case 'processAccountInfo':
                $this->processAccountInfo($_POST);
                break;
		}
	}

    private function updateUser($newProperties) {
        $user->firstname = htmlspecialchars($newProperties['fname']);
        $user->lastname = htmlspecialchars($newProperties['lname']);
        $user->username = htmlspecialchars($newProperties['user']);
        $user->password = htmlspecialchars($newProperties['pass']);
        $user->email = htmlspecialchars($newProperties['email']);
        $user->save();
    }

    public function processRegister($newProperties) {
        updateUser(new User());
		header('Location: '. BASE_URL);
	}

    public function processAccountInfo($newProperties) {
        if (LogginSession::isLoggedIn()) {
            updateUser(LogginSession::currentUser());
            header('Location: ' . BASE_URL . '/account');
        } else {
            header('Location: '. BASE_URL);
        }
	}
}
