<?php

include_once '../global.php';

$action = $_GET['action'];

$cc = new CourseController();
$cc->checkLoginStatus();
$cc->route($action);

class CourseController {
	public function checkLoginStatus() {
		if (!LoginSession::isLoggedIn()) {
			header('Location: ' . BASE_URL . '/login');
			exit();
		}
	}

	public function route($action) {
		switch($action) {
			case 'courses':
                $this->courses();
                break;

			case 'personalCourses':
				$this->personalCourses();
				break;

            case 'viewCourse':
                $cid = $_GET['cid'];
                $this->viewCourse($cid);
                break;

            case 'loadCourse':
				$cid = $_GET['courseid'];
				$lid = $_GET['lessonid'];
				$this->loadCourse($cid,$lid);
				break;

            case 'newCourse':
                $this->newCourse();
                break;

            case 'editCourse':
                $cid = $_GET['cid'];
                $this->editCourse($cid);
                break;

            case 'processCourse':
                $cid = isset($_GET['cid']) ? $_GET['cid'] : null;
                $cname = htmlspecialchars($_POST['coursename']);
                $cdescription = htmlspecialchars($_POST['coursedescription']);
                $ccontent = htmlspecialchars($_POST['coursecontent']);
                $this->processCourse($cid, $cname, $cdescription, $ccontent);
                break;

			case 'publish':
				$id = $_POST['name'];
				$check = $_POST['check'];
				$this->publish($id, $check);
				break;
		}
	}

	public function courses() {
		$user = LoginSession::currentUser();
		$courses = Course::loadPublished();
		$pageName = 'Courses';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/courses.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	public function personalCourses() {
		$user = LoginSession::currentUser();
		$courses = Course::loadByUser($user);
		$pageName = 'Personal Courses';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/courses.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

    public function viewCourse($cid) {
		$user = LoginSession::currentUser();
		$course = Course::loadById($cid);
        if (!$course->published && $course->userid != $user->id) {
            header("HTTP/1.1 403 Forbidden" );
            exit();
        }

		$pageName = 'Course Info';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/coursepage.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

    public function loadCourse($cid, $lid) {
		$course = Course::loadById($cid);
		$toc = $course->coursecontent;
		if($lid == "null") {
			$content = "null";
		} else if($lid == "home") {
			$content = "Welcome to {$course->coursename}!";
		} else {
			$content = Lesson::loadByName($lid)->content;
		}

		$json = array('toc' => $toc, 'content' => $content);
		header('Content-Type: application/json');
		echo json_encode($json);
	}


	public function newCourse() {
		$user = LoginSession::currentUser();
		$course = new Course();
		$pageName = 'New Course';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/editcourse.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	public function editCourse($cid) {
		$user = LoginSession::currentUser();
		$course = Course::loadById($cid);
        if ($course->userid != $user->id) {
            // User does not own course to edit
            header("HTTP/1.1 403 Forbidden" );
            exit();
        }

		$pageName = 'Edit Course';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/editcourse.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
    }

    public function processCourse($cid, $coursename, $coursedescription, $coursecontent) {
		$user = LoginSession::currentUser();
		if (is_null($cid)) {
			$course = new Course();
		} else {
			$course = Course.loadById($cid);
			if ($course->userid != $user->id) {
	            // User does not own course to edit
	            header("HTTP/1.1 403 Forbidden" );
	            exit();
	        }
		}
        $course->coursename = $coursename;
        $course->coursedescription = $coursedescription;
        $course->coursecontent = $coursecontent;
        $course->save();
    }

	public function publish($cid, $check) {
        $user = LoginSession::currentUser();
		$course = Course.loadById($cid);
        if ($course->userid != $user->id) {
            // User does not own course to edit
            header("HTTP/1.1 403 Forbidden" );
            exit();
        }

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
