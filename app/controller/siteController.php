<?php

include_once '../global.php';

$action = $_GET['action'];

$pc = new SiteController();
$pc->route($action);

class SiteController {
	public function route($action) {
		switch($action) {
			case 'home':	$this->home(); break;
			case 'courses':	$this->courses(); break;
			case 'lessons':	$this->lessons(); break;
			case 'newCourse':	$this->newCourse(); break;
			case 'newLesson':	$this->newLesson(); break;
			case 'accountInfo':	$this->accountInfo(); break;

			case 'processNavigation': $this->processNavigation(); break;
			case 'processAccountInfo':
				$firstname = htmlspecialchars($_POST['fname']);
				$lastname = htmlspecialchars($_POST['lname']);
				$username = htmlspecialchars($_POST['user']);
				$password = htmlspecialchars($_POST['pass']);
				$email = htmlspecialchars($_POST['email']);
				$id = htmlspecialchars($_POST['id']);
				$this->processAccountInfo($firstname, $lastname, $username, $password, $email, $id);
				break;
			case 'login':	$this->login();	break;
			case 'processLogin':
				$username = $_POST['user'];
				$password = $_POST['pass'];
				$this->processLogin($username, $password);
				break;
			case 'logout': $this->logout();	break;
			case 'processRegister':
				$firstname = htmlspecialchars($_POST['fname']);
				$lastname = htmlspecialchars($_POST['lname']);
				$username = htmlspecialchars($_POST['user']);
				$password = htmlspecialchars($_POST['pass']);
				$email = htmlspecialchars($_POST['email']);
				$this->processRegister($firstname, $lastname, $username, $password, $email);
				break;
			case 'publish':
				$id = $_POST['name'];
				$check = $_POST['check'];
				$this->publish($id, $check);
				break;

			default: header('Location: '.BASE_URL); exit();
		}
	}

	public function home() {
		$pageName = 'Home';
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);

		Session::start();
		$uid = $_SESSION['id'];
		$sql = "SELECT * FROM subscriptions WHERE userid = '$uid'";
		$result = mysql_query($sql);

		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/home.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	public function processNavigation() {
		if (isset($_POST['courses'])) {
			header('Location: '.BASE_URL.'/courses');
		} else if (isset($_POST['lessons'])) {
			header('Location: '.BASE_URL.'/lessons');
		} else if (isset($_POST['newCourse'])) {
			header('Location: '.BASE_URL.'/courses/new');
		} else if (isset($_POST['newLesson'])) {
			header('Location: '.BASE_URL.'/lessons/new');
		} else if (isset($_POST['accountInfo'])) {
			header('Location: '.BASE_URL.'/accountInfo');
		}
	}

	public function courses() {
		$pageName = 'Courses';
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);

		Session::start();
		$uid = $_SESSION['id'];
		$sql = "SELECT * FROM courses WHERE userid = '$uid'";
		$result = mysql_query($sql);

		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/courses.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	public function lessons() {
		$pageName = 'Lessons';
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);

		Session::start();
		$uid = $_SESSION['id'];
		$sql = "SELECT * FROM lessons WHERE userid = '$uid'";
		$result = mysql_query($sql);

		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/lessons.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	public function newCourse() {
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);
		if (isset($_GET['cid'])) {
			$pageName = 'Edit Course';
			$cid = $_GET['cid'];
			$sql = "SELECT * FROM courses WHERE id = '$cid'";
			$result = mysql_query($sql);
			$row = mysql_fetch_assoc($result);
		} else {
			$pageName = 'New Course';
			$row['id'] = null;
 	  	$row['coursename'] = '';
 	 	  $row['coursedescription'] = '';
  		$row['coursecontent'] = '';
		}

		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/editcourse.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	public function newLesson() {
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);
		if (isset($_GET['lid'])) {
			$pageName = 'Edit Lesson';
			$sql = "SELECT * FROM lessons WHERE id = '$lid'";
			$result = mysql_query($sql);
			$row = mysql_fetch_assoc($result);
		} else {
			$pageName = 'New Lesson';
			$row['id'] = null;
 	  	$row['userid'] = $_SESSION['id'];
 	 	  $row['lessonname'] = '';
  		$row['content'] = '';
		}

		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/editlesson.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	public function accountInfo() {
		$pageName = 'Account Info';
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);

		Session::start();
		$uid = $_SESSION['id'];
		$sql = "SELECT * FROM users WHERE id = '$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		$email = $row['email'];
		$hash = md5(strtolower(trim($email)));

		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/accountInfo.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	public function processAccountInfo($fname, $lname, $uname, $pass, $email, $id) {
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);
		$sql = "UPDATE `users` SET `namefirst` = '$fname', `namelast` = '$lname', `username` = '$uname',
				`password` = '$pass', `email` = '$email' WHERE `users`.`id` = '$id'";
		if(mysql_query($sql) === TRUE) {
			header('Location: '.BASE_URL.'/accountInfo');
			exit();
		} else {
			header('Location: '.BASE_URL.'/accountInfo');
			exit();
		}
	}

	public function publish($cid, $check) {
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);
		$sql = "SELECT * FROM `hidden_courses` WHERE `courseid` = '$cid'";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);
		if($count < 1) {
			if($check == 'false') {
				$newHiddenCourse = new HiddenCourse();
				$newHiddenCourse->set('courseid', $cid);
				$newHiddenCourse->save();
			}
			$json = array('status' => 'unpublished');
		} else {
			if($check == 'false') {
				$row = mysql_fetch_assoc($result);
				$id = $row['id'];
				$sql = "DELETE FROM `hidden_courses` WHERE `id` = '$id'";
				mysql_query($sql);
			}
			$json = array('status' => 'published');
		}
		header('Content-Type: application/json');
		echo json_encode($json);
	}
}
