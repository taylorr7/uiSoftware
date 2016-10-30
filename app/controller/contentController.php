<?php

include_once '../global.php';

$action = $_GET['action'];

$pc = new SiteController();
$pc->route($action);

class SiteController {
	public function route($action) {
		switch($action) {

			case 'viewAuthor': $this->viewAuthor(); break;

			case 'viewCourse':
				if(isset($_GET['cid'])) {
					$id = $_GET['cid'];
				} else {
					$id = null;
				}
				$this->viewCourse($id);
				break;

			case 'processLesson':
				$lname = htmlspecialchars($_POST['lname']);
				$content = htmlspecialchars($_POST['content']);
				$this->processLesson($lname, $content);
				break;

			case 'processCourse':
				$cname = htmlspecialchars($_POST['cname']);
				$description = htmlspecialchars($_POST['cdescription']);
				$content = htmlspecialchars($_POST['ccontent']);
				$this->processCourse($cname, $description, $content);
				break;

			case 'search':
				$qry = htmlspecialchars($_GET['s']);
				$this->search($qry);
				break;

			default: header('Location: '.BASE_URL);	exit();
		}
	}

	public function viewAuthor() {
		$username = htmlspecialchars($_GET['aname']);

		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);
		$sql = "SELECT id, email FROM users WHERE username = '$user'";
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		$uid = $row['id'];
		$email = $row['email'];
		if($uid != null) {
			$sql = "SELECT * FROM courses WHERE userid = '$uid'";
			$result = mysql_query($sql);
			$hash = md5(strtolower(trim($email)));
			$pageName = $user;
			include_once SYSTEM_PATH.'/view/header.tpl';
			include_once SYSTEM_PATH.'/view/author.tpl';
			include_once SYSTEM_PATH.'/view/footer.tpl';
		} else {
			include_once SYSTEM_PATH.'/view/header.tpl';
			include_once SYSTEM_PATH.'/view/footer.tpl';
		}
	}

	public function viewCourse($cid) {
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);
		if($cid != null) {
			$sql = "SELECT * FROM courses WHERE id = '$cid'";
			$result = mysql_query($sql);
			$row = mysql_fetch_assoc($result);
			$cname = $row['coursename'];
			$content = $row['coursecontent'];
			$description = $row['coursedescription'];
		} else {
			$cname = 'Course';
			$content = '';
			$description = '';
		}
		$pageName = 'Course';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/coursepage.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	public function editCourse($cid) {
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);
		if ($cid == null) {
			$uid = $_SESSION['id'];
			$sql = "INSERT INTO `courses` (`id`, `userid`, `coursename`, `coursedescription`, `coursecontent`) VALUES (NULL, $uid, '', '', '')";
			 mysql_query($sql);
		}
		$sql = "SELECT * FROM courses WHERE id = '$cid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);

		$pageName = 'Edit Course';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/editcourse.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	public function editLesson($lid) {
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);
		if ($lid == null) {
			$uid = $_SESSION['id'];
			$sql = "INSERT INTO `lessons` (`id`, `userid`, `lessonname`, `content`) VALUES
					(null, '$uid', '', '')";
			mysql_query($sql);
		}
		$sql = "SELECT * FROM lessons WHERE id = '$lid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);

		$pageName = 'Edit Lesson';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/editlesson.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	public function processLesson($lname, $content) {
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);
		if (isset($_POST['save'])) {
			$sql = "UPDATE `lessons` SET `lessonname` = '$lname', `content` = '$content' WHERE
					`lessons`.`id` = '$id'";
		} else if (isset($_POST['delete'])) {
			$sql = "DELETE FROM `lessons` WHERE `id` = '$id'";
		}
		mysql_query($sql);

		header('Location: '.BASE_URL.'/lessons');
		exit();
	}

	public function processCourse($cname, $description, $content) {
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);
		$cid = $_GET['cid'];
		if (isset($_POST['save'])) {
			$sql = "UPDATE `courses` SET `coursename` = '$cname', `coursedescription` = '$description', `coursecontent` = '$content' WHERE `courses`.`id` = $cid";
		} else if (isset($_POST['delete'])) {
			$sql = "DELETE FROM `lessons` WHERE `id` = $cid";
		}
		mysql_query($sql);

		header('Location: '.BASE_URL.'/courses');
		exit();
	}

	public function search($index) {
		$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error: Could not connect to database.');
		mysql_select_db(DB_DATABASE);
		$pageName = 'Search';
		$qry = $index;
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/search.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}
}
