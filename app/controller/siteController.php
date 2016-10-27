<?php

include_once '../global.php';

$action = $_GET['action'];

$pc = new SiteController();
$pc->route($action);

class SiteController {
	public function route($action) {
		switch($action) {
			case 'home':	$this->home(); break;
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

			case 'register':
				$this->register();
				break;

			case 'processRegister':
				$firstname = htmlspecialchars($_POST['fname']);
				$lastname = htmlspecialchars($_POST['lname']);
				$username = htmlspecialchars($_POST['user']);
				$password = htmlspecialchars($_POST['pass']);
				$email = htmlspecialchars($_POST['email']);
				$this->processRegister($firstname, $lastname, $username, $password, $email);
				break;

			default:
				header('Location: '.BASE_URL);
				exit();
		}
	}

	public function home() {
		$pageName = 'Home';
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/home.tpl';
	}

	public function processNavigation() {
		if (isset($_POST['courses'])) {
			$this->courses();
		} else if (isset($_POST['lessons'])) {
			$this->lessons();
		} else if (isset($_POST['newCourse'])) {
			$this->newCourse();
		} else if (isset($_POST['newLesson'])) {
			$this->newLesson();
		} else if (isset($_POST['accountInfo'])) {
			$this->accountInfo();
		}
	}

	public function courses() {
		$pageName = 'Courses';
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/courses.tpl';
	}

	public function lessons() {
		$pageName = 'Lessons';
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/lessons.tpl';
	}

	public function newCourse() {
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);
		$row['id'] = null;
		$row['coursename'] = '';
		$row['coursedescription'] = '';
		$row['coursecontent'] = '';

		$pageName = 'New Course';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/editcourse.tpl';
	}

	public function newLesson() {
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);
		$row['id'] = null;
		$row['lessonname'] = '';
		$row['content'] = '';

		$pageName = 'New Lesson';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/editlesson.tpl';
	}

	public function accountInfo() {
		$pageName = 'Account Info';
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/accountInfo.tpl';
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

	public function login() {
		$pageName = 'Login';
		include_once SYSTEM_PATH.'/view/login.tpl';
	}

	public function processLogin($u, $p) {
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);
		$sql = "SELECT * FROM users WHERE username = '$u' and password = '$p'";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);
		if($count == 1) {
			session_start();
			$row = mysql_fetch_assoc($result);
			$_SESSION['id'] = $row['id'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['namefirst'] = $row['namefirst'];
			header('Location: '.BASE_URL);
			exit();
		} else {
			header('Location: '.BASE_URL);
			exit();
		}
	}

	public function logout() {
		session_start();
		session_unset();
		session_destroy();
		header('Location: '.BASE_URL);
		exit();
	}

	public function register() {
		$pageName = 'Registration';
		include_once SYSTEM_PATH.'/view/register.tpl';
	}

	public function processRegister($fname, $lname, $uname, $pass, $email) {
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);
		$sql = "INSERT INTO `users` (`id`, `namefirst`, `namelast`, `username`, `password`, `email`)
			VALUES (NULL, '$fname', '$lname', '$uname', '$pass', '$email')";
		if(mysql_query($sql) === TRUE) {
			header('Location: '.BASE_URL);
			exit();
		} else {
			header('Location: '.BASE_URL.'/register');
			exit();
		}
	}
}
