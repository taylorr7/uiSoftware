<?php

include_once '../global.php';

$action = $_GET['action'];

$sc = new SiteController();
$sc->checkLoginStatus();
$sc->route($action);

class SiteController {
	public function checkLoginStatus() {
		if (!LoginSession::isLoggedIn()) {
			header('Location: ' . BASE_URL . '/login');
			exit();
		}
	}

	public function route($action) {
		switch($action) {
			case 'home':
				$this->home();
				break;

			case 'processRegister':
				$this->processRegister($_POST);
				break;

			case 'account':
				$this->account();
				break;

            case 'processAccount':
                $this->processAccount($_POST);
                break;

			case 'viewAuthor':
				$authorName = htmlspecialchars($_GET['aname']);
				$this->viewAuthor($username);
				break;

			case 'search':
				$qry = htmlspecialchars($_GET['s']);
				$this->search($qry);
				break;
		}
	}

	public function home() {
		$user = LoginSession::currentUser();
		$subscriptions = Subscription::loadByUser($user);
		$pageName = 'Home';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/home.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	private function updateUser($user, $newProperties) {
        $user->firstname = htmlspecialchars($newProperties['fname']);
        $user->lastname = htmlspecialchars($newProperties['lname']);
        $user->username = htmlspecialchars($newProperties['user']);
        $user->password = htmlspecialchars($newProperties['pass']);
        $user->email = htmlspecialchars($newProperties['email']);
        $user->save();
    }

    public function processRegister($newProperties) {
        updateUser(new User(), $newProperties);
		header('Location: '. BASE_URL);
	}

	public function account() {
		if (LoginSession::isLoggedIn()) {
            $user = LoginSession::currentUser();
			$pageName = 'Account Info';
			include_once SYSTEM_PATH.'/view/header.tpl';
			include_once SYSTEM_PATH.'/view/navigation.tpl';
			include_once SYSTEM_PATH.'/view/account.tpl';
        } else {
            header('Location: ' . BASE_URL);
        }
	}

    public function processAccount($newProperties) {
        if (LoginSession::isLoggedIn()) {
            updateUser(LoginSession::currentUser(), $newProperties);
            header('Location: ' . BASE_URL . '/account');
        } else {
            header('Location: ' . BASE_URL);
        }
	}

	public function viewAuthor($authorName) {
		if (LoginSession::isLoggedIn()) {
            $user = LoginSession::currentUser();
			$author = User.loadByUsername($username);
			$pageName = $authorName;
			include_once SYSTEM_PATH.'/view/header.tpl';
			include_once SYSTEM_PATH.'/view/author.tpl';
			include_once SYSTEM_PATH.'/view/footer.tpl';
		} else {
            header('Location: ' . BASE_URL);
		}
	}

	public function search($qry) {
        $user = LoginSession.currentUser();
		$users = User.search($qry);
		$courses = Course.search($qry);
		$pageName = 'Search';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/search.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}
}
