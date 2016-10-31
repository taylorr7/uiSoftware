<?php

include_once '../global.php';

$action = $_GET['action'];

$sc = new SiteController();
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
				$this->checkLoginStatus();
				$this->home();
				break;

			case 'processRegister':
				$this->processRegister($_POST);
				break;

			case 'account':
				$this->checkLoginStatus();
				$this->account();
				break;

            case 'processAccount':
				$this->checkLoginStatus();
                $this->processAccount($_POST);
                break;

			case 'viewAuthor':
				$this->checkLoginStatus();
				$authorName = htmlspecialchars($_GET['aname']);
				$this->viewAuthor($authorName);
				break;

			case 'search':
				$this->checkLoginStatus();
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
        $user->namefirst = htmlspecialchars($newProperties['fname']);
        $user->namelast = htmlspecialchars($newProperties['lname']);
        $user->username = htmlspecialchars($newProperties['user']);
        $user->password = htmlspecialchars($newProperties['pass']);
        $user->email = htmlspecialchars($newProperties['email']);
		echo var_dump($user);
        $user->save();
    }

    public function processRegister($newProperties) {
        $this->updateUser(new User(), $newProperties);
		header('Location: '. BASE_URL);
	}

	public function account() {
        $user = LoginSession::currentUser();
		$pageName = 'Account Info';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/account.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

    public function processAccount($newProperties) {
        updateUser(LoginSession::currentUser(), $newProperties);
        header('Location: ' . BASE_URL . '/account');
	}

	public function viewAuthor($authorName) {
        $user = LoginSession::currentUser();
		$author = User::loadByUsername($authorName);
		$pageName = $authorName;
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/author.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	public function search($qry) {
        $user = LoginSession::currentUser();
		$users = User::search($qry);
		$courses = Course::search($qry);
		$pageName = 'Search';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/search.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}
}
