<?php

include_once '../global.php';

/*
 * Get action to route to.
 */
$action = $_GET['action'];

$sc = new SiteController();
$sc->route($action);

/*
 * Class to control the site.
 */
class SiteController {
	/*
	 * Send not logged in user to login page.
	 */
	public function checkLoginStatus() {
		if (!LoginSession::currentUser()->canViewSite()) {
			header('Location: ' . BASE_URL . '/login');
			exit();
		}
	}

	/*
	 * Route to appropriate function.
	 */
	public function route($action) {
		switch($action) {
			case 'home':
				$this->checkLoginStatus();
				$this->home();
				break;

			case 'processRegister':	$this->processRegister($_POST);	break;

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

			case 'deleteUser':
				$this->checkLoginStatus();
				$uid = htmlspecialchars($_GET['uid']);
				$this->deleteUser($uid);
				break;

			case 'search':
				$this->checkLoginStatus();
				$qry = htmlspecialchars($_GET['s']);
				$this->search($qry);
				break;

			case 'subscribe':
				$authorId = $_POST['name'];
				$check = $_POST['check'];
				$this->subscribe($authorId, $check);
				break;

			case 'manage':
				$this->manage();
				break;
				
			case 'processManage':
				$event = $_POST['type'];
				$uid = $_POST['value'];
				$info = $_POST['info'];
				$this->processManage($uid, $event, $info);
				break;
		}
	}

	/*
	 * Function to send the user to the home page.
	 */
	public function home() {
		$user = LoginSession::currentUser();
		$events = Event::getFeedEvents($user, 10);

		$pageName = 'Home';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/home.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	/*
	 * Function to update the user information.
	 */
	private function updateUser($user, $newProperties) {
    $user->namefirst = htmlspecialchars($newProperties['fname']);
    $user->namelast = htmlspecialchars($newProperties['lname']);
    $user->username = htmlspecialchars($newProperties['user']);
    $user->password = htmlspecialchars($newProperties['pass']);
    $user->email = htmlspecialchars($newProperties['email']);
	if($newProperties['education_type'] != null) {
		$user->education_type = htmlspecialchars($newProperties['education_type']);
	} else {
		$user->education_type = "no";
	}
	$user->role = "registered";

    $user->save();
  }

	/*
	 * Function to register a user.
	 */
  public function processRegister($newProperties) {
    $this->updateUser(new User(), $newProperties);
		header('Location: '. BASE_URL);
	}

	/*
	 * Function to bring the user to their account page.
	 */
	public function account() {
    $user = LoginSession::currentUser();

		$pageName = 'Account Info';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/account.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	/*
	 * Function to update user account information.
	 */
  public function processAccount($newProperties) {
    $this->updateUser(LoginSession::currentUser(), $newProperties);
    header('Location: ' . BASE_URL . '/account');
	}

	/*
	 * Function to view author page.
	 */
	public function viewAuthor($authorName) {
    	$user = LoginSession::currentUser();
		$author = User::loadByUsername($authorName);
		$events = Event::getUserEvents($author, 10);
		$usersAuthorIsSubscribedTo = Subscription::getSubscribedToUsers($author);
		$usersSubscribedToAuthor = Subscription::getSubscribersOf($author);

		$pageName = $authorName;
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/author.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	/*
	 * Function to delete user.
	 */
	public function deleteUser($uid) {
		Db::instance()->deleteById("users", $uid);
		header('Location: ' . BASE_URL);
	}

	/*
	 * Function to search.
	 */
	public function search($qry) {
    $user = LoginSession::currentUser();
		$users = User::search($qry);
		$courses = Course::search($qry);
		$numResults = count($users) + count($courses);

		$pageName = 'Search';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/search.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	/*
	 * Function to subscribe.
	 */
	public function subscribe($authorId, $check) {
		$user = LoginSession::currentUser();
		$author = User::loadById($authorId);
		$results = Subscription::loadBySubscription($user, $author);
		if ($check == 'false') {
			if (count($results) == 1) {
				$sub = $results[0];
				$sub2 = Subscription::loadById($sub->id);
				$sub2->delete();
				$json = array('status' => 'unsubscribed');
			} else {
				$sub = new Subscription();
				$sub->user1id = $user->id;
				$sub->user2id = $author->id;
				$sub->save();
				$json = array('status' => 'subscribed');

				$event = new SubscribeEvent();
				$event->user1id = $user->id;
				$event->user2id = $author->id;
				$event->save();
			}
		} else {
			if (count($results) == 1) {
				$json = array('status' => 'subscribed');
			} else {
				$json = array('status' => 'unsubscribed');
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
	}

	/*
	* Function to view the user manager page for administrators.
	*/
	public function manage() {
		$user = LoginSession::currentUser();
		$users = User::loadAll();
		if ($user->role != "admin") {
			// User does not have permissions
			header("HTTP/1.1 403 Forbidden" );
			exit();
		}
		$pageName = 'User Manager';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/manager.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}
	
	/*
	* Function to update user information as posted by the
	* administrators.
	*/
	public function processManage($uid, $event, $info) {
		$admin = LoginSession::currentUser();
		if ($admin->role != "admin") {
			// User does not have permissions
			header("HTTP/1.1 403 Forbidden" );
			exit();
		}
		$user = User::loadById($uid);
		if($event == "Update") {
			$user->namefirst = $info[0];
			$user->namelast = $info[1];
			$user->email = $info[2];
			$user->save();
			$json = array('status' => 'success');	
		} else if($event == "Delete") {
			$user->delete();
			$json = array('status' => 'success');
		} else if($event == "Promote") {
			$user->role = "admin";
			$user->save();
			$json = array('status' => 'success');
		} else if($event == "Reset") {
			$user->password = "default";
			$user->save();
			$json = array('status' => 'success');
		} else {
			$json = array('status' => 'failure');
		}
		header('Content-Type: application/json');
		echo json_encode($json);
	}
}
